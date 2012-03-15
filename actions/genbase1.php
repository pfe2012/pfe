<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Generation de base 1</title>
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
</head>

<body>

	<div id="leftcolumn">
		<?php 
		include("..\menu.php"); 
		include("../functions/genBaseFunctions.php");
		?>    
	</div>
	
	<div id="contentcolumn">
	    <p>
	        <br />
				Normalisation et Creation des listes ...
	        <br />
	    </p>  

		<form action="apprentissage.php" method="post" name="myform">
			<?php
				$resultpath="c:/Vhosts/pfe/result/";
				$directorypath=correctpath($_POST['dPath']);
		
				$nbcouleur=5; // je ne sais pas trop pourquoi cela a �t� fix� � 5... � voir
				loopdirectorylist($directorypath,0);
				loopdescripteurglobaleNew($directorypath,$nbcouleur,0);
				
				$lClass = createlist($directorypath);
				$dest = normalizeNew($resultpath."Descripteur_".(directoryname($directorypath)).".txt");
				echo "<input type =\"hidden\" name=\"dPath\" value=\"$directorypath\"/>";
		
			?>
			<input type="submit" name="submit" value="Continuer" />
		</form>
	</div>
	
</body>
</html>