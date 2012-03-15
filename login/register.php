<?php
 
require_once "header.php"; 
 
if (isset($_POST['register'])){
 
	if (registerNewUser($_POST['username'], $_POST['password'], $_POST['password2'], $_POST['email'])){
 
		echo "Thank you for registering, an email has been sent to your inbox, Please activate your account.
		<a href='../index.php'>Click here to login.</a>
		";
 
	}else {
 
		echo "Registration failed! Please try again.";
		show_registration_form();
 
	}
 
} else {
// has not pressed the register button
	show_registration_form();	
}
 
 require_once "footer.php";
?>