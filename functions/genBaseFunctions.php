<?php
	 	include("commonFunctions.php");
		include("descriptionFunctions.php");

/*
	Count the number of line with information in a given file
	param:	$fileLocation
	return:	$count: number of line not vide in the given file
*/
function countElement($fileLocation){
	$fileopen=fopen($fileLocation,"r")or exit ("Unable to create/access to file");	
	$count=0;
	while (!feof($fileopen)){ 
		$tempsinfo=trim(fgets($fileopen,5000));
		//echo $tempsinfo."<br/>";
		if ($tempsinfo!=""){
			$count++;
		}
	}return ($count);
}

/*********************************************************************************************************/

/*
	Create a list of images of a given directory
	param:	$directoryPath
	return:	$count: number of line not vide in the given file
*/
/*********************************************************************************************************/
function imageList($directoryPath,$level){
	$handler = opendir($directoryPath) or die ("Cant open directory; directorypath: ".$directoryPath);
	if ($level==0){
		//create a new clean list of images
		$listFile=fopen($directoryPath."liste_".(directoryname($directoryPath)).".txt","w") or exit ("Unable to create file");
		fclose($listFile);
		while (false !== ($file = readdir($handler))) { 		
			if ($file != '.' && $file != '..'){
				if ( !is_dir("$directoryPath/$file")){
					//do nothing
				}else{
					$subdirectoryPath="$directoryPath$file/";
					imageList($subdirectoryPath,1);			
				}
			}
		}
	}
	elseif ($level==1){
		$parentpath=parentDirectory($directoryPath);			
		$listFile=fopen($parentpath."liste_".(directoryname($parentpath)).".txt","a") or exit ("Unable to access file");
		while (false !== ($file = readdir($handler))) { 
			if ($file != '.' && $file != '..'){ 
				if ( !is_dir("$directorypath/$file")){
					//verify if the file is an image jpg
					if (strpos($file,".jpg")!=null){
						//write the file name (without the path) to the list file
						$name=nameWithoutExtension($file);
						fwrite($listFile,$name."\n");
					}
				}
			}
		}							
		fclose($listFile);
	}
}


/*********************************************************************************************************/

/*
	Create the global descripteur for a given direcotry
	param:	$directorypath
			$nbcouleur: used by various little programmes 
			$level: 0: root folder or 1:subfolder
			$color, $histo,$art: state of corresponding descripter. false=not chosen, true= chosen.
	return:	a Descripteur_"directory name".txt and a Descripteur_"directory name"_norm.txt file
*/
/*********************************************************************************************************/
function loopdescripteurglobaleNew($directorypath,$nbcouleur,$level){
	set_time_limit(0);
	$resultpath="c:/Vhosts/pfe/result/";
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	if ($level==0){
		//create a new clean global descripteur and a new clean list of images
		$globTempDesc=fopen($resultpath."Descripteur_".(directoryname($directorypath)).".txt","w") or exit ("Unable to create file");			
		$listFile=fopen($resultpath."liste_".(directoryname($directorypath)).".txt","w") or exit ("Unable to create file");
		fclose($globTempDesc);
		fclose($listFile);
		while (false !== ($file = readdir($handler))) { 		
			if ($file != '.' && $file != '..'){
				if ( !is_dir("$directorypath/$file")){
					//do nothing
				}else{
					if ($file!='descripteur'){
						$subdirectorypath="$directorypath$file/";
						loopdescripteurglobaleNew($subdirectorypath,$nbcouleur,1);			
					}
				}
			}
		}
	}
	elseif ($level==1){
		$parentpath=parentDirectory($directorypath);			
		$globTempDesc=fopen($resultpath."Descripteur_".(directoryname($parentpath)).".txt","a") or exit ("Unable to access file");
		$listFile=fopen($resultpath."liste_".(directoryname($parentpath)).".txt","a") or exit ("Unable to access file");
		$desPath=$parentpath."descripteur/".basename($directorypath)."/";
		while (false !== ($file = readdir($handler))) { 
		  if ($file != '.' && $file != '..'){ 
			if ( !is_dir("$directorypath/$file")){
			//verify if the file is an image jpg
			 if (strpos($file,".jpg")!=null){
			 $namefile=nameWithoutExtension($file);
			 //write the file name (without the path) to the list file
			 fwrite($listFile,$file."\n");
			 //Start to read from the result of colordominante
			 //open, read the first line and ignore it
			 //Start to read from the result of hist
			 $fileopen=fopen($desPath.$namefile."_hist.txt","r")or exit ("Unable to access to file hist: ".$namefile."_hist.txt");
			 $theData=fread($fileopen, filesize($desPath.$namefile."_hist.txt"));
			 fwrite($globTempDesc,(trim($theData))." ");
			 fclose($fileopen);
			 //Start to read from the result of art
			 $fileopen=fopen($desPath.$namefile."__shape.dsc","r")or exit ("Unable to access to file shpae: ".$namefile."__shape.dsc");
			 $theData=fread($fileopen, filesize($desPath.$namefile."__shape.dsc"));
			 fclose($fileopen);
			 $theData=strstr($theData," ");
			 fwrite($globTempDesc,(trim($theData)));
			 fwrite($globTempDesc,"\n");
			 }
			}
		   }
		}							
			fclose($globTempDesc);	 
			fclose($listFile);
	}
}



