<?php
/**/
function facebook_wall_and_social_integration_scripts() {
    global $post;
    wp_enqueue_script('jquery');
	
    //wp_register_script('mitsol_feed_main_javascript', plugins_url('js/jquery.mitsol.fbookwall.js', __FILE__), array("jquery"));
    //wp_enqueue_script('mitsol_feed_main_javascript');
    wp_register_script('mitsol_feed_scroll_javascript', plugins_url('js/jquery.mCustomScrollbar.concat.min.js', __FILE__));
    wp_enqueue_script('mitsol_feed_scroll_javascript');

} 
// Example Use: [facebook_wall_and_social_integration_replace_com post_title="true" excerpt_length="true" categories="all" thumbnail="true" img_width="250" img_height="150" rows="2" columns="1" pages_number="2" template="amaz-columns.php"]
function facebook_wall_and_social_integration_replace_scode($atts) { 
/*	extract(shortcode_atts(array(
		'id' => ''.get_option('msfb_fbid').'',
		'header' => ''. (get_option('msfb_header') == 'enabled') ? 'true' : 'false' .'', //pro
		'like_button' => ''. (get_option('msfb_toplikebox')== 'enabled') ? 'true' : 'false' .'', //pro
		'comments' => ''. (get_option('msfb_comments')== 'enabled') ? 'true' : 'false' .'', //pro
		'num' => ''. get_option('msfb_postnum') .''
	), $atts));*/
	$msfb_options = get_option('ms_fbwall_plugin_general_settings');
	$options_color = get_option('ms_fbwall_plugin_color_settings');
	$options_lang = get_option('ms_fbwall_plugin_language_settings');		
	 
	$atts = shortcode_atts( array(
	    'id' => ''.$msfb_options['msfb_fbid'].'',		
		'num' => ''. $msfb_options['msfb_postnum'] .''                
    ), $atts);	

/////////////check critical errors first 	
if (trim($msfb_options['msfb_accesstoken']) == '') {
	
	$msfb_html_content_first.= 'Please enter a valid Access Token in settings page.<br /><br />';
	//return false;
}
//Check if page id has been defined
if ( trim($atts[ 'id' ]) == '') {
	$msfb_html_content_first.= "Please enter the facebook page/group id to display feed. Enter in settings page's facebook id box or in short code(see instructions at bottom)<br /><br />";
	//return false;
}
//Check if number of posts has been defined
if (count(trim($atts['num']))<=0) {
	$msfb_html_content_first.= "Please enter the number of posts value. Enter in settings page's show number of posts box or in short code(see instructions at bottom)<br /><br />";
	//return false;
}	
 
////////////define all variables 	
$re_facebookwidth="11"; $temp_width=(int)$msfb_options['msfb_facebookwidth']; 
if(is_int($temp_width)) { if(($temp_width>90)&&($temp_width<=100)){ $re_facebookwidth="12"; } if(($temp_width>80)&&($temp_width<=90)){ $re_facebookwidth="11"; } if(($temp_width>70)&&($temp_width<=80)){ $re_facebookwidth="10"; } if(($temp_width>60)&&($temp_width<=70)){ $re_facebookwidth="9"; } if(($temp_width>50)&&($temp_width<=60)){ $re_facebookwidth="8"; } if(($temp_width>40)&&($temp_width<=50)){ $re_facebookwidth="7"; } if(($temp_width>30)&&($temp_width<=40)){ $re_facebookwidth="6"; } if(($temp_width>20)&&($temp_width<=30)){ $re_facebookwidth="5"; } if(($temp_width>10)&&($temp_width<=20)){ $re_facebookwidth="4"; } if($temp_width<=10){ $re_facebookwidth="3"; } if($temp_width>100){ $re_facebookwidth="11"; }} 
//set time zone for date calculation //check if empty function is appropriate when string is empty check done
$msfb_timezone = (!empty($msfb_options["msfb_timezone"]))? $msfb_options["msfb_timezone"] : "Europe/London";
date_default_timezone_set($msfb_timezone);

$msfb_type=""; $msfb_source_id=""; 
//feed or posts
$msfb_type = ($msfb_options['msfb_guestentries']== 'enabled') ? 'feed' : 'posts'; //if showGuest false = posts
//graph api url
$msfb_posts_url = 'https://graph.facebook.com/'. $atts[ 'id' ].'/' . $msfb_type . '?access_token='.$msfb_options['msfb_accesstoken'].'&limit='.trim($atts['num']);


////////////Now get data from Graph api
$msfb_data_objs = Msfb_Wall_Get_Graph_API_Data($msfb_posts_url);
//json decode of data
$msfbData = json_decode($msfb_data_objs);
$msfb_counter=0;

/////////////data extraction.Check error first
if(isset($msfbData->error)){ $msfb_html_content_first.= $msfbData->error->message ; } else {  
// check if no records found
$msfb_max = count($msfbData->data);
if($msfb_max==0){			
	$msfb_html_content_first .= '<div class="msfb-wall-box-first">';
	$msfb_html_content_first .= '<img class="msfb-wall-avatar" src="'. Msfb_Wall_Get_Avatar_Url($atts["id"]) .'" />';
	$msfb_html_content_first .= '<div class="msfb-wall-data">';
	$msfb_html_content_first .= '<span class="msfb-wall-message">has not shared any information. Try Increasing the number of posts value.</span>';
	$msfb_html_content_first .= '</div>';
	$msfb_html_content_first .= '</div>';
}   
else 
{
	//get like info per post seperately because of the hassle of first call don't show like count.
	if(msfb_exists($msfbData->data[0]->id)) { $msfb_source_id= explode("_",$msfbData->data[0]->id); }	   
 
//////////////////////sample test post start
//$msfb_html_content_first .= Test_Post_function($msfb_options, $msfb_html_content_first, $atts, $options_lang);    
/////////////////////test post ends
    	    
 foreach ($msfbData->data as $fdata) 
 { 	 	
    if(($fdata->type="status") ||($fdata->type="link") )
    {	
	
	$msfb_html_content_first .= ($msfb_counter==0) ? '<div class="msfb-layout msfb-wall-box msfb-wall-box-first">' : '<div class="msfb-layout msfb-wall-box">';
	/////////show avatar
	//if(o.showavatar==1){ 
		$msfb_html_content_first .= '<div class="avatar"><a href="https://www.facebook.com/profile.php?id='.$fdata->from->id.'" target="_blank">';
		$msfb_html_content_first .= '<img class="msfb-wall-avatar" src="'. Msfb_Wall_Get_Avatar_Url($fdata->from->id) .'" />';
		$msfb_html_content_first .= '</a></div>';
	//}
	$msfb_html_content_first .= '<div class="msfb-wall-data">';
	$msfb_html_content_first .= '<span class="msfb-wall-message">';
	$msfb_html_content_first .= '<a href="https://www.facebook.com/profile.php?id='. $fdata->from->id .'" class="msfb-wall-message-from" target="_blank">'. $fdata->from->name .'</a> ';
	$primary=""; $primary2="";
	if(msfb_exists($fdata->message))
	{
	     $msfb_html_content_first .= '<span style="display:block;margin-top:4px;">'. msfb_modText($fdata->message) .'</span>';		
	}
	if(msfb_exists($fdata->story))
	{				  		
	     $msfb_html_content_first .= '<span style="display:block;margin-top:4px;">'. msfb_modText($fdata->story) .'</span>'; 
	}
	$msfb_html_content_first .= '</span>';		
	
	//date section
	if($msfb_options['msfb_showdate']== 'enabled') {
		$msfb_html_content_first .= '<span class="msfb-wall-date">';		
		$msfb_html_content_first .= Msfb_FormatDate($fdata->created_time, "at", $msfb_options["msfb_dateformat"]);
		if($msfb_options['msfb_postlikebutton']== 'enabled')
		{
			$mspost_id = explode("_",$fdata->id);
			$msfb_html_content_first .= '<a style="margin-left:5px;cursor:pointer;cursor:hand; font-weight:normal;" href="https://www.facebook.com/'.$mspost_id[0].'/posts/'.$mspost_id[1].'" target="_blank" >Like</a>';
		}				
		
		$msfb_html_content_first .='</span>';
	}
	else 
	{ 
		    //exclude following mixing with above 
			$msfb_html_content_first .= '<span class="msfb-wall-date">';			
			if($msfb_options['msfb_postlikebutton']== 'enabled')
			{
				$mspost_id = explode("_",$fdata->id);
				$msfb_html_content_first .= '<a style="margin-left:5px;cursor:pointer;cursor:hand; font-weight:normal;"  href="https://www.facebook.com/'.$mspost_id[0].'/posts/'.$mspost_id[1].'" target="_blank" >Like</a>';
			}						
			$msfb_html_content_first .='</span>';
	}			
	
	 $msfb_html_content_first .= '</div><div class="msfb-wall-clean"></div>';
	 $msfb_html_content_first .='</div>';	
	}// show post type ends
	$msfb_counter++;
  } //for each ends  
 } //records !=0 condition ends
}    

$msfb_source_id= explode("_",$msfbData->data[0]->id); //if not define here, things get messed up

/* If we want to create more complex html code it's easier to capture the output buffer and return it */ 
 ob_start();  
 ?>
<link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/plugins/facebook-wall-and-social-integration/css/jquery.mitsol.fbookwall.css" />
 		
<style type="text/css">
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> .scroll-content 
{
    overflow: auto;  <?php echo 'height:'.$msfb_options['msfb_facebookheight'].'px;';?> margin:2px 1px 2px 0;
}
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> 
{
	<?php if($msfb_options['msfb_showborder']=='enabled'){ echo 'border: 1px solid #A69E98;'; } ?> 
	background-color:<?php echo $options_color['msfb_backcolor'];?>;
}
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> .msfb-wall
{	
	background-color:<?php echo $options_color['msfb_backcolor']; ?>; /* wall backg color setting*/ margin-top:5px;	
}
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> .msfb-wall-message
{
   color: <?php echo $options_color['msfb_postcolor'];?>; /*post color setting*/
}
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> .msfb-layout {
    border: 1px solid <?php echo $options_color['msfb_postbordercolor']; ?>; /*post border color setting*/
}
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> .msfb-wall a
{
	color:<?php echo $options_color['msfb_linkcolor'];?>; /* all wall link color */ /*setting*/
}
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> .msfb-wall-date
{
   color: <?php echo $options_color['msfb_datecolor']; ?>; /*date color of post */ /*setting*/
}
#msfbmain-div-<?php echo $msfb_source_id[0]; ?> .msfb-wall-comment-from-date span
{
   color:<?php echo $options_color['msfb_colorcom']; ?>; /*like number comment color same as comment color *//*seting*/
}		
</style> 
 
<?php if($re_facebookwidth!=""){ $fb_width=$re_facebookwidth; } ?>
<div class="msfb-wall-main"> <div class="msfb-container"> <div class="msfb-row"> <div class="span_len<?php echo $fb_width; ?>">
<div id="msfbmain-div-<?php echo $msfb_source_id[0]; ?>">

<div id="msfb-content-main-<?php echo $msfb_source_id[0]; ?>" class="scroll-content"><div class="msfb-wall"><?php echo $msfb_html_content_first; ?></div></div>   </div> 
</div></div></div></div>

 <?php  
    /* Return the buffer contents into a variable */
    $msfb_html_content = ob_get_contents(); 
    /* Empty the buffer without displaying it. We don't want the previous html shown */
    ob_end_clean(); 
    /* The text returned will replace our shortcode matching text */    
    return $msfb_html_content;
}
//format date from facebook per post
function Msfb_FormatDate($dateStr,$atTranslated, $dateFormat){				
	
	$unixtime=strtotime($dateStr);
	$day=date("d",$unixtime);
	$month=date("m",$unixtime);
	$year=date("Y",$unixtime);
	$hour=date("h",$unixtime);
	$minutes=date("i",$unixtime);
	$ampm= ((date("H",$unixtime))<12) ? 'am' : 'pm';
	if($dateFormat=="us") { return $month.'.'.$day.'.'.$year.' '.$atTranslated.' '.$hour.':'.$minutes.' '.$ampm; }
	return $day.'.'.$month.'.'.$year.' '.$atTranslated.' '.$hour.':'.$minutes.' '.$ampm;
	
}
function msfb_exists($data){
	if(!$data || $data==null || $data=='undefined') return false;
	else return true;
}
function msfb_modText($text){	
	return msfb_nl2br(msfb_autoLink(msfb_escapeTags($text)));
}
	
