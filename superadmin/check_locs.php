<?php
include('./function/function.php');
$locations = sqlfetch("SELECT DISTINCT pro_lable FROM subproduct WHERE pro_lable != ''");
echo json_encode($locations);
?>
