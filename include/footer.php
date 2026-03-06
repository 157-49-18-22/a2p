<!--Site Footer Start-->

<style>
    .footer-widget__title {
        color: black;
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .footer-widget__title:before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 35px;
        height: 3px;
        background: #c00415;
    }

    .footer-widget__explore-list li a {
        color: black;
        transition: all 0.3s ease;
    }
    
    .footer-widget__explore-list li a:hover {
        color: #c00415;
        padding-left: 5px;
    }

    .footer-widget__services-list li a {
        color: #000000;
        transition: all 0.3s ease;
    }
    
    .footer-widget__services-list li a:hover {
        color: #c00415;
        padding-left: 5px;
    }

    .footer-widget__contact-list li .text h5 {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #666;
        margin-bottom: 4px;
    }

    .footer-widget__contact-list li .text p {
        color: #000000;
        font-weight: 600;
        line-height: 1.5;
    }

    .footer-widget__contact-list li .text p a {
        color: #000000;
        transition: color 0.3s;
    }
    
    .footer-widget__contact-list li .text p a:hover {
        color: #c00415;
    }

    .footer-widget__about-text {
        color: #444;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .site-footer-two .site-footer__top {
        box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
        padding: 80px 0 50px;
    }

    .footer-widget__logo img {
        max-height: 80px;
        width: auto !important;
        object-fit: contain;
    }

    .footer-widget__contact-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 15px;
    }

    .footer-widget__contact-list li .icon {
        width: 45px;
        height: 45px;
        background: #c00415;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff !important;
        font-size: 18px;
        flex-shrink: 0;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(192, 4, 21, 0.2);
    }

    .footer-widget__contact-list li .icon span,
    .footer-widget__contact-list li .icon i {
        color: #fff !important;
    }

    .footer-widget__contact-list li:hover .icon {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 15px rgba(192, 4, 21, 0.3);
    }

    .footer-widget__contact {
        margin-left: 0 !important;
    }

    .logo-box img {
        width: 155px !important;
        height: auto !important;
        object-fit: contain !important;
    }

    /* Colorful Footer Social Icons */
    .site-footer__social a {
        background: #333 !important; /* Default */
        color: #fff !important;
        transition: all 0.3s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 44px !important;
        height: 44px !important;
        border-radius: 50% !important;
        margin-right: 8px !important;
        font-size: 20px !important;
        text-decoration: none !important;
    }

    .site-footer__social a.facebook { background-color: #1877F2 !important; }
    .site-footer__social a.twitter { background-color: #000 !important; }
    .site-footer__social a.instagram { 
        background: #f09433 !important;
        background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d) !important;
        background-image: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d) !important;
    }
    .site-footer__social a.linkedin { background-color: #0077B5 !important; }
    .site-footer__social a.youtube { background-color: #FF0000 !important; }
    .site-footer__social a.whatsapp { background-color: #25D366 !important; }

    .site-footer__social a:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
        opacity: 0.9 !important;
    }
</style>

<!-- Location Permission Modal -->
<div id="location-modal">
    <div class="loc-modal-card">
        <div class="loc-icon-pulse">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <h3>Location Permission</h3>
        <p>To provide you with the best real estate service in your city, please <strong>Allow Location Permission</strong> in the next step.</p>
        <button id="give-loc-permission" class="loc-btn-primary">Allow Permission & Continue</button>
    </div>
</div>

<!-- PWA Install Modal (Global) - Appears on Startup -->
<div id="pwa-install-modal">
    <div class="pwa-modal-card">
        <div class="pwa-icon-box">
            <img src="<?php echo SITE_URL; ?>assets/images/favicons/android-chrome-192x192.png" alt="App Logo">
        </div>
        <h3>Install Our App</h3>
        <p>Stay updated with the latest property listings and real-time alerts. Install the A2P Realtech app on your home screen today!</p>
        
        <button id="pwa-main-btn" onclick="handlePwaInstallClick()" class="pwa-btn-install">
            <i class="fas fa-download"></i> <span>INSTALL NOW</span>
        </button>
        
        <a href="javascript:void(0)" onclick="closePwaModal()" class="pwa-close-link">Maybe Later</a>
    </div>
</div>

<style>
    /* Global Modals Base Styles */
    #location-modal, #pwa-install-modal {
        position: fixed; top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.85);
        display: none; align-items: center; justify-content: center;
        z-index: 2000001; backdrop-filter: blur(10px);
        font-family: 'Poppins', sans-serif;
    }

    /* Shared Modal Cards Style */
    .loc-modal-card, .pwa-modal-card {
        background: #fff; padding: 40px 30px;
        border-radius: 24px; text-align: center;
        max-width: 420px; width: 90%;
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        animation: pwaModalPop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes pwaModalPop {
        from { opacity: 0; transform: scale(0.8) translateY(30px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    /* Icon Pulse Styles */
    .loc-icon-pulse, .pwa-icon-box {
        width: 90px; height: 90px;
        background: #fdf2f2; border-radius: 22%;
        display: inline-flex; align-items: center; justify-content: center;
        margin-bottom: 25px; position: relative;
    }
    .loc-icon-pulse { color: #c00415; font-size: 35px; border-radius: 50%; }
    .pwa-icon-box img { width: 60px; height: 60px; border-radius: 12px; }

    .loc-icon-pulse::after, .pwa-icon-box::after {
        content: ''; position: absolute;
        top: -5px; left: -5px; right: -5px; bottom: -5px;
        border: 2px solid #c00415; border-radius: 25%;
        animation: pwaPulse 2s infinite;
    }
    .loc-icon-pulse::after { border-radius: 50%; }

    @keyframes pwaPulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.3); opacity: 0; }
    }

    .loc-modal-card h3, .pwa-modal-card h3 { color: #222; font-weight: 800; font-size: 24px; margin-bottom: 12px; }
    .loc-modal-card p, .pwa-modal-card p { color: #666; font-size: 15px; line-height: 1.6; margin-bottom: 30px; }

    .loc-btn-primary, .pwa-btn-install {
        background: #c00415; color: #fff; border: none;
        padding: 16px 30px; border-radius: 50px;
        font-weight: 700; cursor: pointer; width: 100%;
        font-size: 16px; transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(192,4,21,0.3);
    }
    .loc-btn-primary:hover, .pwa-btn-install:hover { background: #000; transform: translateY(-3px); }

    .pwa-close-link {
        display: block; margin-top: 20px; color: #999;
        text-decoration: none; font-size: 13px; font-weight: 600;
        transition: color 0.3s;
    }
    .pwa-close-link:hover { color: #c00415; }
</style>

<footer class="site-footer site-footer-two">
    <div class="site-footer-bg" style="background:white;">
    </div>
    <div class="site-footer__top">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <div class="footer-widget__column footer-widget__about">
                        <div class="footer-widget__logo">
                            <a href="<?= SITE_URL; ?>"><img src="<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>" alt="Logo"></a>
                        </div>
                        <div class="footer-widget__about-text-box">
                            <p class="footer-widget__about-text">A2P Realtech is setting new standards for excellence and transforming the way real estate services are delivered.</p>
                        </div>
                        <div class="site-footer__social">
                            <a href="<?php echo $pr_add['facebook']; ?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="<?php echo $pr_add['twitter']; ?>" class="twitter"><i class="fab fa-x-twitter"></i></a>
                            <a href="<?php echo $pr_add['youtube']; ?>" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="<?php echo $pr_add['linkedin']; ?>" class="youtube"><i class="fab fa-youtube"></i></a>
                            <a href="<?php echo $pr_add['linkedin2']; ?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://api.whatsapp.com/send?phone=918130525001" class="whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <!--<div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">-->
                <!--    <div class="footer-widget__column footer-widget__explore clearfix">-->
                <!--        <h3 class="footer-widget__title">Projects</h3>-->
                <!--        <ul class="footer-widget__explore-list list-unstyled clearfix">-->
                <!--            <li><a href="<?= SITE_URL; ?>residential.php">Residential</a></li>-->
                <!--            <li><a href="<?= SITE_URL; ?>commercial.php">Commercial</a></li>-->
                            

                <!--        </ul>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                    <div class="footer-widget__column footer-widget__services clearfix">
                        <h3 class="footer-widget__title">Quicklinks</h3>
                        <ul class="footer-widget__services-list list-unstyled clearfix">


                            
                                    <li><a href="<?= SITE_URL; ?>sitemap.html">Site Map </a></li>
                                    <li><a href="<?= SITE_URL; ?>terms_conditions.php">Terms And Conditions </a></li>
                                    <li><a href="<?= SITE_URL; ?>privacy_policy.php">Privacy Policy </a></li>
                                    <li><a href="<?= SITE_URL; ?>blog.php">Blog </a></li>
                                    <li><a href="<?= SITE_URL; ?>contact.php">Contact Us </a></li>
                                    <li><a href="<?= SITE_URL; ?>career.php">Career </a></li>

                            

                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                    <div class="footer-widget__column footer-widget__contact clearfix">
                        <h3 class="footer-widget__title">Contact</h3>
                        <ul class="footer-widget__contact-list list-unstyled clearfix">
                            <li>
                                <div class="icon">
                                    <span class="icon-phone-call"></span>
                                </div>
                                <div class="text">
                                    <h5>Call anytime</h5>
                                    <p><a href="tel:+91-8130525001">+91-8130525001</a></p>
                                    <p><a href="tel:+91-8130510678">+91-8130510678</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-message"></span>
                                </div>
                                <div class="text">
                                    <h5>Send email</h5>
                                    <p><a href="mailto:<?php echo $pr_add['email']; ?>"><?php echo $pr_add['email']; ?></a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-location"></span>
                                </div>
                                <div class="text">
                                    <h5>Address</h5>
                                    <p><?php echo $pr_add['addr']; ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-footer__bottom-inner">
                        <p class="site-footer__bottom-text">© Copyright  by <a href="<?= SITE_URL; ?>">A2P Realtech</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Site Footer End-->


</div>


<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

        <div class="logo-box">
            <a href="<?= SITE_URL; ?>" aria-label="logo image"><img src="<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>"
                    width="155" alt="" /></a>
        </div>
        <!-- /.logo-box -->
        <style>
            .mobile-nav__search-box {
                padding: 20px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.08);
            }
            .mobile-nav__search-box form {
                position: relative;
                display: flex;
                align-items: center;
                background: rgba(255,255,255,0.1) !important;
                border-radius: 12px;
                padding: 2px;
                border: 1px solid rgba(255,255,255,0.1) !important;
                box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
                overflow: hidden;
            }
            .mobile-nav__search-box button {
                position: absolute;
                left: 5px; /* Moved to left */
                top: 5px;
                bottom: 5px;
                width: 40px;
                background: #fff !important;
                border-radius: 8px;
                color: #c00415 !important;
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s;
                z-index: 2;
            }
            .mobile-nav__search-box input {
                flex: 1;
                background: transparent;
                border: none;
                color: #fff !important;
                padding: 12px 15px 12px 50px; /* Space on left for button */
                font-size: 14px;
                outline: none !important;
                width: 100%;
                z-index: 1;
            }
            .mobile-nav__search-box form:focus-within button {
                color: #c00415;
            }
            .mobile-nav__search-box input::placeholder {
                color: rgba(255,255,255,0.5);
                transition: all 0.3s;
            }
            .mobile-nav__search-box form:focus-within input::placeholder {
                color: #999;
            }
        </style>

        <div class="mobile-nav__search-box">
            <form action="<?= SITE_URL; ?>search_result.php" method="GET">
                <input type="text" name="query" placeholder="Search for property..." required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="mobile-nav__container"></div>
        <!-- /.mobile-nav__container -->

        <!-- Attractive Phone Card -->
        <div class="mobile-phone-card">
            <div class="mobile-phone-card__icon">
                <i class="fa fa-phone-alt"></i>
            </div>
            <div class="mobile-phone-card__text">
                <span>Call Us Anytime</span>
                <?php
                    $phone_raw = $pr_add['phone'];
                    // Split numbers if they are comma-separated
                    $phone_arr = explode(',', $phone_raw);
                    foreach($phone_arr as $p) {
                        $p = trim($p);
                        if(empty($p)) continue;
                        
                        // Remove +91 prefix for display
                        $display = preg_replace('/^\+91[-\s]?/', '', $p);
                        // Keep only digits from the prefix-removed string
                        $digits = preg_replace('/[^0-9]/', '', $display);
                        
                        echo '<a href="tel:+91'.$digits.'" style="display:block; margin-top:2px; letter-spacing:1px; color:#fff !important; position:relative; z-index:5;">'.$display.'</a>';
                    }
                ?>
            </div>
        </div>
        <style>
        .mobile-phone-card {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 0 15px 5px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 14px;
            padding: 12px 16px;
            backdrop-filter: blur(5px);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .mobile-phone-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(255,255,255,0.05) 0%, transparent 60%);
            animation: phonePulse 3s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes phonePulse {
            0%, 100% { opacity: 0.5; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1); }
        }
        .mobile-phone-card__icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #c00415, #ff2d3d);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(192,4,21,0.4);
            animation: phoneRing 2.5s ease-in-out infinite;
        }
        @keyframes phoneRing {
            0%, 100% { transform: rotate(0deg); }
            10% { transform: rotate(-15deg); }
            20% { transform: rotate(15deg); }
            30% { transform: rotate(-10deg); }
            40% { transform: rotate(10deg); }
            50% { transform: rotate(0deg); }
        }
        .mobile-phone-card__text {
            display: flex;
            flex-direction: column;
            line-height: 1.3;
        }
        .mobile-phone-card__text span {
            font-size: 10px;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .mobile-phone-card__text a {
            font-size: 15px;
            color: #fff !important;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
        }
        .mobile-phone-card__text a:hover {
            color: #ffcdd2 !important;
        }
        </style>
        <div class="mobile-nav__top">
            <div class="mobile-nav__social">
                <a href="<?php echo $pr_add['facebook']; ?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="<?php echo $pr_add['youtube']; ?>" class="instagram"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo $pr_add['linkedin']; ?>" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="<?php echo $pr_add['linkedin2']; ?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://api.whatsapp.com/send?phone=918130525001" class="whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div><!-- /.mobile-nav__social -->
        </div><!-- /.mobile-nav__top -->



    </div>
    <!-- /.mobile-nav__content -->
</div>


<style>
/* Premium Search Popup Redesign */
.search-popup {
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.search-popup__content {
    max-width: 800px !important;
    width: 90%;
    margin: 0 auto;
    position: relative;
}

.search-popup form {
    position: relative;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 60px;
    padding: 10px 15px;
    display: flex;
    align-items: center;
    transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.search-popup form:focus-within {
    background: rgba(255, 255, 255, 1);
    border-color: #c00415;
    box-shadow: 0 0 50px rgba(192, 4, 21, 0.3);
    transform: scale(1.02);
}

.search-popup input[type="text"] {
    background: transparent !important;
    color: #fff !important;
    font-size: 26px !important;
    font-weight: 600 !important;
    padding: 15px 30px !important;
    border: none !important;
    flex: 1;
    letter-spacing: 0.5px;
}

.search-popup form:focus-within input[type="text"] {
    color: #222 !important;
}

.search-popup .thm-btn {
    width: 60px !important;
    height: 60px !important;
    border-radius: 50% !important;
    background: #c00415 !important;
    color: #fff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.4s ease !important;
    padding: 0 !important;
    box-shadow: 0 8px 15px rgba(192, 4, 21, 0.3) !important;
}

.search-popup .thm-btn:hover {
    transform: rotate(90deg) scale(1.1) !important;
    background: #900010 !important;
}

.search-popup .thm-btn i {
    font-size: 22px !important;
}

/* Close button enhancement */
.mobile-nav__close.search-toggler {
    font-size: 35px;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    top: 30px;
    right: 30px;
}

.mobile-nav__close.search-toggler:hover {
    color: #c00415;
    transform: rotate(90deg);
}

.popup-tagline {
    color: #c00415;
    text-align: center;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 20px;
    font-size: 14px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease 0.2s;
}

.search-popup.active .popup-tagline {
    opacity: 1;
    transform: translateY(0);
}
</style>

<div class="search-popup">
    <div class="search-popup__overlay search-toggler"></div>
    <div class="search-popup__content">
        <div class="popup-tagline">Experience the future of property search</div>
        <form action="<?= SITE_URL; ?>search_result.php" method="GET" onsubmit="return checkSearchRedirect(this)">
            <input type="text" id="search" name="query" placeholder="Tell us what you're looking for..." autocomplete="off" />
            <button type="submit" aria-label="search submit" class="thm-btn">
                <i class="icon-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>

<!-- Location Permission Modal -->
<div id="location-modal">
    <div class="loc-modal-card">
        <div class="loc-icon-pulse">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <h3>Permission Required</h3>
        <p>To ensure we provide the best real estate service in your area, please <strong>Allow Location Permission</strong> in the next step.</p>
        <button id="give-loc-permission" class="loc-btn-primary">Give Permission & Continue</button>
    </div>
</div>

<script>
function checkSearchRedirect(form) {
    var queryField = form.querySelector('[name="query"]');
    var query = queryField ? queryField.value.trim() : '';
    if (!query) return true;

    // Phone: 5+ consecutive digits
    var digitsOnly = query.replace(/[\s\-\(\)\+]/g, '');
    var isPhone = /\d{5,}/.test(digitsOnly);

    // Email pattern
    var isEmail = /[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/.test(query);

    if (isPhone || isEmail) {
        window.location.href = '<?= SITE_URL; ?>contact.php';
        return false;
    }
    return true;
}
</script>
<script>
    document.getElementById('search-button').addEventListener('click', function() {
        var searchBar = document.getElementById('search-bar');

        if (searchBar.style.display === "none" || searchBar.style.display === "") {
            searchBar.style.display = "block";
        } else {
            searchBar.style.display = "none";
        }
    });
</script>




<!-- Premium AI Chatbot Widget -->
<div id="a2p-chatbot">
    <!-- Chat Button -->
    <div id="chat-button" onclick="toggleChat()">
        <i class="fas fa-robot"></i>
        <span class="chat-badge">1</span>
    </div>

    <!-- Chat Window -->
    <div id="chat-window">
        <div class="chat-header">
            <div class="bot-info">
                <div class="bot-avatar">
                   <img src="<?= SITE_URL; ?>assets/images/favicons/favicon.ico" alt="A2P Bot">
                </div>
                <div class="bot-details">
                    <h6>A2P Assistant</h6>
                    <small>Online | Instant Response</small>
                </div>
            </div>
            <button class="close-chat" onclick="toggleChat()">&times;</button>
        </div>
        
        <div class="chat-body" id="chat-messages">
            <div class="bot-msg">
                <p>Hello! Welcome to <strong>A2P Realtech</strong>. How can I help you find your dream property today?</p>
            </div>
            <div class="bot-options">
                <button onclick="handleBotOption('buy')"><i class="fas fa-building"></i> Buy Property</button>
                <button onclick="handleBotOption('offers')"><i class="fas fa-fire"></i> Latest Offers</button>
                <button onclick="handleBotOption('location')"><i class="fas fa-map-marker-alt"></i> Search by Location</button>
                <button onclick="handleBotOption('contact')"><i class="fas fa-headset"></i> Talk to Expert</button>
            </div>
        </div>

        <div class="chat-footer">
            <input type="text" id="user-input" placeholder="Type your query..." onkeypress="handleKeyPress(event)">
            <button onclick="sendMessage()"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<style>
/* Chat Bot Styling - Using #a2p-chatbot prefix for specificity */
#a2p-chatbot {
    position: fixed !important;
    bottom: 105px !important;
    right: 20px !important;
    z-index: 10001 !important;
    font-family: 'Poppins', sans-serif !important;
}

#a2p-chatbot * {
    box-sizing: border-box !important;
}

#a2p-chatbot #chat-button {
    width: 60px !important;
    height: 60px !important;
    background: #000 !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #fff !important;
    font-size: 24px !important;
    cursor: pointer !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3) !important;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    position: relative !important;
}

#a2p-chatbot #chat-button:hover {
    transform: scale(1.1) rotate(10deg) !important;
    background: #c00415 !important;
}

#a2p-chatbot .chat-badge {
    position: absolute !important;
    top: -5px !important;
    right: -5px !important;
    background: #c00415 !important;
    color: #fff !important;
    width: 22px !important;
    height: 22px !important;
    border-radius: 50% !important;
    font-size: 12px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 2px solid #fff !important;
}

#a2p-chatbot #chat-window {
    position: absolute !important;
    bottom: 80px !important;
    right: 0 !important;
    width: 320px !important;
    height: 450px !important;
    background: #fff !important;
    border-radius: 15px !important;
    display: none;
    flex-direction: column !important;
    overflow: hidden !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
    animation: chatbotSlideIn 0.3s ease-out !important;
}

