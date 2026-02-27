<?php include "function/function.php"; ?>
<?php
$sql_add = sqlfetch("select * from address where id=1");
if (count($sql_add))
    foreach ($sql_add as $pr_add) {
    }
?>


<?php
$pid = makeurlnormal($_GET['id']);
$sql_ser = sqlfetch("select * from subcategory where slug='$pid' and actstat=1");
if (count($sql_ser)) {
    foreach ($sql_ser as $subcategorydd) {

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title><?php echo $subcategorydd['meta_title']; ?></title>
            <meta name="description" content="<?php echo $subcategorydd['meta_description']; ?>">
            <meta name="keywords" content="<?php echo $subcategorydd['meta_keyword']; ?>">
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
    .services-one__single.wow.fadeInUp.animated {
    box-shadow: rgb(90 0 8) 0px 3px 8px;
}
/* Container for the block filter */
.block-filter {
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 5px;
    background-color: #f9f9f9;
    max-width: 753px;
    margin: 20px auto;
        box-shadow: 0px 5px 15px rgb(0 0 0 / 49%);
    transition: all 0.3s ease-in-out;
    position: relative;
}
}

/* Title of the filter */
.block-filter h6 {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
}

/* Scrollable filter box with flexbox */
.box-collapse {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
}

/* Label and input wrapper to keep them in the same column */
.filter-group {
    display: flex;
    flex-direction: column;
    flex: 1;
}

/* Labels for input fields */
.box-collapse label {
    font-size: 14px;
    color: #000;
    margin-bottom: 5px;
    font-weight:700;
}

/* Styling for number inputs */
.box-collapse input[type="number"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 14px;
    color: #333;
    box-sizing: border-box;
}

/* Change the input field on focus */
.box-collapse input[type="number"]:focus {
    border-color: #007bff;
    outline: none;
}




.bud {
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  color: white;
  background-color: #c00415;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  outline: none;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease-in-out;
  position: relative;
}

.bud:hover {
  background-color: #218838;
  transform: translateY(-5px);
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
}

.bud:active {
  animation: bounce 0.3s;
}

@keyframes bounce {
  0% { transform: scale(1); }
  30% { transform: scale(1.1); }
  50% { transform: scale(0.9); }
  70% { transform: scale(1.05); }
  100% { transform: scale(1); }
}


.services-one__img:after {
    position: relative !important;
  }
  
  .services-one__img:after {
     position: relative !important;
      
      
      
  }
  .services-one__img:before {
    position: relative!important;}
     
     

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
                        <li><?php echo $subcategorydd['name']; ?></li>
                    </ul>
                    <h2><?php echo $subcategorydd['name']; ?></h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->



       
        <section class="services-page">
            <div class="container">
                
                
                
                
<!--                          <div class="block-filter">-->
    <!--<h6 class="item-collapse">Price Filter</h6>-->
<!--    <div class="box-collapse scrollFilter">-->
<!--        <div class="filter-group">-->
<!--            <label for="minPrice">Min Price:</label>-->
<!--            <input class="ghd" type="number" id="minPrice" name="minPrice" min="0" value="0">-->
<!--        </div>-->
<!--        <div class="filter-group">-->
<!--            <label for="maxPrice">Max Price:</label>-->
<!--            <input class="ghd" type="number" id="maxPrice" name="maxPrice" min="0" value="50000">-->
<!--        </div>-->
<!--        <button id="applyFilter" class="bud mt-4">Apply Filter</button>-->
<!--    </div>-->
<!--</div>-->



                        
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <div class="row mt-5">

                    <?php
                    $sub_cat = sqlfetch("SELECT * FROM subproduct where subcat='" . $subcategorydd['id'] . "'  ORDER BY id DESC");
                    if (count($sub_cat)) {
                        foreach ($sub_cat as $subproductwww) {
                    ?>

                            <div class="col-xl-4 col-lg-4 col-md-6 productr">
                                <!--Services One Single-->
                                <div class="services-one__single wow fadeInUp" data-wow-delay="100ms">
                                    <div class="services-one__img">
                                          <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php">
                                        <img src="<?= SITE_URL; ?>upload/<?php echo $subproductwww['photo']; ?>" alt="" style="height:250px;">
                                       
                                       
                                    </a>
                                       
                                    </div>
                                    <div class="services-one__content">
                                        <h3 class="services-one__title"><a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php"><?php echo $subproductwww['name']; ?></a></h3>
                                        <p class="services-one__text"><i class="fa-solid fa-map-pin"></i> <?php echo $subproductwww['pro_lable']; ?></p>
                                        <p class="services-one__text price"><i class="fa-solid fa-map-pin"></i> <?php echo $subproductwww['pro_discountprice']; ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                 <div id="noProductsMessage" style="display: none; color: #ff0000; margin-top: 10px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; padding:20px; border-radius:10px;font-size: 24px;font-weight: 500; ">

                            <center><span> No Properties  Match The Selected Filter.
                                    <button class="bud" onclick="refreshPage()">Back To Page</button>
                                </span></center>
                                  </div>
            </div>
        </section>
       


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            $(document).ready(function() {
                // Apply the price filter
                $('#applyFilter').on('click', function() {
                    var minPrice = parseInt($('#minPrice').val()) || 0;
                    var maxPrice = parseInt($('#maxPrice').val()) || 50000;
                    filterProductsByPrice(minPrice, maxPrice);
                });

                // Function to filter products by price
                function filterProductsByPrice(min, max) {
                    var productsToShow = 0;

                    $('.productr').each(function() {
                        var productPrice = parseInt($(this).find('.price').text().replace('₹', ''));
                        if (productPrice >= min && productPrice <= max) {
                            $(this).show();
                            productsToShow++;
                        } else {
                            $(this).hide();
                        }
                    });

                    // Show a message if no products are available
                    if (productsToShow === 0) {
                        $('#noProductsMessage').show();
                    } else {
                        $('#noProductsMessage').hide();
                    }

                    // Set display to "none" for products not in the price range
                    $('.productr:not(:visible)').css('display', 'none');
                }
            });
        </script>


        <script>
            // JavaScript function to refresh the page
            function refreshPage() {
                // Use the location.reload() method to reload the page
                location.reload();
            }
        </script>




        <?php include 'include/footer.php' ?><?php
                                                break; // Stop after the first record
                                            }
                                        }
                                                ?>