<?php
include('function/function.php');
header('Content-Type: text/plain');

$jsonPath = 'firebase-service-account.json';
if (!file_exists($jsonPath)) {
    die("ERROR: firebase-service-account.json not found in superadmin folder!");
}

$jsonRaw = file_get_contents($jsonPath);
$json = json_decode($jsonRaw, true);

if (!$json) {
    die("ERROR: JSON is invalid! Check for extra spaces or missing commas.");
}

$privateKey = $json['private_key'];
echo "1. JSON Read: SUCCESS\n";
echo "2. Project ID: " . $json['project_id'] . "\n";
echo "3. Client Email: " . $json['client_email'] . "\n";

// Normalized key for testing
$cleanKey = str_replace(['\n', '\\n'], "\n", $privateKey);
$res = openssl_pkey_get_private($cleanKey);

if ($res) {
    echo "4. OpenSSL Key Load: SUCCESS ✅\n";
} else {
    echo "4. OpenSSL Key Load: FAILED ❌\n";
    echo "   Error: " . openssl_error_string() . "\n";
    echo "   Key Start: " . substr(trim($privateKey), 0, 30) . "...\n";
    echo "   Key End: ..." . substr(trim($privateKey), -30) . "\n";
}

echo "5. Server Time: " . date('Y-m-d H:i:s') . "\n";
echo "6. PHP Version: " . PHP_VERSION . "\n";

// Standard JWT Test
$header = base64_encode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
$payload = base64_encode(json_encode(['iss'=>'test', 'aud'=>'test', 'iat'=>time(), 'exp'=>time()+3600]));
$sig = '';
if (openssl_sign("$header.$payload", $sig, $cleanKey, 'SHA256')) {
    echo "7. JWT Signing Test: SUCCESS ✅\n";
} else {
    echo "7. JWT Signing Test: FAILED ❌ (" . openssl_error_string() . ")\n";
}
?>
