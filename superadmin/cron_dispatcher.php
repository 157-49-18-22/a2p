<?php
/**
 * CRON DISPATCHER for Scheduled Push Notifications
 * Recommended to run every 1 minute via Cron Job:
 * * * * * * php /path/to/superadmin/cron_dispatcher.php
 */

// Since this might be run via CLI, we need proper paths
chdir(__DIR__);
include('./function/function.php');
require_once('./function/fcm_helper.php');

$pdo = getPDOObject();
$service_account_path = 'firebase-service-account.json';

if (!file_exists($service_account_path)) {
    die("Service Account JSON file not found!");
}

$fcm = new FCMHelper($service_account_path);

// 1. Fetch notifications that are due but not yet sent
$due_notifs = $pdo->query("SELECT * FROM notifications WHERE is_sent = 0 AND schedule_time <= NOW()")->fetchAll(PDO::FETCH_ASSOC);

if (empty($due_notifs)) {
    echo "No due notifications to send.\n";
    exit;
}

// Get all subscriber tokens once for optimization (if list is small)
$tokens = $pdo->query("SELECT DISTINCT fcm_token FROM subscriber_devices WHERE fcm_token IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);

foreach ($due_notifs as $n) {
    echo "Processing Notif ID: " . $n['id'] . " (" . $n['title'] . ")...\n";
    
    $success_count = 0;
    
    // Build tracking link
    $protocol = "https"; // Assume HTTPS for production
    $host = $_SERVER['HTTP_HOST'] ?? 'a2prealtech.com';
    $site_base = "$protocol://$host/superadmin";
    // Adjust if necessary
    
    $tracking_link = $n['link'];
    if ($n['link']) {
        $tracking_link = "https://a2prealtech.com/superadmin/track_click.php?notif_id=" . $n['id'] . "&redirect=" . urlencode($n['link']);
    }

    foreach ($tokens as $token) {
        if(strlen($token) < 20) continue;
        
        $sender = $fcm->sendNotification($token, $n['title'], $n['message'], $tracking_link ?: $n['link'], $n['image']);
        
        if ($sender['success']) {
            $success_count++;
        } else {
            $err = $sender['response']['error']['message'] ?? '';
            if(strpos($err, 'NOT_FOUND') !== false || strpos($err, 'UNREGISTERED') !== false) {
                $pdo->prepare("DELETE FROM subscriber_devices WHERE fcm_token = ?")->execute([$token]);
            }
        }
    }

    // Mark as sent
    $pdo->prepare("UPDATE notifications SET fcm_message_id = :fcmid, recipients = :rcpt, is_sent = 1 WHERE id = :id")
        ->execute([
            ':fcmid' => 'CRON_BATCH_' . time(),
            ':rcpt' => $success_count,
            ':id' => $n['id']
        ]);
        
    echo "Sent to $success_count devices.\n";
}

echo "All due notifications processed.\n";
?>
