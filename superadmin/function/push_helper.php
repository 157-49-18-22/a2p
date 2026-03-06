<?php
require_once __DIR__ . '/fcm_helper.php';

/**
 * Sends a push notification to all subscribers and records it in history.
 */
function sendGlobalPushNotification($title, $message, $link = '', $image = '') {
    $pdo = getPDOObject();
    $service_account_path = __DIR__ . '/../firebase-service-account.json';
    
    // 1. Determine site base for tracking
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $site_base = "$protocol://$host/superadmin";
    $app_base = "$protocol://$host";
    
    if (strpos($_SERVER['REQUEST_URI'], '/cms/') !== false) {
        $site_base = "$protocol://$host/cms/superadmin";
        $app_base = "$protocol://$host/cms";
    }

    // Link construction
    if ($link && strpos($link, 'http') !== 0) {
        $link = $app_base . '/' . ltrim($link, '/');
    }

    try {
        // 2. Save to history first
        $q = $pdo->prepare("INSERT INTO notifications (title, message, link, image_url, status) VALUES (:title, :message, :link, :image_url, 'sent')");
        $q->execute([
            ':title'   => $title,
            ':message' => $message,
            ':link'    => $link,
            ':image_url' => $image ?: null
        ]);
        $notif_db_id = $pdo->lastInsertId();

        // 3. Prepare tracking link
        $tracking_link = $link;
        if ($link && $notif_db_id) {
            $tracking_link = $site_base . '/track_click.php?notif_id=' . $notif_db_id . '&redirect=' . urlencode($link);
        }

        // 4. Send via FCM
        $fcm = new FCMHelper($service_account_path);
        $tokens = $pdo->query("SELECT DISTINCT fcm_token FROM subscriber_devices WHERE fcm_token IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);
        
        $success_count = 0;
        foreach ($tokens as $token) {
            if(strlen($token) < 20) continue;
            
            $sender = $fcm->sendNotification($token, $title, $message, $tracking_link ?: $link, $image);
            
            if ($sender['success']) {
                $success_count++;
            } else {
                $err = $sender['response']['error']['message'] ?? '';
                if(strpos($err, 'NOT_FOUND') !== false || strpos($err, 'UNREGISTERED') !== false) {
                    $pdo->prepare("DELETE FROM subscriber_devices WHERE fcm_token = ?")->execute([$token]);
                }
            }
        }

        // 5. Update stats
        $pdo->prepare("UPDATE notifications SET fcm_message_id = :fcmid, recipients = :rcpt WHERE id = :id")
            ->execute([
                ':fcmid' => 'AUTO_' . time(), 
                ':rcpt' => $success_count, 
                ':id' => $notif_db_id
            ]);

        return $success_count;
    } catch (Exception $e) {
        error_log("Push Error: " . $e->getMessage());
        return false;
    }
}
?>
