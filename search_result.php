<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 1);

include "function/function.php"; ?>



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


<?php
// Include header
include 'include/header.php';

// Function to highlight search terms
function highlightTerms($text, $term) {
    if (!$term || $text === null) return (string)$text;
    return preg_replace('/(' . preg_quote((string)$term, '/') . ')/i', '<strong>$1</strong>', (string)$text);
}
?>

<style>
    /* Theme-matched search term highlight */
    strong {
        background-color: rgba(90, 0, 8, 0.15); /* soft maroon tint */
        color: #5a0008; /* theme color */
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: 600;
    }

    strong:hover {
        background-color: rgba(90, 0, 8, 0.28); /* deeper tint on hover */
        transition: background-color 0.3s ease;
    }

    .services-one__single {
        border-radius: 15px;
        overflow: hidden;
        background: #fff;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .services-one__single:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(192, 4, 21, 0.15);
        border-color: rgba(192, 4, 21, 0.2);
    }

    .services-one__img img {
        transition: transform 0.6s ease;
    }

    .services-one__single:hover .services-one__img img {
        transform: scale(1.1);
    }

    .services-one__content {
        padding: 25px !important;
    }

    .services-one__title a {
        color: #222;
        font-weight: 700;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .services-one__title a:hover {
        color: #c00415;
    }

    .price {
        font-size: 1.3rem;
        font-weight: 800;
        color: #c00415;
        margin-top: 10px;
    }

    h3.cool {
        font-weight: 800;
        letter-spacing: -1px;
        border-left: 5px solid #c00415;
        padding-left: 20px;
        margin-bottom: 40px;
    }
</style>

<section class="page-header">
    <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)"></div>
    <div class="container">
        <div class="page-header__inner">
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="<?= SITE_URL; ?>">Home</a></li>
                <li><span>/</span></li>
                <li>
                    <?php 
                    if (isset($_GET['query']) && $_GET['query'] != '') {
                        echo highlightTerms('Search', $_GET['query']); 
                    } else {
                        echo 'Search';
                    }
                    ?>
                </li>
            </ul>
            <h2>
                <?php 
                if (isset($_GET['query']) && $_GET['query'] != '') {
                    echo 'Search Results for: "' . highlightTerms(htmlspecialchars($_GET['query']), $_GET['query']) . '"';
                } else {
                    echo 'Search';
                }
                ?>
            </h2>
        </div>
    </div>
</section>

