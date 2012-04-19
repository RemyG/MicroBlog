<?php

require_once(PATH_MODEL."Right.php");
require_once(PATH_MODEL."User.php");

$login = cleanGlobal($_POST, 'login');
$password = cleanGlobal($_POST, 'password');

$disconnect = cleanGlobal($_GET, 'disconnect');

if($login && $password) {
	
	$user = User::getUserByName($login);
	
	if($user == null) {
		
		echo 'NO USER';
		include(PATH_VIEW."view_connection.php");
		
	} else if (sha1($password) != $user->getPassword()) {
	
		echo 'AUTHENTICATION ERROR';
		include(PATH_VIEW."view_connection.php");
	
	} else {

		$_SESSION['connected'] = 1;
		$_SESSION['usr_id'] = $user->getId();
		$user->setListRights(Right::getRightsForUser($user->getId()));
		$_SESSION['current_user'] = serialize($user);
		echo 'OK';
		
	}
	
	
} else if ($disconnect && $disconnect == 1) {

	session_destroy();
	
	echo '
	<script type="text/javascript">
	<!--
	window.location = "index.php";
	//-->
	</script>';
	

} else {

	include(PATH_VIEW."view_connection.php");
	
}

?>