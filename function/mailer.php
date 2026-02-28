<?php
/**
 * Optimized Mailer Helper — A2P Realtech
 * Uses a single SMTP connection to send both Admin and User emails.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$phpmailerBase = __DIR__ . '/../admin/vendor/phpmailer/phpmailer/src/';
require_once $phpmailerBase . 'Exception.php';
require_once $phpmailerBase . 'PHPMailer.php';
require_once $phpmailerBase . 'SMTP.php';

define('SMTP_HOST',     'smtp.gmail.com');
define('SMTP_PORT',     465); 
define('SMTP_USER',     'team@a2prealtech.com');
define('SMTP_PASS',     'peyutflqslgkfutv');
define('SMTP_FROM',     'team@a2prealtech.com');
define('SMTP_FROM_NAME','A2P Realtech');
define('ADMIN_EMAIL',   'team@a2prealtech.com');

function writeMailLog($msg) {
    $logFile = __DIR__ . '/../mail_debug.log';
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $msg\n", FILE_APPEND);
}

/**
 * Common function to send both Admin Notification and User Auto-Reply
 */
function sendAllMails($userEmail, $userName, $adminSubject, $adminBody) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = SMTP_PORT;
        $mail->CharSet    = 'UTF-8';

        // 1. Send to Admin
        $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
        $mail->addAddress(ADMIN_EMAIL, 'A2P Admin');
        $mail->isHTML(true);
        $mail->Subject = $adminSubject;
        $mail->Body    = $adminBody;
        $mail->send();
        writeMailLog("Admin Notification Sent to " . ADMIN_EMAIL);

        // Clear recipients for the next mail
        $mail->clearAddresses();

        // 2. Send Auto-Reply to User (If email is valid)
        if (!empty($userEmail) && filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $mail->addAddress($userEmail, $userName);
            $mail->Subject = 'Thank You for Your Luxury Property Inquiry — A2P Realtech';
            
            // Re-using the same branded template
            $mail->Body = getAutoReplyTemplate($userName);
            $mail->send();
            writeMailLog("Auto-Reply Sent to " . $userEmail);
        }

        return true;
    } catch (Exception $e) {
        writeMailLog("MAIL ERROR: " . $mail->ErrorInfo);
        return false;
    }
}

function getAutoReplyTemplate($toName) {
    return '
    <!DOCTYPE html>
    <html>
    <body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:30px 0;">
      <tr>
        <td align="center">
          <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);">
            <tr>
              <td style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);padding:40px 30px;text-align:center;">
                <h1 style="color:#d4af37;margin:0;font-size:26px;letter-spacing:1px;">A2P REALTECH</h1>
                <p style="color:#e0c97f;margin:8px 0 0;font-size:13px;letter-spacing:2px;">LUXURY PROPERTY ADVISORY</p>
              </td>
            </tr>
            <tr>
              <td style="padding:35px 40px 20px;">
                <p style="font-size:16px;color:#333;margin:0 0 12px;">Dear <strong>' . htmlspecialchars($toName) . '</strong>,</p>
                <p style="font-size:15px;color:#555;line-height:1.7;margin:0;">Thank you for contacting <strong>A2P Realtech</strong> regarding premium real estate opportunities.</p>
              </td>
            </tr>
            <tr>
              <td style="padding:0 40px 20px;">
                <ul style="color:#555;font-size:14px;line-height:2;">
                  <li><strong>Dwarka Expressway</strong> | <strong>Gurgaon</strong></li>
                  <li><strong>Faridabad</strong> | <strong>Noida</strong></li>
                </ul>
              </td>
            </tr>
            <tr>
              <td style="padding:20px 40px;background:#f9f5ea;text-align:center;">
                <p style="margin:0;color:#0f3460;font-size:15px;">Our senior advisor will connect with you shortly.</p>
              </td>
            </tr>
            <tr>
              <td style="padding:30px 40px;text-align:center;background:#1a1a2e;color:#888;font-size:11px;">
                © 2025 A2P Realtech Private Limited
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    </body>
    </html>';
}
