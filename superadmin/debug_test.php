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
    
    $stmt = $pdo->query("DESCRIBE admin");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<p>Admin Table Columns: " . implode(", ", array_column($columns, 'Field')) . "</p>";
    
    $stmt2 = $pdo->query("SELECT * FROM admin LIMIT 1");
    $admins = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    echo "<p>Admin records: " . count($admins) . "</p>";
    if(count($admins)) {
        echo "<p>Admin username: " . $admins[0]['username'] . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red'>✗ DB Error: " . $e->getMessage() . "</p>";
}

echo "<p>Testing header.php include directly...</p>";
include('include/header.php');
