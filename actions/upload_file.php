<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>uploadfile</title>
</head>

<body>
	<?php
	if ($_FILES["file"]["error"] > 0)
	  {
	  echo "Error: " . $_FILES["file"]["error"] . "<br />";
	  }
	else
	  {
	  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	  echo "Type: " . $_FILES["file"]["type"] . "<br />";
	  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	  echo "Stored in: " . $_FILES["file"]["tmp_name"];
	  }
	?> 
</body>
</html>