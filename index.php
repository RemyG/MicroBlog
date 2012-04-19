<?php

// Initialisation
include 'global/init.php';

$error = null;

if($_POST != null && cleanGlobal($_POST, 'action') == "connect") {
	
	require_once(PATH_MODEL."Right.php");
	require_once(PATH_MODEL."User.php");
	
	$login = cleanGlobal($_POST, 'login');
	$password = cleanGlobal($_POST, 'password', false);
	
	if(!is_null($login) && !is_null($password)) {
	
		$connect = User::getUserByName($login);
	
		if(!is_null($connect) && $connect->getPassword() == sha1($password)) {
				
			session_name(SESSION_KEY);
			$_SESSION['connected'] = 1;
			$_SESSION['usr_id'] = $connect->getId();
			$connect->setListRights(Right::getRightsForUser($connect->getId()));
			$_SESSION['current_user'] = serialize($connect);
				
			$usrid = $connect->getId();
			$error = "OK";
				
		} else {
				
			if(is_null($connect)) {
				$usrid = "NULL";
				$error = "Wrong login.";
			} else if ($connect->getPassword() != sha1($password)) {
				$usrid = "NULL";
				$error = "Wrong password.";
			}
				
		}
	
	} else {
	
		if(is_null($login)) {
			$usrid = "NULL";
			$error = "Login missing.";
		} else if (is_null($password)) {
			$usrid = "NULL";
			$error = "Password missing.";
		}
	
	}
	
} else if($_POST != null && cleanGlobal($_POST, 'action') == "disconnect") {
	
	session_name(SESSION_KEY);
	session_destroy();
	header('Location: '.$_SERVER['REQUEST_URI']);
	
}

// Début de la tamporisation de sortie
ob_start();

// Si un module est specifié, on regarde s'il existe
if (!empty($_GET['module'])) {

	$module = dirname(__FILE__).'/modules/'.$_GET['module'].'/';
	
	// Si l'action est specifiée, on l'utilise, sinon, on tente une action par défaut
	$action = (!empty($_GET['action'])) ? $_GET['action'].'.php' : 'index.php';
	
	// Si l'action existe, on l'exécute
	if (is_file($module.$action)) {

		include $module.$action;

	// Sinon, on affiche la page d'accueil !
	} else {

// 		header('Location: 404.php');
		include '404.php';
		
	}

} else if (!empty($_GET['action']) && $_GET['action'] == 'license') {
	
	include 'global/license.php';
	
// Module non specifié ou invalide ? On affiche la page d'accueil !
} else {

   header('Location: index.php?module=news');

}

// Fin de la tamporisation de sortie
$contenu = ob_get_clean();

// Début du code HTML
include 'global/header.php';

echo $contenu;

// Fin du code HTML
include 'global/footer.php';
