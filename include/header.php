    <!-- Native Browser Push Notifications Registration -->
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('<?= SITE_URL; ?>sw.js').then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
    </script>
<body class="custom-cursor">

<style>
/* Header Layout - Highly Compact for One Row */
/* Header Layout - Clean Centered Design */
.main-menu-two__wrapper {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 0 30px !important; 
    height: 70px !important; /* Reverted to standard height */
    position: relative !important;
    z-index: 100 !important;
    max-width: 100% !important;
    background: #fff !important;
}

.main-menu-two__left {
    display: flex !important;
    align-items: center !important;
    flex: 1 !important;
}

.main-menu-two__logo {
    margin: 0 !important;
    flex-shrink: 0 !important;
}

.main-menu-two__logo img {
    height: 45px !important; 
    width: auto !important;
}

/* Absolute Centering for Menu Box */
.main-menu-two__main-menu-two-box {
    position: absolute !important;
    left: 50% !important;
    top: 50% !important;
    transform: translate(-50%, -50%) !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    height: 100% !important;
    width: auto !important;
}

.main-menu__list {
    display: flex !important;
    gap: 8px !important; /* Reverted to original compact gap */
    align-items: center !important;
    height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
}

.main-menu-two .main-menu__list > li {
    padding: 0 !important;
    margin: 0 !important;
    display: flex !important;
    align-items: center !important;
    height: 70px !important;
}

