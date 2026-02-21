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
    
   


<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
  window.OneSignalDeferred = window.OneSignalDeferred || [];
  OneSignalDeferred.push(async function(OneSignal) {
    await OneSignal.init({
      appId: "2571f3ad-53c7-4ee3-a0d3-0c5a0025b1d8",
    });
  });
</script>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11490897190"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11490897190');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MX5RBG34');</script>
<!-- End Google Tag Manager -->



<?php echo $pr_add['all_tag']; ?>


</head>


<style>


    /* Add these styles in your stylesheet */
.modal-border-red {
    border: 3px solid red;
}

.modal-border-dark-blue {
    border: 3px solid darkblue;
}

.modal-border-auto {
    border: 3px solid #333; /* Example auto color */
}

</style>
  
  
  
  
<?php
$sql_banner = sqlfetch("select * from team where actstat=1 order by fld_order");

if (count($sql_banner) > 0): // Check if there are any active team members
?>
<div class="modal fade" id="carouselModal" tabindex="-1" aria-labelledby="carouselModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Use modal-xl for larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Bootstrap 5 Carousel inside Modal Body -->
                <div id="carouselExampleModal" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000"> <!-- Set interval to 4 seconds -->
                    <div class="carousel-inner">
                        <?php $count_banner = 0; foreach ($sql_banner as $team): ?>
                        <div class="carousel-item <?php if($count_banner == 0){ echo 'active'; } ?>">
                            <a href="<?php echo $team['name']; ?>">
                                <img src="upload/<?php echo $team['photo']; ?>" class="d-block w-100" alt="Slide">
                            </a>   
                        </div>
                        <?php $count_banner++; endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleModal" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleModal" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<!-- Add the following JavaScript to change the border color dynamically -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Get the modal content
        let modalContent = document.querySelector('.modal-content');

        // Example logic to change the border color based on some condition
        // You can replace this condition with your own logic
        let condition = 'red'; // Change this to 'dark-blue', 'auto', or other conditions

        switch (condition) {
            case 'red':
                modalContent.classList.add('modal-border-red');
                break;
            case 'dark-blue':
                modalContent.classList.add('modal-border-dark-blue');
                break;
            default:
                modalContent.classList.add('modal-border-auto');
        }
    });
</script>

  


 <!-- Auto Popup Script -->
    <script>
        // Wait until the document is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Show the modal after a short delay (e.g., 1 second)
            setTimeout(function() {
                var myModal = new bootstrap.Modal(document.getElementById('carouselModal'));
                myModal.show();
            }, 1000); // 1000 milliseconds = 1 second
        });
    </script>


<?php include 'include/header.php' ?>

<?php include 'include/slider.php' ?>

<style>
    .welcome-one__img-s2 img {
    margin-top: 20px;
    border-radius: 20px;
}
h3.ddd {
    font-size: 22px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    border: 1px solid red;
    padding: 14px 16px;
    border-radius: 10px;
}
</style>


<?php
$abou_mission_sql = sqlfetch("SELECT * FROM about where id='5' ");
if (count($abou_mission_sql)) {
    foreach ($abou_mission_sql as $mission)
?>
    <br><br><br>

    <section class="welcome-one">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="welcome-one__lefts">
                        <div class="welcome-one__img-box wow slideInLeft" data-wow-delay="100ms"
                            data-wow-duration="2500ms">
                            
                            
                             <div class="welcom">
                               <h3 class="ddd"> <?php echo $mission['short']; ?> <?php echo $mission['short2']; ?></h3>
                              </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <!--<div class="welcome-one__img-1">-->
                            <!--    <img src="upload/<?php echo $mission['photo']; ?>" alt="">-->
                            <!--</div>-->
                            <div class="welcome-one__img-s2">
                                <img src="upload/<?php echo $mission['photo']; ?>" alt="">
                            </div>
                           
                            
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="welcome-one__right">
                        <div class="section-title text-left">
                            <span class="section-title__tagline">Our introduction</span>
                            <h2 class="section-title__title"> <?php echo $mission['name']; ?></h2>
                            <div class="section-title__line"></div>
                        </div>
                        <?php echo $mission['des']; ?>

                        <div class="welcome-one__person">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
} ?>


