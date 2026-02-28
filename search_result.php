<?php
include "function/function.php";

if (isset($_GET['query'])) {
    $search_redir = trim($_GET['query']);
    $searchLower_redir = strtolower($search_redir);
    
    // 1. Blog redirection
    $blogKeywords = ['blog', 'news', 'article', 'update', 'blogs'];
    foreach ($blogKeywords as $kw) {
        if (strpos($searchLower_redir, $kw) !== false) {
            header('Location: ' . SITE_URL . 'blog.php');
            exit();
        }
    }

    // 2. Contact redirection
    $contactKeywords_redir = [
        'address', 'location', 'phone', 'mobile', 'call', 'email', 'contact',
        'office', 'address?', 'pincode', 'corporate', 'connect', 'reach',
        'enquiry', 'help', 'support', 'number', 'whatsapp'
    ];
    
    $isKeywordMatch_redir = false;
    foreach ($contactKeywords_redir as $kw) {
        if (strpos($searchLower_redir, $kw) !== false) {
            $isKeywordMatch_redir = true;
            break;
        }
    }

    $isPhone_redir = preg_match('/\d{7,}/', preg_replace('/[^\d]/', '', $search_redir));
    $isEmail_redir = filter_var($search_redir, FILTER_VALIDATE_EMAIL) ||
               preg_match('/[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/', $search_redir);

    if ($isKeywordMatch_redir || $isPhone_redir || $isEmail_redir) {
        header('Location: ' . SITE_URL . 'contact.php');
        exit();
    }
}
?>
<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', 1);
?>



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
    /* Highlight - Match Image 2 (just bold and red) */
    strong {
        background-color: transparent;
        color: inherit;
        font-weight: 900;
        text-decoration: none;
    }

    .services-one__single.wow.fadeInUp.animated {
        box-shadow: rgb(90 0 8) 0px 3px 12px !important;
    }

    .services-one__single {
        margin-bottom: 30px;
        background: #fff;
        border-radius: 0px !important; /* Square as per Image 2 */
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #ddd;
    }

    .services-one__img {
        position: relative;
        height: 250px;
        overflow: hidden;
    }

    .services-one__img img {
        height: 100%;
        width: 100%;
        object-fit: fill; /* Ensure whole image is displayed correctly */
        display: block;
    }

    .services-one__content {
        padding: 25px;
    }

    .services-one__title {
        font-size: 22px !important;
        font-weight: 800 !important;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .services-one__title a {
        color: #c00415 !important;
        text-decoration: none !important;
        display: block;
    }

    .services-one__title a strong {
        color: #c00415 !important;
    }

    .price {
        font-size: 20px;
        font-weight: 800;
        color: #c00415;
        margin-top: 15px;
        display: block;
    }

    h3.cool {
        margin-bottom: 32px;
        font-weight: 800;
        font-size: 24px;
        color: #222;
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
            $searchSafe = "%$search%";

            // --- Fetch Subproducts ---
            $stmt = $pdo->prepare("SELECT * FROM subproduct WHERE name LIKE ?");
            $stmt->execute([$searchSafe]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // If no direct product match, search via subcategory
            if (empty($products)) {
                $stmt2 = $pdo->prepare("SELECT id FROM subcategory WHERE name LIKE ?");
                $stmt2->execute([$searchSafe]);
                $subcat = $stmt2->fetch(PDO::FETCH_ASSOC);

                if ($subcat) {
                    $subcatId = $subcat['id'];
                    $stmt3 = $pdo->prepare("SELECT * FROM subproduct WHERE subcat = ?");
                    $stmt3->execute([$subcatId]);
                    $products = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            // --- Fetch Offers ---
            $stmt4 = $pdo->prepare("SELECT * FROM offer WHERE name LIKE ?");
            $stmt4->execute([$searchSafe]);
            $offers = $stmt4->fetchAll(PDO::FETCH_ASSOC);

            echo '<div class="row"><div class="col-md-12">';
            echo '<h3 class="cool">Search Results for: "' . htmlspecialchars($search) . '"</h3>';

            // Show products
            if (!empty($products)) {
                echo '<div class="row">';
                foreach ($products as $subproductwww) {
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 productr">
                        <div class="services-one__single wow fadeInUp" data-wow-delay="100ms">
                            <div class="services-one__img">
                                <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php">
                                    <img src="<?= SITE_URL; ?>upload/<?php echo $subproductwww['photo']; ?>" alt="">
                                </a>
                            </div>
                            <div class="services-one__content">
                                <h3 class="services-one__title">
                                    <a href="<?= SITE_URL; ?>service_detail/<?php echo makeurlnamebynameCategory($subproductwww['name']); ?>.php">
                                        <?php echo highlightTerms(htmlspecialchars($subproductwww['name']), $search); ?>
                                    </a>
                                </h3>
                                <p class="services-one__text"><i class="fa-solid fa-map-pin"></i> <?php echo htmlspecialchars($subproductwww['pro_lable']); ?></p>
                                <p class="services-one__text price"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo htmlspecialchars($subproductwww['pro_discountprice']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            }

            // Show offers
            if (!empty($offers)) {
                echo '<div class="row">';
                foreach ($offers as $offer) {
                    ?>
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                        <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php">
                            <div class="blog-one__single">
                                <div class="blog-one__img">
                                    <img src="upload/<?php echo $offer['photo']; ?>" alt="<?php echo htmlspecialchars($offer['name']); ?>" style="height: 220px; width: 100%; object-fit: cover;">
                                </div>
                                <div class="blog-one__content">
                                    <div class="blog-one__date">
                                        <p><?php echo htmlspecialchars($offer['des1']); ?></p>
                                    </div>
                                    <ul class="list-unstyled blog-one__meta">
                                        <li><a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php"><i class="far fa-user-circle"></i> <?php echo htmlspecialchars($offer['by_blog']); ?></a></li>
                                        <li><span>/</span></li>
                                    </ul>
                                    <h3 class="blog-one__title">
                                        <a href="<?= SITE_URL; ?>blog_detail/<?php echo makeurlnamebynameCategory($offer['name']); ?>.php">
                                            <?php echo highlightTerms(custom_echo(htmlspecialchars($offer['name']), 40), $search); ?>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                echo '</div>';
            }

            if (empty($products) && empty($offers)) {
                echo '<div class="alert alert-info">No results found for: "' . htmlspecialchars($search) . '"</div>';
            }

            echo '</div></div>';
        } else {
            echo '<div class="alert alert-warning">Please enter a search term</div>';
        }
        ?>
    </div>
</section>
    </div>
</section>

<?php include 'include/footer.php'; ?>