function msfb_escapeTags($str){	
	$new_str1=str_replace("<","&lt;",$str);
	$new_str2=str_replace(">","&gt;",$new_str1);
	return  $new_str2;
}
	
function msfb_nl2br($str){	
	return str_replace(array("\r\n","\n\r","\r","\n","\n\n"),"<br>", $str);
}
//http,ftp link	
function msfb_autoLink($str){
//it replaces any link into coded link as shown link will be instead $1
	//return preg_replace('|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i', '$1 <a href="$2" target="_blank">$3</a>', $str);//see if hidden is better
	return preg_replace('#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#', '<a href="$1" target="_blank">$1</a>', $str);
} 
function Msfb_Wall_Get_Avatar_Url($id){
	$msfbAvURL='https://graph.facebook.com/'.$id.'/picture?type=square';	
	return $msfbAvURL;
}

//Get JSON object of feed data
function Msfb_Wall_Get_Graph_API_Data($url){
	//if cURL is available and enabled in server
 if(is_callable('curl_init')){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);//addition
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$msfbJsonData = curl_exec($ch);
	curl_close($ch);
	//curl is not available use file_get_contents
	} else { if ( ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
	        $msfbJsonData = @file_get_contents($url);
	//If above ways fails use wordpress HTTP API
	} else {
	     if( !class_exists( 'WP_Http' ) ) include_once( ABSPATH . WPINC. '/class-http.php' );
	     $request = new WP_Http;
	     $result = $request->request($url);
	     $msfbJsonData = $result['body'];
      }
	}
	return $msfbJsonData;
}	

