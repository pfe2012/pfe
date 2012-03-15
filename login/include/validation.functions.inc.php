<?php
 
#### Validation functions ####

function valid_email($email)
{
	$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';   // caractères autorisés avant l'arobase
	$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // caractères autorisés après l'arobase (nom de domaine)
	                               
	$regex = '/^' . $atom . '+' .   // Une ou plusieurs fois les caractères autorisés avant l'arobase
	'(\.' . $atom . '+)*' .         // Suivis par zéro point ou plus
	                                // séparés par des caractères autorisés avant l'arobase
	'@' .                           // Suivis d'un arobase
	'(' . $domain . '{1,63}\.)+' .  // Suivis par 1 à 63 caractères autorisés pour le nom de domaine
	                                // séparés par des points
	$domain . '{2,63}$/i';          // Suivi de 2 à 63 caractères autorisés pour le nom de domaine
	
	// test de l'adresse e-mail
	if (preg_match($regex, $email)) {
		return true;
	} else {
	    return false;
	}
}
 
function valid_username($username, $minlength = 3, $maxlength = 30)
{
 
    $username = trim($username);
 
/*    if (empty($username))
    {
        return false; // it was empty
    }
    if (strlen($username) > $maxlength)
    {
        return false; // to long
    }
    if (strlen($username) < $minlength)
    {
        return false; //toshort
    }
 
    $result = ereg("^[A-Za-z0-9_\-]+$", $username); //only A-Z, a-z and 0-9 are allowed
 
    if ($result)
    {
        return true; // ok no invalid chars
    } else
    {
        return false; //invalid chars found
    }
*/ 
    return true;
 
}
 
function valid_password($pass, $minlength = 6, $maxlength = 15)
{
    $pass = trim($pass);
 
/*	if (preg_match("#.*^(?=.{".$minlength.",".$maxlength."})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pass)){
        return true;
	} else {
        return false;
	}
 
    $result = ereg("^[A-Za-z0-9_\-]+$", $pass);
 
    if ($result)
    {
        return true;
    } else
    {
        return false;
    }
*/ 
    return true;
}
 
?>