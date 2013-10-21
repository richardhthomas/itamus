<?php

require 'PHPMailer2/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->isSendmail();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587;
$mail->Host = 'smtp.sendgrid.net';
$mail->Username = $_ENV["SENDGRID_USERNAME"];
$mail->Password = $_ENV["SENDGRID_PASSWORD"];
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