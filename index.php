<?php 
/*~ index.php

/**
 * Login / Mot de passe
 * 
 * @last modified Nhan 12-03-2012
 */
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Accueil</title>
</head>
 
<body>
		HelloWorld !!!
		
		<?php 
		 
		 require_once "login/header.php"; 
		 //content
		 include "login/login.php";
		 // more content
		 require_once "login/footer.php";
		 
		?>
</body>
</html>