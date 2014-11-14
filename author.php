<?php get_header();?>
<?php if(function_exists('CopyProtect_footer')) CopyProtect_footer();?>
<div class="content-wrapper row cf"> <!-- content-wrapper -->
	<div class="content column two-thirds"> <!-- content -->
	<article class="article cf">
		<?php
		if(isset($_GET['author_name'])) :
		$curauth = get_userdatabylogin($author_name);
		else :
		$curauth = get_userdata(intval($author));
		endif;
		?>
		<h1 class="author-name"><?php echo $curauth->display_name; ?></h2>
		<p><strong>Website:</strong> <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
		<p><strong>Profil:</strong> <?php echo $curauth->user_description; ?></p>
		<h3>Artikel yang dipublikasikan oleh <?php echo $curauth->display_name; ?>:</h3>
		<ul>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<li>
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
		<?php the_title(); ?></a>
		</li>
		<?php endwhile; else: ?>
		<p><?php _e('No posts by this author.'); ?></p>
		<?php endif; ?>
		
		</ul>
	</article>
</div> <!-- end of content -->

<?php get_footer();?>