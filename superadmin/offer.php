<?php
$umessage = '';
include('./function/function.php');
include('./function/push_helper.php');
check_session();

// Auto-create offer_images table if not exists
try {
    $pdo_init = getPDOObject();
    $pdo_init->exec("CREATE TABLE IF NOT EXISTS offer_images (
        id INT NOT NULL AUTO_INCREMENT,
        offer_id INT NOT NULL DEFAULT 0,
        photo VARCHAR(255) NOT NULL DEFAULT '',
        title VARCHAR(255) DEFAULT '',
        caption TEXT,
        fld_order INT DEFAULT 0,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
} catch (Exception $e) {
    // silent
}

try {
    $pdo = getPDOObject();
    $pdo->exec("ALTER TABLE offer ADD COLUMN related_blogs TEXT NULL");
} catch (Exception $e) {}

try {
    $pdo = getPDOObject();
    $pdo->exec("ALTER TABLE offer ADD COLUMN related_products TEXT NULL");
} catch (Exception $e) {}

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

function save_extra_images_func($offer_id) {
    if (!$offer_id) return;
    $pdo = getPDOObject();

    // First, let's check if the table exists just in case
    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS offer_images (
            id INT NOT NULL AUTO_INCREMENT,
            offer_id INT NOT NULL DEFAULT 0,
            photo VARCHAR(255) NOT NULL DEFAULT '',
            title VARCHAR(255) DEFAULT '',
            caption TEXT,
            fld_order INT DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    } catch(Exception $e) {}

    $uploadDir = "../upload/";
    if (!is_dir($uploadDir)) {
        @mkdir($uploadDir, 0775, true);
    }

    $extra_titles   = $_POST['extra_title'] ?? [];
    $extra_captions = $_POST['extra_caption'] ?? [];
    $extra_orders   = $_POST['extra_order'] ?? [];
    $existing_imgs  = $_POST['existing_extra_photo'] ?? [];

    $files = $_FILES['extra_photos'] ?? null;

    // IMPORTANT: Clear existing ones only if we are about to save something or if updating
    // For simplicity, we delete and re-insert the list
    $del = $pdo->prepare("DELETE FROM offer_images WHERE offer_id = ?");
    $del->execute([$offer_id]);

    if (is_array($extra_titles)) {
        foreach ($extra_titles as $i => $title) {
            $fname = '';
            
            // Check if a new file was uploaded for this specific row index
            if (isset($files['name'][$i]) && $files['error'][$i] === UPLOAD_ERR_OK) {
                $origName = basename($files['name'][$i]);
                $safeName = preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $origName);
                $fname = date('YmdHis') . "_" . uniqid() . "_" . $safeName;
                $target = $uploadDir . $fname;
                move_uploaded_file($files['tmp_name'][$i], $target);
            } 
            // Otherwise use existing photo if available for this row
            elseif (!empty($existing_imgs[$i])) {
                $fname = $existing_imgs[$i];
            }

            // Only insert if we actually have a photo filename
            if ($fname) {
                $status = $pdo->prepare("INSERT INTO offer_images (offer_id, photo, title, caption, fld_order) VALUES (?, ?, ?, ?, ?)")
                             ->execute([
                                 $offer_id,
                                 $fname,
                                 $title,
                                 $extra_captions[$i] ?? '',
                                 $extra_orders[$i] ?? 0
                             ]);
            }
        }
    }
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

        if (isset($related_blogs) && is_array($related_blogs)) {
            $related_blogs_str = implode(',', $related_blogs);
        } else {
            $related_blogs_str = '';
        }

        if (isset($related_products) && is_array($related_products)) {
            $related_products_str = implode(',', $related_products);
        } else {
            $related_products_str = '';
        }

        // Insert data into database
        $q = $pdo->prepare("INSERT INTO `offer` 
            (id, name, photo, des, des1, meta_title, meta_keyword, meta_description, by_blog, related_blogs, related_products, fld_order, actstat) 
            VALUES (:id,:name, :photo,:des,:des1,:meta_title,:meta_keyword,:meta_description, :by_blog, :related_blogs, :related_products, :fld_order, :actstat)");
        $q->execute([
            ':id'               => $id,
            ':name'             => $name,
            ':photo'            => $Filename,
            ':des'              => $des,
            ':des1'             => $des1,
            ':meta_title'       => $meta_title,
            ':meta_keyword'     => $meta_keyword,
            ':meta_description' => $meta_description,
            ':by_blog'          => $by_blog,
            ':related_blogs'    => $related_blogs_str,
            ':related_products' => $related_products_str,
            ':fld_order'        => $fld_order,
            ':actstat'          => $actstat
        ]);

        $affected_rows = $q->rowCount();
        if ($affected_rows) {
            $last_id = $pdo->lastInsertId();
            save_extra_images_func($last_id);
            $umessage = '<div class="alert alert-success" role="alert">
                            <strong></strong> Added Successfully
                       </div>';
            
            // Send Push Notification if checked
            if (isset($_POST['send_notif']) && $_POST['send_notif'] == '1') {
                $notif_title = !empty($_POST['notif_title']) ? $_POST['notif_title'] : "New Blog: " . $name;
                $notif_msg = !empty($_POST['notif_msg']) ? $_POST['notif_msg'] : "Check out our latest blog post!";
                $notif_custom_link = !empty($_POST['notif_link']) ? $_POST['notif_link'] : SITE_URL . "blog_detail.php?id=" . urlencode($name);

                $notif_img = $Filename ? SITE_URL . "upload/" . $Filename : '';
                sendGlobalPushNotification($notif_title, $notif_msg, $notif_custom_link, $notif_img);
            }
        }
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

    // Delete extra images
    $extra_imgs = sqlfetch("SELECT photo FROM offer_images WHERE offer_id='$id'");
    foreach ($extra_imgs as $ei) {
        if (file_exists("../upload/" . $ei['photo'])) {
            @unlink("../upload/" . $ei['photo']);
        }
    }
    $pdo->prepare("DELETE FROM offer_images WHERE offer_id=?")->execute([$id]);

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
        // Delete extra images too
        $extra_imgs = sqlfetch("SELECT photo FROM offer_images WHERE offer_id IN ($str_rest_refs)");
        foreach ($extra_imgs as $ei) {
            if (file_exists("../upload/" . $ei['photo'])) {
                @unlink("../upload/" . $ei['photo']);
            }
        }
        $pdo = getPDOObject();
        $pdo->query("DELETE FROM offer_images WHERE offer_id IN ($str_rest_refs)");
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

    if (isset($related_blogs) && is_array($related_blogs)) {
        $related_blogs_str = implode(',', $related_blogs);
    } else {
        $related_blogs_str = '';
    }

    if (isset($related_products) && is_array($related_products)) {
        $related_products_str = implode(',', $related_products);
    } else {
        $related_products_str = '';
    }

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
            related_blogs=?,
            related_products=?,
            fld_order=?,
            actstat=?
            WHERE id=?");
    $q->execute([$name, $Filename, $des, $des1, $meta_title, $meta_keyword, $meta_description, $by_blog, $related_blogs_str, $related_products_str, $fld_order, $actstat, $pid]);

    save_extra_images_func($pid);

    $affected_rows = $q->rowCount();
    if ($affected_rows) {
        save_extra_images_func($pid);
        $umessage = '<div class="alert alert-primary alert-dismissible" role="alert">
                       Updated Successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

        // Send Push Notification if checked
        if (isset($_POST['send_notif']) && $_POST['send_notif'] == '1') {
            $notif_title = !empty($_POST['notif_title']) ? $_POST['notif_title'] : "Updated Blog: " . $name;
            $notif_msg = !empty($_POST['notif_msg']) ? $_POST['notif_msg'] : "We've updated one of our blog posts. Read it now!";
            $notif_custom_link = !empty($_POST['notif_link']) ? $_POST['notif_link'] : SITE_URL . "blog_detail.php?id=" . urlencode($name);

            $notif_img = $Filename ? SITE_URL . "upload/" . $Filename : '';
            sendGlobalPushNotification($notif_title, $notif_msg, $notif_custom_link, $notif_img);
        }
    }
}

// Function to display client form
function client_form($pid = '0', $name = '', $photo = '', $des = '', $des1 = '', $meta_title = '', $meta_keyword = '', $meta_description = '',   $by_blog = '', $related_blogs = '', $related_products = '', $fld_order = '0', $actstat = '', $formname = 'addclient')
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

                <!-- Main Photo + Add More Photos side by side -->
                <div class="col-lg-8 mt-3">
                    <div class="d-flex align-items-start gap-3 flex-wrap">
                        <!-- Main Photo -->
                        <div class="input-group input-group-merge" style="max-width:320px;">
                            <span class="input-group-text">@</span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" class="form-control" name="photo" aria-label="Upload" accept="image/*">
                                <label>Add Photo</label>
                            </div>
                        </div>
                        <?php if ($photo): ?>
                        <div>
                            <img src="../upload/<?php echo $photo; ?>" style="height:50px;width:50px;border-radius:8px;object-fit:cover;" title="Current main photo">
                        </div>
                        <?php endif; ?>
                        <!-- Add More Photos Button -->
                        <div>
                            <button type="button" class="btn btn-outline-primary waves-effect" onclick="addMorePhoto()">
                                <i class="fa-solid fa-plus"></i> Add More Photos
                            </button>
                        </div>
                    </div>

                    <!-- Extra Photos Container -->
                    <div id="extra-photos-container" class="mt-3">
                        <?php
                        // If editing, load existing extra images
                        if ($pid != '0') {
                            $extra_imgs = sqlfetch("SELECT * FROM offer_images WHERE offer_id='$pid' ORDER BY fld_order ASC");
                            foreach ($extra_imgs as $idx => $ei) {
                                ?>
                                <div class="extra-photo-item card p-3 mb-2 border" style="background:#f8f9ff;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="text-primary">📷 Photo <?php echo $idx + 1; ?></strong>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeExtraPhoto(this)">
                                            <i class="fa-solid fa-trash"></i> Remove
                                        </button>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <div class="text-center mb-2">
                                                <img src="../upload/<?php echo $ei['photo']; ?>" style="height:80px;width:80px;object-fit:cover;border-radius:8px;">
                                            </div>
                                            <input type="file" class="form-control form-control-sm" name="extra_photos[]" accept="image/*">
                                            <input type="hidden" name="existing_extra_photo[]" value="<?php echo $ei['photo']; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating form-floating-outline mb-2">
                                                <input type="text" class="form-control form-control-sm" name="extra_title[]" 
                                                       placeholder="Title" value="<?php echo htmlspecialchars($ei['title']); ?>">
                                                <label>Title</label>
                                            </div>
                                            <div class="form-floating form-floating-outline">
                                                <textarea class="form-control form-control-sm" name="extra_caption[]" 
                                                          placeholder="Caption" rows="2"><?php echo htmlspecialchars($ei['caption']); ?></textarea>
                                                <label>Caption</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <input type="number" class="form-control form-control-sm" name="extra_order[]" 
                                                       placeholder="Order" value="<?php echo $ei['fld_order']; ?>">
                                                <label>Sort Order</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
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

                <div class="col-lg-12 mt-4">
                    <div class="card p-4 border shadow-none" style="background: #fffafa; border-radius: 12px; border: 1px dashed #666cff !important;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-bell-ring-outline text-primary fs-3 me-2"></i>
                                <div>
                                    <h6 class="mb-0 text-primary">Push Notification Alert</h6>
                                    <p class="mb-0 text-muted small">Notify all subscribers about this blog post</p>
                                </div>
                            </div>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input ms-0" type="checkbox" name="send_notif" id="sendNotifBlog" value="1" style="cursor: pointer; width: 3em; height: 1.5em; margin-top: 0;">
                            </div>
                        </div>

                        <!-- Extra Notification Fields -->
                        <div id="notifFields" style="display:none; border-top: 1px dashed #666cff44; padding-top: 20px; margin-top: 15px;">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control border-primary-subtle" name="notif_title" id="notif_title" placeholder="Notification Title">
                                        <label>Notification Title</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control border-primary-subtle" name="notif_link" id="notif_link" placeholder="Custom Link (Optional)">
                                        <label>Custom Link (Optional)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control border-primary-subtle" name="notif_msg" id="notif_msg" placeholder="Message Body" style="height: 80px"></textarea>
                                        <label>Notification Message / Body</label>
                                    </div>
                                </div>
                            </div>
                        </div>
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


                <div class="col-lg-12 mt-4">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h5 class="mb-0">Select Related Blogs</h5>
                            <div class="search-box">
                                <input type="text" id="blogSearch" class="form-control form-control-sm" placeholder="Search blogs..." style="width: 250px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="blogList">
                                <?php
                                $all_blogs = sqlfetch("SELECT id, name FROM `offer` WHERE actstat=1 ORDER BY name ASC");
                                $selected_blogs = explode(',', $related_blogs);
                                $item_count = 0;
                                foreach ($all_blogs as $blog) {
                                    // Don't show current blog in selection
                                    if($blog['id'] == $pid) continue;

                                    $is_checked = in_array($blog['id'], $selected_blogs) ? 'checked' : '';
                                    // Initially hide items after the first 10, unless they are checked
                                    $item_class = ($item_count < 10 || $is_checked) ? 'blog-item' : 'blog-item d-none-extra';
                                    ?>
                                    <div class="col-md-4 col-sm-6 mb-2 <?php echo $item_class; ?>" data-name="<?php echo strtolower(htmlspecialchars($blog['name'])); ?>">
                                        <div class="form-check">
                                            <input class="form-check-input blog-checkbox" type="checkbox" name="related_blogs[]" value="<?php echo $blog['id']; ?>" id="blog_<?php echo $blog['id']; ?>" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="blog_<?php echo $blog['id']; ?>">
                                                <?php echo htmlspecialchars($blog['name']); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    $item_count++;
                                }
                                ?>
                            </div>
                            <?php if ($item_count > 10): ?>
                            <div class="text-center mt-3" id="loadMoreContainer">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="btnLoadMore">Read More</button>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Related Products Section -->
                <div class="col-lg-12 mt-4">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h5 class="mb-0"><i class="mdi mdi-home-city-outline me-2 text-primary"></i>Select Related Products</h5>
                            <div class="search-box">
                                <input type="text" id="productSearch" class="form-control form-control-sm" placeholder="Search properties..." style="width: 250px;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="productList">
                                <?php
                                $all_products = sqlfetch("SELECT id, name FROM `subproduct` WHERE actstat=1 ORDER BY name ASC");
                                $selected_products = !empty($related_products) ? explode(',', $related_products) : [];
                                $prod_count = 0;
                                foreach ($all_products as $prod) {
                                    $is_checked = in_array($prod['id'], $selected_products) ? 'checked' : '';
                                    $item_class = ($prod_count < 10 || $is_checked) ? 'product-item' : 'product-item d-none-extra-prod';
                                    ?>
                                    <div class="col-md-4 col-sm-6 mb-2 <?php echo $item_class; ?>" data-name="<?php echo strtolower(htmlspecialchars($prod['name'])); ?>">
                                        <div class="form-check">
                                            <input class="form-check-input product-checkbox" type="checkbox" name="related_products[]" value="<?php echo $prod['id']; ?>" id="prod_<?php echo $prod['id']; ?>" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="prod_<?php echo $prod['id']; ?>">
                                                <?php echo htmlspecialchars($prod['name']); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    $prod_count++;
                                }
                                ?>
                            </div>
                            <?php if ($prod_count > 10): ?>
                            <div class="text-center mt-3" id="loadMoreProductsContainer">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="btnLoadMoreProducts">Load More</button>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <style>
                    .d-none-extra { display: none !important; }
                    .blog-item.filtered-out { display: none !important; }
                    .d-none-extra-prod { display: none !important; }
                    .product-item.filtered-out-prod { display: none !important; }
                </style>


                <div class="col-lg-12 mt-5">
                    <div class="input-group input-group-merge">
                        <button class="btn btn-primary waves-effect  waves-light" type="submit" value="Submit" name="<?php echo $formname; ?>">
                            <span class=" align-middle">Submit</span>
                        </button>
                    </div>
                </div>

            </div>



        </div>
    </form>

    <!-- Extra Photo Template (hidden, used by JS) -->
    <div id="extra-photo-template" style="display:none;">
        <div class="extra-photo-item card p-3 mb-2 border" style="background:#f8f9ff;">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong class="text-primary">📷 New Photo</strong>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeExtraPhoto(this)">
                    <i class="fa-solid fa-trash"></i> Remove
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="extra-preview-wrap text-center mb-2" style="display:none;">
                        <img class="extra-preview" style="height:80px;width:80px;object-fit:cover;border-radius:8px;">
                    </div>
                    <input type="file" class="form-control form-control-sm" name="extra_photos[]" accept="image/*" onchange="previewExtraPhoto(this)">
                    <input type="hidden" name="existing_extra_photo[]" value="">
                </div>
                <div class="col-md-4">
                    <div class="form-floating form-floating-outline mb-2">
                        <input type="text" class="form-control form-control-sm" name="extra_title[]" placeholder="Title" value="">
                        <label>Title</label>
                    </div>
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control form-control-sm" name="extra_caption[]" placeholder="Caption" rows="2"></textarea>
                        <label>Caption</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating form-floating-outline">
                        <input type="number" class="form-control form-control-sm" name="extra_order[]" placeholder="Order" value="0">
                        <label>Sort Order</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
function addMorePhoto() {
    var template = document.getElementById('extra-photo-template').innerHTML;
    var container = document.getElementById('extra-photos-container');
    var div = document.createElement('div');
    div.innerHTML = template;
    // Update photo number label
    var count = container.querySelectorAll('.extra-photo-item').length + 1;
    div.querySelector('strong').textContent = '📷 Photo ' + count;
    container.appendChild(div.firstElementChild);
}

function removeExtraPhoto(btn) {
    var item = btn.closest('.extra-photo-item');
    item.remove();
    // Re-number
    var items = document.querySelectorAll('#extra-photos-container .extra-photo-item strong');
    items.forEach(function(el, i) {
        el.textContent = '📷 Photo ' + (i + 1);
    });
}

function previewExtraPhoto(input) {
    var wrap = input.previousElementSibling;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            wrap.style.display = 'block';
            wrap.querySelector('img').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
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
                                    client_form($pid, $name, $photo, $des, $des1, $meta_title, $meta_keyword, $meta_description, $by_blog, $related_blogs, $related_products ?? '', $fld_order, $actstat, $formname = 'editdone');
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
                                <th>Extra Photos</th>
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
                                
                                foreach ($data as $menu) { 
                                    try {
                                        $extra_count = sqlfetch("SELECT COUNT(*) as cnt FROM offer_images WHERE offer_id='" . $menu['id'] . "'");
                                        $ec = $extra_count ? $extra_count[0]['cnt'] : 0;
                                    } catch (Exception $e) {
                                        $ec = 0;
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $menu['name']; ?></td>
                                        <td><img style="height: 32px;width: 32px;" src="../upload/<?php echo $menu['photo']; ?>" class="img-responsive"></td>
                                        <td>
                                            <?php if ($ec > 0): ?>
                                                <span class="badge bg-primary"><?php echo $ec; ?> photo(s)</span>
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
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


        <script>
            // --- Blog Selection Logic ---
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('blogSearch');
                const btnLoadMore = document.getElementById('btnLoadMore');
                const blogItems = document.querySelectorAll('.blog-item');
                let showingAll = false;

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const query = this.value.toLowerCase().trim();
                        blogItems.forEach(item => {
                            const name = item.getAttribute('data-name');
                            if (name.includes(query)) {
                                item.classList.remove('filtered-out');
                                // If searching, remove pagination restriction for matches
                                if(query !== "") {
                                    item.classList.remove('d-none-extra');
                                } else if(!showingAll) {
                                    // Reset to pagination if search is cleared
                                    const index = Array.from(blogItems).indexOf(item);
                                    const isChecked = item.querySelector('.blog-checkbox').checked;
                                    if(index >= 10 && !isChecked) {
                                        item.classList.add('d-none-extra');
                                    }
                                }
                            } else {
                                item.classList.add('filtered-out');
                            }
                        });
                        
                        // Hide Load More during search
                        if(btnLoadMore) {
                            btnLoadMore.parentElement.style.display = query === "" && !showingAll ? "block" : "none";
                        }
                    });
                }

                if (btnLoadMore) {
                    btnLoadMore.addEventListener('click', function() {
                        blogItems.forEach(item => {
                            item.classList.remove('d-none-extra');
                        });
                        this.parentElement.style.display = 'none';
                        showingAll = true;
                    });
                }

                // Push Notification Field Handling
                const sendNotifCheck = document.getElementById('sendNotifBlog');
                const notifFields = document.getElementById('notifFields');
                if (sendNotifCheck) {
                    sendNotifCheck.addEventListener('change', function() {
                        notifFields.style.display = this.checked ? 'block' : 'none';
                        if (this.checked) {
                            const itemName = document.querySelector('input[name="name"]').value;
                            document.getElementById('notif_title').value = itemName || "New Blog Post";
                            if (!document.getElementById('notif_msg').value) {
                                document.getElementById('notif_msg').value = itemName ? "New Blog: " + itemName + ". Read more now!" : "Check out our latest blog post!";
                            }
                        }
                    });
                }

                // --- Product Selection Logic ---
                const productSearchInput = document.getElementById('productSearch');
                const btnLoadMoreProducts = document.getElementById('btnLoadMoreProducts');
                const productItems = document.querySelectorAll('.product-item');
                let showingAllProducts = false;

                if (productSearchInput) {
                    productSearchInput.addEventListener('input', function() {
                        const query = this.value.toLowerCase().trim();
                        productItems.forEach(item => {
                            const name = item.getAttribute('data-name');
                            if (name.includes(query)) {
                                item.classList.remove('filtered-out-prod');
                                if (query !== "") {
                                    item.classList.remove('d-none-extra-prod');
                                } else if (!showingAllProducts) {
                                    const index = Array.from(productItems).indexOf(item);
                                    const isChecked = item.querySelector('.product-checkbox').checked;
                                    if (index >= 10 && !isChecked) {
                                        item.classList.add('d-none-extra-prod');
                                    }
                                }
                            } else {
                                item.classList.add('filtered-out-prod');
                            }
                        });
                        if (btnLoadMoreProducts) {
                            btnLoadMoreProducts.parentElement.style.display = query === "" && !showingAllProducts ? "block" : "none";
                        }
                    });
                }

                if (btnLoadMoreProducts) {
                    btnLoadMoreProducts.addEventListener('click', function() {
                        productItems.forEach(item => {
                            item.classList.remove('d-none-extra-prod');
                        });
                        this.parentElement.style.display = 'none';
                        showingAllProducts = true;
                    });
                }
            });
        </script>

        <?php require('include/footer.php'); ?>