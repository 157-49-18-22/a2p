<?php 
if(!defined('SITE_URL')) define('SITE_URL', '');
include_once __DIR__ . '/../config.php';

if (session_status() == PHP_SESSION_NONE) { 
    session_start(); 
}

// Retrieve the admin's name and ID from the session
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 0;
?>
<!DOCTYPE html>

    <html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-semi-dark" data-assets-path="assets/" data-template="vertical-menu-template-semi-dark">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title><?php echo $siteTitle; ?> </title>


        <meta name="description" content="" />
        <meta name="keywords" content="">
        <!-- Canonical SEO -->
        <link rel="canonical" href="https://1.envato.market/materialize_admin">
        <!-- Favicon -->
        <!-- Global Favicon -->
        <link rel="icon" href="<?= SITE_URL; ?>assets/images/favicons/favicon.ico" type="image/x-icon">
        <link rel="icon" type="image/png" sizes="32x32"
            href="<?= SITE_URL; ?>assets/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16"
            href="<?= SITE_URL; ?>assets/images/favicons/favicon-16x16.png">
        <link rel="apple-touch-icon"
            href="<?= SITE_URL; ?>assets/images/favicons/apple-touch-icon.png">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap" rel="stylesheet">

        <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
        <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css" />
        <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

        <!-- Menu waves for no-customizer fix -->
        <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="assets/css/demo.css" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
        <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
        <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
        <link rel="stylesheet" href="assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css">
        <link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">
        <link rel="stylesheet" href="assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css">
        <link rel="stylesheet" href="assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css">

        <script src="assets/vendor/js/helpers.js"></script>
        <script src="assets/vendor/js/template-customizer.js"></script>
        <script src="assets/js/config.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
        </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="assets/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="assets/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="assets/vendor/libs/quill/editor.css" />
   <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/vendor/js/template-customizer.js"></script>
    <script src="assets/js/config.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />





<?php
// Get the current file name
$current_page = basename($_SERVER['PHP_SELF']);

// Only load TinyMCE if the current page is not application_seating.php
if ($current_page !== 'application_seating.php') {
?>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.1.2/tinymce.min.js"></script>


    <script type="text/javascript">
        tinymce.init({
            selector: '.editor',
            plugins: [
                'autolink', 'lists', 'link', 'image', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'fullscreen', 'insertdatetime', 'media', 'table', 'wordcount', 'code'
            ],
            toolbar: 'undo redo | casechange blocks | code |bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
                'bullist numlist outdent indent | removeformat | code table'
        })
    </script>
    



<?php
}
?>

  
  
  
  
  


</head>

<script type="text/javascript">
    function toggle(source) {
        var aInputs = document.getElementsByTagName('input');
        for (var i = 0; i < aInputs.length; i++) {
            if (aInputs[i] != source && aInputs[i].className == source.className) {
                aInputs[i].checked = source.checked;
            }
        }
    }
</script>

