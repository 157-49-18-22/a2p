<?php
include "function/function.php";
$result = sqlfetch("select * from offer ORDER BY id DESC LIMIT 0,3");
foreach ($result as $row) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Name: " . $row['name'] . "<br>";
    echo "Photo: [" . $row['photo'] . "]<br>";
    echo "Full Path: " . SITE_URL . "upload/" . $row['photo'] . "<br>";
    echo "File Exists: " . (file_exists("upload/" . $row['photo']) ? "Yes" : "No") . "<br><br>";
}
?>
