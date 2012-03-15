<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>base generation</title>
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
</head>

<body>
	<div id="leftcolumn">
		<?php 
			include("../menu.php"); 
			include("../functions/genBaseFunctions.php");
		?>    
	</div>
	
	<div id="contentcolumn">
	    <p>
	        <br />
			Dans cette étape on va creer le descripteur globale qui contient tous les descripteurs de la base <br  />
	        On calcule également les autres éléments nécessaires pour l'étape apprentissage: liste des classe, liste imgaes ... <br />
	        <br />
	    </p>  
	    
	    <form action="genbase1.php" method="post" name="myform">
		    <?php
			if (isset($_POST['dPath'])){
				$directorypath=$_POST['dPath'];
				echo "Vous avez chosit de travailler avec la base ".basename($_POST['dPath'])." à l'adress: ".$_POST['dPath'];
				echo "<br /> Cliquez sur Continuer pour lancer le procédure.";
				echo "<input type =\"hidden\" name=\"dPath\" value=\"$directorypath\"/>";
					
			}else{
				echo "Vous voulez travailler avec une base munie déja des descripteur ? <br/>";
				echo "Veuillez choisir une base d'images pour commencer <br />";
				echo("Chemin vers la base <input type=\"label\" name=\"dPath\" id=\"directorypath\"/>");			
			}
			?>
	        <input type="submit" name="submit" value="Continuer" />
	    </form>
	</div>
</body>
</html>