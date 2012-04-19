<div class="content">

	<div class="post">
		
		<div class="post_date">
			<a href="">
			<?php echo $post->getDtCrea()->format(EN_DT_POST); ?>
			</a>
		</div>
		<?php 
		if ($post->getTitle() != null) {
		
			echo '<div class="post_title"><a href="">'.$post->getTitle().'</a></div>';
			
		}
		
		echo '
		<div class="post_content">
		<div class="post_author">
		by '.$post->getCreaUser()->name.'
		</div>
		<div class="post_content_text">
		'.htmlspecialchars_decode(nl2br($post->getContent())).'
		</div>
		';
		
		if($post->getDtModif() != null && User::hasCurrentUserRight(RGT_ADMIN)) {
				
			echo '<div class="post_date_update">'.'Last update : '.$post->getDtModif()->format(EN_DT_POST).'</div>';
				
		}
		
		echo '</div>';
		?>
		
		<div class="post_comments">
		
			<?php
			if($list_comments != null && sizeof($list_comments) != 0) {
				
				echo '<div class="post_comments_title">Comments</div>';
				
				foreach($list_comments as $comment) {
					
					echo '
					<div class="post_comment">
					<div class="post_comment_content">
					'.$comment->getContent().'
					</div>
					<div class="post_comment_infos">
					'.$comment->getUser()->getName().', '.$comment->getDt()->format(EN_DT_POST).'
					</div>
					</div>';
					
				}
				
			}
			?>
		
			
			<span class="post_action"><a href="javascript:showHideCommentForm()">Post a comment</a></span>
		
			<form action="" method="post" id="form_comment" style="display:none;">
			
				<input type="hidden" id="post_id" name="post_id" value="<?php echo $post->getId(); ?>" />
			
				<?php 
				if(!cleanGlobal($_SESSION, 'usr_id')) {
				?>
				
				<label for="login">Name : </label><br/>
				<input type="text" name="name"/><br/>
			
				<label for="mail">Mail : </label><br/>
				<input type="text" name="mail"/><br/>
				
				<?php
				}
				?>
				
				<label for="cmt_content">Comment : </label><br/>
				<textarea rows="10" cols="50" name="cmt_content" id="cmt_content"></textarea><br/>
				<input type="submit" value="Post comment" />
			</form>
			
		</div>
		
		<?php
		if(User::hasCurrentUserRight(RGT_ADMIN)) {
		?>
		<div class="post_actions" style="text-align: right;">
			<span class="post_action" style="padding-right: 0;"><a href="<?php echo getEditPostUrl($post); ?>" >Edit</a></span>
		</div>
		<?php
		}
		?>
		
	</div>

</div>

<script type="text/javascript">

	function showHideCommentForm() {
	
		if(document.getElementById('form_comment').style.display == 'none') {
			$('#form_comment').slideDown();
		} else {
			$('#form_comment').slideUp();
		}
	
	}

</script>