@keyframes chatbotSlideIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

#a2p-chatbot .chat-header {
    background: #c00415 !important;
    padding: 15px !important;
    color: #fff !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    width: 100% !important;
}

#a2p-chatbot .bot-info {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

#a2p-chatbot .bot-avatar img {
    width: 35px !important;
    height: 35px !important;
    border-radius: 50% !important;
    background: #fff !important;
    padding: 2px !important;
}

#a2p-chatbot .bot-details h6 { 
    margin: 0 !important; 
    padding: 0 !important; 
    font-size: 15px !important; 
    font-weight: 700 !important; 
    color: #fff !important; 
    line-height: 1.2 !important; 
    display: block !important;
    text-align: left !important;
    text-transform: none !important;
    letter-spacing: normal !important;
    width: auto !important;
}
#a2p-chatbot .bot-details small { 
    margin: 3px 0 0 0 !important; 
    padding: 0 !important; 
    font-size: 11px !important; 
    opacity: 0.9 !important; 
    color: #fff !important; 
    display: block !important;
    line-height: 1 !important;
    text-align: left !important;
    text-transform: none !important;
    width: auto !important;
    white-space: nowrap !important;
}

#a2p-chatbot .close-chat {
    background: none !important;
    border: none !important;
    color: #fff !important;
    font-size: 24px !important;
    cursor: pointer !important;
    padding: 0 !important;
    line-height: 1 !important;
}

