<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "function/function.php";
    include "function/mailer.php";

    $name        = htmlspecialchars($_POST["name"] ?? '');
    $phone       = htmlspecialchars($_POST["phone"] ?? '');
    $email       = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL);
    $message     = nl2br(htmlspecialchars($_POST["message"] ?? ''));
    $page        = isset($_POST["page"])        ? htmlspecialchars($_POST["page"])        : "Brochure Download";
    $destination = isset($_POST["destination"]) ? htmlspecialchars($_POST["destination"]) : "";

    // Store in database
    $data = [
        'name'        => $name,
        'email'       => $email,
        'phone'       => $phone,
        'message'     => $message,
        'page'        => $page,
        'destination' => $destination,
        'tdate'       => date('Y-m-d'),
    ];
    insert('enquiry', $data);

    // ── Admin notification ────────────────────────────────────────
    $adminSubject = "New Brochure Inquiry from $name";
    $adminBody = "
    <html><body style='font-family:Arial,sans-serif;color:#333;'>
    <h2 style='color:#0f3460;'>New Brochure Download Inquiry — A2P Realtech</h2>
    <table cellpadding='8' cellspacing='0' style='border-collapse:collapse;width:100%;max-width:500px;'>
      <tr style='background:#f9f5ea;'><td><strong>Name</strong></td><td>$name</td></tr>
      <tr><td><strong>Email</strong></td><td>$email</td></tr>
      <tr style='background:#f9f5ea;'><td><strong>Phone</strong></td><td>$phone</td></tr>
      <tr><td><strong>Message</strong></td><td>$message</td></tr>
      <tr style='background:#f9f5ea;'><td><strong>Source Page</strong></td><td>$page</td></tr>
      <tr><td><strong>Property</strong></td><td>$destination</td></tr>
    </table>
    </body></html>";

    sendAdminNotification($adminSubject, $adminBody);

    // ── Auto-reply to user ────────────────────────────────────────
    sendAutoReply($email, $name);

    // ── Redirect ──────────────────────────────────────────────────
    $brochure_file = isset($_POST["brochure_file"]) ? $_POST["brochure_file"] : "";
    if (!empty($brochure_file)) {
        header("Location: thank-you.php?brochure=" . urlencode($brochure_file));
    } else {
        header("Location: thank-you.php");
    }
    exit();
} else {
    echo "<script>alert('Invalid Request.'); window.location.href='thank-you.php';</script>";
}
?>
