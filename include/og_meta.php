<?php
/* ── A2P Realtech – Open Graph / WhatsApp Meta Tags ────────────────────
   Final Master Fix (Square Image & Top Priority)
   ─────────────────────────────────────────────────────────────────────── */
$_host = $_SERVER['HTTP_HOST'];
$_protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$_whatsapp_img = $_protocol . "://" . $_host . "/upload/whatsapp-thumb.png";
$_page_url = $_protocol . "://" . $_host . $_SERVER['REQUEST_URI'];
?>
<meta property="og:image" content="<?php echo $_whatsapp_img; ?>">
<meta property="og:image:secure_url" content="<?php echo $_whatsapp_img; ?>">
<meta property="og:image:width" content="512">
<meta property="og:image:height" content="512">
<meta property="og:image:type" content="image/png">
<meta itemprop="image" content="<?php echo $_whatsapp_img; ?>">
<link rel="image_src" href="<?php echo $_whatsapp_img; ?>">

<meta property="og:title" content="A2P Realtech Private Limited">
<meta property="og:description" content="Real Estate Company for Dwarka Expressway Project">
<meta property="og:url" content="<?php echo $_page_url; ?>">
<meta property="og:site_name" content="A2P Realtech">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="<?php echo $_whatsapp_img; ?>">











