<?php
include('./function/function.php');
$pdo = getPDOObject();
try {
    $pdo->exec("ALTER TABLE subproduct ADD COLUMN developer VARCHAR(255) DEFAULT '' AFTER pro_lable");
} catch (Exception $e) {
    // Column might already exist
}
echo "Column checked/added";
?>
