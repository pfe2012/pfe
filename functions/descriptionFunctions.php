<?php

/*
	A loop with the function "couleur dominante" in and given directory
	params: 	$directorypath
				$nbcouler: number of dominant color - used by "couleur domiante"
	return:		"couleur domiante" will create a file "image name".dsc for each image found in the given directory
				in the same folder as image.
	remarks:	need to create a seperate folder for result? For the purpose of better maintenability
*/
function loopdirectorycolor($directorypath,$nbcouler){
	set_time_limit(0);
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	if (file_exists(dirname($directorypath)."/descripteur/")){
		$resultpath=dirname($directorypath)."/descripteur/".basename($directorypath)."/";
		if (!file_exists($resultpath))
		mkdir($resultpath, 0777);
	}
	while (false !== ($file = readdir($handler))) { 

        // if $file isn't this directory or its parent, 
        // add it to the results array
		if ($file != '.' && $file != '..'){
			if ( !is_dir("$directorypath/$file")){  // si on d�crit une image
				//verify if the file is an image jpg
				if (strpos($file,".jpg")!=null){
				$newfile=nameWithoutExtension($file);
				$command= "start /min C:/vhosts/pfe/test/couleursdominantes(exe)/quantif_couleur_seul_sans_fond_noir.exe = image=".$newfile." pathin=".$directorypath." pathout=".$resultpath." Nb_coul=".$nbcouler;
				exec($command, $output, $return);
				}
			}else{					// si on d�crit une base
				if ($file!='descripteur'){
					if (!file_exists($directorypath."descripteur/"))
					mkdir($directorypath."descripteur/", 0777);
					$subdirectorypath="$directorypath$file/";
					//echo $subdirectorypath."<br />";
					loopdirectorycolor($subdirectorypath,$nbcouler);			
				}
			}
		}
	}
    // tidy up: close the handler
    closedir($handler);

}

/*********************************************************************************************************/

/*
	A loop with the function "histogramme" in and given directory
	params: 	$directorypath
				$nbcouler: number of dominant color - used by "histogramme"
	return:		"histogramme" will create 2 files "image name".dsc and "image name"_hist.txt for each image found in the given
				directory in the same folder as image.
	remarks:	need to create a seperate folder for result? For the purpose of better maintenability
*/

/*********************************************************************************************************/
function loopdirectoryhist($directorypath,$nbcouler){
	set_time_limit(0);
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	if (file_exists(dirname($directorypath)."/descripteur/")){
		$resultpath=dirname($directorypath)."/descripteur/".basename($directorypath)."/";
		if (!file_exists($resultpath))
		mkdir($resultpath, 0777);
	}
	while (false !== ($file = readdir($handler))) { 

        // if $file isn't this directory or its parent, add it to the results array
		if ($file != '.' && $file != '..'){
			if ( !is_dir("$directorypath/$file")){
				//verify if the file is an image jpg
				if (strpos($file,".jpg")!=null){
					$newfile=nameWithoutExtension($file);
					$command = "start /min C:/vhosts/pfe/test/histogramcouleur(exe)/Hist_Norm.exe = ";
					$command.= "C:/vhosts/pfe/test/couleursdominantes/quantif_couleur_seul_sans_fond_noir.exe ";//chemin vers couleurdominantes
					$command.= " image=".$newfile;//nom de l'image
					$command.= " pathin=".$directorypath;//chemin vers l'image
					$command.= " pathout=".$resultpath;//chemin vers le resultat de couleurdominantes
					$command.= " Nb_coul=".$nbcouler;//nb de couleur dominantes
					$command.= " ".$newfile."_color";//nom du ficher de resultat de couleurdominantes
					$command.= " ".$resultpath.$newfile."_hist.txt";//chemin complet vers le resultat de hist
					
					
					
					//echo "test ".$command."<br />";
					exec($command, $output, $return);
					}
				}else{
				if ($file!='descripteur'){
					if (!file_exists($directorypath."descripteur/"))
					mkdir($directorypath."descripteur/", 0777);
					$subdirectorypath="$directorypath$file/";
					//echo $subdirectorypath."<br />";
					loopdirectoryhist($subdirectorypath,$nbcouler);			
					}
				}
		}
	}
    // tidy up: close the handler
    closedir($handler);

}

/*********************************************************************************************************/

/*
	A loop with the function "art" in and given directory
	params: 	$directorypath
				$nbcouler: number of dominant color - used by "art"
	return:		"histogramme" will create 
					a file "image name"_shape.dsc  for each image found in the given directory in the same folder as image.
					a list of jpeg file and a fctdebase.txt
	remarks:	need to create a seperate folder for result? For the purpose of better maintenability

*/

/*********************************************************************************************************/
function loopdirectoryart($directorypath,$nbcouler){
	
	set_time_limit(0);
	$handler = opendir($directorypath) or die ("Cant open directory; directorypath: ".$directorypath);
	if (file_exists(dirname($directorypath)."/descripteur/")){
		$resultpath=dirname($directorypath)."/descripteur/".basename($directorypath)."/";
		if (!file_exists($resultpath))
		mkdir($resultpath, 0777);
	}
	while (false !== ($file = readdir($handler))) { 

        // if $file isn't this directory or its parent, 
        // add it to the results array
		if ($file != '.' && $file != '..'){
			if ( !is_dir("$directorypath/$file")){
				//verify if the file is an image jpg
				if (strpos($file,".jpg")!=null){
					//$newfile=substr($file,0,(strlen($file)-4));
															
					$CFB=1;  // on recalcule les fonctions de base 
					$newfile=nameWithoutExtension($file);
					$command = "start /min C:/vhosts/pfe/test/ART(exe)/calcul_ART_coil.exe = ";
					$command.= " image=".$newfile;//nom de l'image
					$command.= " pathin=".$directorypath;//chemin vers l'image
					$command.= " pathfb=".$resultpath."fctbase.txt";//chemin vers le resultat de la fct de base
					$command.= " pathout=".$resultpath;//chemin vers le resultat de l'art
					$command.= " CFB=".$CFB;      // 1: on recalcule les fonctions de base	*/
                             
					
					//echo "test ".$command."<br />";
					
					exec($command, $output, $return);
				}
				}else{
				if ($file!='descripteur'){
					if (!file_exists($directorypath."descripteur/"))
					mkdir($directorypath."descripteur/", 0777);
					$subdirectorypath="$directorypath$file/";
					//echo $subdirectorypath."<br />";
					loopdirectoryart($subdirectorypath,$nbcouler);			
					}
				}
			}
	}
    // tidy up: close the handler
    closedir($handler);

}

/*********************************************************************************************************/

?>