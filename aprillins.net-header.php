<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>

<?php if(!is_user_logged_in()):?>
<script>
function utmx_section(){}function utmx(){}
(function(){var k='1910489946',d=document,l=d.location,c=d.cookie;function f(n){
if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.indexOf(';',i);return escape(c.substring(i+n.
length+1,j<0?c.length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;
d.write('<sc'+'ript src="'+
'http'+(l.protocol=='https:'?'s://ssl':'://www')+'.google-analytics.com'
+'/siteopt.js?v=1&utmxkey='+k+'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='
+new Date().valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"></sc'+'ript>')})();
</script>
<?php endif;?>


<?php if(is_search()){ ?>
<meta name="description" content="Hasil pencarian term <?php echo $s;?> di aprillins.com" />
<meta name="keywords" content="<?php echo $s;?>" />
<link rel="canonical" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/search/<?php echo fix_permalink($s);?>" />;  
<?php } ?>

<title><?php ghpseo_output('main_title'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="FX6V4_SNcGrsCIc2lCRwaK-gEThShgQ2SpStcDIW04g">
<meta name="y_key" content="f481cd381a81c8f2">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="http://img0.aprillins.com/global/favicon.ico" />
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/slicknav.css" />
<script src="<?php bloginfo('stylesheet_directory');?>/js/jquery-2.1.1.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory');?>/js/jquery.slicknav.min.js"></script>

<script type="text/javascript" src="http://img4.aprillins.com/optimized-template/optimized-template.js"></script>
<?php if (is_singular()) wp_enqueue_script( 'comment-reply' );?>
<?php wp_head(); ?>

<script type="text/javascript">(function($){if($.browser.mozilla){$.fn.disableTextSelect=function(){return this.each(function(){$(this).css({'MozUserSelect':'none'})})};$.fn.enableTextSelect=function(){return this.each(function(){$(this).css({'MozUserSelect':''})})}}else if($.browser.msie){$.fn.disableTextSelect=function(){return this.each(function(){$(this).bind('selectstart.disableTextSelect',function(){return false})})};$.fn.enableTextSelect=function(){return this.each(function(){$(this).unbind('selectstart.disableTextSelect')})}}else{$.fn.disableTextSelect=function(){return this.each(function(){$(this).bind('mousedown.disableTextSelect',function(){return false})})};$.fn.enableTextSelect=function(){return this.each(function(){$(this).unbind('mousedown.disableTextSelect')})}}})(jQuery);jQuery(function($){$('#s-post').disableTextSelect()});</script>

<!-- SOCIAL MEDIA -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: 'id'}</script>
<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
<!-- END OF SOCIAL MEDIA SCRIPT -->

<!-- GOOGLE ANALYTICS -->
<?php if(!is_user_logged_in()):?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12350726-54']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script><?php endif;?>
<!-- END TRACKING CODE -->

</head>
<body>
<div id="fb-root"></div>
<script type="text/javascript">
<!--
window.fbAsyncInit = function() {
 FB.init({appId: '213864022033562', status: true, cookie: true, xfbml: true});
 	FB.Event.subscribe('edge.create', function(targetUrl) {
		try{
  		_gaq.push(['_trackSocial', 'facebook', 'like', targetUrl]);
		alert('Terima kasih Anda telah me-Like halaman kami. Semoga Anda selalu beruntung :)');
		} catch(err) {
		alert('Terima kasih Anda telah me-Like halaman kami. Semoga Anda selalu beruntung :)');
		}
	});
 	FB.Event.unsubscribe('edge.remove', function(targetUrl) {
		try{
  		_gaq.push(['_trackSocial', 'facebook', 'unlike', targetUrl]);
		} catch(err){}
	});
};
(function() {
 var e = document.createElement('script');
 e.type = 'text/javascript';
 e.src = document.location.protocol + '//connect.facebook.net/id_ID/all.js';
 e.async = true;
 document.getElementById('fb-root').appendChild(e);
 }());
//-->
</script>

<div class="container"> <!-- container -->
	<div class="top-header row cf"> <!-- top header -->
		<div class="search">
			<form action="<?php bloginfo('url')?>" id="headersearchform" method="get">
				<input type="text" class="search-input" value="Cari artikel.." id="s" onfocus="if (this.value == 'Cari artikel..') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Cari artikel..';}" name="s">
				<input type="image" alt="search button" id="searchsubmit" src="<?php bloginfo('stylesheet_directory');?>/images/search.png" style="vertical-align:middle">
			 </form>
		</div>
		<div class="feedburner">
				<a type="application/rss+xml" rel="alternate" href="http://feeds.feedburner.com/harianaprillins">
				<img style="border: 0pt none;vertical-align: middle;width:16px;height:16px" alt="Feedburner" src="<?php bloginfo('stylesheet_directory');?>/images/feed-icon16x16.png"></a>
				<a type="application/rss+xml" rel="alternate" href="http://feeds.feedburner.com/harianaprillins" class="navy">Langganan artikel</a>
				<a href="http://feeds.feedburner.com/harianaprillins"><img width="88" height="26" alt="" style="border: 0pt none ;vertical-align:middle;margin-left:10px" src="http://feeds.feedburner.com/~fc/harianaprillins?bg=0099FF&amp;fg=FFFFFF&amp;anim=1&amp;label=listeners"></a>
		</div>
	</div> <!-- end of top header -->
	<header class="header row cf">
		<div class="logo">
			<a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('stylesheet_directory');?>/images/logo.png"></a>
		</div>
	</header>
	
	<!-- main navigation -->
	<div id="slickmenu" role="navigation"></div>
	<nav id="nav-main" class="top-nav row cf" role="navigation">
	<div id="cssmenu">
		<?php wp_nav_menu(array( 'container' => 'false','menu_class'=>'nav-menu')); ?>
	</div> 
	</nav><!-- end of main navigation -->