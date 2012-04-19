<?php

require_once(PATH_MODEL."Right.php");
require_once(PATH_MODEL."User.php");

if(!User::hasCurrentUserRight(RGT_ADMIN)) {

	include(PATH_LIB."redirect_connection.php");

}

require_once(PATH_MODEL."Post.php");

if($_POST != null) {

	$post_title = cleanGlobal($_POST, 'post_title');
	$post_content = cleanGlobal($_POST, 'post_content');

	if($post_content) {

		$post_title_url = seoUrl($post_title);

		$post = new Post(null, User::getCurrentUser()->getId(), $post_title, $post_title_url, $post_content, null, null);
		$id = Post::createPost($post);
		if(is_array($id)) {
			var_dump($id);
			$erreur = "-2";
			include (PATH_VIEW."view_add.php");
		} else {
			$post_title_url = $post_title_url.$id;
			$post->setId($id);
			$post->setTitleUrl($post_title_url);
			Post::updatePost($post);
			header('Location: index.php?module=news');
		}
	} else {
		$erreur = "-1";
		include (PATH_VIEW."view_add.php");
	}

} else {

	include (PATH_VIEW."view_add.php");

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


