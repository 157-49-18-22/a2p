<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Works on ANY domain automatically (pink-sheep Hostinger + a2prealtech.com)
   Include this file inside <head> on EVERY page
   ─────────────────────────────────────────────────────────────────────── */
$_og_image = 'https://' . $_SERVER['HTTP_HOST'] . '/upload/290126125406LOGO.png';
$_og_url   = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!-- Open Graph / WhatsApp Preview Tags -->
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:image" content="<?php echo $_og_image; ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="400">
<meta property="og:url" content="<?php echo $_og_url; ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="A2P Realtech">
<!-- Twitter/X Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="A2P Realtech Private Limited">
<meta name="twitter:description" content="Real Estate Company for Dwarka Expressway Project">
<meta name="twitter:image" content="<?php echo $_og_image; ?>">