/*********************************************************************************************************/

/*
	Normalize the global descripteur got in the loopdescripteurglobale function
	param:	$fileLocation: location of the global descripteur
	return:	the normalized type of the global descripteur.
*/
/*********************************************************************************************************/
function normalizeNew($fileLocation){
	$numFile=countElement($fileLocation);
	//echo "numfile: ".$numFile."<br />";
	$fileTempAvg=fopen(nameWithoutExtension($fileLocation)."TempAvg.txt","w") or exit ("Unable to access to file TempAvg");
	$fileNorm=fopen(nameWithoutExtension($fileLocation)."norm.txt","w") or exit ("Unable to access to file norm");
	//calcule nombre de charactéristique
	$file1=fopen($fileLocation,"r") or exit ("Unable to access to file ff");
	$theData="";
	while($theData==""){
		$theData=trim(fgets($file1,5000));
	}
	$elements=explode(" ",$theData);
	$colTotal=sizeof($elements);
	fclose($file1);
	//initialize les avg et les variances et ecartypes
	for ($col=0;$col<$colTotal;$col++){
		$moyen[$col]=0;
		$var[$col]=0;
		$ecar[$col]=0;
	}
	//calcul the average
	$file1=fopen($fileLocation,"r") or exit ("Unable to access to file ll");
	for ($row=0;$row<$numFile;$row++){
		$theData="";
		while($theData=="") {
			$theData=trim(fgets($file1,5000));
			if ($theData!=""){
				$elements = explode(" ",$theData);
			}
		}
		for ($col=0;$col<$colTotal;$col++){
			$moyen[$col]+=$elements[$col];   // enlevé d'ici car visiblement mal placé /$numFile;
		}	
	}
	// modification le 20 Avril.
	for ($col=0;$col<$colTotal;$col++){
			$moyen[$col]=$moyen[$col]/$numFile;
			}
	//save the average value in a file for later use
	$path=parentDirectory($fileLocation);
	$path=$path."normVar.txt";
	$filehandler=fopen($path,"w");
	for ($col=0;$col<$colTotal;$col++){
		fwrite($filehandler,$moyen[$col]." ");
	}fwrite($filehandler,"\n");
	//center the descripter with the average and save all in a temp file
	$file1=fopen($fileLocation,"r") or exit ("Unable to access to file dd");
	for ($row=0;$row<$numFile;$row++){
		$theData="";
		while($theData=="") {
			$theData=trim(fgets($file1,5000));
			if ($theData!=""){
				$elements = explode(" ",$theData);
			}
		}
		for ($col=0;$col<$colTotal;$col++){
			$elements[$col]=$elements[$col]-$moyen[$col];
			fwrite($fileTempAvg,$elements[$col]." ");
		}fwrite($fileTempAvg,"\n");		
	}
	fclose($file1);
	fclose($fileTempAvg);
	//calcul the variance and ecarttype
	$fileTempAvg=fopen(nameWithoutExtension($fileLocation)."TempAvg.txt","r") or exit ("Unable to access to file bb");
	for ($row=0;$row<$numFile;$row++){
		$theData=trim(fgets($fileTempAvg));
		$elements = explode(" ",$theData);
		
		//modif 20 Avril 2010
		for ($col=0;$col<$colTotal;$col++){
			$var[$col]+=$elements[$col]*$elements[$col];
		}
	}
	   
	   //modif 20 avril 2010
	for ($col=0;$col<$colTotal;$col++){
			$var[$col]=$var[$col]/$numFile;
			}
	
	
	for ($col=0;$col<$colTotal;$col++) $ecar[$col]=sqrt($var[$col]); 
	
	//save the ecarttype for latter use in recherche phase				
	for ($col=0;$col<$colTotal;$col++){
		fwrite($filehandler,$ecar[$col]." ");
	}fclose($filehandler);	
	//calcul the final value and save it in the appropriate file
	fclose($fileTempAvg);
	$fileTempAvg=fopen(nameWithoutExtension($fileLocation)."TempAvg.txt","r") or exit ("Unable to access to file mm");
	for ($row=0;$row<$numFile;$row++){
		$theData=trim(fgets($fileTempAvg));
		$elements = explode(" ",$theData);
		for ($col=0;$col<$colTotal;$col++){
			if ($ecar[$col]!=0) {
				$elements[$col]=$elements[$col]/$ecar[$col];
			}
			fwrite($fileNorm,$elements[$col]." ");
		}fwrite($fileNorm,"\n");
	}
	fclose($fileTempAvg);
	fclose($fileNorm);
	return (nameWithoutExtension($fileLocation)."norm.txt");

}

/*********************************************************************************************************/

?>