<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$identifier = 'SETTINGS';
if(filter_input(INPUT_POST,'submit_settings'))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_general_settings' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
	$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	if($post!=false)
	{
		if(!isset($post['pm_allow_multiple_attachments'])) $post['pm_allow_multiple_attachments'] = 0;
                if(!isset($post['pm_auto_redirect_author_to_profile'])) $post['pm_auto_redirect_author_to_profile']=0;
		if(!isset($post['pm_enable_gravatars'])) $post['pm_enable_gravatars']=0;
		//if(!isset($post['pm_is_editable_primary_email'])) $post['pm_is_editable_primary_email']=0;
		if(!isset($post['pm_guest_allow_backend_login_screen'])) $post['pm_guest_allow_backend_login_screen']=0;
                if(!isset($post['pm_guest_allow_backend_register_screen'])) $post['pm_guest_allow_backend_register_screen']=0;
                if(!isset($post['pm_hide_wp_toolbar'])) $post['pm_hide_wp_toolbar']='no';
                if(!isset($post['pm_hide_admin_toolbar'])) $post['pm_hide_admin_toolbar']='no';
                if(!isset($post['pm_enable_reset_password_limit'])) $post['pm_enable_reset_password_limit']=0;
                if(!isset($post['pm_hide_wp_toolbar'])) $post['pm_hide_wp_toolbar']='no';
                if(!isset($post['pm_hide_admin_toolbar'])) $post['pm_hide_admin_toolbar']='no';
                if(!isset($post['pm_disabled_admin_reset_password_limit'])) $post['pm_disabled_admin_reset_password_limit']=0;
                if(!isset($post['pm_save_ip_browser_info'])) $post['pm_save_ip_browser_info'] = 0;
                foreach($post as $key=>$value)
		{
			$dbhandler->update_global_option_value($key,$value);
		}
	}
	
	wp_redirect( esc_url_raw('admin.php?page=pm_settings') );exit;
}
?>

