<?php

require 'PHPMailer2/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSendmail();
$mail->setFrom = $_POST['Emailaddr'];
$mail->FromName = $_POST['Fullname'];
$mail->addAddress('richard.thomas@itamus.com', 'itamus.com');
$mail->Subject = $_POST['subject'];
$mail->Body = $_POST['mesg'];

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';

?>