<?php get_header();?>
<div class="content-wrapper row cf"> <!-- content-wrapper -->
	<div class="content column two-thirds"> <!-- content -->

	<?php if(have_posts()):?>

<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h1 class="article-category-title">Daftar artikel dalam kategori &#8216;<?php single_cat_title(); ?>&#8217;</h1>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1 class="article-category-title">Daftar artikel dalam tag &#8216;<?php single_tag_title(); ?>&#8217;</h1>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1 class="article-category-title">Daftar artikel pada tanggal <?php the_time('F jS, Y'); ?></h1>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1 class="article-category-title">Daftar artikel pada bulan <?php the_time('F, Y'); ?></h1>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1 class="article-category-title">Daftar artikel pada tahun <?php the_time('Y'); ?></h1>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1 class="article-category-title">Arsip penulis</h1>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="article-category-title">Arsip, artikel, dan direktori filsafat</h1>
 	  <?php } ?>
 	  
		<?php while (have_posts()) : the_post(); ?>
			<article class="article cf">
				<h2 class="article-category-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
				<div class="postmeta cf">
				  <time datetime="<?php the_time('c') ?>"><?php the_time('j F Y h:m A T') ?></time> - oleh <?php the_author_posts_link(); ?>
				  </span>
				</div>
				<?php the_excerpt()?>
				
			</article>

		<?php endwhile; ?>
		
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Maaf artikel filsafat dalam direktori %s belum tersedia.<br />Silakan mencari di lewat search box :)</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Maaf artikel filsafat dalam tanggal tersebut tidak tersedia.<br />YSilakan mencari di lewat search box :)</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Maaf artikel filsafat dalam direktori %s belum tersedia.<br />Silakan mencari di lewat search box :)</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>Maaf artikel filsafat dalam direktori %s belum tersedia.<br />Silakan mencari di lewat search box :)</h2>");
		}

	endif;
?>

         
          
          
            
          </div> <!-- end of content -->


<?php get_footer(); ?>
