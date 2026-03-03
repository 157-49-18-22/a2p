<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'function/mailer.php';

$email = 'devlop.ssts@gmail.com'; 
$name = 'Test User';
$otp = rand(100000, 999999);

echo "Attempting to send OTP to $email using password " . SMTP_PASS . " and port " . SMTP_PORT . " (TLS)<br>";

$mail = new PHPMailer\PHPMailer\PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "Final Test";
    $mail->Body    = "Your OTP is $otp";

    if($mail->send()) {
        echo "SUCCESS!";
    } else {
        echo "FAILED!";
    }
} catch (Exception $e) {
    echo "ERROR: " . $mail->ErrorInfo;
}
?>
