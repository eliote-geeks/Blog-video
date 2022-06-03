<?php
//including required phpmailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

//Define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//create instance of phpmailer
$mail = new PHPMailer();
//set mail to use
$mail->isSMTP();
//define smtp host
$mail->Host = "smtp.gmail.com";
//enable  smtp Authentication
$mail->SMTPAuth = "true";
//set encryption (ssl/tls)
$mail->SMTPSecure = "tls";
//set port to connect smtp
$mail->Port = "587";
//set gmail username
$mail->Username = "dancomedy2@gmail.com";
//set gmail password
$mail->Password = "bertoua123";
//set email subject
$mail->Subject = "Clinic La Bridge (CLB)";
//set sender email
$mail->setFrom("dancomedy2@gmail.com");
//Enable html
$mail->isHTML("true");


?>