<div class="content">

<div class="content_title">

	New post

</div>

<div class="content_form">

<form method="post" action="" id="form_post">
	
	<?php if(isset($result) && $result == -2) { ?>
	<div class="error">Error while creating post.</div>
	<?php } else if(isset($result) && $result == -1) { ?>
	<div class="error">Tous les champs obligatoires doivent être remplis.</div>
	<?php } else if(isset($result) && $result == 0) {?>
	<div class="success">Votre post a bien été sauvegardé.</div>
	<?php } ?>

	<label class="creer_post">Title (optional)</label><br/>
	
	<input type="text" class="creer_post" id="post_title" name="post_title" /><br/>
	
	<label class="creer_post">Content *</label><br/>
	
	<textarea rows="10" cols="30" class="creer_post" id="post_content" name="post_content"></textarea><br/>
	
	<script type="text/javascript">
		//make_wyzz('post_content');
	</script>
	
	<input type="submit" value="Create post" />

</form>

</div>

</div>