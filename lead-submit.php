<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "function/function.php";
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $phone = htmlspecialchars($_POST['phone']);
  $interest = htmlspecialchars($_POST['interest']);
  $budget = htmlspecialchars($_POST['budget']);
  $message = htmlspecialchars($_POST['message']);

  // Combine data for storage
  $full_message = "Interested In: $interest | Budget: $budget | Message: $message";

  $page_source = isset($_POST['source']) ? htmlspecialchars($_POST['source']) : "Contact Us Page";

  $data = array(
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'message' => $full_message,
      'page' => $page_source,
      'destination' => "Direct Inquiry",
      'tdate' => date('Y-m-d')
  );
  
  insert('enquiry', $data);

  $to = "team@a2prealtech.com";
  $subject = "New Property Inquiry from $name";
  $body = "
  Name: $name
  Email: $email
  Phone: $phone
  Interested In: $interest
  Budget: $budget
  Message: $message
  ";

  $headers = "From: noreply@a2prealtech.com";

  if (mail($to, $subject, $body, $headers)) {
    echo "success";
  } else {
    echo "error";
  }
}
?>

