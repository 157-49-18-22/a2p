<?php include "function/function.php"; ?>
<?php
$sql_add = sqlfetch("select * from address where id=1");
if (count($sql_add))
    foreach ($sql_add as $pr_add) {
    }
?>
<?php
$pid = makeurlnormal($_GET['id']);
$sql_ser = sqlfetch("select * from subproduct where name='$pid' and actstat=1  ");


if (count($sql_ser)) {
    foreach ($sql_ser as $subproductss) {

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title><?php echo $subproductss['meta_title']; ?></title>
            <meta name="description" content="<?php echo $subproductss['meta_description']; ?>">
            <meta name="keywords" content="<?php echo $subproductss['meta_keyword']; ?>">
            <link rel="shortcut icon" href="<?= SITE_URL; ?>upload/<?php echo $subproductss['photo']; ?>">
            
            <meta property="og:title" content="<?php echo $subproductss['meta_title']; ?>">
            <meta property="og:description" content="<?php echo $subproductss['meta_description']; ?>">
            <meta property="og:image" content="<?= SITE_URL; ?>upload/<?php echo $subproductss['photo']; ?>">
            <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

            <meta property="og:type" content="<?php echo $subproductss['meta_keyword']; ?>">

            
            
            
            
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
        
        table {
                margin-top: 40px !important;
                width: 100% !important;
                margin-bottom: 40px !important;
               
            }

        /* Table Container for Responsive Scroll */
            .table-container {
                width: 100%;
                overflow-x: auto;
                max-width: 100%;
            }
            
            /* Core Table Styling */
            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                font-family: Arial, sans-serif;
                font-size: 16px;
                background-color: #fff;
            }
            
            /* Table Header */
            th {
                background-color: #007bff; /* Blue Header */
                color: #fff;
                text-align: left;
                padding: 12px;
                font-weight: bold;
            }
            
            /* Table Rows */
            td {
                padding: 10px;
                border-bottom: 1px solid #ddd; /* Light Grey Border */
            }
            
            /* Striped Rows */
            tr:nth-child(even) {
                background-color: #f8f9fa; /* Light Grey */
            }
            
            /* Hover Effect */
            tr:hover {
                background-color: #e2e6ea; /* Light Blue-Grey */
            }
            
            /* Border for Table */
            table, th, td {
                border: 1px solid #ddd;
            }
            
            /* Responsive Table */
            @media screen and (max-width: 768px) {
                table {
                    font-size: 14px;
                }
                th, td {
                    padding: 8px;
                }
            }



        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
            /* Alignment for Product Images */
            .blog-details__img img {
                width: 100%;
                height: auto;
                border-radius: 12px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            @media (max-width: 991px) {
                .blog-details__img img {
                    height: auto !important;
                    object-fit: initial !important;
                    max-height: none !important;
                }
                .blog-details {
                    padding: 60px 0 60px !important;
                }
            }

            .project-three__imgs img {
                width: 100%;
                height: 250px;
                object-fit: cover;
                border-radius: 8px;
            }

            /* Gallery items alignment */
            .project-three__single {
                margin-bottom: 30px;
            }

            /* Video container */
            .video-container {
                position: relative;
                padding-bottom: 56.25%; /* 16:9 aspect ratio */
                height: 0;
                overflow: hidden;
                max-width: 100%;
                background: #000;
                border-radius: 12px;
            }
            .video-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: 0;
            }

            .tab-content li {
                color: black;
            }

            /* Tab Nav Styles */
            .con_tabs .nav-tabs .nav-link {
                border: none;
                font-size: 1.1rem;
                padding: 12px 10px;
                transition: background-color 0.3s ease, box-shadow 0.3s ease;
                margin: 0 5px;
                color: #333;
                background: #f8f9fa;
            }

            .con_tabs .nav-tabs .nav-link.active {
                background-color: #c00415;
                color: #fff;
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            }

            .con_tabs .nav-tabs .nav-link:hover {
                background-color: #c00415;
                color: #fff;
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            }

            /* Tab Content Animation */
            .con_tabs .tab-pane {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.5s ease, transform 0.5s ease;
            }

            .con_tabs .tab-pane.show.active {
                opacity: 1;
                transform: translateY(0);
            }

            /* Card-style shadow for tab content */
            .con_tabs .tab-content {
                margin-top: 20px;
                padding: 20px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            }

            /* Extra styling for headers inside tabs */
            .con_tabs h3 {
                font-size: 1.5rem;
                color: #c00415;
                margin-bottom: 15px;
            }

            /* Link styles in the brochure tab */
            .con_tabs a {
                text-decoration: none;
                color: #c00415;
                transition: color 0.3s ease;
            }

            .con_tabs a:hover {
                color: #c00415;
            }
        </style>



        <?php include 'include/header.php' ?>



<style>
.btn-primary {
    padding: 8px 19px;
    color: #fff;
    background-color: #60020a;
    border-color: #000000;
}


.form-label {
    color: black;
    margin-bottom: .5rem;
}


       #enquiryBtn {
    position: fixed;
    right: -44px;
    top: 50%;
    transform: rotate(4.7137rad);
    z-index: 1050;
    padding: 10px 20px;
    font-size: 18px;
    background-color: #c00415;
    color: white;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#enquiryBtn a
{
    text-decoration: none;
    color: white;
}
    </style>





<!-- Enquiry Now Button -->
    <button id="enquiryBtn" data-bs-toggle="modal">
        <a href="https://a2prealtech.com/contact.php">Enquiry Now</a>
    </button>
    
    
    

    <!-- Enquiry Modal -->
    <div class="modal fade" id="enquiryModal11" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquiryModalLabel">Enquiry Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form id="enquiryForm" action="<?= SITE_URL; ?>mail.php" method="post">
    <div class="row">
        <!-- Name input in col-lg-6 -->
        <div class="col-lg-6 mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <!-- Phone input in col-lg-6 -->
        <div class="col-lg-6 mb-3">
            <label for="phone" class="form-label">Your Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" required>
        </div>
        <!-- Email input in col-lg-6 -->
        <div class="col-lg-6 mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <!-- Subject input in col-lg-6 -->
        <div class="col-lg-6 mb-3">
            <label for="subject" class="form-label">Your Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <!-- Message input in col-lg-12 -->
        <div class="col-lg-12 mb-3">
            <label for="message" class="form-label">Your Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit Enquiry</button>
</form>

                   
                </div>
            </div>
        </div>
    </div>






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




<?php
$blogName = $subproductss['name'];  // Name of the blog post
$encodedBlogName = urlencode($blogName);  // URL encode the blog name for use in URLs
$currentPageUrl = urlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); // Get current page URL
?>





        <section class="page-header">
            <div class="page-header-bg" style="background-image: url(<?= SITE_URL; ?>assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="<?= SITE_URL; ?>">Home</a></li>
                        <li><span>/</span></li>
                        <li> <?php custom_echo($subproductss['name'], 30); ?></li>
                    </ul>
                    <h2><?php custom_echo($subproductss['name'], 70); ?></h2>
                </div>
            </div>
        </section>


        <section class="blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-details__left">
                            <div class="blog-details__img">
                                <img src="<?= SITE_URL; ?>upload/<?php echo trim($subproductss['photo']); ?>" alt=" <?php echo $subproductss['name']; ?>">
                            </div>
                            <div class="blog-details__content">

                                <h3 class="blog-details__title"><?php echo $subproductss['name']; ?></h3>


                            </div>


                                 <div class="mob">
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
                        



                            <div class="con_tabs mt-5">
                                <!-- Tabs navigation -->
                                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="amenities-tab" data-bs-toggle="tab" data-bs-target="#amenities" type="button" role="tab" aria-controls="amenities" aria-selected="false">Amenities</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="floorplan-tab" data-bs-toggle="tab" data-bs-target="#floorplan" type="button" role="tab" aria-controls="floorplan" aria-selected="false">Floor Plan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab" aria-controls="gallery" aria-selected="false">Gallery</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#map" type="button" role="tab" aria-controls="map" aria-selected="false">Map</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="video" aria-selected="false">Video</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="download-link" >Download Brochure</button>
                                    </li>
                                </ul>

                                <!-- Tabs content -->
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <h3>Description</h3>
                                        <?php echo $subproductss['pro_additionalinfo']; ?>
                                    </div>
                                    <div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                                        <h3>Amenities</h3>
                                        <?php echo $subproductss['des']; ?>
                                    </div>
                                    <div class="tab-pane fade" id="floorplan" role="tabpanel" aria-labelledby="floorplan-tab">
                                        <h3>Floor Plan</h3>



                                        <div class="thm-owl__carousel owl-theme owl-carousel owl-with-shadow owl-dot-one owl-dot-one--md owl-nav-one owl-nav-one--md"
                                            data-owl-options='{
                                                        "items": 3,
                                                        "margin": 30,
                                                        "smartSpeed": 700,
                                                        "loop":true,
                                                        "autoplay": 6000,
                                                        "nav":true,
                                                        "dots":true,
                                                        "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                                        "responsive":{
                                                            "0":{
                                                                "items":1
                                                            },
                                                            "575":{
                                                                "items":1
                                                            },
                                                            "992":{
                                                                "items": 2
                                                            }
                                                        }
                                                    }'>


                                            <!--<div class="item">-->

                                            <!--    <div class="project-three__single">-->
                                            <!--        <div class="project-three__img-box">-->
                                            <!--            <div class="project-three__imgs">-->
                                            <!--                <img src="<?= SITE_URL; ?>upload/<?php echo $subproductss['photo2']; ?>" alt="" style="height:250px;">-->

                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->

                                            <!--<div class="item">-->

                                            <!--    <div class="project-three__single">-->
                                            <!--        <div class="project-three__img-box">-->
                                            <!--            <div class="project-three__imgs"> -->
                                            <!--                <img src="<?= SITE_URL; ?>upload/<?php echo $subproductss['photo3']; ?>" alt="" style="height:250px;">-->

                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            
                                            
                                      
                                            <?php
                                            $sub_cat = sqlfetch("SELECT * FROM subcategory2 where subcat='" . $subproductss['id'] . "' ");
                                            if (count($sub_cat)) {
                                                foreach ($sub_cat as $subcategory2ee) {
                                            ?>

                                            
                                            
                                            
                                            
                                             <div class="item">

                                                <div class="project-three__single">
                                                    <div class="project-three__img-box">
                                                        <div class="project-three__imgs">
                                                            <img src="<?= SITE_URL; ?>upload/<?php echo trim($subcategory2ee['photo']); ?>" alt="" style="height:250px;">
                                                            
                                                            <h3 class="mt-4"><?php echo $subcategory2ee['name']; ?></h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }
                                            } ?>


                                        </div>



                                    </div>
                                    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                                        <h3>Gallery</h3>


                                        <div class="thm-owl__carousel owl-theme owl-carousel owl-with-shadow owl-dot-one owl-dot-one--md owl-nav-one owl-nav-one--md"
                                            data-owl-options='{
                                                        "items": 3,
                                                        "margin": 30,
                                                        "smartSpeed": 700,
                                                        "loop":true,
                                                        "autoplay": 6000,
                                                        "nav":true,
                                                        "dots":true,
                                                        "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                                        "responsive":{
                                                            "0":{
                                                                "items":1
                                                            },
                                                            "575":{
                                                                "items":1
                                                            },
                                                            "992":{
                                                                "items": 2
                                                            }
                                                        }
                                                    }'>


                                            <?php
                                            $sub_cat = sqlfetch("SELECT * FROM sub_image where subcat='" . $subproductss['id'] . "' ");
                                            if (count($sub_cat)) {
                                                foreach ($sub_cat as $sub_image) {
                                            ?>


                                                    <div class="item">

                                                        <div class="project-three__single">
                                                            <div class="project-three__img-box">
                                                                <div class="project-three__imgs">
                                                                    <img src="<?= SITE_URL; ?>upload/<?php echo trim($sub_image['photo']); ?>" alt=" <?php echo $subproductss['name']; ?>">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            <?php }
                                            } ?>




                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
                                        <h3>Map</h3>


                                        <iframe src="<?php echo $subproductss['pro_shortdes']; ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                    </div>
                                    <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                        <h3>Property Video</h3>
                                        <?php 
                                        // Check if there's a video link in pro_additionalinfo or a manual check
                                        $video_found = false;
                                        if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?([^\s&]+)/', $subproductss['pro_additionalinfo'], $matches)) {
                                            $video_id = $matches[1];
                                            echo '<div class="video-container"><iframe src="https://www.youtube.com/embed/'.$video_id.'" allowfullscreen></iframe></div>';
                                            $video_found = true;
                                        } else {
                                            echo '<p>Property video will be uploaded soon.</p>';
                                        }
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="brochure" role="tabpanel" aria-labelledby="brochure-tab">
                                        <!--<h3>Download Brochure</h3>-->
                                      
                                        
                                                      <?php if (empty($subproductss['photo4'])): ?>
                                                      
                                                    <h3>Coming Soon</h3>
                                                      <?php else: ?>
                                                          <p><a href="#" id="download-link">Download the brochure here.</a></p>
                                                      <?php endif; ?>
  
                                    </div>
                                </div>
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
                            <div class="desk">
                                    <h3>Social Media Share</h3> <br>
                                     <div class="social-share-buttons">
                             
                           
                            <!-- Facebook Share -->
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
                        </div>
                         <br><br>
                           </div>
                        



                            <div class="sidebar__single sidebar__post">
                                <h3 class="sidebar__title">Latest Posts</h3>
                                <ul class="sidebar__post-list list-unstyled">
                                    <?php $result = sqlfetch("select * from offer  ");
                                    if (count($result)) {
                                        foreach ($result as $offer) {
                                    ?>
                                            <li>
                                                <div class="sidebar__post-image">
                                                    <img src="<?= SITE_URL; ?>upload/<?php echo $offer['photo']; ?>" alt="<?php echo $subproductss['name']; ?>" style="height: 80px;">
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






<!-- Redesigned Brochure Modal -->
<style>
  #enquiryModal .modal-content {
    border-radius: 15px;
    border: none;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
  }
  #enquiryModal .modal-body {
    padding: 0;
  }
  .brochure-form-wrapper {
    display: flex;
    flex-wrap: wrap;
    min-height: 500px;
  }
  .brochure-image {
    flex: 1;
    background: url('<?= SITE_URL; ?>enquirymodel.jpg') center/cover no-repeat;
    min-height: 300px;
    position: relative;
    display: flex;
    align-items: flex-end;
  }
  .brochure-image-overlay {
    background: rgba(192, 4, 21, 0.85);
    width: 100%;
    padding: 20px;
    color: #fff;
  }
  .brochure-image-overlay h4 {
    color: #ffd700;
    margin-bottom: 5px;
    font-weight: 700;
  }
  .brochure-form-content {
    flex: 1.2;
    padding: 30px;
    background: #fff;
  }
  .brochure-form-content h3 {
    color: #c00415;
    font-weight: 800;
    margin-bottom: 5px;
  }
  .brochure-form-content p {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
  }
  .form-group-custom {
    margin-bottom: 15px;
  }
  .form-group-custom label {
    font-weight: 600;
    font-size: 13px;
    color: #333;
    margin-bottom: 5px;
    display: block;
  }
  .form-control-custom {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s;
  }
  .form-control-custom:focus {
    border-color: #c00415;
    box-shadow: 0 0 8px rgba(192, 4, 21, 0.1);
    outline: none;
  }
  .btn-submit-custom {
    background: #000;
    color: #fff;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 6px;
    font-weight: 700;
    font-size: 16px;
    text-transform: uppercase;
    transition: all 0.3s;
    margin-top: 10px;
  }
  .btn-submit-custom:hover {
    background: #c00415;
    transform: translateY(-2px);
  }
  @media (max-width: 767px) {
    .brochure-form-wrapper {
      flex-direction: column;
    }
    .brochure-image {
      min-height: 200px;
    }
  }
