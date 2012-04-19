<?php

function getShowPostUrl(Post $post) {
	$url = "index.php?module=news&amp;action=show&amp;post=".$post->title_url;
	return $url;
}

function getEditPostUrl(Post $post) {
	$url = "index.php?module=news&amp;action=edit&amp;post=".$post->title_url;
	return $url;
}

function getAddPostUrl() {
	$url = "index.php?module=news&amp;action=add";
	return $url;
}

function getIndexPostUrl() {
	$url = "index.php?module=news";
	return $url;
}