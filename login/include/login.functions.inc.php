<?php
 
#### Login Functions #####

 
function isLoggedIn()
{
 
	if (isset($_SESSION['loginid']) &&( $_SESSION['username'])) {
        return true; // the user is loged in
    } else {
        return false; // not logged in
    }
 
    return false;
 
}
 
function checkLogin($u, $p)
{
global $seed; // global because $seed is declared in the header.php file
 
    if (!valid_username($u) || !valid_password($p) || !user_exists($u))
    {
        return false; // the name was not valid, or the password, or the username did not exist
    }
 
    //Now let us look for the user in the database.
    $query = sprintf("
		SELECT loginid 
		FROM login 
		WHERE 
		username = '%s' AND password = '%s' 
		AND disabled = 0 AND activated = 1 
		LIMIT 1;", mysql_real_escape_string($u), mysql_real_escape_string(sha1($p . $seed)));
    $result = mysql_query($query);
    // If the database returns a 0 as result we know the login information is incorrect.
    // If the database returns a 1 as result we know  the login was correct and we proceed.
    // If the database returns a result > 1 there are multple users
    // with the same username and password, so the login will fail.
    if (mysql_num_rows($result) != 1)
    {
        return false;
    } else
    {
        // Login was successfull
        $row = mysql_fetch_array($result);
        // Save the user ID for use later
        $_SESSION['loginid'] = $row['loginid'];
        // Save the username for use later
        $_SESSION['username'] = $u;
        // Now we show the userbox
        return true;
    }
    return false;
}
 
?>