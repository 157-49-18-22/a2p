<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Desktop, Android & iOS Support (Fixed for WhatsApp Web)
   ─────────────────────────────────────────────────────────────────────── */
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$_host = $_SERVER['HTTP_HOST'];
$_path = $_SERVER['REQUEST_URI'];
// Global Logo for Previews (A2P Logo)
$_global_logo = SITE_URL . "upload/290126125406LOGO.png?v=1.6";
$_current_url = $_protocol . "://" . $_host . $_path;
?>
<!-- Global Open Graph Tags (WhatsApp Fix) -->
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project. Find your dream home with us.">
<meta property="og:url" content="https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
<meta property="og:image" content="https://pink-sheep-796549.hostingersite.com/upload/290126125406LOGO.png?v=3.1">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="A2P Realtech Private Limited">
<meta name="twitter:description" content="Real Estate Company for Dwarka Expressway Project">
<meta name="twitter:image" content="<?php echo $_global_logo; ?>">
