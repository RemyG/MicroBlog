<div class="content">

<div class="content_title">

	Edit post

</div>

<div class="content_form">

<form method="post" action="" id="form_post">

	<?php if(isset($result) && $result == -1) { ?>
	<div class="error">Tous les champs obligatoires doivent être remplis.</div>
	<?php } else if(isset($result) && $result == 0) {?>
	<div class="success">Votre post a bien été sauvegardé.</div>
	<?php } ?>

	<input type="hidden" name="post_id" id="post_id" value="<?php echo $post->getId(); ?>" />

	<label class="creer_post">Title *</label><br/>
	
	<input type="text" class="creer_post" id="title" name="title" value="<?php echo $post->getTitle(); ?>" /><br/>
	
	<label class="creer_post">Content *</label><br/>
	
	<textarea rows="10" cols="30" class="creer_post" id="content" name="content"><?php echo $post->getContent(); ?></textarea><br/>
	
	<script type="text/javascript">
		//make_wyzz('content');
	</script>
	
	<input type="submit" value="Update" />

</form>

<form method="post" action="" name="form_delete" id="form_delete" >

	<input type="hidden" name="post_id" id="post_id" value="<?php echo $post->getId(); ?>" />

	<input type="hidden" name="post_delete" id="post_delete" value="1" />

	<input type="button" value="Delete" onclick="confirmDelete();" />

</form>

</div>

</div>

<script type="text/javascript">
<!--
function confirmDelete() {

	var confirmDel = false;
	
	confirmDel = confirm('Are you sure to delete this post ?');
	
	if(confirmDel == true) {
	
		document.form_delete.submit();
	
	} 

}
//-->
</script>