.main-menu__list > li > a {
    white-space: nowrap !important;
    padding: 8px 12px !important; 
    font-size: 13px !important; 
    font-weight: 700 !important;
    text-transform: uppercase !important;
    color: #333 !important;
    border-radius: 5px !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.main-menu-two .main-menu__list > li.current > a,
.main-menu-two .main-menu__list > li:hover > a {
    background-color: #c00415 !important;
    color: #fff !important;
}

.main-menu-two__main-menu-two-inner {
    display: flex !important;
    align-items: center !important;
    height: 100% !important;
}

.main-menu-two__right {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    flex: 1 !important;
    z-index: 101 !important;
}

/* Center Top Bar Content */
.main-header-three__top-inner {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 40px !important;
}

.main-header-three__top-left, 
.main-header-three__top-right {
    flex: initial !important;
}

/* Search Button Style - Next Level Redesign */
.main-menu-two__call .thm-btn {
    width: 48px !important;
    height: 48px !important;
    border-radius: 12px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: linear-gradient(145deg, #c00415 0%, #a00311 100%) !important;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    box-shadow: 
        0 6px 20px rgba(192, 4, 21, 0.3),
        inset 0 1px 2px rgba(255, 255, 255, 0.3) !important;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    cursor: pointer !important;
    position: relative;
    overflow: hidden;
}

.main-menu-two__call .thm-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.main-menu-two__call .thm-btn:hover {
    transform: translateY(-4px) scale(1.08) !important;
    background: linear-gradient(145deg, #e6051b 0%, #c00415 100%) !important;
    box-shadow: 
        0 12px 30px rgba(192, 4, 21, 0.45),
        0 0 0 5px rgba(192, 4, 21, 0.1) !important;
}

.main-menu-two__call .thm-btn:hover::before {
    left: 100%;
}

.main-menu-two__call .thm-btn i {
    font-size: 20px !important;
    transition: all 0.4s ease !important;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2)) !important;
}

.main-menu-two__call .thm-btn:hover i {
    transform: scale(1.2) !important;
}

/* Notification Bell */
.notification-bell {
    position: fixed;
    bottom: 20px;
    left: 20px;
    width: 50px;
    height: 50px;
    background: #c00415;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.bell-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ffc107; /* Bright yellow for visibility */
    color: #000;
    font-size: 11px;
    font-weight: 800;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

@media (max-width: 1199px) {
    .main-menu__list {
        display: none !important; /* Hide desktop list on mobile */
    }
    .mobile-nav__container .main-menu__list {
        display: block !important; /* Force show in mobile drawer */
        list-style: none !important;
        padding: 20px !important;
    }
    .mobile-nav__container .main-menu__list > li > a {
        color: #fff !important; /* White text for red background */
        font-size: 16px !important;
        padding: 12px 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        position: relative !important;
    }
    .mobile-nav__container .main-menu__list > li > a i {
        color: #fff !important; /* Force icon white in mobile */
    }
    /* Fix for the blue dropdown arrows */
    .mobile-nav__container .main-menu__list .dropdown > a button {
        background: transparent !important;
        border: none !important;
        color: #fff !important;
        font-size: 14px !important;
        padding: 0 !important;
        margin-left: 10px !important;
        display: flex !important;
        align-items: center !important;
    }
    .mobile-nav__social {
        display: flex !important;
        flex-direction: row !important;
        gap: 15px !important;
        padding: 20px !important;
        justify-content: flex-start !important;
    }
    .mobile-nav__social a {
        color: #fff !important;
        font-size: 18px !important;
    }
    .mobile-nav__top {
        margin-top: 20px !important;
    }
    .mobile-nav__contact {
        padding: 20px !important;
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 0 !important;
    }
    .mobile-nav__contact li {
        margin-bottom: 10px !important;
    }
    .mobile-nav__contact a, 
    .mobile-nav__contact i {
        color: #fff !important;
    }
    .mobile-nav__toggler {
        display: flex !important; /* Show hamburger */
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #f4f4f4;
        border-radius: 5px;
        color: #333;
        font-size: 20px;
        margin-left: 10px;
    }
    .main-menu-two__wrapper {
        padding: 0 15px !important;
        height: 65px !important;
    }
    .main-menu-two__logo img {
        height: 40px !important; /* Responsive logo size */
    }
    .main-menu-two__main-menu-two-box {
        justify-content: flex-end !important;
        flex: 0 !important;
        order: 3 !important; /* Hamburger on far right */
    }
    .main-menu-two__right {
        flex: 1 !important;
        justify-content: flex-end !important;
        order: 2 !important;
        margin-left: 0 !important;
        gap: 10px !important;
    }
    .main-menu-two__call .thm-btn {
        width: 38px !important;
        height: 38px !important;
        border-radius: 8px !important;
    }
    .mobile-nav__toggler {
        margin-left: 8px !important;
        width: 38px !important;
        height: 38px !important;
    }

    /* Fix image cutting on mobile - Enhanced Robustness */
    .page-header {
        padding: 50px 0 !important;
        min-height: auto !important;
    }
    .page-header-bg {
        background-size: cover !important;
        background-position: center !important;
    }
    
    /* Centralized Image Scaling Fix - Ultra Aggressive for Mobile */
    .welcome-one__img-box img,
    .about-one__img-box img,
    .service-details__img img,
    .project-details__img img,
    .blog-details__img img,
    .project-three__img img,
    .project-three__imgs img {
        width: 95% !important; /* Slightly smaller than 100% for padding */
        max-width: 100% !important;
        height: auto !important;
        max-height: 70vh !important; /* Prevent too long images on mobile */
        object-fit: contain !important; /* Never cut the image */
        display: block !important;
        margin: 10px auto !important; /* Added vertical margin and centered */
        box-shadow: none !important; /* Optional: remove shadow if it adds extra width */
    }

    .blog-details {
        padding: 30px 10px !important;
        overflow-x: hidden !important; /* Prevent horizontal scroll */
    }

    .blog-details__img {
        overflow: visible !important;
        width: 100% !important;
        display: block !important;
        text-align: center !important;
    }
    
    .thm-breadcrumb {
        margin-bottom: 10px !important;
    }
}

@media (min-width: 1200px) {
    .mobile-nav__toggler {
        display: none !important; /* Hide hamburger on desktop */
    }
}

/* Notification Panel Styling */
.notif-panel {
    position: fixed;
    bottom: 80px;
    left: 20px;
    width: 280px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    display: none; /* Hidden by default */
    z-index: 1001;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.05);
}

.notif-header {
    background: #c00415;
    color: #fff;
    padding: 12px 15px;
    font-size: 14px;
    font-weight: 700;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notif-list {
    max-height: 250px;
    overflow-y: auto;
}

.notif-item {
    padding: 12px 15px;
    border-bottom: 1px solid #f4f4f4;
    cursor: pointer;
    transition: background 0.2s;
}

.notif-item:hover {
    background: #f9f9f9;
}

.notif-item p {
    margin: 0;
    font-size: 13px;
    color: #333;
    line-height: 1.4;
}

.notif-item span {
    font-size: 10px;
    color: #999;
}

.notif-panel.active {
    display: block;
    animation: slideUp 0.3s ease-out;
}

    /* Global Image Fix for Uploaded Content */
    .project-card-v2__img, 
    .blog-card-v2__img, 
    .about-one__img-box,
    .service-details__img,
    .project-details__img,
    .working-process__icon {
        overflow: hidden !important;
        position: relative !important;
        background: #f8f9fa !important;
    }

    /* welcome-one__img-box should NOT clip the .welcom text */
    .welcome-one__img-box {
        overflow: visible !important;
        position: relative !important;
    }

    /* Standardize card image ratios */
    .project-card-v2__img { height: 260px !important; }
    .blog-card-v2__img { height: 240px !important; }
    
    .project-card-v2__img img, 
    .blog-card-v2__img img, 
    .about-one__img-box img,
    .service-details__img img,
    .project-details__img img,
    .working-process__icon img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        transition: transform 0.3s ease !important;
    }

    .welcome-one__img-s2 img {
        width: 100% !important;
        height: auto !important;
        object-fit: cover !important;
        object-position: center !important;
    }

    /* Detail Pages (Service/Blog) & Floor Plans Image Fix */
    .blog-details__img img,
    .project-three__img img,
    .project-three__imgs img {
        width: 100% !important;
        height: auto !important;
        max-width: 100% !important;
        object-fit: contain !important; /* Ensures whole image (like Plans) is visible */
        display: block !important;
        margin: 0 auto !important;
    }

    @media (max-width: 767px) {
        .blog-details {
            padding: 60px 0 60px !important;
        }
        .project-three__img, .blog-details__img {
            overflow: visible !important;
        }
    }

    /* Small process icons should fit contain */
    .working-process__icon img {
        object-fit: contain !important;
        padding: 10px;
    }

    /* Mobile: Make working process icons & cards smaller */
    @media (max-width: 767px) {
        .working-process__icon {
            text-align: center !important;
            margin-bottom: 10px !important;
        }
        .working-process__icon img {
            max-width: 80px !important;
            height: 80px !important;
            padding: 5px !important;
        }
        .working-process__icon span {
            font-size: 40px !important;
        }
        .working-process__single {
            padding: 25px 20px 35px !important;
            margin-left: 30px !important;
            margin-bottom: 45px !important;
        }
        .working-process__count {
            width: 55px !important;
            height: 55px !important;
            top: -35px !important;
            left: -30px !important;
        }
        .working-process__count:before {
            width: 55px !important;
            height: 55px !important;
            line-height: 55px !important;
            font-size: 16px !important;
        }
        .working-process__title {
            font-size: 18px !important;
            margin-bottom: 12px !important;
        }
    }

    /* Fix: .welcom (h3.ddd text) - never overlap the image on mobile */
    .welcom {
        position: relative !important;
        z-index: 1;
        margin-bottom: 15px !important;
    }

    @media (max-width: 991px) {
        .welcom {
            display: block !important;
            width: 100% !important;
            margin-bottom: 15px !important;
        }
        .welcome-one__img-s2 {
            display: block !important;
            width: 100% !important;
            margin-top: 10px !important;
        }
        .welcome-one__img-s2 img {
            width: 100% !important;
            height: auto !important;
            border-radius: 15px !important;
        }
        h3.ddd {
            font-size: 18px !important;
            padding: 10px 14px !important;
        }
    }

/* Header Top Social Icons - Footer Style - Compact */
.main-header-three__top-right-social {
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.main-header-three__top-right-social a {
    position: relative !important;
    height: 24px !important;
    width: 24px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #fff !important;
    font-size: 11px !important;
    border-radius: 50% !important;
    transition: all 400ms ease !important;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
}

.main-header-three__top-right-social a:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25) !important;
}

