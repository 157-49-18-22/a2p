<?php
include('function/function.php');

$pdo = getPDOObject();

// Create table if not exists
$pdo->exec("CREATE TABLE IF NOT EXISTS subscriber_devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    onesignal_id VARCHAR(100) UNIQUE,
    device_type VARCHAR(50),
    browser VARCHAR(50),
    os VARCHAR(50),
    device_model VARCHAR(100),
    user_agent TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['onesignal_id'])) {
        $onesignal_id = $data['onesignal_id'];
        $device_type = isset($data['device_type']) ? $data['device_type'] : 'unknown';
        $browser = isset($data['browser']) ? $data['browser'] : 'unknown';
        $os = isset($data['os']) ? $data['os'] : 'unknown';
        $device_model = isset($data['device_model']) ? $data['device_model'] : 'unknown';
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $q = $pdo->prepare("INSERT INTO subscriber_devices 
            (onesignal_id, device_type, browser, os, device_model, user_agent, ip_address) 
            VALUES (:onesignal_id, :device_type, :browser, :os, :device_model, :user_agent, :ip_address)
            ON DUPLICATE KEY UPDATE 
            device_type = VALUES(device_type),
            browser = VALUES(browser),
            os = VALUES(os),
            device_model = VALUES(device_model),
            user_agent = VALUES(user_agent),
            ip_address = VALUES(ip_address)");
            
        $q->execute(array(
            ':onesignal_id' => $onesignal_id,
            ':device_type' => $device_type,
            ':browser' => $browser,
            ':os' => $os,
            ':device_model' => $device_model,
            ':user_agent' => $user_agent,
            ':ip_address' => $ip_address
        ));
        
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing ID']);
    }
}
?>
