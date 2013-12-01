<?php
/**/
function facebook_wall_and_social_integration_scripts() {
    global $post;
    wp_enqueue_script('jquery');
	
    wp_register_script('mitsol_feed_javascript', plugins_url('js/jquery.mitsol.fbookwall.js', __FILE__), array("jquery"));
    wp_enqueue_script('mitsol_feed_javascript');
//    wp_register_script('ff_init', plugins_url('js/ff.initialize.js', __FILE__));
//    wp_enqueue_script('ff_init');

//    $effect      = (get_option('ff_effect') == '') ? "slide" : get_option('fwds_effect');
//    $interval    = (get_option('ff_interval') == '') ? 2000 : get_option('fwds_interval');
//    $autoplay    = (get_option('ff_autoplay') == 'enabled') ? true : false;
//    $playBtn    = (get_option('ff_playbtn') == 'enabled') ? true : false;
//        $config_array = array(
//            'effect' => $effect,
//            'interval' => $interval,
//            'autoplay' => $autoplay,
//            'playBtn' => $playBtn
//        );
   // wp_localize_script('ff_init', 'setting', $config_array);

}
function facebook_wall_and_social_integration_styles() {

   // wp_register_style('mitsol_feed_bootstrap', plugins_url('css/bootstrap.css', __FILE__));
   // wp_enqueue_style('mitsol_feed_bootstrap');
}
//// Example Use: [facebook_wall_and_social_integration_replace_com post_title="true" excerpt_length="true" categories="all" thumbnail="true" img_width="250" img_height="150" rows="2" columns="1" pages_number="2" template="amaz-columns.php"]
function facebook_wall_and_social_integration_replace_scode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => ''.get_option('msfb_fbid').'',
		//'header' => ''. (get_option('msfb_header') == 'enabled') ? 'true' : 'false' .'', //pro
		//'like_button' => ''. (get_option('msfb_toplikebox')== 'enabled') ? 'true' : 'false' .'', //pro
		//'comments' => ''. (get_option('msfb_comments')== 'enabled') ? 'true' : 'false' .'', //pro
		'num' => ''. get_option('msfb_postnum') .''
	), $atts));
 
    /* Retrieve our settings */
    //$options = get_option('mitsol_opts'); 
    /* If we want to create more complex html code it's easier to capture the output buffer and return it */
    ob_start(); ?>	
	
<link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/plugins/facebook-wall-and-social-integration/css/jquery.mitsol.fbookwall.css" />
<style type="text/css">
#msfbmain-div .scroll-pane 
{
  width: <?php echo get_option('msfb_facebookwidth')-10; ?>px; overflow: auto;  <?php echo 'height:'.get_option('msfb_facebookheight').'px;'; ?> } ?>
}
#msfbmain-div 
{
	width:<?php echo get_option('msfb_facebookwidth'); ?>px; <?php if(get_option('msfb_showborder') == 'enabled'){ echo "border:1px solid #A69E98;"; } ?>
}
#msfbmain-div #like{
	/*margin-top: 5px;*/	
	padding:5px 10px 5px 10px; width:<?php echo get_option('msfb_facebookwidth')-20; ?>px; <?php if(get_option('msfb_showborder')=='enabled'){ echo 'border-bottom:1px solid buttonface;'; } ?>
}
#msfbmain-div .msfb-wall
{	
	background-color:<?php echo get_option('msfb_backcolor');?>; /* wall backg color setting*/
	width:<?php echo get_option('msfb_facebookwidth')-10; ?>px;
	<?php  echo 'height:'.get_option('msfb_facebookheight').'px;'; ?>
}
#msfbmain-div .msfb-wall-message
{
   color: <?php echo get_option('msfb_postcolor');?>; /*post color setting*/
}
#msfbmain-div .msfb-layout {
    border: 1px solid <?php echo get_option('msfb_postbordercolor'); ?>; /*post border color setting*/
}
#msfbmain-div .msfb-wall a
{
	color:<?php echo get_option('msfb_linkcolor');?>; /* all wall link color */ /*setting*/
}
#msfbmain-div .msfb-wall-date
{
   color: <?php echo get_option('msfb_datecolor'); ?>; /*date color of post */ /*setting*/
}
#msfbmain-div .msfb-wall-comment-from-date
{
  color: <?php echo get_option('msfb_datecolor'); ?>; /*date color of comments same setting wall date color */ /*setting*/
}					
</style>
	
<script type="text/javascript">	
var ms_js = jQuery.noConflict();  	
ms_js(function(){	
///////////////////
ms_js('#live-demo').Ms_fwall({ id:'<?php echo $id; ?>', //'2211155996'
	accessToken:'<?php echo get_option('msfb_accesstoken'); ?>',
	showGuestEntries: '<?php echo (get_option('msfb_guestentries')== 'enabled') ? '1' : '0'; ?>',
	max:<?php echo $num; ?>, //100
	showdate:'<?php echo (get_option('msfb_showdate')== 'enabled') ? '1' : '0'; ?>',
	date_format:'<?php echo (get_option('msfb_dateformat')== 'us') ? 'us' : ''; ?>',
	show_like:'<?php echo (get_option('msfb_postlikebutton')== 'enabled') ? '1' : '0'; ?>',//like link below post
	//more for pro
});	 	
					
});		   
	
</script>
<div id="msfbmain-div">
	<div id="live-demo" class="scroll-pane"></div>
</div>

<?php 
    /* Return the buffer contents into a variable */
    $new_content = ob_get_contents(); 
    /* Empty the buffer without displaying it. We don't want the previous html shown */
    ob_end_clean(); 
    /* The text returned will replace our shortcode matching text */
    return $new_content;
}

