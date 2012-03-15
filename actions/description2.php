<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>description2</title>
	<link rel="stylesheet" type="text/css" href="/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css" />
</head>

<body>
    
    <div id="leftcolumn">
        <?php include("../menu.php"); ?>
    </div>

    <div id="contentcolumn">
        <p>
            <br />
                Calcul des descripteurs couleurs <br />
                Le descripteur couleur est composé de Nb_coul couleurs dominantes <br />
                Le descripteur couleur: Couleurs dominantes dans l'espace Lab <br />
                Pourcentages des classes <br />
                Cohérence spatiale <br />
                Histogramme couleur Lab par mélange de Gaussienne des CD<br />
            <br />
        </p>  

	<script type="text/javascript">
	<!--
	function enableField(){
	
		document.myform.type.disabled=false;
		document.myform.nbcouleur.disabled=false;
	
	}
	function testJava(){
		if (document.myform.opHisto == true){
			document.myform.directorypath.text = "hello";
		}else document.myform.directorypath.text ="";
	}
	//--> 
	</script>

	<form action="description3.php" method="post" name="myform">

        <div class="colmask doublepage">
	        <div class="colleft">
	            <div class="col1">
	                Paramètres à founir:<br />
	                <table>
	                <tr>
	                	<td>Nombre couleur</td>
						<!-- l'attribut disabled de la variable nbcouleur a été eliminé pour pouvoir saisir le nb de couleur -->
	                	<td><input type="text" name="nbcouleur" value="" id="nbcouleur"/><br/></td>
	                </tr>
					<?php
	                	if ($_POST["type_objet"]== "Image"){
	                		echo("<tr><td>Nom de l'image</td><td><input type=\"label\" name=\"imagename\" id=\"imagename\" </td></tr>");
	                		echo("<tr><td>Chemin vers l'image</td><td><input type=\"label\" name=\"imagepath\" id=\"imagepath\"</td></tr>");
	                	}else{
	                    	echo("<tr><td>Chemin vers la base</td><td><input type=\"label\" name=\"directorypath\" id=\"directorypath\" </td></tr>");			
	                    }
	                ?>
	                </table> 
	
	    		</div>
	    		
	     		<div class="col2"> 
	               Choisir l'opération:<br />
					<input type="checkbox" name="operation[]" id = "opHisto" value="histogramme" onclick="testJava()" /> Histogramme <br />
	                <input type="checkbox" name="operation[]" id ="opColor"value="couleurdominante" /> Couleur dominate <br />
	                <input type="checkbox" name="operation[]" id = "opArt" value="art" /> ART <br />
	      		</div>
	        </div>
        </div>
                    
		<input type="submit" name="submit" value="Continuer" />
        <input type="button" value="Revenir" onclick="history.go(-1);return true;" />
        
	</form>
	<?php
        if ($_POST["descripteur"]!= null){
            foreach ($_POST["descripteur"] as $choix){
                if ($choix == "couleur") {
                echo "<script type='text/javascript'> enableField()</script>";
                }
            }
        }
    ?>

</div>
</body>
</html>