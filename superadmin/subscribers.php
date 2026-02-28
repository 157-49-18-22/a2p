<?php
include('./function/function.php');
check_session();
$pdo = getPDOObject();

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $pdo->query("DELETE FROM notification_subscribers WHERE id='$id'");
    header("Location: subscribers.php");
}

require('include/header.php');
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Push Notification Subscribers</h4>

        <div class="card">
            <h5 class="card-header">Device List (Push Subscribers)</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Device Type</th>
                            <th>OS / Browser</th>
                            <th>IP Address</th>
                            <th>Subscribed On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $subs = sqlfetch("SELECT * FROM notification_subscribers ORDER BY id DESC");
                        foreach ($subs as $s) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td>
                                    <span class="badge bg-label-<?php echo ($s['device_type'] == 'Mobile' ? 'primary' : 'success'); ?>">
                                        <i class="mdi mdi-<?php echo ($s['device_type'] == 'Mobile' ? 'cellphone' : 'laptop'); ?> me-1"></i>
                                        <?php echo $s['device_type']; ?>
                                    </span>
                                </td>
                                <td>
                                    <strong><?php echo $s['os']; ?></strong><br>
                                    <small class="text-muted"><?php echo $s['browser']; ?></small>
                                </td>
                                <td><?php echo $s['ip_address']; ?></td>
                                <td><?php echo date('d M, Y h:i A', strtotime($s['created_at'])); ?></td>
                                <td>
                                    <a href="subscribers.php?id=<?php echo $s['id']; ?>&action=delete" 
                                       onclick="return confirm('Remove this subscriber?')" 
                                       class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($subs)) { echo "<tr><td colspan='6' class='text-center'>No subscribers found yet.</td></tr>"; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require('include/footer.php'); ?>
