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
    onesignal_notification_id VARCHAR(255) DEFAULT NULL,
    recipients INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Ensure new columns exist (for existing installations)
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN onesignal_notification_id VARCHAR(255) DEFAULT NULL"); } catch(Exception $e) {}
try { $pdo->exec("ALTER TABLE notifications ADD COLUMN recipients INT DEFAULT 0"); } catch(Exception $e) {}

// Ensure click tracking table exists
$pdo->exec("CREATE TABLE IF NOT EXISTS notification_clicks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    notification_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    clicked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_notification_id (notification_id)
)");

// OneSignal keys
$app_id      = "d672c804-fe64-41c5-b321-44e92cf74cc9";
$rest_api_key = "os_v2_app_2zzmqbh6mra4lmzbitusz52mzh2srdmqcqke2je6x2lltzfz6umhi5r2s4sl5ipdvspr7h3unk6mzitwg2bjq3lwqa5af7agwvq7nfa";

// Handle Form Submission
if (isset($_POST['send_notif'])) {
    extract($_POST);

    // 1. Build tracking URL dynamically based on current domain
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']); // returns /cms/superadmin or /superadmin
    $site_base = $protocol . $host . $path;

    // 2. Save to Database first to get ID
    $q = $pdo->prepare("INSERT INTO notifications (title, message, link) VALUES (:title, :message, :link)");
    $q->execute([
        ':title'   => $title,
        ':message' => $message,
        ':link'    => $link
    ]);
    $notif_db_id = $pdo->lastInsertId();

    // 3. Build tracking link for this notification
    $tracking_link = $link;
    if ($link && $notif_db_id) {
        $tracking_link = $site_base . '/track_click.php?notif_id=' . $notif_db_id . '&redirect=' . urlencode($link);
    }

    // 4. Send via OneSignal
    $content  = ["en" => $message];
    $headings = ["en" => $title];

    $fields = [
        'app_id'             => $app_id,
        'target_channel'     => 'push',
        'included_segments'  => ['Subscribed Users'],
        'contents'           => $content,
        'headings'           => $headings,
        'url'                => $tracking_link ?: $link
    ];

    $fields_json = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.onesignal.com/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Key $rest_api_key"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_json);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    $res_json = json_decode($response, true);
    curl_close($ch);

    // 5. Update notification with OneSignal ID
    if (isset($res_json['id'])) {
        $pdo->prepare("UPDATE notifications SET onesignal_notification_id = :osid, recipients = :rcpt WHERE id = :id")
            ->execute([':osid' => $res_json['id'], ':rcpt' => $res_json['recipients'] ?? 0, ':id' => $notif_db_id]);
        $umessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>
            <strong>Success!</strong> Notification sent to <strong>' . number_format($res_json['recipients'] ?? 0) . '</strong> device(s).
            <a href="notification_analytics.php?id=' . $notif_db_id . '" class="btn btn-sm btn-light ms-3">View Analytics</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
    } else {
        $err_msg = isset($res_json['errors'][0]) ? $res_json['errors'][0] : 'Push failed';
        $umessage = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert me-2"></i>
            Notification saved to DB, but device push failed: <strong>' . htmlspecialchars($err_msg) . '</strong>
            <br><small class="text-muted">OneSignal Response: ' . htmlspecialchars($response) . '</small>
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
                <form action="notifications.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Notification Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. New Property Launch!" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Target Link <span class="text-muted fw-normal">(optional — click tracking auto-applied)</span></label>
                            <input type="text" name="link" class="form-control" placeholder="https://a2prealtech.com/product.php">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-medium">Message Content <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Enter your notification message..." required></textarea>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" name="send_notif" class="btn btn-primary">
                            <i class="mdi mdi-send me-2"></i> Send to <?php echo number_format($total_subs); ?> Subscriber(s)
                        </button>
                        <small class="text-muted"><i class="mdi mdi-information-outline me-1"></i>Click tracking is automatically applied to the link.</small>
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
                                <?php if ($n['onesignal_notification_id']): ?>
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
