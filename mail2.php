<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "function/function.php";
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = nl2br(htmlspecialchars($_POST["message"]));
    $page = isset($_POST["page"]) ? htmlspecialchars($_POST["page"]) : "Brochure Download";
    $destination = isset($_POST["destination"]) ? htmlspecialchars($_POST["destination"]) : "";

    // Store in database
    $data = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message,
        'page' => $page,
        'destination' => $destination,
        'tdate' => date('Y-m-d')
    );
    insert('enquiry', $data);

    $to = "team@a2prealtech.com"; // Replace with your email
    $subject = "New Contact Form Submission";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $emailBody = "
        <html>
        <head>
            <title>New Contact Form Submission</title>
        </head>
        <body>
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        </body>
        </html>
    ";

    if (mail($to, $subject, $emailBody, $headers)) {
        echo "<script>alert('Message sent successfully!'); window.location.href='thank-you.php';</script>";
    } else {
        echo "<script>alert('Failed to send message. Try again later.'); window.location.href='thank-you.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Request.'); window.location.href='thank-you.php';</script>";
}
?>
