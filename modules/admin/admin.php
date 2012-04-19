<?php

require_once(PATH_MODEL."Right.php");
require_once(PATH_MODEL."User.php");

if(!User::hasCurrentUserRight(RGT_ADMIN)) {
	
	include(PATH_LIB."redirect_connection.php");
	
}

include(PATH_VIEW."view_admin.php");



?>