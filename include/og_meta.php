<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Desktop, Android & iOS Support (Fixed for WhatsApp Web)
   ─────────────────────────────────────────────────────────────────────── */

// Use SITE_URL constants for consistency
$_canonical_url = SITE_URL . ltrim($_SERVER['REQUEST_URI'], '/');
if (strpos($_canonical_url, 'index.php') !== false) {
    $_canonical_url = SITE_URL; // Keep root clean
}

// Global Logo for Previews (A2P Logo)
$_global_logo = SITE_URL . "upload/290126125406LOGO.png"; // Removed query param for cleaner crawling
?>
<!-- Global Open Graph Tags (WhatsApp Fix) -->
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project. Find your dream home with us.">
<meta property="og:url" content="<?php echo $_canonical_url; ?>">
<link rel="image_src" href="<?php echo $_global_logo; ?>">

<!-- Schema.org for Google+ and WhatsApp Android -->
<meta itemprop="name" content="A2P Realtech Private Limited">
<meta itemprop="description" content="Real Estate Company for Dwarka Expressway Project. Find your dream home with us.">
<meta itemprop="image" content="<?php echo $_global_logo; ?>">

<!-- WhatsApp Android / Facebook Image support -->
<meta property="og:image" content="<?php echo $_global_logo; ?>">
<meta property="og:image:secure_url" content="<?php echo $_global_logo; ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="600">
<meta property="og:image:height" content="315">
<meta property="og:image:alt" content="A2P Realtech Logo">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="A2P Realtech Private Limited">
<meta name="twitter:description" content="Real Estate Company for Dwarka Expressway Project">
<meta name="twitter:image" content="<?php echo $_global_logo; ?>">
<meta name="twitter:image:alt" content="A2P Realtech Logo">