<div class="uimagic">
    <form name="pm_general_settings" id="pm_general_settings" method="post" onsubmit="return add_section_validation()">
    <!-----Dialogue Box Starts----->
    <div class="content">
      <div class="uimheader">
        <?php _e( 'General','profilegrid-user-profiles-groups-and-communities' ); ?>
      </div>
     
      <div class="uimsubheader">
        <?php
		//Show subheadings or message or notice
		?>
      </div>
      <div class="uimrow">
        <div class="uimfield">
          <?php _e('Template','profilegrid-user-profiles-groups-and-communities');?>
        </div>
        <div class="uiminput">
          <select name="pm_style" id="pm_style">
          <?php
          $themename = $pmrequests->profile_magic_get_pm_theme_name();
            foreach($themename as $dirname) {
                ?>
            <option value="<?php echo $dirname;?>" <?php selected($dbhandler->get_global_option_value('pm_style'),$dirname); ?>><?php echo $dirname;?></option>
            <?php } ?>        
  	</select>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('You can create new templates by copying and renaming "default" folder (&#128194;) inside "[plugin root]/public/partials/themes" to "[your current theme directory]/profilegrid-user-profiles-groups-and-communities/themes".','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e('Theme','profilegrid-user-profiles-groups-and-communities');?>
        </div>
        <div class="uiminput">
          <select name="pm_theme_type" id="pm_theme_type">
            <option value="light" <?php selected($dbhandler->get_global_option_value('pm_theme_type','light'),'light'); ?>><?php _e('Light','profilegrid-user-profiles-groups-and-communities');?></option>
            <option value="dark" <?php selected($dbhandler->get_global_option_value('pm_theme_type','light'),'dark'); ?>><?php _e('Dark','profilegrid-user-profiles-groups-and-communities');?></option>
        </select>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('While Light will fit most of the themes, choose Dark if your WordPress theme has black or dark background.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
     
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Automatically Redirect Author Page to their Profile?','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
          <input name="pm_auto_redirect_author_to_profile" id="pm_auto_redirect_author_to_profile" type="checkbox" class="pm_toggle" value="1" style="display:none;" <?php checked($dbhandler->get_global_option_value('pm_auto_redirect_author_to_profile'),'1'); ?>   />
          <label for="pm_auto_redirect_author_to_profile"></label>
        </div>
          <div class="uimnote"><?php _e("When visitors accesses author page, they will be redirected to author's profile page.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Enable Gravatar','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
          <input name="pm_enable_gravatars" id="pm_enable_gravatars" type="checkbox" class="pm_toggle" value="1" style="display:none;" <?php checked($dbhandler->get_global_option_value('pm_enable_gravatars'),'1'); ?>   />
          <label for="pm_enable_gravatars"></label>
        </div>
          <div class="uimnote"><?php printf(__('When enabled, if user has not uploaded a profile image, ProfileGrid will fetch profile image associated with user email on <a href="%s" target="_blank">Gravatar</a>, a WordPress service for uploading and managing user avatars.','profilegrid-user-profiles-groups-and-communities'),'https://gravatar.com');?></div>
      </div>
        
<!--      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Make Primary Email Field Editable in Profile View','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
          <input name="pm_is_editable_primary_email" id="pm_is_editable_primary_email" type="checkbox" class="pm_toggle" value="1" style="display:none;" <?php checked($dbhandler->get_global_option_value('pm_is_editable_primary_email'),'1'); ?>   />
          <label for="pm_is_editable_primary_email"></label>
        </div>
          <div class="uimnote"><?php _e('Users will see their registered email address as editable field while editing their profiles.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>-->
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Allow Dashboard Login Page Access to Guests','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
          <input name="pm_guest_allow_backend_login_screen" id="pm_guest_allow_backend_login_screen" type="checkbox" class="pm_toggle" value="1" style="display:none;" <?php checked($dbhandler->get_global_option_value('pm_guest_allow_backend_login_screen','1'),'1'); ?>   />
          <label for="pm_guest_allow_backend_login_screen"></label>
        </div>
          <div class="uimnote"><?php _e("Users will be allowed to login using WordPress' default dashboard login page. When turned off, guests will be redirected to ProfileGrid login page when trying to access dashboard login page directly.",'profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
        <div class="uimrow">
          <div class="uimfield">
            <?php _e( 'Allow Dashboard Register Page access to Guests','profilegrid-user-profiles-groups-and-communities' ); ?>
          </div>
          <div class="uiminput">
            <input name="pm_guest_allow_backend_register_screen" id="pm_guest_allow_backend_register_screen" type="checkbox" class="pm_toggle" value="1" style="display:none;" <?php checked($dbhandler->get_global_option_value('pm_guest_allow_backend_register_screen','1'),'1'); ?>   />
            <label for="pm_guest_allow_backend_register_screen"></label>
          </div>
            <div class="uimnote"><?php _e("Users will be allowed to register using WordPress' default dashboard registration page. When turned off, guests will be redirected to ProfileGrid's default registration page when trying to access dashboard register page directly.",'profilegrid-user-profiles-groups-and-communities');?></div>
        </div>

        

      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Hide WordPress Toolbar','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
            <input name="pm_hide_wp_toolbar" id="pm_hide_wp_toolbar" type="checkbox" class="pm_toggle" value="yes" style="display:none;"  onclick="pm_show_hide(this,'pm_hide_admin_toolbar_html')" <?php checked($dbhandler->get_global_option_value('pm_hide_wp_toolbar'),'yes'); ?>   />
          <label for="pm_hide_wp_toolbar"></label>
        </div>
          <div class="uimnote"><?php _e('Hides the top WordPress admin bar for logged in users.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>  
        <div class="childfieldsrow" id="pm_hide_admin_toolbar_html" style=" <?php if($dbhandler->get_global_option_value('pm_hide_wp_toolbar','no')== 'yes'){echo 'display:block;';} else { echo 'display:none;';} ?>">
                <div class="uimrow">
                  <div class="uimfield">
                    <?php _e( 'Keep it visible for admin','profilegrid-user-profiles-groups-and-communities' ); ?>
                  </div>
                <div class="uiminput">
                       <input name="pm_hide_admin_toolbar" id="pm_hide_admin_toolbar" type="checkbox" <?php checked($dbhandler->get_global_option_value('pm_hide_admin_toolbar'),'yes'); ?> class="pm_toggle" value="yes" style="display:none;" />
                      <label for="pm_hide_admin_toolbar"></label>
                </div>
                <div class="uimnote"><?php _e('Show WordPress admin bar only to admin users','profilegrid-user-profiles-groups-and-communities');?></div>
                </div> 
        </div>

      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Set Limit for Password Reset Tries','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
            <input name="pm_enable_reset_password_limit" id="pm_enable_reset_password_limit" type="checkbox" class="pm_toggle" value="1" style="display:none;" onclick="pm_show_hide(this,'pm_reset_password_limt_html')" <?php checked($dbhandler->get_global_option_value('pm_enable_reset_password_limit'),'1'); ?>   />
          <label for="pm_enable_reset_password_limit"></label>
        </div>
          <div class="uimnote"><?php _e('Define number of times user can try to reset password.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>  
        
    <div class="childfieldsrow" id="pm_reset_password_limt_html" style=" <?php if($dbhandler->get_global_option_value('pm_enable_reset_password_limit',0)==1){echo 'display:block;';} else { echo 'display:none;';} ?>">
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Number of Allowed Tries','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput <?php if($dbhandler->get_global_option_value('pm_enable_reset_password_limit',0)==1){echo 'pm_required';} ?>">
            <input name="pm_reset_password_limit" id="pm_reset_password_limit" type="number" value="<?php echo $dbhandler->get_global_option_value('pm_reset_password_limit','');?>"  />
         <div class="errortext"></div>
        </div>
          <div class="uimnote"><?php _e('User will not be allowed to reset password more than this defined number. If exceeded, user will see an error next time he/ she tries to reset the password.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>  
        
        <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Disable Password Reset Rule for Admins','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
            <input name="pm_disabled_admin_reset_password_limit" id="pm_disabled_admin_reset_password_limit" type="checkbox" class="pm_toggle" value="1" style="display:none;" <?php checked($dbhandler->get_global_option_value('pm_disabled_admin_reset_password_limit'),'1'); ?>   />
          <label for="pm_disabled_admin_reset_password_limit"></label>
        </div>
          <div class="uimnote"><?php _e('The password reset limit rule will not apply to the admin.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>  

    </div>  
        
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Allow Multiple Attachments','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
          <input name="pm_allow_multiple_attachments" id="pm_allow_multiple_attachments" type="checkbox" class="pm_toggle" value="1" style="display:none;" <?php checked($dbhandler->get_global_option_value('pm_allow_multiple_attachments'),'1'); ?>   />
          <label for="pm_allow_multiple_attachments"></label>
        </div>
          <div class="uimnote"><?php _e('Allow users to attach more than one file to file upload fields.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Default WP Registration Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   $default_registration_url = $dbhandler->get_global_option_value('pm_default_regisration_page','0');
			$args = array(
				'depth'            => 0,
				'child_of'         => 0,
				'selected'         => $default_registration_url,
				'echo'             => 1,
				'show_option_none'      => __('Select Page','profilegrid-user-profiles-groups-and-communities'),
    			'option_none_value'     => 0, 
				'name'             => 'pm_default_regisration_page'); 
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Redirect all registration links to this page on your site. This helps in hiding the default WP registration form.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'After Login Redirect User to:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   $pm_redirect_after_login = $dbhandler->get_global_option_value('pm_redirect_after_login','0');
			$args = array(
				'depth'            => 0,
				'child_of'         => 0,
				'selected'         => $pm_redirect_after_login,
				'echo'             => 1,
				'show_option_none'      => __('Select Page','profilegrid-user-profiles-groups-and-communities'),
    			'option_none_value'     => 0, 
				'name'             => 'pm_redirect_after_login'); 
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('When the user logs in, he/ she will be redirected to this page. This is usually a member specific area, like user profile page.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'After Logout Redirect User to:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   $pm_redirect_after_logout = $dbhandler->get_global_option_value('pm_redirect_after_logout','0');
			$args = array(
				'depth'            => 0,
				'child_of'         => 0,
				'selected'         => $pm_redirect_after_logout,
				'echo'             => 1,
				'show_option_none'      => __('Select Page','profilegrid-user-profiles-groups-and-communities'),
    			'option_none_value'     => 0, 
				'name'             => 'pm_redirect_after_logout'); 
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('When the user logs in, he/ she will be redirected to this page. This is usually a member specific area, like user profile page.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>  
        
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'All Groups Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   $pm_groups_page = $dbhandler->get_global_option_value('pm_groups_page','0');
			$args = array('depth'=>0,'child_of'=>0,'selected'=> $pm_groups_page,'echo'=>1,'show_option_none'=>__('Select Page','profilegrid-user-profiles-groups-and-communities'),'option_none_value'=>0,
			'name'=>'pm_groups_page');
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('All Groups page displays all the groups on your site beautifully on a single page. A great way to allow visitors to decide and sign up for relevant group.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Registration Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   $pm_registration_page = $dbhandler->get_global_option_value('pm_registration_page','0');
			$args = array('depth'=>0,'child_of'=>0,'selected'=> $pm_registration_page,'echo'=>1,'show_option_none'=>__('Select Page','profilegrid-user-profiles-groups-and-communities'),'option_none_value'=>0,
			'name'=>'pm_registration_page');
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('This will add Username and Password fields to this form.','profilegrid-user-profiles-groups-and-communities');?> </div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Profile Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   $pm_user_profile_page = $dbhandler->get_global_option_value('pm_user_profile_page','0');
			$args = array('depth'=>0,'child_of'=>0,'selected'=> $pm_user_profile_page,'echo'=>1,'show_option_none'=>__('Select Page','profilegrid-user-profiles-groups-and-communities'),'option_none_value'=>0,
			'name'=>'pm_user_profile_page');
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Default member profile page. Make sure it has profile shortcode pasted inside it.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Login Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   		$pm_user_login_page = $dbhandler->get_global_option_value('pm_user_login_page','0');
			$args = array('depth'=>0,'child_of'=>0,'selected'=> $pm_user_login_page,'echo'=>1,'show_option_none'=>__('Select Page','profilegrid-user-profiles-groups-and-communities'),'option_none_value'=>0,
			'name'=>'pm_user_login_page');
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('The page where users can log in. It should have the login shortcode pasted inside.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Password Recovery Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   		$pm_forget_password_page = $dbhandler->get_global_option_value('pm_forget_password_page','0');
			$args = array('depth'=>0,'child_of'=>0,'selected'=> $pm_forget_password_page,'echo'=>1,'show_option_none'=>__('Select Page','profilegrid-user-profiles-groups-and-communities'),'option_none_value'=>0,
			'name'=>'pm_forget_password_page');
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('This page will allows users to start password recovery process.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>
      
     
      
      <div class="uimrow">
        <div class="uimfield">
          <?php _e( 'Group Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
        </div>
        <div class="uiminput">
        <?php 
	   		$pm_group_page = $dbhandler->get_global_option_value('pm_group_page','0');
			$args = array('depth'=>0,'child_of'=>0,'selected'=> $pm_group_page,'echo'=>1,'show_option_none'=>__('Select Page','profilegrid-user-profiles-groups-and-communities'),'option_none_value'=>0,
			'name'=>'pm_group_page');
			wp_dropdown_pages($args); 
		?>
          <div class="errortext"></div>
        </div>
        <div class="uimnote"><?php _e('Single group page where users can see group details and other members of the group.','profilegrid-user-profiles-groups-and-communities');?></div>
      </div>

        <div class="uimrow">
            <div class="uimfield">
              <?php _e( 'User Blog Submission Page:','profilegrid-user-profiles-groups-and-communities' ); ?>
            </div>
            <div class="uiminput">
            <?php 
                            $pm_submit_blog = $dbhandler->get_global_option_value('pm_submit_blog','0');
                            $args = array('depth'=>0,'child_of'=>0,'selected'=> $pm_submit_blog,'echo'=>1,'show_option_none'=>__('Select Page','profilegrid-user-profiles-groups-and-communities'),'option_none_value'=>0,
                            'name'=>'pm_submit_blog');
                            wp_dropdown_pages($args); 
                    ?>
              <div class="errortext"></div>
            </div>
            <div class="uimnote"><?php _e('Page from where users can submit new blog posts, which will then appear in Blogs tab of their profiles.','profilegrid-user-profiles-groups-and-communities');?></div>
        </div>
     
      <div class="buttonarea"> <a href="admin.php?page=pm_settings">
        <div class="cancel">&#8592; &nbsp;
          <?php _e('Cancel','profilegrid-user-profiles-groups-and-communities');?>
        </div>
        </a>
        <?php wp_nonce_field('save_general_settings'); ?>
          <input type="submit" value="<?php _e('Save','profilegrid-user-profiles-groups-and-communities');?>" name="submit_settings" id="submit_settings"/>
        <div class="all_error_text" style="display:none;"></div>
      </div>
    </div>
  </form>
</div>
