<?php
$umessage = '';
include('./function/function.php');
check_session();

function handleFileUpload($prevphoto = '')
{
    $Filename = $prevphoto; // default to previous photo if editing
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "../upload/";

            // Ensure folder exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            // Sanitize filename
            $originalName = basename($_FILES['photo']['name']);
            $safeName = preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $originalName);

            // Add timestamp
            $Filename = date('YmdHis') . "_" . $safeName;
            $target = $uploadDir . $Filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
                // Delete old photo if editing
                if ($prevphoto && file_exists($uploadDir . $prevphoto)) {
                    @unlink($uploadDir . $prevphoto);
                }
            } else {
                die("Error: Could not move uploaded file. Check folder permissions.");
            }
        } else {
            die("Upload failed with error code: " . $_FILES['photo']['error']);
        }
    }
    return $Filename;
}

// Function to process form data and insert into database
if (isset($_POST['addclient'])) {
    $id = 0;
    extract($_POST);
    $pdo = getPDOObject();

    // Check if the offer already exists
    $sql = $pdo->prepare("SELECT * FROM `offer` WHERE name LIKE :name");
    $sql->execute([':name' => $name]);
    $num = $sql->rowCount();

    if (!$num) {
        $Filename = handleFileUpload();

        // Insert data into database
        $q = $pdo->prepare("INSERT INTO `offer` 
            (id, name, photo, des, des1, meta_title, meta_keyword, meta_description, by_blog, fld_order, actstat) 
            VALUES (:id,:name, :photo,:des,:des1,:meta_title,:meta_keyword,:meta_description, :by_blog, :fld_order, :actstat)");
        $q->execute([
            ':id' => $id,
            ':name' => $name,
            ':photo' => $Filename,
            ':des' => $des,
            ':des1' => $des1,
            ':meta_title' => $meta_title,
            ':meta_keyword' => $meta_keyword,
            ':meta_description' => $meta_description,
            ':by_blog' => $by_blog,
            ':fld_order' => $fld_order,
            ':actstat' => $actstat
        ]);

        $affected_rows = $q->rowCount();
        if ($affected_rows)
            $umessage = '<div class="alert alert-success" role="alert">
                            <strong></strong> Added Successfully
                       </div>';
    } else {
        $umessage = '<div class="alert alert-danger" role="alert">Duplicate Entry!!! Code Already Exists </div>';
    }
}

// Deleting a single item
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $pdo = getPDOObject();
    $id = $_GET['id'];

    // Delete image file
    $img = sqlfetch("SELECT photo FROM offer WHERE id='$id' LIMIT 1");
    if ($img && file_exists("../upload/" . $img[0]['photo'])) {
        @unlink("../upload/" . $img[0]['photo']);
    }

    $q = $pdo->prepare("DELETE FROM offer WHERE id = :id");
    $q->execute([':id' => $id]);
    echo "<script>window.open('offer.php','_self')</script>";
}

// Deleting multiple items
if (isset($_POST['deleteall'])) {
    $arr = $_POST['ids'];
    if (count($arr)) {
        $str_rest_refs = implode(",", $arr);
        $data = sqlfetch("SELECT * FROM `offer` WHERE id IN ($str_rest_refs)");
        foreach ($data as $client) {
            $img_path = '../upload/' . $client['photo'];
            if (file_exists($img_path)) {
                @unlink($img_path);
            }
        }
        $pdo = getPDOObject();
        $q = $pdo->query("DELETE FROM `offer` WHERE id IN ($str_rest_refs)");
        if ($q)
            $umessage = '<div class="alert alert-success" role="alert">
                            <strong></strong> Deleted Successfully
                       </div>';
    } else {
        $umessage = '<div class="alert alert-danger" role="alert">
                            <strong></strong> Please Select Items to perform this action
                       </div>';
    }
}

