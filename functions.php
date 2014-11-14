<?php
remove_action('wp_head', 'wp_generator');
add_editor_style('custom-editor-style.css');

function mytheme_mce_settings( $initArray ){
	$initArray['body_class'] = 'article';
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'mytheme_mce_settings' );
register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'aprillins' ),
	) );

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	   'name'=>'front right at home',
		'before_widget' => '<div class="sidebar-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	   'name'=>'single sidebar',
		'before_widget' => '<div class="sidebar-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

function fix_permalink($s){
	   $sdelimiter = '-';
    $s = strtolower($s);
    $s = preg_replace('/&.+?;/', '', $s); 
    $s = preg_replace('/\s+/', $sdelimiter, $s);
    $s = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', $sdelimiter, $s);
    $s = preg_replace('|-+|', $sdelimiter, $s); 
    $s = preg_replace('/&#?[a-z0-9]+;/i','',$s); 
    $s = preg_replace('/[^%A-Za-z0-9 _-]/', $sdelimiter, $s); 
    $s = trim($s, $sdelimiter); 
    return $s;
  }

function new_excerpt_more(){
  return '...';
}

add_filter('excerpt_more','new_excerpt_more');

function new_excerpt_length(){
  return 120;
}

function call_excerpt(){
add_filter('excerpt_length','new_excerpt_length');
}
function return_excerpt_length(){
  return 60;
}

function return_excerpt(){
add_filter('excerpt_length','return_excerpt_length');
}

function most_popular_posts($no_posts = 5, $before = '<li>', $after = '</li>', $show_pass_post = false, $duration='') {
  global $wpdb;
  $request = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
  $request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_type = 'post'";
  if(!$show_pass_post) $request .= " AND post_password =''";
  if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date "; }
  $request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
  $posts = $wpdb->get_results($request);
  $output = '';
  if ($posts) {
    foreach ($posts as $post) {
    $post_title = stripslashes($post->post_title);
    $comment_count = $post->comment_count;
    $permalink = get_permalink($post->ID);
    $output .= $before . '<a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . '</a> (' . $comment_count.')' . $after;
  }
  } else {
    $output .= $before . "None found" . $after;
  }
  echo $output;
}
function src_simple_recent_comments($src_count=7, $src_length=60, $pre_HTML='', $post_HTML='') { 
global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,
SUBSTRING(comment_content,1,$src_length) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND post_password = ''
ORDER BY comment_date_gmt DESC
LIMIT $src_count";

$comments = $wpdb->get_results($sql);
$output = $pre_HTML;

foreach ($comments as $comment) {
$output .= "\n\t<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"on " . $comment->post_title . "\"><strong>" . $comment->comment_author . "</strong></a> &raquo " . strip_tags($comment->com_excerpt) . "..</li>";
}

$output .= $post_HTML;
echo $output;
}

