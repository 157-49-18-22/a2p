<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "function/function.php";
    include "function/mailer.php";

    $name     = htmlspecialchars($_POST['name'] ?? '');
    $email    = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone    = htmlspecialchars($_POST['phone'] ?? '');
    $interest = htmlspecialchars($_POST['interest'] ?? '');
    $budget   = htmlspecialchars($_POST['budget'] ?? '');
    $message  = htmlspecialchars($_POST['message'] ?? '');

    // Combine data for storage
    $full_message = "Interested In: $interest | Budget: $budget | Message: $message";
    $page_source  = isset($_POST['source']) ? htmlspecialchars($_POST['source']) : "Contact Us Page";

    $data = [
        'name'        => $name,
        'email'       => $email,
        'phone'       => $phone,
        'message'     => $full_message,
        'page'        => $page_source,
        'destination' => "Direct Inquiry",
        'tdate'       => date('Y-m-d'),
    ];
    insert('enquiry', $data);

    // ── Admin notification ────────────────────────────────────────
    $adminSubject = "New Property Inquiry from $name";
    $adminBody = "
    <html><body style='font-family:Arial,sans-serif;color:#333;'>
    <h2 style='color:#0f3460;'>New Property Inquiry — A2P Realtech</h2>
    <table cellpadding='8' cellspacing='0' style='border-collapse:collapse;width:100%;max-width:500px;'>
      <tr style='background:#f9f5ea;'><td><strong>Name</strong></td><td>$name</td></tr>
      <tr><td><strong>Email</strong></td><td>$email</td></tr>
      <tr style='background:#f9f5ea;'><td><strong>Phone</strong></td><td>$phone</td></tr>
      <tr><td><strong>Interested In</strong></td><td>$interest</td></tr>
      <tr style='background:#f9f5ea;'><td><strong>Budget</strong></td><td>$budget</td></tr>
      <tr><td><strong>Message</strong></td><td>$message</td></tr>
      <tr style='background:#f9f5ea;'><td><strong>Source Page</strong></td><td>$page_source</td></tr>
    </table>
    </body></html>";

    sendAdminNotification($adminSubject, $adminBody);

    // ── Auto-reply to user ────────────────────────────────────────
    sendAutoReply($email, $name);

    echo "success";
}
?>
