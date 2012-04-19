<?php

require_once(PATH_MODEL."Post.php");
require_once(PATH_MODEL."User.php");
require_once(PATH_MODEL."Right.php");

?>

<div id="rightmenu">
	<div class="rightmenu_group" style="margin-top: 0;">
		<a href="index.php">Home</a>
	</div>
	<div class="rightmenu_group">
		<a href="index.php?module=misc&amp;action=about">About</a>
	</div>
	<div class="rightmenu_group">
		<a href="index.php?action=license">License</a>
	</div>
	<div class="rightmenu_group" <?php if(User::isCurrentUserConnected()) echo 'style="display: none;"'?>>
		<form method="post">
		<input type="hidden" name="action" value="connect" />
		<table>
			<tr>
				<td><label for="login">Login</label></td>
				<td><input type="text" id="login" name="login"/></td>
			</tr>
			<tr>
				<td><label for="password">Password</label></td>
				<td><input type="password" id="password" name="password"/></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;">
					<input type="submit" value="Connect" style="width: auto"/>
				</td>
			</tr>
			<!-- 
			<tr>
				<td colspan="2">
					No account ? <a href="index.php?module=admin&amp;action=sign">Sign up</a>
				</td>
			</tr>
			 -->
		</table>
		</form>
	</div>
	<div class="rightmenu_group" <?php if(!User::isCurrentUserConnected()) echo 'style="display: none;"'?>>
		<form method="post" id="signoutform">
		<input type="hidden" name="action" value="disconnect" />
		<a href="javascript: document.forms['signoutform'].submit()">Sign out</a>
		</form>
	</div>
	
</div>
