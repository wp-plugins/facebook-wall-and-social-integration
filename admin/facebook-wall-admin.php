<?php 
/**/
function mitsol_admin_css_all_page() {	
    wp_enqueue_script('jquery');
   // wp_register_script('mitsol_feed_bootstrap_js', plugins_url('js/bootstrap.js', __FILE__), array("jquery"));
   // wp_enqueue_script('mitsol_feed_bootstrap_js');	
    wp_register_style($handle = 'mitsol_feed_bootstrap', $src = plugins_url('css/bootstrap.css', __FILE__), $deps = array(), $ver = '1.0.0', $media = 'all');
    wp_enqueue_style('mitsol_feed_bootstrap'); 
} 
/* admin functions */
function facebook_wall_and_social_integration_plugin_settings() {
   //add_options_page( 'social facebook by mitsol Plugin Settings', 'social facebook by mitsol Plugin', 'manage_options', 'social-facebook-by-mitsol-plugin-settings', 'facebook_wall_and_social_integration_plugin_settings_page' );
   add_menu_page('facebook wall & social integration settings', 'facebook wall & social integration', 'administrator', 'facebook_wall_and_social_integration_settings', 'facebook_wall_and_social_integration_display_settings');
}
//
function facebook_wall_and_social_integration_display_settings () {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 
        'You do not have sufficient permissions to access this page.' 
        ) );
    }
    
	$options = get_option('ms_fbwall_plugin_general_settings');
	$options_color = get_option('ms_fbwall_plugin_color_settings');	
			
    if((isset($_REQUEST["msfb_active_tab"]))&&($_REQUEST["msfb_active_tab"] == "1"))
	{ 
	   //first variable
	   $msfb_fbid=$_REQUEST["msfb_fbid"]; $options['msfb_fbid']= $msfb_fbid;
   	   $msfb_accesstoken=$_REQUEST["msfb_accesstoken"]; $options['msfb_accesstoken']= $msfb_accesstoken;   	      	   
   	   $msfb_facebookwidth=$_REQUEST["msfb_facebookwidth"]; $options['msfb_facebookwidth']= $msfb_facebookwidth;   	   
   	   $msfb_facebookheight=$_REQUEST["msfb_facebookheight"]; $options['msfb_facebookheight']= $msfb_facebookheight;   	      	  
   	   $msfb_postlikebutton=$_REQUEST["msfb_postlikebutton"]; $options['msfb_postlikebutton']= $msfb_postlikebutton;	  
       $msfb_postnum=$_REQUEST["msfb_postnum"]; $options['msfb_postnum']= $msfb_postnum; 	
       $msfb_guestentries=$_REQUEST["msfb_guestentries"]; $options['msfb_guestentries']= $msfb_guestentries; 
       $msfb_showdate=$_REQUEST["msfb_showdate"]; $options['msfb_showdate']= $msfb_showdate;
 	   $msfb_dateformat=$_REQUEST["msfb_dateformat"]; $options['msfb_dateformat']= $msfb_dateformat; 	   	   
 	   $msfb_timezone=$_REQUEST["msfb_timezone"]; $options['msfb_timezone']= $msfb_timezone;
 	   
	   $msfb_showborder=$_REQUEST["msfb_showborder"]; $options['msfb_showborder']= $msfb_showborder;	     	 
	   
	   
	   	update_option( 'ms_fbwall_plugin_general_settings', $options );
	   	   
	} 
    if((isset($_REQUEST["msfb_active_tab"]))&&($_REQUEST["msfb_active_tab"] == "2"))
	{ 
	   //first variable
	   $msfb_postcolor=$_REQUEST["msfb_postcolor"]; $options_color['msfb_postcolor']= $msfb_postcolor;
	   $msfb_backcolor=$_REQUEST["msfb_backcolor"]; $options_color['msfb_backcolor']= $msfb_backcolor;
	   
	   $msfb_postbordercolor=$_REQUEST["msfb_postbordercolor"]; $options_color['msfb_postbordercolor']= $msfb_postbordercolor;
	   $msfb_linkcolor=$_REQUEST["msfb_linkcolor"]; $options_color['msfb_linkcolor']= $msfb_linkcolor;
	   $msfb_datecolor=$_REQUEST["msfb_datecolor"]; $options_color['msfb_datecolor']= $msfb_datecolor;
	    	   	   	   	   	   	   	   	      	  		   	   	   	   	   	   	   	   	  
	   	update_option( 'ms_fbwall_plugin_color_settings', $options_color );
	   	   
	} 					
  
	//
    $msfb_fbid = ($options['msfb_fbid'] != '') ? $options['msfb_fbid'] : 'joomla';
    $msfb_accesstoken = ($options['msfb_accesstoken'] != '') ? $options['msfb_accesstoken'] : '';   
	$msfb_facebookwidth = ($options['msfb_facebookwidth'] != '') ? $options['msfb_facebookwidth'] : '550';	
	$msfb_facebookheight = ($options['msfb_facebookheight'] != '') ? $options['msfb_facebookheight'] : '550';	   
    $msfb_postlikebutton  = ($options['msfb_postlikebutton'] == 'enabled') ? 'checked' : '' ;	   	
    $msfb_postnum = ($options['msfb_postnum'] != '') ? $options['msfb_postnum'] : '30'; 
    $msfb_guestentries = ($options['msfb_guestentries'] == 'enabled') ? 'checked' : '' ;		
    $msfb_showdate = ($options['msfb_showdate'] == 'enabled') ? 'checked' : '' ;	
	$msfb_dateformat_us = ($options['msfb_dateformat'] == 'us') ? 'selected' : '';
    $msfb_dateformat_nonus = ($options['msfb_dateformat'] == 'nonus') ? 'selected' : '';
    $msfb_timezone = ($options['msfb_timezone'] != '') ? $options['msfb_timezone'] : '';    
    $msfb_showborder = ($options['msfb_showborder'] == 'enabled') ? 'checked' : '' ;      
    
    //$msfb_post_layout=$_REQUEST["msfb_post_layout"]; $options['msfb_post_layout']= $msfb_post_layout;
	//color
	$msfb_postcolor = ($options_color['msfb_postcolor'] != '') ? $options_color['msfb_postcolor'] : '#333333'; 	
	$msfb_backcolor = ($options_color['msfb_backcolor'] != '') ? $options_color['msfb_backcolor'] : '#ffffff'; 		
	$msfb_postbordercolor = ($options_color['msfb_postbordercolor'] != '') ? $options_color['msfb_postbordercolor'] : '#F0F0F0'; 	
	$msfb_linkcolor = ($options_color['msfb_linkcolor'] != '') ? $options_color['msfb_linkcolor'] : '#3B5998'; 	
	$msfb_datecolor = ($options_color['msfb_datecolor'] != '') ? $options_color['msfb_datecolor'] : '#777'; 			
	
   if(isset($_REQUEST["msfb_active_tab"])) { //if($_REQUEST["settings-updated"] == "true"){ 
   if($_REQUEST["msfb_active_tab"] == "1"){ $setting_section="General"; }    if($_REQUEST["msfb_active_tab"] == "2"){ $setting_section="Color"; }    if($_REQUEST["msfb_active_tab"] == "3"){ $setting_section="Language"; }    if($_REQUEST["msfb_active_tab"] == "4"){ $setting_section="Social plugin"; }
	    $msfb_success_error='<div class="alert alert-success">  
        <a class="close" data-dismiss="alert">x</a>  
        '. $setting_section .' settings saved successfully
        </div>';
	} 	 
	
   (!isset($_REQUEST["msfb_active_tab"])) ? $msfb_active_tab="1": $msfb_active_tab = $_REQUEST["msfb_active_tab"];

    if($msfb_active_tab =="1"){ $active=""; $active2='style="display:none;"';$active3='style="display:none;"'; $active4='style="display:none;"'; $active5='style="display:none;"'; $activetab='class="active"'; $activetab2='';  $activetab3=''; $activetab4=''; $activetab5=''; }
    if($msfb_active_tab =="2"){ $active2=""; $active='style="display:none;"'; $active3='style="display:none;"'; $active4='style="display:none;"'; $active5='style="display:none;"'; $activetab2='class="active"'; $activetab='';  $activetab3=''; $activetab4=''; $activetab5=''; }	
	if($msfb_active_tab =="4"){ $active4=""; $active3='style="display:none;"'; $active='style="display:none;"'; $active2='style="display:none;"'; $active5='style="display:none;"';  $activetab4='class="active"'; $activetab3=''; $activetab='';  $activetab2=''; $activetab5=''; }

