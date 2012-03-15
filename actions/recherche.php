<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/css/recherche.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>

<body>
<div id="leftcolumn">
	<?php 
		include("../menu.php"); 
		include("../functions/rechercheFunctions.php");
		# Constants
		define('MAX_WIDTH', 75);
		define('MAX_HEIGHT', 75);
	?>    
</div>

<div id="contentcolumn">
	
    <form enctype="multipart/form-data" action="recherche2.php" method="post">
	    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	    	<br />
			Le nom de la base d'image <input type="text" name="baseName" id="baseName" /> 
			<br />
	        Choisir l'image pour la recherche: <input type="file" name="uploadedfile" /><br />
	        Nombre d'image a afficher <input type="text" name="nbImage" value="20" id="nbImage" /> <br />
	    <input type="submit" value="Continuer" />
	
    </form>
</div>
</body>
</html>