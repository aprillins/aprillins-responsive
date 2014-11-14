<div class="domtab">
        			<ul class="domtabs" id="pop-nav">
                <li class="active"><a href="#month">Artikel Filsafat</a></li>				
                <li class=""><a class="default" href="#alltime">Paling Ditanggapi</a></li>
        			</ul>
        			<div id="pop-in"> 
        			   <div style="display: none;">
        					<h2 id="month" name="month">Artikel Filsafat Terbaru</h2>
        					<ul>
                    <?php query_posts('showposts=10&cat=6');?>
                    <?php if(have_posts()) :?>
                    <?php while(have_posts()): the_post()?>
                    <li><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title()?></a></li>
                    <?php endwhile;?>
                    <?php endif;?>
        					</ul>
                </div>
        				<div style="display:none">
        					<h2 id="alltime" name="alltime">Paling Ditanggapi</h2>
        					<ul>
        					   <?php most_popular_posts(10);?>	
        					</ul>
                </div>
        				
        			</div>
		        </div>