function Test_Post_function($msfb_options, $msfb_html_content_first, $atts, $options_lang)
{				
		$msfb_html_content_first .= ($msfb_counter==0) ? '<div class="msfb-layout msfb-wall-box msfb-wall-box-first">' : '<div class="msfb-layout msfb-wall-box">';
		/////////show avatar
		//if(o.showavatar==1){
		$msfb_html_content_first .= '<div class="avatar"><a href="https://www.facebook.com/profile.php" target="_blank">';
		$msfb_html_content_first .= '<img class="msfb-wall-avatar" src="http://localhost/wordpress/wp-content/plugins/facebook-wall-and-social-integration/profile.jpg" />';
		$msfb_html_content_first .= '</a></div>';
		//}
		$msfb_html_content_first .= '<div class="msfb-wall-data">';
		$msfb_html_content_first .= '<span class="msfb-wall-message">';
		$msfb_html_content_first .= '<a href="https://www.facebook.com/profile.php" class="msfb-wall-message-from" target="_blank">mridul samadder</a> ';
		$content.= 'Smog is smothering Beijing - its been likened by scientists to a nuclear winter, starving everything of sunlight: http://bbc.in/1h59djJ\n\nBut the problem of toxic air is not just confined to China. The World Health Organization (WHO) has linked air pollution to the deaths of seven million people globally in 2012.\n\nIs air pollution a problem where you are?';
	
		$msfb_html_content_first .= '<span style="display:block;margin-top:4px;">'. msfb_modText($content) .'</span>'; 
			
		$msfb_html_content_first .= '</span>';
	
		//date section
		if($msfb_options['msfb_showdate']== 'enabled') {
			$msfb_html_content_first .= '<span class="msfb-wall-date">';			
			$msfb_html_content_first .= Msfb_FormatDate("2014-03-22T22:34:36+0000", "at", $msfb_options["msfb_dateformat"]);
			if($msfb_options['msfb_postlikebutton']== 'enabled')
			{
				 
				$msfb_html_content_first .= '<a style="margin-left:5px;cursor:pointer;cursor:hand; font-weight:normal;" href="https://www.facebook.com/" target="_blank" >Like</a>';
			}			
	
			$msfb_html_content_first .='</span>';
		}		
	
		$msfb_html_content_first .= '</div><div class="msfb-wall-clean"></div>';
		$msfb_html_content_first .='</div>';
		
		return $msfb_html_content_first;	
}

