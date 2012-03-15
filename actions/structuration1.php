<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>structuration 1</title>
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
			Indexation en cours ... et fini :D
	        <br />
	    </p>  
		<?php
			$directoryPath=correctpath($_POST['dPath']);
			$name=directoryname($directoryPath);
			$resultpath="c:/Vhosts/pfe/result/";
			$dest=$resultpath."Descripteur_".$name."norm.txt";
			$lClass=$resultpath."listeClasses_".$name.".txt";
			$param=$resultpath."Params_Index_".$name.".txt";
			$paramId=$resultpath."ParamsIndexing_".$name.".txt";
			$newparam="";
			/*echo "chemein complet vers les classes ".$lClass;
			echo "chemein complet vers les parametres ".$param;
			echo "chemein complet vers les parametres dindexation ".$paramId;
			echo "chemein complet vers les resultats ".$resultpath;*/
			set_time_limit(0);
			indexation($dest,$lClass,$param,$paramId,$resultpath,$newparam);
		?>
	</div>

</body>
</html>