<?php

$sql_ser = sqlfetch("select * from category  LIMIT 0,1");
if (count($sql_ser)) {
    foreach ($sql_ser as $category) {

?>

        <section class="blog-three residential-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="blog-three__left">
                            <div class="section-title text-left">
                                <span class="section-title__tagline">Premium Collection</span>
                                <h2 class="section-title__title"><?php echo $category['name']; ?></h2>
                                <div class="section-title__line"></div>
                            </div>
                            <p class="blog-three__text"> <?php echo $category['des1']; ?></p>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="blog-three__right">
                            <div class="blgo-three__carousel owl-carousel owl-theme thm-owl__carousel residential-carousel" data-owl-options='{
                                "loop": true,
                                "autoplay": true,
                                "margin": 30,
                                "nav": true,
                                "dots": true,
                                "smartSpeed": 700,
                                "autoplayTimeout": 5000,
                                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                "responsive": {
                                    "0": { "items": 1 },
                                    "768": { "items": 2 },
                                    "992": { "items": 2 },
                                    "1200": { "items": 2.5 }
                                }
                            }'>

                                <?php
                                $sub_cat = sqlfetch("SELECT * FROM subproduct where  subcat2='" . $category['id'] . "' ORDER BY id DESC  ");
                                if (count($sub_cat)) {
                                    foreach ($sub_cat as $subproductwww) {
                                ?>
                                        <div class="project-card-v2">
                                            <div class="project-card-v2__img">
                                                <?php 
                                                    $res_placeholders = [
                                                        "060825060302Vatika Sovereign Park Image1.jpg",
                                                        "100725050048Sobha-City-Sector-108-Dwarka-Expressway-Gurgaon.jpg",
                                                        "160425091419Sobha Altus image A2P Realtech.jpg",
                                                        "20260128161604_M3M-GIC-Manesar-Gurgaon.jpg"
                                                    ];
                                                    $imagePath = "upload/" . $subproductwww['photo'];
                                                    if (file_exists($imagePath) && !empty($subproductwww['photo'])) {
                                                        $displayImg = SITE_URL . $imagePath;
                                                    } else {
                                                        $placeholderIndex = $subproductwww['id'] % count($res_placeholders);
                                                        $displayImg = SITE_URL . "upload/" . $res_placeholders[$placeholderIndex];
                                                    }
                                                ?>
                                                <img src="<?php echo $displayImg; ?>" alt="<?php echo $subproductwww['name']; ?>">
                                                <div class="project-card-v2__location">
                                                    <i class="fa-solid fa-location-dot"></i> <?php echo $subproductwww['pro_lable']; ?>
                                                </div>
                                                <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php" class="project-card-v2__link">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div class="project-card-v2__content">
                                                <h3 class="project-card-v2__title">
                                                    <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php"><?php echo $subproductwww['name']; ?></a>
                                                </h3>
                                                <div class="project-card-v2__footer">
                                                    <span class="project-card-v2__subtitle">
                                                        <i class="fa-solid fa-building"></i> Luxury Residence
                                                    </span>
                                                    <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php" class="project-card-v2__arrow">
                                                        Explore <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php

    }
}
?>








<section class="benefits-one">
    <div class="benefits-one-shape float-bob-x">
        <img src="assets/images/shapes/benefits-one-shape.png" alt="">
    </div>
    <div class="container">
        <div class="row">
                             <?php
                                $sub_cat = sqlfetch("SELECT * FROM faq LIMIT 0,1");
                                if (count($sub_cat)) {
                                    foreach ($sub_cat as $faq) {
                                ?>
            
            <div class="col-xl-6">
                <div class="benefits-one__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline"><?php echo $faq['name']; ?></span>
                        <h2 class="section-title__title"><?php echo $faq['des']; ?></h2>
                        <div class="section-title__line"></div>
                    </div>
                    <p class="benefits-one__text"><?php echo $faq['des1']; ?></p>

                </div>
            </div>
            
            <?php

    }
}
?>

            
            <div class="col-xl-6">
                <div class="benefits-one__right">
                    <div class="accrodion-grp" data-grp-name="faq-one-accrodion">
                        
                          <?php
                                $sub_cat = sqlfetch("SELECT * FROM faq LIMIT 1,50");
                                if (count($sub_cat)) {
                                    $count = 0;
                                    foreach ($sub_cat as $faq) {
                                        $isActive = ($count == 0) ? 'active' : ''; // Only first item active
                                ?>
                                        <div class="accrodion <?php echo $isActive; ?>">
                                            <div class="accrodion-title">
                                                <h4><?php echo $faq['name']; ?></h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p><?php echo $faq['des']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                        $count++; // Increment counter
                                    }
                                }
                                ?>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<?php

$sql_ser = sqlfetch("select * from category  LIMIT 1,1");
if (count($sql_ser)) {
    foreach ($sql_ser as $category) {

?>

        <section class="blog-three commercial-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="blog-three__left">
                            <div class="section-title text-left">
                                <span class="section-title__tagline">Business Spaces</span>
                                <h2 class="section-title__title"><?php echo $category['name']; ?></h2>
                                <div class="section-title__line"></div>
                            </div>
                            <p class="blog-three__text"> <?php echo $category['des1']; ?></p>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="blog-three__right">
                            <div class="blgo-three__carousel owl-carousel owl-theme thm-owl__carousel commercial-carousel" data-owl-options='{
                                "loop": true,
                                "autoplay": true,
                                "margin": 30,
                                "nav": true,
                                "dots": true,
                                "smartSpeed": 700,
                                "autoplayTimeout": 6000,
                                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                "responsive": {
                                    "0": { "items": 1 },
                                    "768": { "items": 2 },
                                    "992": { "items": 2 },
                                    "1200": { "items": 2.5 }
                                }
                            }'>

                                <?php
                                $sub_cat = sqlfetch("SELECT * FROM subproduct where subcat2='" . $category['id'] . "'  ORDER BY id DESC ");
                                if (count($sub_cat)) {
                                    foreach ($sub_cat as $subproductwww) {
                                ?>
                                        <div class="project-card-v2 alt-style">
                                            <div class="project-card-v2__img">
                                                <?php 
                                                    $com_placeholders = [
                                                        "030625094659Commercial-Construction-A2P-Realtech.jpg",
                                                        "070225085304M3M_Capital_Walk113.jpg",
                                                        "110225084138M3M CAPITAL WALK SECTOR 113 DWARKA EXPRESSWAY GURGAON (1).jpg",
                                                        "140625094558build-your-commercial-building-A2P-Realtech.jpg"
                                                    ];
                                                    $imagePath = "upload/" . $subproductwww['photo'];
                                                    if (file_exists($imagePath) && !empty($subproductwww['photo'])) {
                                                        $displayImg = SITE_URL . $imagePath;
                                                    } else {
                                                        $placeholderIndex = $subproductwww['id'] % count($com_placeholders);
                                                        $displayImg = SITE_URL . "upload/" . $com_placeholders[$placeholderIndex];
                                                    }
                                                ?>
                                                <img src="<?php echo $displayImg; ?>" alt="<?php echo $subproductwww['name']; ?>">
                                                <div class="project-card-v2__location">
                                                    <i class="fa-solid fa-location-dot"></i> <?php echo $subproductwww['pro_lable']; ?>
                                                </div>
                                                <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php" class="project-card-v2__link">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                            <div class="project-card-v2__content">
                                                <h3 class="project-card-v2__title">
                                                    <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php"><?php echo $subproductwww['name']; ?></a>
                                                </h3>
                                                <div class="project-card-v2__footer">
                                                    <span class="project-card-v2__subtitle">
                                                        <i class="fa-solid fa-briefcase"></i> Commercial Space
                                                    </span>
                                                    <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php" class="project-card-v2__arrow">
                                                        View Details <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php

    }
}
?>









<section class="working-process">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">3 easy steps</span>
            <h2 class="section-title__title">Our Work Process</h2>
            <div class="section-title__line"></div>
        </div>
        <div class="working-process__inner">
            <div class="row">
                
                
                <?php
                  $sub_cat = sqlfetch("SELECT * FROM process  ");
                 if (count($sub_cat)) {
                     foreach ($sub_cat as $process) {
                  ?>
                <div class="col-xl-4 col-lg-4 mt-4 wow fadeInUp" data-wow-delay="100ms">
                    <!--Working Process Single-->
                    <div class="working-process__single">
                        <div class="working-process__count"></div>
                        <div class="working-process__icon">
                          <img src="upload/<?php echo $process['photo']; ?>">
                        </div>
                        <h3 class="working-process__title"><a href="#"><?php echo $process['name']; ?></a></h3>
                        <p class="working-process__text"><?php echo $process['des1']; ?></p>
                    </div>
                </div>
                <?php
                
                    }
                }
                ?>
                
            </div>
        </div>
    </div>
</section>


<style>
    .leading__points li .icon span {
    font-size: 41px;
    color: white;
}
</style>



<section class="leading">
    <div class="leading-bg-box">
        <div class="leading-bg jarallax"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-6">
                <div class="leading__left">
                    
                      <?php $result = sqlfetch("select * from certification  LIMIT 0,1 ");
                if (count($result)) {
                    foreach ($result as $offer) {
                ?>

                    <h3 class="leading__title"><?php echo $offer['name']; ?></h3>
                    
                       <?php }
                } ?>

                    
                    
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="leading__right">
                    <ul class="list-unstyled leading__points">
                        
                        
                            <?php $result = sqlfetch("select * from certification  LIMIT 1,10 ");
                if (count($result)) {
                    foreach ($result as $offer) {
                ?>
                        <li>
                            <div class="icon">
                               <span>&bull;</span>

                            </div>
                            <div class="text">
                                <p><?php echo $offer['name']; ?></p>
                            </div>
                        </li>
                        
                        
                         <?php }
                } ?>

                    
                    
                    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .gols img {
        height: 100px;
        width: 100%;
    }
    .blog-one__single:hover .blog-one__img>a {
    visibility: visible;
    -webkit-transform: translateY(0%);
    transform: translateY(0%);
    opacity: 0;
}
</style>






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

                <?php $result = sqlfetch("select * from offer ORDER BY id DESC LIMIT 0,12");
                if (count($result)) {
                    foreach ($result as $offer) {
                ?>
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="blog-card-v2">
                                <div class="blog-card-v2__img">
                                    <?php 
                                        $placeholders = [
                                            "060225101913Dwarka_Expressway_Projects_A2P_Realtech_Gurgaon.webp",
                                            "060225101609Luxury_Homes_on_Dwarka_Expressway_A2P_Realtech.webp",
                                            "060225101329Dream_House_With_A2P_Realtech.webp",
                                            "060225100954M3M_Mansion_113_A2P_Realtech.webp",
                                            "060225100526Dwarka_Expressway_Luxury_Projects_with_A2P_Realtech.webp",
                                            "060225100348Hero_Homes_Top_Choice_A2P_Realtech.webp"
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
                                        <span><i class="far fa-user-circle"></i> Admin</span>
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
            <div class="row">
                <div class="col-xl-12">
                    <div class="blog-two__btn-box text-center" style="margin-top: 50px;">
                        <a href="<?= SITE_URL; ?>blog.php" class="thm-btn" style="padding: 15px 40px; border-radius: 30px;">
                            View All News <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Blog Two End-->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MX5RBG34"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php include 'include/footer.php' ?>