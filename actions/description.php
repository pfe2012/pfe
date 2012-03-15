<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>description</title>
	<link rel="stylesheet" type="text/css" href="/css/global.css">
	<link rel="stylesheet" type="text/css" href="/css/twocolumn.css">
</head>

<body>
<div id="leftcolumn">
	<?php include("../menu.php"); ?>
</div>

<div id="contentcolumn">
    <form action="description2.php" method="post" name="descriptionform">
        <div class="colmask doublepage">
        <div class="colleft">
            <div class="col1">
                <br>
                  Image logo: IMALBUM goes here.<br />
                  Calcul des Descripteurs pour une image ou une base d'images. <br />
                  Les descripteurs calculés sont stockés sous forme de vecteurs dans
		  le même répertoire que l'image d'entrée. <br />
                  Si on choisit de travailler sur une base d'image, la description 
		  sera appliquée à tous les images contenues dans le répertoire fourni 
		  ainsi que ses sous répertoires.
                <br />
                <p>
                <br />
                   Choisir le type d'objet pour la description <br />
				   <!-- la variable type est devenu type_objet, I = Image et D = Base -->
                   <input type="radio" name="type_objet" value="Image" checked="checked"/> Image <br />
                   <input type="radio" name="type_objet" value="Base" /> Base <br />
                    <br />
                </p>
            </div>
            <div class="col2">
                
                    <br />
                        Choix des descripteurs de l'image <br />
                        Le descripteur couleur: Couleurs dominantes dans l'espace Lab <br />
                        Le descripteur de texture: Gabor avec 3 échelles et 4 orientations <br />
                        Le descripteur forme: ART calculé sur tout l'image <br />
                    <br />
                
                <br />
                <br />
                <br />
                Les descripteurs disponnibles <br />
                
                <input type="checkbox" name="descripteur[]" value="couleur"> Couleur <br />
                <input type="checkbox" name="descripteur[]" value="texture"> Texture <br />
                <input type="checkbox" name="descripteur[]" value="forme"> Forme <br />
            </div>
        </div>
        </div>
        
        <input type="submit" name="submit" value="Continuer" />
        
    </form>
</div>

</body>
</html>