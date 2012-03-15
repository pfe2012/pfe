<?php
//error_reporting(0); // we don't want to see errors on screen
// Start a session
session_start();
require_once ('include/db_connect.inc.php'); // include the database connection
require_once ("include/functions.inc.php"); // include all the functions
$seed="0dAfghRqSTgx"; // the seed for the passwords
$domain =  "insa-lyon.fr"; // the domain name without http://www.
 
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Complete Member Login - <?php echo $domain; ?></title>
</head>
<body>