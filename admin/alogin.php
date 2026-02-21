<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include('db.php');  // Ensure PDO is properly initialized here

function sendOTP($email, $otp)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST') ?: 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USERNAME') ?: 'mail@famepixel.in';
        $mail->Password = getenv('SMTP_PASSWORD') ?: 'Singhravi@#123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('mail@famepixel.in', 'OTP System');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = 'Your OTP code is: ' . $otp;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}

function generateOTP()
{
    return rand(100000, 999999);
}

$message = '';
$otpSent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Get password from POST

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            // Check if the email exists in the subadmin table
            $stmt = $pdo->prepare("SELECT * FROM subadmin WHERE username = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user) {
                // Directly compare plain text passwords
                if ($password === $user['password']) {
                    $otp = generateOTP();

                    // Update OTP
                    $stmt = $pdo->prepare("UPDATE subadmin SET otp = :otp, otp_created_at = NOW() WHERE username = :email");
                    $stmt->execute(['otp' => $otp, 'email' => $email]);

                    if (sendOTP($email, $otp)) {
                        // Redirect to OTP verification page with email as query parameter
                        header("Location: verify_otp.php?email=" . urlencode($email));
                        exit();
                    } else {
                        $message = 'Failed to send OTP. Please try again later.';
                    }
                } else {
                    $message = 'Email and password do not match.';
                }
            } else {
                $message = 'Your email is not registered with us.';
            }
        } catch (Exception $e) {
            error_log("Database Error: " . $e->getMessage());
            $message = 'Database error. Please try again later.';
        }
    } else {
        $message = 'Invalid email format.';
    }
}
?>


<?php
include('./function/function.php');
$umessage = '<div class="alert alert-info">
                Please login with your Username and Password.
            </div>';
check_login();
if (isset($_POST['login_me'])) {
    $umessage = login_me();
}
$no_visible_elements = true;
include('include/header.php'); ?>

<style>
    .authentication-wrapper .auth-cover-illustration {
        z-index: 1;
        max-inline-size: 38rem;
    }

    .w-100 {
        width: 100% !important;
    }

    .d-flex.col-12.col-lg-6.col-xl-6.align-items-center.authentication-bg.position-relative.py-sm-5.px-4.py-4 {
        background: white;
    }
</style>



<div class="authentication-wrapper authentication-cover">
    <!-- Logo -->
    <a href="#" class="auth-cover-brand d-flex align-items-center gap-2">
        <span class="app-brand-logo demo">
            <span style="color:var(--bs-primary);">
                <svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z" fill="currentColor" />
                    <path d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z" fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                    <path d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z" fill="currentColor" />
                    <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="currentColor" />
                    <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                    <path d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z" fill="currentColor" />
                    <defs>
                        <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-opacity="1" />
                            <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                        <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-opacity="1" />
                            <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
        </span>
        <span class="app-brand-text demo text-heading fw-bold"><?php echo $siteTitle; ?> </span>
    </a>
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-6 col-xl-6 align-items-center  p-5 pb-2">
            <img src="assets/img/illustrations/auth-login-illustration-light.png" class="auth-cover-illustration w-100" alt="auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.html" />
        </div>
        <!-- /Left Section -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-6 col-xl-6 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
            <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                <h4 class="mb-2">Welcome to <?php echo $siteTitle; ?> Admin! 👋</h4>
                <p class="mb-4">Please sign-in to your account </p>
                <?php echo $umessage; ?>

                <form id="formAuthentication" class="mb-3" method="post" action="">
                    <div class="form-floating form-floating-outline mb-3">
                        <input class="form-control" type="email" name="email" placeholder="Enter your email or username" autofocus>
                        <label for="email">Email or Username</label>
                    </div>
                    <div class="mb-3">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                    </div>
                 
                    <button class="btn btn-primary d-grid w-100" type="submit"  name="login_me" type="submit">
                    Send OTP
                    </button>
                </form>




                <div class="divider my-4">
                    <div class="divider-text">or</div>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                        <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                        <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                        <i class="tf-icons mdi mdi-24px mdi-github"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                        <i class="tf-icons mdi mdi-24px mdi-google"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Login -->
    </div>
</div>
<?php if (!empty($message)): ?>
    <script>
        alert('<?php echo addslashes($message); ?>');
    </script>
<?php endif; ?>























<?php include 'include/footer.php' ?>