#a2p-chatbot .chat-body {
    flex: 1 !important;
    padding: 15px !important;
    overflow-y: auto !important;
    background: #f9f9f9 !important;
    display: flex !important;
    flex-direction: column !important;
}

#a2p-chatbot .bot-msg {
    background: #fff !important;
    padding: 10px 15px !important;
    border-radius: 12px 12px 12px 2px !important;
    margin-bottom: 15px !important;
    font-size: 13px !important;
    line-height: 1.5 !important;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05) !important;
    color: #333 !important;
    width: fit-content !important;
    max-width: 90% !important;
}

#a2p-chatbot .user-msg {
    background: #000 !important;
    color: #fff !important;
    padding: 10px 15px !important;
    border-radius: 12px 12px 2px 12px !important;
    margin-bottom: 15px !important;
    font-size: 13px !important;
    align-self: flex-end !important;
    text-align: right !important;
    margin-left: 20% !important;
    width: fit-content !important;
    max-width: 80% !important;
}

#a2p-chatbot .user-msg p, 
#a2p-chatbot .bot-msg p {
    color: inherit !important;
    margin: 0 !important;
    padding: 0 !important;
}

#a2p-chatbot .bot-options {
    display: flex !important;
    flex-direction: column !important;
    gap: 8px !important;
    margin-bottom: 15px !important;
}

