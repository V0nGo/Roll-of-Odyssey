<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendMail($email, $subject, $message)
{

    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/SMTP.php';

    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/config.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();

    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    $mail->Host = 'smtp.gmail.com';

    $mail->Port = 465;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->SMTPAuth = true;

    $mail->Username = USERNAME;

    $mail->Password = PASSWORD;

    $mail->setFrom('roll.of.odyssey@gmail.com');
    $mail->addReplyTo($email);
    $mail->addAddress($email);

    $mail->Subject = $subject;
    $mail->Body = $message;
    







    if (!$mail->send()) {
        return "Email non envoyé." . $mail->ErrorInfo;
    } else {
        return "Email envoyé.";
    }
}
