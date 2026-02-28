<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "function/function.php";
  $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
  $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
  $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
  $interest = isset($_POST['interest']) ? htmlspecialchars($_POST['interest']) : '';
  $budget = isset($_POST['budget']) ? htmlspecialchars($_POST['budget']) : '';
  $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

  $data = array(
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'interest' => $interest,
      'budget' => $budget,
      'message' => $message,
      'tdate' => date('Y-m-d')
  );
  
  insert('chatbot_leads', $data);
  echo "success";
}
?>
