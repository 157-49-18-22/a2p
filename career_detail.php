<?php include "function/function.php"; ?>
<?php
$sql_add = sqlfetch("select * from address where id=1");
if (count($sql_add))
    foreach ($sql_add as $pr_add) {
    }
?>
<?php
$pid = makeurlnormal($_GET['id']);
$sql_ser = sqlfetch("select * from blog where slug='$pid' and actstat=1  ");


if (count($sql_ser)) {
    foreach ($sql_ser as $blog) {

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


        <style>
            .product-description {

                padding: 74px 0px 60px;
            }

            .blog-details__content ul li {
                color: black;
            }

            /* Ensure the parent container has a defined height */
            .container {
                position: relative;
            }

            /* Apply sticky positioning to the sidebar */
            .sidebar {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                top: 0;
                /* Adjust the value as needed */
                height: 100vh;
                /* Ensure the sidebar takes full viewport height */
                overflow-y: auto;
                /* Allow scrolling if content overflows */
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
                        <li><?php echo $blog['name']; ?>
                        </li>
                    </ul>
                    <h2>Career
                    </h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->







        <section class="blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-details__left">
                            <!-- <div class="blog-details__img">
                                <img src="<?= SITE_URL; ?>upload/<?php echo $blog['photo']; ?>" alt="">
                            </div> -->
                            <div class="blog-details__content">
                                <h3 class="blog-details__title"><?php echo $blog['name']; ?></h3>
                                <p class="blog-details__text-2"><?php echo $blog['des']; ?></p>
                            </div>

                            <div class="comment-form mt-4">
                                <h3 class="comment-form__title">Apply Now</h3>
                                <form action="assets/inc/sendemail.php" class="comment-one__form contact-form-validated" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <label for="name">Your Name</label>
                                                <input type="text" id="name" placeholder="Your name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <label for="email">Email Address</label>
                                                <input type="email" id="email" placeholder="Email address" name="email">
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <label for="phone">Your Phone</label>
                                                <input type="text" id="phone" placeholder="Your Phone" name="phone">
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <label for="resume">Upload Resume</label>
                                                <input type="file" id="resume" class="form-control" name="resume">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="comment-form__input-box text-message-box">
                                                <label for="message">Your Message</label>
                                                <textarea id="message" name="message" placeholder="Write comment"></textarea>
                                            </div>
                                            <br>
                                            <div class="comment-form__btn-box mt-4">
                                                <button type="submit" class="thm-btn comment-form__btn">Submit Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="sidebar">
                            <div class="sidebar__single sidebar__search">
                                <form action="https://a2prealtech.com/search.php" method="get" class="sidebar__search-form">
    <input type="search" name="q" placeholder="Search here">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>

                            </div>

                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>





        <?php include 'include/footer.php' ?><?php }
                                        }
                                                ?>