<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>search 1</title>
</head>

<body>

    <div id="leftcolumn">
        <?php 
            include("../menu.php"); 
            include("../functions/rechercheFunctions.php");
        ?>    
    </div>
	<div id="contentcolumn">
		<?php
		//feedback("c:/",17);
		$imagepath="C:/vhosts/pfe/uploads/";
		$paramNormPath="C:/test/301209/normVar.txt";
		traitementImage($imagepath,$paramNormPath);
		?>
	</div>

</body>
</html>