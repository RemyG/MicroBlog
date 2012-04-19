<div class="content">
	
	<?php
	
	if($liste_posts == null || sizeof($liste_posts) == 0) {
		echo "No posts available.";
	}
	
	foreach($liste_posts as $post) {
		
		echo '
			<div class="post">
				<div class="post_date">
					<a href="'.getShowPostUrl($post).'">'.$post->getDtCrea()->format(EN_DT_POST_SHORT).'</a><br/>
				</div>
				';
		if($post->getTitle() != null) {
			echo '<div class="post_title"><a href="'.getShowPostUrl($post).'">'.$post->getTitle().'</a></div>';
		}
		echo '				
				<div class="post_content">
					<div class="post_author">
						by '.$post->getCreaUser()->name.'
					</div>
					<div class="post_content_text">
					'.htmlspecialchars_decode(nl2br($post->getContent())).'
					</div>
				</div>
			</div>
				';
		
	}
	
	?>
	
	<div class="pagination">
	
	<?php
	
	foreach($pagination as $page_nb) {
		
		echo '<span class="pagination_element">';
		if($page != $page_nb['page']) {
			echo '<a href="'.$page_nb['address'].'">'.$page_nb['page'].'</a>';	
		} else {
			echo $page_nb['page'];
		}
		echo '</span>';
		
	}
	
	?>
	
	</div>
	
</div>