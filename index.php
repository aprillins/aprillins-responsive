<?php get_header();?>
<div class="content-wrapper row cf"> <!-- content-wrapper -->
		<div class="row cf">
			<div class="column two-thirds welcome">
				<img src="<?php bloginfo('stylesheet_directory')?>/images/welcome.png" style="margin-bottom:17px" />
			
			</div>
			<div class="column third">
			<?php query_posts('showposts=2&cat=6')?>
        <?php if(have_posts()) :?>
				<?php while(have_posts()): the_post()?>
		            <div class="front-post">
		            <h2 class="article-title"><a href="<?php the_permalink();?>" title="Artikel Filsafat - <?php the_title();?>" rel="bookmark"><?php the_title();?></a></h2>
		            <div class="the-date"><?php //the_date();?></div>
		            <?php if($values=get_post_custom_values('front_image')): ?>
		              <img alt="photo at aprillins.com" title="front post" src="<?php echo $values[0];?>" class="left" style="padding:5px;margin:6px 8px 0 0;width:35%" />
		            <?php endif; ?>
		            
		            </div>
				<?php endwhile;?>
          <?php endif;?>
			</div>
		</div>
		<div class="column full cf">
		<img src="<?php bloginfo('stylesheet_directory');?>/images/intermezzo.png" />
		</div>
		<div class="row cf">
			<div class="column half">
				<?php query_posts('showposts=2&offset=1&cat=6')?>
		          <?php if(have_posts()) :?>
		          <?php while(have_posts()): the_post()?>
		            <div class="front-post">
			            <h2><a href="<?php the_permalink();?>" title="Artikel Filsafat - <?php the_title();?>" rel="bookmark"><?php the_title();?></a></h2>
			            <?php if($values=get_post_custom_values('front_image')): ?>
			              <img alt="photo at aprillins.com" title="second post" src="<?php echo $values[0];?>" class="left" style="margin:6px 8px 0 0;width:100px" />
			            <?php endif; ?>
			            <div class="excerpt"><?php the_excerpt();?></div>
		            </div>
		          <?php endwhile;?>
		          
		          <?php endif;?>
			</div>
			<div class="column half">
				<?php wp_reset_query();
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts('showposts=3&cat=-6&paged='.$paged);if(have_posts()):while(have_posts()):the_post();?>
				<div class="front-post intermezzo">
				<h2><a href="<?php the_permalink();?>" title="Artikel Filsafat - <?php the_title();?>" rel="bookmark"><?php the_title();?></a></h2>
				<div class="excerpt"><?php the_excerpt();?></div>
				</div>
				<?php endwhile;?>
			</div>
			
		</div>   
          
<div class="intermezzo column full cf" style="border-top:1px dashed #ddd;margin-top:15px;border-bottom:1px dashed #ddd;padding:10px;margin-left:-10px;background:#eee">
<p style="margin-top:10px;font-weight:bold">Intermezzo adalah bagian dari aprillins.com berisi artikel yang sedikit mengandung filsafat. Pada bagian intermezzo ini terdapat berbagai artikel dengan kategori bebas mulai dari opini sampai pengetahuan umum yang bisa dicerna oleh siapa pun</p>
</div>

<?php if(function_exists(wp_pagenavi))  wp_pagenavi();?>

<?php endif;?>
			    <?php $apr_ad_check = get_option('apr_ad_check');
			    	 if($apr_ad_check): ?>
						<div class="ads125">
				         <a href="<?php $apr_ad1_link = get_option('apr_ad1_link'); echo stripslashes($apr_ad1_link); ?>" target="_blank"><img src="<?php $apr_ad1 = get_option('apr_ad1'); echo stripslashes($apr_ad1); ?>" alt="" /></a>
				         <a href="<?php $apr_ad2_link = get_option('apr_ad2_link'); echo stripslashes($apr_ad2_link); ?>" target="_blank"><img src="<?php $apr_ad2 = get_option('apr_ad2'); echo stripslashes($apr_ad2); ?>" alt="" /></a>
				         <a href="<?php $apr_ad3_link = get_option('apr_ad3_link'); echo stripslashes($apr_ad3_link); ?>" target="_blank"><img src="<?php $apr_ad3 = get_option('apr_ad3'); echo stripslashes($apr_ad3); ?>" alt="" /></a>
				         <a href="<?php $apr_ad4_link = get_option('apr_ad4_link'); echo stripslashes($apr_ad4_link); ?>" target="_blank"><img src="<?php $apr_ad4 = get_option('apr_ad4'); echo stripslashes($apr_ad4); ?>" alt="" /></a>
						</div>
					<?php endif; ?>
					
<div id="sidebar-cagories" class="sidebar column third">
	<div class="sidebar-item">
		<h2 class="widget-title">Kategori Artikel</h2>
		<ul class="sidebarcat">
		<?php //wp_list_categories(array('title_li'=>'','hierarchical'=>0,'child_of'=>6));
						wp_list_categories(array('title_li'=>'','hierarchical'=>0));?>
		</ul>
	</div>
</div>
            <?php //include(TEMPLATEPATH.'/boxed.php');?>          
          <?php get_sidebar('home');?>          

<!-- footer start -->

<?php get_footer();?>
