<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Final Dynamic Fix for Both Domains (v5.0)
   ─────────────────────────────────────────────────────────────────────── */
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$_host = $_SERVER['HTTP_HOST'];
$_path = $_SERVER['REQUEST_URI'];
// Dynamic absolute URL for image and page
$_dynamic_img = $_protocol . "://" . $_host . "/upload/290126125406LOGO.png?v=5.0";
$_dynamic_url = $_protocol . "://" . $_host . $_path;
?>
<!-- Header Prefixes -->
<meta prefix="og: http://ogp.me/ns#">
<meta property="fb:app_id" content="123456789"> 

<!-- Image Priority (Desktop/Android) -->
<meta property="og:image" content="<?php echo $_dynamic_img; ?>">
<meta property="og:image:secure_url" content="<?php echo $_dynamic_img; ?>">
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">
<meta property="og:image:type" content="image/png">

<!-- Core Metadata -->
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:url" content="<?php echo $_dynamic_url; ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="A2P Realtech">
<link rel="canonical" href="<?php echo $_dynamic_url; ?>">

<!-- Fallbacks -->
<meta itemprop="image" content="<?php echo $_dynamic_img; ?>">
<link rel="image_src" href="<?php echo $_dynamic_img; ?>">

<!-- Twitter -->
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="<?php echo $_dynamic_img; ?>">










