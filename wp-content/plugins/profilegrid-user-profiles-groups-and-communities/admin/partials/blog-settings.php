<?php
$dbhandler = new PM_DBhandler;
$textdomain = $this->profile_magic;
$pmrequests = new PM_request;
$path =  plugin_dir_url(__FILE__);
$identifier = 'SETTINGS';
if(filter_input(INPUT_POST,'submit_settings'))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_blog_settings' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
	$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
	if(!isset($_POST['pm_blog_editor'])) $_POST['pm_blog_editor'] = 0;
        if(!isset($_POST['pm_blog_feature_image'])) $_POST['pm_blog_feature_image'] = 0;
        if(!isset($_POST['pm_blog_tags'])) $_POST['pm_blog_tags'] = 0;
        if(!isset($_POST['pm_blog_privacy_level'])) $_POST['pm_blog_privacy_level'] = 0;
        if(!isset($_POST['pm_enable_blog'])) $_POST['pm_enable_blog'] = 0;
        if(!isset($_POST['pm_blog_notification_user'])) $_POST['pm_blog_notification_user'] = 0;
        if(!isset($_POST['pm_blog_notification_admin'])) $_POST['pm_blog_notification_admin'] = 0;
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	if($post!=false)
	{
		foreach($post as $key=>$value)
		{
			$dbhandler->update_global_option_value($key,$value);
		}
	}
	
	wp_redirect( esc_url_raw('admin.php?page=pm_settings') );exit;
}
?>

<div class="uimagic">
  <form name="pm_user_settings" id="pm_user_settings" method="post">
    <!-----Dialogue Box Starts----->
    <div class="content">
      <div class="uimheader">
        <?php _e( 'Blog Settings','profilegrid-user-profiles-groups-and-communities' ); ?>
      </div>
     
      <div class="uimsubheader">
        <?php
		//Show subheadings or message or notice
		?>
      </div>
    
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Enable Blog','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_enable_blog" id="pm_enable_blog" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_enable_blog','1'),'1'); ?> class="pm_toggle" value="1" style="display:none;" onClick="pm_show_hide(this,'pm_blog_html')" />
          <label for="pm_enable_blog"></label>
        </div>
        <div class="uimnote"><?php _e("Turn on social blogging for your users. Make sure you have a page with User Blog shortcode for users to submit posts.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
    <div class="childfieldsrow" id="pm_blog_html" style=" <?php  if($dbhandler->get_global_option_value('pm_enable_blog','1')==1){echo 'display:block;';} else { echo 'display:none;';} ?>">  
        <div class="uimrow">
            <div class="uimfield">
              <?php _e( 'Fetch Posts From','profilegrid-user-profiles-groups-and-communities' ); ?>
            </div>
            <div class="uiminput">
              <select name="pm_blog_post_from" id="pm_blog_post_from">
                <option value="profilegrid_blogs" <?php selected($dbhandler->get_global_option_value('pm_blog_post_from','both'),'profilegrid_blogs'); ?>><?php _e('User Blogs','profilegrid-user-profiles-groups-and-communities');?> </option>
                <option value="post" <?php selected($dbhandler->get_global_option_value('pm_blog_post_from','both'),'post'); ?>><?php _e('Posts','profilegrid-user-profiles-groups-and-communities');?> </option>
                <option value="both" <?php selected($dbhandler->get_global_option_value('pm_blog_post_from','both'),'both'); ?>><?php _e('Both','profilegrid-user-profiles-groups-and-communities');?> </option>
              </select>
            </div>
            <div class="uimnote"><?php _e('Select from where you wish to fetch user authored posts. You can use WordPress default Posts, ProfileGrid User Posts system or a combination of both.','profilegrid-user-profiles-groups-and-communities');?></div>
         </div>
        
        <div class="uimrow">
            <div class="uimfield">
              <?php _e( 'Default Blog post Status','profilegrid-user-profiles-groups-and-communities' ); ?>
            </div>
            <div class="uiminput">
              <select name="pm_blog_status" id="pm_blog_status">
                <option value="publish" <?php selected($dbhandler->get_global_option_value('pm_blog_status','pending'),'publish'); ?>><?php _e('Published','profilegrid-user-profiles-groups-and-communities');?> </option>
                <option value="pending" <?php selected($dbhandler->get_global_option_value('pm_blog_status','pending'),'pending'); ?>><?php _e('Pending','profilegrid-user-profiles-groups-and-communities');?> </option>
                <option value="draft" <?php selected($dbhandler->get_global_option_value('pm_blog_status','pending'),'draft'); ?>><?php _e('Draft','profilegrid-user-profiles-groups-and-communities');?> </option>
              </select>
            </div>
            <div class="uimnote"><?php _e('Status of the blog post after user submits it. You can allow it to be automatically approved or save it as Pending for moderation.','profilegrid-user-profiles-groups-and-communities');?></div>
         </div>
      
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Feature Image','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_blog_feature_image" id="pm_blog_feature_image" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_blog_feature_image','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_blog_feature_image"></label>
        </div>
        <div class="uimnote"><?php _e("Turn on to allow users to add featured image to their post. A featured image is displayed prominently above the blog post.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Tags','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_blog_tags" id="pm_blog_tags" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_blog_tags','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_blog_tags"></label>
        </div>
        <div class="uimnote"><?php _e("Turn on to allow users to add tags to their posts.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Use Tinymce Editor','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_blog_editor" id="pm_blog_editor" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_blog_editor','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_blog_editor"></label>
        </div>
        <div class="uimnote"><?php _e("Turn it on to allow users to use WordPress' rich text editor for post formatting. Keep it off if you only wish to allow users to post content in plain text.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Enable content Privacy','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_blog_privacy_level" id="pm_blog_privacy_level" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_blog_privacy_level','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_blog_privacy_level"></label>
        </div>
        <div class="uimnote"><?php _e("Turning this on will ask users to set privacy level for their blog post while submitting it.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Notify Users','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_blog_notification_user" id="pm_blog_notification_user" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_blog_notification_user','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_blog_notification_user"></label>
        </div>
        <div class="uimnote"><?php _e("Send an email notifying users when their blog post is published successfully",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Notify Admin','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_blog_notification_admin" id="pm_blog_notification_admin" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_blog_notification_admin','0'),'1'); ?> class="pm_toggle" value="1" style="display:none;" />
          <label for="pm_blog_notification_admin"></label>
        </div>
        <div class="uimnote"><?php _e("Send an email notifying admin when a user submits new blog post.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
    </div>
      <div class="buttonarea"> 
          <a href="admin.php?page=pm_settings">
        <div class="cancel">&#8592; &nbsp;
          <?php _e('Cancel','profilegrid-user-profiles-groups-and-communities');?>
        </div>
        </a>
        <?php wp_nonce_field('save_blog_settings'); ?>
        <input type="submit" value="<?php _e('Save','profilegrid-user-profiles-groups-and-communities');?>" name="submit_settings" id="submit_settings" />
        <div class="all_error_text" style="display:none;"></div>
      </div>
    </div>
   
  </form>
</div>
