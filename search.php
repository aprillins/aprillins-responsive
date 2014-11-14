<?php get_header(); ?>

<div class="content-wrapper row cf"> <!-- content-wrapper -->
	<div class="content column two-thirds"> <!-- content -->
	
	<?php if (have_posts()) : ?> <!-- have_posts() -->

		<h1 class="article-category-title">Hasil pencarian dengan kata kunci "<?php echo $s;?>"</h1>
		<?php if(!is_user_logged_in()){ ?>
			<?php if (function_exists('showCountryContentInPage')) { ?>
			<?php if(showCountryContentInPage(array("id", "my","sg"), 1)) { ?> 
			<!--ads-->
			<?php }else{ ?>
			<!-- below search title -->
		<?php }}} ?>
	       	
		<?php while (have_posts()) : the_post(); ?>
			<article class="article cf">
				<h2 class="article-search-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
				<div class="postmeta cf">
				  <time datetime="<?php the_time('c') ?>"><?php the_time('j F Y h:m A T') ?></time> - oleh <?php the_author_posts_link(); ?>
				  </span>
				</div>
				<?php the_excerpt()?>
			
			</article>
		<?php endwhile; ?>
		<div class="paginate-links">
			<?php echo paginate_links();?>
		</div>
	<?php else: ?>
		<article class="article cf">
		<h1 class="article-title">Hayo lo gak ketemu apa-apa!</h1>
		<p>Jangan khawatir dan galau gitu ah! Cari lagi dengan kata kunci yang lain melalui box di bawah ini.</p>
		<div class="search" style="width: 100%;">
			<form action="<?php bloginfo('url')?>" id="headersearchform" method="get">
				<input type="text" class="search-input" value="Cari artikel.." id="s" onfocus="if (this.value == 'Cari artikel..') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Cari artikel..';}" name="s">
				<input type="image" alt="search button" id="searchsubmit" src="<?php bloginfo('stylesheet_directory');?>/images/search.png" style="vertical-align:middle">
			 </form>
		</div>
		</article>
	<?php endif; ?> <!-- end of have_posts() -->
</div> <!-- end of content -->

<?php get_footer(); ?>