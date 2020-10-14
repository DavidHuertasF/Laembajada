
<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once('PHPMailer/src/PHPMailer.php');

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;                                        // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com.';                   // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
    $mail->Username   = 'mesaagua8@gmail.com';       // SMTP username
    $mail->Password   = 'mesaagua8admin';                 // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('mesaagua8@gmail.com', 'Sistema Mesa Agua');
    $mail->addAddress('david.huertasf@gmail.com', 'administrador encargado');     // Add a recipient
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nuevo Contacto';
    // $mail->Body    = 'Nuevo Contacto';
    $mail->Body    = '<p> w</p>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>