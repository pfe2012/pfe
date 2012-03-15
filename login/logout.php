<?php 
session_start();
if (!isset($_SESSION['loginid']) == true && $_SESSION['username'] == true ) {
    session_destroy();
	header('Location: ../index.php');
  } else {
   unset($_SESSION['loginid']);
   unset($_SESSION['username']);
   session_destroy();
   header('Location: ../index.php');
}
?>