<?php get_header();?>
<div class="content-wrapper row cf"> <!-- content-wrapper -->
	<div class="content column two-thirds"> <!-- content -->
			
			<?php if(have_posts()): ?>
				<h1 class="article-category-title">Daftar artikel dalam kategori &#8216;<?php single_cat_title(); ?>&#8217;</h1>
				<?php if ( category_description() ) : // Show an optional category description ?>
					<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			<?php while (have_posts()) : the_post(); ?> 
			
			<article class="article cf">
			<h2 class="article-category-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<div class="postmeta cf">
			  <time datetime="<?php the_time('c') ?>"><?php the_time('j F Y h:m A T') ?></time> - oleh <?php the_author_posts_link(); ?>
			  </span>
			</div>
			<?php the_excerpt()?>
			
			</article>
			<?php endwhile;?>
			<div class="paginate-links">
				<?php echo paginate_links();?>
			</div>
			<?php else: 
			echo "<h2 class='center'>Sorry, but there aren't any posts with that ID..</h2></div>";endif;?>
	</div> <!-- end of content -->

<?php get_footer();?>