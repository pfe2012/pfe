<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
	<link rel="stylesheet" type="text/css" href="/css/menu.css">
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/css/recherche.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>

<body>
	<script type="text/javascript">
	<!--
	function checkAll(){
		for (i=0;i<40;i++){
			document.getElementById('cbox'+i).checked="checked";
		}
	}
	//-->
	</script>
	
	<div id="leftcolumn">
		<?php 
			include("../menu.php"); 
			include("../functions/rechercheFunctions.php");
			
			# Constants
			define('MAX_WIDTH', 75);
			define('MAX_HEIGHT', 75);	
		?>    
	</div>
	<div id="contentcolumn">
	    <div class="colmask doublepage1">
	    <div class="colleft1">
	    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="rechercheform" enctype="multipart/form-data">
	        
	        <div class="col4">
	        	<?php
			        $resultpath="c:/vhosts/pfe/result/";  // ou seront les r�sultats
					$target_path = "C:/vhosts/pfe/uploads/";   // ou seront les fichiers intermediaires
					$target_path = $target_path . "requete.jpg"; 
						// echo "on est bien avant traitement image";
					if  (($_POST['baseName'])!=""){
						$name=$_POST['baseName'];
					}
					else {
						$name="Coil-100";
					}
					
					if (isset($_FILES['uploadedfile'])){
						if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)){ 
						  // copie de l'image requ�te dans target_path
						  //traitement image: calculer les descripteur + normaliser		
						  $imagepath="C:/vhosts/pfe/uploads/";
						  $paramNormPath=$resultpath."normVar.txt";
						  traitementImage($imagepath,$paramNormPath,$name);
						} 
						else
						{
						  echo "There was an error uploading the file, please try again!";
						}
						if (file_exists($resultpath."RelevanceFeedback.txt"))
							unlink($resultpath."RelevanceFeedback.txt");
					}
					if (isset($_POST['imagechecked']))
					{
							feedback($resultpath,40);
					}			
								
					$command = "start /min C:/vhosts/pfe/test/Recherche(exe)/Recherche.exe = ";
					$command.= $resultpath.$name."_Descripteurs_Transposee.txt ";//Descripteur transposee
					$command.= $resultpath."listeClasses_".$name.".txt ";//Liste classe
					$command.= $resultpath."Params_Index_".$name.".txt ";//params
					$command.= $resultpath."ParamsIndexing_".$name.".txt ";//params indexing
					$command.= $resultpath." ";//repertoire de resultats
					$command.= $resultpath."liste_".$name.".txt";//listes des images
					exec($command, $output, $return);	
			
				    echo "<br />";
					echo "<img src=\"../uploads/requete.jpg\"/>";
					echo "<br />";
					if (file_exists($resultpath."cputime.txt"))
					{
						$fileopen=fopen($resultpath."cputime.txt","r")or exit ("Unable to create/access to file");
						$time=trim(fgets($fileopen));
						echo "Temps de recherche: $time (milisecondes) <br />";
					}
				?>
									
			    <br />
			    <input type ="button" value ="Selectionne tout" onclick="checkAll()"/> 
			    <input type ="reset" value="Reset" />
			    <br />
				
				<input type="submit" value = "continuer" />
				
				<?php
				 echo ("<input type=\"hidden\" name =\"baseName\" value =\"$name\" />");
				?>
	        </div>
	        
	        <div class ="col5">
		  		<div id="main">              
			        <div id="caption">Search Result</div>
			        
			        <div id="result">
						<?php 
						clearAll("../images/tmp/");
						$count=0;
				        $imageList=inputFileName($resultpath."obj1__0.jpg.ans");
						//echo $imageList;
						echo "<table><tr>";	
											
				        foreach ($imageList as $value){
							//echo $value."<br />";
							$img = @imagecreatefromjpeg($value);
							
							if (!$img){ 
								/* Vérification */
							    //echo "image:$value. <br />";
							    $img  = imagecreatetruecolor(150, 30); /* Cr�ation d'une image blanche */
							    $bgc = imagecolorallocate($img, 255, 255, 255);
							    $tc  = imagecolorallocate($img, 0, 0, 0);
							    imagefilledrectangle($img, 0, 0, 150, 30, $bgc);
							    // Affichage d'un message d'erreur
							    imagestring($img, 1, 5, 5, "Erreur de chargement de l'image $imgname", $tc);
							}
							
							if ($img){
							   	//echo $count."<br />";
							   	
							   	# Get image size and scale ratio
							   	$width = imagesx($img);
							   	$height = imagesy($img);
							  	$scale = min(MAX_WIDTH/$width, MAX_HEIGHT/$height);
							  	
							   	# If the image is larger than the max shrink it
								if ($scale < 1){
								   	$new_width = floor($scale*$width);
								  	$new_height = floor($scale*$height);
									//echo $value."<br />";
									# Create a new temporary image
									$tmp_img = imagecreatetruecolor($new_width, $new_height);
									# Copy and resize old image into new image
									imagecopyresized($tmp_img, $img, 0, 0, 0, 0,
									$new_width, $new_height, $width, $height);
									imagedestroy($img);
									//$img = $tmp_img;
									$part=explode('/',$value);
									$name = nameWithoutExtension($part[4]);
									//echo $name;
									$ssrc="../images/tmp/".$name."_thump.jpg";
									imagejpeg($tmp_img,$ssrc);
							    }
							}
							else{
								//echo $count."<br />";
							}
							
							# Create error image if necessary
							if (!$img){
								$img = imagecreate(MAX_WIDTH, MAX_HEIGHT);
								imagecolorallocate($img,0,0,0);
								$c2 = imagecolorallocate($img,70,70,70);
								imageline($img,0,0,MAX_WIDTH,MAX_HEIGHT,$c2);
								imageline($img,MAX_WIDTH,0,0,MAX_HEIGHT,$c2);
							}
							
							# Display the image
							// echo $value."<br />";								   
							echo "<td><div class=\"imgW\"> <div class=\"img100\"><img src=\"$ssrc\" /></div></div>";
							$part=explode('/',$ssrc);
							$name=nameWithoutExtension($part[3]);
							$pos=strpos($name,"_thump");
							$namedp=substr($name,0,$pos);		
							//echo $name;
							echo "<input type=CHECKBOX name=imagechecked[] id=cbox$count value=$count>$namedp</td>";	
						    $count++;
							// echo $count."<br />";
						    if (($count%5)==0){
							   echo "</tr><tr>";
							   //$count=0;
							}
				        } //end foreach
				        
				        echo "</tr></table>";         
				        ?>
					</div>
				
		        	<div id="source">Imanbum</div>
		        	
		        </div>           
	        </div>
	                
	    </form>
		</div>
		</div>
	</div>
</body>
</html>