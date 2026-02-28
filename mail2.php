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

    // Prepare Admin Body
    $adminSubject = "New Brochure Inquiry from $name";
    $adminBody = "<h3>New Brochure Inquiry</h3>
                  <p><b>Name:</b> $name<br>
                  <b>Email:</b> $email<br>
                  <b>Phone:</b> $phone<br>
                  <b>Message:</b> $message<br>
                  <b>Property / Destination:</b> $destination<br>
                  <b>Source Page:</b> $page</p>";

    // Send BOTH in one go
    sendAllMails($email, $name, $adminSubject, $adminBody);

    // Redirect to thank-you
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
