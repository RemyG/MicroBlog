<?php require_once(PATH_MODEL."Right.php");
	require_once(PATH_MODEL."User.php");
	?>
<?php if(User::hasCurrentUserRight(RGT_ADMIN)) { ?>
<div id="topmenu">
<div class="main">
<ul>
	<li><a href="index.php?module=news&amp;action=add">Create news</a></li>
	<li><a href="index.php?module=admin&amp;action=create_user">Create user</a></li>
</ul>
</div>
</div>
<?php } ?>