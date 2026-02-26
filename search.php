<?php include "function/function.php"; ?>
<?php
$sql_add = sqlfetch("select * from address where id=1");
if (count($sql_add))
    foreach ($sql_add as $pr_add) {
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $pr_add['test_date']; ?></title>
    <meta name="description" content="<?php echo $pr_add['class9']; ?>">
    <meta name="keywords" content="<?php echo $pr_add['class8']; ?>">
    <link rel="shortcut icon" href="upload/<?php echo $pr_add['photo']; ?>">
    <link rel="manifest" href="<?= SITE_URL; ?>assets/images/favicons/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/animate/animate.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/animate/custom-animate.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/jarallax/jarallax.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/nouislider/nouislider.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/nouislider/nouislider.pips.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/odometer/odometer.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/swiper/swiper.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/ambed-icons/style.css">
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/tiny-slider/tiny-slider.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/reey-font/stylesheet.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/owl-carousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/vegas/vegas.min.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/timepicker/timePicker.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/css/ambed.css" />
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/css/ambed-responsive.css" />
    <link rel="stylesheet" id="jssMode" href="<?= SITE_URL; ?>assets/css/ambed-light.css">
    <link rel="stylesheet" href="<?= SITE_URL; ?>assets/vendors/toolbar/css/toolbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>




<?php include 'include/header.php' ?>


<section class="page-header">
    <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="<?= SITE_URL; ?>">Home</a></li>
                <li><span>/</span></li>
                <li>Search </li>
            </ul>
            <h2>Search </h2>
        </div>
    </div>
</section>
<style>
/* NEXT LEVEL SEARCH - ULTRA PREMIUM DESIGN */
@keyframes meshGradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes pulseNeon {
    0% { box-shadow: 0 0 10px rgba(192, 4, 21, 0.2); }
    50% { box-shadow: 0 0 25px rgba(192, 4, 21, 0.6); }
    100% { box-shadow: 0 0 10px rgba(192, 4, 21, 0.2); }
}

@keyframes floatWrap {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

.next-level-search-wrap {
    min-height: 85vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(-45deg, #0a0a0a, #1a1a1a, #4a0108, #00104a);
    background-size: 400% 400%;
    animation: meshGradient 15s ease infinite;
    position: relative;
    overflow: hidden;
    padding: 60px 20px;
}

.next-level-search-wrap::before {
    content: '';
    position: absolute;
    width: 150%;
    height: 150%;
    background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
    opacity: 0.1;
    pointer-events: none;
}

/* Glass Orb Backgrounds */
.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    z-index: 1;
    opacity: 0.4;
}
.orb-1 { width: 400px; height: 400px; background: #c00415; top: -100px; left: -100px; animation: floatWrap 8s ease infinite; }
.orb-2 { width: 350px; height: 350px; background: #102a83; bottom: -50px; right: -50px; animation: floatWrap 10s ease infinite reverse; }

.ultra-glass-card {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 1000px;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 40px;
    padding: 80px 40px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
    text-align: center;
}

.search-main-heading {
    margin-bottom: 50px;
}

.search-main-heading h1 {
    font-size: 64px;
    font-weight: 900;
    color: #fff;
    margin-bottom: 15px;
    letter-spacing: -2px;
    background: linear-gradient(to bottom, #fff 0%, #aaa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.search-main-heading p {
    color: #c00415;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 800;
    letter-spacing: 5px;
    margin-bottom: 5px;
}

/* The Futuristic Bar */
.neo-search-bar {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 100px;
    padding: 10px;
    display: flex;
    align-items: center;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    max-width: 850px;
    margin: 0 auto;
    position: relative;
}

.neo-search-bar:focus-within {
    background: rgba(255, 255, 255, 0.1);
    border-color: #c00415;
    box-shadow: 0 0 30px rgba(192, 4, 21, 0.3);
    transform: scale(1.02);
}

.neo-search-input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 20px 30px;
    font-size: 20px;
    color: #fff;
    font-weight: 500;
    width: 100%;
}

.neo-search-input:focus { outline: none; }
.neo-search-input::placeholder { color: rgba(255,255,255,0.4); }

.neo-search-btn {
    width: 70px;
    height: 70px;
    background: #c00415;
    border: none;
    border-radius: 50%;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s ease;
    animation: pulseNeon 3s infinite;
    flex-shrink: 0;
}

.neo-search-btn:hover {
    background: #fff;
    color: #c00415;
    transform: rotate(90deg) scale(1.1);
}

/* Quick Tags */
.quick-search-tags {
    margin-top: 40px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 12px;
}

.tag-pill {
    padding: 10px 22px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    color: rgba(255,255,255,0.7);
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.tag-pill:hover {
    background: #c00415;
    color: #fff;
    border-color: #c00415;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(192, 4, 21, 0.4);
}

@media (max-width: 768px) {
    .ultra-glass-card {
        padding: 50px 20px;
    }
    .search-main-heading h1 {
        font-size: 36px;
    }
    .neo-search-bar {
        border-radius: 30px;
        flex-direction: column;
        padding: 15px;
    }
    .neo-search-btn {
        width: 100%;
        border-radius: 15px;
        margin-top: 15px;
        height: 55px;
    }
    .search-main-heading h1 { font-size: 32px; letter-spacing: -1px; }
}
</style>

<section class="next-level-search-wrap">
    <!-- Animated Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container">
        <div class="ultra-glass-card wow zoomIn" data-wow-duration="1200ms">
            <div class="search-main-heading">
                <p>Premium Real Estate Experience</p>
                <h1>Search Your Future</h1>
            </div>
            
            <div class="neo-search-bar">
                <form action="<?= SITE_URL; ?>search_result.php" method="GET" class="d-flex w-100 align-items-center" onsubmit="return checkSearchRedirect(this)">
                    <i class="fa-solid fa-sparkles ms-4" style="color: #c00415; font-size: 20px;"></i>
                    <input type="text" class="neo-search-input" placeholder="Where do you want to live?" name="query" autocomplete="off">
                    <button type="submit" class="neo-search-btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <!-- Quick Search Tags -->
            <div class="quick-search-tags">
                <a href="<?= SITE_URL; ?>search_result.php?query=Gurgaon" class="tag-pill">#Gurgaon</a>
                <a href="<?= SITE_URL; ?>search_result.php?query=Delhi" class="tag-pill">#Delhi</a>
                <a href="<?= SITE_URL; ?>search_result.php?query=Noida" class="tag-pill">#Noida</a>
                <a href="<?= SITE_URL; ?>search_result.php?query=Residential" class="tag-pill">#Residential</a>
                <a href="<?= SITE_URL; ?>search_result.php?query=Commercial" class="tag-pill">#Commercial</a>
                <a href="<?= SITE_URL; ?>search_result.php?query=New Launch" class="tag-pill">#NewLaunch</a>
            </div>
        </div>
    </div>
</section>

<script>
function checkSearchRedirect(form) {
    var queryInput = form.querySelector('[name="query"]');
    var query = queryInput ? queryInput.value.trim() : '';
    if (!query) return true;
    var digitsOnly = query.replace(/[\s\-\(\)\+]/g, '');
    var isPhone = /\d{5,}/.test(digitsOnly);
    var isEmail = /[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/.test(query);
    if (isPhone || isEmail) {
        window.location.href = '<?= SITE_URL; ?>contact.php';
        return false;
    }
    return true;
}
</script>





<?php include 'include/footer.php' ?>