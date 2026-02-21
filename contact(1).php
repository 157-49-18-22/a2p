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
    
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11490897190"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11490897190');
</script>

<!-- Event snippet for A2P REALTECH conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-11490897190/O-YqCL-F0JwaEKbapOcq',
      'value': 1.0,
      'currency': 'INR'
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
                <li>Contact Us</li>
            </ul>
            <h2>Contact Us</h2>
        </div>
    </div>
</section>
<!--Page Header End-->









<!--Contact Page Start-->
<section class="contact-page">
    <div class="contact-page-shape-1 float-bob-x">
        <img src="assets/images/shapes/contact-page-shape-1.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="contact-page__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline">Contact us</span>
                        <h2 class="section-title__title">Feel Free to Write</h2>
                        <div class="section-title__line"></div>
                    </div>
                    <div class="contact-page__form">
                    <form action="mail.php" method="post">
    <div class="row">
        <div class="col-xl-6">
            <div class="comment-form__input-box">
                <input type="text" placeholder="Your name" name="name">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="comment-form__input-box">
                <input type="email" placeholder="Email address" name="email">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="comment-form__input-box">
                <input type="text" placeholder="Phone number" name="phone">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="comment-form__input-box">
                <input type="text" placeholder="Subject" name="subject">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="comment-form__input-box text-message-box">
                <textarea name="message" placeholder="Write a message"></textarea>
            </div>
            <div class="comment-form__btn-box">
                <button type="submit" class="thm-btn comment-form__btn">Send a Message</button>
            </div>
        </div>
    </div>
</form>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="contact-page__right">
                    <div class="contact-page__details">
                        <ul class="list-unstyled contact-page__details-list">
                            <li>
                                <span>Call anytime</span>
                                 <p><a href="tel:+91-8130525001">+91-8130525001</a></p>
                                    <p><a href="tel:+91-8130510678">+91-8130510678</a></p>
                            </li>
                            <li>
                                <span>Send email</span>
                                <p><a href="mailto:<?php echo $pr_add['email']; ?>"><?php echo $pr_add['email']; ?></a></p>
                            </li>
                            <li>
                                <span>Address</span>
                                <p><?php echo $pr_add['addr']; ?></p>
                            </li>
                        </ul>
                        <div class="contact-page__social">
                            <a href="<?php echo $pr_add['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                            <a href="<?php echo $pr_add['facebook']; ?>"><i class="fab fa-facebook"></i></a>
                            <a href="<?php echo $pr_add['youtube']; ?>"><i class="fab fa-instagram"></i></a>
                               <a href="<?php echo $pr_add['linkedin']; ?>"><i class="fab fa-youtube"></i></a>
                                 <a href="<?php echo $pr_add['linkedin2']; ?>"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact Page End-->

<!--Google Map Start-->
<section class="google-map-two">

   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.0808414848975!2d77.0498477!3d28.597351500000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1b8d7ee000e5%3A0x5a6f1f8f031ff9fb!2sA2P%20Realtech%20Private%20Limited!5e0!3m2!1sen!2sin!4v1745565088950!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


</section>
<!--Google Map End-->

<script>
  document.querySelector('.comment-one__form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevents the form from actually submitting
    alert('Query submitted successfully');
    this.reset(); // Optional: Clears the form fields after submission
  });
</script>



<?php include 'include/footer.php' ?>