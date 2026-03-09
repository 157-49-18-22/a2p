<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Desktop, Android & iOS Support (Fixed for WhatsApp Web)
   ─────────────────────────────────────────────────────────────────────── */
// Get current host dynamically to avoid cross-domain issues
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$_host = $_SERVER['HTTP_HOST'];
$_path = $_SERVER['REQUEST_URI'];
// Square image (512x512) for best Android + iOS + Desktop compatibility
$_full_logo_url = $_protocol . "://" . $_host . "/assets/images/favicons/android-chrome-512x512.png";
$_logo_width    = "512";
$_logo_height   = "512";
$_current_page_url = $_protocol . "://" . $_host . $_path;
?>
<!-- Open Graph / WhatsApp Preview Tags -->
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:url" content="<?php echo $_current_page_url; ?>">
<meta property="og:image" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:secure_url" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="<?php echo $_logo_width; ?>">
<meta property="og:image:height" content="<?php echo $_logo_height; ?>">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="A2P Realtech Private Limited">
<meta name="twitter:description" content="Real Estate Company for Dwarka Expressway Project">
<meta name="twitter:image" content="<?php echo $_full_logo_url; ?>">


