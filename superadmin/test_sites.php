<?php
include('./function/function.php');
$sites = sqlfetch("SELECT id, name, pro_lable FROM subproduct WHERE pro_lable LIKE '%Gurugram%' LIMIT 10");
print_r($sites);
?>