.main-header-three__top-right-social a.facebook { background: #1877F2 !important; }
.main-header-three__top-right-social a.twitter { background: #000000 !important; }
.main-header-three__top-right-social a.instagram { background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%) !important; }
.main-header-three__top-right-social a.linkedin { background: #0077B5 !important; }
.main-header-three__top-right-social a.youtube { background: #FF0000 !important; }
.main-header-three__top-right-social a.whatsapp { background: #25D366 !important; }


@keyframes slideUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>


<?php
// Fetch real notifications from database
$notif_data = sqlfetch("SELECT * FROM notifications ORDER BY id DESC LIMIT 10");
$notif_count = count($notif_data);
?>
<!-- Notification Bell UI -->
<div class="notification-bell" onclick="toggleNotifPanel()">
    <i class="fa fa-bell"></i>
    <?php if($notif_count > 0) { ?>
        <span id="bell-count" class="bell-badge"><?php echo $notif_count; ?></span>
    <?php } ?>
</div>

<!-- Notification Panel -->
<div id="notifPanel" class="notif-panel">
    <div class="notif-header">
        <span>Notifications</span>
        <i class="fa fa-times" onclick="toggleNotifPanel()" style="cursor:pointer;"></i>
    </div>
    <div class="notif-list">
        <?php if($notif_count > 0) { 
            foreach($notif_data as $nt) { ?>
            <div class="notif-item" onclick="window.location.href='<?php echo $nt['link'] ?: '#'; ?>'">
                <p><strong><?php echo $nt['title']; ?></strong> <?php echo $nt['message']; ?></p>
                <span><?php echo date('d M, h:i A', strtotime($nt['created_at'])); ?></span>
            </div>
            <?php } 
        } else { ?>
            <div class="notif-item"><p>No new notifications</p></div>
        <?php } ?>
    </div>
</div>

<script>
function toggleNotifPanel() {
    var panel = document.getElementById('notifPanel');
    panel.classList.toggle('active');
    
    // Also trigger native permission if not already granted
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }
}

function requestNotification() {
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    } else if (Notification.permission === "granted") {
        showLocalNotification("A2P Realtech", "You are already subscribed to our latest updates!");
    } else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(function (permission) {
            if (permission === "granted") {
                showLocalNotification("Welcome!", "Thank you for subscribing to A2P Realtech. You will now receive property updates.");
            }
        });
    } else {
        alert("Notifications are blocked. Please enable them in browser settings.");
    }
}

function showLocalNotification(title, body) {
    if ('serviceWorker' in navigator && Notification.permission === 'granted') {
        navigator.serviceWorker.ready.then(function(registration) {
            registration.showNotification(title, {
                body: body,
                icon: '<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>',
                badge: '<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>',
                vibrate: [200, 100, 200]
            });
        });
    } else {
        new Notification(title, { body: body });
    }
}

// Force rebuild mobile menu on load to ensure it's not hidden
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var desktopMenu = document.querySelector('.main-menu__list');
        var mobileContainer = document.querySelector('.mobile-nav__container');
        if (desktopMenu && mobileContainer && mobileContainer.children.length === 0) {
            var clone = desktopMenu.cloneNode(true);
            clone.style.display = 'block';
            mobileContainer.appendChild(clone);
            console.log("Mobile menu rebuilt manually.");
        }
    }, 500);
});
</script>


    <div class="page-wrapper">
        <header class="main-header-two clearfix">
            <div class="main-header-three__top">
                <div class="container">
                    <div class="main-header-three__top-inner clearfix">
                        <div class="main-header-three__top-left">
                            <ul class="list-unstyled main-header-three__top-address">
                                <li>
                                    <div class="icon">
                                        <span class="icon-pin"></span>
                                    </div>
                                    <div class="text">
                                        <p> <?php echo $pr_add['addr']; ?></p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="main-header-three__top-right">
                            <div class="main-header-three__top-right-content">
                                <ul class="list-unstyled main-header-three__top-right-menu">

                                    <li><a href="#">About Us</a></li>
                                </ul>
                                <div class="main-header-three__top-right-social">
                                    <a href="<?php echo $pr_add['facebook']; ?>" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="<?php echo $pr_add['twitter']; ?>" class="twitter" target="_blank"><i class="fab fa-x-twitter"></i></a>
                                    <a href="<?php echo $pr_add['instagram']; ?>" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="<?php echo $pr_add['youtube']; ?>" class="youtube" target="_blank"><i class="fab fa-youtube"></i></a>
                                    <a href="<?php echo $pr_add['linkedin']; ?>" class="linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://api.whatsapp.com/send?phone=91<?php echo $pr_add['phone']; ?>" class="whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <nav class="main-menu main-menu-two clearfix">
                <div class="main-menu-two__wrapper clearfix">
                    <div class="main-menu-two__left">
                        <div class="main-menu-two__logo">
                            <a href="<?= SITE_URL; ?>">
                                <img src="<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>" class="light-logo bg-white" alt="">

                            </a>
                        </div>
                    </div>
                       <div class="main-menu-two__main-menu-two-box">
                            <div class="main-menu-two__main-menu-two-inner">
                                <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                <ul class="main-menu__list">
                                    <li class="current">
                                        <a href="<?= SITE_URL; ?>">Home </a>

                                    </li>

                                    <li class="dropdown">
                                        <a href="<?= SITE_URL; ?>about.php">About Us </a>
                                        <ul>

                                            <li><a href="<?= SITE_URL; ?>vision.php">Vision</a></li>
                                            <li><a href="<?= SITE_URL; ?>mission.php">Mission</a></li>
                                            <li><a href="<?= SITE_URL; ?>feedback.php">Customer Feedback</a></li>




                                        </ul>
                                    </li>
