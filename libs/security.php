<?php

require_once(PATH_MODEL."User.php");



if(is_null($_SESSION['connected']) || $_SESSION['connected'] != 1 || !User::hasCurrentUserRight(RGT_ADMIN)) { 
	
?>
	
<script type="text/javascript">
<!--
window.location = "index.php?module=admin&action=connection";
//-->
</script>	
	
<?php

}

?>