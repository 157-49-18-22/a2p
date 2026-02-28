<?php
$umessage = '';
include('./function/function.php');
check_session();

$pdo = getPDOObject();

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $pdo->query("DELETE FROM subscriber_devices WHERE id='$id'");
    echo "<script>window.location.href='subscribers.php';</script>";
}

require('include/header.php');
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Subscribed Devices</h4>

        <div class="card">
            <h5 class="card-header">Managed Devices for Push Notifications</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Device Type</th>
                            <th>OS / Browser</th>
                            <th>Model</th>
                            <th>Date Subscribed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $devices = sqlfetch("SELECT * FROM subscriber_devices ORDER BY id DESC");
                        foreach ($devices as $d) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td>
                                    <?php if($d['device_type'] == 'Mobile') { ?>
                                        <span class="badge bg-info"><i class="fa fa-mobile-screen"></i> Mobile</span>
                                    <?php } else { ?>
                                        <span class="badge bg-primary"><i class="fa fa-laptop"></i> Desktop</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <strong><?php echo $d['os']; ?></strong> / <?php echo $d['browser']; ?>
                                </td>
                                <td><code><?php echo $d['device_model']; ?></code></td>
                                <td><?php echo date('d M, Y', strtotime($d['created_at'])); ?></td>
                                <td>
                                    <a href="subscribers.php?id=<?php echo $d['id']; ?>&action=delete" 
                                       onclick="return confirm('Remove this device?')" 
                                       class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($devices)) { echo "<tr><td colspan='6' class='text-center'>No devices found.</td></tr>"; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require('include/footer.php'); ?>
