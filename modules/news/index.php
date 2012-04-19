<?php

require_once(PATH_MODEL."Post.php");
require_once(PATH_MODEL."Right.php");
require_once(PATH_MODEL."User.php");
require_once(PATH_LIB."paginate.php");

$page = cleanGlobal($_GET, 'page', true, 1);
$month = cleanGlobal($_GET, 'month');

if(!is_null($month)) {
	
	$liste_posts = Post::getPostsByMonth($month, $page, NB_POST_PER_PAGE);
	
	$nb_pages = Post::getPostsNbPagesByMonth($month);
	
	$pagination = createPagination("index.php?module=news&amp;month=".$month, $nb_pages);
	
} else {

	$liste_posts = Post::getPosts($page, NB_POST_PER_PAGE);
	
	$nb_pages = Post::getPostsNbPages();
	
	$pagination = createPagination("index.php?module=news", $nb_pages);

}

include (PATH_VIEW."view_index.php");

?>