<?php
include "function/function.php";
$tables = sqlfetch("SHOW TABLES");
foreach($tables as $table) {
    echo array_values($table)[0] . "\n";
}
?>