?>
<div class="msmain_container" style="margin-top:10px;">	
<script type="text/javascript">	
var ms_js = jQuery.noConflict();  	
ms_js(function(){		 	
 ms_js("#ms_1st_tablink").click(function() {
     ms_js("#ms_1st_tab").show(); 
	 ms_js("#ms_2nd_tab").hide(); 
	 ms_js("#ms_third_tab").hide();	
	 ms_js("#ms_fourth_tab").hide();  	
	 ms_js("#ms_fifth_tab").hide();
	  
  	 ms_js("#ms_1st_list").addClass("active"); 	 
	 ms_js("#ms_2nd_list").removeClass("active");
  	 ms_js("#ms_third_list").removeClass("active");
	 ms_js("#ms_fourth_list").removeClass("active"); 
	 ms_js("#ms_fifth_list").removeClass("active");
  });
  ms_js("#ms_2nd_tablink").click(function() {
     ms_js("#ms_2nd_tab").show(); 
	 ms_js("#ms_1st_tab").hide(); 
	 ms_js("#ms_third_tab").hide();	
	 ms_js("#ms_fourth_tab").hide();
	 ms_js("#ms_fifth_tab").hide(); 
	  
  	 ms_js("#ms_2nd_list").addClass("active"); 	 
	 ms_js("#ms_1st_list").removeClass("active");
  	 ms_js("#ms_third_list").removeClass("active"); 
	 ms_js("#ms_fourth_list").removeClass("active"); 
	 ms_js("#ms_fifth_list").removeClass("active");
  });   
  ms_js("#ms_fourth_tablink").click(function() {
     ms_js("#ms_1st_tab").hide(); 
	 ms_js("#ms_2nd_tab").hide(); 
	 ms_js("#ms_third_tab").hide();
	 ms_js("#ms_fourth_tab").show();
	 ms_js("#ms_fifth_tab").hide(); 	 	
	  
     ms_js("#ms_fourth_list").addClass("active");
  	 ms_js("#ms_1st_list").removeClass("active"); 	 
	 ms_js("#ms_2nd_list").removeClass("active");
  	 ms_js("#ms_third_list").removeClass("active"); 
  	 ms_js("#ms_fifth_list").removeClass("active"); 
  });
  ms_js("#ms_fifth_tablink").click(function() {
	     ms_js("#ms_1st_tab").hide(); 
		 ms_js("#ms_2nd_tab").hide(); 
		 ms_js("#ms_third_tab").hide();
		 ms_js("#ms_fourth_tab").hide(); 
		 ms_js("#ms_fifth_tab").show(); 	 	
		  
	     ms_js("#ms_fourth_list").removeClass("active");
	  	 ms_js("#ms_1st_list").removeClass("active"); 	 
		 ms_js("#ms_2nd_list").removeClass("active");
	  	 ms_js("#ms_third_list").removeClass("active");
	  	ms_js("#ms_fifth_list").addClass("active"); 
	  });
  ms_js(".msmain_container .close").click( function() {
    ms_js(this).parent("div").hide();
  });
});	 

