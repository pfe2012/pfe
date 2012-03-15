<?php
 
require_once "header.php";
 
$uid = (int)htmlentities(strip_tags($_GET['uid']));
$actcode = htmlentities(strip_tags($_GET['actcode']));
 
if (activateUser($uid, $actcode) == true)
{
    echo "Thank you for activating your account, You can now login.
		<a href='../index.php'>Click here to login.</a>";
} else
{
    echo "Activation failed! Please try again.";
    echo "If problem presists please contact the webmaster.";
}
 
require_once "footer.php";
?>