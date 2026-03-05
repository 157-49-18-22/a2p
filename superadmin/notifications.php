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
    image VARCHAR(255) DEFAULT NULL,
    schedule_time DATETIME DEFAULT NULL,
    is_sent TINYINT(1) DEFAULT 1,
    fcm_message_id VARCHAR(255) DEFAULT NULL,
    recipients INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Ensure new columns exist (for existing installations)
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN fcm_message_id VARCHAR(255) DEFAULT NULL"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN recipients INT DEFAULT 0"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN image VARCHAR(255) DEFAULT NULL"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN schedule_time DATETIME DEFAULT NULL"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN is_sent TINYINT(1) DEFAULT 1"); } catch(Exception $e) {}

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
    
    // 0. Handle File Upload or URL
    $image_url = !empty($image_url) ? trim($image_url) : null;
    
    if (!empty($_FILES['notif_file']['name'])) {
        $upload_dir = '../upload/notifications/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_ext = pathinfo($_FILES['notif_file']['name'], PATHINFO_EXTENSION);
        $file_name = 'notif_' . time() . '.' . $file_ext;
        $target_file = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['notif_file']['tmp_name'], $target_file)) {
            $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
            $image_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/upload/notifications/' . $file_name;
            // Adjust for /cms/ if current site has it
            if (strpos($_SERVER['REQUEST_URI'], '/cms/') !== false) {
                 $image_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/cms/upload/notifications/' . $file_name;
            }
        }
    }
    
    $image = $image_url; // Map to database column
    $schedule_time = !empty($schedule_time) ? $schedule_time : null;
    $is_sent = $schedule_time ? 0 : 1;

    // 1. Build tracking URL dynamically
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $site_base = "$protocol://$host/superadmin";
    if (strpos($_SERVER['REQUEST_URI'], '/cms/') !== false) {
        $site_base = "$protocol://$host/cms/superadmin";
    }

    // 2. Save to Database first to get ID
    $q = $pdo->prepare("INSERT INTO notifications (title, message, link, image, schedule_time, is_sent) VALUES (:title, :message, :link, :image, :schedule_time, :is_sent)");
    $q->execute([
        ':title'         => $title,
        ':message'       => $message,
        ':link'          => $link,
        ':image'         => $image,
        ':schedule_time' => $schedule_time,
        ':is_sent'       => $is_sent
    ]);
    $notif_db_id = $pdo->lastInsertId();

    // 3. Build tracking link
    $tracking_link = $link;
    if ($link && $notif_db_id) {
        $tracking_link = $site_base . '/track_click.php?notif_id=' . $notif_db_id . '&redirect=' . urlencode($link);
    }

    // 4. Send via FCM ONLY IF not scheduled for later
    if ($is_sent) {
        $success_count = 0;
        $fail_count = 0;
        try {
            if (!file_exists($service_account_path)) {
                throw new Exception("Service Account JSON file not found!");
            }
            $fcm = new FCMHelper($service_account_path);

            $tokens = $pdo->query("SELECT DISTINCT fcm_token FROM subscriber_devices WHERE fcm_token IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);
            
            foreach ($tokens as $token) {
                if(strlen($token) < 20) continue;
                $sender = $fcm->sendNotification($token, $title, $message, $tracking_link ?: $link, $image);
                if ($sender['success']) { $success_count++; } 
                else {
                    $err = $sender['response']['error']['message'] ?? '';
                    if(strpos($err, 'NOT_FOUND') !== false || strpos($err, 'UNREGISTERED') !== false) {
                        $pdo->prepare("DELETE FROM subscriber_devices WHERE fcm_token = ?")->execute([$token]);
                    }
                    $fail_count++;
                }
            }

            $pdo->prepare("UPDATE notifications SET fcm_message_id = :fcmid, recipients = :rcpt, is_sent = 1 WHERE id = :id")
                ->execute([':fcmid' => 'FCM_BATCH_' . time(), ':rcpt' => $success_count, ':id' => $notif_db_id]);

            $umessage = '<div class="alert alert-success alert-dismissible fade show">
                <strong><i class="mdi mdi-check-circle"></i> Success!</strong> Sent to ' . $success_count . ' devices. (Failed: ' . $fail_count . ')
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
        } catch (Exception $e) {
            $umessage = '<div class="alert alert-danger alert-dismissible fade show">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } else {
        $umessage = '<div class="alert alert-info alert-dismissible fade show">
            <strong><i class="mdi mdi-clock-outline"></i> Scheduled!</strong> Notification saved and scheduled for ' . date('d M, Y h:i A', strtotime($schedule_time)) . '.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
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
                            <label class="form-label">Target Link <small class="text-muted">(optional)</small></label>
                            <input type="url" name="link" class="form-control" placeholder="https://a2prealtech.com/product.php">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image URL <small class="text-muted">(direct link)</small></label>
                            <input type="url" name="image_url" id="imageInput" class="form-control" placeholder="https://example.com/promo.jpg" oninput="if(this.value){ document.getElementById('imgPreview').src = this.value; document.getElementById('previewContainer').style.display = 'block'; }">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">OR Upload Image <small class="text-muted">(from device)</small></label>
                            <input type="file" name="notif_file" class="form-control" accept="image/*" onchange="const file = this.files[0]; if(file){ const reader = new FileReader(); reader.onload = (e) => { document.getElementById('imgPreview').src = e.target.result; document.getElementById('previewContainer').style.display = 'block'; }; reader.readAsDataURL(file); }">
                        </div>
                        <div id="previewContainer" class="col-12 mb-3 mt-1" style="display:none;">
                            <label class="form-label d-block">Image Preview:</label>
                            <img id="imgPreview" src="" style="max-height:120px; border-radius:8px; border:2px solid #696cff22; padding:4px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Schedule Time <small class="text-muted">(leave empty to send now)</small></label>
                            <input type="datetime-local" name="schedule_time" class="form-control">
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
                            <th>Status</th>
                            <th>Title / Message</th>
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
                            <td>
                                <?php if($n['is_sent']): ?>
                                    <span class="badge bg-label-success">Sent</span>
                                <?php else: ?>
                                    <span class="badge bg-label-warning">Scheduled</span>
                                <?php endif; ?>
                            </td>
                            <td style="max-width:300px;">
                                <div class="d-flex align-items-center gap-2">
                                    <?php if($n['image']): ?>
                                        <img src="<?php echo $n['image']; ?>" style="width:40px;height:40px;border-radius:4px;object-fit:cover;" onerror="this.src='/assets/images/placeholder.png'">
                                    <?php endif; ?>
                                    <div style="overflow:hidden;">
                                        <div class="text-truncate"><strong><?php echo htmlspecialchars($n['title']); ?></strong></div>
                                        <div class="text-muted small text-truncate"><?php echo htmlspecialchars($n['message']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if ($n['fcm_message_id']): ?>
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
                            <td>
                                <small>
                                    Created: <?php echo date('d M, h:i A', strtotime($n['created_at'])); ?>
                                    <?php if(!$n['is_sent'] && $n['schedule_time']): ?>
                                        <div class="text-primary fw-bold">Send at: <?php echo date('d M, h:i A', strtotime($n['schedule_time'])); ?></div>
                                    <?php endif; ?>
                                </small>
                            </td>
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

