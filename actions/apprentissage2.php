<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>apprentissage 2</title>
	<link rel="stylesheet" type="text/css" href="/css/menu.css">
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
	    <p>
	        <br />
			Introduction de l'apprentissage go here.
	        <br />
	    </p>  
		<?php
			if($_POST["directoryPath"]!=null){
				$nbcouleur=6;
				$directorypath=correctpath($_POST["directoryPath"]);
				$name=directoryname($directorypath);
				loopdirectorylist($directorypath,0);
				$lClass = createlist($directorypath);
				set_time_limit(0);
				loopdescripteurglobale($directorypath,$nbcouleur,0,false,false,false);
				$param = inputParams($directorypath);
				$dest = normalize($directorypath."Descripteur_".(directoryname($directorypath)).".txt");
				$resultpath = $directorypath;
				$resultname = "Descripteurstranspose_".$name.".txt";
				$newparam = $directorypath."UserParams_".$name."txt";
				apprentissage($dest,$lClass,$param,$resultpath,$resultname,$newparam);
	
			}elseif($_POST["descripteurName"]!=null){
				$dest=correctpath($_POST["descripteurLoc"]).($_POST["descripteurName"]);
				$lClass=correctpath($_POST["listclasseLoc"]).($_POST["listclasseName"]);
				$param=correctpath($_POST["userparamLoc"]).($_POST["userparamName"]);
				$resultpath=correctpath($_POST["resultLoc"]);
				$resultname=($_POST["resultName"]);			
				$newparam=$_POST["newparamName"];
				apprentissage($dest,$lClass,$param,$resultpath,$resultname,$newparam);
			}
		?>
	</div>
	
</body>
</html>