// Activating multiple items
if (isset($_POST['activate'])) {
    $arr = $_POST['ids'];
    if (count($arr)) {
        $str_rest_refs = implode(",", $arr);
        $pdo = getPDOObject();
        $q = $pdo->query("UPDATE `offer` SET actstat='1' WHERE id IN ($str_rest_refs)");
        if ($q)
            $umessage = '<div class="alert alert-success" role="alert">
                            <strong></strong> Activated Successfully
                       </div>';
    }
}

// Deactivating multiple items
if (isset($_POST['deactivate'])) {
    $arr = $_POST['ids'];
    if (count($arr)) {
        $str_rest_refs = implode(",", $arr);
        $pdo = getPDOObject();
        $q = $pdo->query("UPDATE `offer` SET actstat='0' WHERE id IN ($str_rest_refs)");
        if ($q)
            $umessage = '<div class="alert alert-success" role="alert">
                            <strong></strong> Deactivated Successfully
                       </div>';
    }
}

// Processing edited data
if (isset($_POST['editdone'])) {
    extract($_POST);

    $Filename = handleFileUpload($prevphoto);

    $pdo = getPDOObject();
    $q = $pdo->prepare("UPDATE `offer` SET 
            name=?,
            photo=?,
            des=?,
            des1=?,
            meta_title=?,
            meta_keyword=?,
            meta_description=?,
            by_blog=?,
            fld_order=?,
            actstat=?
            WHERE id=?");
    $q->execute([$name, $Filename, $des, $des1, $meta_title, $meta_keyword, $meta_description, $by_blog, $fld_order, $actstat, $pid]);

    $affected_rows = $q->rowCount();
    if ($affected_rows)
        $umessage = '<div class="alert alert-primary alert-dismissible" role="alert">
                       Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

// Function to display client form
function client_form($pid = '0', $name = '', $photo = '', $des = '', $des1 = '', $meta_title = '', $meta_keyword = '', $meta_description = '',   $by_blog = '',   $fld_order = '0', $actstat = '', $formname = 'addclient')
{ ?>
    <form action="offer.php" method="post" enctype="multipart/form-data">
        <div class="form theme-form">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
            <input type="hidden" name="prevphoto" value="<?php echo $photo; ?>" />
            <div class="row">

                <div class="col-lg-4  mt-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name" value="<?php echo $name; ?>" />
                            <label for="basic-addon11">Name </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" aria-label="Meta Title" value="<?php echo $meta_title; ?>" />
                            <label for="basic-addon11">Meta Title</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" aria-label="Meta Keyword" value="<?php echo $meta_keyword; ?>" />
                            <label for="basic-addon11">Meta Keyword</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="meta_description" placeholder="Meta Description" aria-label="Meta Description" value="<?php echo $meta_description; ?>" />
                            <label for="basic-addon11">Meta Description</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-3">

                    <div class="input-group input-group-merge">

                        <span class="input-group-text">@</span>

                        <div class="form-floating form-floating-outline">
                            <input type="file" class="form-control" name="photo" aria-label="Upload" value="<?php echo $photo; ?>">
                            <label for="basic-addon11">Add Photo</label>

                        </div>

                    </div>
                    <!-- <img src="../upload/<?php echo $photo; ?>" style=" border-radius: 12px;width: 39px;height: 35px;"> -->
                </div>

                <div class="col-lg-4  mt-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="des1" placeholder="Name" aria-label="Name" value="<?php echo $des1; ?>" />
                            <label for="basic-addon11">Additinol Text</label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4  mt-3">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="actstat" id="selectError" data-rel="chosen">
                            <option <?php if (($actstat) == '1') echo 'selected'; ?> value="1">Active</option>
                            <option <?php if (($actstat) == '0') echo 'selected'; ?> value="0">Inactive</option>
                        </select>
                        <label for="floatingSelect">Status</label>
                    </div>
                </div>
                
                  <div class="col-lg-4 mt-3">
                    <div class="form-floating form-floating-outline">
                       <select class="form-select" name="by_blog" id="selectError" data-rel="chosen">
                            <option <?php if (($by_blog) == '0') echo 'selected'; ?> value="0">Select Here</option>
                            <option <?php if (($by_blog) == 'By Admin') echo 'selected'; ?> value="By Admin">By Admin</option>
                        
                            <?php
                            $categories = sqlfetch("SELECT * FROM `subadmin`");
                        
                            foreach ($categories as $subadmin) {
                                $select = ($by_blog == $subadmin['name']) ? 'selected' : '';
                                echo '<option ' . $select . ' value="' . htmlspecialchars($subadmin['name']) . '">' . 
                                    htmlspecialchars($subadmin['name']) . '</option>';
                            }
                            ?>
                        </select>

                        <label for="selectError">Select Author</label>
                    </div>
                </div>

                  
                
                <div class="col-lg-4 mt-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="number" class="form-control" placeholder="Sort Order" aria-label="Description" name="fld_order" value="<?php echo $fld_order; ?>" />
                            <label for="basic-addon11">Sort Order</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12  mt-3">
                    <div class="input-group input-group-merge">

                        <div class="form-floating form-floating-outline">
                            <label for="basic-addon11">Description Text</label>
                            <br><br>
                            <textarea class="page_data editor"  name="des" cols="60" rows="10"><?php echo $des; ?></textarea>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12  mt-5">
                    <div class="input-group input-group-merge">
                        <button class="btn btn-primary waves-effect  waves-light" type="submit" value="Submit" name="<?php echo $formname; ?>">
                            <span class=" align-middle">Submit</span>
                        </button>
                    </div>
                </div>

            </div>



        </div>
    </form>
<?php
}
?>


<?php require('include/header.php'); ?>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Home/</span>Banner Settings</h4>


        <?php echo $umessage; ?>


        <?php
        if (isset($_GET['edit']) and ($_GET['edit'] == 'true')) { ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Manage Here</h5>
                        <div class="card-body demo-vertical-spacing demo-only-element z4">
                            <div class="row">
                                <?php
                                $pid = $_GET['pid'];
                                $productdata = sqlfetch("SELECT * FROM `offer` where id='$pid' ");
                                foreach ($productdata as $product) {
                                    extract($product);
                                    client_form($pid, $name, $photo, $des, $des1, $meta_title, $meta_keyword, $meta_description, $by_blog, $fld_order, $actstat, $formname = 'editdone');
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php
        } else {
        ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Manage Here</h5>
                        <div class="card-body demo-vertical-spacing demo-only-element z4">
                            <div class="row">
                                <?php client_form(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>









            <div class="card">
                <div class="card-datatable dataTable_select text-nowrap table-responsive">
                    <table id="tableID" class="display dt-select-table table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                            <tr>
                                <th>S. No.</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delet</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count = 1;
                                $data = sqlfetch("SELECT * FROM `offer` ORDER BY id DESC");
                                
                                foreach ($data as $menu) { ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $menu['name']; ?></td>
                                        <td><img style="height: 32px;width: 32px;" src="../upload/<?php echo $menu['photo']; ?>" class="img-responsive"></td>
                                        <td><?php echo $menu['fld_order']; ?></td>
                                        <td> <?php echo get_active_status_text($menu['actstat']); ?></td>
                                        <td>
                                            <a class="ajax-link" href="offer.php?&pid=<?php echo $menu['id']; ?>&edit=true">
                                                <button type="button" class="btn btn-xs btn-danger pull-right" name="editclient"><i class="fa fa-pencil"></i> </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="offer.php?id=<?php echo $menu['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete this item?');">
                                                <button type="submit" class="btn btn-xs btn-danger pull-right" style="margin:0px 10px;" name="delete"><i class="fa-solid fa-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>










        <?php } ?>


        <?php require('include/footer.php'); ?>