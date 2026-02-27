<?php
include "function/function.php";
$tables = sqlfetch("SHOW TABLES");
print_r($tables);
?>
