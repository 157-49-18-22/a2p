<?php
$umessage = '';
include('./function/function.php');
check_session();

// Ensure developer column exists in subproduct
try {
    $pdo = getPDOObject();
    $pdo->exec("ALTER TABLE subproduct ADD COLUMN developer VARCHAR(255) DEFAULT '' AFTER pro_lable");
} catch (Exception $e) {}

try {
    $pdo->exec("ALTER TABLE subproduct ADD COLUMN city VARCHAR(255) DEFAULT '' AFTER developer");
} catch (Exception $e) {}

try {
    $pdo = getPDOObject();
    $pdo->exec("ALTER TABLE subproduct ADD COLUMN related_blogs TEXT NULL");
} catch (Exception $e) {}

// ✅ Reusable upload function
function handleFileUpload($fileKey, $prevFile = '')
{
    $Filename = $prevFile; // keep old file if no new one uploaded
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "../upload/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            $originalName = basename($_FILES[$fileKey]['name']);
            $safeName = preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $originalName);

            $Filename = date('YmdHis') . "_" . $safeName;
            $target = $uploadDir . $Filename;

            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target)) {
                // remove old file
                if ($prevFile && file_exists($uploadDir . $prevFile)) {
                    @unlink($uploadDir . $prevFile);
                }
            } else {
                die("Error: Could not move uploaded file ($fileKey). Check permissions.");
            }
        } else {
            die("Upload failed ($fileKey) with error code: " . $_FILES[$fileKey]['error']);
        }
    }
    return $Filename;
}

# ============================
# ADD SUBPRODUCT
# ============================
if (isset($_POST['addsubproduct'])) {
    $pdo = getPDOObject();
    $posted_data = $_POST;

    // handle uploads
    $posted_data['photo']  = handleFileUpload('photo');
    $posted_data['photo2'] = handleFileUpload('photo2');
    $posted_data['photo3'] = handleFileUpload('photo3');
    $posted_data['photo4'] = handleFileUpload('photo4');

    if (isset($posted_data['related_blogs']) && is_array($posted_data['related_blogs'])) {
        $posted_data['related_blogs'] = implode(',', $posted_data['related_blogs']);
    } else {
        $posted_data['related_blogs'] = '';
    }

    $affected_rows = insert('subproduct', $posted_data);
    if ($affected_rows) {
        $umessage = '<div class="alert alert-success" role="alert">
                        Added Successfully
                     </div>';
    } else {
        $umessage = '<div class="alert alert-danger" role="alert">
                        Something went wrong while saving!
                     </div>';
    }
}

# ============================
# DELETE SUBPRODUCT
# ============================
if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $data = sqlfetch("SELECT * FROM subproduct WHERE id='$id'");
    foreach ($data as $subproduct) {
        foreach (['photo', 'photo2', 'photo3', 'photo4'] as $field) {
            $img_path = '../upload/' . $subproduct[$field];
            if ($subproduct[$field] && file_exists($img_path)) {
                @unlink($img_path);
            }
        }
    }
    sqlfetch("DELETE FROM subproduct WHERE id='" . $id . "'");
    echo "<script>window.open('product.php','_self')</script>";
}

# ============================
# BULK DELETE
# ============================
if (isset($_POST['deleteall'])) {
    $arr = $_POST['ids'];
    if (count($arr)) {
        $ids = implode(",", $arr);
        $data = sqlfetch("SELECT * FROM subproduct WHERE id IN ($ids)");
        foreach ($data as $subproduct) {
            foreach (['photo', 'photo2', 'photo3', 'photo4'] as $field) {
                $img_path = '../upload/' . $subproduct[$field];
                if ($subproduct[$field] && file_exists($img_path)) {
                    @unlink($img_path);
                }
            }
        }
        $pdo = getPDOObject();
        $q = $pdo->query("DELETE FROM subproduct WHERE id IN ($ids)");
        if ($q) {
            $umessage = '<div class="alert alert-success" role="alert">Deleted Successfully</div>';
        }
    } else {
        $umessage = '<div class="alert alert-danger" role="alert">Please select items</div>';
    }
}

