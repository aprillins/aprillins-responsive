<?php get_header();?>
<div class="content-wrapper row cf"> <!-- content-wrapper -->
	<div class="content column two-thirds"> <!-- content -->
		<article class="article cf">
			<h1 class="article-title">Aduhhh aduhh.. si abang nyari eneng sampe ke sini.. Di sini cuma ada eneng bang, ga ada yang lain.</h1>
			<div style="margin-top: 2em">
				<p><img class="alignleft image404" src="<?php bloginfo('stylesheet_directory');?>/images/404.jpg" alt="not found image" />
				<h3><em>"Kalau abang cuma pengen ketemu eneng, abang di sini aja jangan pergi ke mana-mana. Eneng kesepian bang.."</em></h3> </p>
				<p>Tapi kalo abang pengen cari yang lain coba lewat kotak pencarian di bawah ini, siapa tau ketemu eneng-eneng yang lain.. ;)</p>
				
				<div class="search alignleft">
					<form action="<?php bloginfo('url')?>" id="headersearchform" method="get">
						<input type="text" class="search-input" value="Cari artikel.." id="s" onfocus="if (this.value == 'Cari artikel..') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Cari artikel..';}" name="s">
						<input type="image" alt="search button" id="searchsubmit" src="<?php bloginfo('stylesheet_directory');?>/images/search.png" style="vertical-align:middle">
					 </form>
				</div>
			</div>
		</article>
	</div>
<?php get_footer();?>
