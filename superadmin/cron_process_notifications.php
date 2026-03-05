<?php
/**
 * Cron script to process scheduled push notifications
 * Setup: Run this script via cron job every minute
 * Example: * * * * * php /path/to/superadmin/cron_process_notifications.php
 */

require_once(__DIR__ . '/function/function.php');
require_once(__DIR__ . '/function/fcm_helper.php');

$pdo = getPDOObject();

// 1. Get current time
$now = date('Y-m-d H:i:s');

// 2. Find pending scheduled notifications
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE status = 'scheduled' AND scheduled_at <= :now");
$stmt->execute([':now' => $now]);
$pending = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($pending)) {
    exit("No pending notifications to send.\n");
}

// 3. Setup Configuration
$service_account_path = __DIR__ . '/firebase-service-account.json';
if (!file_exists($service_account_path)) {
    exit("Error: Service account file not found.\n");
}

$fcm = new FCMHelper($service_account_path);

// Determine Site Base for tracking links
// Since this runs in CLI, we might need a hardcoded or stored base URL
// We'll try to guess or use a fallback. 
// Ideally, SITE_URL should be defined in function.php or config.php
$site_base = defined('SITE_URL') ? SITE_URL . 'superadmin' : 'https://' . ($_SERVER['HTTP_HOST'] ?? 'pink-sheep-796549.hostingersite.com') . '/cms/superadmin';

foreach ($pending as $n) {
    echo "Processing Notification ID: " . $n['id'] . " - " . $n['title'] . "\n";
    
    $notif_db_id = $n['id'];
    $link = $n['link'];
    $image_url = $n['image_url'];
    
    // Build tracking link
    $tracking_link = $link;
    if ($link && $notif_db_id) {
        $tracking_link = $site_base . '/track_click.php?notif_id=' . $notif_db_id . '&redirect=' . urlencode($link);
    }

    // Fetch tokens
    $tokens = $pdo->query("SELECT DISTINCT fcm_token FROM subscriber_devices WHERE fcm_token IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);
    
    $success_count = 0;
    $fail_count = 0;
    
    foreach ($tokens as $token) {
        if(strlen($token) < 20) continue;
        
        $sender = $fcm->sendNotification($token, $n['title'], $n['message'], $tracking_link ?: $link, $image_url);
        
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

    // Update notification status
    $pdo->prepare("UPDATE notifications SET status = 'sent', fcm_message_id = :fcmid, recipients = :rcpt WHERE id = :id")
        ->execute([
            ':fcmid' => 'FCM_CRON_' . time(),
            ':rcpt' => $success_count,
            ':id' => $notif_db_id
        ]);
    
    echo "Sent to $success_count devices. Failed: $fail_count.\n";
}

echo "Done.\n";
