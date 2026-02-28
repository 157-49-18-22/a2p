<?php
include('function/function.php');
$pdo = getPDOObject();

if (isset($_POST['onesignal_id'])) {
    $onesignal_id = $_POST['onesignal_id'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    // Parse User Agent for basic Device Info
    $device_type = "Desktop";
    if (preg_match('/Mobi|Android|iPhone/i', $user_agent)) {
        $device_type = "Mobile";
    }
    
    // OS Detection
    $os = "Unknown OS";
    if (preg_match('/Windows/i', $user_agent)) $os = "Windows";
    elseif (preg_match('/Android/i', $user_agent)) $os = "Android";
    elseif (preg_match('/iPhone|iPad|Macintosh/i', $user_agent)) $os = "iOS/macOS";
    elseif (preg_match('/Linux/i', $user_agent)) $os = "Linux";

    // Browser Detection
    $browser = "Unknown Browser";
    if (preg_match('/Chrome/i', $user_agent)) $browser = "Chrome";
    elseif (preg_match('/Firefox/i', $user_agent)) $browser = "Firefox";
    elseif (preg_match('/Safari/i', $user_agent)) $browser = "Safari";
    elseif (preg_match('/Edge/i', $user_agent)) $browser = "Edge";
    
    // Check if ID already exists
    $check = $pdo->prepare("SELECT id FROM notification_subscribers WHERE onesignal_id = ?");
    $check->execute([$onesignal_id]);
    
    if($check->rowCount() == 0) {
        $q = $pdo->prepare("INSERT INTO notification_subscribers (onesignal_id, device_type, os, browser, ip_address, user_agent) 
                            VALUES (:onesignal_id, :device_type, :os, :browser, :ip_address, :user_agent)");
        $q->execute([
            ':onesignal_id' => $onesignal_id,
            ':device_type' => $device_type,
            ':os' => $os,
            ':browser' => $browser,
            ':ip_address' => $ip_address,
            ':user_agent' => $user_agent
        ]);
        echo "Saved Successfully";
    } else {
        echo "Already Exists";
    }
} else {
    echo "No ID Provided";
}
?>
