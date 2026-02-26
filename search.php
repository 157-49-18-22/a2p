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
    
    .search-bar {
   
    margin-top: 10px;
    top: 0;
    z-index: 9;
    right: 0;
}

.welcome-one {
  
    padding: 0px 0px 45px;
}


    .sp1 {
    padding: 48px 0 27px;
}

.search-bar {
    position: relative !important; 
    display: flex;
    justify-content: center;
    padding: 30px 0;
}

.search-input {
    width: 500px;
    flex: 0 1 auto;
    padding: 15px 25px;
    border: 2px solid #eee;
    border-radius: 50px 0 0 50px;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.search-input:focus {
    border-color: #c00415;
    box-shadow: 0 4px 20px rgba(192, 4, 21, 0.1);
    outline: none;
}

.search-btn {
    padding: 12px 35px;
    border: none;
    background: linear-gradient(135deg, #c00415 0%, #a00312 100%);
    color: white;
    border-radius: 0 50px 50px 0;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(192, 4, 21, 0.3);
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-btn:hover {
    background: linear-gradient(135deg, #a00312 0%, #80020e 100%);
    transform: translateX(3px);
    box-shadow: 0 6px 20px rgba(192, 4, 21, 0.4);
}


@media (max-width: 600px) {
    
    
 .search-input {
    width: 100% !important;}
  
  
}

</style>

<section class="welcome-one">
 



<div class="blog-top-area sp1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="testimonia4-header text-center heading8">
                    <h2 class="text-center ">Search Here</h2>
                </div>
            </div>
        </div>
 <div class="search-bar">
                                <form action="<?= SITE_URL; ?>search_result.php" method="GET" class="d-flex" onsubmit="return checkSearchRedirect(this)">
                                    <input type="text" class="form-control search-input" placeholder="Search properties, locations, phone, email..." name="query">
                                    <button type="submit" class="search-btn">
                                        <i class="fa-solid fa-search"></i> Search
                                    </button>
                                </form>

                            </div>
<script>
function checkSearchRedirect(form) {
    var query = form.querySelector('[name="query"]').value.trim();
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
        
    </div>
</div>

</section>





<?php include 'include/footer.php' ?>