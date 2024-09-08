<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../../../src/PHPMailer.php';
include '../../../src/SMTP.php';
include '../../../src/Exception.php';


if (isset($_POST['email_send'])) {

    $sender_name = $_POST['name'];
    $sender_email = $_POST['email'];
    $sender_body = $_POST['body'];

    if ($sender_name && $sender_email && $sender_body) {
        $mail = new PHPMailer(true);
    }
}
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'minhazmehadi51@gmail.com';
    $mail->Password   = 'nqkqokyheudlmihu';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($mail->Username, 'minhaj');
    $mail->addAddress($sender_email, $sender_name);
    $mail->isHTML(true);
    $mail->Subject = 'Welcome to our Community';
    $mail->Body    =  "Hi $sender_name,
    <br>
    Thank you so much for your support and trust. Its been a pleasure working with you. Looking forward to our continued collaboration!
    <br>
    Best Regurds,
    <br>
    'mofizza'";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>




































