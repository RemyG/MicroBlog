<?php

require_once(PATH_MODEL."Right.php");
require_once(PATH_MODEL."User.php");

if(!User::hasCurrentUserRight(RGT_ADMIN)) {
	
	include(PATH_LIB."redirect_connection.php");
	
}

if($_POST != null) {
	
	$name = cleanGlobal($_POST, 'login');
	$password = cleanGlobal($_POST, 'password', false);
	$password2 = cleanGlobal($_POST, 'password2', false);
	$mail = cleanGlobal($_POST, 'mail');
	
	if($name && $password && $password2 && $mail) {
		
		if($password != $password2) {
			
			echo 'PASSWORD NOT CORRESPONDING';
			
		} else {
			
			$usr_password = sha1($password);
			$user = new User(null, $name, $usr_password, $mail, null);
			User::createUser($user);
			echo 'USER CREATED';
			
		}
		
	} else {
		
		echo 'MISSING PARAMETERS';
		
	}
	
}

include(PATH_VIEW."view_create_user.php");

?>