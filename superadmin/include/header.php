<?php 
include __DIR__ . '/../config.php';
error_reporting(0); // Production mode

if (session_status() == PHP_SESSION_NONE) { session_start(); }

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
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/fonts/materialdesignicons.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/js/config.js"></script>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.php" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bold ms-2">Superadmin</span>
                    </a>
                </div>
                <ul class="menu-inner py-1">
                    <li class="menu-item active">
                        <a href="index.php" class="menu-link">
                            <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                            <div>Dashboards</div>
                        </a>
                    </li>
                    
                    <li class="menu-header fw-medium mt-4">
                        <span class="menu-header-text">Apps &amp; Pages</span>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class='menu-icon tf-icons mdi mdi-folder'></i>
                            <div>Manage Front Page</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item"><a href="banner.php" class="menu-link"><div>Manage Slider</div></a></li>
                            <li class="menu-item"><a href="about_us.php?&pid=5&edit=true" class="menu-link"><div>About Us</div></a></li>
                            <li class="menu-item"><a href="faq.php" class="menu-link"><div>Manage Faq</div></a></li>
                            <li class="menu-item"><a href="notifications.php" class="menu-link"><div>Push Notifications</div></a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class='menu-icon tf-icons mdi mdi-account-group'></i>
                            <div>Manage About Us</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item"><a href="about_us.php?&pid=2&edit=true" class="menu-link"><div>About Us</div></a></li>
                            <li class="menu-item"><a href="testimonial.php" class="menu-link"><div>Testimonials</div></a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class='menu-icon tf-icons mdi mdi-newspaper'></i>
                            <div>Manage Blogs</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item"><a href="offer.php" class="menu-link"><div>Add Blogs</div></a></li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="location_developers.php" class="menu-link">
                            <i class='menu-icon tf-icons mdi mdi-map-marker'></i>
                            <div>By City Location</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="assets/img/avatars/1.png" alt="Avatar" class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block"><?php echo $admin_name; ?></span>
                                                    <small class="text-muted">Superadmin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout me-2"></i><span class="align-middle">Log Out</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="content-wrapper">