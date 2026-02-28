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

    // Prepare Admin Body
    $adminSubject = "New Property Inquiry from $name";
    $adminBody = "<h3>New Property Inquiry</h3>
                  <p><b>Name:</b> $name<br>
                  <b>Email:</b> $email<br>
                  <b>Phone:</b> $phone<br>
                  <b>Budget:</b> $budget<br>
                  <b>Source:</b> $page_source</p>";

    // Send BOTH in one go
    sendAllMails($email, $name, $adminSubject, $adminBody);

    echo "success";
}
?>
