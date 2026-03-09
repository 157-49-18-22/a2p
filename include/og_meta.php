<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Direct Public Path Fix (Top Priority)
   ─────────────────────────────────────────────────────────────────────── */
$_host = $_SERVER['HTTP_HOST'];
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
// Using a path that is known to be public and functional
$_og_img_url = $_protocol . "://" . $_host . "/assets/images/favicons/android-chrome-512x512.png";
$_og_page_url = $_protocol . "://" . $_host . $_SERVER['REQUEST_URI'];
?>
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:image" content="<?php echo $_og_img_url; ?>">
<meta property="og:image:secure_url" content="<?php echo $_og_img_url; ?>">
<meta property="og:image:width" content="512">
<meta property="og:image:height" content="512">
<meta property="og:url" content="<?php echo $_og_page_url; ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="A2P Realtech">

<meta itemprop="image" content="<?php echo $_og_img_url; ?>">
<link rel="image_src" href="<?php echo $_og_img_url; ?>">

<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="<?php echo $_og_img_url; ?>">












