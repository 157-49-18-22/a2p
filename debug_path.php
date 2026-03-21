<?php
// TEMPORARY DEBUG FILE - DELETE AFTER USE
echo "<pre>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "__DIR__: " . __DIR__ . "\n";
echo "dirname(__FILE__): " . dirname(__FILE__) . "\n";
echo "\nFiles in __DIR__/upload/ :\n";
$upload = __DIR__ . '/upload/';
if (is_dir($upload)) {
    $files = scandir($upload);
    foreach ($files as $f) {
        if ($f !== '.' && $f !== '..') echo "  - $f\n";
    }
} else {
    echo "  !! /upload/ folder NOT found at " . $upload . "\n";
}
echo "\nFiles in DOCUMENT_ROOT/upload/ :\n";
$upload2 = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/upload/';
if (is_dir($upload2)) {
    $files2 = scandir($upload2);
    foreach ($files2 as $f) {
        if ($f !== '.' && $f !== '..') echo "  - $f\n";
    }
} else {
    echo "  !! /upload/ folder NOT found at " . $upload2 . "\n";
}
echo "</pre>";
?>
