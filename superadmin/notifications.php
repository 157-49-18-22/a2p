<?php
$umessage = '';
include('./function/function.php');
check_session();

$pdo = getPDOObject();

// Create table if not exists
$pdo->exec("CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    link VARCHAR(255),
    image_url VARCHAR(255) DEFAULT NULL,
    scheduled_at DATETIME DEFAULT NULL,
    status ENUM('sent', 'scheduled') DEFAULT 'sent',
    fcm_message_id VARCHAR(255) DEFAULT NULL,
    recipients INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Ensure new columns exist (for existing installations)
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN fcm_message_id VARCHAR(255) DEFAULT NULL"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN recipients INT DEFAULT 0"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN image_url VARCHAR(255) DEFAULT NULL"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN scheduled_at DATETIME DEFAULT NULL"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN status ENUM('sent', 'scheduled') DEFAULT 'sent'"); } catch(Exception $e) {}

// Ensure click tracking table exists
$pdo->exec("CREATE TABLE IF NOT EXISTS notification_clicks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    notification_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    clicked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_notification_id (notification_id)
)");

// FCM Helper include
require_once('./function/fcm_helper.php');

// Service Account JSON Path (User should place their firebase-service-account.json here)
$service_account_path = 'firebase-service-account.json';

// Handle Form Submission
if (isset($_POST['send_notif'])) {
    extract($_POST);

    // 1. Build tracking URL dynamically
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $site_base = "$protocol://$host/superadmin";
    $app_base = "$protocol://$host";
    
    // Adjust for subdirectories like /cms/
    if (strpos($_SERVER['REQUEST_URI'], '/cms/') !== false) {
        $site_base = "$protocol://$host/cms/superadmin";
        $app_base = "$protocol://$host/cms";
    }

    // Handle Image Upload
    if (isset($_FILES['notif_img']) && $_FILES['notif_img']['error'] == 0) {
        $target_dir = "../upload/notifications/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_ext = pathinfo($_FILES["notif_img"]["name"], PATHINFO_EXTENSION);
        $file_name = "notif_" . time() . "_" . rand(1000, 9999) . "." . $file_ext;
        $target_file = $target_dir . $file_name;
        
        if (move_uploaded_file($_FILES["notif_img"]["tmp_name"], $target_file)) {
            $image_url = $app_base . "/upload/notifications/" . $file_name;
        }
    }

    // 2. Save to Database first to get ID
    $is_scheduled = !empty($scheduled_at);
    $status = $is_scheduled ? 'scheduled' : 'sent';
    
    $q = $pdo->prepare("INSERT INTO notifications (title, message, link, image_url, scheduled_at, status) VALUES (:title, :message, :link, :image_url, :scheduled_at, :status)");
    $q->execute([
        ':title'   => $title,
        ':message' => $message,
        ':link'    => $link,
        ':image_url' => $image_url ?: null,
        ':scheduled_at' => $scheduled_at ?: null,
        ':status' => $status
    ]);
    $notif_db_id = $pdo->lastInsertId();

    if ($is_scheduled) {
        $umessage = '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><i class="mdi mdi-clock-outline me-1"></i> Scheduled!</strong> Notification scheduled for ' . htmlspecialchars($scheduled_at) . '.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        // 3. Build tracking link for this notification
        $tracking_link = $link;
        if ($link && $notif_db_id) {
            $tracking_link = $site_base . '/track_click.php?notif_id=' . $notif_db_id . '&redirect=' . urlencode($link);
        }

        // 4. Send via FCM
        $success_count = 0;
        $fail_count = 0;
        try {
            if (!file_exists($service_account_path)) {
                throw new Exception("Service Account JSON file not found! Please place 'firebase-service-account.json' in the superadmin directory.");
            }
            $fcm = new FCMHelper($service_account_path);

            // Fetch all UNIQUE tokens
            $tokens = $pdo->query("SELECT DISTINCT fcm_token FROM subscriber_devices WHERE fcm_token IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);
            
            foreach ($tokens as $token) {
                if(strlen($token) < 20) continue;
                
                $sender = $fcm->sendNotification($token, $title, $message, $tracking_link ?: $link, $image_url);
                
                if ($sender['success']) {
                    $success_count++;
                } else {
                    $fail_count++;
                    $err = $sender['response']['error']['message'] ?? '';
                    if(strpos($err, 'NOT_FOUND') !== false || strpos($err, 'UNREGISTERED') !== false) {
                        $pdo->prepare("DELETE FROM subscriber_devices WHERE fcm_token = ?")->execute([$token]);
                    }
                }
            }

            // Update notification with final stats
            $pdo->prepare("UPDATE notifications SET fcm_message_id = :fcmid, recipients = :rcpt WHERE id = :id")
                ->execute([
                    ':fcmid' => 'FCM_BATCH_' . time(), 
                    ':rcpt' => $success_count, 
                    ':id' => $notif_db_id
                ]);

            $umessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="mdi mdi-check-circle me-1"></i> Success!</strong> Notification sent to ' . $success_count . ' device(s). (Failed: ' . $fail_count . ')
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';

        } catch (Exception $e) {
            $umessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert me-2"></i>
                Error sending via FCM: <strong>' . htmlspecialchars($e->getMessage()) . '</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
        }
    }
}

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = (int)$_GET['id'];
    $pdo->query("DELETE FROM notifications WHERE id='$id'");
    $pdo->query("DELETE FROM notification_clicks WHERE notification_id='$id'");
    echo "<script>window.location.href='notifications.php';</script>";
}

// Get all notifications with click counts
$notifs = $pdo->query("
    SELECT n.*, 
           COALESCE(nc.clicks, 0) AS click_count
    FROM notifications n
    LEFT JOIN (
        SELECT notification_id, COUNT(*) AS clicks 
        FROM notification_clicks 
        GROUP BY notification_id
    ) nc ON nc.notification_id = n.id
    ORDER BY n.id DESC
")->fetchAll(PDO::FETCH_ASSOC);

// Total subscribers
$total_subs = $pdo->query("SELECT COUNT(*) FROM subscriber_devices")->fetchColumn();

require('include/header.php');
?>

<style>
.notif-form-card {
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 24px rgba(102, 126, 234, 0.12);
}
.notif-form-card .card-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1.2rem 1.5rem;
    font-weight: 600;
    font-size: 1rem;
}
.history-card {
    border-radius: 16px;
    border: none;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
}
.history-card .card-header {
    padding: 1.2rem 1.5rem;
    font-weight: 600;
    border-bottom: 1px solid rgba(0,0,0,0.07);
}
.subs-banner {
    background: linear-gradient(135deg, #1a1a2e, #16213e);
    border-radius: 16px;
    padding: 1.2rem 1.5rem;
    color: #fff;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}
.subs-banner .subs-count {
    font-size: 2.5rem;
    font-weight: 800;
    color: #38ef7d;
    line-height: 1;
}
.metric-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    border-radius: 30px;
    padding: 3px 10px;
    font-size: 0.75rem;
    font-weight: 500;
}
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-1"><span class="text-muted fw-light">Admin /</span> Push Notifications</h4>
        <p class="text-muted mb-4">Create and manage push notifications. Click "Analytics" on any notification to see delivery & click stats.</p>

        <?php echo $umessage; ?>

        <!-- Subscriber Banner -->
        <div class="subs-banner">
            <div>
                <div class="subs-count"><?php echo number_format($total_subs); ?></div>
                <div style="opacity:0.7;font-size:0.9rem;margin-top:4px;">Total active push subscribers</div>
            </div>
            <a href="subscribers.php" class="btn btn-sm" style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.25);">
                <i class="mdi mdi-chart-bar me-1"></i> View Subscriber Analytics
            </a>
        </div>

        <!-- Send Notification Form -->
        <div class="card notif-form-card mb-4">
            <div class="card-header">
                <i class="mdi mdi-bell-plus-outline me-2"></i> Create New Push Notification
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Notification Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. New Property Launch!" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Target Link <small class="text-muted">(optional — click tracking auto-applied)</small></label>
                            <input type="url" name="link" class="form-control" placeholder="https://a2prealtech.com/product.php">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Upload Image <small class="text-muted">(Device se upload karein)</small></label>
                            <input type="file" name="notif_img" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">OR Image URL <small class="text-muted">(Agar link hai to)</small></label>
                            <input type="url" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Schedule Sending <small class="text-muted">(optional - leave empty for instant)</small></label>
                            <input type="datetime-local" name="scheduled_at" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Message Content <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Enter your notification message..." required></textarea>
                        </div>
                    </div>
                    <button type="submit" name="send_notif" class="btn btn-primary d-flex align-items-center">
                        <i class="mdi mdi-send me-2"></i> SEND NOTIFICATION
                    </button>
                    <div class="form-text mt-2">
                        <i class="mdi mdi-information-outline"></i> Click tracking is automatically enabled for individual notifications.
                    </div>
                </form>
            </div>
        </div>

        <!-- Notification History -->
        <div class="card history-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="mdi mdi-history me-2"></i>Notification History</span>
                <span class="badge bg-label-secondary"><?php echo count($notifs); ?> notifications</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Recipients</th>
                            <th>Clicks</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; foreach ($notifs as $n): ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><strong><?php echo htmlspecialchars($n['title']); ?></strong></td>
                            <td style="max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                <?php echo htmlspecialchars($n['message']); ?>
                            </td>
                            <td>
                                <?php if ($n['status'] == 'scheduled'): ?>
                                <span class="badge bg-label-warning">
                                    <i class="mdi mdi-clock-fast"></i> Scheduled
                                </span>
                                <?php elseif ($n['fcm_message_id']): ?>
                                <span class="metric-pill" style="background:#e8f5e9;color:#2e7d32;">
                                    <i class="mdi mdi-send-check-outline"></i>
                                    <?php echo number_format($n['recipients'] ?? 0); ?>
                                </span>
                                <?php else: ?>
                                <span class="text-muted small">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="metric-pill" style="background:#e3f2fd;color:#1565c0;">
                                    <i class="mdi mdi-cursor-default-click-outline"></i>
                                    <?php echo number_format($n['click_count']); ?>
                                </span>
                            </td>
                            <td><small><?php echo date('d M, Y h:i A', strtotime($n['created_at'])); ?></small></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="notification_analytics.php?id=<?php echo $n['id']; ?>"
                                       class="btn btn-sm btn-outline-primary" title="View Analytics">
                                        <i class="mdi mdi-chart-areaspline"></i> Analytics
                                    </a>
                                    <a href="notifications.php?id=<?php echo $n['id']; ?>&action=delete"
                                       onclick="return confirm('Delete this notification and all its analytics?')"
                                       class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($notifs)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="mdi mdi-bell-off-outline" style="font-size:2.5rem;display:block;margin-bottom:10px;opacity:0.3;"></i>
                                No notifications sent yet.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /container -->
</div><!-- /content-wrapper -->

<?php require('include/footer.php'); ?>

