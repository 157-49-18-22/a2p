<?php
$umessage = '';
include('./function/function.php');
check_session();

$pdo = getPDOObject();

// Create table if not exists
$pdo->exec("CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Handle Form Submission
if (isset($_POST['send_notif'])) {
    extract($_POST);
    
    // 1. Save to Database
    $q = $pdo->prepare("INSERT INTO notifications (title, message, link) VALUES (:title, :message, :link)");
    $q->execute(array(
        ':title' => $title,
        ':message' => $message,
        ':link' => $link
    ));
    
    // 2. Send Native Push Notification via OneSignal
    $app_id = "d672c804-fe64-41c5-b321-44e92cf74cc9"; 
    $rest_api_key = "os_v2_app_2zzmqbh6mra4lmzbitusz52mzgns5dpyvwru5u45emdcaf7e34cuoncvcvxhbaxtl74p7ux767dj52nej3kmesajs36wiobb6kwtk7q";
    
    $content = array("en" => $message);
    $headings = array("en" => $title);
    
    $fields = array(
        'app_id' => $app_id,
        'target_channel' => 'push',
        'included_segments' => array('Subscribed Users'),
        'contents' => $content,
        'headings' => $headings,
        'url' => $link
    );
    
    $fields_json = json_encode($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.onesignal.com/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Key ' . trim($rest_api_key)
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_json);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    $res_json = json_decode($response, true);
    curl_close($ch);
    
    if ($q->rowCount()) {
        if (isset($res_json['id'])) {
            $umessage = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Notification sent to Website & All Devices.</div>';
        } else {
            $err_msg = isset($res_json['errors'][0]) ? $res_json['errors'][0] : 'Push failed';
            // Debug: Show full response
            $umessage = '<div class="alert alert-warning" role="alert">Website Saved, but Device Push Failed: ' . $err_msg . '<br><small>OneSignal Response: ' . htmlspecialchars($response) . '</small></div>';
        }
    } else {
        $umessage = '<div class="alert alert-danger" role="alert">Failed to save notification.</div>';
    }
}

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $pdo->query("DELETE FROM notifications WHERE id='$id'");
    echo "<script>window.location.href='notifications.php';</script>";
}

require('include/header.php');
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Push Notifications</h4>

        <?php echo $umessage; ?>

        <!-- Send Notification Form -->
        <div class="card mb-4">
            <h5 class="card-header">Create New Notification</h5>
            <div class="card-body">
                <form action="notifications.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Notification Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. New Property Launch!" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Target Link (Optional)</label>
                            <input type="text" name="link" class="form-control" placeholder="http://a2prealtech.com/property.php">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Message Content</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Enter your message here..." required></textarea>
                        </div>
                    </div>
                    <button type="submit" name="send_notif" class="btn btn-primary">Send Notification</button>
                </form>
            </div>
        </div>

        <!-- Notification History -->
        <div class="card">
            <h5 class="card-header">Notification History</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $notifs = sqlfetch("SELECT * FROM notifications ORDER BY id DESC");
                        foreach ($notifs as $n) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><strong><?php echo $n['title']; ?></strong></td>
                                <td><?php echo $n['message']; ?></td>
                                <td><?php echo date('d M, Y h:i A', strtotime($n['created_at'])); ?></td>
                                <td>
                                    <a href="notifications.php?id=<?php echo $n['id']; ?>&action=delete" 
                                       onclick="return confirm('Delete this notification?')" 
                                       class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($notifs)) { echo "<tr><td colspan='5' class='text-center'>No notifications found.</td></tr>"; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require('include/footer.php'); ?>
