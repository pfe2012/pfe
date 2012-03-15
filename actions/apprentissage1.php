<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>apprentissage 1</title>
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
			Nous allons calculer les valeurs de D et sigma dans cette étape.
	        <br />
		</p>  
		
		<form action="structuration.php" method="post" name="myform">
		<?php
			$resultpath="c:/Vhosts/pfe/result/";
			$directorypath=correctpath($_POST['dPath']);
			$lClass = $resultpath."listeClasses_".directoryname($directorypath).".txt";
			$dest = $resultpath."Descripteur_".directoryname($directorypath)."norm.txt";
			$resultname = "Descripteurstranspose_".directoryname($directorypath).".txt";
			$param = inputParams($directorypath);
			$newparam = "";
			// On va lancer executable de l'apprentissage pour calculer les deux matrix PI et VAR
			apprentissage($dest,$lClass,$param,$resultpath,$resultname,$newparam);
			//On va calculer les valeurs de d et sigma a partir des matrix PI et VAR
			inputParamIndex($directoryPath);
			echo "vous avez fini l'apprentissage <br />";
			echo "<input type =\"hidden\" name=\"dPath\" value=\"$directorypath\"/>";
			echo ("<input type=\"submit\" name=\"submit\" value=\"Continuer\" />");
		?>
		</form>
	</div>

</body>
</html>