</style>

<div class="modal fade" id="enquiryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px; top: 15px; z-index: 10;"></button>
        <div class="brochure-form-wrapper">
          <div class="brochure-image">
            <div class="brochure-image-overlay">
              <h4>Get Exclusive Access</h4>
              <p>Download the detailed brochure with floor plans, pricing, and amenities.</p>
            </div>
          </div>
          <div class="brochure-form-content">
            <h3>Download Brochure</h3>
            <p>Please fill in your details to proceed with the download.</p>
            
            <form id="enquiryForm" method="post" action="<?= SITE_URL; ?>mail2.php" onsubmit="handleSubmit(event)">
              <div class="form-group-custom">
                <label>Your Name *</label>
                <input type="text" class="form-control-custom" name="name" placeholder="Enter your full name" required>
              </div>
              <div class="form-group-custom">
                <label>Your Phone *</label>
                <input type="tel" class="form-control-custom" name="phone" placeholder="Enter 10-digit number" pattern="[0-9]{10}" required>
              </div>
              <div class="form-group-custom">
                <label>Your Email *</label>
                <input type="email" class="form-control-custom" name="email" placeholder="Enter your email address" required>
              </div>
              <div class="form-group-custom">
                <label>Message</label>
                <textarea class="form-control-custom" name="message" rows="3" placeholder="Any specific requirements?"></textarea>
              </div>
              <input type="hidden" name="page" value="<?php echo $subproductss['name']; ?>">
              <input type="hidden" name="destination" value="Brochure Download">
              <button type="submit" class="btn-submit-custom">Submit & Download</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Coming Soon Modal -->
