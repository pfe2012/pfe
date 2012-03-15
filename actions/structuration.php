<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>structuration</title>
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
</head>

<body>

	<div id="leftcolumn">
		<?php 
			include("../menu.php"); 
			include("../functions/structurationFunctions.php");
		?>    
	</div>
	
	<div id="contentcolumn">
	    <p>
	        <br />
			Nous allons transformer le descipteur globale normalisé et indexer la base dans cette étape.
	        <br />
	    </p>
	    <form action="structuration1.php" method="post" name="myform">
		    <?php
			if (isset($_POST['dPath'])){
				$directorypath=$_POST['dPath'];
				echo "Vous avez chosit de travailler avec la base ".basename($_POST['dPath'])." à l'adress: ".$_POST['dPath'];
				echo "<br /> Cliquez sur Continuer pour lancer le procédure.";
				echo "<input type =\"hidden\" name=\"dPath\" value=\"$directorypath\"/>";	
			}else{
				echo "Veuillez choisir une base d'images pour commencer <br />";
				echo("Chemin vers la base <input type=\"label\" name=\"dPath\" id=\"directorypath\"/>");			
			}			
		     ?>
	   		<input type="submit" name="submit" value="Continuer" />
	    </form>            
	</div>
	
</body>
</html>