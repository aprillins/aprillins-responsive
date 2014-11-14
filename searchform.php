
<form method="get" id="searchform" class="left" action="<?php bloginfo('url'); ?>/">
<a onclick="history.back(0)" class="normal-cur"><img class="bb" src="<?php bloginfo('stylesheet_directory')?>/images/bba.png" /></a>
            <a href=""><img class="bf" src="<?php bloginfo('stylesheet_directory')?>/images/bfa.png" /></a>
            <a href="<?php bloginfo('url')?>"><img class="bf" src="<?php bloginfo('stylesheet_directory')?>/images/house.png" /></a>
            <input type="text" style="width:230px;padding:2px 4px;font-size:11px;font-family:tahoma;vertical-align:middle" value="<?php the_search_query(); ?>" name="s" id="s" onfocus="this.value=''" title="Enter the terms you wish to search for."/> 
            <input type="image" class="bf" src="<?php bloginfo('stylesheet_directory')?>/images/se.png" id="searchsubmit" /><em>Cari di aprillins.com</em>
</form>
