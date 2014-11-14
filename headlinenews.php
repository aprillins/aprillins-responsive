<?php
$feedurl='http://blogsearch.google.com/blogsearch_feeds?hl=en&q=filsafat&lr=&ie=utf-8&num=1&output=rss';
$feed2=new SimplePie();
$feed2->set_feed_url($feedurl);
$feed2->init();
$feed2->handle_content_type();
foreach($feed2->get_items() as $item): echo '<a href="'.get_settings('home').'/search/'.str_replace(' ','+',strip_tags(htmlspecialchars(str_replace('<b>','',str_replace('</b>','',$item->get_title()))))).'">'.str_replace('...','',$item->get_title()).'</a>';
endforeach;
?>
