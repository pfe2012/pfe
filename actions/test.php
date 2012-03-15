<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>test</title>
</head>

<body>

	<?php
	function writefile($strtmp){
		$file=fopen("../tempfile/tmp.txt","w")or exit ("Unable to create/access to file");
		foreach ($strtmp as $str){
			fwrite($file,$str."\n");
		
		}
		fclose($file);
	}
	
	/*if (isset($ok))
		{
	foreach ($critere as $choix)
			{
	echo "Choix utilisateur : ",$critere,"<br>";
			}
		}*/	
		echo "Vous avez choisi le descripteur ".$_POST["file"]."<br />";
		$count=0;
		if ($_POST["descripteur"]!= null){
			foreach ($_POST["descripteur"] as $choix){
				echo "Choix des criteres : ".$choix." de valeur ".$_POST[$choix]. "<br />";
				$strtmps[$count]=$_POST[$choix];
				$count=$count+1;
			}
			writefile($strtmps);
		}
		
	//    exec("../test/test.exe = ../test/input.txt 22 ../test/result.txt", $output, $return); 
	//    echo "Dir returned $return, and output: <br />";
	//    var_dump($output);
	//	  echo "<br />";
	//	exec("start ../test/test.exe = ../test/input.txt 22 ../test/result.txt");
		exec("start C:/test/test.exe = C:/test/input.txt 100 C:/test/result.txt", $output, $return);
	    echo "test returned $return, and output: <br />";
	    var_dump($output);
		echo "<br />";
		echo "Click sur continuer pour ecrire dans fichier a et passer à letape suivante <br />";
	  	//onclick="writefile($strtmps)"
	?>
	<a href="/actions/genbase.php" >Continuer avec la generation de base</a> <br />
	<a href="/actions/description.php">Retourner</a> <br />


</body>
</html>