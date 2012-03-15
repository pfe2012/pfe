<?php

/*************************************************************************************************
	Return the last folder's name for a given path
	Params: $directoryPath (string)
	Return: $name (string): last folder's name
**************************************************************************************************/
function directoryname($directorypath){
	if (substr($directorypath,-1,1)=="/"){		
		$dpnoendslash=substr($directorypath,0,strlen($directorypath)-1);//remove the last slash "/"
	}else $dpnoendslash=substr($directorypath,0);
	$pos=0;
	$name="";
	for($i=1;$i<strlen($dpnoendslash)-1;$i++){
		if (substr($dpnoendslash,-$i,1)=="/"){
			$pos=$i;
			break;
		}
	}
	if ($pos!=0){
		$name=substr($dpnoendslash,-$pos+1);
	}else {
		echo ($dpnoendslash);
		echo ("Error: Cant find directory's name <br />");
		echo ("Directory path: ".$directorypath. "<br />");
	}
	return $name;
}

/*********************************************************************************************************/

/*	Return the path to the parent's directory of the given directory
	Params: $directoryPath (string)
	Return: $parent (string)
**************************************************************************************************/
function parentDirectory($directorypath){
	if (substr($directorypath,-1,1)=="/"){		
		$dpnoendslash=substr($directorypath,0,strlen($directorypath)-1);//remove the last slash "/"
	}else $dpnoendslash=substr($directorypath,0);
	$pos=0;
	$parent="";
	for($i=strlen($dpnoendslash)-1;$i>0;$i--){
		if (substr($dpnoendslash,$i,1)=="/"){
			$pos=$i;
			break;
		}
	}
	if ($pos!=0){
		$parent=substr($dpnoendslash,0,$pos+1);
	}else echo ("Error: Cant find directory's name <br />"); 
	return $parent;
}

/*********************************************************************************************************/

/*
	Replace the "\" in a given path with the "/" and add a "/" at the end of the path
	Param: $oldpath (string)
	Return: $newpath (string): path corrected.
**************************************************************************************************/
function correctpath($oldpath){
	// replace "\" with "/" and add an "/" to the end of the path if it's not already done
	$newpath=str_replace("\\","/",$oldpath);
	if (substr($newpath,-1,1)!="/"){
		$newpath=substr_replace($newpath,"/",strlen($newpath),0);
	}
	return $newpath;
}

/*********************************************************************************************************/

/*
	Remove the extention from a file's name
	Param: $oldname (string)
	Return: $newname (string): name after removed everything after the last "." found in the file's name	"." is also removed, if "." not found return the $oldname
**************************************************************************************************/
function nameWithoutExtension($oldname){
	$pos=0;
	for ($i = strlen($oldname)-1;$i >0;$i--){
		if ($oldname[$i]=="."){
			$pos=$i;
			break;
		}
	} if ($pos!=0){
		$newname=substr($oldname,0,$pos);
		return ($newname);
	}else {
		return $oldname;		
	}
}

/*********************************************************************************************************/

/*
	Return the number of images in a given directory
	param: 	$directorypath
	return: $nbPartie: number of jpg images, can be modified to add more type
**************************************************************************************************/
function nbImage($directorypath){
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	$nbPartie=0;
	while (false !== ($file = readdir($handler))) { 

        // if $file isn't this directory or its parent, 
        // add it to the results array
		if ($file != '.' && $file != '..'){
			if ( !is_dir("$directorypath/$file")){
				//verify if the file is an image jpg
				if (strpos($file,".jpg")!=null){
					$nbPartie++;	
				}
			}else{
				if ($file!="descripteur"){
					$subdirectorypath="$directorypath$file/";
					//echo $subdirectorypath."<br />";
					$nbPartie+=nbImage($subdirectorypath);
				}
			}
		}
	}
    // tidy up: close the handler
    closedir($handler);
	return $nbPartie;

}

/*********************************************************************************************************/

/*
	Return the number of characteristic of the global descripteur
	param: 	$fileLocation: location of the global descripteur
	return:	$count: number of line in the file. 
**************************************************************************************************/
function nbLine($fileLocation){
	$fileopen=fopen($fileLocation,"r")or exit ("Unable to create/access to file");	
	$count=0;
	while(!feof($fileopen)){
		$data=trim(fgets($fileopen));
		if ($data!=null) $count++;
	}fclose($fileopen);
	return ($count);
}

