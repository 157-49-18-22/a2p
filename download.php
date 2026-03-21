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

// Try multiple possible paths (handles different hosting structures)
$possible_paths = [
    __DIR__ . '/upload/' . $filename,                                      // Same directory
    dirname(__FILE__) . '/upload/' . $filename,                            // Explicit dirname
    $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $filename,                    // Document root /upload/
    rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/upload/' . $filename,        // No trailing slash
];

$file_path = null;
foreach ($possible_paths as $path) {
    if (file_exists($path) && is_readable($path)) {
        $file_path = $path;
        break;
    }
}

if (!$file_path) {
    http_response_code(404);
    exit('Brochure file not found. Please contact us at team@a2prealtech.com');
}

// Force download headers
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file_path));

// Clear output buffers to avoid corruption
if (ob_get_level()) {
    ob_end_clean();
}

readfile($file_path);
exit;
