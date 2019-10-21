<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profilegrid.co
 * @since      1.0.0
 *
 * @package    Profile_Magic
 * @subpackage Profile_Magic/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Profile_Magic
 * @subpackage Profile_Magic/admin
 * @author     ProfileGrid <support@profilegrid.co>
 */
class Profile_Magic_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $profile_magic    The ID of this plugin.
	 */
	private $profile_magic;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $profile_magic       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $profile_magic, $version ) {

		$this->profile_magic = $profile_magic;
		$this->version = $version;
		$this->pm_theme_path = plugin_dir_path( __FILE__ ) . '../public/partials/themes/';
                $theme_path = get_stylesheet_directory();
                $override_template = $theme_path . "/profilegrid-user-profiles-groups-and-communities/themes/";
                $this->pm_theme_path_in_wptheme = $override_template;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
        
        public function activate_sitewide_plugins($blog_id)
        {
            // Switch to new website
            $dbhandler = new PM_DBhandler;
            switch_to_blog( $blog_id );
            // Activate
            foreach( array_keys( get_site_option( 'active_sitewide_plugins' ) ) as $plugin ) {
                do_action( 'activate_'  . $plugin, false );
                do_action( 'activate'   . '_plugin', $plugin, false );
            }
            // Restore current website 
            restore_current_blog();
        }
        
	public function enqueue_styles() {
//            $pmrequests = new PM_request;
//            $is_pg_dashboard_page = $pmrequests->is_pg_dashboard_page();
//            if($is_pg_dashboard_page):
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Profile_Magic_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Profile_Magic_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 global $wp_scripts;
		// tell WordPress to load jQuery UI tabs
		wp_enqueue_script('jquery-ui-tabs');
		// get registered script object for jquery-ui
		$ui = $wp_scripts->query('jquery-ui-core');
		// tell WordPress to load the Smoothness theme from Google CDN
		$protocol = is_ssl() ? 'https' : 'http';
		$url = "$protocol://ajax.googleapis.com/ajax/libs/jqueryui/{$ui->ver}/themes/smoothness/jquery-ui.min.css";
		$screen = get_current_screen();
		if(isset($screen) && $screen->base!='admin_page_pm_profile_fields' && $screen->base!='admin_page_pm_profile_view')
		wp_enqueue_style('jquery-ui-smoothness', $url, false, null);
		wp_enqueue_style( $this->profile_magic, plugin_dir_url( __FILE__ ) . 'css/profile-magic-admin.css', array(), $this->version, 'all' );
		//wp_enqueue_style( 'pm-joyride', plugin_dir_url( __FILE__ ) . 'css/joyride.css', array(), $this->version, 'all' );
                wp_enqueue_style( 'pm-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css', array(), $this->version, 'all' );
		//wp_enqueue_style( 'pm-user-manager', plugin_dir_url( __FILE__ ) . 'css/pm-user-manager.css', array(), $this->version, 'all' );
		wp_enqueue_style('thickbox');
		wp_register_style('pm_googleFonts', 'https://fonts.googleapis.com/css?family=Titillium+Web:400,600');
                wp_enqueue_style( 'pm_googleFonts');
//                endif;
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
                $pmrequests = new PM_request;
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Profile_Magic_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Profile_Magic_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
//            $is_pg_dashboard_page = $pmrequests->is_pg_dashboard_page();
//            if($is_pg_dashboard_page):
                
                $dbhandler = new PM_DBhandler;
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_Script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-autocomplete');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
                wp_enqueue_script('jquery-form');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_media();
		wp_enqueue_script( $this->profile_magic, plugin_dir_url( __FILE__ ) . 'js/profile-magic-admin.js', array( 'jquery' ), $this->version, false );
                //wp_enqueue_script( 'pm-joyride', plugin_dir_url( __FILE__ ) . 'js/joyride.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( $this->profile_magic, 'pm_ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php')) );
                $error = array();
		$error['valid_email'] = __('Please enter a valid e-mail address.','profilegrid-user-profiles-groups-and-communities');
		$error['valid_number'] = __('Please enter a valid number.','profilegrid-user-profiles-groups-and-communities');
		$error['valid_date'] = __('Please enter a valid date(yyyy-mm-dd format).','profilegrid-user-profiles-groups-and-communities');
		$error['required_field'] = __('This is a required field.','profilegrid-user-profiles-groups-and-communities');
		$error['file_type'] = __('This file type is not allowed.','profilegrid-user-profiles-groups-and-communities');
		$error['short_password'] = __('Your password should be at least 7 characters long.','profilegrid-user-profiles-groups-and-communities');
		$error['pass_not_match'] = __('Password and confirm password do not match.','profilegrid-user-profiles-groups-and-communities');
		$error['user_exist'] = __('Sorry, username already exist.','profilegrid-user-profiles-groups-and-communities');
		$error['email_exist'] = __('Sorry, email already exist.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_facebook_url'] = __('Please enter a valid facebook url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_twitter_url'] = __('Please enter a valid twitter url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_google_url'] = __('Please enter a valid google+ url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_linked_in_url'] = __('Please enter a valid linkedin url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_youtube_url'] = __('Please enter a valid youtube url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_instagram_url'] = __('Please enter a valid instagram url.','profilegrid-user-profiles-groups-and-communities');
                $error['atleast_one_field'] = __('Select at least one field.','profilegrid-user-profiles-groups-and-communities');
                $error['seprator_not_empty'] = __('Seperator field can not be empty.','profilegrid-user-profiles-groups-and-communities');
                $error['choose_image'] = __('Choose Image','profilegrid-user-profiles-groups-and-communities');
                $error['valid_image'] = __('This is not a valid image','profilegrid-user-profiles-groups-and-communities');
                $error['valid_group_name'] = __('Please enter a valid group name.','profilegrid-user-profiles-groups-and-communities');
                $error['group_manager_first'] = __('You must define a Group Manager first, before making a Group closed.','profilegrid-user-profiles-groups-and-communities');
                $error['delete'] = __('Delete','profilegrid-user-profiles-groups-and-communities');
                $error['success'] = __('Success','profilegrid-user-profiles-groups-and-communities');
                $error['failure'] = __('Failure','profilegrid-user-profiles-groups-and-communities');
                $error['select_group'] = __('please select a group','profilegrid-user-profiles-groups-and-communities');
                $error['no_user_search'] = __('Sorry, no user with this username in this group.','profilegrid-user-profiles-groups-and-communities');
                
                $error['change_group'] = __('You are changing the group of this user. All data associated with profile fields of old group will be hidden and the user will have to edit and fill profile fields associated with the new group. Do you wish to continue?','profilegrid-user-profiles-groups-and-communities');
		$error['allow_file_ext'] = $dbhandler->get_global_option_value('pm_allow_file_types','jpg|jpeg|png|gif');	
		wp_localize_script( $this->profile_magic, 'pm_error_object',$error);
                
                $upload_requirements = array();
                $upload_requirements['pg_profile_image_max_file_size'] = $dbhandler->get_global_option_value('pg_profile_image_max_file_size','');
                $upload_requirements['pg_cover_image_max_file_size'] = $dbhandler->get_global_option_value('pg_cover_image_max_file_size','');
                $upload_requirements['pg_profile_photo_minimum_width'] = $dbhandler->get_global_option_value('pg_profile_photo_minimum_width','DEFAULT');
                $upload_requirements['pg_cover_photo_minimum_width'] = $dbhandler->get_global_option_value('pg_cover_photo_minimum_width','800');
                $upload_requirements['pg_image_quality'] = $dbhandler->get_global_option_value('pg_image_quality','90');
                $upload_requirements['error_max_profile_filesize'] = sprintf( __( 'Image size exceeds the maximum limit. Maximum allowed image size is %d byte.','profilegrid-user-profiles-groups-and-communities'),$upload_requirements['pg_profile_image_max_file_size'] );
                $upload_requirements['error_min_profile_width'] = sprintf( __( 'Image dimensions are too small. Minimum size is %d by %d pixels.','profilegrid-user-profiles-groups-and-communities' ),$upload_requirements['pg_profile_photo_minimum_width'] ,$upload_requirements['pg_profile_photo_minimum_width']);
                $upload_requirements['error_min_cover_width'] = sprintf( __( 'Image dimensions are too small. Minimum size is %d by 300 pixels.','profilegrid-user-profiles-groups-and-communities' ),$upload_requirements['pg_cover_photo_minimum_width']);
                wp_localize_script( $this->profile_magic, 'pm_upload_object',$upload_requirements);
//                endif;

	}
	
        public function profile_magic_admin_menu_for_extensions()
        {
            add_submenu_page("pm_manage_groups","Extensions","Extensions","manage_options","pm_extensions",array( $this, 'pm_extensions' ));
        }
	
	public function profile_magic_admin_menu()
	{       
                add_menu_page(__('ProfileGrid','profilegrid-user-profiles-groups-and-communities'),__('ProfileGrid','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_manage_groups",array( $this, 'pm_manage_groups' ),'dashicons-groups');
		add_submenu_page("",__('New Group','profilegrid-user-profiles-groups-and-communities'),__('New Group','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_add_group",array( $this, 'pm_add_group' ));
		add_submenu_page("",__('Profile Fields','profilegrid-user-profiles-groups-and-communities'),__('Profile Fields','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_profile_fields",array( $this, 'pm_profile_fields' ));
		add_submenu_page("",__('New Field','profilegrid-user-profiles-groups-and-communities'),__('New Field','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_add_field",array( $this, 'pm_add_field' ));
		add_submenu_page("",__('New Section','profilegrid-user-profiles-groups-and-communities'),__('New Section','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_add_section",array( $this, 'pm_add_section' ));
		add_submenu_page("pm_manage_groups",__('User Profiles','profilegrid-user-profiles-groups-and-communities'),__('User Profiles','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_user_manager",array( $this, 'pm_user_manager' ));
                add_submenu_page("pm_manage_groups",__('Requests','profilegrid-user-profiles-groups-and-communities'),__('Requests','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_requests_manager",array( $this, 'pm_requests_manager' ));
		add_submenu_page("",__('Profile View','profilegrid-user-profiles-groups-and-communities'),__('Profile View','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_profile_view",array( $this, 'pm_profile_view' ));
		add_submenu_page("",__('Edit User','profilegrid-user-profiles-groups-and-communities'),__('Edit User','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_user_edit",array( $this, 'pm_user_edit' ));
		add_submenu_page("pm_manage_groups",__('Email Templates','profilegrid-user-profiles-groups-and-communities'),__('Email Templates','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_email_templates",array( $this, 'pm_email_templates' ));
		add_submenu_page("pm_manage_groups",__('Add Email Template','profilegrid-user-profiles-groups-and-communities'),__('Add Email Template','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_add_email_template",array( $this, 'pm_add_email_template' ));
		add_submenu_page("",__('Email Preview','profilegrid-user-profiles-groups-and-communities'),__('Email Preview','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_email_preview",array($this,'pm_email_preview'));
		add_submenu_page("",__('Analytics','profilegrid-user-profiles-groups-and-communities'),__('Analytics','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_analytics",array( $this, 'pm_analytics' ));
		add_submenu_page("",__('Membership','profilegrid-user-profiles-groups-and-communities'),__('Membership','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_membership",array( $this, 'pm_membership' ));
		add_submenu_page("pm_manage_groups",__('Shortcodes','profilegrid-user-profiles-groups-and-communities'),__('Shortcodes','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_shortcodes",array( $this, 'pm_shortcodes' ));
                add_submenu_page("pm_manage_groups",__('Global Settings','profilegrid-user-profiles-groups-and-communities'),__('Global Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_settings",array( $this, 'pm_settings' ));
		add_submenu_page("",__('General Settings','profilegrid-user-profiles-groups-and-communities'),__('General Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_general_settings",array( $this, 'pm_general_settings' ));
		add_submenu_page("",__('Anti Spam Settings','profilegrid-user-profiles-groups-and-communities'),__('Anti Spam Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_security_settings",array( $this, 'pm_security_settings' ));
		add_submenu_page("",__('User Accounts Settings','profilegrid-user-profiles-groups-and-communities'),__('User Accounts Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_user_settings",array( $this, 'pm_user_settings' ));
		add_submenu_page("",__('Email Settings','profilegrid-user-profiles-groups-and-communities'),__('Email Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_email_settings",array( $this, 'pm_email_settings' ));
		add_submenu_page("",__('Third Party Integrations','profilegrid-user-profiles-groups-and-communities'),__('Third Party Integrations','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_third_party_settings",array( $this, 'pm_third_party_settings' ));
                add_submenu_page("",__('Payments Settings','profilegrid-user-profiles-groups-and-communities'),__('Payments Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_payment_settings",array( $this, 'pm_payment_settings' ));
                add_submenu_page("",__('Tools','profilegrid-user-profiles-groups-and-communities'),__('Tools','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_tools",array( $this, 'pm_tools' ));
                add_submenu_page("",__('Export Users','profilegrid-user-profiles-groups-and-communities'),__('Export Users','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_export_users",array( $this, 'pm_export_users' ));
                add_submenu_page("",__('Import Users','profilegrid-user-profiles-groups-and-communities'),__('Import Users','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_import_users",array( $this, 'pm_import_users' ));
                add_submenu_page("",__('Blog Settings','profilegrid-user-profiles-groups-and-communities'),__('Blog Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_blog_settings",array( $this, 'pm_blog_settings' ));
                add_submenu_page("",__('Message Settings','profilegrid-user-profiles-groups-and-communities'),__('Message Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_message_settings",array( $this, 'pm_message_settings' ));
                add_submenu_page("",__('Friends Settings','profilegrid-user-profiles-groups-and-communities'),__('Friends Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_friend_settings",array( $this, 'pm_friend_settings' ));
                add_submenu_page("",__('Upload Settings','profilegrid-user-profiles-groups-and-communities'),__('Upload Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_upload_settings",array( $this, 'pm_upload_settings' ));
                add_submenu_page("",__('SEO Settings','profilegrid-user-profiles-groups-and-communities'),__('SEO Settings','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_seo_settings",array( $this, 'pm_seo_settings' ));
                add_submenu_page("",__('Export Options','profilegrid-user-profiles-groups-and-communities'),__('Export Options','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_export_options",array( $this, 'pm_export_options' ));
                add_submenu_page("",__('Import Options','profilegrid-user-profiles-groups-and-communities'),__('Import Options','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_import_options",array( $this, 'pm_import_options' ));
                add_submenu_page("",__('Content Restrictions','profilegrid-user-profiles-groups-and-communities'),__('Content Restrictions','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_content_restrictions",array( $this, 'pm_content_restrictions' ));
                add_submenu_page("",__('Woocommerce Extension','profilegrid-user-profiles-groups-and-communities'),__('Woocommerce Extension','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_woocommerce_extension",array( $this, 'pm_woocommerce_extension' ));                             
                add_submenu_page("",__("Advanced Woocommerce Extension","profilegrid-user-profiles-groups-and-communities"),__("Advanced Woocommerce Extension","profilegrid-user-profiles-groups-and-communities"),"manage_options","pm_woocommerce_advanced_extension",array( $this, 'pm_woocommerce_advanced_extension' ));
                add_submenu_page("",__('RegistrationMagic Integrations','profilegrid-user-profiles-groups-and-communities'),__('RegistrationMagic Integrations','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_rm_integration",array( $this, 'pm_rm_integration' ));
                add_submenu_page("",__('Profile Notifications','profilegrid-user-profiles-groups-and-communities'),__('Profile Notifications','profilegrid-user-profiles-groups-and-communities'),"manage_options","pm_profile_notification_settings",array( $this, 'pm_profile_notification_settings' ));

        }
	
        public function pm_requests_manager()
        {
           include 'partials/pm-membership-requests.php'; 
        }
        
        public function pm_message_settings()
        {
            include 'partials/message-settings.php';
        }
        
        public function pm_profile_notification_settings()
        {
            include 'partials/profile-notification-settings.php';
        }
        
        
        public function pm_rm_integration()
        {
            
           if (class_exists('Profile_Magic') &&  class_exists('Registration_Magic')) 
           { 
                include 'partials/rmagic_settings.php';
           }
           else
           {
               include 'partials/rmagic_banner_settings.php';
           }
        }
        
        public function pm_woocommerce_extension()
        {
            include 'partials/woocommerce-extension.php';
        }
        
        public function pm_woocommerce_advanced_extension()
        {
            include 'partials/woocommerce-advanced-extension.php';
        }

        public function pm_content_restrictions()
        {
            include 'partials/content-restrictions.php';
        }

        public function pm_import_options()
        {
            include 'partials/import-options.php';
        }
        
        public function pm_export_options()
        {
            include 'partials/export-options.php';
        }
        
        public function pm_seo_settings()
        {
            include 'partials/seo-settings.php';            
        }

        public function pm_upload_settings()
        {
            include 'partials/upload-settings.php';
        }
        
        public function pm_extensions()
        {
            include 'partials/pm_extensions.php';
        }
        
        public function pm_friend_settings()
	{
            include 'partials/friends-settings.php';	
	}
        
        public function pm_tools()
        {
                include 'partials/pm-tools.php';
        }
        
        public function pm_payment_settings()
	{
		include 'partials/payment-settings.php';	
	}
        
        public function pm_blog_settings()
        {
            include 'partials/blog-settings.php';
        }
        
        public function pm_export_users()
        {
                include 'partials/pm-export-users.php';
        }
        
        public function pm_import_users()
        {
                include 'partials/pm-import-users.php';
        }
        
        public function pm_profile_magic_add_group_option($gid,$group_options)
	{
		include 'partials/profile-magic-group-option.php';	
	}
        
        public function pm_profile_magic_add_option_setting_page()
	{
		include 'partials/profile-magic-paypal-admin-display.php';	
	}
        
	public function pm_add_email_template()
	{
		include 'partials/email-template.php';
                $this->pg_get_footer_banner();
	}
	
        public function pm_shortcodes()
        {
            include 'partials/shortcode.php';
            $this->pg_get_footer_banner();
        }
	public function pm_email_templates()
	{
		include 'partials/email-templates-list.php';
                $this->pg_get_footer_banner();
	}
	
	public function pm_email_preview()
	{
		include 'partials/email-preview.php';
	}
	
	public function pm_template_preview_button()
	{	
		echo '<a href="admin.php?page=pm_email_preview&TB_iframe=false&width=600&height=550inlineId=wpbody" class="thickbox" onClick="return preview()">Preview</a>';
		
	}
	
	public function pm_manage_groups()
	{
		include 'partials/manage-groups.php';
	}
	
	public function pm_add_group()
	{
		include 'partials/add-group.php';
	}
	
	public function pm_add_field()
	{
		include 'partials/add-field.php';	
	}
	
	public function pm_add_section()
	{
		include 'partials/add-section.php';	
	}
	
	public function pm_profile_fields()
	{
		include 'partials/manage-fields.php';	
	}
	
	public function pm_user_manager()
	{
		include 'partials/user-manager.php';	
                $this->pg_get_footer_banner();
	}
	
	public function pm_profile_view()
	{
		include 'partials/user-profile.php';	
	}
	
	public function pm_third_party_settings()
	{
		include 'partials/thirdparty-settings.php';	
	}
	
	public function pm_email_settings()
	{
		include 'partials/email-settings.php'; 
	}
	
	public function pm_user_settings()
	{
		include 'partials/user-settings.php';	
	}
	
	public function pm_general_settings()
	{
		include 'partials/general-settings.php';
		
	}
	
	public function pm_security_settings()
	{
		include 'partials/security-settings.php';
	}
	
	public function pm_settings()
	{
		include 'partials/pm-settings.php';
                $this->pg_get_footer_banner();
	}
	
	
	
	
	public function profile_magic_set_field_order()
	{
		include 'partials/set-fields-order.php';
		die;
	}
        
        public function profile_magic_set_group_order()
	{
		include 'partials/set-groups-order.php';
		die;
	}
        
        public function profile_magic_set_group_items()
	{
		include 'partials/set-groups-order.php';
		die;
	}
	
	public function profile_magic_set_section_order()
	{
                $dbhandler = new PM_DBhandler;
		$textdomain = $this->profile_magic;
		$path =  plugin_dir_url(__FILE__); 
		$identifier = 'SECTION';
		$list_order = filter_input(INPUT_POST, 'list_order');
		if(isset($list_order))
		{
			$list = explode(',' , $list_order);
			$i = 1 ;
			foreach($list as $id) {
				$dbhandler->update_row($identifier,'id',$id,array('ordering' => $i),array('%d'),'%d');	
				
				$i++;
			}
		}	
		die;
	}
	
	public function profile_magic_section_dropdown()
	{
		$textdomain = $this->profile_magic;
		$path =  plugin_dir_url(__FILE__);
		$gid = filter_input(INPUT_POST, 'gid');
                $dbhandler = new PM_DBhandler;
		$sections = $dbhandler->get_all_result('SECTION',array('id','section_name'),array('gid'=>$gid));
		foreach($sections as $section)
	    {?>
            <option value="<?php echo $section->id;?>" <?php if(!empty($row))selected($row->associate_section,$section->id);?>><?php echo $section->section_name; ?></option>
         <?php 
		}
		die;	
	}
	
	
	public function profile_magic_check_smtp_connection()
	{
                $dbhandler = new PM_DBhandler;
                $pmrequests = new PM_request;
		$identifier = 'SETTINGS';
		$exclude = array("_wpnonce","_wp_http_referer","submit_settings");
		$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
		if($post!=false)
		{
			if(isset($post['pm_smtp_password']) && $post['pm_smtp_password']!='') 
			{
				//$post['pm_smtp_password'] = $pmrequests->pm_encrypt_decrypt_pass('encrypt',$post['pm_smtp_password']);
                                $post['pm_smtp_password'] = $post['pm_smtp_password'];
			}
			else
			{
				unset($post['pm_smtp_password']);
			}
			foreach($post as $key=>$value)
			{
				$dbhandler->update_global_option_value($key,$value);
			}
		}
		$dbhandler->update_global_option_value('pm_enable_smtp',1);
		$to = $dbhandler->get_global_option_value('pm_smtp_test_email_address');
                //echo $to;die;
		echo wp_mail( $to,__('Test SMTP Connection','profilegrid-user-profiles-groups-and-communities'),'Test');die;
                
	}
	
	public function profile_magic_check_user_exist()
	{
                $pmrequests = new PM_request;
                if(isset($_POST['previous_data']) && $_POST['previous_data']==$_POST['userdata'])
                {
                    echo 'false';
                    die;
                }
		switch($_POST['type'])
		{
			case 'validateUserName': 
				 if($pmrequests->profile_magic_check_username_exist($_POST['userdata']))
                                 {
                                     echo 'true';
                                 }
                                 else
                                 {
                                     echo 'false';
                                 }
                                     
				break;
			case 'validateUserEmail': 
				if($pmrequests->profile_magic_check_user_email_exist($_POST['userdata']))
                                {
                                    echo 'true';
                                }
                                else
                                {
                                    echo 'false';
                                }
				break;
		}	
                
     	die;
	}
	
	public function pm_fields_list_for_email()
	{
                $dbhandler = new PM_DBhandler;
		$exclude = "and field_type not in('file','user_avatar','heading','paragraph','confirm_pass','user_pass','divider','spacing','birth_date')";
		$groups =  $dbhandler->get_all_result('GROUPS');
		echo '<select name="pm_field_list" class="pm_field_list" onchange="pm_insert_field_in_email(this.value)">';
		echo '<option>'.__('Select A Field','profilegrid-user-profiles-groups-and-communities').'</option>';
		echo '<optgroup label="'.__('Comman Fields','profilegrid-user-profiles-groups-and-communities').'" >';
		echo '<option value="{{user_login}}">'.__('User Name','profilegrid-user-profiles-groups-and-communities').'</option>';
		echo '<option value="{{user_pass}}">'.__('User Password','profilegrid-user-profiles-groups-and-communities').'</option>';
               // echo '<option value="{{pm_activation_code}}">'.__('User Activation Link','profilegrid-user-profiles-groups-and-communities').'</option>';
		echo '</optgroup>';
		if(isset($groups)):
		foreach($groups as $group)
		{
			$fields =  $dbhandler->get_all_result('FIELDS','*',array('associate_group'=>$group->id),'results',0,false,'ordering',false,$exclude);
			echo '<optgroup label="'.$group->group_name.'" >';
			if(isset($fields)):
			foreach($fields as $field)
			{
				echo '<option value="{{'.$field->field_key.'}}">'.$field->field_name.'</option>';
			}
			endif;
			
			echo '</optgroup>';
		}
                echo '<optgroup label="'.__('Other Fields','profilegrid-user-profiles-groups-and-communities').'" >';
		echo '<option value="{{post_name}}">'.__('Post Name','profilegrid-user-profiles-groups-and-communities').'</option>';
                echo '<option value="{{edit_post_link}}">'.__('Review Post Link','profilegrid-user-profiles-groups-and-communities').'</option>';
		echo '<option value="{{post_link}}">'.__('Post Link','profilegrid-user-profiles-groups-and-communities').'</option>';
                echo '<option value="{{group_name}}">'.__('User Group Name','profilegrid-user-profiles-groups-and-communities').'</option>';
                
                
                // echo '<option value="{{pm_activation_code}}">'.__('User Activation Link','profilegrid-user-profiles-groups-and-communities').'</option>';
		echo '</optgroup>';
		echo '</select>';
		endif;
			
	}
	
	public function profile_magic_show_user_fields($user)
	{
                $dbhandler = new PM_DBhandler;
                $pg_profile_image_max_file_size= $dbhandler->get_global_option_value('pg_profile_image_max_file_size','');
                $pg_cover_image_max_file_size= $dbhandler->get_global_option_value('pg_cover_image_max_file_size','');
                $pg_profile_photo_minimum_width = $dbhandler->get_global_option_value('pg_profile_photo_minimum_width','DEFAULT');
                $pg_cover_photo_minimum_width = $dbhandler->get_global_option_value('pg_cover_photo_minimum_width','DEFAULT');
                
                if($pg_profile_photo_minimum_width=='DEFAULT')$pg_profile_photo_minimum_width = 150;
                if($pg_cover_photo_minimum_width=='DEFAULT')$pg_cover_photo_minimum_width = 800;
                if($pg_profile_image_max_file_size=='')
                {
                    $message = sprintf( __( 'File Restrictions: Please make sure your image size fits within %d by %d pixels.','profilegrid-user-profiles-groups-and-communities' ),$pg_profile_photo_minimum_width ,$pg_profile_photo_minimum_width);
                }
                else
                {
                    $message = sprintf( __( 'File Restrictions: Please make sure your image size fits within %d by %d pixels and does not exceeds total size of %d bytes.','profilegrid-user-profiles-groups-and-communities' ),$pg_profile_photo_minimum_width ,$pg_profile_photo_minimum_width,$pg_profile_image_max_file_size);
                }
                
                if($pg_cover_image_max_file_size=='')
                {
                    $message2 = sprintf( __( 'File Restrictions: Please make sure your image size fits within %d by %d pixels.','profilegrid-user-profiles-groups-and-communities' ),$pg_cover_photo_minimum_width,300);
                }
                else
                {
                    $message2 = sprintf( __( 'File Restrictions: Please make sure your image size fits within %d by %d pixels and does not exceeds total size of %d bytes.','profilegrid-user-profiles-groups-and-communities' ),$pg_cover_photo_minimum_width,300,$pg_cover_image_max_file_size);
                }
                
                $pm_customfields = new PM_Custom_Fields;
                $pmrequests = new PM_request;
		if(is_object($user))
		{
                        $uid = $user->ID;
			$gids = $pmrequests->profile_magic_get_user_field_value($user->ID,'pm_group');
                        $gid = $pmrequests->pg_filter_users_group_ids($gids);
		}
		else
		{
			$gid = array();	
                        $uid = 0;
		}
                
                if(!empty($gid)):
		$exclude = "associate_group in(".implode(',',$gid).") and field_type not in('first_name','last_name','user_name','user_email','user_url','user_pass','confirm_pass','description','file','user_avatar','heading','paragraph')";
		
                
                $fields =  $dbhandler->get_all_result('FIELDS','*',1,'results',0,false,'ordering',false,$exclude);
		endif;
		$col = $dbhandler->get_global_option_value('pm_reg_form_cols',1);
		
		$profile_pic = (is_object($user)) ? get_user_meta($user->ID, 'pm_user_avatar', true): false;
		$groups =  $dbhandler->get_all_result('GROUPS',array('id','group_name'));
                $pm_profile_privacy = $pmrequests->profile_magic_get_user_field_value($user->ID,'pm_profile_privacy');
                $pm_hide_my_profile = $pmrequests->profile_magic_get_user_field_value($user->ID,'pm_hide_my_profile');
                if(empty($pm_hide_my_profile))
                {
                    $pm_hide_my_profile = '0';
                }
                $cover_image = $pmrequests->profile_magic_get_user_field_value($user->ID,'pm_cover_image');
   ?>
            <table class="form-table"> 
                <tbody>
                        <tr>
                           
                            <th class="pm-field-lable">
                                <label for="pm_field_37"><?php _e('Profile Picture', 'profilegrid-user-profiles-groups-and-communities'); ?></label>
                            </th>
                            <td class="pm-field-input">              
                                <input id="pm_user_avatar" type="hidden" name="pm_user_avatar" class="icon_id" value="<?php if (isset($profile_pic)) echo $profile_pic; ?>" />
                                <input id="field_icon_button" name="field_icon_button" class="button group_icon_button" type="button" value="<?php _e('Upload Image', 'profilegrid-user-profiles-groups-and-communities'); ?>" />
                                <span class="pg_profile_image_container" style="<?php if(!is_object($user) || $profile_pic==false)echo 'display: none;';?>">
                                <?php echo get_avatar($user->user_email,100,'',false,array('class'=>'pm-user user-profile-image','id'=>'pg_upload_image_preview','force_display'=>true));?>
                                <input type="button" name="pg_remove_image" id="pg_remove_image" class="button" value="<?php _e('Remove','profilegrid-user-profiles-groups-and-communities');?>" onclick="pg_remove_profile_image()"/>
                                </span>
                                <p class="description"><?php echo $message; ?></p>
                                <div class="errortext" style="display:none;"></div>
                            </td> 
                        </tr>
                        
                        <tr>
                           
                            <th class="pm-field-lable">
                                <label for="pm_field_37"><?php _e('Cover Image', 'profilegrid-user-profiles-groups-and-communities'); ?></label>
                            </th>
                            <td class="pm-field-input">              
                                <input id="pm_cover_image" type="hidden" name="pm_cover_image" class="cover_icon_id" value="<?php if (isset($cover_image)) echo $cover_image; ?>" />
                                <input id="cover_image_button" name="cover_image_button" class="button cover_image_button" type="button" value="<?php _e('Upload Image', 'profilegrid-user-profiles-groups-and-communities'); ?>" />
                                <span class="pg_cover_image_container" style="<?php if(!is_object($user) || $cover_image==false)echo 'display: none;';?>">
                                <?php $src = wp_get_attachment_image_src($cover_image,array(100,100));
                                
                                ?>
                                    <img src="<?php if(isset($src['0'])) echo $src['0'];?>" width="100" height="100" class="pm-user" id="pg_upload_cover_image_preview" />
                                <input type="button" name="pg_remove_cover_image" id="pg_remove_cover_image" class="button" value="<?php _e('Remove','profilegrid-user-profiles-groups-and-communities');?>" onclick="pm_remove_cover_image()"/>
                                </span>
                                <p class="description"><?php echo $message2; ?></p>
                                <div class="errortext" style="display:none;"></div>
                            </td> 
                        </tr>
                        <?php
                        $pm_show_privacy_settings = $dbhandler->get_global_option_value('pm_show_privacy_settings','');
                        if($pm_show_privacy_settings == 1)
                        { ?>
                        <tr>
                           <th class="pm-field-lable">
                                <label for="pm_profile_privacy"><?php _e('Profile Privacy', 'profilegrid-user-profiles-groups-and-communities'); ?></label>
                            </th>
                            <td class="pm-field-input">              
                                 <select name="pm_profile_privacy" id="pm_profile_privacy">
                                    <option value="1" <?php selected($pm_profile_privacy,'1'); ?>><?php _e('Everyone','profilegrid-user-profiles-groups-and-communities');?></option>
                                    <option value="2" <?php selected($pm_profile_privacy,'2'); ?>><?php _e('Friends','profilegrid-user-profiles-groups-and-communities');?></option>
                                    <option value="3" <?php selected($pm_profile_privacy,'3'); ?>><?php _e('Group Members','profilegrid-user-profiles-groups-and-communities');?></option>
                                    <option value="4" <?php selected($pm_profile_privacy,'4'); ?>><?php _e('Friends &amp; Group Members','profilegrid-user-profiles-groups-and-communities');?></option>
                                    <option value="5" <?php selected($pm_profile_privacy,'5'); ?>><?php _e('Only Me','profilegrid-user-profiles-groups-and-communities');?></option>
                                </select>
                            </td> 
                        </tr>
                        <?php } ?>
                        
                        <?php $allowhiddenusers = $dbhandler->get_global_option_value('pm_allow_user_to_hide_their_profile','');
                        if($allowhiddenusers == 1)
                        { ?>
                        <tr>
                            <th class="pm-field-lable">
                                <label for="pm_hide_my_profile"><?php _e('Hide My Profile From Groups, Directories and Search Results', 'profilegrid-user-profiles-groups-and-communities'); ?></label>
                            </th>
                            <td class="pm-field-input">              
                                 <div class="pmradio">
                                    <div class="pm-radio-option">
                                        <input type="radio" class="pg-hide-privacy-profile" name="pm_hide_my_profile" value="0" <?php checked($pm_hide_my_profile,"0"); ?>> 
                                        <label class="pg-hide-my-profile"><?php _e('No','profilegrid-user-profiles-groups-and-communities');?></label>
                                    </div>
                                     <div class="pm-radio-option">
                                        <input type="radio" class="pg-hide-privacy-profile" name="pm_hide_my_profile" value="1" <?php checked($pm_hide_my_profile,"1"); ?> > 
                                        <label class="pg-hide-my-profile"><?php _e('Yes','profilegrid-user-profiles-groups-and-communities');?> </label>
                                    </div>

                                 </div>
                            </td> 
                        </tr>
             
                        <?php } ?>
                        
                </tbody>
            </table>
        <?php if(current_user_can('manage_options')):?>
            <table class="form-table">        
                        <tr>

                            <th class="pm-field-lable">
                                <label for="pm_field_37"><?php _e('User Group(s)', 'profilegrid-user-profiles-groups-and-communities'); ?></label>
                            </th>
                            <td class="pm-field-input">              
                                <select multiple name="pm_group[]" id="pm_group">
                                            <?php
                                            foreach ($groups as $group) {
                                                ?>
                                    <option value="<?php echo $group->id; ?>" <?php if (!empty($gid)){if(in_array($group->id,$gid)){echo 'selected';}} ?>><?php echo $group->group_name; ?></option>
                                    <?php } ?>
                                </select>
                                <p class="description"><?php _e('Press ctrl or ⌘ (in Mac) while clicking to assign multiple ProfileGrid Groups','profilegrid-user-profiles-groups-and-communities') ?></p>
                                <div class="errortext" style="display:none;"></div>
                            </td>
                        </tr>
                    </table>
        
        <?php
                endif;
		if(isset($fields) && !empty($fields)):
		if($lastRec=count($fields) && !empty($gid))
		{
			echo '<div class="pm_dashboard_custom_fields">';
			$i=0;
			foreach($fields as $field) 
			{
				$value = $pmrequests->profile_magic_get_user_field_value($user->ID,$field->field_key);
				//echo $value;die;
				$pm_customfields->pm_get_custom_form_fields($field,$value,$this->profile_magic);
				$i++;
			}
			echo '</div>';
		}
                endif;
                echo '<div class="all_errors" style="display:none;"></div>';
				
	}
	
	public function profile_magic_update_user_fields($user_id )
	{
                $dbhandler = new PM_DBhandler;
                $pmrequests = new PM_request;
                $pm_emails = new PM_Emails;
                $notification = new Profile_Magic_Notification;  
                $current_user = wp_get_current_user();
		if ( !current_user_can( 'edit_user', $user_id ))
		return FALSE;
		if(!isset($_POST['reg_form_submit']))
		{
			$is_update_profile_image = update_user_meta($user_id, 'pm_user_avatar', $_POST['pm_user_avatar']);
                        if($is_update_profile_image)
                        {
                            if($_POST['pm_user_avatar']=='')
                            {
                                do_action('pm_remove_profile_image',$user_id);
                            }
                            else
                            {
                                do_action('pm_update_profile_image',$user_id);
                            }
                            
                        }
                        
                        $is_update_cover_image = update_user_meta($user_id, 'pm_cover_image', $_POST['pm_cover_image']);
                        
                        if($is_update_cover_image)
                        {
                            if($_POST['pm_cover_image']=='')
                            {
                                do_action('pm_remove_cover_image',$user_id);
                            }
                            else
                            {
                                do_action('pm_update_cover_image',$user_id);
                            }
                        }
                        
                        $allowhiddenusers = $dbhandler->get_global_option_value('pm_allow_user_to_hide_their_profile','');
                        if($allowhiddenusers == 1)
                        { 
                        update_user_meta($user_id, 'pm_hide_my_profile', $_POST['pm_hide_my_profile']);
                        }
                        
                        $pm_show_privacy_settings = $dbhandler->get_global_option_value('pm_show_privacy_settings','');
                        if($pm_show_privacy_settings == 1)
                        { 
                            update_user_meta($user_id, 'pm_profile_privacy', $_POST['pm_profile_privacy']);
                        }
                        $gids = $pmrequests->profile_magic_get_user_field_value($user_id,'pm_group');
                        $gid = $pmrequests->pg_filter_users_group_ids($gids);
			if(!empty($gid))
                        {
                            $exclude = "associate_group in(".implode(',',$gid).") and field_type not in('first_name','last_name','user_name','user_email','user_url','user_pass','confirm_pass','description','file','user_avatar','heading','paragraph')";
                            $fields =  $dbhandler->get_all_result('FIELDS','*',1,'results',0,false,'ordering',false,$exclude);
                        }
                        else
                        {
                            $fields = array();
                        }
                        $pmrequests->pm_update_user_custom_fields_data($_POST,$_FILES,$_SERVER,$gid,$fields,$user_id);
                        
                        if(!isset($_POST['pm_group']))
                        {
                            $_POST['pm_group'] = array();
                        }
			
                        add_user_meta($user_id, 'rm_user_status',0,true);
                        
                        if(current_user_can('manage_options'))
                        {  
                            update_user_meta($user_id, 'pm_group', $_POST['pm_group']);
                            $new_groups = array_diff($_POST['pm_group'], $gid);
                            $old_groups = array_diff($gid, $_POST['pm_group']);

                            foreach($old_groups as $o_id)
                            {
                                $notification->pm_removed_old_group_notification($user_id,$o_id);
                                if($current_user->ID != $user_id)
                                {
                                    $pm_emails->pm_send_remove_from_group_user_notification($user_id, $o_id);
                                }
                            }

                            foreach($new_groups as $n_gid)
                            {
                                $notification->pm_joined_new_group_notification($user_id,$n_gid);
                            }
                        
                        }
		}
	}
        
        public function profile_magic_activate_user_by_email()
        {
            $pmemails = new PM_Emails;
            $req = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
            $pmrequests = new PM_request;
            $req_deco = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$req);
            $user_data = json_decode($req_deco);
            $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));

        if ($user_data->activation_code == get_user_meta($user_data->user_id, 'pm_activation_code', true)) 
        {
            $gids = get_user_meta($user_data->user_id, 'pm_group', true);
            $gid = $pmrequests->pg_filter_users_group_ids($gids);
            $primary_group = $pmrequests->pg_get_primary_group_id($gid);
            if(!empty($gid))
            {   
                $pmemails->pm_send_group_based_notification($primary_group,$user_data->user_id,'on_user_activate');
            }
            update_user_meta($user_data->user_id,'rm_user_status',0);
            if (!delete_user_meta($user_data->user_id, 'pm_activation_code')) {
                 $redirect_url = add_query_arg( 'errors','ajx_failed_del', $redirect_url );
            }
            else
            {
               $message = __('You have successfully activated the user.','profilegrid-user-profiles-groups-and-communities');
                $redirect_url = add_query_arg( 'activated','success', $redirect_url );
            }
        }
        else 
        {
             $message = __('Failed to upadte user information.Can not activate user','profilegrid-user-profiles-groups-and-communities');
             $redirect_url = add_query_arg( 'errors','invalid_code', $redirect_url );
        }
       wp_redirect( esc_url_raw( $redirect_url ) );exit;
        die;
        }
        
        public function pm_load_export_fields_dropdown()
        {
            include 'partials/export-fields.php';
            die;
        }
        
        public function pm_upload_csv()
        {
            include 'partials/pm-import-ajax.php';
            die;
        }
        
        public function pm_upload_json()
        {
           // echo 'test';die;
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $current_user = wp_get_current_user();
            $pmexportimport = new PM_Export_Import;
            $post = isset($_POST) ? $_POST: array();
            $filefield = $_FILES['uploadjson'];
            $allowed_ext ='json';
            if(isset($filefield) && !empty($filefield))
            {
            $attachment_id = $pmrequests->make_upload_and_get_attached_id($filefield,$allowed_ext);
            if(is_numeric($attachment_id))
            {
                $filepath = get_attached_file($attachment_id); 
                $filecontent = file_get_contents($filepath);

                $options_data = json_decode($filecontent);
                foreach($options_data as $data)
                {
                    if(is_object($data))
                    {
                         $dbhandler->update_global_option_value($data->option_name,$data->option_value);
                    }
                    elseif(is_array($data))
                    {
                         $dbhandler->update_global_option_value($data[0],$data[1]);
                    }

                }
                echo '<div class="uimrow">'.__('Your configuration file was successfully imported and included settings have been applied.','profilegrid-user-profiles-groups-and-communities').'</div>';
                
            }
            else
            {
                echo '<div class="uimrow" style="color:red;">'.$attachment_id.'</div>';
            }
            }
            else
            {
                echo '<div class="uimrow" style="color:red;">'.__('Select a JSON file earlier exported from ProfileGrid.','profilegrid-user-profiles-groups-and-communities').'</div>';
            }
            
            die;
        }
        
        public function profile_grid_myme_types($mime_types)
        {
            $mime_types['csv'] = 'text/csv';
            $mime_types['json'] = 'application/json';
            return $mime_types;
        }
        
        public function profile_magic_show_feedback_form()
        {
            $path =  plugin_dir_url(__FILE__);
           ?>
            <div class="pmagic uimagic">
            <div id="pg-deactivate-feedback-dialog-wrapper" class="pg-modal-view" style="display: none">
                <div class="pg-modal-overlay" style="display: none"></div>
                
               <div class="pg-modal-wrap pg-deactivate-feedback"> 
                   <div class="pg-modal-titlebar">
                               <div class="pg-modal-title"><?php _e('ProfileGrid Feedback','profilegrid-user-profiles-groups-and-communities');?> </div>
                               <div class="pg-modal-close">&times;</div>
                           </div>
                   
                   <form id="pg-deactivate-feedback-dialog-form" method="post">
                       <input type="hidden" name="action" value="pg_deactivate_feedback" />
                   <div class="pg-modal-container">
                <div class="uimrow">
                <div id="pg-deactivate-feedback-dialog-form-caption"><?php _e('If you have a moment, please share why you are deactivating ProfileGrid:','profilegrid-user-profiles-groups-and-communities');?></div>
                <div id="pg-deactivate-feedback-dialog-form-body">
                    <div class="pg-deactivate-feedback-dialog-input-wrapper">
                        <input id="pg-deactivate-feedback-feature_not_available" class="pg-deactivate-feedback-dialog-input" type="radio" name="pg_feedback_key" value="feature_not_available">
                        <label for="pg-deactivate-feedback-feature_not_available" class="pg-deactivate-feedback-dialog-label"><span class="pg-feedback-emoji">&#x1f61e;</span><?php _e("Doesn't have the feature I need","profilegrid-user-profiles-groups-and-communities");?></label>
                        <div class="pginput" id="pg_reason_feature_not_available" style="display:none"><input class="pg-feedback-text" type="text" name="pg_reason_feature_not_available" placeholder="<?php _e("Please let us know the missing feature...","profilegrid-user-profiles-groups-and-communities");?>"></div>
                    </div>
                    <div class="pg-deactivate-feedback-dialog-input-wrapper">
                        <input id="pg-deactivate-feedback-feature_not_working" class="pg-deactivate-feedback-dialog-input" type="radio" name="pg_feedback_key" value="feature_not_working" >
                        <label for="pg-deactivate-feedback-feature_not_working" class="pg-deactivate-feedback-dialog-label"><span class="pg-feedback-emoji">&#x1f615;</span><?php _e("One of the features didn't worked","profilegrid-user-profiles-groups-and-communities");?></label>
                        <div class="pginput" id="pg_reason_feature_not_working" style="display:none"><input class="pg-feedback-text" type="text" name="pg_reason_feature_not_working" placeholder="<?php _e("Please let us know the feature, like 'emails notifications'","profilegrid-user-profiles-groups-and-communities");?>"></div>
                    </div>
                    <div class="pg-deactivate-feedback-dialog-input-wrapper">
                        <input id="pg-deactivate-feedback-found_a_better_plugin" class="pg-deactivate-feedback-dialog-input" type="radio" name="pg_feedback_key" value="found_a_better_plugin" >
                        <label for="pg-deactivate-feedback-found_a_better_plugin" class="pg-deactivate-feedback-dialog-label"><span class="pg-feedback-emoji">&#x1f60a;</span><?php _e("Moved to a different plugin","profilegrid-user-profiles-groups-and-communities");?></label>
                        <div class="pginput" id="pg_reason_found_a_better_plugin" style="display:none"><input class="pg-feedback-text" type="text" name="pg_reason_found_a_better_plugin" placeholder="<?php _e("Could you please share the plugin's name","profilegrid-user-profiles-groups-and-communities");?>"></div>
                    </div>
                    <div class="pg-deactivate-feedback-dialog-input-wrapper">
                        <input id="pg-deactivate-feedback-plugin_broke_site" class="pg-deactivate-feedback-dialog-input" type="radio" name="pg_feedback_key" value="plugin_broke_site">
                        <label for="pg-deactivate-feedback-plugin_broke_site" class="pg-deactivate-feedback-dialog-label"><span class="pg-feedback-emoji">&#x1f621;</span><?php _e("The plugin broke my site","profilegrid-user-profiles-groups-and-communities");?></label>
                    </div>
                    <div class="pg-deactivate-feedback-dialog-input-wrapper">
                        <input id="pg-deactivate-feedback-plugin_stopped_working" class="pg-deactivate-feedback-dialog-input" type="radio" name="pg_feedback_key" value="plugin_stopped_working">
                        <label for="pg-deactivate-feedback-plugin_stopped_working" class="pg-deactivate-feedback-dialog-label"><span class="pg-feedback-emoji">&#x1f620;</span><?php _e("The plugin suddenly stopped working","profilegrid-user-profiles-groups-and-communities");?></label>
                    </div>
                    <div class="pg-deactivate-feedback-dialog-input-wrapper">
                        <input id="pg-deactivate-feedback-temporary_deactivation" class="pg-deactivate-feedback-dialog-input" type="radio" name="pg_feedback_key" value="temporary_deactivation">
                        <label for="pg-deactivate-feedback-temporary_deactivation" class="pg-deactivate-feedback-dialog-label"><span class="pg-feedback-emoji">&#x1f60a;</span><?php _e("It's a temporary deactivation","profilegrid-user-profiles-groups-and-communities");?></label>
                    </div>
                    
                    <div class="pg-deactivate-feedback-dialog-input-wrapper">
                        <input id="pg-deactivate-feedback-other" class="pg-deactivate-feedback-dialog-input" type="radio" name="pg_feedback_key" value="other">
                        <label for="pg-deactivate-feedback-other" class="pg-deactivate-feedback-dialog-label"><span class="pg-feedback-emoji">&#x1f610;</span><?php _e("Other","profilegrid-user-profiles-groups-and-communities");?></label>
                        <div class="pginput" id="pg_reason_other"  style="display:none"><input class="pg-feedback-text" type="text" name="pg_reason_other" placeholder="<?php _e("Please share the reason","profilegrid-user-profiles-groups-and-communities");?>"></div>
                    </div>
                </div>

            </div>
                   </div>
                       
                          <div class="pg-ajax-loader" style="display:none">
                              <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                <span class=""><?php _e("Loading...","profilegrid-user-profiles-groups-and-communities");?></span>
                                </div>
                       
                       <div class="pg-modal-footer uimrow">
                                <input type="button" id="pg-feedback-btn" value="<?php _e("Submit & Deactivate","profilegrid-user-profiles-groups-and-communities");?>"/>
                                <input type="button" id="pg-feedback-cancel-btn" value="<?php _e("Cancel","profilegrid-user-profiles-groups-and-communities");?>"/>
                                </div>
                       
                   </form>
               </div>
   
        
</div>
            </div>
            <?php
        }
        
        public function pg_post_feedback(){
        $msg= $_POST['msg'];
        $feedback= $_POST['feedback'];
        $message= '';
        $pmrequests = new PM_request;
        $from_email_address = $pmrequests->profile_magic_get_from_email();
        switch($feedback)
        {
            case 'feature_not_available': $body='Feature not available: '; break;
            case 'feature_not_working': $body='Feature not working: '; break;
            case 'found_a_better_plugin': $body='Found a better plugin: '; break;
            case 'plugin_broke_site': $body='Plugin broke my site.'; break;
            case 'plugin_stopped_working': $body='Plugin stopped working'; break;
            case 'temporary_deactivation': $body = "It's a temporary deactivation"; break;
            case 'upgrade':  $body='Upgrading to premium '; break;   
            case 'other': $body='Other: '; break;
            default: return;
        }
        if(!empty($feedback))
        {
            $message .= $body."\n\r";
            if(!empty($msg))
            {
                $message .= $msg."\n\r";
            }
            $message .= "\n\r ProfileGrid Version - ".PROGRID_PLUGIN_VERSION;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8\r\n";
            $headers .= 'From:'.$from_email_address. "\r\n";
            wp_mail('feedback@profilegrid.co','PG Feedback',$message,$headers);
            die;
        }
    }
    
    public function pg_frontend_group_short_code()
    {
        $pg_function = new Profile_Magic_Basic_Functions($this->profile_magic,$this->version);
        $link = $pg_function->pg_get_extension_shortcode('FRONTEND_GROUP');
        $path =  plugin_dir_url(__FILE__);
        $html = '
            <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle">'.__("Group Creation Form","profilegrid-user-profiles-groups-and-communities").'</div>
            <div class="pg-scblock"><span class="pg-code">'.$link.'</span></div>
            <div class="pg-scblock"><img class="pg-scimg" src="'.$path.'partials/images/sc-12.png"></div>
            <div class="pg-scblock pg-scdesc">'.__("Allow registered users to create new Groups on front end. These Groups behave and work just like regular ProfileGrid groups.","profilegrid-user-profiles-groups-and-communities").'</div>
            </div>';
        $html = apply_filters( 'pg_filter_frontend_group_shortcode',$html);
        echo $html; 
    }
    
    public function pg_geolocation_short_code()
    {
        $pg_function = new Profile_Magic_Basic_Functions($this->profile_magic,$this->version);
        $link = $pg_function->pg_get_extension_shortcode('GEOLOCATION');
        $path =  plugin_dir_url(__FILE__);
        $html = '
            <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle">'.__("Generate User Map","profilegrid-user-profiles-groups-and-communities").'</div>
            <div class="pg-scblock"><span class="pg-code">'.$link.'</span></div>
            <div class="pg-scblock"><img class="pg-scimg" src="'.$path.'partials/images/sc-11.png"></div>
            <div class="pg-scblock pg-scdesc">'.__("Generate maps showing locations of all users or specific groups using simple shortcodes. Get location data from registration form.","profilegrid-user-profiles-groups-and-communities").'</div>
            </div>';
        $html = apply_filters( 'pg_filter_geolocation_shortcode',$html);
        echo $html; 
    }
    
    public function pg_groupwall_short_code()
    {
        $pg_function = new Profile_Magic_Basic_Functions($this->profile_magic,$this->version);
        $link = $pg_function->pg_get_extension_shortcode('GROUPWALL');
        $path =  plugin_dir_url(__FILE__);
        $html = '
            <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle">'.__("Wall Post Submission Form","profilegrid-user-profiles-groups-and-communities").'</div>
            <div class="pg-scblock"><span class="pg-code">'.$link.'</span></div>
            <div class="pg-scblock"><img class="pg-scimg" src="'.$path.'partials/images/sc-13.jpg"></div>
            <div class="pg-scblock pg-scdesc">'.__("Allows group members to write and submit posts to their group wall. Users can also upload and attach images to their wall posts.","profilegrid-user-profiles-groups-and-communities").'</div>
            </div>';
        $html = apply_filters( 'pg_filter_groupwall_shortcode',$html);
        echo $html; 
    }
    
    public function pg_get_footer_banner()
    {
         $path =  plugin_dir_url(__FILE__);
         
        ?>
            <div class="pg-footer-banner"><a href="admin.php?page=pm_extensions"><img src="<?php echo $path;?>partials/images/extension_banner.png" /></a></div>
        <?php
    }
    
    public function pm_dismissible_notice()
    {
         $dbhandler = new PM_DBhandler;
         $pmrequests = new PM_request;
         $notice_name = $dbhandler->get_global_option_value('pg_dismissible_plugin','0');
         $is_pg_page = $pmrequests->is_pg_dashboard_page();
         if($notice_name=='1') { return;}
         if($is_pg_page==false){return;}
         ?>
        <div class="notice notice-info is-dismissible pg-dismissible" id="pg_dismissible_plugin">
        <p><?php _e( "If you are testing multiple user profile plugins for WordPress, there's a chance that one or more of them can override ProfileGrid's functionality. If something is not working as expected, please try turning them off. A very common example is profile image upload feature not working.", 'profilegrid-user-profiles-groups-and-communities' ); ?></p>
        </div>
        <?php
    }
    
    public function pm_dismissible_notice_ajax()
    {
        $dbhandler = new PM_DBhandler;
        $notice_name = $_POST['notice_name'];
        $col = $dbhandler->update_global_option_value($notice_name,'1');
        $default = array();
        if(isset($_POST['rm_form_id']))
        {
            $rmformid = $_POST['rm_form_id'];
            $get_value = maybe_unserialize(get_option('pg_rm_change_form_type',$default));
            if(isset($get_value[$rmformid]))
            {
                unset($get_value[$rmformid]);
                $dbhandler->update_global_option_value('pg_rm_change_form_type',$get_value);
                
            }
            delete_option('pg_rm_change_form_type_'.$rmformid);
            delete_option('pg_rm_change_form_type_group_name_'.$rmformid);
        }
        die;
    }
    
    public function pm_dismissible_woocommerce_notice()
    {
         $dbhandler = new PM_DBhandler;
         $pmrequests = new PM_request;
         $url = 'https://profilegrid.co/extensions/woocommerce-integration/';
         $notice_name = $dbhandler->get_global_option_value('pg_woocommerce_ext_notice','0');
         $is_pg_page = $pmrequests->is_pg_dashboard_page();
         if($notice_name=='1') { return;}
         if($is_pg_page==false){return;}
         
         if (class_exists('Profile_Magic') &&  class_exists('WooCommerce') && !class_exists('Profilegrid_Woocommerce') ) {
             ?>
            <div class="notice notice-info is-dismissible pg-dismissible" id="pg_woocommerce_ext_notice">
            <p><?php echo sprintf(__( "If you wish to integrate WooCommerce data with ProfileGrid user profiles, please download WooCommerce extension from <a target='_blank' href='%s'>here.</a>", 'profilegrid-user-profiles-groups-and-communities' ),$url); ?></p>
            </div>
        <?php
         }
    }
    
    public function pm_dismissible_custom_profile_tab_notice()
    {
        $dbhandler = new PM_DBhandler;
         $pmrequests = new PM_request;
         $url = 'https://profilegrid.co/extensions/custom-user-profile-tabs-content/';
         $notice_name = $dbhandler->get_global_option_value('pg_custom_tab_ext_notice','0');
         $is_pg_page = $pmrequests->is_pg_dashboard_page();
         if($notice_name=='1') { return;}
         if($is_pg_page==false){return;}
         
         if (class_exists('Profile_Magic') &&  class_exists('WooCommerce') && class_exists('Profilegrid_Woocommerce') && !class_exists('Profilegrid_User_Content') ) {
             ?>
            <div class="notice notice-info is-dismissible pg-dismissible" id="pg_custom_tab_ext_notice">
            <p><?php echo sprintf(__( "Do you wish to display information from WooCommerce extensions and other WordPress plugins inside frontend user profiles? Try our Custom Profile Tabs extension, which can turn user profiles into powerful hubs with all user specific information in one place! <a target='_blank' href='%s'>Get it here.</a>", 'profilegrid-user-profiles-groups-and-communities' ),$url); ?></p>
            </div>
        <?php
         }
    }
    
    public function pm_dismissible_bbpress_notice()
    {
        $dbhandler = new PM_DBhandler;
         $pmrequests = new PM_request;
         $url = 'https://profilegrid.co/extensions/custom-user-profile-tabs-content/';
         $notice_name = $dbhandler->get_global_option_value('pg_bbpress_ext_notice','0');
         $is_pg_page = $pmrequests->is_pg_dashboard_page();
         if($notice_name=='1') { return;}
         //if($is_pg_page==false){return;}
         
         if (class_exists('Profile_Magic') &&  is_plugin_active( 'bbpress/bbpress.php' ) && class_exists('Profilegrid_Bbpress') && !class_exists('Profilegrid_User_Content') ) {
             ?>
            <div class="notice notice-info is-dismissible pg-dismissible" id="pg_bbpress_ext_notice">
            <p><?php echo sprintf(__( "Do you wish to display information from bbPress extensions and other WordPress plugins inside frontend user profiles? Try our Custom Profile Tabs extension, which can turn user profiles into powerful hubs with all user specific information in one place! <a target='_blank' href='%s'>Get it here.</a>", 'profilegrid-user-profiles-groups-and-communities' ),$url); ?></p>
            </div>
        <?php
         }
    }
    
    
    
    public function pm_check_associate_email_tmpl()
    {
        $pmrequests = new PM_request;
        $selected = $_POST['searchIDs'];
        $count_selected =  count($selected);
        $msg = '';
	foreach($selected as $tid)
	{
                $exist_tmpl = $pmrequests->pg_check_email_template_if_used_in_any_group($tid);
                if($exist_tmpl!=false)
                {
                    if($count_selected>1)
                    {
                        $msg = __('One or more email templates you are trying to delete are being used for notifications by a group. Please disassociate them before attempting to delete.','profilegrid-user-profiles-groups-and-communities');
                    }
                    else
                    {
                        $msg = __('The Email Template you are trying to delete is being used for notifications by 1 or more user groups. Disassociate the template from all associated groups before deleting.','profilegrid-user-profiles-groups-and-communities');
                    }  
                    
                }    
	}
        echo $msg;
        die;
    }
    
    public function pm_groups_widget()
    {
        register_widget('Profilegrid_Groups_Menu');
    }
    
    public function pm_group_option_update()
    {
        $dbhandler = new PM_DBhandler;
        $pmrequest = new PM_request;
                
        $pg_main_groups =  $dbhandler->get_all_result('GROUPS',array('id'), $where = 1, $result_type = 'results', $offset = 0, $limit = false, $sort_by = null, $descending = false, $additional='', $output='ARRAY_A', $distinct = false);
        if(!empty($pg_main_groups))
        {
            $pg_groups= $pmrequest->pm_to_array($pg_main_groups);
            $group_menu = get_option('pg_group_menu');
            if(!empty($group_menu))
            {        
                update_option('pg_group_menu',$pg_groups );
            }
            else
            {
                if(isset($pg_groups)):
                    $tmp = $group_menu;
                    if(isset($group_menu) && is_array($group_menu) && !empty($group_menu))
                    {
                        sort($group_menu);
                    }
                    if(isset($pg_groups) && is_array($pg_groups) && !empty($pg_groups))
                    {
                        sort($pg_groups);  
                    }
                endif;
                if($group_menu == $pg_groups):
                    update_option('pg_group_menu',$tmp );
                else:
                    update_option('pg_group_menu',$pg_groups);
                    update_option('pg_group_list',$pg_groups );
                endif;
            }
            $group_list = get_option('pg_group_list');
            if(!$group_list)
            {
                update_option('pg_group_list',$pg_groups );
            }
            $pg_group_icon = get_option('pg_group_icon');
            if(!$pg_group_icon)
            {
                update_option('pg_group_icon','yes' );
            }
        }   
    }
    
    public function pg_groupleader_assign_remove_fun($gid,$prev_is_leader,$prev_group_leaders,$new_is_leader,$new_group_leaders)
    {
        $pmemails = new PM_Emails;
            $is_remove = false;
            $is_assign = false;
            $new_group_leaders = maybe_unserialize($new_group_leaders);
            $admins_removed = array_diff($prev_group_leaders, $new_group_leaders);
            $admins_added = array_diff($new_group_leaders,$prev_group_leaders);
            if($prev_is_leader!='' && $prev_is_leader==1 && $new_is_leader==0 )
            {
               if(!empty($prev_group_leaders))
                {
                    foreach($prev_group_leaders as $old_admin)
                    {
                        $user_data = get_user_by('ID', $old_admin);
                        $pmemails->pm_send_group_based_notification($gid,$user_data->ID,'on_admin_removal');
                        do_action('pm_unassign_group_manager_privilege',$gid,$user_data->ID);
                    }
                }
               
            }
            else
            {
                if(!empty($admins_added))
                {
                    foreach($admins_added as $new_admin)
                    {
                        $user_data = get_user_by('ID', $new_admin);
                        $pmemails->pm_send_group_based_notification($gid,$user_data->ID,'on_admin_assignment');
                         do_action('pm_assign_group_manager_privilege',$gid,$user_data->ID);
                    }
                }
                if(!empty($admins_removed))
                {
                    foreach($admins_removed as $old_admin)
                    {
                        $user_data = get_user_by('ID', $old_admin);
                        $pmemails->pm_send_group_based_notification($gid,$user_data->ID,'on_admin_removal');
                        do_action('pm_unassign_group_manager_privilege',$gid,$user_data->ID);
                    }
                }
            }
        return;
    }
    
    public function rm_form_type_changed_fun($form_id,$form_type,$previous_form_type)
    {
        $pmrequest = new PM_request;
        $dbhandler = new PM_DBhandler;
        $is_associate = $pmrequest->pm_check_rm_form_associate_with_groups($form_id);
        if(!empty($is_associate) && $form_type!='1' && $previous_form_type =='1' )
        {
            $group_name = array();
            foreach($is_associate as $group)
            {
                $group_name[] = $dbhandler->get_value('GROUPS','group_name',$group);
                $group_options = maybe_unserialize($dbhandler->get_value('GROUPS','group_options',$group));
                $group_options['pg_rm_form'] = "0";
                
                $dbhandler->update_row('GROUPS','id',$group,array('group_options'=>maybe_serialize($group_options)),array('%s'),'%d');
            }
            if(!empty($group_name))
            {
                $name = implode(',', $group_name);
            }
            else
            {
                $name ='';
            }
            
            $default = array();
            $get_value = maybe_unserialize(get_option('pg_rm_change_form_type',$default));
            $get_value[] = $form_id;
            update_option('pg_rm_change_form_type', $get_value);
            update_option('pg_rm_change_form_type_'.$form_id, $form_id);
            update_option('pg_rm_change_form_type_group_name_'.$form_id,$name);
        }
    }
    
    public function pm_dismissible_rm_form_type_changed()
    {
        $pmrequest = new PM_request;
        $dbhandler = new PM_DBhandler;
        $default = array();
        $get_value = maybe_unserialize(get_option('pg_rm_change_form_type',$default));
        
        if(!empty($get_value)) {
            foreach($get_value as $form_id)
            {
                $get_form_option = get_option("pg_rm_change_form_type_$form_id",'');
                if($get_form_option!='')
                {
                    $name = get_option("pg_rm_change_form_type_group_name_$form_id",'');
                     ?>
            <div class="notice notice-info is-dismissible pgrm-dismissible" id="pg_rm_change_form_type_<?php echo $form_id;?>" data-rmid="<?php echo $form_id;?>">
                            <p><?php echo sprintf(__("%s registration form has been reverted to default ProfileGrid form since the associated RegistrationMagic form was deleted or its type was changed.",'profilegrid-user-profiles-groups-and-communities'),$name);  ?></p>
                        </div>
                    <?php
                }
            }
         }
    }
    
    public function rm_user_deactivated($uid)
    {
        $pmrequests = new PM_request;
        $pmemails = new PM_Emails;
        $ugids = get_user_meta($uid,'pm_group',true);
        $ugid = $pmrequests->pg_filter_users_group_ids($ugids);
        $primary_group = $pmrequests->pg_get_primary_group_id($ugid);
        $pmemails->pm_send_group_based_notification($primary_group,$uid,'on_user_deactivate');
    }
    public function pm_dismissible_pg3_notice()
    {
        $dbhandler = new PM_DBhandler;
         $pmrequests = new PM_request;
         
         $notice_name = $dbhandler->get_global_option_value('pg3_update_notice','0');
         $is_pg_page = $pmrequests->is_pg_dashboard_page();
         if($notice_name=='1') { return;}
         //if($is_pg_page==false){return;}
         
         if (class_exists('Profile_Magic')) {
             ?>
            <div class="notice notice-error is-dismissible pg-dismissible" id="pg3_update_notice">
            <p><?php printf(__( "<b style='color:red;'>Important!</b> You have recently upgraded to ProfileGrid 3.0. If you are using any ProfileGrid extensions, please update them to their latest versions immediately for maximum compatibility. <a target='_blank' href='%s'>You can download latest version of extensions you have purchased from here.</a>", 'profilegrid-user-profiles-groups-and-communities' ),'https://profilegrid.co/checkout/purchase-history/'); ?></p>
            </div>
        <?php
         }
    }
    
    public function rm_form_deleted_fun($form_id)
    {
        $this->rm_form_type_changed_fun($form_id,'2','1');
    }
    
    public function pm_get_rm_helptext()
    {
        
        $dbhandler = new PM_DBhandler;
        $form_id = $_POST['id'];
        if($form_id=="0")
        {
            echo "'Default' sets up the group registration form using this group's profile fields";
        }
        else
        {
            $form_name = $dbhandler->get_value('FORMS','form_name',$form_id);
            echo "This sets up the RegistrationMagic form <a target='_blank' href='admin.php?page=rm_form_sett_manage&rm_form_id=".$form_id."'>".$form_name."</a> as this group's registration form";
        }
        die;
    }
    public function profilegrid_user_blogs_widgets()
    {
        register_widget('Profilegrid_User_Blogs');
    }
    
    public function profilegrid_user_login_widgets()
    {
        register_widget('Profilegrid_User_login');
    }
    //register our meta box for our links
    public function individual_user_group_add_meta_box(){
        add_meta_box(
            'group_pages_menu_metabox',
            __('Individual User Group', 'individual-user-group-to-menu'),
            array($this, 'individual_user_group_display_meta_box'),
            'nav-menus',
            'side',
            'low'
        );
        add_meta_box(
            'user_profile_pages_menu_metabox',
            __('Individual User Profile', 'individual-user-profile-to-menu'),
            array($this, 'individual_user_profile_display_meta_box'),
            'nav-menus',
            'side',
            'low'
        );
        
    }
    
    public function individual_user_group_display_meta_box()
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $groups = $dbhandler->get_all_result('GROUPS');
        //print_r($groups);
        ?>
       
    <div id="posttype-group-pages" class="posttypediv">
        <div id="tabs-panel-group-pages" class="tabs-panel tabs-panel-active">
            
            <ul id="group-pages" class="categorychecklist form-no-clear">
                <!--Custom -->
                <?php
                //loop through all registered content types that have 'has-group' enabled 
                
                if(!empty($groups)){
                    $counter = -1;
                    foreach($groups as $group){
                        $group_name = $group->group_name;
                        $group_page_link = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$group->id);
                        $group_page_link = add_query_arg( 'gid',$group->id,$group_page_link );
                        ?>
                        <li>
                            <label class="menu-item-title">
                                <input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo $counter; ?>][menu-item-object-id]" value="-1"/><?php echo $group_name; ?>
                            </label>
                            <input type="hidden" class="menu-item-type" name="menu-item[<?php echo $counter; ?>][menu-item-type]" value="custom"/>
                            <input type="hidden" class="menu-item-title" name="menu-item[<?php echo $counter; ?>][menu-item-title]" value="<?php echo $group_name; ?>"/>
                            <input type="hidden" class="menu-item-url" name="menu-item[<?php echo $counter; ?>][menu-item-url]" value="<?php echo $group_page_link; ?>"/>
                            <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo $counter; ?>][menu-item-classes]"/>
                        </li>
                        <?php
                        $counter--;
                    }
                }?>     
            </ul>
        </div>
        <p class="button-controls">
            <span class="list-controls">
                <a href="<?php echo admin_url('nav-menus.php?page-tab=all&selectall=1#posttype-group-pages'); ?>" class="select-all"> <?php _e('Select All', 'group-pages-to-menu' ); ?></a>
            </span>
            <span class="add-to-menu">
                <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php _e('Add to Menu', 'group-pages-to-menu') ?>" name="add-post-type-menu-item" id="submit-posttype-group-pages">
                <span class="spinner"></span>
            </span>
        </p>
    </div>    
        <?php
    }
    
    public function individual_user_profile_display_meta_box()
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $meta_query = $pmrequests->pm_get_user_meta_query(array());
        $user_query = $dbhandler->pm_get_all_users_ajax('',$meta_query);
       
        $users = $user_query->get_results();
        //print_r($groups);
        ?>
       
    <div id="posttype-user-pages" class="posttypediv">
        <div id="tabs-panel-user-pages" class="tabs-panel tabs-panel-active">
           
            <ul id="user-pages" class="categorychecklist form-no-clear">
                <!--Custom -->
                <?php
                //loop through all registered content types that have 'has-group' enabled 
                
                if(!empty($users)){
                    $counter = -1;
                    foreach($users as $user){
                        $group_name = $user->display_name;
                        $uid = $user->ID;
                        $profile_url = get_permalink($dbhandler->get_global_option_value('pm_user_profile_page'));
                        $slug = $pmrequests->pm_get_profile_slug_by_id($uid);
                        $profile_url = add_query_arg( 'uid',$slug,$profile_url );
                        ?>
                        <li>
                            <label class="menu-item-title">
                                <input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo $counter; ?>][menu-item-object-id]" value="-1"/><?php echo $group_name; ?>
                            </label>
                            <input type="hidden" class="menu-item-type" name="menu-item[<?php echo $counter; ?>][menu-item-type]" value="custom"/>
                            <input type="hidden" class="menu-item-title" name="menu-item[<?php echo $counter; ?>][menu-item-title]" value="<?php echo $group_name; ?>"/>
                            <input type="hidden" class="menu-item-url" name="menu-item[<?php echo $counter; ?>][menu-item-url]" value="<?php echo $profile_url; ?>"/>
                            <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo $counter; ?>][menu-item-classes]"/>
                        </li>
                        <?php
                        $counter--;
                    }
                }?>     
            </ul>
        </div>
        <p class="button-controls">
            <span class="list-controls">
                <a href="<?php echo admin_url('nav-menus.php?page-tab=all&selectall=1#posttype-user-pages'); ?>" class="select-all"> <?php _e('Select All', 'user-pages-to-menu' ); ?></a>
            </span>
            <span class="add-to-menu">
                <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php _e('Add to Menu', 'user-pages-to-menu') ?>" name="add-post-type-menu-item" id="submit-posttype-user-pages">
                <span class="spinner"></span>
            </span>
        </p>
    </div>    
        <?php
    }
    
    public function pg_create_group_page()
    {
        $dbhandler = new PM_DBhandler;
        $gid = filter_input(INPUT_POST, 'gid');
        $identifier = 'GROUPS';
        $row = $dbhandler->get_row($identifier,$gid);
	if($row->group_options!="")
        {
            $group_options = maybe_unserialize($row->group_options);
        }
        
        $group_name = 'User Group - '.$dbhandler->get_value('GROUPS','group_name',$gid);
        $arg = array('post_type' => 'page','post_title' =>$group_name,'post_status' => 'publish','post_content' => '[PM_Group id="'.$gid.'"]');
        $id = wp_insert_post($arg);
        
        $group_options['group_page']=$id;
        $options = maybe_serialize($group_options);
        $data = array('group_options'=>$options);
        $args = array('%s');
        $dbhandler->update_row($identifier,'id',$gid,$data,$args,'%d');
        
        echo $id;
        die;
    }
      
}
