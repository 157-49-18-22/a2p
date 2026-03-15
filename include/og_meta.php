<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Desktop, Android & iOS Support (Fixed for WhatsApp Web)
   ─────────────────────────────────────────────────────────────────────── */
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$_host = $_SERVER['HTTP_HOST'];
$_path = $_SERVER['REQUEST_URI'];

// Force Canonical URL for better preview consistency
$_base_url = (strpos($_host, 'a2prealtech.com') !== false) ? "https://a2prealtech.com/" : SITE_URL;

// Global Logo for Previews (A2P Logo) - Bumped version for cache busting
$_global_logo = $_base_url . "upload/290126125406LOGO.png?v=1.5";
$_current_url = $_protocol . "://" . $_host . $_path;
?>
<!-- Global Open Graph Tags (WhatsApp Fix) -->
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo $_current_url; ?>">
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project. Find your dream home with us.">

<!-- Image Tags - Placed high for Android/WhatsApp -->
<meta property="og:image" content="<?php echo $_global_logo; ?>">
<meta property="og:image:secure_url" content="<?php echo $_global_logo; ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="A2P Realtech Logo">

<!-- Schema.org for Google+ / WhatsApp / Android -->
<meta itemprop="name" content="A2P Realtech Private Limited">
<meta itemprop="description" content="Real Estate Company for Dwarka Expressway Project. Find your dream home with us.">
<meta itemprop="image" content="<?php echo $_global_logo; ?>">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="A2P Realtech Private Limited">
<meta name="twitter:description" content="Real Estate Company for Dwarka Expressway Project">
<meta name="twitter:image" content="<?php echo $_global_logo; ?>">

<!-- Additional Thumbnail for older Android devices -->
<link rel="image_src" href="<?php echo $_global_logo; ?>">