</script>
<style type="text/css">

.msmain_container select,.msmain_container 
textarea,.msmain_container 
input[type="text"],.msmain_container 
input[type="password"],.msmain_container 
input[type="datetime"],.msmain_container 
input[type="datetime-local"],.msmain_container 
input[type="date"],.msmain_container 
input[type="month"],.msmain_container 
input[type="time"],.msmain_container 
input[type="week"],.msmain_container 
input[type="number"],.msmain_container 
input[type="email"],.msmain_container 
input[type="url"],.msmain_container 
input[type="search"],.msmain_container 
input[type="tel"],.msmain_container 
input[type="color"],.msmain_container 
.uneditable-input {
  height: 28px; 
}
</style>

<div class="container-fluid" style="margin-top:30px; padding-top:20px; background-color:white">  
<div class="row-fluid">  
<div class="span12"> <?php echo $msfb_success_error; ?> 
<ul class="nav nav-tabs">  		 
<li  id="ms_1st_list" style="cursor:pointer; cursor:hand" <?php echo $activetab ; ?> ><a id="ms_1st_tablink">General</a></li>  
<li id="ms_2nd_list" style="cursor:pointer; cursor:hand" <?php echo $activetab2 ; ?>><a id="ms_2nd_tablink">Colors</a></li>  
<li id="ms_fourth_list" style="cursor:pointer; cursor:hand"  <?php echo $activetab4; ?>><a id="ms_fourth_tablink">Facebook social plugins</a></li>  
<li id="ms_fifth_list" style="cursor:pointer; cursor:hand"  <?php echo $activetab5; ?>><a id="ms_fifth_tablink">System requirements</a></li>  
</ul>
<div  id="ms_1st_tab" <?php echo $active; ?>> 
<form method="post" name="general_options" action="" class="form-horizontal">  
        <fieldset>  
          <legend>General settings</legend> 
          <div class="control-group">  
            <label class="control-label" for="msfb_fbid">Facebook ID</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_fbid" value="<?php echo esc_attr_e($msfb_fbid); ?>" id="msfb_fbid" />
			<p class="help-block"><a target="_blank" href="http://extensions.programminghelp24.com/facebook_wall_documentation_wordpress.htm">read doc</a> or <a target="_blank" href="http://wordpress.org/plugins/facebook-wall-and-social-integration/faq/">plugin faq</a> to get facebook page/group/profile id</p> 
            </div>  
          </div>  
		  <div class="control-group">  
            <label class="control-label" for="msfb_accesstoken">Access token</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_accesstoken" value="<?php echo esc_attr_e($msfb_accesstoken); ?>" id="msfb_accesstoken" />
               <p class="help-block">it will be look like <b>123456789|23242hj323232jh3j2222fs45</b> (for this create facebook<br/>
               application first and configure application basic setting correctly, written in the <a target="_blank" href="http://extensions.programminghelp24.com/facebook_wall_documentation_wordpress.htm">doc here</a>)</p>  
            </div>  
          </div> 		  		   		 
		   <div class="control-group">  
            <label class="control-label" for="msfb_facebookwidth">Width</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_facebookwidth" value="<?php echo esc_attr_e($msfb_facebookwidth); ?>" id="msfb_facebookwidth" />
			<p class="help-block">width value in %. Ex - 100,80,50..</p> 
            </div>  
          </div>  
		  			 		  		        
		  <div class="control-group">  
            <label class="control-label" for="msfb_facebookheight">Height</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_facebookheight" value="<?php echo esc_attr_e($msfb_facebookheight); ?>" id="msfb_facebookheight" />                        
            </div>  
          </div>
		  		  		
		   <div class="control-group">  
            <label class="control-label" for="msfb_postlikebutton">Show post like button</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input  type="checkbox" <?php echo esc_attr_e($msfb_postlikebutton); ?> name="msfb_postlikebutton" id="msfb_postlikebutton" value="enabled" />   
              </label>  
            </div>  
          </div>		                     		 
		  
		  <div class="control-group">  
            <label class="control-label" for="msfb_postnum">Show number of posts</label>  
            <div class="controls">  
			<input type="text"  class="input-xlarge" name="msfb_postnum" value="<?php echo esc_attr_e($msfb_postnum); ?>" id="msfb_postnum" />
            </div>  
          </div>
		  <div class="control-group">  
            <label class="control-label" for="msfb_guestentries">Show guest entries</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input type="checkbox" <?php echo esc_attr_e($msfb_guestentries); ?> name="msfb_guestentries" id="msfb_guestentries" value="enabled" />  
              </label>  
            </div>  
          </div>   
		    <div class="control-group">  
            <label class="control-label" for="msfb_showdate">Show Date</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input type="checkbox" <?php echo esc_attr_e($msfb_showdate); ?> name="msfb_showdate" id="msfb_showdate" value="enabled" />  
              </label>  
            </div>  
          </div> 
		  <div class="control-group">  
            <label class="control-label" for="msfb_dateformat">Date format</label>  
            <div class="controls">  
              <select id="msfb_dateformat" name="msfb_dateformat">  
                 <option value="us" <?php echo esc_attr_e($msfb_dateformat_us); ?>>05.25.2014 08:20</option>
                 <option value="nonus" <?php echo esc_attr_e($msfb_dateformat_nonus ); ?>>25.05.2014 08:20</option></select>
            </div>  
          </div>
           <div class="control-group">  
            <label class="control-label" for="msfb_timezone">Date TimeZone</label>  
            <div class="controls">  
           <select id="msfb_timezone" name="msfb_timezone">
                                        <option value="Pacific/Midway" <?php if($msfb_timezone == "Pacific/Midway") echo 'selected="selected"' ?> ><?php _e('(GMT-11:00) Midway Island, Samoa'); ?></option>
                                        <option value="America/Adak" <?php if($msfb_timezone == "America/Adak") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii-Aleutian'); ?></option>
                                        <option value="Etc/GMT+10" <?php if($msfb_timezone == "Etc/GMT+10") echo 'selected="selected"' ?> ><?php _e('(GMT-10:00) Hawaii'); ?></option>
                                        <option value="Pacific/Marquesas" <?php if($msfb_timezone == "Pacific/Marquesas") echo 'selected="selected"' ?> ><?php _e('(GMT-09:30) Marquesas Islands'); ?></option>
                                        <option value="Pacific/Gambier" <?php if($msfb_timezone == "Pacific/Gambier") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Gambier Islands'); ?></option>
                                        <option value="America/Anchorage" <?php if($msfb_timezone == "America/Anchorage") echo 'selected="selected"' ?> ><?php _e('(GMT-09:00) Alaska'); ?></option>
                                        <option value="America/Ensenada" <?php if($msfb_timezone == "America/Ensenada") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Tijuana, Baja California'); ?></option>
                                        <option value="Etc/GMT+8" <?php if($msfb_timezone == "Etc/GMT+8") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pitcairn Islands'); ?></option>
                                        <option value="America/Los_Angeles" <?php if($msfb_timezone == "America/Los_Angeles") echo 'selected="selected"' ?> ><?php _e('(GMT-08:00) Pacific Time (US & Canada)'); ?></option>
                                        <option value="America/Denver" <?php if($msfb_timezone == "America/Denver") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Mountain Time (US & Canada)'); ?></option>
                                        <option value="America/Chihuahua" <?php if($msfb_timezone == "America/Chihuahua") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Chihuahua, La Paz, Mazatlan'); ?></option>
                                        <option value="America/Dawson_Creek" <?php if($msfb_timezone == "America/Dawson_Creek") echo 'selected="selected"' ?> ><?php _e('(GMT-07:00) Arizona'); ?></option>
                                        <option value="America/Belize" <?php if($msfb_timezone == "America/Belize") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Saskatchewan, Central America'); ?></option>
                                        <option value="America/Cancun" <?php if($msfb_timezone == "America/Cancun") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Guadalajara, Mexico City, Monterrey'); ?></option>
                                        <option value="Chile/EasterIsland" <?php if($msfb_timezone == "Chile/EasterIsland") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Easter Island'); ?></option>
                                        <option value="America/Chicago" <?php if($msfb_timezone == "America/Chicago") echo 'selected="selected"' ?> ><?php _e('(GMT-06:00) Central Time (US & Canada)'); ?></option>
                                        <option value="America/New_York" <?php if($msfb_timezone == "America/New_York") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Eastern Time (US & Canada)'); ?></option>
                                        <option value="America/Havana" <?php if($msfb_timezone == "America/Havana") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Cuba'); ?></option>
                                        <option value="America/Bogota" <?php if($msfb_timezone == "America/Bogota") echo 'selected="selected"' ?> ><?php _e('(GMT-05:00) Bogota, Lima, Quito, Rio Branco'); ?></option>
                                        <option value="America/Caracas" <?php if($msfb_timezone == "America/Caracas") echo 'selected="selected"' ?> ><?php _e('(GMT-04:30) Caracas'); ?></option>
                                        <option value="America/Santiago" <?php if($msfb_timezone == "America/Santiago") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Santiago'); ?></option>
                                        <option value="America/La_Paz" <?php if($msfb_timezone == "America/La_Paz") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) La Paz'); ?></option>
                                        <option value="Atlantic/Stanley" <?php if($msfb_timezone == "Atlantic/Stanley") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Faukland Islands'); ?></option>
                                        <option value="America/Campo_Grande" <?php if($msfb_timezone == "America/Campo_Grande") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Brazil'); ?></option>
                                        <option value="America/Goose_Bay" <?php if($msfb_timezone == "America/Goose_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Goose Bay)'); ?></option>
                                        <option value="America/Glace_Bay" <?php if($msfb_timezone == "America/Glace_Bay") echo 'selected="selected"' ?> ><?php _e('(GMT-04:00) Atlantic Time (Canada)'); ?></option>
                                        <option value="America/St_Johns" <?php if($msfb_timezone == "America/St_Johns") echo 'selected="selected"' ?> ><?php _e('(GMT-03:30) Newfoundland'); ?></option>
                                        <option value="America/Araguaina" <?php if($msfb_timezone == "America/Araguaina") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) UTC-3'); ?></option>
                                        <option value="America/Montevideo" <?php if($msfb_timezone == "America/Montevideo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Montevideo'); ?></option>
                                        <option value="America/Miquelon" <?php if($msfb_timezone == "America/Miquelon") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Miquelon, St. Pierre'); ?></option>
                                        <option value="America/Godthab" <?php if($msfb_timezone == "America/Godthab") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Greenland'); ?></option>
                                        <option value="America/Argentina/Buenos_Aires" <?php if($msfb_timezone == "America/Argentina/Buenos_Aires") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Buenos Aires'); ?></option>
                                        <option value="America/Sao_Paulo" <?php if($msfb_timezone == "America/Sao_Paulo") echo 'selected="selected"' ?> ><?php _e('(GMT-03:00) Brasilia'); ?></option>
                                        <option value="America/Noronha" <?php if($msfb_timezone == "America/Noronha") echo 'selected="selected"' ?> ><?php _e('(GMT-02:00) Mid-Atlantic'); ?></option>
                                        <option value="Atlantic/Cape_Verde" <?php if($msfb_timezone == "Atlantic/Cape_Verde") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Cape Verde Is.'); ?></option>
                                        <option value="Atlantic/Azores" <?php if($msfb_timezone == "Atlantic/Azores") echo 'selected="selected"' ?> ><?php _e('(GMT-01:00) Azores'); ?></option>
                                        <option value="Europe/Belfast" <?php if($msfb_timezone == "Europe/Belfast") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Belfast'); ?></option>
                                        <option value="Europe/Dublin" <?php if($msfb_timezone == "Europe/Dublin") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Dublin'); ?></option>
                                        <option value="Europe/Lisbon" <?php if($msfb_timezone == "Europe/Lisbon") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : Lisbon'); ?></option>
                                        <option value="Europe/London" <?php if($msfb_timezone == "Europe/London") echo 'selected="selected"' ?> ><?php _e('(GMT) Greenwich Mean Time : London'); ?></option>
                                        <option value="Africa/Abidjan" <?php if($msfb_timezone == "Africa/Abidjan") echo 'selected="selected"' ?> ><?php _e('(GMT) Monrovia, Reykjavik'); ?></option>
                                        <option value="Europe/Amsterdam" <?php if($msfb_timezone == "Europe/Amsterdam") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna'); ?></option>
                                        <option value="Europe/Belgrade" <?php if($msfb_timezone == "Europe/Belgrade") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague'); ?></option>
                                        <option value="Europe/Brussels" <?php if($msfb_timezone == "Europe/Brussels") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Brussels, Copenhagen, Madrid, Paris'); ?></option>
                                        <option value="Africa/Algiers" <?php if($msfb_timezone == "Africa/Algiers") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) West Central Africa'); ?></option>
                                        <option value="Africa/Windhoek" <?php if($msfb_timezone == "Africa/Windhoek") echo 'selected="selected"' ?> ><?php _e('(GMT+01:00) Windhoek'); ?></option>
                                        <option value="Asia/Beirut" <?php if($msfb_timezone == "Asia/Beirut") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Beirut'); ?></option>
                                        <option value="Africa/Cairo" <?php if($msfb_timezone == "Africa/Cairo") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Cairo'); ?></option>
                                        <option value="Asia/Gaza" <?php if($msfb_timezone == "Asia/Gaza") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Gaza'); ?></option>
                                        <option value="Africa/Blantyre" <?php if($msfb_timezone == "Africa/Blantyre") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Harare, Pretoria'); ?></option>
                                        <option value="Asia/Jerusalem" <?php if($msfb_timezone == "Asia/Jerusalem") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Jerusalem'); ?></option>
                                        <option value="Europe/Minsk" <?php if($msfb_timezone == "Europe/Minsk") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Minsk'); ?></option>
                                        <option value="Asia/Damascus" <?php if($msfb_timezone == "Asia/Damascus") echo 'selected="selected"' ?> ><?php _e('(GMT+02:00) Syria'); ?></option>
                                        <option value="Europe/Moscow" <?php if($msfb_timezone == "Europe/Moscow") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Moscow, St. Petersburg, Volgograd'); ?></option>
                                        <option value="Africa/Addis_Ababa" <?php if($msfb_timezone == "Africa/Addis_Ababa") echo 'selected="selected"' ?> ><?php _e('(GMT+03:00) Nairobi'); ?></option>
                                        <option value="Asia/Tehran" <?php if($msfb_timezone == "Asia/Tehran") echo 'selected="selected"' ?> ><?php _e('(GMT+03:30) Tehran'); ?></option>
                                        <option value="Asia/Dubai" <?php if($msfb_timezone == "Asia/Dubai") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Abu Dhabi, Muscat'); ?></option>
                                        <option value="Asia/Yerevan" <?php if($msfb_timezone == "Asia/Yerevan") echo 'selected="selected"' ?> ><?php _e('(GMT+04:00) Yerevan'); ?></option>
                                        <option value="Asia/Kabul" <?php if($msfb_timezone == "Asia/Kabul") echo 'selected="selected"' ?> ><?php _e('(GMT+04:30) Kabul'); ?></option>
                                        <option value="Asia/Yekaterinburg" <?php if($msfb_timezone == "Asia/Yekaterinburg") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Ekaterinburg'); ?></option>
                                        <option value="Asia/Tashkent" <?php if($msfb_timezone == "Asia/Tashkent") echo 'selected="selected"' ?> ><?php _e('(GMT+05:00) Tashkent'); ?></option>
                                        <option value="Asia/Kolkata" <?php if($msfb_timezone == "Asia/Kolkata") echo 'selected="selected"' ?> ><?php _e('(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi'); ?></option>
                                        <option value="Asia/Katmandu" <?php if($msfb_timezone == "Asia/Katmandu") echo 'selected="selected"' ?> ><?php _e('(GMT+05:45) Kathmandu'); ?></option>
                                        <option value="Asia/Dhaka" <?php if($msfb_timezone == "Asia/Dhaka") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Astana, Dhaka'); ?></option>
                                        <option value="Asia/Novosibirsk" <?php if($msfb_timezone == "Asia/Novosibirsk") echo 'selected="selected"' ?> ><?php _e('(GMT+06:00) Novosibirsk'); ?></option>
                                        <option value="Asia/Rangoon" <?php if($msfb_timezone == "Asia/Rangoon") echo 'selected="selected"' ?> ><?php _e('(GMT+06:30) Yangon (Rangoon)'); ?></option>
                                        <option value="Asia/Bangkok" <?php if($msfb_timezone == "Asia/Bangkok") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Bangkok, Hanoi, Jakarta'); ?></option>
                                        <option value="Asia/Krasnoyarsk" <?php if($msfb_timezone == "Asia/Krasnoyarsk") echo 'selected="selected"' ?> ><?php _e('(GMT+07:00) Krasnoyarsk'); ?></option>
                                        <option value="Asia/Hong_Kong" <?php if($msfb_timezone == "Asia/Hong_Kong") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi'); ?></option>
                                        <option value="Asia/Irkutsk" <?php if($msfb_timezone == "Asia/Irkutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Irkutsk, Ulaan Bataar'); ?></option>
                                        <option value="Australia/Perth" <?php if($msfb_timezone == "Australia/Perth") echo 'selected="selected"' ?> ><?php _e('(GMT+08:00) Perth'); ?></option>
                                        <option value="Australia/Eucla" <?php if($msfb_timezone == "Australia/Eucla") echo 'selected="selected"' ?> ><?php _e('(GMT+08:45) Eucla'); ?></option>
                                        <option value="Asia/Tokyo" <?php if($msfb_timezone == "Asia/Tokyo") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Osaka, Sapporo, Tokyo'); ?></option>
                                        <option value="Asia/Seoul" <?php if($msfb_timezone == "Asia/Seoul") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Seoul'); ?></option>
                                        <option value="Asia/Yakutsk" <?php if($msfb_timezone == "Asia/Yakutsk") echo 'selected="selected"' ?> ><?php _e('(GMT+09:00) Yakutsk'); ?></option>
                                        <option value="Australia/Adelaide" <?php if($msfb_timezone == "Australia/Adelaide") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Adelaide'); ?></option>
                                        <option value="Australia/Darwin" <?php if($msfb_timezone == "Australia/Darwin") echo 'selected="selected"' ?> ><?php _e('(GMT+09:30) Darwin'); ?></option>
                                        <option value="Australia/Brisbane" <?php if($msfb_timezone == "Australia/Brisbane") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Brisbane'); ?></option>
                                        <option value="Australia/Hobart" <?php if($msfb_timezone == "Australia/Hobart") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Hobart'); ?></option>
                                        <option value="Asia/Vladivostok" <?php if($msfb_timezone == "Asia/Vladivostok") echo 'selected="selected"' ?> ><?php _e('(GMT+10:00) Vladivostok'); ?></option>
                                        <option value="Australia/Lord_Howe" <?php if($msfb_timezone == "Australia/Lord_Howe") echo 'selected="selected"' ?> ><?php _e('(GMT+10:30) Lord Howe Island'); ?></option>
                                        <option value="Etc/GMT-11" <?php if($msfb_timezone == "Etc/GMT-11") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Solomon Is., New Caledonia'); ?></option>
                                        <option value="Asia/Magadan" <?php if($msfb_timezone == "Asia/Magadan") echo 'selected="selected"' ?> ><?php _e('(GMT+11:00) Magadan'); ?></option>
                                        <option value="Pacific/Norfolk" <?php if($msfb_timezone == "Pacific/Norfolk") echo 'selected="selected"' ?> ><?php _e('(GMT+11:30) Norfolk Island'); ?></option>
                                        <option value="Asia/Anadyr" <?php if($msfb_timezone == "Asia/Anadyr") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Anadyr, Kamchatka'); ?></option>
                                        <option value="Pacific/Auckland" <?php if($msfb_timezone == "Pacific/Auckland") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Auckland, Wellington'); ?></option>
                                        <option value="Etc/GMT-12" <?php if($msfb_timezone == "Etc/GMT-12") echo 'selected="selected"' ?> ><?php _e('(GMT+12:00) Fiji, Kamchatka, Marshall Is.'); ?></option>
                                        <option value="Pacific/Chatham" <?php if($msfb_timezone == "Pacific/Chatham") echo 'selected="selected"' ?> ><?php _e('(GMT+12:45) Chatham Islands'); ?></option>
                                        <option value="Pacific/Tongatapu" <?php if($msfb_timezone == "Pacific/Tongatapu") echo 'selected="selected"' ?> ><?php _e('(GMT+13:00) Nuku\'alofa'); ?></option>
                                        <option value="Pacific/Kiritimati" <?php if($msfb_timezone == "Pacific/Kiritimati") echo 'selected="selected"' ?> ><?php _e('(GMT+14:00) Kiritimati'); ?></option>
                                    </select>
		  </div></div>
		    <div class="control-group">  
            <label class="control-label" for="msfb_showborder">Show outer border</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input type="checkbox" <?php echo esc_attr_e($msfb_showborder); ?> name="msfb_showborder" id="msfb_showborder" value="enabled" />  
              </label>  
            </div>  
          </div>          
		  									               
          <div class="form-actions"> 
  		   <input type="hidden" name="msfb_active_tab" value="1" /> 
            <input type="submit" name="submit" class="btn btn-primary" value="Update"/>   
          </div>  
        </fieldset>  
</form>  
  
</div>  
<div id="ms_2nd_tab" <?php echo $active2; ?>>  
<form method="post" name="color_options" action="" class="form-horizontal">  
        <fieldset>  
          <legend>Color Settings</legend>
          <div class="control-group">  
            <label class="control-label" for="msfb_postcolor">Post color of wall (#333333...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_postcolor" value="<?php echo esc_attr_e($msfb_postcolor); ?>" id="msfb_postcolor" />
			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div>  
          <div class="control-group">  
            <label class="control-label" for="msfb_backcolor">Background color of wall (#ffffff...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_backcolor" value="<?php echo esc_attr_e($msfb_backcolor); ?>" id="msfb_backcolor" />
						 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div> 		 
		  
		  <div class="control-group">  
            <label class="control-label" for="msfb_postbordercolor">Post border color(#E6E8E8...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_postbordercolor" value="<?php echo esc_attr_e($msfb_postbordercolor); ?>" id="msfb_postbordercolor" />			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div> 
		  <div class="control-group">  
            <label class="control-label" for="msfb_linkcolor">All links color(#3B5998...)</label>  
            <div class="controls">  
			 <input type="text" class="input-xlarge" name="msfb_linkcolor" value="<?php echo esc_attr_e($msfb_linkcolor); ?>" id="msfb_linkcolor" />			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div> 
		  <div class="control-group">  
            <label class="control-label" for="msfb_datecolor">Date color(#777...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_datecolor" value="<?php echo esc_attr_e($msfb_datecolor); ?>" id="msfb_datecolor" />			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div> 			  
		  
		  									               
          <div class="form-actions"> 
  		   <input type="hidden" name="msfb_active_tab" value="2" />
            <input type="submit" name="submit" class="btn btn-primary" value="Update"/>  
          </div>  
        </fieldset>  
</form>  
</div> 

<div id="ms_fourth_tab"  <?php echo $active4; ?>>
<div class="well">  
<h4><a target="_blank" href="http://extensions.programminghelp24.com/wordpress/facebook-wall-pro">upgrade to pro version for following facebook social plugins using shortcodes</a></h4>
1.Facebook like button<br/><br />
2.Facebook comments<br /><br />
3.Facebook follow button<br /><br />
</div>  
</div>
 
<div id="ms_fifth_tab"  <?php echo $active5; ?>>
<form method="post" name="system_options" action="" class="form-horizontal">  
        <fieldset>  
          <legend>System requirements</legend>
          <div class="control-group">  
           <label class="control-label" for="msfb_followwidth">To get feed some of these functions should be enabled in server</label>
            <div class="controls"> 
               Server & php info:&nbsp;&nbsp; <?php echo $_SERVER['SERVER_SOFTWARE']?><br/><br/>                
			   Is cURL enabled:&nbsp;&nbsp;<input type="checkbox" <?php if(is_callable('curl_init')) echo "checked"; ?> disabled value="enabled" /><br/><br/>
			   Is url fopen enabled:&nbsp;&nbsp;<input type="checkbox" <?php if(ini_get( 'allow_url_fopen' )) echo "checked"; ?> disabled value="enabled" /><br/><br/>
			   Is Json enabled:&nbsp;<input type="checkbox" <?php if(function_exists("json_decode")) echo "checked"; ?> disabled value="enabled" /><br/><br/>			 	 
            </div>  
          </div> 
          <div>              
           * If either cUrl or allow_url_fopen(fopen) enabled, it's ok. If both of them disabled, ask your hosting to enable it or if you own your server it's easy to do.<br/>
           Also without these, it may still work by the fallback method. But if feed do not load after all, contact us, if needed we send you previous javascript version <br/>
           which not depends on the availability of above methods.<br/><br/>
           * Json should be enabled(checked), but in any case it's disabled ask your host to enable it
                         
		  </div>
		  		   		 		 		  								               
          <!-- <div class="form-actions"> 
  		   <input type="hidden" name="msfb_active_tab" value="3" />		             				 
            <input type="submit" name="submit" class="btn btn-primary" value="Update"/>  
          </div>   -->
        </fieldset>  
</form>  
</div>

</div>  
</div><hr/>  

<div class="row-fluid">
<div class="well" style="color: navy">
Please check <b>"System requirements"</b> tab above to know if your server has required methods enabled to display the content of the facebook feed <br/>
using facebook Graph API call. For other requirements and identify errors if any view <a target="_blank" href="http://extensions.programminghelp24.com/facebook_wall_documentation_wordpress.htm">Documentation</a> 
</div> 

<div class="well">
<h4>how to display feed</h4> 
copy and paste this short code anywhere of page or post - <strong>[mitsol_fbwall_feed_short_code]</strong> <br/><br/>
To override common settings include parameters as follows - <strong>[mitsol_fbwall_feed_short_code id="mitsol12" num="30"]</strong> <br/><br/>

</div>

<div class="well">
<a class="btn btn-info" target="_blank" style="font-weight:bold;" href="http://extensions.programminghelp24.com/wordpress/facebook-wall-pro">Click to Buy pro version now for a complete feed display for your website</a><br/><br/>
1.<strong>Display photo, video, links, event posts effectively, currently free version only shows textual/status posts</strong><br/><br/>
2.Get more features and settings for choosing type of posts, various picture sizes, header display, like button display, number of likes, all comments with paging, more color options,nice scrolling,responsiveness others<br/><br/>
3.Add popular facebook plugins - like button, comments, follow button anywhere in the pages, posts using short codes<br/><br/>

<strong>View pro version demo for all the features here - <a class="btn btn-info" target="_blank" href="http://wordpress.programminghelp24.com/facebook-wall-pro/">Pro Demo</a></strong>

</div>

</div>
 
 </div>
 <?php  }