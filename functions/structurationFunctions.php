<?php
		include("apprentissageFunctions.php");

/**************************************************************************************************************
	Run the indexation.exe 
	params:	$dest 		chemin vers le fichier de descripteur, faut le chemin complet avec nom du fichier.txt
			$lCalss		liste globale avec les fichiers txt des classes. ces fichers contiennent les 
					noms des images du sous	repertoire(classe).
			$param		chemin vers les parametres, chemin complet avec nom du fichier.txt
			$paramId	chemin vers les params utiliser pour l'indexation, chemin complet avec le nom
					du fichier.txt
			$resultpath	le chemin vers le resultat
			$newparam	chemin complet vers le fichier qui contient les parametres que l'utilisateurs a
					saisit a travers l'interface reserve dans le cas on veut enregistrer les 
					modifications des params saisits par l'utilisateur a part
						
	return:	?
/***************************************************************************************************************/
function indexation($dest,$lClass,$param,$paramId,$resultpath,$newparam){
	 set_time_limit(0);
	$command = "start /min C:/vhosts/pfe/test/Indexation2(exe)/Indexation = ";
	$command.=$dest." ";
	$command.=$lClass." ";
	$command.=$param." ";
	$command.=$paramId." ";
	$command.=$resultpath." ";
	if ($newparam!="") $command.=$newparam;
	echo "test : ".$command."<br />";// imane :rajouter un commentaire � cette commande
	exec($command, $output, $return);
}

/*********************************************************************************************************/

/*
	Calcul the max of an matrix given in the parameter
	params: $fileLoc: location of the file contain the matrix
	return: 98% of the value maxi found in the matrix.	
/***************************************************************************************************************/
function maxMatrix($fileLoc){
	$fileHandler=fopen($fileLoc,"r") or exit("Cant open the file !!!");
	$max=-1000;
	while(!feof($fileHandler)){
	  $theData=trim(fgets($fileHandler));
	  $elements = explode(" ",$theData);
	  for($i=0;$i<sizeof($elements);$i++){
		  if ($elements[$i]>$max) {
			  $max=$elements[$i];
		  }
	  }
	}
	$max=0.98*$max;
	fclose($fileHandler);
	return $max;
}

/*********************************************************************************************************/

/*
	Calcul the value of d and sigma from the 2 matrix var and pi
	params: $varLoc: 	location of the varMatrix
			$piLoc: 	location of the piMatrix
			$paramLoc	location of the file contains values of dMax,sigmaMin,sigmaMax.
	return: $result: array of the d and sigma.	
/***************************************************************************************************************/
function dsigmaNew($varLoc,$piLoc){
	$resPath=fopen("C:/vhosts/pfe/result/dsigma.txt","w");
	$varMax=maxMatrix($varLoc);
	$piMax=maxMatrix($piLoc);
	$dif=1000;
	$result = array(-1,-1);
	$maxLine=nbLine($varLoc);	
	$maxCol=nbCharacter($varLoc);	
	$openVar=fopen($varLoc,"r") or exit ("Cant access to varMatrix");
	$openPi=fopen($piLoc,"r") or exit ("Cant access to piMatrix");
	
	for ($i=0;$i<$maxLine;$i++){
		$dataVar=trim(fgets($openVar,5000));
		$dataPi=trim(fgets($openPi,5000));
		$elementsPi=explode(" ",$dataPi);
		$elementsVar=explode(" ",$dataVar);
		for ($j=0;$j<$maxCol;$j++){			
			if (($elementsPi[$j] >= $piMax)&&($elementsVar[$j] >= $varMax)){
				fwrite($resPath,$i." ".($j+2)."\n");
				if (($elementsVar[$j]-$varMax)<$dif){
					$result = array ($i,$j+2);
					$dif=$elementsVar[$j]-$varMax;
				}
			}
		}
	}
//	echo "final: $result[0], $result[1] <br />";
	return $result;
}

/*********************************************************************************************************/

/*
	Create the param file for the function indexation
	params: $varLoc: location of the varMatrix
			$piLoc: location of the piMatrix
	return: $result: array of the d and sigma.	
/***************************************************************************************************************/
function inputParamIndex($directoryPath){
	$name=directoryname($directoryPath);
	$resultpath="c:/Vhosts/pfe/result/";
	$fileopen=fopen($resultpath."Params_Index_".$name.".txt","w")or exit ("Unable to create/access to file");
	fwrite($fileopen,$name."\n");
	$desLoc=$resultpath."Descripteur_".(directoryname($directoryPath))."norm.txt";//descripteur normalise
	fwrite($fileopen,nbCharacter($desLoc)."\n");
	fwrite($fileopen,nbImage($directoryPath)."\n");
	fwrite($fileopen,nbClasse($directoryPath)."\n");
	$varLoc=$resultpath."VAR_MATRIX.txt";
	$piLoc=$resultpath."PI_MATRIX.txt";
	$result = dsigmaNew($varLoc,$piLoc);
	fwrite($fileopen,$result[0]."\n");
	fwrite($fileopen,$result[1]."\n");
	$fclose($fileopen);
	$fileopen=fopen($resultpath."ParamsIndexing_".$name.".txt","w")or exit ("Unable to create/access to file");
	fwrite($fileopen,"8"."\n");
	fwrite($fileopen,"600"."\n");
	fwrite($fileopen,"40"."\n");
	$fclose($fileopen);	
}
?>