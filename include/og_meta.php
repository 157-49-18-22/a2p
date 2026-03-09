<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Desktop, Android & iOS Support (pink-sheep + a2prealtech.com)
   ─────────────────────────────────────────────────────────────────────── */
// Securely get the site URL
$_full_logo_url = SITE_URL . 'upload/290126125406LOGO.png';
$_current_page_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!-- Open Graph / WhatsApp Preview Tags -->
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:url" content="<?php echo $_current_page_url; ?>">
<meta property="og:image" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:secure_url" content="<?php echo $_full_logo_url; ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="500">
<meta property="og:image:height" content="500">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="A2P Realtech Private Limited">
<meta name="twitter:description" content="Real Estate Company for Dwarka Expressway Project">
<meta name="twitter:image" content="<?php echo $_full_logo_url; ?>">

