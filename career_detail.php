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

                            <div class="comment-form mt-4 p-4 shadow-sm rounded bg-white border">
                                <h3 class="comment-form__title mb-4" style="color: #ed1c24; font-weight: 700; border-bottom: 2px solid #eee; padding-bottom: 15px;">Apply Now</h3>
                                <form action="<?= SITE_URL; ?>apply_job.php" method="POST" enctype="multipart/form-data" class="apply-job-form">
                                    <input type="hidden" name="job_id" value="<?php echo $blog['id']; ?>">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box mb-3">
                                                <label for="name" class="form-label fw-bold">Full Name</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter your full name" name="name" required style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box mb-3">
                                                <label for="email" class="form-label fw-bold">Email Address</label>
                                                <input type="email" id="email" class="form-control" placeholder="Enter your email" name="email" required style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box mb-3">
                                                <label for="phone" class="form-label fw-bold">Phone Number</label>
                                                <input type="text" id="phone" class="form-control" placeholder="Enter your phone number" name="phone" required style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box mb-3">
                                                <label for="resume" class="form-label fw-bold">Upload Resume (PDF/DOC)</label>
                                                <input type="file" id="resume" class="form-control" name="resume" accept=".pdf,.doc,.docx" required style="border-radius: 8px; padding: 10px; border: 1px solid #ddd;">
                                                <div id="resume-preview" class="mt-2 text-muted small"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="comment-form__input-box text-message-box mb-3">
                                                <label for="message" class="form-label fw-bold">Short Introduction</label>
                                                <textarea id="message" name="message" class="form-control" placeholder="Tell us why you are a good fit..." style="border-radius: 8px; padding: 12px; border: 1px solid #ddd; height: 150px;"></textarea>
                                            </div>
                                            <div class="form-result mt-3"></div>
                                            <div class="comment-form__btn-box mt-4">
                                                <button type="submit" class="thm-btn comment-form__btn w-100" style="background: #ed1c24; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: 600; text-transform: uppercase; transition: all 0.3s ease;">
                                                    <i class="fas fa-paper-plane me-2"></i> Send Application
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.querySelector('.apply-job-form');
                                const resumeInput = document.getElementById('resume');
                                const resumePreview = document.getElementById('resume-preview');

                                resumeInput.addEventListener('change', function() {
                                    if (this.files && this.files[0]) {
                                        const file = this.files[0];
                                        const fileName = file.name;
                                        const fileSize = (file.size / 1024 / 1024).toFixed(2);
                                        resumePreview.innerHTML = `<i class="fas fa-file-pdf text-danger me-2"></i> Selected: <strong>${fileName}</strong> (${fileSize} MB)`;
                                        resumePreview.style.color = '#28a745';
                                    }
                                });

                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    const submitBtn = form.querySelector('button[type="submit"]');
                                    const resultDiv = form.querySelector('.form-result');
                                    
                                    submitBtn.disabled = true;
                                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
                                    
                                    const formData = new FormData(this);
                                    
                                    fetch(this.getAttribute('action'), {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if(data.status === 'success') {
                                            resultDiv.innerHTML = `<div class="alert alert-success mt-3" style="border-radius: 8px; border-left: 5px solid #28a745;">
                                                <i class="fas fa-check-circle me-2"></i> ${data.message}
                                            </div>`;
                                            form.reset();
                                            resumePreview.innerHTML = '';
                                        } else {
                                            resultDiv.innerHTML = `<div class="alert alert-danger mt-3" style="border-radius: 8px; border-left: 5px solid #dc3545;">
                                                <i class="fas fa-exclamation-triangle me-2"></i> ${data.message}
                                            </div>`;
                                        }
                                    })
                                    .catch(error => {
                                        resultDiv.innerHTML = `<div class="alert alert-danger mt-3" style="border-radius: 8px; border-left: 5px solid #dc3545;">
                                            <i class="fas fa-exclamation-triangle me-2"></i> An error occurred. Please try again.
                                        </div>`;
                                    })
                                    .finally(() => {
                                        submitBtn.disabled = false;
                                        submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Send Application';
                                    });
                                });
                            });
                            </script>
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