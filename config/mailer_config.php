<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'lib/PHPMailer/src/Exception.php';
require_once 'lib/PHPMailer/src/PHPMailer.php';
require_once 'lib/PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                     //Enable verbose debug output
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';                                       //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'huydev2002@gmail.com';                     //SMTP username
    $mail->Password   = 'fzjxujpfkukgvhnn';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('huydev2002@gmail.com', 'User Manager');
    $mail->addReplyTo('huydev2002@gmail.com', 'user manager');


    $mail->isHTML(true);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