# ============================
# ACTIVATE / DEACTIVATE
# ============================
if (isset($_POST['activate']) || isset($_POST['deactivate'])) {
    $arr = $_POST['ids'];
    if (count($arr)) {
        $ids = implode(",", $arr);
        $status = isset($_POST['activate']) ? '1' : '0';
        $pdo = getPDOObject();
        $pdo->query("UPDATE subproduct SET actstat='$status' WHERE id IN ($ids)");
        $msg = $status == '1' ? "Activated" : "Deactivated";
        $umessage = '<div class="alert alert-success" role="alert">' . $msg . ' Successfully</div>';
    } else {
        $umessage = '<div class="alert alert-danger" role="alert">Please select items</div>';
    }
}

# ============================
# EDIT SUBPRODUCT
# ============================
if (isset($_POST['editdone'])) {
    extract($_POST);
    $posted_data = $_POST;

    $posted_data['photo']  = handleFileUpload('photo',  $prevphoto);
    $posted_data['photo2'] = handleFileUpload('photo2', $prevphoto2);
    $posted_data['photo3'] = handleFileUpload('photo3', $prevphoto3);
    $posted_data['photo4'] = handleFileUpload('photo4', $prevphoto4);

    if (isset($posted_data['related_blogs']) && is_array($posted_data['related_blogs'])) {
        $posted_data['related_blogs'] = implode(',', $posted_data['related_blogs']);
    } else {
        $posted_data['related_blogs'] = '';
    }

    $affected_rows = update('subproduct', $posted_data, ['id' => $pid]);
    if ($affected_rows) {
        $umessage = '<div class="alert alert-success" role="alert">
                        Updated Successfully
                     </div>';
    }
}

