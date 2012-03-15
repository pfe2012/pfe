<?php
 
##### User Functions #####

function changePassword($username,$currentpassword,$newpassword,$newpassword2){
global $seed;	
	if (!valid_username($username) || !user_exists($username))
    {
        return false;
    }
    if (! valid_password($newpassword) || ($newpassword != $newpassword2)){
 
		return false;
	}
 
	// we get the current password from the database
    $query = sprintf("SELECT password FROM login WHERE username = '%s' LIMIT 1",
        mysql_real_escape_string($username));
 
    $result = mysql_query($query);
	$row= mysql_fetch_row($result);
 
	// compare it with the password the user entered, if they don't match, we return false, he needs to enter the correct password.
	if ($row[0] != sha1($currentpassword.$seed)){
 
		return false;	
	}
 
	// now we update the password in the database
    $query = sprintf("update login set password = '%s' where username = '%s'",
        mysql_real_escape_string(sha1($newpassword.$seed)), mysql_real_escape_string($username));
 
    if (mysql_query($query))
    {
		return true;
	}else {return false;}
	return false;
}
 
 
function user_exists($username)
{
    if (!valid_username($username))
    {
        return false;
    }
 
    $query = sprintf("SELECT loginid FROM login WHERE username = '%s' LIMIT 1",
        mysql_real_escape_string($username));
 
    $result = mysql_query($query);
 
    if (mysql_num_rows($result) > 0)
    {
        return true;
    } else
    {
        return false;
    }
 
    return false;
 
}
 
function activateUser($uid, $actcode)
{
 
    $query = sprintf("select activated from login where loginid = '%s' and actcode = '%s' and activated = 0  limit 1",
        mysql_real_escape_string($uid), mysql_real_escape_string($actcode));
 
    $result = mysql_query($query);
 
    if (mysql_num_rows($result) == 1)
    {
 
        $sql = sprintf("update login set activated = '1'  where loginid = '%s' and actcode = '%s'",
            mysql_real_escape_string($uid), mysql_real_escape_string($actcode));
 
        if (mysql_query($sql))
        {
            return true;
        } else
        {
            return false;
        }
 
    } else
    {
 
        return false;
 
    }
 
}
 
function registerNewUser($username, $password, $password2, $email)
{
 
    global $seed;
 
    if (!valid_username($username) || !valid_password($password) || 
        	!valid_email($email) || $password != $password2 || user_exists($username))
    {
        return false;
    }
 
 
    $code = generate_code(20);
    $sql = sprintf("insert into login (username,password,email,actcode) value ('%s','%s','%s','%s')",
        mysql_real_escape_string($username), mysql_real_escape_string(sha1($password . $seed))
		, mysql_real_escape_string($email), mysql_real_escape_string($code));
 
 
    if (mysql_query($sql))
    {
        $id = mysql_insert_id();
 
        if (sendActivationEmail($username, $password, $id, $email, $code))
        {
 
            return true;
        } else
        {
            return false;
        }
 
    } else
    {
        return false;
    }
    return false;
 
}
 
function lostPassword($username, $email)
{
 
	global $seed;
    if (!valid_username($username) || !user_exists($username) || !valid_email($email))
    {
 
        return false;
    }
 
    $query = sprintf("select loginid from login where username = '%s' and email = '%s' limit 1",
        $username, $email);
 
    $result = mysql_query($query);
 
    if (mysql_num_rows($result) != 1)
    {
 
        return false;
    }
 
 
    $newpass = generate_code(8);
 
    $query = sprintf("update login set password = '%s' where username = '%s'",
        mysql_real_escape_string(sha1($newpass.$seed)), mysql_real_escape_string($username));
 
    if (mysql_query($query))
    {
 
            if (sendLostPasswordEmail($username, $email, $newpass))
        {
            return true;
        } else
        {
            return false;
        }      
 
    } else
    {
        return false;
    }
 
    return false;
 
}
 
?>