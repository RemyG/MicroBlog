<?php

function cleanGlobal($global_array, $arg, $specialchars = true, $default = null) {
	if(key_exists($arg, $global_array) && $global_array[$arg] != null && $global_array[$arg] != "") {
		if($specialchars) {
			return htmlspecialchars($global_array[$arg]);
		} else {
			return $global_array[$arg];
		}
	} else {
		return $default;
	}
}

define('SQL_DSN',      'mysql:dbname=microblog;host=localhost');
define('SQL_USERNAME', 'user');
define('SQL_PASSWORD', 'password');

$module = empty($module) ? !empty($_GET['module']) ? $_GET['module'] : 'index' : $module;
define('PATH_VIEW',    	'modules/'.$module.'/views/');
define('PATH_JS',     	'modules/'.$module.'/js/');
define('PATH_MODEL', 	'modeles/');
define('PATH_LIB',    	'libs/');

define('SITE_TITLE', 'MicroBlog');
define('SITE_OWNER', 'Rémy GARDETTE');
define('SITE_OWNER_MAIL', 'contact@remy-gardette.fr');
define('SITE_OWNER_PAGE', 'remy-gardette.fr/en');

define('GITHUB_SOURCES', 'https://github.com/RemyG/MicroBlog');

define("FR_DT_POST", "\l\e d/m/Y \à h:i");
define("EN_DT_POST", "Y-m-d g:ia");
define("EN_DT_POST_SHORT", "Y-m-d");

define('NB_POST_PER_PAGE', 5);

define('RGT_ADMIN', 'ADMIN');

define('TABLE_POST', 	'post');
define('TABLE_COMMENT', 'comment');

define('SESSION_KEY', 'key');