/*********************************************************************************************************/

/*
	Return the number of line of a given file
	param: 	$fileLocation: location of the file
	return:	$count: number of elements sepearted by " " in the first line of the given descripteur. 
**************************************************************************************************/
function nbCharacter($fileLocation){
	$fileopen=fopen($fileLocation,"r")or exit ("Unable to create/access to file");	
	$count=0;
	$tempsinfo=fgets($fileopen,5000);
	$elements = explode(" ",trim($tempsinfo));
	$count=sizeof($elements);
	fclose($fileopen);
	return ($count);
}

/*********************************************************************************************************/
/*
	Return the number of classe of a given image's base.
	param:	$directorypath
	return:	$nbClasse: number of subfolder directly under the given directory.
**************************************************************************************************/
function nbClasse($directorypath){
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	$nbClasse=0;
	while (false !== ($file = readdir($handler))) { 

        // if $file isn't this directory or its parent, 
        // add it to the results array
		if ($file != '.' && $file != '..'){
			if ( !is_dir("$directorypath/$file")){
				//do nothing
			}else{
				if ($file!='descripteur')
				$nbClasse++;
			}
		}
	}
    // tidy up: close the handler
    closedir($handler);
	return $nbClasse;

}

/*********************************************************************************************************/

/*
	Create files listing all the image of a given directory
	param:	$directorypath,$level: level of the subfolder relative to the given directory
	return:	for each subfolder, this will create a file "subfolder name".txt listing all the images the subfolder contains
	remark:	we loop for only level 1 of subfolder here, but it can be modifed to support higher level loop
*************************************************************************************************/
function loopdirectorylist($directorypath,$level){
	$resultpath="C:/vhosts/pfe/result/classes/";
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	if ($level==0){
		while (false !== ($file = readdir($handler))) { 
	
			// if $file isn't this directory or its parent, 
			// add it to the results array
			if ($file != '.' && $file != '..'){
				if ( !is_dir("$directorypath/$file")){
					//do nothing
				}
				else{
					if ($file!='descripteur'){
						$subdirectorypath="$directorypath$file/";
						loopdirectorylist($subdirectorypath,1);			
					}
				}
			}
		}
	}		
	elseif ($level==1){
		$name = directoryname($directorypath);
		$fileopen=fopen($resultpath.$name.".txt","w")or exit ("Unable to create/access to file");
		while (false !== ($file = readdir($handler))) { 
	
			// if $file isn't this directory or its parent, 
			// add it to the results array
			if ($file != '.' && $file != '..'){
				if ( !is_dir("$directorypath/$file")){
					//verify if the file is an image jpg ou jpeg
					if (strpos($file,".jpg")!=null){
						//$newfile=substr($file,0,(strlen($file)-4));
						//Uncomment the upper line to remove the extension of the file
						//In this case we conserve the extenstion
						fwrite($fileopen,$file."\n");
					}
				}else{
					//do nothing
				}
			}
		}
		fclose($fileopen);
	}
	// tidy up: close the handler
	closedir($handler);
}

/*********************************************************************************************************/

/*
	Create a file listing all the direct subfolder of a given directory
	param:	$directorypath
	return:	listeClasses_"directory name".txt
**************************************************************************************************/
function createlist($directorypath){
	$resultpath="C:/vhosts/pfe/result/";
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	$name = directoryname($directorypath);
	$fileopen=fopen($resultpath."listeClasses_".$name.".txt","w")or exit ("Unable to create/access to file");
	while (false !== ($file = readdir($handler))) { 

        // if $file isn't this directory or its parent, 
        // add it to the results array
		if ($file != '.' && $file != '..'){
			if ( !is_dir("$directorypath/$file")){
				//donothing
			}else{
				if ($file!='descripteur'){
					$subdirectorypath=$resultpath."classes/";
					fwrite($fileopen,$subdirectorypath.$file.".txt \n");				
				}
			}
		}
	}
    // tidy up: close the handler
    closedir($handler);
	fclose($fileopen);
	return ($resultpath."listeClasses_".$name.".txt");
}

/*********************************************************************************************************/

?>
