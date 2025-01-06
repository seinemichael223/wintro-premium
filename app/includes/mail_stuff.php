<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

function notify_mail($username, $mailAddress) {
    try {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'wintropremium42@gmail.com';                    // SMTP username
        $mail->Password   = 'pgue rcot idob jabs';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
        $mail->Port       = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('wintropremium42@gmail.com');   // Set sender email and name
        $mail->addAddress($mailAddress);                            // Add recipient email

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'User Registration Complete';              // Set email subject
        $mail->Body    = "Hello! $username,<br><br>
                        Thank you for signing up at Wintro Premium. Contact us if you have any questions!<br><br>
                        If you did not sign up for anything, then please ignore this email.";

        $mail->send();
    } catch (Exception $e) {
        echo "<script>
                alert('Oops! Something went wrong. Mailer Error: {$mail->ErrorInfo}');
              </script>";
    }
}
?>
