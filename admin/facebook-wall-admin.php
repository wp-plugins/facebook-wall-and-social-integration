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
    //include MY_PLUGIN_DIR . '/pages/myplugin_simple_admin_page.php';	
	
    $msfb_fbid = (get_option('msfb_fbid') != '') ? get_option('msfb_fbid') : 'joomla';
    $msfb_accesstoken = (get_option('msfb_accesstoken') != '') ? get_option('msfb_accesstoken') : '';
    $msfb_toplikebox  = (get_option('msfb_toplikebox') == 'enabled') ? 'checked' : '' ;
    $msfb_likeboxid = (get_option('msfb_likeboxid') != '') ? get_option('msfb_likeboxid') : 'joomla'; 	
	$msfb_likeverblike = (get_option('msfb_likeboxverb') == 'like') ? 'selected' : '';
    $msfb_likeverbrecommend = (get_option('msfb_likeboxverb') == 'recommend') ? 'selected' : '';		
    $msfb_likeboxlanguage = (get_option('msfb_likeboxlanguage') != '') ? get_option('msfb_likeboxlanguage') : 'en_GB';
	$msfb_facebookwidth = (get_option('msfb_facebookwidth') != '') ? get_option('msfb_facebookwidth') : '550';
	$msfb_heightoptionfixed = (get_option('msfb_heightoption') == 'fixed') ? 'selected' : '';
    $msfb_heightoptionsize = (get_option('msfb_heightoption') == 'size of posts') ? 'selected' : '';
	$msfb_facebookheight = (get_option('msfb_facebookheight') != '') ? get_option('msfb_facebookheight') : '550';
	
    $msfb_header  = (get_option('msfb_header') == 'enabled') ? 'checked' : '' ;	
    $msfb_comments  = (get_option('msfb_comments') == 'enabled') ? 'checked' : '' ;
	$msfb_showcomments_type_page = (get_option('msfb_showcomments_type') == 'Show comments paging') ? 'selected' : '';
    $msfb_showcomments_type_all = (get_option('msfb_showcomments_type') == 'Show all comments') ? 'selected' : '';
    $msfb_postlikebutton  = (get_option('msfb_postlikebutton') == 'enabled') ? 'checked' : '' ;	
    //$msfb_postcommentbutton  = (get_option('msfb_postcommentbutton') == 'enabled') ? 'checked' : '' ;	
    $msfb_postnum = (get_option('msfb_postnum') != '') ? get_option('msfb_postnum') : '30'; 
    $msfb_guestentries = (get_option('msfb_guestentries') == 'enabled') ? 'checked' : '' ;	
	
    $msfb_showdate = (get_option('msfb_showdate') == 'enabled') ? 'checked' : '' ;	
	$msfb_dateformat_us = (get_option('msfb_dateformat') == 'us') ? 'selected' : '';
    $msfb_dateformat_nonus = (get_option('msfb_dateformat') == 'nonus') ? 'selected' : '';
    $msfb_showborder = (get_option('msfb_showborder') == 'enabled') ? 'checked' : '' ;
	
	$msfb_postcolor = (get_option('msfb_postcolor') != '') ? get_option('msfb_postcolor') : '#333333'; 	
	$msfb_backcolor = (get_option('msfb_backcolor') != '') ? get_option('msfb_backcolor') : '#ffffff'; 	
	$msfb_colorcom = (get_option('msfb_colorcom') != '') ? get_option('msfb_colorcom') : '#333333'; 	
	$msfb_backcolorcom = (get_option('msfb_backcolorcom') != '') ? get_option('msfb_backcolorcom') : '#EDEFF4'; 	
	$msfb_postbordercolor = (get_option('msfb_postbordercolor') != '') ? get_option('msfb_postbordercolor') : '#F0F0F0'; 	
	$msfb_linkcolor = (get_option('msfb_linkcolor') != '') ? get_option('msfb_linkcolor') : '#3B5998'; 	
	$msfb_datecolor = (get_option('msfb_datecolor') != '') ? get_option('msfb_datecolor') : '#777'; 
	$msfb_postlikebgcolor = (get_option('msfb_postlikebgcolor') != '') ? get_option('msfb_postlikebgcolor') : '#EDEFF4'; 
	$msfb_postlikeseccolor = (get_option('msfb_postlikeseccolor') != '') ? get_option('msfb_postlikeseccolor') : '#333333'; 
	$msfb_postlikenumccolor = (get_option('msfb_postlikenumccolor') != '') ? get_option('msfb_postlikenumccolor') : '#3B5998'; 	
	if(isset($_REQUEST["settings-updated"])) { if($_REQUEST["settings-updated"] == "true")
	{ 
	    $msfb_success_error='<div class="alert alert-success">  
        <a class="close" data-dismiss="alert">x</a>  
        <strong>Success!</strong> Settings saved
        </div>';
	} else { $msfb_success_error='<div class="alert alert-error">  
        <a class="close" data-dismiss="alert">x</a>  
        <strong>Error!</strong> something went wrong  
        </div>'; } }		 	
	
   (!isset($_REQUEST["settings-updated"])) ? $msfb_active_tab="1": $msfb_active_tab = get_option('msfb_active_tab');

    if($msfb_active_tab =="1"){ $active2='style="display:none;"'; $active=""; $activetab='class="active"'; $activetab2=''; }
    if($msfb_active_tab =="2"){ $active='style="display:none;"'; $active2=""; $activetab2='class="active"'; $activetab=''; }

    $html = '<div class="msmain_container" style="margin-top:10px;">	
<script type="text/javascript">		
var ms_js = jQuery.noConflict();  	
ms_js(function(){		 	
  ms_js("#ms_2nd_tablink").click(function() {
     ms_js("#ms_2nd_tab").show(); 
	 ms_js("#ms_1st_tab").hide(); 
	 ms_js("#ms_third_tab").hide();	
	  
  	 ms_js("#ms_2nd_list").addClass("active"); 	 
	 ms_js("#ms_1st_list").removeClass("active");
  	 ms_js("#ms_third_list").removeClass("active"); 
  });
 ms_js("#ms_1st_tablink").click(function() {
     ms_js("#ms_1st_tab").show(); 
	 ms_js("#ms_2nd_tab").hide(); 
	 ms_js("#ms_third_tab").hide();	 	
	  
  	 ms_js("#ms_1st_list").addClass("active"); 	 
	 ms_js("#ms_2nd_list").removeClass("active");
  	 ms_js("#ms_third_list").removeClass("active"); 
  });
   ms_js("#ms_third_tablink").click(function() {
     ms_js("#ms_1st_tab").hide(); 
	 ms_js("#ms_2nd_tab").hide(); 
	 ms_js("#ms_third_tab").show();	 	
	  
  	 ms_js("#ms_1st_list").removeClass("active"); 	 
	 ms_js("#ms_2nd_list").removeClass("active");
  	 ms_js("#ms_third_list").addClass("active"); 
  });
  ms_js(".msmain_container .close").click( function() {
    ms_js(this).parent("div").hide();
  });
});		   	
</script>

<div class="container-fluid">  
<div class="row-fluid">  
<div class="span12">'. $msfb_success_error .' 
<ul class="nav nav-tabs">  		 
<li id="ms_1st_list" style="cursor:pointer; cursor:hand" '.$activetab.'><a id="ms_1st_tablink">General</a></li>  
<li id="ms_2nd_list" style="cursor:pointer; cursor:hand" '.$activetab2.'><a id="ms_2nd_tablink">Colors</a></li>  
<li id="ms_third_list" style="cursor:pointer; cursor:hand"><a id="ms_third_tablink">Facebook social plugins</a></li>  
</ul>
<div id="ms_1st_tab" '.$active.'> 
<form method="post" name="options" action="options.php" class="form-horizontal">  
        <fieldset>  
          <legend>General settings</legend>  ' . wp_nonce_field('update-options') . '
          <div class="control-group">  
            <label class="control-label" for="msfb_fbid">Facebook ID</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_fbid" value="' . $msfb_fbid . '" id="msfb_fbid" />
			<p class="help-block"><a target="_blank" href="http://extensions.programminghelp24.com/facebook_wall_documentation_wordpress.htm">read doc</a> or <a target="_blank" href="http://wordpress.org/plugins/facebook-wall-and-social-integration/faq/">plugin faq</a> to get facebook page/group/profile id</p> 
            </div>  
          </div>  
		  <div class="control-group">  
            <label class="control-label" for="msfb_accesstoken">Access token</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_accesstoken" value="' . $msfb_accesstoken . '" id="msfb_accesstoken" />
               <p class="help-block"><a target="_blank" href="http://extensions.programminghelp24.com/access-token-wp">token generation link</a> (for this create facebook application first and configure<br/> application basic setting correctly, written in the <a target="_blank" href="http://extensions.programminghelp24.com/facebook_wall_documentation_wordpress.htm">doc here</a>)</p> 
            </div>  
          </div>  		  
		   <div class="control-group">  
            <label class="control-label" for="msfb_facebookwidth">Width</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_facebookwidth" value="' . $msfb_facebookwidth . '" id="msfb_facebookwidth" />
            </div>  
          </div>  		 		  		        
		  <div class="control-group">  
            <label class="control-label" for="msfb_facebookheight">Height(fixed)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_facebookheight" value="' . $msfb_facebookheight . '" id="msfb_facebookheight" />                        
            </div>  
          </div> 		  		 
		   <div class="control-group">  
            <label class="control-label" for="msfb_postlikebutton">Show post like button</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input  type="checkbox" '.$msfb_postlikebutton.' name="msfb_postlikebutton" id="msfb_postlikebutton" value="enabled" />   
              </label>  
            </div>  
          </div>
<!--		  <div class="control-group">  
            <label class="control-label" for="msfb_postcommentbutton">Show post comment button</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input type="checkbox" '.$msfb_postcommentbutton.' name="msfb_postcommentbutton" id="msfb_postcommentbutton" value="enabled" />  
              </label>  
            </div>  
          </div> -->
		  <div class="control-group">  
            <label class="control-label" for="msfb_postnum">Show number of posts</label>  
            <div class="controls">  
			<input type="text"  class="input-xlarge" name="msfb_postnum" value="' . $msfb_postnum . '" id="msfb_postnum" />
            </div>  
          </div>
		  <div class="control-group">  
            <label class="control-label" for="msfb_guestentries">Show guest entries</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input type="checkbox" '.$msfb_guestentries.' name="msfb_guestentries" id="msfb_guestentries" value="enabled" />  
              </label>  
            </div>  
          </div>   
		    <div class="control-group">  
            <label class="control-label" for="msfb_showdate">Show Date</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input type="checkbox" '.$msfb_showdate.' name="msfb_showdate" id="msfb_showdate" value="enabled" />  
              </label>  
            </div>  
          </div> 
		  <div class="control-group">  
            <label class="control-label" for="msfb_dateformat">Date format</label>  
            <div class="controls">  
              <select id="msfb_dateformat" name="msfb_dateformat">  
                 <option value="us" ' . $msfb_dateformat_us . '>us</option>
                 <option value="nonus" '.$msfb_dateformat_nonus .'>non us</option></select>
            </div>  
          </div>
		  
		    <div class="control-group">  
            <label class="control-label" for="msfb_showborder">Show outer border</label>  
            <div class="controls">  
              <label class="checkbox">  
                <input type="checkbox" '.$msfb_showborder.' name="msfb_showborder" id="msfb_showborder" value="enabled" />  
              </label>  
            </div>  
          </div> 
		  <hr/>
		  <div><a target="_blank" href="http://extensions.programminghelp24.com/wordpress/facebook-wall-pro">Upgrade to pro version for more settings</a></div>
		  									               
          <div class="form-actions"> 
  		   <input type="hidden" name="msfb_active_tab" value="1" />  
		   <input type="hidden" name="action" value="update" />  
           <input type="hidden" name="page_options" value="msfb_fbid,msfb_accesstoken,msfb_toplikebox,msfb_likeboxid,msfb_likeboxverb,msfb_likeboxlanguage,msfb_facebookwidth,msfb_heightoption,msfb_facebookheight,msfb_header,msfb_comments ,msfb_showcomments_type,msfb_postlikebutton,msfb_postcommentbutton,msfb_postnum,msfb_guestentries,msfb_showdate,msfb_dateformat,msfb_showborder,msfb_active_tab" />                 				 
            <input type="submit" name="submit" class="btn btn-primary" value="Update"/>  
            <input type="button" class="btn" value="Cancel"/>  
          </div>  
        </fieldset>  
</form>  
  
</div>  
<div id="ms_2nd_tab" '.$active2.'>  
<form method="post" name="options" action="options.php" class="form-horizontal">  
        <fieldset>  
          <legend>Color Settings</legend>  ' . wp_nonce_field('update-options') . '
          <div class="control-group">  
            <label class="control-label" for="msfb_postcolor">Post color of wall (#333333...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_postcolor" value="' . $msfb_postcolor . '" id="msfb_postcolor" />
			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div>  
          <div class="control-group">  
            <label class="control-label" for="msfb_backcolor">Background color of wall (#ffffff...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_backcolor" value="' . $msfb_backcolor . '" id="msfb_backcolor" />
						 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div> 		 
		  <div class="control-group">  
            <label class="control-label" for="msfb_postbordercolor">Post border color(#E6E8E8...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_postbordercolor" value="' . $msfb_postbordercolor . '" id="msfb_postbordercolor" />			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div> 
		  <div class="control-group">  
            <label class="control-label" for="msfb_linkcolor">All links color(#3B5998...)</label>  
            <div class="controls">  
			 <input type="text" class="input-xlarge" name="msfb_linkcolor" value="' . $msfb_linkcolor . '" id="msfb_linkcolor" />			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>  
          </div> 
		  <div class="control-group">  
            <label class="control-label" for="msfb_datecolor">Date color(#777...)</label>  
            <div class="controls">  
			<input type="text" class="input-xlarge" name="msfb_datecolor" value="' . $msfb_datecolor. '" id="msfb_datecolor" />			 <p class="help-block"><a href="http://www.colorpicker.com/" target="_blank">Ex. #EG9A10 color picker</a></p>  
            </div>			  
          </div> 		
		  
		  									               
          <div class="form-actions"> 
  		   <input type="hidden" name="msfb_active_tab" value="2" />
		   <input type="hidden" name="action" value="update" />  
           <input type="hidden" name="page_options" value="msfb_postcolor,msfb_backcolor,msfb_colorcom,msfb_backcolorcom,msfb_postbordercolor,msfb_linkcolor,msfb_datecolor,msfb_postlikebgcolor,msfb_postlikeseccolor,msfb_postlikenumccolor,msfb_active_tab" />                 				 
            <input type="submit" name="submit" class="btn btn-primary" value="Update"/>  
            <input type="button" class="btn" value="Cancel"/>  
          </div>  
        </fieldset>  
</form>  
</div>  
<div id="ms_third_tab" style="display:none;">
<div class="well">  
<h4><a target="_blank" href="http://extensions.programminghelp24.com/wordpress/facebook-wall-pro">upgrade to pro version for following facebook social plugins using shortcodes</a></h4>
1.Facebook like button<br/><br />
2.Facebook comments<br /><br />
3.Facebook follow button<br /><br />
</div>
</div>  
</div>  
</div></div> 
<div class="row-fluid"> 

<div class="well">
<h4>how to display feed</h4> 
copy and paste this short code anywhere of page or post - <strong>[mitsol_fbwall_feed_short_code]</strong> <br/><br/>
To override common settings include parameters as follows - <strong>[mitsol_fbwall_feed_short_code id="mitsol12" num="30"]</strong> <br/><br/>

</div>

<div class="row-fluid"> 

<div class="well">
<a class="btn btn-info" target="_blank" style="font-weight:bold;" href="http://extensions.programminghelp24.com/wordpress/facebook-wall-pro">Click to Buy pro version now for a complete feed display for your business/personal website</a><br/><br/>
1.<strong>Display photo, video, links, event posts effectively, currently free version only shows textual/status posts</strong><br/><br/>
2.Get more features and settings for header display, like button display, number of likes, all comments with paging, more color options,nice scrolling, others<br/><br/>
3.Add popular facebook plugins - like button, comments, follow button anywhere in the pages, posts using short codes<br/><br/>

<strong>View pro version demo for all the features here - <a class="btn btn-info" target="_blank" href="http://wordpress.programminghelp24.com/facebook-wall-pro/">Pro Demo</a></strong>

</div>
 </div>';

    echo $html;
}