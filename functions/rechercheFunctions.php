<?php
	include("../functions/descriptionFunctions.php");
	include("../functions/commonFunctions.php");
/***********************************************************************************************
	Return the last folder's name for a given path
	Params: $directoryPath (string)
	Return: $name (string): last folder's name
/************************************************************************************************/
function inputFileName1($fileLocation){
//echo $fileLocation;
	$fileopen=fopen($fileLocation,"r")or exit ("Unable to create/access to file");
	$index=0;
	while (!feof($fileopen) ) {

		$line_of_text = trim(fgets($fileopen));
		if ($line_of_text!=""){
			$result[$index]=$line_of_text;
			$index++;
		}
	}
	fclose($fileopen);
	return $result;		
		
}

/***********************************************************************************************/

//fonction de lecture du fichier resultat


/***********************************************************************************************/
function inputFileName($fileLocation){
    //echo $fileLocation;
	$fileopen=fopen($fileLocation,"r")or exit ("Unable to create1/access to file");

	$index=0;
	while (!feof($fileopen) ) {

		$line_of_text = trim(fgets($fileopen));
		if ($line_of_text!=""){
			$data=explode('_',$line_of_text);
			 $folder="../images/Coil100Databases/".$data[0]."/";
			$name=trim(nameWithoutExtension($line_of_text));
			$result[$index]=$folder.$name.".jpg";
			
			$index++;
		}
	}
	fclose($fileopen);
	return $result;		
		
}

/***********************************************************************************************/

/***********************************************************************************************/
function feedback($path,$nbImage){
	$feedbackRev=fopen($path."RelevanceFeedback.txt","w");
	for ($i=0;$i<$nbImage;$i++) $res[$i]=0;
	if (isset($_POST["imagechecked"])){
		foreach ($_POST["imagechecked"] as $tmp){
			$res[$tmp]=1;
			//echo "good <br />";
		}
	}
	for ($i=0;$i<$nbImage;$i++){
		fwrite($feedbackRev,$res[$i]."\n");
	}
	fclose ($feedbackRev);	
}



/***********************************************************************************************/

/***********************************************************************************************/

function traitementImage($imagepath,$paramNormPath,$baseName){

	$resultpath="c:/vhosts/pfe/result/";
	
	$command = "start /min C:/vhosts/pfe/test/histogramcouleur(exe)/Hist_Norm.exe = ";
	$command.= "C:/vhosts/pfe/test/couleursdominanteS/quantif_couleur_seul_sans_fond_noir.exe ";//chemin vers couleurdominantes
	$command.= " image=requete";//nom de l'image
	$command.= " pathin=".$imagepath;//chemin vers l'image
	$command.= " pathout=".$imagepath;//chemin vers le resultat de couleurdominantes
	$command.= " Nb_coul=7";//nb de couleur dominantes
	$command.= " "."requete_color";//nom du ficher de resultat de couleurdominantes
	$command.= " ".$imagepath."requete"."_hist.txt";//chemin complet vers le resultat de hist
	
	exec($command, $output, $return);

	$command = "start /min c:/vhosts/pfe/test/ART(exe)/calcul_ART_coil.exe = ";// a remettre si je veux tester avec l'ancienne version sur la base base
	$command.= " image=requete";//nom de l'image
	$command.= " pathin=".$imagepath;//chemin vers l'image
	$command.= " pathfb=".$imagepath."fctdebase.txt";//chemin vers le resultat de la fct de base
	$command.= " pathout=".$imagepath;//chemin vers le resultat de l'art
	$command.= " CFB=0"; // 0 pour ne pas recalculer les fonctions de base
	
	exec($command, $output, $return);
	
	$namefile="requete";
	//create descripter global
	$globTempDesc=fopen($imagepath."requestdeb.txt","w"); //Remplac� par la ligne suivante pour sauter la normalisation	
	//$globTempDesc=fopen($imagepath."request.txt","w");	
	$fileopen=fopen($imagepath.$namefile."_hist.txt","r")or exit ("Unable to access to fileg: ".$namefile."_hist.txt");
	$theData=fread($fileopen, filesize($imagepath.$namefile."_hist.txt"));
	fwrite($globTempDesc,(trim($theData))." ");
	fclose($fileopen);
	$fileopen=fopen($imagepath.$namefile."__shape.dsc","r")or exit ("Unable to access to filej: ".$namefile."__shape.dsc");
	$theData=fread($fileopen, filesize($imagepath.$namefile."__shape.dsc"));
	fclose($fileopen);
	$theData=strstr($theData," ");
	fwrite($globTempDesc,(trim($theData)));
	fclose($globTempDesc);
	
	
	
	//normalize pour avoir des donn�es centr�es et moyenn�es
	$file1=fopen($imagepath."requestdeb.txt","r") or exit ("Unable to access to file1");
	$theData="";
	while($theData=="") {
		$theData=trim(fgets($file1,5000));
	}	$elements1 = explode(" ",$theData);
	fclose($file1);
	$colTotal=sizeof($elements1);
	//echo $paramNormPath;
	$file1=fopen($paramNormPath,"r") or exit ("Unable to acces to file2");
	$theData="";
	while($theData=="") {
		$theData=trim(fgets($file1,5000));
	}	$avg = explode(" ",$theData);
	$theData="";
	while($theData=="") {
		$theData=trim(fgets($file1,5000));
	}	$ecart = explode(" ",$theData);
	for ($col=0;$col<$colTotal;$col++){
		$elements1[$col]=$elements1[$col]-$avg[$col];
	}
	for ($col=0;$col<$colTotal;$col++){
		if ($ecart[$col]!=0){
			$elements1[$col]=$elements1[$col]/$ecart[$col];
		}
	}
	//copy($imagepath."request.txt",$imagepath."requestdeb.txt");
	$file1=fopen($imagepath."request.txt","w") or exit ("Unable to access to file b");
	for($col=0;$col<$colTotal;$col++){
		fwrite($file1,$elements1[$col]." ");
	}
	fclose($file1);
	//transpose
	
	$command = "start /min C:/vhosts/pfe/test/reqindex/IndexationReq.exe = ";
	$command.= $resultpath."Params_Index_".$baseName.".txt ";//chemin vers les param�tres de l'indexation
	copy($resultpath."matriceDePassage.txt",$imagepath."matriceDePassage.txt");
	$command.= $imagepath;//r�pertoire r�sultat
	$command.= " ".$resultpath.$baseName."_Descripteurs_Transposee.txt";
	
	//echo "test ".$command."<br />";
	 exec($command, $output, $return);
	copy($imagepath."requestTranspose.txt", $resultpath."request.txt");

}


/***********************************************************************************************/

/***********************************************************************************************/

function clearAll($directoryPath){
	$handler = opendir($directoryPath) or die ("Cant open directory; directorypath: ".$directoryPath);
	while (false !== ($file = readdir($handler))) { 

        // if $file isn't this directory or its parent, 
        // add it to the results array
		if ($file != '.' && $file != '..'){
			if ( !is_dir("$directorypath/$file")){
				unlink($directoryPath.$file);
			}
		}
	}
}
	
/*********************************************************************************************************/
?>