<?php

// example on using PHPMailer with GMAIL

include("phpmailer/class.phpmailer.php");
include("phpmailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

$mail             = new PHPMailer();

//$body             = $mail->getFile('contents.html');
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = "pfe.imanbum@gmail.com";  // GMAIL username
$mail->Password   = "insalyon";            // GMAIL password

$webmaster_email = "pfe.imanbum@gmail.com"; //Reply to this email ID
$email = "tuongnhan257@gmail.com"; // Recipients email ID

$mail->From       = $webmaster_email;
$mail->FromName   = "Webmaster:PFE IMANBUM";
$mail->Subject    = "This is the subject";
$mail->Body = "Hi, This is the HTML BODY "; //HTML Body
$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
$mail->WordWrap   = 50; // set word wrap

//$mail->MsgHTML($body);

$mail->AddReplyTo($webmaster_email,"Webmaster");
$mail->AddAddress($email,"Nhan Nguyen"); // CC

//$mail->AddAttachment("/path/to/file.zip");             // attachment
//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment


$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message has been sent";
}

?>