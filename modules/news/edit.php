<?php

// require_once(PATH_MODEL."Action.php");
require_once(PATH_MODEL."Right.php");
// require_once(PATH_MODEL."TypeAction.php");
require_once(PATH_MODEL."User.php");

if(!User::hasCurrentUserRight(RGT_ADMIN)) {
	
	include(PATH_LIB."redirect_connection.php");
	
}

require_once(PATH_MODEL."Post.php");


$post_id = cleanGLobal($_GET, 'post_id');
$post_title_url = cleanGLobal($_GET, 'post');

if($post_title_url) {
	
	$post = Post::getPostByTitleUrl($post_title_url);
	
	if($_POST != null) {
		
		var_dump($_POST);
		
		$post_title = cleanGLobal($_POST, 'title');
		$post_title_url = seoUrl($post_title).$post->getId();
		$post_content = cleanGLobal($_POST, 'content');
		
		$post_delete = cleanGLobal($_POST, 'post_delete');
		
		if($post_delete && $post_delete === "1") {
				
			Post::deletePost($post->getId());
			header('Location: index.php?module=news');
			
		} else if($post_title && $post_content) {
			
			$post = new Post($post->getId(), null, $post_title, $post_title_url, $post_content, null, null);
			
			Post::updatePost($post);
			
			header('Location: index.php?module=news&action=show&post='.$post->getTitleUrl());
			
		} else {
			
			$erreur = "1";
			include (PATH_VIEW."view_edit.php");
			
		}
		
	} else {

		include(PATH_VIEW."view_edit.php");
	
	}

}

function seoUrl($string) {
	
	if($string != null && $string != "") {
		//Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
		$string = strtolower($string);
		
		$normalizeChars = array(
	    'š'=>'s', 'ž'=>'z', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
	    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
	    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
	    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f');	
		$string = strtr($string, $normalizeChars);	
		
		//Strip any unwanted characters
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string."-";
		
	} else {
		return "note.";
		
	}
}