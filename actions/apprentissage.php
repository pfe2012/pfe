<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>apprentissage</title>
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
</head>

<body>
	<div id="leftcolumn">
		<?php 
			include("../menu.php"); 
			include("../functions/apprentissageFunctions.php");
		?>    
	</div>
	
	<div id="contentcolumn">
	    <br />
		Dans cette partie, on va calculer les valeurs de D et sigma pour la structuration
	    <br />
		<form action="apprentissage1.php" method="post" name="myform">
			<?php
			if (isset($_POST['dPath'])){
				$dPath=correctpath($_POST['dPath']);
				echo "<input type =\"hidden\" name=\"dPath\" value=\"$dPath\"/>";
				echo "Vous avez chosit de travailler avec la base ".basename($_POST['dPath'])." à l'adress: ".$_POST['dPath'];
				echo "<br /> Cliquez sur Continuer pour lancer le procédure.";			
			}
			else{
				echo "Vous voulez travailler avec une base munie déja des descripteur ? <br/>";
				echo "Veuillez choisir une base d'images pour commencer <br />";
				echo("Chemin vers la base <input type=\"label\" name=\"dPath\" id=\"directorypath\"");			
			}
			?>
			
			<input type="submit" name="submit" value="Continuer" />     
		</form>
	</div>

</body>
</html>