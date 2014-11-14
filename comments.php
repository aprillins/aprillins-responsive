<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) {
		echo '<p class="nocomments">This post is password protected. Enter the password to view comments.</p>';
		return;
	}

	/* Function for seperating comments from track- and pingbacks. */
	function k2_comment_type_detection($commenttxt = 'Comment', $trackbacktxt = 'Trackback', $pingbacktxt = 'Pingback') {
		global $comment;
		if (preg_match('|trackback|', $comment->comment_type))
			return $trackbacktxt;
		elseif (preg_match('|pingback|', $comment->comment_type))
			return $pingbacktxt;
		else
			return $commenttxt;
	}

	$templatedir = get_bloginfo('template_directory');
	$comment_number = 1;
?>


	
<?php
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<!-- <li class="comment <?php if($comment->comment_author_email == get_the_author_email()) {echo 'admincomment';} else {echo 'regularcomment';} ?>" id="comment-<?php comment_ID() ?>">-->
		
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		
		<div class="author cf">
			<div class="pic"><?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 32); } ?></div>
			<div class="author-info">	
				<div class="name">
					<?php if (get_comment_author_url()) : ?>
						<a id="commentauthor-<?php comment_ID() ?>" class="url" href="<?php comment_author_url() ?>" rel="external nofollow">
					<?php else : ?>
						<span id="commentauthor-<?php comment_ID() ?>">
					<?php endif; ?>
	
					<?php comment_author(); ?>
	
					<?php if(get_comment_author_url()) : ?></a><?php else : ?>
						</span>
					<?php endif; ?>
					
				</div>
				<div class="date">
						<?php printf( __('%1$s at %2$s', 'inove'), get_comment_time(__('F jS, Y', 'inove')), get_comment_time(__('H:i', 'inove')) ); ?>
							 | <a href="#comment-<?php comment_ID() ?>"><?php printf('#%1$s', ++$commentcount); ?></a>
				</div>
			</div>
		</div>
		<div class="info">
			
			<div class="comment-content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><small><?php _e('Your comment is awaiting moderation.', 'inove'); ?></small></p>
				<?php endif; ?>

				<div id="commentbody-<?php comment_ID() ?>">
					<?php comment_text(); ?>
				</div>
			</div>
			<div class="act">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<!-- <a class="reply-button" href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('Reply', 'inove'); ?></a>-->  
				<a class="reply-button" href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'commentbody-<?php comment_ID() ?>', 'comment');"><?php _e('Quote', 'inove'); ?></a>
				<?php
					if (function_exists("qc_comment_edit_link")) {
						qc_comment_edit_link('', ' | ', '', __('Edit', 'inove'));
					}
					edit_comment_link(__('Advanced edit', 'inove'), ' | ', '');
				?>
			</div>
			<div class="cf"></div>
		</div>
		<div class="cf"></div>

<?php } //end of function custom_comments() ?>


<div class="comment-wrap">
	<?php if ( comments_open() ) : ?><h3 class="widget-title from-left"><?php comments_number('Belum ada tanggapan', 'Satu tanggapan', '% tanggapan' );?> untuk &#8220;<?php the_title(); ?>&#8221;</h3><?php endif;?>
</div>
<div id="c">
<?php if ( have_comments() ) : ?>

	<ol class="commentlist">
			<?php
				if ($comments && count($comments) - count($trackbacks) > 0) {
					// for WordPress 2.7 or higher
					if (function_exists('wp_list_comments')) {
						wp_list_comments('type=comment&callback=custom_comments');
					// for WordPress 2.6.3 or lower
					} else {
						foreach ($comments as $comment) {
							if($comment->comment_type != 'ping balik' && $comment->comment_type != 'lacak balik') {
								custom_comments($comment, null, null);
							}
						}
					}
				} else {
			?>
			<li class="messagebox">
				<?php _e('Belum ada komentar'); ?>
			</li>
			<?php } ?>
		</ol>
	


	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
	<?php endif; ?>

<?php endif; ?>
<?php
	if (get_option('page_comments')) {
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) {
?>
		<div id="commentnavi" class="fixed">
			<span class="pages"><?php _e('Halaman komentar'); ?></span>
			<div id="commentpager">
				<?php echo $comment_pages; ?>
				
			</div>
			<div class="fixed"></div>
		</div>
<?php
		}
	}
?>

	
<div id="respond">

<?php if (comments_open()) : ?>
	
	
	<?php if (get_option('comment_registration') && !is_user_logged_in()): ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
	
	<div class="comment-form-box cf">	<!--  comment form -->
	
	
	<h2 class="widget-title from-left">Silakan Beri Komentar</h2>
		<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link('Batalkan komentar'); ?>
		</div>
		<form class="dark-matter" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
		<?php if ( is_user_logged_in() ) : ?>
		
			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
			
				<label>
					<div>Komentar :</div>
					<textarea name="comment" id="comment" tabindex="4" placeholder="Your Message to Us"></textarea>
					<br><small>Allowed tags: <?php echo allowed_tags(); ?></small>
				</label>
				<?php do_action('comment_form', $post->ID); ?>
				<input type="submit" id="submit" class="button" value="Kirim" tabindex="5" />
					<?php comment_id_fields(); ?>
				
			
		
		<?php else : ?>
	
				<label>
					<div>Nama <?php if ($req) echo "(wajib diisi)"; ?>:</div>
					<input id="name" type="text" name="author" placeholder="Your Full Name" tabindex="1"/>
				</label>
			   
				<label>
					<div>Email <?php if ($req) echo "(wajib diisi)"; ?>:</div>
					<input id="email" type="email" name="email" placeholder="Valid Email Address" tabindex="2"/>
				</label>
			   <label>			
			   		<div>Website:</div>
			   		<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="3" />
				</label>
				<label>
					<div>Komentar :</div>
					<textarea name="comment" id="comment" tabindex="4" placeholder="Your Message to Us"></textarea>
					<small>Allowed tags: <?php echo allowed_tags(); ?></small>
				</label>
				
					<?php do_action('comment_form', $post->ID); ?>	    
					<input type="submit" id="submit" class="button" value="Kirim" tabindex="5" />
					<?php comment_id_fields(); ?>		
			
			
			
			
		<?php endif; ?>
		</form>
		
		</div> <!-- end of comment form -->
		<?php endif; // If registration required and not logged in ?>
	<?php endif; // if you delete this the sky will fall on your head ?>
</div>
</div>

