<?php

require_once(PATH_MODEL."Comment.php");
require_once(PATH_MODEL."Post.php");
require_once(PATH_MODEL."Right.php");
require_once(PATH_MODEL."User.php");
// require_once(PATH_MODEL."Action.php");
// require_once(PATH_MODEL."TypeAction.php");

if($_GET != null) {
	
	$post_title_url = cleanGlobal($_GET, 'post');
	
	if($_POST != null) {
		
		$post_id = cleanGlobal($_POST, 'post_id');
		$cmt_content = cleanGlobal($_POST, 'cmt_content');		
		$cmt_usr_name = cleanGlobal($_POST, 'name');
		$cmt_usr_mail = cleanGlobal($_POST, 'mail');
		
		if($cmt_content && cleanGlobal($_SESSION, 'usr_id') && $post_id) {
			$comment = new Comment(null, null, cleanGlobal($_SESSION, 'usr_id'), null, null, $post_id, $cmt_content);			
			Comment::createComment($comment);
			
		} else if ($cmt_content && $cmt_usr_name && $cmt_usr_mail && $post_id) {
			$comment = new Comment(null, null, null, $cmt_usr_name, $cmt_usr_mail, $post_id, $cmt_content);			
			Comment::createComment($comment);
			
		}
		
	}
	
	if($post_title_url) {
	
		$post = Post::getPostByTitleUrl($post_title_url);
		
		$list_comments = Comment::getCommentsForPost($post->getId());
		
		include(PATH_VIEW."view_show.php");
	
	}
	
}

