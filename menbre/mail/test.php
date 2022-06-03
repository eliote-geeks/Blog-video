<?php
require_once "phpmailer/emailSetup.php";

//Email Body
$mail->Body = "Nice Email This is Daniel Sending this Email to You !!!!!";
//Add Recipient address
$mail->addAddress("ndabosed@gmail.com");
//Finally send email
if ($mail->Send()) {
     echo "<script>alert('Successfully Sent !!!!')</script>";
}
else{
    echo "<script>alert('Wrong Email an error occurred !!!')</script>";
}
$mail->smtpClose();
                
?>