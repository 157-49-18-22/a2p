<?php
// Ensure no errors are output before JSON
error_reporting(0);
ini_set('display_errors', 0);

require_once('./function/function.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';
$response = [];

try {
    if ($action == 'get_locations') {
        // Check if city column exists to avoid Fatal Error
        $check = sqlfetch("SHOW COLUMNS FROM subproduct LIKE 'city'");
        if (count($check) > 0) {
            $data = sqlfetch("SELECT DISTINCT city FROM subproduct WHERE actstat=1 AND city != '' ORDER BY city ASC");
            foreach($data as $row) {
                $response[] = ['location' => $row['city']];
            }
        }
    } 
    
    else if ($action == 'get_categories') {
        $city = $_GET['city'] ?? '';
        $response = sqlfetch("SELECT DISTINCT c.id, c.name FROM subproduct s JOIN category c ON s.subcat2 = c.id WHERE s.city = '$city' AND s.actstat=1 ORDER BY c.name ASC");
    } 
    
    else if ($action == 'get_property_types') {
        $city = $_GET['city'] ?? '';
        $cat_id = $_GET['category_id'] ?? '';
        $response = sqlfetch("SELECT DISTINCT sc.id, sc.name as property_type FROM subproduct s JOIN subcategory sc ON s.subcat = sc.id WHERE s.city = '$city' AND s.subcat2 = '$cat_id' AND s.actstat=1 ORDER BY sc.name ASC");
    } 
    
    else if ($action == 'get_developers') {
        $city = $_GET['city'] ?? '';
        $cat_id = $_GET['category_id'] ?? '';
        $subcat_id = $_GET['subcategory_id'] ?? '';
        $response = sqlfetch("SELECT DISTINCT developer FROM subproduct WHERE city = '$city' AND subcat2 = '$cat_id' AND subcat = '$subcat_id' AND actstat = 1 AND developer != '' ORDER BY developer ASC");
    }

} catch (Throwable $e) {
    // Catch Fatal Errors in PHP 7+
} catch (Exception $e) {
    // Catch normal exceptions
}

// Clean any buffer and send JSON
if (ob_get_length()) ob_clean();
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
