<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Final Compatibility Fix for Desktop, Android & iOS
   ─────────────────────────────────────────────────────────────────────── */
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$_host = $_SERVER['HTTP_HOST'];
$_path = $_SERVER['REQUEST_URI'];
// Version 1.2 for fresh cache bypass
$_full_logo_url = $_protocol . "://" . $_host . "/upload/290126125406LOGO.png?v=1.2";
$_current_page_url = $_protocol . "://" . $_host . $_path;
?>
<!-- Essential Meta Tags -->
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo $_current_page_url; ?>">

<!-- Image Tags (WhatsApp Web/Desktop Compatibility) -->
<meta property="og:image" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:secure_url" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="600">
<meta property="og:image:height" content="600">
<meta itemprop="image" content="<?php echo $_full_logo_url; ?>">
<link rel="image_src" href="<?php echo $_full_logo_url; ?>">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="A2P Realtech Private Limited">
<meta name="twitter:description" content="Real Estate Company for Dwarka Expressway Project">
<meta name="twitter:image" content="<?php echo $_full_logo_url; ?>">