<section class="services-page">
    <div class="container">
        <?php
        $pdo = getPDOObject();

        if (isset($_GET['query'])) {
            $search = trim($_GET['query']);
            $location = isset($_GET['location']) ? trim($_GET['location']) : '';
            $searchSafe = "%$search%";
            $locSafe = "%$location%";

            // ─── CONTACT REDIRECT: Phone or Email detected ───────────────────
            // Phone: contains 5+ consecutive digits (handles +91-813..., 8130525001, etc.)
            $isPhone = preg_match('/\d{5,}/', preg_replace('/[\s\-\(\)\+]/', '', $search));
            // Email: standard email pattern
            $isEmail = filter_var($search, FILTER_VALIDATE_EMAIL) ||
                       preg_match('/[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/', $search);

            if ($isPhone || $isEmail) {
                header('Location: ' . SITE_URL . 'contact.php');
                exit();
            }
            // ─────────────────────────────────────────────────────────────────

            // --- Fetch Subproducts (Searching in Name, Meta Title, Keywords, Location, City, and Developer) ---
            $query = "SELECT DISTINCT * FROM subproduct 
                      WHERE (name LIKE ? 
                      OR meta_title LIKE ? 
                      OR meta_keyword LIKE ? 
                      OR pro_lable LIKE ?
                      OR city LIKE ?
                      OR developer LIKE ?)";
            
            $params = [$searchSafe, $searchSafe, $searchSafe, $searchSafe, $searchSafe, $searchSafe];
            
            if(!empty($location)) {
                $query .= " AND (pro_lable LIKE ? OR city LIKE ?)";
                $params[] = $locSafe;
                $params[] = $locSafe;
            }
            
            $query .= " AND actstat = 1";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // If no products found, try searching in subcategory names
            if (empty($products)) {
                $stmt2 = $pdo->prepare("SELECT id FROM subcategory WHERE name LIKE ? AND actstat = 1");
                $stmt2->execute([$searchSafe]);
                $subcat = $stmt2->fetch(PDO::FETCH_ASSOC);

                if ($subcat) {
                    $subcatId = $subcat['id'];
                    $stmt3 = $pdo->prepare("SELECT DISTINCT * FROM subproduct WHERE subcat = ? AND actstat = 1");
                    $stmt3->execute([$subcatId]);
                    $products = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            // --- Fetch Offers (Blogs) ---
            $stmt4 = $pdo->prepare("SELECT * FROM offer WHERE name LIKE ? OR des1 LIKE ?");
            $stmt4->execute([$searchSafe, $searchSafe]);
            $offers = $stmt4->fetchAll(PDO::FETCH_ASSOC);

            // --- Fetch Media Gallery (fixed_delivery_time) ---
            $stmt5 = $pdo->prepare("SELECT * FROM fixed_delivery_time WHERE name LIKE ? OR meta_title LIKE ?");
            $stmt5->execute([$searchSafe, $searchSafe]);
            $mediaItems = $stmt5->fetchAll(PDO::FETCH_ASSOC);

            echo '<div class="row"><div class="col-md-12">';
            echo '<h3 class="cool">Search Results for: "' . htmlspecialchars($search) . '"</h3>';

            // Show products
            if (!empty($products)) {
                echo '<h4 class="mb-4 mt-5">Projects & Properties</h4>';
                echo '<div class="row">';
                foreach ($products as $subproductwww) {
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 productr mb-4">
                        <div class="services-one__single wow fadeInUp" data-wow-delay="100ms">
                            <div class="services-one__img">
                                <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php">
                                    <img src="<?= SITE_URL; ?>upload/<?php echo $subproductwww['photo']; ?>" alt="" style="height:250px; width:100%; object-fit:cover;">
                                </a>
                            </div>
                            <div class="services-one__content">
                                <h3 class="services-one__title">
                                    <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php">
                                        <?php echo highlightTerms(htmlspecialchars($subproductwww['name']), $search); ?>
                                    </a>
                                </h3>
                                <p class="services-one__text"><i class="fa-solid fa-map-pin"></i> <?php echo htmlspecialchars($subproductwww['pro_lable']); ?></p>
                                <?php if(!empty($subproductwww['developer'])) { ?>
                                    <p class="services-one__text"><i class="fa-solid fa-user-tie"></i> <strong>Developer:</strong> <?php echo htmlspecialchars($subproductwww['developer']); ?></p>
                                <?php } ?>
                                <p class="services-one__text price"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo htmlspecialchars($subproductwww['pro_discountprice']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            }

            // Show Media Gallery Results
            if (!empty($mediaItems)) {
                echo '<hr class="my-5">';
                echo '<h4 class="mb-4">Media Gallery Results</h4>';
                echo '<div class="row">';
                foreach ($mediaItems as $media) {
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                        <div class="blog-one__single wow fadeInUp" data-wow-delay="100ms">
                            <div class="blog-one__img">
                                <img src="upload/<?php echo $media['photo']; ?>" alt="<?php echo htmlspecialchars($media['name']); ?>" style="height:250px; width:100%; object-fit:cover;">
                            </div>
                            <div class="blog-one__content">
                                <h3 class="blog-one__title text-center">
                                    <a href="<?= SITE_URL; ?>media-gallery-detail/<?php echo makeurlnamebynameCategory($media['name']); ?>.php">
                                        <?php echo highlightTerms(htmlspecialchars($media['name']), $search); ?>
                                    </a>
                                </h3>
                                <div class="text-center">
                                    <a href="<?= SITE_URL; ?>media-gallery-detail/<?php echo makeurlnamebynameCategory($media['name']); ?>.php" class="btn btn-sm btn-danger mt-3">View Gallery</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            }

            // Show Offers (Blogs)
            if (!empty($offers)) {
                echo '<hr class="my-5">';
                echo '<h4 class="mb-4">News & Blogs</h4>';
                echo '<div class="row">';
                foreach ($offers as $offer) {
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                        <div class="blog-one__single">
                            <div class="blog-one__img">
                                <img src="upload/<?php echo $offer['photo']; ?>" alt="<?php echo htmlspecialchars($offer['name']); ?>" style="height:220px; width:100%; object-fit:cover;">
                            </div>
                            <div class="blog-one__content">
                                <div class="blog-one__date">
                                    <p><?php echo htmlspecialchars($offer['des1']); ?></p>
                                </div>
                                <h3 class="blog-one__title">
                                    <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php">
                                        <?php echo highlightTerms(custom_echo(htmlspecialchars($offer['name']), 45), $search); ?>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            }

            if (empty($products) && empty($offers) && empty($mediaItems)) {
                echo '<div class="alert alert-info text-center py-5">
                    <i class="fa fa-frown fa-3x mb-3 text-muted"></i>
                    <h4>No direct results found for: "' . htmlspecialchars($search) . '"</h4>
                    <p>Try searching for a different keyword or check our categories.</p>
                </div>';
            }

            echo '</div></div>';
        } else {
            echo '<div class="alert alert-warning text-center py-4">Please enter a search term above to begin.</div>';
        }
        ?>
    </div>
</section>
    </div>
</section>

<?php include 'include/footer.php'; ?>
