<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Superadmin Debug</h2>";

echo "<p>Testing function.php include...</p>";
include('./function/function.php');
echo "<p style='color:green'>✓ function.php loaded. siteTitle=" . $siteTitle . "</p>";

echo "<p>Testing DB connection...</p>";
try {
    $pdo = getPDOObject();
    echo "<p style='color:green'>✓ DB connected OK</p>";
    
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p>Tables: " . implode(", ", $tables) . "</p>";
    
    $stmt2 = $pdo->query("SELECT * FROM admin LIMIT 1");
    $admins = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    echo "<p>Admin records: " . count($admins) . "</p>";
    if(count($admins)) {
        echo "<p>Admin username: " . $admins[0]['username'] . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red'>✗ DB Error: " . $e->getMessage() . "</p>";
}

echo "<p>Testing header.php include...</p>";
$no_visible_elements = true;
ob_start();
include('include/header.php');
$headerOutput = ob_get_clean();
if(!empty($headerOutput)) {
    echo "<p style='color:green'>✓ header.php loaded OK (" . strlen($headerOutput) . " bytes)</p>";
} else {
    echo "<p style='color:red'>✗ header.php returned EMPTY output</p>";
}
echo "<pre>First 300 chars of header: " . htmlspecialchars(substr($headerOutput, 0, 300)) . "</pre>";
