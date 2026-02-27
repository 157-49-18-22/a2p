<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Config Debug</h2>";
try {
    include __DIR__ . '/config.php';
    echo "<p style='color:green'>✓ config.php loaded OK</p>";
    echo "<p>siteTitle: " . $siteTitle . "</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Error: " . $e->getMessage() . "</p>";
}
echo "<h2>Session Debug</h2>";
session_start();
echo "<p>Session ID: " . session_id() . "</p>";
echo "<p>admin_id: " . ($_SESSION['admin_id'] ?? 'Not set') . "</p>";
