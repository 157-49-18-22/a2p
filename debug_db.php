<?php
include('function/function.php');
$pdo = getPDOObject();

echo "<h3>FCM Debug Dashboard</h3>";

// 1. Check Notifications Table
$notifs = $pdo->query("SELECT COUNT(*) FROM notifications")->fetchColumn();
echo "Total Notifications in DB: " . $notifs . "<br>";

// 2. Check Subscriber Devices
$subs = $pdo->query("SELECT COUNT(*) FROM subscriber_devices")->fetchColumn();
echo "Total Subscribers in DB: " . $subs . "<br>";

// 3. Last 5 Notifications
echo "<h4>Last 5 Notifications:</h4>";
$last = $pdo->query("SELECT * FROM notifications ORDER BY id DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($last);
echo "</pre>";

// 4. Test Token
$tokens = $pdo->query("SELECT fcm_token FROM subscriber_devices LIMIT 1")->fetchColumn();
echo "Sample Token: " . substr($tokens, 0, 30) . "...<br>";
?>
