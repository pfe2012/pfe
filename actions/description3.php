<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>description3</title>
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
</head>

<body>

	<div id="leftcolumn">
		<?php 
			include("../menu.php"); 
		 	include("../functions/commonFunctions.php");
			include("../functions/descriptionFunctions.php");
		?>
	</div>
	
	<?php
	
		$CFB = 1;  // calcul Fonction de Base ART. si à 1 le calcul doit être fait
		// imane le 26 Avril 2010 
		//$nbcouler=7;
		//Changement de la condition, correspondant à l'elimination de l'attribut disabled
		if ($_POST["nbcouleur"]!=""){	
			$nbcouler=$_POST["nbcouleur"];
		}else{
			$nbcouler=7;
		}
		
		if ($_POST["operation"]!= ""){
			$histo=false;
			foreach ($_POST["operation"] as $choix){
				
				/******** COULEUR DOMINANTE *********/
				
				//imane le 14 avril  2010
				//Eliminée la condition ($histo==false) du if
				if ($choix == "couleurdominante") {
					if(($_POST["imagepath"]!="")&&($_POST["imagename"]!="")){
						$_POST["imagepath"]=correctpath($_POST["imagepath"]);
											
						//imane le 26 avril 2010
						
						$command= "start C:/vhosts/pfe/test/couleursdominantes/quantif_couleur_seul_sans_fond_noir.exe = ";
						$command.= " image=".$_POST["imagename"];
						$command.= " pathin=".$_POST["imagepath"];
						$command.= " pathout=".$_POST["imagepath"];
						$command.= " Nb_coul=".$nbcouler;
						exec($command, $output, $return);
					}else if ($_POST["directorypath"]!=""){
						$tempdirectorypath=correctpath($_POST["directorypath"]);
						loopdirectorycolor($tempdirectorypath,$nbcouler);
					}
				}
			
				/******** HISTOGRAMME **********/
				
				if ($choix == "histogramme") {
					$histo=true;
					if(($_POST["imagepath"]!="")&&($_POST["imagename"]!="")){
											
						$_POST["imagepath"]=correctpath($_POST["imagepath"]);
						$command = "start C:/vhosts/pfe/test/histogramcouleur(exe)/Hist_Norm.exe = ";
						$command.= "C:/vhosts/pfe/test/couleursdominantes/quantif_couleur_seul_sans_fond_noir.exe ";//chemin vers couleurdominantes
						$command.= " image=".$_POST["imagename"];//nom de l'image
						$command.= " pathin=".$_POST["imagepath"];//chemin vers l'image
						$command.= " pathout=".$_POST["imagepath"];//chemin vers le resultat de couleurdominantes
						$command.= " Nb_coul=".$nbcouler;//nb de couleur dominantes
						$command.= " ".$_POST["imagename"]."_color";//nom du ficher de resultat de couleurdominantes
						$command.= " ".$_POST["imagepath"].$_POST["imagename"]."_hist.txt";//chemin complet vers le resultat de hist
						
						//echo "test ".$command."<br />";
						exec($command, $output, $return);
					}else if ($_POST["directorypath"]!=""){
						$tempdirectorypath=correctpath($_POST["directorypath"]);
						loopdirectoryhist($tempdirectorypath,$nbcouler);
					}
				}
				
				
				
				/******** ART *********/
				
				if ($choix == "art") {
					if(($_POST["imagepath"]!="")&&($_POST["imagename"]!="")){
						$_POST["imagepath"]=correctpath($_POST["imagepath"]);
										
						$command = "start c:/vhosts/pfe/test/ART(exe)/calcul_ART_Coil.exe = ";
						$command.= " image=".$_POST["imagename"];//nom de l'image
						$command.= " pathin=".$_POST["imagepath"];//chemin vers l'image
						$command.= " pathfb=".$_POST["imagepath"]."fctbase.txt";//chemin vers le resultat de la fct de base
						$command.= " pathout=".$_POST["imagepath"];//chemin vers le resultat de l'art
						$command.= " CFB=".$CFB;// si 1 alors on recalcule les fonctions de base
	
						//echo "test ".$command."<br />";
						exec($command, $output, $return);
					}else if ($_POST["directorypath"]!=""){
						$tempdirectorypath=correctpath($_POST["directorypath"]);
						loopdirectoryart($tempdirectorypath,$CFB);
					}
				}
			}
			// imane  le1 4 Avril
			
			
		}else{ 
			echo("Vous n'avez pas choisit d'opération <br />");
		}
	
	?>
	<div id="contentcolumn">
		<br />
	    Vous avez fini l'etape description <br />
	    Appuyez sur le button continuer pour passer a l'etape generation de base <br />
	    
	    <form action="genbase.php" method="post" name="myform"> 
	        <input type ="hidden" name="dPath" value="<?php echo correctpath($_POST['directorypath'])?>"/>
			<input type="submit" name="submit" value="Continuer" />
	    </form>
	</div>
	
</body>
</html>