<body>
    <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar  ">
            <div class="layout-container">
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


                    <div class="app-brand demo ">
                        <a href="index.php" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <span style="color:var(--bs-primary);">
                                    <svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z" fill="currentColor" />
                                        <path d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z" fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                                        <path d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z" fill="currentColor" />
                                        <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="currentColor" />
                                        <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                                        <path d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z" fill="currentColor" />
                                        <defs>
                                            <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1" />
                                                <stop offset="1" stop-opacity="0" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1" />
                                                <stop offset="1" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </span>
                            </span>
                            <span class="app-brand-text demo menu-text fw-bold ms-2">Admin</span>
                        </a>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z" fill="currentColor" fill-opacity="0.6" />
                                <path d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z" fill="currentColor" fill-opacity="0.38" />
                            </svg>
                        </a>
                    </div>

                    <div class="menu-inner-shadow"></div>



                    <ul class="menu-inner py-1">
                        <!-- Dashboards -->
                        <li class="menu-item active">
                            <a href="index.php" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                                <div data-i18n="Dashboards">Dashboards</div>

                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="application_seating.php?&pid=1&edit=true" class="menu-link">
                                        <div data-i18n="Web Setting">Web Setting</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="../" class="menu-link" target="_blank">
                                        <div data-i18n="View Frontend">View Frontend</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="notifications.php" class="menu-link">
                                        <div data-i18n="Push Notifications">Push Notifications</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="subscribers.php" class="menu-link">
                                        <div data-i18n="Subscribed Devices">Subscribed Devices</div>
                                    </a>
                                </li>

                            </ul>
                        </li>



                        <!-- Apps & Pages -->
                        <li class="menu-header fw-medium mt-4">
                            <span class="menu-header-text">Apps &amp; Pages</span>
                        </li>

                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Front Page">Manage Front Page</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="banner.php" class="menu-link">
                                        <div data-i18n="Manage Slider">Manage Slider</div>
                                    </a>
                                </li>


                                <li class="menu-item">
                                    <a href="about_us.php?&pid=5&edit=true" class="menu-link">
                                        <div data-i18n=" About Us">About Us
                                        </div>
                                    </a>
                                </li>
                                
                                  <li class="menu-item">
                                    <a href="faq.php" class="menu-link">
                                        <div data-i18n=" Manage Faq"> Manage Faq
                                        </div>
                                    </a>
                                </li>
                                
                                <li class="menu-item">
                                    <a href="process.php" class="menu-link">
                                        <div data-i18n=" Our Work Process"> Our Work Process
                                        </div>
                                    </a>
                                </li>
                                
                                <li class="menu-item">
                                    <a href="certification.php" class="menu-link">
                                        <div data-i18n="
                                                Leading in Real Estate & Technology Solutions"> 
                                                Leading in Real Estate & Technology Solutions
                                        </div>
                                    </a>
                                </li>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <li class="menu-item">
                                    <a href="news.php" class="menu-link">
                                        <div data-i18n="Manage News Marque">Manage News Marque
                                        </div>
                                    </a>
                                </li>
                                
                                 <li class="menu-item">
                                    <a href="team.php" class="menu-link">
                                        <div data-i18n="Pop-Up Image">Pop-Up Image
                                        </div>
                                    </a>
                                </li>
                                
                                  <li class="menu-item">
                                    <a href="fixed_delivery_time.php" class="menu-link">
                                        <div data-i18n="Manage Media Gallery">Manage Media Gallery

                                        </div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="notifications.php" class="menu-link">
                                        <div data-i18n="Push Notifications">Push Notifications</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="subscribers.php" class="menu-link">
                                        <div data-i18n="Subscribed Devices">Subscribed Devices</div>
                                    </a>
                                </li>




                            </ul>
                        </li>

                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage About Us">Manage About Us</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="about_us.php?&pid=2&edit=true" class="menu-link">
                                        <div data-i18n=" About Us"> About Us
                                        </div>
                                    </a>
                                </li>



                                <li class="menu-item">
                                    <a href="about_us.php?&pid=3&edit=true" class="menu-link">
                                        <div data-i18n="Vision">Vision
                                        </div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="about_us.php?&pid=4&edit=true" class="menu-link">
                                        <div data-i18n="Mission">Mission
                                        </div>
                                    </a>
                                </li>


                                <li class="menu-item">
                                    <a href="testimonial.php" class="menu-link">
                                        <div data-i18n="Customer Feedback">Customer Feedback</div>
                                    </a>
                                </li>




                            </ul>
                        </li>

                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Blogs"> Manage Blogs</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="offer.php" class="menu-link">
                                        <div data-i18n="Add Blogs">Add Blogs</div>
                                    </a>
                                </li>




                            </ul>
                        </li>



                            <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Other Pages"> Manage Other Pages</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="about_us.php?&pid=12&edit=true" class="menu-link">
                                        <div data-i18n="Terms And Conditions">Terms And Conditions</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="about_us.php?&pid=11&edit=true" class="menu-link">
                                        <div data-i18n="Privacy Policy">Privacy Policy</div>
                                    </a>
                                </li>




                            </ul>
                        </li>              












                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Projects">Manage Projects</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="client_logo.php" class="menu-link">
                                        <div data-i18n="Residential Projects">Residential Projects</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="certification.php" class="menu-link">
                                        <div data-i18n="Commercial Projects">Commercial Projects</div>
                                    </a>
                                </li>




                            </ul>
                        </li>


                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Products"> Manage Products</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="category.php" class="menu-link">
                                        <div data-i18n="Add  Category">Add Category</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="subcategory.php" class="menu-link">
                                        <div data-i18n="Add Subcategory">Add Subcategory</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="product.php" class="menu-link">
                                        <div data-i18n="Add Products">Add Products</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="sub_image.php" class="menu-link">
                                        <div data-i18n="Add Products Gallery">Add Products Gallery</div>
                                    </a>
                                </li>
                                
                                <li class="menu-item">
                                    <a href="subcategory2.php" class="menu-link">
                                        <div data-i18n="Add Floor Images">Add Floor Images</div>
                                    </a>
                                </li>




                            </ul>
                        </li>

                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Career">Manage Career</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="blog.php" class="menu-link">
                                        <div data-i18n="Add Career">Add Career</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="job_applications.php" class="menu-link">
                                        <div data-i18n="Job Applications">Job Applications</div>
                                    </a>
                                </li>
                            </ul>
                        </li>



                     <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Sub Admins">Manage Sub Admins</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="subadmin.php" class="menu-link">
                                        <div data-i18n="Creat Super Admin"> Creat Super Admin
                                        </div>
                                    </a>
                                </li>



                                <!--<li class="menu-item">-->
                                <!--    <a href="#" class="menu-link">-->
                                <!--        <div data-i18n="Vision">Vision-->
                                <!--        </div>-->
                                <!--    </a>-->
                                <!--</li>-->

                                



                            </ul>
                        </li>














                        <li class="menu-item ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class='menu-icon tf-icons mdi mdi-folder'></i>
                                <div data-i18n="Manage Query">Manage Query</div>
                            </a>
                            <ul class="menu-sub">

                                <li class="menu-item">
                                    <a href="client.php" class="menu-link">
                                        <div data-i18n="Query List">
                                            Query List</div>
                                    </a>
                                </li>

                                 <li class="menu-item">
                                    <a href="location_developers.php" class="menu-link">
                                        <div data-i18n="By City Location">By City Location</div>
                                    </a>
                                </li>




                            </ul>
                        </li>

                    </ul>



                </aside>
                <div class="layout-page">
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">



                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="mdi mdi-menu mdi-24px"></i>
                            </a>
                        </div>


                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


                         





                            <ul class="navbar-nav flex-row align-items-center ms-auto">



