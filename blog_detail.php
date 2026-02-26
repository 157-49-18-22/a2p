<?php include "function/function.php"; ?>
<?php
$sql_add = sqlfetch("select * from address where id=1");
if (count($sql_add))
    foreach ($sql_add as $pr_add) {
    }
?>
<?php
$pid = makeurlnormal($_GET['id']);
$sql_ser = sqlfetch("select * from offer where name='$pid' and actstat=1  ");


if (count($sql_ser)) {
    foreach ($sql_ser as $offer) {

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title><?php echo $offer['meta_title']; ?></title>
            <meta name="description" content="<?php echo $offer['meta_description']; ?>">
            <meta name="keywords" content="<?php echo $offer['meta_keyword']; ?>">
            <link rel="shortcut icon" href="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>">
            <link rel="manifest" href="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>" />
            
            <meta property="og:title" content="<?php echo $offer['meta_title']; ?>">
            <meta property="og:description" content="<?php echo $offer['meta_description']; ?>">
            <meta property="og:image" content="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>">
            <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

            <meta property="og:type" content="<?php echo $offer['meta_keyword']; ?>">
            
            
            
            
            <!-- Favicon for browser tab -->
    <link rel="icon" href="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>" type="image/x-icon">

    <!-- Favicon for different devices -->
    <link rel="apple-touch-icon" href="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>">
    <link rel="icon" type="image/png" href="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>" sizes="512x512">

    <meta property="og:image" content="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>">
            
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
        
        <style>
            .social-share-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.social-share-buttons a {
    display: inline-block;
    width: 45px;
    height: 45px;
    background-color: #f1f1f1;
    border-radius: 50%;
    text-align: center;
    line-height: 45px;
    transition: all 0.4s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.social-share-buttons a i {
    font-size: 18px;
    color: #fff;
    transition: all 0.3s ease;
}

/* Branded Backgrounds */
.social-share-buttons a.facebook { background: #1877F2; }
.social-share-buttons a.twitter { background: #000000; }
.social-share-buttons a.linkedin { background: #0077B5; }
.social-share-buttons a.whatsapp { background: #25D366; }
.social-share-buttons a.share { background: #6c757d; }

/* Hover effects */
.social-share-buttons a:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.social-share-buttons a:hover i {
    transform: scale(1.1);
}

.mob{
    display: none !important;
}


@media (max-width: 580px) {
 .mob{
    display: block !important;
}

.desk{
    display: none !important;
}


}

        </style>




        <?php include 'include/header.php' ?>


        <section class="page-header">
            <div class="page-header-bg" style="background-image: url(<?= SITE_URL; ?>assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="<?= SITE_URL; ?>">Home</a></li>
                        <li><span>/</span></li>
                        <li> <?php custom_echo($offer['name'], 30); ?></li>
                    </ul>
                    <h2>Blogs</h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

<?php
$blogName = $offer['name'];  // Name of the blog post
$encodedBlogName = urlencode($blogName);  // URL encode the blog name for use in URLs
$currentPageUrl = urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); // Get current page URL
?>





        <!--Blog Details Start-->
        <section class="blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-details__left">
                            <div class="blog-details__img">
                                <img src="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>" alt="">
                            </div>
                            <div class="blog-details__content">
                                <ul class="list-unstyled blog-details__meta">
                                    <li><a href="#"><i class="far fa-user-circle"></i><?php echo $offer['by_blog']; ?> </a>
                                    </li>
                                    <li><span>/</span></li>
                                   
                                </ul>
                                
                                <div class="mob mt-4">
                             <h3>Social Media Share</h3> <br>
                                <div class="social-share-buttons">
                                     
                                   
                                    <!-- Facebook Share -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $currentPageUrl; ?>&amp;t=<?php echo $encodedBlogName; ?>" target="_blank" class="facebook" title="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    
                                    <!-- Twitter Share -->
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo $encodedBlogName; ?>&amp;url=<?php echo $currentPageUrl; ?>" target="_blank" class="twitter" title="Share on Twitter">
                                        <i class="fab fa-x-twitter"></i>
                                    </a>
                                    
                                    <!-- LinkedIn Share -->
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $currentPageUrl; ?>" target="_blank" class="linkedin" title="Share on LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                
                                    <!-- WhatsApp Share -->
                                    <a href="https://api.whatsapp.com/send?text=<?php echo $encodedBlogName; ?>%20<?php echo $currentPageUrl; ?>" target="_blank" class="whatsapp" title="Share on WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    
                                    
                                         <!-- General Share Button -->
                                                    <?php 
                        $currentPageUrlReal = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $encodedBlogNameReal = htmlspecialchars("A2P Realtech", ENT_QUOTES, 'UTF-8'); 
                        ?>
                        
                        <a href="#" class="share" title="Share" onclick="shareContent(event)">
                            <i class="fas fa-share-alt"></i>
                        </a>
                        
                        <script>
                            function shareContent(event) {
                                event.preventDefault();
                                
                                const pageTitle = <?php echo json_encode($encodedBlogName); ?>;
                                const pageUrl = <?php echo json_encode($currentPageUrl); ?>;
                        
                                if (navigator.share) {
                                    navigator.share({
                                        title: pageTitle,
                                        text: pageTitle,
                                        url: pageUrl
                                    })
                                    .then(() => console.log('Shared successfully'))
                                    .catch((error) => console.log('Error sharing:', error));
                                } else {
                                    alert('Your browser does not support the native sharing feature.');
                                }
                            }
                        </script>
                        
                        
                                </div>
                                <br><br>
                          </div>
                          
                          
                                <h3 class="blog-details__title"><?php echo $offer['name']; ?></h3>
                                
                                

                                <p class="blog-details__text-2"><?php echo $offer['des']; ?></p>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="sidebar">
                            <!--<div class="sidebar__single sidebar__search">-->
                            <!--    <form action="#" class="sidebar__search-form">-->
                            <!--        <input type="search" placeholder="Search here">-->
                            <!--        <button type="submit"><i class="fa fa-search"></i></button>-->
                            <!--    </form>-->
                            <!--</div>-->
                            
                            <!-- Social Media Share Buttons -->
                            
                            
                            <div class="desk">
                             <h3>Social Media Share</h3> <br>
                                <div class="social-share-buttons">
                                     
                                   
                                    <!-- Facebook Share -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $currentPageUrl; ?>&amp;t=<?php echo $encodedBlogName; ?>" target="_blank" class="facebook" title="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    
                                    <!-- Twitter Share -->
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo $encodedBlogName; ?>&amp;url=<?php echo $currentPageUrl; ?>" target="_blank" class="twitter" title="Share on Twitter">
                                        <i class="fab fa-x-twitter"></i>
                                    </a>
                                    
                                    <!-- LinkedIn Share -->
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $currentPageUrl; ?>" target="_blank" class="linkedin" title="Share on LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                
                                    <!-- WhatsApp Share -->
                                    <a href="https://api.whatsapp.com/send?text=<?php echo $encodedBlogName; ?>%20<?php echo $currentPageUrl; ?>" target="_blank" class="whatsapp" title="Share on WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    
                                    <!-- General Share Button -->
                                    <a href="#" class="share" title="Share" onclick="shareContent(event)">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                                <br><br>
                          </div>

                            <div class="sidebar__single sidebar__post">
                                <h3 class="sidebar__title">Latest Posts</h3>
                                
                                
                                <ul class="sidebar__post-list list-unstyled">
                                    <?php $result = sqlfetch("select * from offer order by des ");
                                    if (count($result)) {
                                        foreach ($result as $offer) {
                                    ?>
                                            <li>
                                                <div class="sidebar__post-image">
                                                    <img src="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>" alt="" style="height: 80px;">
                                                </div>
                                                <div class="sidebar__post-content">
                                                    <h3>
                                                        <span class="sidebar__post-content-meta"><i
                                                                class="far fa-user-circle"></i> by Admin</span>
                                                        <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php"><?php custom_echo($offer['name'], 30); ?></a>
                                                    </h3>
                                                </div>
                                            </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Blog Details End-->







        <?php include 'include/footer.php' ?><?php }
                                        }
                                                ?>