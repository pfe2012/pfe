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
	<link rel="stylesheet" href="/css/menu.css">
	<link rel="stylesheet" href="/css/global.css">
</head>
 
<body>

		<div id = "wrapper">
			<?php 
			 require_once "login/header.php"; 
			 //content
			 include "login/login.php";
			 // more content
			 require_once "login/footer.php";
			?>
		</div>
</body>
</html>