#a2p-chatbot .bot-options button {
    background: #fff !important;
    border: 1px solid #c00415 !important;
    color: #c00415 !important;
    padding: 8px 15px !important;
    border-radius: 20px !important;
    font-size: 13px !important;
    text-align: left !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    width: 100% !important;
    margin: 0 !important;
    font-family: inherit !important;
    text-transform: none !important;
    font-weight: normal !important;
    height: auto !important;
    min-height: 0 !important;
    line-height: 1.4 !important;
}

#a2p-chatbot .bot-options button:hover {
    background: #c00415 !important;
    color: #fff !important;
}

#a2p-chatbot .permission-btn {
    background: #c00415 !important;
    color: #fff !important;
    border: none !important;
    padding: 10px 20px !important;
    border-radius: 25px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    width: 100% !important;
    margin-top: 5px !important;
    font-size: 14px !important;
    height: auto !important;
}

#a2p-chatbot .permission-btn:hover {
    background: #000 !important;
    transform: translateY(-2px) !important;
}

#a2p-chatbot .chat-footer {
    padding: 10px !important;
    border-top: 1px solid #eee !important;
    display: flex !important;
    gap: 5px !important;
    background: #fff !important;
    align-items: center !important;
}

#a2p-chatbot .chat-footer input {
    flex: 1 !important;
    border: none !important;
    padding: 8px 12px !important;
    font-size: 13px !important;
    outline: none !important;
    background: #fff !important;
    margin: 0 !important;
    width: auto !important;
    height: auto !important;
    color: #333 !important;
    line-height: normal !important;
    box-shadow: none !important;
}