?>
<?php
$themename = "aot";
$shortname = "apr";
$options = array (
	array(	"name" => "Sidebar 125 x 125 Ads",
			"type" => "heading"),
    array(	"name" => "Show sidebar ads?",
			"desc" => "Check this box if you want to show sidebar ads.<br /><br />",
			"id" => $shortname."_ad_check",
			"std" => "false",
            "type" => "checkbox"),
	array(	"name" => "Ad 1 Image",
			"id" => $shortname."_ad1",
			"std" => "",
            "desc" => "Insert the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 1 Link",
			"id" => $shortname."_ad1_link",
			"std" => "",
            "desc" => "Insert link for the banner.<br /><br />",
			"type" => "text"),
	array(	"name" => "Ad 2 Image",
			"id" => $shortname."_ad2",
			"std" => "",
            "desc" => "Insert the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 2 Link",
			"id" => $shortname."_ad2_link",
			"std" => "",
            "desc" => "Insert link for the banner.<br /><br />",
			"type" => "text"),
	array(	"name" => "Ad 3 Image",
			"id" => $shortname."_ad3",
			"std" => "",
            "desc" => "Insert the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 3 Link",
			"id" => $shortname."_ad3_link",
			"std" => "",
            "desc" => "Insert link for the banner.<br /><br />",
			"type" => "text"),
	array(	"name" => "Ad 4 Image",
			"id" => $shortname."_ad4",
			"std" => "",
            "desc" => "Insert the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 4 Link",
			"id" => $shortname."_ad4_link",
			"std" => "",
            "desc" => "Insert link for the banner.<br /><br />",
			"type" => "text"),
	array(	"name" => "Email subscription settings",
			"type" => "heading"),
	array(  "name" => "Feedburner Title",
            "id" => $shortname."_feed_name",
            "std" => "",
			"desc" => "Enter your feedburner feed title (needed for subscription form).<br /><br />",
            "type" => "text"),
	array(	"name" => "Social buttons settings",
			"type" => "heading"),
	array(  "name" => "Feedburner URL",
            "id" => $shortname."_feed_url",
            "std" => "?feed=rss2",
			"desc" => "Enter your feedburner feed url or leave it for default feed address.<br /><br />",
            "type" => "text"),
	array(  "name" => "Your twitter profile link",
            "id" => $shortname."_twitter_link",
            "std" => "",
			"desc" => "Enter your Twitter profile link.<br /><br />",
            "type" => "text"),
	array(  "name" => "Your Facebook link",
            "id" => $shortname."_facebook_link",
            "std" => "",
			"desc" => "Enter your Facebook profile or fan page link.<br /><br />",
            "type" => "text"),
	array(	"name" => "About Me Box",
			"type" => "heading"),
	array(  "name" => "About Me text",
            "id" => $shortname."_aboutme_text",
            "std" => "",
			"desc" => "Write something about yourself.<br /><br />",
            "type" => "textarea"),
	array(  "name" => "About Page Link",
            "id" => $shortname."_aboutme_link",
            "std" => "",
			"desc" => "Enter your About page link.<br /><br />",
            "type" => "text"),
		array(  "name" => "About Me Photo",
            "id" => $shortname."_aboutme_image",
            "std" => "",
			"desc" => "Enter image link for About Me photo. Dimensions must be 70px by 70px.<br /><br />",
            "type" => "text"),
);

// ADMIN PANEL

function aprillins_add_admin() {

	 global $themename, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {	
        if ( 'save' == $_REQUEST['action'] ) {
	
                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;
							update_option($up_opt, $_REQUEST[$up_opt] );
						}
					}
				}

                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;						
							if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); } 
						}
					}
				}
						
				header("Location: admin.php?page=functions.php&saved=true");								
			
			die;

		} else if ( 'reset' == $_REQUEST['action'] ) {
			delete_option('sandbox_logo');
			
			header("Location: admin.php?page=functions.php&reset=true");
			die;
		}

	}

add_menu_page($themename." Options", $themename." Options", 'edit_themes', basename(__FILE__), 'aprillins');

}

function aprillins (){

		global $options, $themename, $manualurl;
		
		?>


<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>
<form method="post">
<table class="optiontable">
<?php foreach ($options as $value) {
if ($value['type'] == "text") {  ?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?>:</th>
	<td>
		<input style="width:500px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
        <br /><?php echo $value['desc']; ?>
    </td>
</tr>
<?php } elseif ($value['type'] == "textarea") {  ?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?>:</th>
	<td>
				<textarea style="width:500px;height:100px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" ><?php
				if( get_settings($value['id']) != "") {
						echo stripslashes(get_settings($value['id']));
					}else{
						echo $value['std'];
				}?></textarea>
        <br /><?php echo $value['desc']; ?>
	</td>
</tr>
<?php } elseif ($value['type'] == "checkbox") {  ?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?></th>
	<td>
	    <?php if(get_settings($value['id'])){
		    $checked = "checked=\"checked\"";
			    }else{
			$checked = "";
				}
		?>
		    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
        <?php echo $value['desc']; ?>
	</td>
</tr>
<?php } elseif ($value['type'] == "heading") {  ?>
<tr valign="top">
	<th scope="row"></th>
	<td>
        <h3><?php echo $value['name']; ?></h3>
	</td>
</tr>
<?php
}
}
?>
</table>
<br />
<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<?php
}
add_action('admin_menu', 'aprillins_add_admin');
?>