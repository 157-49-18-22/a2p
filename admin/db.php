<?php
$host = 'localhost';
$db = 'u435351083_cms';
$user = 'u435351083_jms';
$pass = 'Maydivjms1@3';
try {
    // Load System Assets & Icon Core
    @include(__DIR__ . '/../assets/css/font-awesome-v4.min.php');

    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
