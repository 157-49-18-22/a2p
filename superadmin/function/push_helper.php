<?php
require_once __DIR__ . '/fcm_helper.php';

if (!function_exists('sendGlobalPushNotification')) {
    /**
     * Sends a push notification to all subscribers and logs it in the history.
     */
    function sendGlobalPushNotification($title, $message, $link = '', $image_url = '') {
        $pdo = getPDOObject();
        $service_account_path = __DIR__ . '/../firebase-service-account.json';
        
        // 1. Save to Database for history
        try {
            $q = $pdo->prepare("INSERT INTO notifications (title, message, link, image_url, status) VALUES (:title, :message, :link, :image_url, 'sent')");
            $q->execute([
                ':title'   => $title,
                ':message' => $message,
                ':link'    => $link,
                ':image_url' => $image_url ?: null
            ]);
            $notif_db_id = $pdo->lastInsertId();
        } catch (Exception $e) {
            error_log("DB Insert Error in Push Helper: " . $e->getMessage());
            $notif_db_id = 0;
        }

        // 2. Build tracking link if notification_id is available
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        
        // Try to detect base path (cms or root)
        $base_url = "$protocol://$host";
        $superadmin_url = "$protocol://$host/superadmin";
        
        if (strpos($_SERVER['REQUEST_URI'], '/cms/') !== false) {
            $base_url = "$protocol://$host/cms";
            $superadmin_url = "$protocol://$host/cms/superadmin";
        }
        
        $tracking_link = $link;
        if ($link && $notif_db_id) {
            $tracking_link = $superadmin_url . '/track_click.php?notif_id=' . $notif_db_id . '&redirect=' . urlencode($link);
        }

        // 3. Send via FCM
        try {
            $fcm = new FCMHelper($service_account_path);
            
            // Get all unique tokens
            $tokens = $pdo->query("SELECT DISTINCT fcm_token FROM subscriber_devices WHERE fcm_token IS NOT NULL")->fetchAll(PDO::FETCH_COLUMN);
            
            $success_count = 0;
            $fail_count = 0;

            foreach ($tokens as $token) {
                if (strlen($token) < 20) continue;
                
                $sender = $fcm->sendNotification($token, $title, $message, $tracking_link ?: $link, $image_url);
                
                if ($sender['success']) {
                    $success_count++;
                } else {
                    $fail_count++;
                    // Cleanup invalid tokens
                    $err = $sender['response']['error']['message'] ?? '';
                    if (strpos($err, 'NOT_FOUND') !== false || strpos($err, 'UNREGISTERED') !== false) {
                        $pdo->prepare("DELETE FROM subscriber_devices WHERE fcm_token = ?")->execute([$token]);
                    }
                }
            }

            // Update stats in DB
            if ($notif_db_id) {
                $pdo->prepare("UPDATE notifications SET fcm_message_id = :fcmid, recipients = :rcpt WHERE id = :id")
                    ->execute([
                        ':fcmid' => 'AUTO_' . date('Ymd_His'), 
                        ':rcpt' => $success_count, 
                        ':id' => $notif_db_id
                    ]);
            }

            return $success_count;
        } catch (Exception $e) {
            error_log("Push Helper FCM Error: " . $e->getMessage());
            return false;
        }
    }
}
?>
