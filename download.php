<?php
/**
 * download.php – Force-downloads a brochure PDF from the /upload folder.
 * Usage: download.php?file=filename.pdf
 */

// Only allow simple filenames – no path traversal (../), no slashes
$file_param = isset($_GET['file']) ? $_GET['file'] : '';
$filename   = basename($file_param); // strips any path component

// Whitelist: only allow pdf files
if (empty($filename) || !preg_match('/\.pdf$/i', $filename)) {
    http_response_code(400);
    exit('Invalid file request.');
}

$file_path = __DIR__ . '/upload/' . $filename;

if (!file_exists($file_path)) {
    http_response_code(404);
    exit('Brochure file not found. Please contact us.');
}

// Force download headers
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file_path));

// Clear output buffers to avoid corruption
ob_clean();
flush();

readfile($file_path);
exit;