#a2p-chatbot .chat-footer button {
    background: #c00415 !important;
    color: #fff !important;
    border: none !important;
    width: 35px !important;
    height: 35px !important;
    border-radius: 50% !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    margin: 0 !important;
}

#a2p-chatbot .chat-footer button i {
    font-size: 14px !important;
}

/* Adjust WhatsApp Button Position */
.float-whatsapp {
    bottom: 150px !important;
}

@media (max-width: 768px) {
    #a2p-chatbot #chat-window {
        width: 280px !important;
        height: 400px !important;
        right: 0 !important;
    }
    #a2p-chatbot {
        bottom: 110px !important;
        right: 15px !important;
    }
}
</style>

<script>
function toggleChat() {
    const window = document.getElementById('chat-window');
    const badge = document.querySelector('.chat-badge');
    if (window.style.display === 'flex') {
        window.style.display = 'none';
    } else {
        window.style.display = 'flex';
        badge.style.display = 'none';
    }
}

let chatbotState = {
    step: 0,
    needDetails: false,
    data: { name: '', email: 'N/A', phone: '', interest: 'General Setup', budget: 'Not Specified', message: 'Chatbot User Inquiry', city: 'Not Shared', lat_long: '' }
};

async function getCityName() {
    return new Promise((resolve) => {
        const modal = document.getElementById('location-modal');
        const btn = document.getElementById('give-loc-permission');
        
        const detectLocation = async () => {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    modal.style.display = 'none';
                    try {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;
                        const coordsText = `${lat}, ${lon}`;
                        const resp = await fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`);
                        const data = await resp.json();
                        resolve({ 
                            city: data.city || data.locality || "Unknown",
                            lat_long: coordsText
                        });
                    } catch (e) {
                        resolve({ city: "Unknown", lat_long: "" });
                    }
                }, async (error) => {
                    // STRICT: If denied, we return empty/denied. No automatic IP fallback.
                    modal.style.display = 'none';
                    resolve({ city: "Denied/Error", lat_long: "" });
                }, { timeout: 10000 });
            } else {
                modal.style.display = 'none';
                resolve({ city: "Not Supported", lat_long: "" });
            }
        };

        // Always show our custom modal first to force user interaction
        modal.style.display = 'flex';
        btn.innerHTML = 'Give Permission & Continue';
        btn.onclick = () => {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Initializing...';
            detectLocation();
        };
    });
}

function handleBotOption(option) {
    let msg = "";
    
    if(option === 'buy') {
        msg = "I'm looking to buy a property.";
        chatbotState.data.interest = "Residential/Commercial";
    } else if(option === 'offers') {
        msg = "Show me the latest offers.";
        chatbotState.data.interest = "Latest Offers";
    } else if(option === 'location') {
        msg = "I want to search by location.";
        chatbotState.data.interest = "Search Location";
    } else if(option === 'contact') {
        msg = "I want to talk to an expert.";
        chatbotState.data.interest = "Talk to Expert";
    }

    addMessage(msg, 'user');
    
    setTimeout(() => {
        addMessage("To assist you better, could you please tell me your <strong>Full Name</strong>?", 'bot');
        chatbotState.step = 1;
        chatbotState.needDetails = true;
    }, 1000);
}

function processChatInput(text) {
    if(!chatbotState.needDetails) {
        chatbotState.data.message = text;
        chatbotState.needDetails = true;
        chatbotState.step = 1;
        setTimeout(() => {
            addMessage("Thanks! May I know your <strong>Full Name</strong> to assist you better?", 'bot');
        }, 800);
        return;
    }

    if(chatbotState.step === 1) {
        chatbotState.data.name = text;
        chatbotState.step = 2;
        setTimeout(() => {
            addMessage("Nice to meet you, " + text + "! Please provide your <strong>Phone Number</strong> so our expert can connect with you.", 'bot');
        }, 800);
    } else if(chatbotState.step === 2) {
        chatbotState.data.phone = text;
        chatbotState.step = 3;
        setTimeout(() => {
            addMessage("Got it! Lastly, what is your <strong>Email ID</strong>?", 'bot');
        }, 800);
    } else if(chatbotState.step === 3) {
        chatbotState.data.email = text;
        chatbotState.step = 4;
        
        // Send OTP
        sendChatbotOtp(chatbotState.data.email, chatbotState.data.name);

        setTimeout(() => {
            addMessage("To verify your email, I've sent a <strong>6-digit OTP</strong> to " + text + ". Please enter the code below to continue.", 'bot');
        }, 800);
    } else if(chatbotState.step === 4) {
        // Verify OTP
        verifyChatbotOtp(text);
    }
}

async function sendChatbotOtp(email, name) {
    const formData = new FormData();
    formData.append('email', email);
    formData.append('name', name);
    try {
        await fetch('<?= SITE_URL; ?>function/send_otp.php', { method: 'POST', body: formData });
    } catch (e) { console.error("OTP Send Error:", e); }
}

async function verifyChatbotOtp(otp) {
    const formData = new FormData();
    formData.append('otp', otp);
    formData.append('email', chatbotState.data.email);
    
    try {
        const resp = await fetch('<?= SITE_URL; ?>function/verify_otp.php', { method: 'POST', body: formData });
        const data = await resp.json();
        
        if(data.status === 'success') {
            addMessage('<i class="fas fa-check-circle"></i> OTP Verified Successfully!', 'bot');
            chatbotState.step = 5;
            setTimeout(() => {
                addMessage("Perfect! One last thing! Please <strong>Allow Location Permission</strong> to help us tailor the best properties for your area.", 'bot');
                
                // Show custom permission button in chatbot ui
                const chatBody = document.getElementById('chat-messages');
                const div = document.createElement('div');
                div.className = 'bot-options';
                div.style.marginTop = '10px';
                div.id = 'location-permission-btn';
                div.innerHTML = `<button onclick="handleLocationPermission()" class="permission-btn"><i class="fas fa-map-marker-alt"></i> Share My City & Finish</button>`;
                chatBody.appendChild(div);
                chatBody.scrollTop = chatBody.scrollHeight;
            }, 800);
        } else {
            addMessage('<i class="fas fa-exclamation-triangle"></i> Invalid OTP. Please enter the correct 6-digit code sent to your email.', 'bot');
        }
    } catch (e) { 
        console.error("OTP Verify Error:", e);
        addMessage("Error verifying OTP. Please try again.", 'bot');
    }
}

async function handleLocationPermission() {
    const locData = await getCityName(); // This will handle the modal now
    chatbotState.data.city = locData.city;
    chatbotState.data.lat_long = locData.lat_long;
    
    // Resume flow
    submitChatbotLead();
    
    setTimeout(() => {
        addMessage(`Thank you! Detected City: <strong>${locData.city}</strong>. Your details have been securely saved.`, 'bot');
        chatbotState.step = 6;
        document.querySelector('.chat-footer').style.display = 'none';
        const btnDiv = document.getElementById('location-permission-btn');
        if(btnDiv) btnDiv.remove();
    }, 500);
}

function submitChatbotLead() {
    let formData = new FormData();
    formData.append('name', chatbotState.data.name);
    formData.append('email', chatbotState.data.email);
    formData.append('phone', chatbotState.data.phone);
    formData.append('interest', chatbotState.data.interest);
    formData.append('budget', chatbotState.data.budget);
    formData.append('message', chatbotState.data.message);
    formData.append('city', chatbotState.data.city);
    formData.append('lat_long', chatbotState.data.lat_long);
    formData.append('source', 'Chatbot Widget');

    fetch('<?= SITE_URL; ?>chatbot-submit.php', {
        method: 'POST',
        body: formData
    })
    .catch(err => console.error(err));
}

function addMessage(text, type) {
    const chatBody = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.className = type === 'user' ? 'user-msg' : 'bot-msg';
    div.innerHTML = `<p>${text}</p>`;
    chatBody.appendChild(div);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
    const input = document.getElementById('user-input');
    const text = input.value.trim();
    if (text) {
        addMessage(text, 'user');
        input.value = '';
        processChatInput(text);
    }
}

function handleKeyPress(e) {
    if (e.key === 'Enter') sendMessage();
}

// Smart PWA Modal Trigger
document.addEventListener('DOMContentLoaded', () => {
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
    if (!isStandalone) {
        setTimeout(() => {
            if (typeof window.showPwaModal === 'function') {
                window.showPwaModal();
            }
        }, 4000); 
    }
});
</script>


<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>




<script src="<?= SITE_URL; ?>assets/vendors/jquery/jquery-3.6.0.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jarallax/jarallax.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-appear/jquery.appear.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/nouislider/nouislider.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/odometer/odometer.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/swiper/swiper.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/tiny-slider/tiny-slider.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/wnumb/wNumb.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/wow/wow.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/isotope/isotope.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/countdown/countdown.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/vegas/vegas.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-ui/jquery-ui.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/timepicker/timePicker.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/circleType/jquery.circleType.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/circleType/jquery.lettering.min.js"></script>


<script src="<?= SITE_URL; ?>assets/js/ambed.js"></script>

<script src="<?= SITE_URL; ?>assets/vendors/toolbar/js/js.cookie.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/toolbar/js/jQuery.style.switcher.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/toolbar/js/toolbar.js"></script>

    <!-- iOS PWA Step-by-Step Guide -->
    <div id="ios-pwa-prompt">
        <button class="ios-close" onclick="closeIOSPrompt()"><i class="fa fa-times"></i></button>

        <!-- Step 0: Main screen (before tapping steps) -->
        <div id="ios-guide-step-0" class="ios-guide-screen active">
            <img src="<?php echo SITE_URL; ?>assets/images/favicons/android-chrome-192x192.png" class="ios-icon" alt="A2P App">
            <div class="ios-title">Install A2P Realtech App</div>
            <p class="ios-text">Follow these 3 quick steps to install the app on your iPhone & get instant notifications!</p>
            <div class="ios-steps-preview">
                <div class="ios-step-preview">
                    <div class="ios-step-num">1</div>
                    <div>Tap <strong>Share</strong> <span style="color:#007aff;">⬆</span> button in Safari</div>
                </div>
                <div class="ios-step-preview">
                    <div class="ios-step-num">2</div>
                    <div>Select <strong>"Add to Home Screen"</strong></div>
                </div>
                <div class="ios-step-preview">
                    <div class="ios-step-num">3</div>
                    <div>Open the App → Tap <strong>"Allow"</strong> for notifications</div>
                </div>
            </div>
            <button class="ios-start-btn" onclick="showIOSStep(1)">
                <i class="fa fa-play-circle me-1"></i> Show Me How
            </button>
            <div class="ios-skip" onclick="closeIOSPrompt()">Maybe Later</div>
        </div>

        <!-- Step 1: Tap Share button -->
        <div id="ios-guide-step-1" class="ios-guide-screen">
            <div class="ios-step-badge">Step 1 of 3</div>
            <div class="ios-step-title">Tap the <span style="color:#007aff;">Share</span> Button</div>
            <div class="ios-phone-preview">
                <div class="ios-safari-bar">
                    <div class="ios-url-bar">pink-sheep-796549.hostingersite.com</div>
                </div>
                <div class="ios-page-content">
                    <div style="height:120px;background:linear-gradient(135deg,#c00415,#7b0010);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <img src="<?php echo SITE_URL; ?>assets/images/favicons/android-chrome-192x192.png" style="height:60px;border-radius:10px;">
                    </div>
                    <div style="height:8px;background:#eee;border-radius:4px;margin-top:12px;"></div>
                    <div style="height:8px;background:#eee;border-radius:4px;margin-top:8px;width:70%;"></div>
                </div>
                <div class="ios-safari-bottom">
                    <span>◁</span>
                    <span>▷</span>
                    <div class="ios-share-btn-highlight">
                        <span class="ios-share-svg">⬆</span>
                        <div class="ios-tap-ring"></div>
                        <div class="ios-arrow-bounce">👆</div>
                    </div>
                    <span>⊟</span>
                    <span>⊞</span>
                </div>
            </div>
            <p class="ios-instruction">Look at the <strong>bottom bar</strong> of Safari and tap the <strong style="color:#007aff;">Share ⬆</strong> icon</p>
            <button class="ios-next-btn" onclick="showIOSStep(2)">Next →</button>
            <div class="ios-dots">
                <span class="dot active"></span><span class="dot"></span><span class="dot"></span>
            </div>
        </div>

        <!-- Step 2: Add to Home Screen -->
        <div id="ios-guide-step-2" class="ios-guide-screen">
            <div class="ios-step-badge">Step 2 of 3</div>
            <div class="ios-step-title">Tap <span style="color:#007aff;">"Add to Home Screen"</span></div>
            <div class="ios-sheet-preview">
                <div class="ios-sheet-item" style="border-bottom:1px solid #eee;">
                    <span>📤</span> AirDrop
                </div>
                <div class="ios-sheet-item ios-sheet-highlight">
                    <span>➕</span> Add to Home Screen
                    <div class="ios-tap-ring" style="right:-5px;left:auto;"></div>
                    <div class="ios-arrow-point">← Tap This!</div>
                </div>
                <div class="ios-sheet-item" style="border-bottom:1px solid #eee;">
                    <span>📋</span> Copy
                </div>
                <div class="ios-sheet-item">
                    <span>🔖</span> Add Bookmark
                </div>
            </div>
            <p class="ios-instruction">In the share menu, scroll down and tap <strong>"Add to Home Screen"</strong></p>
            <button class="ios-next-btn" onclick="showIOSStep(3)">Next →</button>
            <div class="ios-dots">
                <span class="dot"></span><span class="dot active"></span><span class="dot"></span>
            </div>
        </div>

        <!-- Step 3: Open App & Allow Notifications -->
        <div id="ios-guide-step-3" class="ios-guide-screen">
            <div class="ios-step-badge">Step 3 of 3</div>
            <div class="ios-step-title">Open App → Allow <span style="color:#007aff;">Notifications</span></div>
            <div class="ios-notif-preview">
                <div class="ios-homescreen-icon">
                    <img src="<?php echo SITE_URL; ?>assets/images/favicons/android-chrome-192x192.png" style="width:100%;height:100%;object-fit:cover;">
                    <div class="ios-icon-label">A2P Realtech</div>
                </div>
                <div style="font-size:28px;margin:10px 0;">👇</div>
                <div class="ios-notif-popup">
                    <div class="ios-notif-popup-header">
                        <img src="<?php echo SITE_URL; ?>assets/images/favicons/android-chrome-192x192.png" style="width:22px;height:22px;border-radius:5px;">
                        <strong style="font-size:13px;margin-left:6px;">A2P Realtech</strong>
                        <span style="font-size:11px;color:#999;margin-left:auto;">Now</span>
                    </div>
                    <div style="font-size:12px;color:#555;margin-top:4px;">Would like to send you notifications</div>
                    <div class="ios-allow-btns">
                        <div class="ios-allow-deny">Don't Allow</div>
                        <div class="ios-allow-allow" style="position:relative;">
                            Allow
                            <div class="ios-tap-ring" style="width:50px;height:30px;border-radius:8px;top:50%;transform:translateY(-50%);left:-5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="ios-instruction">Open <strong>A2P Realtech</strong> from your home screen, then tap <strong style="color:#007aff;">"Allow"</strong> when asked for notifications.</p>
            <button class="ios-done-btn" onclick="closeIOSPrompt()">
                <i class="fa fa-check-circle me-1"></i> Got it! Done
            </button>
            <div class="ios-dots">
                <span class="dot"></span><span class="dot"></span><span class="dot active"></span>
            </div>
        </div>
    </div>

    <style>
    /* iOS Guide Styles */
    #ios-pwa-prompt {
        position: fixed; bottom: 0; left: 0; right: 0;
        background: #fff; z-index: 2000001;
        display: none; flex-direction: column; align-items: center;
        padding: 30px 20px 40px; border-radius: 24px 24px 0 0;
        box-shadow: 0 -10px 60px rgba(0,0,0,0.2);
        transform: translateY(100%);
        transition: transform 0.5s cubic-bezier(0.19,1,0.22,1);
        text-align: center; max-height: 92vh; overflow-y: auto;
    }
    #ios-pwa-prompt.show { transform: translateY(0); }
    .ios-guide-screen { display: none; width: 100%; flex-direction: column; align-items: center; }
    .ios-guide-screen.active { display: flex; animation: fadeSlide 0.35s ease; }
    @keyframes fadeSlide { from { opacity:0; transform:translateX(30px); } to { opacity:1; transform:translateX(0); } }

    .ios-icon { width: 68px; height: 68px; border-radius: 16px; margin-bottom: 16px; box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
    .ios-title { font-size: 20px; font-weight: 800; color: #1a1a1a; margin-bottom: 10px; }
    .ios-text { font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 20px; }
    .ios-close { position: absolute; top: 14px; right: 14px; background: #eee; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 13px; color: #888; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; }

    .ios-steps-preview { background: #f7f7f7; border-radius: 14px; padding: 14px; width: 100%; margin-bottom: 22px; text-align: left; }
    .ios-step-preview { display: flex; align-items: center; gap: 12px; padding: 8px 0; border-bottom: 1px solid #eee; font-size: 14px; color: #333; }
    .ios-step-preview:last-child { border-bottom: none; padding-bottom: 0; }
    .ios-step-num { width: 28px; height: 28px; border-radius: 50%; background: #c00415; color: #fff; font-size: 13px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

    .ios-start-btn { background: #c00415; color: #fff; border: none; padding: 14px 32px; border-radius: 50px; font-size: 15px; font-weight: 700; cursor: pointer; width: 100%; margin-bottom: 12px; }
    .ios-skip { font-size: 13px; color: #aaa; cursor: pointer; }

    .ios-step-badge { background: #007aff22; color: #007aff; font-size: 12px; font-weight: 700; padding: 4px 14px; border-radius: 50px; margin-bottom: 12px; }
    .ios-step-title { font-size: 19px; font-weight: 800; color: #1a1a1a; margin-bottom: 16px; }
    .ios-instruction { font-size: 13px; color: #666; line-height: 1.6; margin: 14px 0 16px; }

    /* Phone Preview */
    .ios-phone-preview { width: 100%; background: #f0f0f0; border-radius: 14px; overflow: hidden; border: 2px solid #ddd; }
    .ios-safari-bar { background: #f8f8f8; padding: 8px 12px; border-bottom: 1px solid #ddd; }
    .ios-url-bar { background: #fff; border-radius: 8px; padding: 5px 12px; font-size: 11px; color: #555; text-align: center; }
    .ios-page-content { padding: 12px; background: #fff; }
    .ios-safari-bottom { background: #f8f8f8; border-top: 1px solid #ddd; padding: 10px 20px; display: flex; align-items: center; justify-content: space-around; font-size: 20px; color: #555; }
    .ios-share-btn-highlight { position: relative; display: flex; align-items: center; justify-content: center; }
    .ios-share-svg { font-size: 22px; color: #007aff; font-weight: 700; }
    .ios-tap-ring { position: absolute; width: 44px; height: 44px; border: 2.5px solid #007aff; border-radius: 50%; animation: tapPulse 1.2s ease-in-out infinite; top: 50%; left: 50%; transform: translate(-50%,-50%); }
    .ios-arrow-bounce { position: absolute; bottom: -28px; font-size: 20px; animation: bounceUp 0.8s ease-in-out infinite alternate; }
    @keyframes tapPulse { 0%,100%{opacity:1;transform:translate(-50%,-50%) scale(1);} 50%{opacity:0.3;transform:translate(-50%,-50%) scale(1.5);} }
    @keyframes bounceUp { to { transform: translateY(-6px); } }

    /* Sheet Preview */
    .ios-sheet-preview { background: #fff; border: 1.5px solid #e5e5e5; border-radius: 14px; width: 100%; overflow: hidden; margin-bottom: 4px; }
    .ios-sheet-item { padding: 13px 16px; font-size: 15px; color: #333; display: flex; align-items: center; gap: 10px; position: relative; }
    .ios-sheet-highlight { background: #007aff11; font-weight: 700; color: #007aff; border-left: 4px solid #007aff; }
    .ios-arrow-point { position: absolute; right: 14px; font-size: 12px; color: #c00415; font-weight: 700; animation: blink 1s ease-in-out infinite alternate; }
    @keyframes blink { to { opacity: 0.3; } }

    /* Notif Preview */
    .ios-notif-preview { width: 100%; display: flex; flex-direction: column; align-items: center; margin-bottom: 4px; }
    .ios-homescreen-icon { width: 70px; height: 70px; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.18); position: relative; }
    .ios-icon-label { position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%); font-size: 11px; white-space: nowrap; color: #333; font-weight: 600; }
    .ios-notif-popup { background: #fff; border-radius: 14px; padding: 14px; box-shadow: 0 6px 30px rgba(0,0,0,0.15); width: 100%; margin-top: 24px; border: 1.5px solid #e5e5e5; }
    .ios-notif-popup-header { display: flex; align-items: center; }
    .ios-allow-btns { display: flex; margin-top: 12px; border-top: 1px solid #eee; padding-top: 10px; gap: 10px; }
    .ios-allow-deny { flex: 1; text-align: center; padding: 8px; font-size: 14px; color: #999; cursor: pointer; }
    .ios-allow-allow { flex: 1; text-align: center; padding: 8px; font-size: 14px; color: #007aff; font-weight: 700; cursor: pointer; background: #007aff11; border-radius: 8px; position: relative; }

    .ios-next-btn { background: #007aff; color: #fff; border: none; padding: 13px 32px; border-radius: 50px; font-size: 15px; font-weight: 700; cursor: pointer; width: 100%; margin-bottom: 14px; }
    .ios-done-btn { background: #34c759; color: #fff; border: none; padding: 14px 32px; border-radius: 50px; font-size: 15px; font-weight: 700; cursor: pointer; width: 100%; margin-bottom: 14px; }

    .ios-dots { display: flex; gap: 7px; justify-content: center; }
    .dot { width: 8px; height: 8px; background: #ddd; border-radius: 50%; transition: background 0.3s; }
    .dot.active { background: #007aff; width: 22px; border-radius: 4px; }
    </style>

    <script>
    window.showIOSStep = function(stepNum) {
        document.querySelectorAll('.ios-guide-screen').forEach(s => s.classList.remove('active'));
        const step = document.getElementById('ios-guide-step-' + stepNum);
        if (step) step.classList.add('active');
    };
    </script>
</body>


</html>