<?php


try {
    // Use the existing getPDOObject function if available, otherwise include the function file
    if (!function_exists('getPDOObject')) {
        include_once __DIR__ . '/../function/function.php';
    }
    
    $pdo_header = getPDOObject();

    // Ensure $admin_id is set and sanitize it
    if (!isset($admin_id) || empty($admin_id)) {
        // Fallback to session if not set
        $admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 0;
    }
    
    if ($admin_id > 0) {
        $admin_id = htmlspecialchars($admin_id);

        // Prepare and execute the SQL query
        $query = "SELECT * FROM `admin` WHERE id = :admin_id";
        $stmt = $pdo_header->prepare($query);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the results
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $data = array();
    }

} catch (PDOException $e) {
    // Log error silently or show a small debug message instead of breaking the layout
    error_log("Header DB Error: " . $e->getMessage());
    $data = array();
} catch (Exception $e) {
    error_log("Header Error: " . $e->getMessage());
    $data = array();
}
?>
                                     <?php
// Ensure that the admin's data is fetched correctly and store the photo path
if (!empty($data)) {
    $menu = $data[0];
    // Display the photo if available
    $photoPath = isset($menu['photo']) ? "../upload/" . htmlspecialchars($menu['photo']) : "assets/img/avatars/1.png";
    $admin_name = isset($menu['name']) ? htmlspecialchars($menu['name']) : (isset($menu['username']) ? htmlspecialchars($menu['username']) : 'Admin');
    $admin_id = isset($menu['id']) ? htmlspecialchars($menu['id']) : 0;
?>



                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <!-- Display the photo if available -->
                                        <img src="<?php echo $photoPath; ?>" alt="Avatar" class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
  
                                    
                                        <li>
                                            <a class="dropdown-item" href="index.php">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <!-- Use the fetched photo path -->
                                                            <img src="<?php echo $photoPath; ?>" alt="Admin Photo" class="w-px-40 h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <!-- Display admin name and ID -->
                                                        <span class="fw-medium d-block"><?php echo $admin_name; ?> <?php echo $admin_id; ?></span>
                                                        <small class="text-muted">Admin</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>



                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="profile.php">
                                                <i class="mdi mdi-account-outline me-2"></i>
                                                <span class="align-middle">My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="application_seating.php?&pid=1&edit=true">
                                                <i class="mdi mdi-cog-outline me-2"></i>
                                                <span class="align-middle">Settings</span>
                                            </a>
                                        </li>

                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="logout.php">
                                                <i class="mdi mdi-logout me-2"></i>
                                                <span class="align-middle">Log Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ User -->
<?php } ?>


                            </ul>
                        </div>


                        <!-- Search Small Screens -->
                        <div class="navbar-search-wrapper search-input-wrapper  d-none">
                            <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
                            <i class="mdi mdi-close search-toggler cursor-pointer"></i>
                        </div>



                    </nav>
                <?php } ?>