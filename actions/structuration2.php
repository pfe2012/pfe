<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>structuration 2</title>
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
	<link rel="stylesheet" type="text/css" href="/css/menu.css">
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
			Introductions de l'indexation go here.
	        <br />
	    </p>  
		<?php
			if($_POST["directoryPath"]!=null){
				//createlist(correctpath($_POST["directoryPath"]));
				$directorypath=correctpath($_POST["directoryPath"]);
				echo ("PI: ".maxMatrix($directorypath."PI_MATRIX.txt")."<br />");
				echo ("var: ".maxMatrix($directorypath."VAR_MATRIX.txt")."<br />");
				
			}elseif($_POST["descripteurName"]!=null){
				$dest=correctpath($_POST["descripteurLoc"]).($_POST["descripteurName"]);
				$lClass=correctpath($_POST["listclasseLoc"]).($_POST["listclasseName"]);
				$param=correctpath($_POST["userparamLoc"]).($_POST["userparamName"]);
				$paramId=correctpath($_POST["paramsIdLoc"]).($_POST["paramsIdName"]);
				$resultpath=correctpath($_POST["resultLoc"]);
				$newparam=$_POST["newparamName"];
				indexation($dest,$lClass,$param,$paramId,$resultpath,$newparam);
			}
		?>
	</div>

</body>
</html>