function facebook_wall_and_social_integration_activation()
{ 

if(!get_option('ms_fbwall_plugin_general_settings')) {
	$ms_fbwall_plugin_general_settings = array(
		'msfb_fbid' => 'wordpress',
		'msfb_accesstoken' => '',		
		'msfb_facebookwidth' => '90',		
		'msfb_facebookheight' => '550',		
		'msfb_postlikebutton' => 'enabled',		    		
		'msfb_postnum' => '5',        
		'msfb_guestentries' => 'enabled',
		'msfb_showdate' => 'enabled',
		'msfb_dateformat' => 'nonus',
        'msfb_timezone' => 'Europe/London',
		'msfb_showborder' => 'enabled',        
																												
		);

	add_option( 'ms_fbwall_plugin_general_settings', $ms_fbwall_plugin_general_settings );
}
if(!get_option('ms_fbwall_plugin_color_settings')) {
	$ms_fbwall_plugin_color_settings = array(
		'msfb_postcolor' => '#333333',
		'msfb_backcolor' => '#ffffff',
		
		'msfb_postbordercolor' => '#F0F0F0',
		'msfb_linkcolor' => '#3B5998',
		'msfb_datecolor' => '#777',
																														
		);

	add_option( 'ms_fbwall_plugin_color_settings', $ms_fbwall_plugin_color_settings );
}
	
}
function facebook_wall_and_social_integration_deactivation()
{
   if ( ! current_user_can( 'activate_plugins' ) )
        return;
   delete_option( 'ms_fbwall_plugin_general_settings' );  
   delete_option( 'ms_fbwall_plugin_color_settings' );   		   
}