<?php 
                                        $result = sqlfetch("SELECT * FROM category WHERE actstat=1 ORDER BY fld_order LIMIT 0,5");
                                        if (count($result)) {
                                            foreach ($result as $category) {
                                        ?>
                                                <li class="dropdown">
                                                    <a href="#"><?php echo $category['name']; ?></a>
                                                    <?php 
                                                        $sub_cat = sqlfetch("SELECT * FROM subcategory WHERE subcat='" . $category['id'] . "'");
                                                        if (count($sub_cat)) { // Check if subcategories exist
                                                    ?>
                                                        <ul class="hffffff">
                                                            <?php foreach ($sub_cat as $subproduct) { ?>
                                                                <li>
                                                                    <a href="<?= SITE_URL; ?>service_list/<?php echo makeurlnamebynameCategory($subproduct['slug']); ?>.php">
                                                                        <?php echo $subproduct['name']; ?>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                        <?php 
                                            }
                                        } 
                                        ?>

                                    <li>
                                        <a href="javascript:void(0)" onclick="openWizard()"><span style="display:inline-flex;align-items:center;gap:6px;"><i class="fa fa-map-marker-alt"></i> By Location</span></a>
                                    </li>












                                    <li><a href="<?= SITE_URL; ?>media-gallery.php">Media Gallery</a></li>

                                    <!--<li><a href="<?= SITE_URL; ?>blog.php">Blog </a></li>-->

                                    <li><a href="<?= SITE_URL; ?>contact.php">Contact Us </a></li>
                                </ul>
                            </div>
                        </div>
                    <div class="main-menu-two__right">


                        <div class="main-menu-two__call-search">

                            <div class="main-menu-two__call">
                               <button type="button" class="thm-btn" onclick="window.location.href='<?= SITE_URL; ?>search.php'">
                                    <i class="icon-magnifying-glass"></i>
                                </button>


                            </div>

                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu main-menu-two">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

<?php require('include/location_wizard.php'); ?>
        
        
        
        
        
        

        
        
        
        
        