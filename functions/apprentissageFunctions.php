<?php
	 	include("genBaseFunctions.php");

/***************************************************************************************************************************
	Run the apprentissage.exe 
	params:	$dest: 		chemin vers le fichier de descripteur, faut le chemin complet avec nom du fichier.txt
			$lCalss:	liste globale avec les fichiers txt des classes. ces fichers contiennent 
					les noms des images du sous
						repertoire(classe).
			$param:		chemin vers les parametres, chemin complet avec nom du fichier.txt
			$resultpath	le chemin vers le resultat
			$resultname	nom du resultat
			$newparam	chemin complet vers le fichier qui contient les parametres que l'utilisateurs 
					a saisit a travers l'interface reserve dans le cas on veut enregistrer 
					les modifications des params saisits par l'utilisateur a part
						
	return:	?
*************************************************************************************************************************/
function apprentissage($dest,$lClass,$param,$resultpath,$resultname,$newparam){
	
	set_time_limit(0);
	$command = "start C:/vhosts/pfe/test/Apprentissage(exe)/Apprentissage.exe = ";
	$command.=$dest." ";
	$command.=$lClass." ";
	$command.=$param." ";
	$command.=$resultpath." ";
	$command.=$resultname." ";
	if ($newparam!="") $command.=$newparam;
	echo "test ".$command."<br />";
	exec($command, $output, $return);
}

/*********************************************************************************************************/

/*
	Create the param file to be used by apprentissage for a given directory
	param:	$directorypath
			$name: name of the directory
	return: Params_$name.txt with the parameters calculated from the base and those from user via interface 
*/
/*********************************************************************************************************/
function inputParams($directorypath){
	$resultpath="c:/Vhosts/pfe/result/";
	$name=directoryname($directorypath);
	$fileopen=fopen($resultpath."Params_".$name.".txt","w")or exit ("Unable to create/access to file");
	fwrite($fileopen,nbImage($directorypath)."\n");
	$desLoc=$resultpath."Descripteur_".$name.".txt";
	fwrite($fileopen,nbCharacter($desLoc)."\n");
	fwrite($fileopen,nbClasse($directorypath)."\n");
	fwrite($fileopen,"160\n");//dmax
	fwrite($fileopen,"1\n");//radius(sigma) min
	fwrite($fileopen,"80\n");//radius(sigma) max
	fwrite($fileopen,"1\n");//radius quant	
	fclose($fileopen);
	if (($_POST["Dmax"]!="")||($_POST["RadiusMin"]!="")||($_POST["RadiusMax"]!="")||($_POST["RadiusQuant"]!="")){
		$fileopen=fopen($directorypath."UserParams_".$name.".txt","w")or exit ("Unable to create/access to file");		
		if ($_POST["Dmax"]!=""){
			fwrite($fileopen,$_POST["Dmax"]."\n");
		}else {
			fwrite($fileopen,"10\n");
		}
		if ($_POST["RadiusMin"]!=""){
			fwrite($fileopen,$_POST["RadiusMin"]."\n");
		}else {
			fwrite($fileopen,"1\n");
		}
		if ($_POST["RadiusMax"]!=""){
			fwrite($fileopen,$_POST["RadiusMax"]."\n");
		}else {
			fwrite($fileopen,"20\n");
		}
		if ($_POST["RadiusQuant"]!=""){
			fwrite($fileopen,$_POST["RadiusQuant"]);
		}else {
			fwrite($fileopen,"1");
		}
		fclose($fileopen);	
	}
	return ($resultpath."Params_".$name.".txt");
}

/*********************************************************************************************************/

?>
