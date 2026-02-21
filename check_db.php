<?php
include('./function/function.php');
try {
    $pdo = getPDOObject();
    $q = $pdo->query("DESCRIBE subproduct");
    echo "<pre>";
    print_r($q->fetchAll(PDO::FETCH_ASSOC));
    echo "</pre>";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
