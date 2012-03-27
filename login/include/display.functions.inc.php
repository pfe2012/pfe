<?php
 
#### Display Functions ####

function show_userbox()
{
    // retrieve the session information
    $u = $_SESSION['username'];
    $uid = $_SESSION['loginid'];
    // display the user box
    echo "<div id='userbox'>
			Welcome $u
			<ul>
				<li><a href='login/changepassword.php'>Change Password</a></li>
				<li><a href='login/logout.php'>Logout</a></li>
			</ul>
		 </div>";
    echo '<div id="leftcolumn">';
    include("./../pfe/menu.php"); 
    echo '</div>';
    
}
 
function show_changepassword_form(){
 
echo '<form action="./changepassword.php" method="post"> 
  <fieldset> 
  <legend>Change Password</legend> 
  <input type="hidden" value="'.$_SESSION['username'].'" name="username"> 
  <dl> 
    <dt> 
      <label for="oldpassword">Current Password:</label> 
    </dt> 
    <dd> 
      <input name="oldpassword" type="password" id="oldpassword" maxlength="15"> 
    </dd> 
  </dl> 
  <dl> 
    <dt> 
      <label for="password">New Password:</label> 
    </dt> 
    <dd> 
      <input name="password" type="password" id="password" maxlength="15"> 
    </dd> 
  </dl> 
  <dl> 
    <dt> 
      <label for="password2">Re-type new password:</label> 
    </dt> 
    <dd> 
      <input name="password2" type="password" id="password2" maxlength="15"> 
    </dd> 
  </dl> 
  <p> 
    <input name="reset" type="reset" value="Reset"> 
    <input name="change" type="submit" value="Reset Password"> 
  </p> 
  </fieldset> 
</form>
';
}
 
function show_loginform($disabled = false)
{
 	echo '<div class="signin-box">';
    echo '<form name="login-form" id="login-form" method="post" action="./index.php"> 
			  <fieldset> 
			  <legend>Please login</legend> 
			  <dl> 
			    <dt><label title="Username"><strong>Username: </strong></label></dt> 
			    <dt><input tabindex="1" accesskey="u" name="username" type="text" maxlength="30" id="username" value=""/></dt> 
			  </dl> 
			  <dl> 
			    <dt><label title="Password"><strong>Password: </strong></label></dt> 
			    <dt><input tabindex="2" accesskey="p" name="password" type="password" maxlength="15" id="password" /></dt> 
			  </dl> 
			  <ul> 
			    <li><a href="login/register.php" title="Register">Register</a></li> 
			    <li><a href="login/lostpassword.php" title="Lost Password">Lost password?</a></li> 
			  </ul> 
			  <div class="buttons"><input class="button" tabindex="3" accesskey="l" type="submit" name="cmdlogin" value="Login" ';
    if ($disabled == true)
    {
        echo 'disabled="disabled"';
    }
    echo ' /></div></fieldset></form>';
    echo '</div>'; 
}


function show_lostpassword_form(){
 
	echo '<form action="./lostpassword.php" method="post"> 
			<fieldset><legend>Reset Password</legend>
			  <dl> 
			    <dt><label for="username">Username:</label></dt> 
			    <dd><input name="username" type="text" id="username" maxlength="30">
			    </dd> 
			  </dl> 
			   <dl> 
			    <dt><label for="email">Email:</label></dt> 
			    <dd><input name="email" type="text" id="email" maxlength="255">
			    </dd> 
			  </dl> 
			  <div class="buttons"> 
			    <input class="button" name="reset" type="reset" value="Reset"> 
			    <input class="button" name="lostpass" type="submit" value="Reset Password"> 
			  </div> 
		  </fieldset>
		</form>';
}
 
function show_registration_form(){
 
	echo '<form action="./register.php" method="post"> 
			<fieldset><legend>Register</legend>
			  <dl> 
			    <dt><label for="username">Username:</label></dt> 
			    <dd><input name="username" type="text" id="username" maxlength="30">
			    </dd> 
			  </dl> 
			  <dl> 
			    <dt><label for="password">Password:</label></dt> 
			    <dd><input name="password" type="password" id="password" maxlength="15">
			    </dd> 
			  </dl> 
			  <dl> 
			    <dt><label for="password2">Re-type password:</label></dt> 
			    <dd><input name="password2" type="password" id="password2" maxlength="15">
			    </dd> 
			  </dl> 
			  <dl> 
			    <dt><label for="email">email:</label></dt> 
			    <dd><input name="email" type="text" id="email" maxlength="255">
			    </dd> 
			  </dl> 
			  <div class="buttons"> 
			    <input class="button" name="reset" type="reset" value="Reset"> 
			    <input class="button" name="register" type="submit" value="Register"> 
			  </div> 
			</fieldset>
		 </form>';
}
?>