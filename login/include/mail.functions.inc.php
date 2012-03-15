<?php
 
##### Mail functions #####

function sendMail($to, $subject, $message, $from)
{
 
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
	$email = $to; // Recipients email ID
	
	$mail->From       = $from;
	$mail->FromName   = "Webmaster : PFE IMANBUM";
	$mail->Subject    = $subject;
	$mail->Body = $message; //HTML Body
	//$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
	$mail->WordWrap   = 50; // set word wrap
	
	//$mail->MsgHTML($body);
	
	$mail->AddReplyTo($from,"Webmaster");	//Reply to this email ID
	$mail->AddAddress($email,"Nom Prénom"); // CC
	
	//$mail->AddAttachment("/path/to/file.zip");             // attachment
	//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
	
	
	$mail->IsHTML(true); // send as HTML
	
	if(!$mail->Send()) {
	  //echo "Mailer Error: " . $mail->ErrorInfo;
	  	return false;
	} else {
	  //echo "Message has been sent";
		return true;
	}
} 

function sendLostPasswordEmail($username, $email, $newpassword)
{
 
    global $domain;
    $message = "Vous avez demande un nouveau mot de pass sur http://www.$domain/, <br />
				<br /> 
				Votre nouveau compte:<br />
				<br /> 
				username:  $username <br /> 				
				password:  $newpassword <br />
				<br /> 
				<br /> 
				Merci <br />
				$domain Administration
				";
 
    if (sendMail($email, "Votre mot de pass a été changé.", $message, "no-reply@$domain")) {
        return true;
    } else {
        return false;
    }
 
 
}
 
 
function sendActivationEmail($username, $password, $uid, $email, $actcode)
{
    global $domain;
    $link = "http://localhost:8080/login/activate.php?uid=$uid&actcode=$actcode";
    $message = "Bonjour, <br />
				Merci de vous enregistrer sur notre site http://imanbum.$domain/,<br />
				<br /> 
				Informations de votre compte:<br />
				<br /> 
				username:  <b> $username </b> <br />
				password:  <b> $password </b> <br />
				<br /> 
				Merci de cliquer sur ce lien pour activé votre compte: .<br />
				<br /> 
				$link <br />
				<br /> 
				Bienvenue <br />
				imanbum.$domain Administration
				";
 
    if (sendMail($email, "Activer votre compte.", $message, "no-reply@$domain")) {
        return true;
    } else {
        return false;
    }
}
 
?>