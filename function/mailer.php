<?php
/**
 * Mailer Helper — A2P Realtech
 * Uses PHPMailer with Gmail SMTP.
 * Sends:
 *  1. Admin notification (to team@a2prealtech.com)
 *  2. Auto-reply to the enquiry submitter
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Path to PHPMailer (already installed in admin/vendor)
$phpmailerBase = __DIR__ . '/../admin/vendor/phpmailer/phpmailer/src/';
require_once $phpmailerBase . 'Exception.php';
require_once $phpmailerBase . 'PHPMailer.php';
require_once $phpmailerBase . 'SMTP.php';

// ──────────────────────────────────────────────
//  Gmail SMTP credentials
// ──────────────────────────────────────────────
define('SMTP_HOST',     'smtp.gmail.com');
define('SMTP_PORT',     587);
define('SMTP_USER',     'team@a2prealtech.com');
define('SMTP_PASS',     'peyutflqslgkfutv');
define('SMTP_FROM',     'team@a2prealtech.com');
define('SMTP_FROM_NAME','A2P Realtech');
define('ADMIN_EMAIL',   'team@a2prealtech.com');

/**
 * Returns a configured PHPMailer instance (SMTP / Gmail).
 */
function getMailer(): PHPMailer
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->CharSet    = 'UTF-8';
    $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
    return $mail;
}

/**
 * Send admin notification email.
 *
 * @param string $subject   Email subject
 * @param string $htmlBody  HTML body
 * @return bool
 */
function sendAdminNotification(string $subject, string $htmlBody): bool
{
    try {
        $mail = getMailer();
        $mail->addAddress(ADMIN_EMAIL, 'A2P Realtech Team');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = strip_tags($htmlBody);
        return $mail->send();
    } catch (Exception $e) {
        error_log('[A2P Mailer] Admin notification failed: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send auto-reply to the enquiry user.
 *
 * @param string $toEmail  Recipient email
 * @param string $toName   Recipient name
 * @return bool
 */
function sendAutoReply(string $toEmail, string $toName): bool
{
    if (empty($toEmail) || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $subject = 'Thank You for Your Luxury Property Inquiry — A2P Realtech';

    $body = '
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank You</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:30px 0;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);">

        <!-- Header -->
        <tr>
          <td style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);padding:40px 30px;text-align:center;">
            <h1 style="color:#d4af37;margin:0;font-size:26px;letter-spacing:1px;">A2P REALTECH</h1>
            <p style="color:#e0c97f;margin:8px 0 0;font-size:13px;letter-spacing:2px;">LUXURY PROPERTY ADVISORY</p>
          </td>
        </tr>

        <!-- Greeting -->
        <tr>
          <td style="padding:35px 40px 20px;">
            <p style="font-size:16px;color:#333;margin:0 0 12px;">Dear <strong>' . htmlspecialchars($toName) . '</strong>,</p>
            <p style="font-size:15px;color:#555;line-height:1.7;margin:0;">
              Thank you for contacting <strong>A2P Realtech</strong> regarding premium real estate opportunities in:
            </p>
          </td>
        </tr>

        <!-- Locations -->
        <tr>
          <td style="padding:0 40px 20px;">
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9f5ea;border-left:4px solid #d4af37;border-radius:4px;padding:0;">
              <tr>
                <td style="padding:16px 20px;">
                  <ul style="margin:0;padding-left:18px;color:#555;font-size:14px;line-height:2;">
                    <li><strong>Dwarka Expressway</strong></li>
                    <li><strong>Gurgaon</strong></li>
                    <li><strong>Faridabad</strong></li>
                    <li><strong>Noida</strong></li>
                  </ul>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- Specializations -->
        <tr>
          <td style="padding:0 40px 25px;">
            <p style="font-size:15px;color:#333;margin:0 0 14px;">We specialize in curated luxury offerings including:</p>
            <table width="100%" cellpadding="0" cellspacing="8">
              <tr>
                <td width="50%" style="padding:8px 12px;background:#0f3460;border-radius:6px;color:#ffffff;font-size:13px;">✔ Luxury Flats &amp; Apartments</td>
                <td width="8"></td>
                <td width="50%" style="padding:8px 12px;background:#0f3460;border-radius:6px;color:#ffffff;font-size:13px;">✔ Premium Villas</td>
              </tr>
              <tr><td colspan="3" height="8"></td></tr>
              <tr>
                <td style="padding:8px 12px;background:#0f3460;border-radius:6px;color:#ffffff;font-size:13px;">✔ Modern Duplex Homes</td>
                <td></td>
                <td style="padding:8px 12px;background:#0f3460;border-radius:6px;color:#ffffff;font-size:13px;">✔ SCO Plots &amp; Commercial Investments</td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- Message -->
        <tr>
          <td style="padding:0 40px 25px;">
            <p style="font-size:15px;color:#555;line-height:1.7;margin:0;">
              Our <strong>senior property advisor</strong> will personally review your requirements and connect with you shortly to provide tailored options based on your preferred location, budget, and investment goals.
            </p>
          </td>
        </tr>

        <!-- Contact Info -->
        <tr>
          <td style="padding:0 40px 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f0f0;border-radius:8px;">
              <tr>
                <td style="padding:20px 24px;">
                  <p style="margin:0 0 6px;font-size:13px;color:#888;text-transform:uppercase;letter-spacing:1px;">Urgent Inquiry? Contact Us Directly</p>
                  <p style="margin:0 0 6px;font-size:15px;color:#333;">📞 <a href="tel:+918130525001" style="color:#0f3460;text-decoration:none;font-weight:bold;">+91-8130525001</a></p>
                  <p style="margin:0 0 6px;font-size:15px;color:#333;">📞 <a href="tel:+918130510678" style="color:#0f3460;text-decoration:none;font-weight:bold;">+91-8130510678</a></p>
                  <p style="margin:0;font-size:15px;color:#333;">📧 <a href="mailto:team@a2prealtech.com" style="color:#0f3460;text-decoration:none;font-weight:bold;">team@a2prealtech.com</a></p>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- Sign-off -->
        <tr>
          <td style="padding:0 40px 30px;">
            <p style="font-size:15px;color:#555;margin:0 0 4px;">We look forward to assisting you in securing a premium property in one of NCR\'s most sought-after destinations.</p>
            <br>
            <p style="font-size:15px;color:#333;margin:0;"><strong>Warm regards,</strong></p>
            <p style="font-size:14px;color:#555;margin:4px 0 0;">Luxury Property Advisory Team</p>
            <p style="font-size:14px;color:#d4af37;margin:2px 0 0;font-weight:bold;">A2P Realtech</p>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style="background:#1a1a2e;padding:18px 30px;text-align:center;">
            <p style="color:#888;font-size:11px;margin:0;">© 2025 A2P Realtech Private Limited. All rights reserved.</p>
            <p style="color:#666;font-size:10px;margin:6px 0 0;">This is an automated response. Please do not reply to this email directly.</p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>';

    try {
        $mail = getMailer();
        $mail->addAddress($toEmail, $toName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = "Dear $toName,\n\nThank you for contacting A2P Realtech regarding premium real estate opportunities.\n\nOur senior property advisor will personally review your requirements and connect with you shortly.\n\nFor urgent inquiries:\nPhone: +91-8130525001 / +91-8130510678\nEmail: team@a2prealtech.com\n\nWarm regards,\nLuxury Property Advisory Team\nA2P Realtech";
        return $mail->send();
    } catch (Exception $e) {
        error_log('[A2P Mailer] Auto-reply failed: ' . $e->getMessage());
        return false;
    }
}
