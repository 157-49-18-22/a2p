<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Final Compatibility Fix (Desktop & Android priority)
   ─────────────────────────────────────────────────────────────────────── */
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$_host = $_SERVER['HTTP_HOST'];
// Using the square favicon image which is highly compatible with WhatsApp Web
$_full_logo_url = $_protocol . "://" . $_host . "/assets/images/favicons/android-chrome-512x512.png?v=1.5";
$_current_page_url = $_protocol . "://" . $_host . $_SERVER['REQUEST_URI'];
?>
<!-- WhatsApp/FB priority tags -->
<meta property="og:image" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:secure_url" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="512">
<meta property="og:image:height" content="512">

<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:url" content="<?php echo $_current_page_url; ?>">
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:type" content="website">

<!-- Android/Desktop Fallbacks -->
<meta itemprop="image" content="<?php echo $_full_logo_url; ?>">
<link rel="image_src" href="<?php echo $_full_logo_url; ?>">

<!-- Twitter -->
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="<?php echo $_full_logo_url; ?>">




