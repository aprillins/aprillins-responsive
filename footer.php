
<?php
if(!is_home()): 
get_sidebar('single');
endif;
?>




      
		</div> <!-- end of content-wrapper -->
			<footer class="row cf"> <!-- footer -->
			<?php wp_footer();?>
					<a title="<?php bloginfo('name');?>" href="<?php bloginfo('url');?>">Aprillins</a> &copy; 2008-2014<br>
					All content are protected. Copying are limited by showing a link in your bibliography
			</footer> <!-- end of footer -->
		</div> <!-- end of container -->
		<script>
		    $(function(){
		        $('.nav-menu').slicknav({
		        	'prependTo': '#slickmenu',
		        	'duration': 200,
		        	'easingOpen' : 'swing'
			    });		        
		    });
		</script>
		<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
  		
  </body>
</html>
