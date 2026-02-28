<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "function/function.php";
    include "function/mailer.php";

    $name     = isset($_POST['name'])     ? htmlspecialchars($_POST['name'])                           : '';
    $email    = isset($_POST['email'])    ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)         : '';
    $phone    = isset($_POST['phone'])    ? htmlspecialchars($_POST['phone'])                          : '';
    $interest = isset($_POST['interest']) ? htmlspecialchars($_POST['interest'])                       : '';
    $budget   = isset($_POST['budget'])   ? htmlspecialchars($_POST['budget'])                         : '';
    $message  = isset($_POST['message'])  ? htmlspecialchars($_POST['message'])                        : '';

    $data = [
        'name'     => $name,
        'email'    => $email,
        'phone'    => $phone,
        'interest' => $interest,
        'budget'   => $budget,
        'message'  => $message,
        'tdate'    => date('Y-m-d'),
    ];
    insert('chatbot_leads', $data);

    // ── Admin notification ────────────────────────────────────────
    $adminSubject = "New Chatbot Lead from $name";
    $adminBody = "
    <html><body style='font-family:Arial,sans-serif;color:#333;'>
    <h2 style='color:#0f3460;'>New Chatbot Lead — A2P Realtech</h2>
    <table cellpadding='8' cellspacing='0' style='border-collapse:collapse;width:100%;max-width:500px;'>
      <tr style='background:#f9f5ea;'><td><strong>Name</strong></td><td>$name</td></tr>
      <tr><td><strong>Email</strong></td><td>$email</td></tr>
      <tr style='background:#f9f5ea;'><td><strong>Phone</strong></td><td>$phone</td></tr>
      <tr><td><strong>Interested In</strong></td><td>$interest</td></tr>
      <tr style='background:#f9f5ea;'><td><strong>Budget</strong></td><td>$budget</td></tr>
      <tr><td><strong>Message</strong></td><td>$message</td></tr>
    </table>
    </body></html>";

    sendAdminNotification($adminSubject, $adminBody);

    // ── Auto-reply to user ────────────────────────────────────────
    sendAutoReply($email, $name);

    echo "success";
}
?>
