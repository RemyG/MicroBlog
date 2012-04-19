<!doctype html>

<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="en" />

	<title><?php echo SITE_TITLE; ?></title>


<!-- 	<link rel="stylesheet" href="style/global.css" /> -->
	<link rel="stylesheet" href="style/style.css" />
	<link rel="stylesheet" href="style/topmenu.css" />
	<link rel="stylesheet" href="style/projects.css" />
	<link rel="stylesheet" href="style/posts.css" />
	<link rel="stylesheet" href="style/home.css" />
	
	<script src="libs/jquery-1.4.4.min.js"></script>
	<script src="libs/javascript.js"></script>
	
</head>

<body>

	<div id="div_background" style="display: none; z-index: 1000; background-color: #222222; opacity: 0.5; -moz-opacity: 0.5;"></div>

	<?php include "topmenu.php"; ?>
	
	<div class="main">

	<div id="header">
		<div class="title">
			<a href="index.php">
			MicroBlog
			</a>
		</div>
		<div class="git_banner">
			<a href="<?php echo GITHUB_SOURCES; ?>">Fork me on GitHub</a>
		</div>
		<!-- <div class="content">
		<div class="hmenu">
			<ul>
				<li><a href="index.php?module=projects">Projects</a></li>
				<li><a href="index.php?module=news">Blog</a></li>
				<li><a href="">Contact</a></li>
			</ul>
		</div>
		</div>-->
	</div>
	
