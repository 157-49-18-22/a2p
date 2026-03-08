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
    
    <!-- Open Graph Meta Tags for WhatsApp and Social Media Preview -->
    <meta property="og:title" content="A2P Realtech Private Limited">
    <meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
    <meta property="og:image" content="<?= SITE_URL; ?>upload/080325100432logo.png">
    <meta property="og:url" content="<?= SITE_URL; ?>">
    <meta property="og:type" content="website">
    
    <link rel="icon" href="<?= SITE_URL; ?>assets/images/favicons/favicon.ico">
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
    
    <script async type="application/javascript"
        src="https://news.google.com/swg/js/v1/swg-basic.js"></script>
<script>
  (self.SWG_BASIC = self.SWG_BASIC || []).push( basicSubscriptions => {
    basicSubscriptions.init({
      type: "NewsArticle",
      isPartOfType: ["Product"],
      isPartOfProductId: "CAowpuveCw:openaccess",
      clientOptions: { theme: "light", lang: "en" },
    });
  });
</script>

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
                <li>Blogs</li>
            </ul>
            <h2>Blogs</h2>
        </div>
    </div>
</section>
<!--Page Header End-->






<!--Blog Two Start-->
<section class="blog-two">
    <div class="blog-two-bg" style="background-image: url(assets/images/backgrounds/blog-two-bg.jpg);"></div>
    <div class="container">
        <div class="blog-two__top">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="blog-two__top-left">
                        <div class="section-title text-left">
                            <span class="section-title__tagline">News & Updates</span>
                            <h2 class="section-title__title">Check Latest News & Articles</h2>
                            <div class="section-title__line"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="blog-two__bottom">
            <div class="row">

                <?php $result = sqlfetch("select * from offer ORDER BY id DESC");
                if (count($result)) {
                    foreach ($result as $offer) {
                ?>
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <!--Blog One Start-->
                            <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php">
                            <div class="blog-one__single">
                                <div class="blog-one__img">
                                    <img src="upload/<?php echo $offer['photo']; ?>" alt="<?php echo $offer['name']; ?>">
                                    
                                    
                                   
                                </div>
                                <div class="blog-one__content">
                                    <div class="blog-one__date">
                                        <p><?php echo $offer['des1']; ?></p>
                                    </div>
                                    <ul class="list-unstyled blog-one__meta">
                                        <li><a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php"><i class="far fa-user-circle"></i> <?php echo $offer['by_blog']; ?></a></li>
                                        <li><span>/</span></li>
                                        <!--<li><a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php"><i class="far fa-comments"></i> Comments</a></li>-->
                                    </ul>
                                    <h3 class="blog-one__title"><a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php"><?php custom_echo($offer['name'], 40); ?></a></h3>
                                </div>
                            </div>
                             </a>
                        </div>
                <?php }
                } ?>



            </div>
        </div>
    </div>
</section>
<!--Blog Two End-->





<?php include 'include/footer.php' ?>