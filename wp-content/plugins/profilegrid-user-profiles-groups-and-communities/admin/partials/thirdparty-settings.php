<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$identifier = 'SETTINGS';
if(filter_input(INPUT_POST,'submit_settings'))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_third_party_settings' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
	$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	if($post!=false)
	{
		if(!isset($post['pm_enable_facebook_login'])) $post['pm_enable_facebook_login'] = 0;
		foreach($post as $key=>$value)
		{
			$dbhandler->update_global_option_value($key,$value);
		}
	}
	
	wp_redirect( esc_url_raw('admin.php?page=pm_settings') );exit;
}
?>

<div class="uimagic">
  <form name="pm_security_settings" id="pm_security_settings" method="post">
    <!-----Dialogue Box Starts----->
    <div class="content">
      <div class="uimheader">
        <?php _e( 'Third Party Integrations','profilegrid-user-profiles-groups-and-communities' ); ?>
      </div>
     
      <div class="uimsubheader">
        <?php
		//Show subheadings or message or notice
		?>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Allow User to Login using Facebook:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
           <input name="pm_enable_facebook_login" id="pm_enable_facebook_login" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_enable_facebook_login'),'1'); ?> class="pm_toggle" value="1" style="display:none;"  onClick="pm_show_hide(this,'enable_facebook_login_html')" />
          <label for="pm_enable_facebook_login"></label>
        </div>
        <div class="uimnote"><?php _e("For your reference only. Not visible on front-end. Description can help you remember the purpose of the form.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      <div class="childfieldsrow" id="enable_facebook_login_html" style=" <?php if($dbhandler->get_global_option_value('pm_enable_facebook_login',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
      

      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('Facebook App ID','profilegrid-user-profiles-groups-and-communities');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_facebook_app_id" id="pm_facebook_app_id" value="<?php echo $dbhandler->get_global_option_value('pm_facebook_app_id');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote">&nbsp;</div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('Facebook App Secret','profilegrid-user-profiles-groups-and-communities');?>
        </div>
        <div class="uiminput">
          <input type="text" name="pm_facebook_app_secret" id="pm_facebook_app_secret" value="<?php echo $dbhandler->get_global_option_value('pm_facebook_app_secret');?>">
          <div class="errortext"></div>
        </div>
        <div class="uimnote">&nbsp;</div>
      </div>
      
      
      </div>
     
      <div class="buttonarea"> <a href="admin.php?page=pm_settings">
        <div class="cancel">&#8592; &nbsp;
          <?php _e('Cancel','profilegrid-user-profiles-groups-and-communities');?>
        </div>
        </a>
        <?php wp_nonce_field('save_third_party_settings'); ?>
        <input type="submit" value="<?php _e('Save','profilegrid-user-profiles-groups-and-communities');?>" name="submit_settings" id="submit_settings" />
        <div class="all_error_text" style="display:none;"></div>
      </div>
    </div>
  </form>
</div>