# ============================
# FORM FUNCTION (unchanged)
# ============================
function subproduct_form(
    $pid = '0',
    $name = '',
    $photo = '',
    $des = '',
    $photo2 = '',
    $photo3 = '',
    $photo4 = '',
    $pro_lable = '',
    $city = '',
    $developer = '',
    $pro_specification = '',
    $pro_mainprice = '',
    $pro_discountprice = '',
    $pro_shortdes = '',
    $pro_additionalinfo = '',
    $code = '',
    $subcat2 = 0,
    $select_option1 = '',
    $fld_order = '0',
    $subcat = 0,
    $meta_title = '',
    $meta_keyword = '',
    $meta_description = '',
    $actstat = '',
    $related_blogs = '',
    $formname = 'addsubproduct'
) { ?>


    <form action="product.php" method="post" enctype="multipart/form-data">
        <div class="form theme-form">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>" />
            <input type="hidden" name="prevphoto" value="<?php echo $photo; ?>" />
            <input type="hidden" name="prevphoto2" value="<?php echo $photo2; ?>" />

            <input type="hidden" name="prevphoto3" value="<?php echo $photo3; ?>" />
            <input type="hidden" name="prevphoto4" value="<?php echo $photo4; ?>" />
            <input type="hidden" name="code" id="code" value="<?php echo $code; ?>" />
            <div class="row">
                <div class="col-lg-6  mt-3">
                    <div class="row">
                        <div class="col-lg-12  mt-4">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">@</span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" name="name" placeholder="Name " aria-label="Name" value="<?php echo $name; ?>" />
                                    <label for="basic-addon11"> Product Name </label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12  mt-4 ">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">@</span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" name="pro_lable" id="product_location" placeholder="Name " aria-label="Name" value="<?php echo $pro_lable; ?>" />
                                    <label for="basic-addon11"> Product Location (Specific Area/Sector) </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12  mt-4 ">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">@</span>
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select" name="city" id="product_city" onchange="fetchDevelopers(this.value)">
                                        <option value="">Select City</option>
                                        <?php
                                        $cities = sqlfetch("SELECT DISTINCT location FROM location_developers ORDER BY location ASC");
                                        $total_cities = count($cities);
                                        foreach($cities as $c) {
                                            $selected = ($city == $c['location']) ? 'selected' : '';
                                            echo '<option value="'.$c['location'].'" '.$selected.'>'.$c['location'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <label for="basic-addon11"> City / Main Location (Total: <?php echo $total_cities; ?>) </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12  mt-4 ">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">@</span>
                                <div class="form-floating form-floating-outline">
                                    <select class="form-select" name="developer" id="developer_dropdown">
                                        <option value="">Select Developer</option>
                                        <?php if(!empty($developer)) echo "<option value='$developer' selected>$developer</option>"; ?>
                                    </select>
                                    <label for="basic-addon11"> Developer </label>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-12  mt-4 ">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">@</span>
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" name="pro_specification" placeholder="Name " aria-label="Name" value="<?php echo $pro_specification; ?>" />
                                    <label for="basic-addon11"> Product Area SQ/FT</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6  mt-4 ">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">@</span>
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" name="pro_mainprice" placeholder="Name " aria-label="Name" value="<?php echo $pro_mainprice; ?>" />
                                    <label for="basic-addon11"> Product Main Price</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6  mt-4 ">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">@</span>
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" name="pro_discountprice" placeholder="Name " aria-label="Name" value="<?php echo $pro_discountprice; ?>" />
                                    <label for="basic-addon11"> Product Discount Price</label>
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-12  mt-4  d-none">
                            <div class="form-floating form-floating-outline">
                                <select class="form-select" name="select_option1" id="selectError" data-rel="chosen">
                                    <option value="no">Select Options</option>
                                    <option value="block">Yes</option>
                                    <option value="none">No</option>
                                </select>
                                <label for="floatingSelect">Add Select Option 1 </label>
                            </div>
                        </div>






                    </div>
                </div>

                <div class="col-lg-6  mt-3">



                    <div class="col-lg-12 mt-4">
                        <div class="input-group input-group-merge">

                            <span class="input-group-text">@</span>

                            <div class="form-floating form-floating-outline">
                                <input type="file" class="form-control" name="photo" aria-label="Upload" value="<?php echo $photo; ?>">
                                <label for="basic-addon11"> Photo</label>

                            </div>
                            <img class="grayscale img-responsive" alt="" src="../upload/<?php echo $photo; ?>" style="    width: 50px;margin-right: 16px;border-radius: 16px;">
                        </div>

                    </div>
                    <div class="col-lg-12 mt-4 d-none">
                        <div class="input-group input-group-merge">

                            <span class="input-group-text">@</span>

                            <div class="form-floating form-floating-outline">
                                <input type="file" class="form-control" name="photo2" aria-label="Upload" value="<?php echo $photo2; ?>">
                                <label for="basic-addon11">Floor Plan Photo 2</label>

                            </div>
                            <img class="grayscale img-responsive" alt="" src="../upload/<?php echo $photo2; ?>" style="    width: 50px;margin-right: 16px;border-radius: 16px;">
                        </div>

                    </div>
                    <div class="col-lg-12 mt-4 d-none">
                        <div class="input-group input-group-merge">

                            <span class="input-group-text">@</span>

                            <div class="form-floating form-floating-outline">
                                <input type="file" class="form-control" name="photo3" aria-label="Upload" value="<?php echo $photo3; ?>">
                                <label for="basic-addon11">Floor Plan Photo 3</label>


                            </div>
                            <img class="grayscale img-responsive" alt="" src="../upload/<?php echo $photo3; ?>" style="    width: 50px;margin-right: 16px;border-radius: 16px;">
                        </div>

                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="input-group input-group-merge">

                            <span class="input-group-text">@</span>

                            <div class="form-floating form-floating-outline">
                                <input type="file" class="form-control" name="photo4" aria-label="Upload" value="<?php echo $photo4; ?>">
                                <label for="basic-addon11">Upload Brochure (PDF/DOC/EXCEL) </label>


                            </div>
                
                        </div>
                        
                            <a href="../upload/<?php echo $photo4; ?>" target="_blank" class="text-danger">View File</a>

                    </div>



                </div>


                <div class="col-lg-6  mt-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="subcat2" id="selectError" data-rel="chosen">
                            <option>Select Category</option>
                            <?php
                            $categories = sqlfetch("SELECT * FROM `category` order by fld_order");
                            foreach ($categories as $categoreey) {
                                $select = '';
                                if (($subcat2 == ($categoreey['id'])))
                                    $select = 'selected';
                                echo '<option ' . $select . ' value="' . $categoreey['id'] . '">' . $categoreey['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">SELECT Category</label>
                    </div>
                </div>

                <div class="col-lg-6  mt-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="subcat" id="selectError" data-rel="chosen">
                            <option>Select Subcategory</option>
                            <?php
                            $categories = sqlfetch("SELECT * FROM `subcategory` order by fld_order");
                            foreach ($categories as $category) {
                                $select = '';
                                if (($subcat == ($category['id'])))
                                    $select = 'selected';
                                echo '<option ' . $select . ' value="' . $category['id'] . '">' . $category['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">SELECT Subcategory</label>
                    </div>
                </div>
                <div class="col-lg-6  mt-4">
                    <div class="form-floating form-floating-outline">
                        <select class="form-select" name="actstat" id="selectError" data-rel="chosen">
                            <option <?php if (($actstat) == '1') echo 'selected'; ?> value="1">Active</option>
                            <option <?php if (($actstat) == '0') echo 'selected'; ?> value="0">Inactive</option>
                        </select>
                        <label for="floatingSelect">Status</label>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="number" class="form-control" placeholder="Sort Order" aria-label="Description" name="fld_order" value="<?php echo $fld_order; ?>" />
                            <label for="basic-addon11">Sort Order</label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4  mt-4 ">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" aria-label="Meta Title" value="<?php echo $meta_title; ?>" />
                            <label for="basic-addon11">Meta Title</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  mt-4 ">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="meta_keyword" placeholder="Meta Keyword" aria-label="Meta Keyword" value="<?php echo $meta_keyword; ?>" />
                            <label for="basic-addon11">Meta Keyword</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  mt-4 ">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="meta_description" placeholder="Meta Description" aria-label="Meta Description" value="<?php echo $meta_description; ?>" />
                            <label for="basic-addon11">Meta Description</label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12  mt-4">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">@</span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="pro_shortdes" placeholder="Name " aria-label="Name" value="<?php echo $pro_shortdes; ?>" />
                            <label for="basic-addon11"> Location Map </label>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12  mt-4">
                    <div class="input-group input-group-merge">

                        <div class="form-floating form-floating-outline">
                            <label for="basic-addon11">Description</label>
                            <br><br>
                            <textarea class="page_data editor" name="pro_additionalinfo" cols="60" rows="10"><?php echo $pro_additionalinfo; ?></textarea>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 mt-4">
                    <div class="form-floating form-floating-outline">
                        <label for="basic-addon11">Amenities</label>
                        <br><br>
                        <textarea class="page_data editor" name="des" cols="60" rows="10"><?php echo $des; ?></textarea>
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

                <style>
                    .d-none-extra { display: none !important; }
                    .blog-item.filtered-out { display: none !important; }
                </style>

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


        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Home/</span> Categories </h4>


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
                                $productdata = sqlfetch("SELECT * FROM `subproduct` where id='$pid' ");
                                foreach ($productdata as $product) {
                                    subproduct_form(
                                        $product['id'] ?? '0',
                                        $product['name'] ?? '',
                                        $product['photo'] ?? '',
                                        $product['des'] ?? '',
                                        $product['photo2'] ?? '',
                                        $product['photo3'] ?? '',
                                        $product['photo4'] ?? '',
                                        $product['pro_lable'] ?? '',
                                        $product['city'] ?? '',
                                        $product['developer'] ?? '',
                                        $product['pro_specification'] ?? '',
                                        $product['pro_mainprice'] ?? '',
                                        $product['pro_discountprice'] ?? '',
                                        $product['pro_shortdes'] ?? '',
                                        $product['pro_additionalinfo'] ?? '',
                                        $product['code'] ?? '',
                                        $product['subcat2'] ?? 0,
                                        $product['select_option1'] ?? '',
                                        $product['fld_order'] ?? '0',
                                        $product['subcat'] ?? 0,
                                        $product['meta_title'] ?? '',
                                        $product['meta_keyword'] ?? '',
                                        $product['meta_description'] ?? '',
                                        $product['actstat'] ?? '',
                                        $product['related_blogs'] ?? '',
                                        'editdone'
                                    );
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
                                <?php subproduct_form(); ?>
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
                                <th>Subcategory Name</th>
                                <th>Category Name</th>

                                <th>Sort Order</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delet</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            // Fetch subcategories from the `subcategory` table
                            $subcategories = sqlfetch("SELECT * FROM `subcategory` ORDER BY fld_order");
                            $subcategoryLookup = [];
                            foreach ($subcategories as $subcategory) {
                                $subcategoryLookup[$subcategory['id']] = $subcategory['name'];
                            }

                            // Fetch categories from the `category` table
                            $categories = sqlfetch("SELECT * FROM `category` ORDER BY fld_order");
                            $categoryLookup = [];
                            foreach ($categories as $category) {
                                $categoryLookup[$category['id']] = $category['name'];
                            }

                            // Initialize counter
                            $count = 1;

                            // Fetch the product data
                            $data = sqlfetch("SELECT * FROM `subproduct` ORDER BY fld_order");

                            // Generate the table rows
                            foreach ($data as $menu) {
                                // Get names for subcat and subcat2
                                $subcatName = isset($subcategoryLookup[$menu['subcat']]) ? $subcategoryLookup[$menu['subcat']] : '';
                                $subcat2Name = isset($categoryLookup[$menu['subcat2']]) ? $categoryLookup[$menu['subcat2']] : '';
                            ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $menu['name']; ?></td>
                                    <td><img style="height: 32px;width: 32px;" src="../upload/<?php echo $menu['photo']; ?>" class="img-responsive"></td>

                                    <!-- Separate columns for subcat and subcat2 -->
                                    <td><?php echo $subcatName; ?></td>
                                    <td><?php echo $subcat2Name; ?></td>

                                    <td><?php echo $menu['fld_order']; ?></td>
                                    <td><?php echo get_active_status_text($menu['actstat']); ?></td>

                                    <td>
                                        <a class="ajax-link" href="product.php?pid=<?php echo $menu['id']; ?>&edit=true">
                                            <button type="button" class="btn btn-xs btn-danger pull-right" name="editclient"><i class="fa fa-pencil"></i></button>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="product.php?id=<?php echo $menu['id']; ?>&action=delete" onclick="return confirm('Are you sure you want to delete this item?');">
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
            // Run functions when the page is loaded
            window.onload = function() {
                generateCode();
                const city = document.getElementById('product_city').value;
                if(city) fetchDevelopers(city);
            };

            function generateCode() {
                // Define the characters to use for the random code
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

                // Set the length of the random code
                const codeLength = 8;

                // Generate the random code
                let randomCode = '';
                for (let i = 0; i < codeLength; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    randomCode += characters.charAt(randomIndex);
                }

                // Set the generated code to the input field
                document.getElementById('code').value = randomCode;
            }

            function fetchDevelopers(city) {
                const dropdown = document.getElementById('developer_dropdown');
                if (!city) {
                    dropdown.innerHTML = '<option value="">Select Developer</option>';
                    return;
                }

                fetch('get_developers.php?city=' + encodeURIComponent(city))
                    .then(response => response.json())
                    .then(data => {
                        const currentVal = dropdown.value;
                        dropdown.innerHTML = '<option value="">Select Developer</option>';
                        data.forEach(dev => {
                            const option = document.createElement('option');
                            option.value = dev;
                            option.text = dev;
                            if(dev === currentVal) option.selected = true;
                            dropdown.add(option);
                        });
                    });
            }

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
            });
        </script>

        <?php require('include/footer.php'); ?>