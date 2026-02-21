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
                            <div class="blog-card-v2">
                                <div class="blog-card-v2__img">
                                    <?php 
                                        $placeholders = [
                                            "060225101609Luxury_Homes_on_Dwarka_Expressway_A2P_Realtech.webp",
                                            "060225101329Dream_House_With_A2P_Realtech.webp",
                                            "060225100954M3M_Mansion_113_A2P_Realtech.webp",
                                            "060225100526Dwarka_Expressway_Luxury_Projects_with_A2P_Realtech.webp",
                                            "060225100348Hero_Homes_Top_Choice_A2P_Realtech.webp",
                                            "060225101913Dwarka_Expressway_Projects_A2P_Realtech_Gurgaon.webp"
                                        ];
                                        $imagePath = "upload/" . $offer['photo'];
                                        if (file_exists($imagePath) && !empty($offer['photo'])) {
                                            $displayImg = SITE_URL . $imagePath;
                                        } else {
                                            $placeholderIndex = $offer['id'] % count($placeholders);
                                            $displayImg = SITE_URL . "upload/" . $placeholders[$placeholderIndex];
                                        }
                                    ?>
                                    <img src="<?php echo $displayImg; ?>" alt="<?php echo $offer['name']; ?>">
                                    <div class="blog-card-v2__category">
                                        <span>News</span>
                                    </div>
                                    <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php" class="blog-card-v2__overlay"></a>
                                </div>
                                <div class="blog-card-v2__content">
                                    <div class="blog-card-v2__meta">
                                        <span><i class="far fa-user-circle"></i> <?php echo $offer['by_blog']; ?></span>
                                        <span><i class="far fa-calendar-alt"></i> Latest</span>
                                    </div>
                                    <h3 class="blog-card-v2__title">
                                        <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php"><?php custom_echo($offer['name'], 60); ?></a>
                                    </h3>
                                    <p class="blog-card-v2__text"><?php custom_echo($offer['des1'], 100); ?></p>
                                    <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php" class="blog-card-v2__btn">
                                        Read More <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>



            </div>
        </div>
    </div>
</section>
<!--Blog Two End-->





<?php include 'include/footer.php' ?>