<div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="comingSoonLabel">Coming Soon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        The brochure is not available yet. Please check back later.
      </div>
    </div>
  </div>
</div>

<script>
  function handleSubmit(event) {
    event.preventDefault(); // Prevent default form submission

    let fileUrl = "<?= SITE_URL; ?>upload/<?php echo !empty($subproductss['photo4']) ? $subproductss['photo4'] : ''; ?>";

    if (!fileUrl || fileUrl.endsWith('/')) { 
      // Show "Coming Soon" modal if the file is not available
      var comingSoonModal = new bootstrap.Modal(document.getElementById('comingSoonModal'));
      comingSoonModal.show();

      // After the modal is closed, submit the form
      document.getElementById('comingSoonModal').addEventListener('hidden.bs.modal', function () {
        event.target.submit();
      }, { once: true }); // Ensure it runs only once
    } else {
      // If file exists, show download confirmation
      let downloadPopup = confirm("Thank you for submitting! Do you want to download the brochure?");
      if (downloadPopup) {
        const downloadLink = document.createElement('a');
        downloadLink.href = fileUrl;
        downloadLink.download = 'Brochure.pdf';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      }

      event.target.submit(); // Submit the form after the download
    }
  }

  // Open the enquiry modal when the link is clicked
  document.getElementById('download-link').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default link behavior
    var myModal = new bootstrap.Modal(document.getElementById('enquiryModal'));
    myModal.show();
  });
</script>






        <?php include 'include/footer.php' ?><?php }
                                        }
                                                ?>