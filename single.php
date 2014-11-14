<?php get_header();?>
<div class="content-wrapper row cf"> <!-- content-wrapper -->
	<div class="content column two-thirds"> <!-- content -->
		<article class="article cf">
			<?php if(have_posts()): while (have_posts()) : the_post();?> 
			

			<h1 class="article-title"><?php the_title();?></h1>
			
			<div class="postmeta cf">
			  <time datetime="<?php the_time('c') ?>"><?php the_time('j F Y h:m A T') ?></time> - oleh <?php the_author_posts_link(); ?>
			  </span>
			  <span class="right comment-count" style="float:right"><a href="#c"><?php comments_number('Berikan tanggapan Anda', 'Ada 1 tanggapan', 'Ada % tanggapan' );?></a></span>
			</div>
			
			<?php the_content()?>

			
			<?php wp_link_pages('before=<div style="margin:0 0 20px;float:left;text-align:center">&after=</div>&nextpagelink=Halaman selanjutnya&previouspagelink=Halaman sebelumnya&next_or_number=next&link_before=<span class="halnext">&link_after=</span>&pagelink=halaman %');?>
			<?php the_tags();?>
		</article>
		<div class="social-box">
			<script type="text/javascript">FB.Event.subscribe('edge.create',function(targetUrl){_gaq.push(['_trackSocial','facebook','like',targetUrl]);alert('Terima kasih Anda telah me-Like halaman kami. Semoga Anda selalu beruntung :)');});FB.Event.subscribe('edge.remove',function(targetUrl){_gaq.push(['_trackSocial','facebook','unlike',targetUrl])});</script>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<script type="text/javascript">twttr.events.bind('tweet', function(event) {if (event) {var targetUrl;if (event.target && event.target.nodeName == 'IFRAME') {targetUrl = extractParamFromUri(event.target.src, 'url');}	_gaq.push(['_trackSocial', 'twitter', 'tweet', targetUrl]);}});</script>
			<ul>
				<li><fb:like href="<?php echo $permalink;?>" send="false" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></fb:like></li>
				<li><a href="https://twitter.com/share" data-url="<?php the_permalink();?>" class="twitter-share-button" data-count="horizontal" data-via="aprillins">Tweet</a></li>
				<li><g:plusone size="medium"></g:plusone></li>
			</ul>	
		</div>
			<?php endwhile;?>
		<div class="author-box cf">
			<h3 class="author-title">AUTHOR</h3><div class="photo"><?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar(get_the_author_meta('user_email'), 48); } ?></div><p class="bio"><strong><?php the_author_posts_link(); ?>
		<?php //the_author_meta('display_name')?></strong> # <?php the_author_meta('description');?></p>
		</div>
		<div class="post-nav cf">
				<div class="next"><?php next_post_link('%link','Artikel Selanjutnya '.'<img class="ver-mid" src="http://img0.aprillins.com/optimized-template/control_right.png" />') ?></div>
				<div class="previous"><?php previous_post_link('%link','<img class="ver-mid" src="http://img1.aprillins.com/optimized-template/control_left.png" />'.' Artikel Sebelumnya') ?></div>
			</div>
		<?php if( function_exists( 'seo_alrp' ) ):?>
		<h3 class="widget-title from-left">Artikel Terkait</h3>
		<div class="related-posts"><?php seo_alrp(); ?></div>
		<?php endif;?>

<?php /* if(function_exists(wp_related_posts)): wp_related_posts();endif; */ ?>

<?php comments_template();?>
<?php else: echo "<h2 class='center'>Sorry, but there aren't any posts with that ID..</h2></div>";endif;?>
</div> <!-- end of content -->


<?php get_footer();?>