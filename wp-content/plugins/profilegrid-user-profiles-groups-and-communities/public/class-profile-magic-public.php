<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profilegrid.co
 * @since      1.0.0
 *
 * @package    Profile_Magic
 * @subpackage Profile_Magic/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Profile_Magic
 * @subpackage Profile_Magic/public
 * @author     ProfileGrid <support@profilegrid.co>
 */
class Profile_Magic_Public {

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
         * @param      string    $profile_magic       The name of the plugin.
         * @param      string    $version    The version of this plugin.
         */
        public function __construct( $profile_magic, $version ) {
                $dbhandler = new PM_DBhandler;
                $this->profile_magic = $profile_magic;
                $this->version = $version;
                $this->pm_theme  = $dbhandler->get_global_option_value('pm_style','default');

        }

        /**
         * Register the stylesheets for the public-facing side of the site.
         *
         * @since    1.0.0
         */
        public function enqueue_styles() 
        {
             $dbhandler = new PM_DBhandler;
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
            
            wp_enqueue_style( 'jquery-ui-styles' );
            wp_enqueue_style( $this->profile_magic, plugin_dir_url( __FILE__ ) . 'css/profile-magic-public.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'pg-responsive', plugin_dir_url( __FILE__ ) . 'css/pg-responsive-public.css', array(), $this->version, 'all' );
            wp_enqueue_style('jquery.Jcrop.css', plugin_dir_url( __FILE__ ) . 'css/jquery.Jcrop.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'pm-emoji-picker', plugin_dir_url( __FILE__ ) . 'css/emoji.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'pm-emoji-picker-nanoscroller', plugin_dir_url( __FILE__ ) . 'css/nanoscroller.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'pm-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'pg-password-checker', plugin_dir_url( __FILE__ ) . 'css/pg-password-checker.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'pg-profile-menu', plugin_dir_url( __FILE__ ) . 'css/pg-profile-menu.css', array(), $this->version, 'all' );
            if($dbhandler->get_global_option_value('pm_theme_type','light')=='dark')
            {
                wp_enqueue_style( 'pg-dark-theme', plugin_dir_url( __FILE__ ) . 'css/pg-dark-theme.css', array(), $this->version, 'all' );
            }
        }

        /**
         * Register the JavaScript for the public-facing side of the site.
         *
         * @since    1.0.0
         */
        public function enqueue_scripts() {

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
                $dbhandler = new PM_DBhandler;
                $pmrequests = new PM_request;
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-dialog');
                wp_enqueue_script('jquery-ui-autocomplete');
                //wp_enqueue_script('jquery-ui-tabs');
                wp_enqueue_script( 'profile-magic-nanoscroller.js', plugin_dir_url( __FILE__ ) . 'js/nanoscroller.min.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( 'profile-magic-tether.js', plugin_dir_url( __FILE__ ) . 'js/tether.min.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( 'profile-magic-emoji-config.js', plugin_dir_url( __FILE__ ) . 'js/config.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( 'profile-magic-emoji-util.js', plugin_dir_url( __FILE__ ) . 'js/util.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( 'profile-magic-emojiarea.js', plugin_dir_url( __FILE__ ) . 'js/jquery.emojiarea.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( 'profile-magic-emoji-picker.js', plugin_dir_url( __FILE__ ) . 'js/emoji-picker.js', array( 'jquery' ), $this->version, true );

                wp_enqueue_media();
                wp_enqueue_script('jquery-form');
                wp_enqueue_script('jcrop');
		wp_enqueue_script('jquery-ui-tooltip');
		wp_enqueue_script('jquery-effects-core');
		
		wp_enqueue_script( $this->profile_magic, plugin_dir_url( __FILE__ ) . 'js/profile-magic-public.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'modernizr-custom.min.js', plugin_dir_url( __FILE__ ) . 'js/modernizr-custom.min.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'profile-magic-footer.js', plugin_dir_url( __FILE__ ) . 'js/profile-magic-footer.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( 'profile-magic-friends-public.js', plugin_dir_url( __FILE__ ) . 'js/profile-magic-friends-public.js', array( 'jquery' ), $this->version, false );
                if($dbhandler->get_global_option_value('pm_enable_live_notification','1')=='1')
                {
                    wp_enqueue_script('heartbeat');
                }
                wp_enqueue_script( 'pg-password-checker.js', plugin_dir_url( __FILE__ ) . 'js/pg-password-checker.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( 'pg-profile-menu.js', plugin_dir_url( __FILE__ ) . 'js/pg-profile-menu.js', array( 'jquery' ), $this->version, false );
                wp_enqueue_script( 'profile-magic-admin-power.js', plugin_dir_url( __FILE__ ) . 'js/profile-magic-admin-power.js', array( 'jquery' ), $this->version, true );
                wp_localize_script( $this->profile_magic, 'pm_ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php'),'plugin_emoji_url'=>plugin_dir_url( __FILE__ ).'partials/images/img') );
                $reg_sub_page = array();
                $reg_sub_page['registration_tab']= isset($_REQUEST['rm_reqpage_sub']) || isset($_REQUEST['rm_reqpage_pay']) || isset($_REQUEST['rm_reqpage_inbox']) ? 1 : 0;
                wp_localize_script( 'profile-magic-footer.js', 'show_rm_sumbmission_tab', $reg_sub_page);
                $error = array();
                $error['valid_email'] = __('Please enter a valid e-mail address.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_number'] = __('Please enter a valid number.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_date'] = __('Please enter a valid date(yyyy-mm-dd format).','profilegrid-user-profiles-groups-and-communities');
                $error['required_field'] = __('This is a required field.','profilegrid-user-profiles-groups-and-communities');
                $error['required_comman_field'] = __('Please fill all the required fields.','profilegrid-user-profiles-groups-and-communities');
                $error['file_type'] = __('This file type is not allowed.','profilegrid-user-profiles-groups-and-communities');
                $error['short_password'] = __('Your password should be at least 7 characters long.','profilegrid-user-profiles-groups-and-communities');
                $error['pass_not_match'] = __('Password and confirm password do not match.','profilegrid-user-profiles-groups-and-communities');
                $error['user_exist'] = __('Sorry, username already exists.','profilegrid-user-profiles-groups-and-communities');
                $error['email_exist'] = __('Sorry, email already exists.','profilegrid-user-profiles-groups-and-communities');
                $error['show_more'] = __('More...','profilegrid-user-profiles-groups-and-communities');
                $error['show_less'] = __('Show less','profilegrid-user-profiles-groups-and-communities');
                $error['user_not_exit'] = __('Username does not exists.','profilegrid-user-profiles-groups-and-communities');
                $error['password_change_successfully'] =  __('Password changed Successfully','profilegrid-user-profiles-groups-and-communities');
                $error['allow_file_ext'] = $dbhandler->get_global_option_value('pm_allow_file_types','jpg|jpeg|png|gif');	
                $error['valid_phone_number'] = __('Please enter a valid phone number.','profilegrid-user-profiles-groups-and-communities');
        	$error['valid_mobile_number'] = __('Please enter a valid mobile number.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_facebook_url'] = __('Please enter a valid Facebook url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_twitter_url'] = __('Please enter a Twitter url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_google_url'] = __('Please enter a valid Google url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_linked_in_url'] = __('Please enter a Linked In url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_youtube_url'] = __('Please enter a valid Youtube url.','profilegrid-user-profiles-groups-and-communities');
                $error['valid_instagram_url'] = __('Please enter a valid Instagram url.','profilegrid-user-profiles-groups-and-communities');
                $error['crop_alert_error'] = __('Please select a crop region then press submit.','profilegrid-user-profiles-groups-and-communities');
                $error['admin_note_error'] = __('Unable to add an empty note. Please write something and try again.','profilegrid-user-profiles-groups-and-communities');
                $error['empty_message_error'] = __('Unable to send an empty message. Please type something.','profilegrid-user-profiles-groups-and-communities');
                $error['invite_limit_error'] = __('Only ten users can be invited at a time.','profilegrid-user-profiles-groups-and-communities');
                $error['no_more_result'] = __('No More Result Found','profilegrid-user-profiles-groups-and-communities');
                $error['delete_friend_request'] = __('This will delete friend request from selected user(s). Do you wish to continue?','profilegrid-user-profiles-groups-and-communities');
                $error['remove_friend'] = __('This will remove selected user(s) from your friends list. Do you wish to continue?','profilegrid-user-profiles-groups-and-communities');
                $error['accept_friend_request_conf'] = __('This will accept request from selected user(s). Do you wish to continue?','profilegrid-user-profiles-groups-and-communities');
                $error['cancel_friend_request'] = __('This will cancel request from selected user(s). Do you wish to continue?','profilegrid-user-profiles-groups-and-communities');
                $error['next'] = __('Next','profilegrid-user-profiles-groups-and-communities');
                $error['back'] = __('Back','profilegrid-user-profiles-groups-and-communities');
                $error['submit'] = __('Submit','profilegrid-user-profiles-groups-and-communities');
                $error['empty_chat_message'] = __("I am sorry, I can't send an empty message. Please write something and try sending it again.",'profilegrid-user-profiles-groups-and-communities');
                
                $pw_login_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                $pw_login_url = add_query_arg( 'password','changed', $pw_login_url );
                $error['login_url'] = esc_url_raw( $pw_login_url );
                wp_localize_script( $this->profile_magic, 'pm_error_object',$error);
                if($dbhandler->get_global_option_value('pm_enable_auto_logout_user','0')=='1' && is_user_logged_in()):
                    wp_enqueue_script( 'profile-magic-auto-logout', plugin_dir_url( __FILE__ ) . 'js/profile-magic-auto-logout.js', array( 'jquery' ), $this->version );
                    $autologout_obj = array();
                    $autologout_obj['pm_auto_logout_time'] = $dbhandler->get_global_option_value('pm_auto_logout_time','600');
                    $autologout_obj['pm_show_logout_prompt'] = $dbhandler->get_global_option_value('pm_show_logout_prompt','0');
                    wp_localize_script('profile-magic-auto-logout', 'pm_autologout_obj',$autologout_obj);
                endif;


        }

        public function register_shortcodes()
        {
                add_shortcode( 'PM_Registration', array( $this, 'profile_magic_registration_form' ) );
                add_shortcode( 'PM_Group', array( $this, 'profile_magic_group_view' ) );
                add_shortcode( 'PM_Groups', array( $this, 'profile_magic_groups_view' ) );
                add_shortcode( 'PM_Login', array( $this, 'profile_magic_login_form' ) );
                add_shortcode( 'PM_Profile', array( $this, 'profile_magic_profile_view' ) );
                add_shortcode( 'PM_Forget_Password', array( $this, 'profile_magic_forget_password' ) );
                add_shortcode( 'PM_Password_Reset_Form', array( $this, 'profile_magic_password_reset_form' ) );
                add_shortcode( 'PM_Search', array( $this, 'profile_magic_user_search' ) );
                add_shortcode( 'PM_Messenger', array( $this, 'profile_magic_messenger' ) );
             
                
                add_shortcode( 'PM_User_Blogs', array( $this, 'profile_magic_user_blogs' ) );
                add_shortcode( 'PM_Add_Blog', array( $this, 'profile_magic_add_blog' ) );
        }

        private function profile_magic_get_template_html($template_name,$content,$attributes = null) 
        {
                if ( ! $attributes )$attributes = array();
                ob_start();
                do_action( 'profile_magic_before_' . $template_name,$template_name,$content );
                require( 'partials/' . $template_name . '.php');
                do_action( 'profile_magic_after_' . $template_name );
                $html = ob_get_contents();
                ob_end_clean();
                return $html;
        }

        private function profile_magic_get_pm_theme_tmpl($type,$gid,$fields)
        {
                $path = $this->profile_magic_get_pm_theme($type);
                require($path);
        }

        public function profile_magic_get_pm_theme($type)
        {

            $plugin_path = plugin_dir_path( __FILE__ );
           $wp_theme_dir = get_stylesheet_directory();
            $override_pm_theme_path = $wp_theme_dir . "/profilegrid-user-profiles-groups-and-communities/themes/";
            $override_pm_theme = $override_pm_theme_path.$this->pm_theme.'/'.$type.'.php';
            $default_pm_theme = $plugin_path.'partials/themes/'.$this->pm_theme.'/'.$type.'.php';
            if(file_exists($override_pm_theme))
            {
                $path = $override_pm_theme;
            }
            else if(file_exists($default_pm_theme))
            {
                $path = $default_pm_theme;
            }
            else
            {
                $path = $plugin_path.'partials/themes/default/'.$type.'.php';
            }

            return $path;
        }
        public function profile_magic_messenger($content)
        {
            return $this->profile_magic_get_template_html('profile-magic-messenger', $content);
        }

        public function profile_magic_add_blog($content)
        {
            $dbhandler = new PM_DBhandler;
            if($dbhandler->get_global_option_value('pm_enable_blog','1')==1):
                return $this->profile_magic_get_template_html( 'profile-magic-add-blog', $content );	
            else:
               return  '<div class="pm-login-box-error">'.__('Admin has disabled blog submissions. You cannot submit a new blog post at the moment.','profilegrid-user-profiles-groups-and-communities').'</div>';
            endif;
            
        }
        
        public function profile_magic_user_search($content)
        {
            return $this->profile_magic_get_template_html( 'profile-magic-search', $content );	
        }

        public function profile_magic_login_form($attributes,$content = null)
        {
             if(class_exists('Registration_Magic')):
                 return do_shortcode('[RM_Login]' );
             else:
                return $this->profile_magic_get_template_html( 'profile-magic-login-form', $content,$attributes );
             endif;
            
        }
        public function profile_magic_registration_form($content)
        {
            
                $pg_args = array();
                $pg_args['form_type']='register';
                
                $is_ip_blocked = $this->pm_blocked_ips($pg_args);
                if($is_ip_blocked)
                {
                    return $is_ip_blocked;
                }
                if(class_exists('Registration_Magic')):
                    $group_id = filter_input(INPUT_GET, 'gid');
                    if(!isset($group_id))$group_id = $content['id'];
                    $pmrequests = new PM_request;
                    $rm_form_id = $pmrequests->pm_check_if_group_associate_with_rm_form($group_id);
                    if($rm_form_id)
                    {
                        return do_shortcode("[RM_Form id='".$rm_form_id."']");
                    }
                    else
                    {
                        return $this->profile_magic_get_template_html( 'profile-magic-registration-form', $content );
                    }
                else:
                    return $this->profile_magic_get_template_html( 'profile-magic-registration-form', $content );
                endif;
        }

        public function profile_magic_group_view($content)
        {	
            
                return $this->profile_magic_get_template_html( 'profile-magic-group', $content );	
        }

        public function profile_magic_groups_view($content)
        {
            
                return $this->profile_magic_get_template_html('profile-magic-groups',$content);	
        }

        public function profile_magic_profile_view($content)
        {
            
                return $this->profile_magic_get_template_html( 'profile-magic-profile', $content );
        }

        public function profile_magic_forget_password($attributes,$content = null)
        {
            
                $default_attributes = array( 'show_title' => false );
        $attributes = shortcode_atts( $default_attributes, $attributes );
                $attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';
                return $this->profile_magic_get_template_html( 'profile-magic-forget-password', $content );
        }

        public function profile_magic_password_reset_form( $attributes, $content = null ) 
        {
            
                // Parse shortcode attributes
                $pmrequests = new PM_request;
                $default_attributes = array( 'show_title' => false );
                $attributes = shortcode_atts( $default_attributes, $attributes );

                if ( is_user_logged_in() ) 
                {
                    return $this->profile_magic_get_template_html( 'profile-magic-password-reset-form', $content, $attributes );
                        //return __( "You can reset your password by accessing Change Password tab in your profile's Settings section.",'profilegrid-user-profiles-groups-and-communities' );
                } 
                else 
                {
                        if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) 
                        {
                                $attributes['login'] = $_REQUEST['login'];
                                $attributes['key'] = $_REQUEST['key'];
                                // Error messages
                                $errors = array();
                                if ( isset( $_REQUEST['error'] ) ) 
                                {
                                        $error_codes = explode( ',', $_REQUEST['error'] );
                                        foreach ( $error_codes as $code ) 
                                        {
                                                $errors []= $pmrequests->profile_magic_get_error_message($code,$this->profile_magic);
                                        }
                                }
                                $attributes['errors'] = $errors;

                                return $this->profile_magic_get_template_html( 'profile-magic-password-reset-form', $content, $attributes );
                        } 
                        else 
                        {
                                return __( 'Invalid password reset link.','profilegrid-user-profiles-groups-and-communities' );
                        }
                }
        }

        public function profile_magic_do_password_reset()
        {
                $pmrequests = new PM_request;
                if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) 
                {
                        $rp_key = $_REQUEST['rp_key'];
                        $rp_login = $_REQUEST['rp_login'];

                        $user = check_password_reset_key( $rp_key, $rp_login );

                        if ( ! $user || is_wp_error( $user ) ) {

                                if ( $user && $user->get_error_code() === 'expired_key' ) {
                                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                                        $redirect_url = add_query_arg( 'errors','expiredkey', $redirect_url );
                                } 
                                else 
                                {
                                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                                        $redirect_url = add_query_arg( 'errors','invalidkey', $redirect_url );
                                }
                                wp_redirect( esc_url_raw( $redirect_url ) );
                exit;
                        }

                        if ( isset( $_POST['pass1'] ) ) 
                        {
                                if ( $_POST['pass1'] != $_POST['pass2'] ) 
                                {
                                        // Passwords don't match
                                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php'));
                                        $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                                        $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                                        $redirect_url = add_query_arg( 'error','password_reset_mismatch', $redirect_url );
                                        wp_redirect( esc_url_raw( $redirect_url ) );
                                        exit;
                                }

                                if ( empty( $_POST['pass1'] ) ) {
                                        // Password is empty
                                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php'));
                                        $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                                        $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                                        $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );
                                        wp_redirect( esc_url_raw( $redirect_url ) );
                                        exit;
                                }


                                if(strlen($_POST['pass1'])<7)
                                {
                                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php'));
                                        $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                                        $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                                        $redirect_url = add_query_arg( 'error', 'password_too_short', $redirect_url );
                                        wp_redirect( esc_url_raw( $redirect_url ) );
                                        exit;
                                }		


                                // Parameter checks OK, reset password
                                reset_password( $user, $_POST['pass1'] );
                                delete_user_meta($user->ID, 'pm_pw_reset_attempt');
                                $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                                $redirect_url = add_query_arg( 'password','changed', $redirect_url );
                                wp_redirect( esc_url_raw( $redirect_url ) );
                                exit;
                        } else {
                                 _e("Invalid request.","profilegrid-user-profiles-groups-and-communities");
                        }

                        exit;
                }
        }

        public function profile_magic_send_email_after_password_reset($user, $new_pass)
        {
            $pmrequests = new PM_request;
            $pmemail = new PM_Emails;
            $userid = $user->ID;
            $newpass = $pmrequests->pm_encrypt_decrypt_pass('encrypt',$new_pass);
            update_user_meta( $userid,'user_pass',$newpass);
            $gids = $pmrequests->profile_magic_get_user_field_value($userid,'pm_group');
            $ugid = $pmrequests->pg_filter_users_group_ids($gids);
            $gid = $pmrequests->pg_get_primary_group_id($ugid);
            if(isset($gid))
            {
                $pmemail->pm_send_group_based_notification($gid,$userid,'on_password_change');
            }
        }

        public function profile_magic_do_password_lost()
        {
                $pmrequests = new PM_request;
                // add code for reset password limit
                $dbhandler = new PM_DBhandler;
                if($dbhandler->get_global_option_value('pm_enable_reset_password_limit','0')==1)
                {
                    if(isset($_POST['user_login']))
                    {
                       $login = trim($_POST['user_login']);
                       if(is_email($login))
                       {
                           $user_data = get_user_by('email', $login);
                       }
                       else
                       {
                           $user_data = get_user_by('login', $login);
                       }
                       $user_id = $user_data->ID;
                       $attempt = (int)$pmrequests->profile_magic_get_user_field_value($user_id,'pm_pw_reset_attempt');
                       $limit = (int)$dbhandler->get_global_option_value('pm_reset_password_limit','0');
                       $is_admin = user_can( intval( $user_id ),'manage_options' );
                       if($dbhandler->get_global_option_value('pm_disabled_admin_reset_password_limit','0')=='1' &&  $is_admin )
                       {
                           $reset_process= true;
                       }
                       else
                       {
                           if($limit<=$attempt)
                           {
                               $reset_process= false;
                           }
                           else
                           {
                               update_user_meta( $user_id, 'pm_pw_reset_attempt', $attempt + 1 );
                               $reset_process= true;
                           }
                       }
                    }
                }
                else
                {
                    $reset_process= true;
                }
                if ( 'POST' == $_SERVER['REQUEST_METHOD'] && $reset_process ) 
                {
                        $errors = retrieve_password();
                        if ( is_wp_error( $errors ) ) {
                                // Errors found
                                $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php?action=lostpassword'));
                                $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
                        } else {
                                // Email sent
                                $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                                $redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
                        }
                        wp_redirect( esc_url_raw( $redirect_url ) );
                        exit;
                }
                else
                {
                    $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php?action=lostpassword'));
                    $redirect_url = add_query_arg( 'errors','pm_reset_pw_limit_exceed', $redirect_url );
                    wp_redirect( esc_url_raw( $redirect_url ) );
                    exit;
                }
        }

        public function profile_magice_retrieve_password_message( $message, $key, $user_login, $user_data ) 
        {
                // Create new message
                $msg  = __( 'Hello!','profilegrid-user-profiles-groups-and-communities' ) . "\r\n\r\n";
                $msg .= sprintf( __( 'You asked us to reset your password for your account using the email address %s.','profilegrid-user-profiles-groups-and-communities' ), $user_login ) . "\r\n\r\n";
                $msg .= __( "If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.",'profilegrid-user-profiles-groups-and-communities' ) . "\r\n\r\n";
                $msg .= __( 'To reset your password, visit the following address:','profilegrid-user-profiles-groups-and-communities' ) . "\r\n\r\n";
                $msg .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";
                $msg .= __( 'Thanks!','profilegrid-user-profiles-groups-and-communities' ) . "\r\n";

                return $msg;
        }

        public function profile_magic_redirect_to_password_reset()
        {
                $pmrequests = new PM_request;
                if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
                        // Verify key / login combo
                        $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
                        if ( ! $user || is_wp_error( $user ) ) 
                        {
                                if ( $user && $user->get_error_code() === 'expired_key' ) {
                                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                                        $redirect_url = add_query_arg( 'login','expiredkey', $redirect_url );
                                } 
                                else 
                                {
                                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                                        $redirect_url = add_query_arg( 'login','invalidkey', $redirect_url );
                                }
                                wp_redirect( esc_url_raw( $redirect_url ) );
                                exit;
                        }

                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php?action=lostpassword'));
                        $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
                        $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );

                        wp_redirect( esc_url_raw( $redirect_url ) );
                        exit;
                }	
        }

        public function profile_magic_lost_password_form()
        {
                $pmrequests = new PM_request;
                $url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php?action=lostpassword'));
                wp_redirect( esc_url_raw($url) );
                exit;
        }

        public function profile_magic_check_login_status( $user_login, $user )
        {
                // Get user meta
                $pmrequests = new PM_request;
                $disabled = get_user_meta( $user->ID, 'rm_user_status', true );


                // Is the use logging in disabled?
                if ($disabled == '1') 
                {
                        // Clear cookies, a.k.a log user out
                         wp_clear_auth_cookie();
                        // Build login URL and then redirect
                        $login_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));

                        $login_url = add_query_arg( 'disabled', '1', $login_url );
                        $gids = get_user_meta( $user->ID, 'pm_group', true );
                        $ugid = $pmrequests->pg_filter_users_group_ids($gids);
                        $gid = $pmrequests->pg_get_primary_group_id($ugid);
                        $payment_status = get_user_meta( $user->ID, 'pm_user_payment_status', true );
                        $price = $pmrequests->profile_magic_check_paid_group($gid);
                        if($price>0 && $payment_status=='pending')
                        {
                                $login_url = add_query_arg( 'errors','payment_pending', $login_url );
                                $login_url = add_query_arg( 'id',$user->ID, $login_url );	
                        }
                        else
                        {
                                $login_url = add_query_arg( 'errors', 'account_disabled', $login_url );	
                        }

                        wp_redirect( esc_url_raw( $login_url ) );exit;
                }
                update_user_meta($user->ID,'pm_last_active_time',time());
                update_user_meta( $user->ID, 'pm_last_login', time() );
                update_user_meta( $user->ID, 'pm_login_status',1 );
        }
        
        public function profile_magic_update_logout_status()
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $current_user = wp_get_current_user(); 
            update_user_meta( $current_user->ID, 'pm_login_status',0 );
            $this->profile_magic_set_logged_out_status($current_user->ID);
            $redirect = $dbhandler->get_global_option_value('pm_redirect_after_logout','0');
            if($redirect!='0')
            {
                $redirect_url = get_permalink($redirect);
                wp_redirect( esc_url_raw($redirect_url) );exit;
            }
            else
            {
                $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                wp_redirect( esc_url_raw($redirect_url) );exit;
            }
            
        }
        public function profile_magic_login_notice( $message ) 
        {
                // Show the error message if it seems to be a disabled user
            $pmrequests = new PM_request;
                if ( isset( $_GET['disabled'] ) && $_GET['disabled'] == 1 ) 
                        $message =  '<div id="login_error">' . __( 'Account disabled','profilegrid-user-profiles-groups-and-communities') . '</div>';
                if ( isset( $_GET['errors'] )) 
                        $message =  '<div id="login_error">' .$pmrequests->profile_magic_get_error_message( filter_input(INPUT_GET, 'errors', FILTER_SANITIZE_STRING),'profilegrid-user-profiles-groups-and-communities'). '</div>';
                if ( isset( $_GET['activated'] ) && $_GET['activated']=='success') 
                        $message =  '<div class="message">' .__('Your account has been successfully activated.','profilegrid-user-profiles-groups-and-communities'). '</div>';
                return $message;
        }

        public function profile_magic_default_registration_url($default_registration_url)
        {
                $pmrequests = new PM_request;
                $register_url = $pmrequests->profile_magic_get_frontend_url('pm_default_regisration_page',site_url('/wp-login.php?action=register'));
                return $register_url;
        }

        public function profile_magic_redirect_after_login( $redirect_to, $request, $user ) 
        {
                //is there a user to check?
                $pmrequests = new PM_request;
                $pm_redirect_after_login = $pmrequests->profile_magic_get_frontend_url('pm_redirect_after_login',$redirect_to);
                if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) 
                {
                        if( $user->has_cap( 'administrator' ) ) 
                        {
                                $pm_redirect_after_login = admin_url();
                        } 
                }
                return $pm_redirect_after_login;
        }

        public function profile_magic_get_default_user_image($size,$args)
        {
            $path =  plugin_dir_url(__FILE__);
            $dbhandler = new PM_DBhandler;
            $avatarid = $dbhandler->get_global_option_value('pm_default_avatar','');
            if($avatarid=='')
            {
                $default_avatar_path = $path.'/partials/images/default-user.png';
                $pm_avatar = '<img src="'.$default_avatar_path.'" width="'.$size.'" height="'.$size.'" class="user-profile-image" />';
            }
            else
            {
                $pm_avatar =  wp_get_attachment_image($avatarid,array($size,$size),false,$args);
            }
            
            return $pm_avatar;
        }
        
        public function profile_magic_default_avatar($avatar_defaults ) 
        {
            $path =  plugin_dir_url(__FILE__);
            $dbhandler = new PM_DBhandler;
            $avatarid = $dbhandler->get_global_option_value('pm_default_avatar','');
            if($avatarid!='')
            {
                $src = wp_get_attachment_image_src($avatarid);
                $pm_avatar = $src[0];
                $avatar = get_option('avatar_default');
                if( $avatar != $pm_avatar )
                {
                    update_option( 'avatar_default', $pm_avatar );
                }

                $avatar_defaults[ $pm_avatar ] = 'Default Avatar';
            }
            
            return $avatar_defaults;
            
        }
        public function profile_magic_get_avatar($avatar,$id_or_email, $size, $default, $alt,$args)
        {
            $path =  plugin_dir_url(__FILE__);
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            if ( is_numeric( $id_or_email ) ) 
            {
                $id = (int) $id_or_email;
                $user = get_user_by( 'id' , $id );
            } 
            elseif ( is_object( $id_or_email ) ) 
            {
                if ( ! empty( $id_or_email->user_id ) ) 
                {
                        $id = (int) $id_or_email->user_id;
                        $user = get_user_by( 'id' , $id );
                }

            } 
            else 
            {
                $user = get_user_by( 'email', $id_or_email );	
            }
            
            if($dbhandler->get_global_option_value('pm_enable_gravatars','0')==1)
            {
               $default_avatar = $avatar;
            }
            else
            {
                $default_avatar = $this->profile_magic_get_default_user_image($size,$args);
            }
            
            if(isset($user) && !empty($user))
                $avatarid = $pmrequests->profile_magic_get_user_field_value($user->data->ID,'pm_user_avatar');
            if(isset($avatarid) && $avatarid!='')
            {
                    if(isset($args['wpdiscuz_current_user']))
                    {
                        unset($args['wpdiscuz_current_user']);
                    }
                     $pm_avatar =  wp_get_attachment_image($avatarid,array($size,$size),false,$args);
                     if(!empty($pm_avatar))
                     {
                            return $pm_avatar;	 
                     }
                     else
                     {
                            if(isset($user) && !empty($user) && is_super_admin($user->ID) && $dbhandler->get_global_option_value('pm_enable_gravatars','0')==0)
                            {
                                $default_avatar_path = $path.'/partials/images/admin-default-user.png';
                                $default_avatar = '<img src="'.$default_avatar_path.'" width="'.$size.'" height="'.$size.'" class="user-profile-image" />';
                            }
                             return $default_avatar;
                     }
            }
            else
            {       if(isset($user) && !empty($user) && is_super_admin($user->ID) && $dbhandler->get_global_option_value('pm_enable_gravatars','0')==0)
                    {
                        $default_avatar_path = $path.'/partials/images/admin-default-user.png';
                        $default_avatar = '<img src="'.$default_avatar_path.'" width="'.$size.'" height="'.$size.'" class="user-profile-image" />';
                    }
                    return $default_avatar;	
            }	
        }

        public function pm_update_user_profile()
        {
                echo update_user_meta($_POST['user_id'],$_POST['user_meta'],$_POST['user_meta_value']);
        die;
        }

        public function pm_send_change_password_email()
        {
            $current_user = wp_get_current_user();
            $userid = $current_user->ID;
            $pmrequests = new PM_request;
            $pmemail = new PM_Emails;
            $gids = $pmrequests->profile_magic_get_user_field_value($userid,'pm_group');
            $ugid = $pmrequests->pg_filter_users_group_ids($gids);
            $gid = $pmrequests->pg_get_primary_group_id($ugid);
            $pmemail->pm_send_group_based_notification($gid,$userid,'on_password_change');
        }

        public function pm_send_change_pass_email()
        {
            $current_user = wp_get_current_user();
            $userid = $current_user->ID;
            $pmrequests = new PM_request;
            $pmemail = new PM_Emails;
            $gids = $pmrequests->profile_magic_get_user_field_value($userid,'pm_group');
            $ugid = $pmrequests->pg_filter_users_group_ids($gids);
            $gid = $pmrequests->pg_get_primary_group_id($ugid);
            $pmemail->pm_send_group_based_notification($gid,$userid,'on_password_change');
            die;
        }

        public function pm_advance_search_get_search_fields_by_gid()
        {   
              $gid =  filter_input(INPUT_POST, 'gid');       
              $match_fields= filter_input(INPUT_POST, 'match_fields');   
              $dbhandler = new PM_DBhandler;
             
              if($gid==''){
                $additional = " field_type not in('file', 'user_avatar', 'heading', 'paragraph', 'confirm_pass', 'user_pass','user_url','user_name')";
               $fields = $dbhandler->get_all_result('FIELDS','*',1,'results',0,false,'ordering',false,$additional); 
              }else{
                   $additional = "and field_type not in('file', 'user_avatar', 'heading', 'paragraph', 'confirm_pass', 'user_pass','user_url','user_name')";
                $fields =  $dbhandler->get_all_result('FIELDS','*',array('associate_group'=>$gid),'results',0,false,'ordering',false,$additional);  
              }
                  $resp =" ";
                 foreach ($fields as $field) {
                     $ischecked = " ";
                     if ($field->field_options != "")
                            $field_options = maybe_unserialize($field->field_options);
                       
                     if(in_array($field->field_key,$match_fields)||$field->field_key==$match_fields){
                                 $ischecked = "checked";
                            }else{
                                $ischecked = " ";
                            }
                                 if (isset($field_options['display_on_search']) && ($field_options['display_on_search'] == 1))
                                     {
                               $resp .=" <li class=\"pm-filter-item\"><input class=\"pm-filter-checkbox\" type=\"checkbox\" name=\"match_fields\" onclick=\"pm_advance_user_search()\" ".$ischecked." value=\"".$field->field_key."\" ><span class=\"pm-filter-value\">".__($field->field_name,'profilegrid-user-profiles-groups-and-communities')."</span></li>";
                        }
                        
                    
                }
                 echo $resp;
                die;
            
        }
        
        public function pm_messenger_show_thread_user()
        {
            $pmmessenger = new PM_Messenger();
            $uid = filter_input(INPUT_POST, 'uid'); 
            $return = $pmmessenger->pm_messenger_show_thread_user($uid);
             $return = json_encode($return);
            echo $return;
            die;
        }


        public function pm_messenger_show_threads()
        {
            $pmmessenger = new PM_Messenger();
             $active_tid = $_POST['tid'];
            $result = $pmmessenger->pm_messenger_show_threads($active_tid);
            echo $result; die;
          
        }

        public function pm_messenger_send_new_message()
        {
            $pmmessenger = new PM_Messenger();    
            if(isset($_POST)){
                $rid = $_POST['rid'];
                $content = $_POST['content'];
                $result = $pmmessenger->pm_messenger_send_new_message($rid,$content);
                echo $result;
            }else{
                 _e(" no post created","profilegrid-user-profiles-groups-and-communities");
            }
            die;
        }

        
        public function pm_messenger_show_messages(){
            $pmmessenger = new PM_Messenger();
            $tid = filter_input(INPUT_POST, 'tid');  
            $t_status = filter_input(INPUT_POST, 't_status'); 
            $loadnum = filter_input(INPUT_POST, 'loadnum');
            $last_mid = filter_input(INPUT_POST, 'last_mid');
            $timezone = filter_input(INPUT_POST, 'timezone');
            $return = $pmmessenger->pm_messenger_show_messages($tid, $t_status, $loadnum,$last_mid,$timezone);
            echo $return;
            die;
        }
        
  
           public function pm_get_messenger_notification()
	{
                $pmmessenger = new PM_Messenger();
		$timestamp = filter_input(INPUT_GET, 'timestamp');		
		$activity =  filter_input(INPUT_GET, 'activity');
                $tid =  filter_input(INPUT_GET, 'tid');
                $return = $pmmessenger->pm_get_messenger_notification($timestamp, $activity, $tid);
		echo $return;
               die;
	}
        
     

        
    public function pm_messenger_delete_threads(){
            $pmmessenger = new PM_Messenger();
            $tid = filter_input(INPUT_POST, 'tid');
            $return = $pmmessenger->pm_messenger_delete_threads($tid);
            echo $return;
            die;
            }
            
    public function pm_messenger_notification_extra_data(){
            $pmmessenger = new PM_Messenger();
            $return = $pmmessenger->pm_messenger_notification_extra_data();
            echo $return;
            die;
    }

    public function pm_autocomplete_user_search(){
    $dbhandler = new PM_DBhandler;
    $pmrequests = new PM_request;
    $uid = wp_get_current_user()->ID;
    $name = filter_input(INPUT_POST, 'name');
    $meta_args = array('status'=>'0');
    $search =$name; 
    $limit = 20;
    $exclude = array();
    $exclude[] = $uid;
    $meta_query_array = $pmrequests->pm_get_user_meta_query($meta_args);
    $users =  $dbhandler->pm_get_all_users($search,$meta_query_array,'',0,$limit,'ASC','ID',$exclude);
    $return=array();      
    if(!empty($users))
    {
                
        foreach($users as $user)
        { 
            if($user->ID!=$uid)
            {
                $user_info['id']=$user->ID;
                $user_info['label']=$user->user_login;
                $return[]=$user_info;
            }
        }
    }
          $data = json_encode($return);
          echo $data;
          die;
}

   public function pm_advance_user_search()
   {  
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $pagenum = filter_input(INPUT_POST, 'pagenum');
            $gid = filter_input(INPUT_POST, 'gid');
               
            if(isset($_POST['match_fields']))
            {
           
                $search = '';
                $meta_query_array = $pmrequests->pm_get_user_advance_search_meta_query($_POST);
                 
            }
            else
            {
                $search =$_POST['pm_search'];    
                $meta_query_array = $pmrequests->pm_get_user_meta_query($_POST);
            
            }
             //$meta_query_array[] = array('key'=> 'pm_hide_my_profile','value'=> '1','compare'=>'!=');   
          

            $current_user = wp_get_current_user();
            $pagenum = isset($pagenum) ? absint($pagenum) : 1;
            $limit = 20; // number of rows in page
            $offset = ( $pagenum - 1 ) * $limit;
            $date_query = $pmrequests->pm_get_user_date_query($_POST);
            $exclude = $pmrequests->pm_get_hide_users_array();
            $user_query =  $dbhandler->pm_get_all_users_ajax($search,$meta_query_array,'',$offset,$limit,'ASC','ID',$exclude,$date_query);
            $total_users = $user_query->get_total();
            $users = $user_query->get_results();
            $num_of_pages = ceil( $total_users/$limit);
            $pagination = $dbhandler->pm_get_pagination($num_of_pages,$pagenum);
            $user_info =array();
        
               if(isset($total_users)){
                $return .="<div  class=\"pm-all-members pm-dbfl pm-pad10\">"
                       . __('Total ','profilegrid-user-profiles-groups-and-communities')."<b>".$total_users
                       ."</b>". __(' members','profilegrid-user-profiles-groups-and-communities')."</div>";
               }
           
               if(!empty($users))
            {
                
            
            foreach($users as $user)
                {       
                        $user_info['avatar'] = get_avatar($user->user_email, 100, '', false, array('class' => 'pm-user-profile','force_display'=>true));
                        $user_info['id']=$user->ID;
                        $profile_url= $pmrequests->pm_get_user_profile_url($user->ID);
                        $user_info['profile_url'] = $profile_url;
                        $user_info['name']=$pmrequests->pm_get_display_name($user->ID); 
                        $group_leader_class="";
                        if($user_info['group_leader'])$group_leader_class="pm-group-leader-medium";
                      
                        
                        $return .= "<div id=\"search_result\" class=\"pm-user pm-difl pm-radius5 pm-border $group_leader_class \"> ". 
                        "<a href=".$user_info['profile_url'].">"
                                            .$user_info['avatar']
                                            . "<div class=\"pm-user-name pm-dbfl pm-clip\">".$user_info['name']."</div></a></div>";
                        
                }

                }
                else{
                    $return ="<div class=\"pm-message pm-dbfl pm-pad10\">"
                            . __("Sorry, your search returned no results." ,'profilegrid-user-profiles-groups-and-communities')
                            ."</div>";
                }
              
            
                if(isset($pagination))
                $return.="<div class=\"pm_clear\"></div>".$pagination;
           
              echo $return;
            die;
        }

        public function pm_change_frontend_user_pass()
        {
                $textdomain = $this->profile_magic;
                $pmrequests = new PM_request;
                $current_user = wp_get_current_user();
                if(isset($current_user->ID) && !empty($_POST['pass1']))
                {
                        if(strlen($_POST['pass1'])<7)
                        {
                                $pm_error = __('Password is too short. At least 7 characters please!','profilegrid-user-profiles-groups-and-communities');
                        }
                        else
                        {
                                if($_POST['pass1']==$_POST['pass2'])
                                {   

                                    $newpass = $pmrequests->pm_encrypt_decrypt_pass('encrypt',$_POST['pass1']);
                                    update_user_meta( $current_user->ID,'user_pass',$newpass);
                                    $this->pm_send_change_password_email();
                                    $this->profile_magic_set_logged_out_status($current_user->ID);
                                    wp_set_password( $_POST['pass1'], $current_user->ID );
                                    $pm_error = true;

                                }
                                else
                                {
                                        $pm_error = __('New Password and Repeat password does not match.','profilegrid-user-profiles-groups-and-communities');
                                }
                        }
                }
                else
                {
                        $pm_error = __('Password didn\'t changed.','profilegrid-user-profiles-groups-and-communities');
                }
                echo $pm_error;
                die;	
        }

        public function profile_magic_recapcha_field($gid)
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $html_creator = new PM_HTML_Creator($this->profile_magic,$this->version);
             if($pmrequests->profile_magic_show_captcha('pm_enable_recaptcha_in_reg'))
             {
                $lang = $dbhandler->get_global_option_value('pm_recaptcha_lang','en');
                wp_enqueue_script("crf-recaptcha-api","https://www.google.com/recaptcha/api.js?hl=$lang");
                $html_creator->pm_get_captcha_html();
             }
        }

        public function pm_submit_user_registration($post,$files,$server,$gid,$fields,$user_id,$textdomain)
        {
                $dbhandler = new PM_DBhandler;
                $pmemails = new PM_Emails;
                $pmrequests = new PM_request;
                $pm_admin_notification = $dbhandler->get_global_option_value('pm_admin_notification',0);
                if($pm_admin_notification==1)
                {
                        $exclude = array('user_avatar','file','user_pass','confirm_pass','heading','paragraph');
                        $admin_html = $pmrequests->pm_admin_notification_message_html($post,$gid,$fields,$exclude);
                        $subject = __('New User Created','profilegrid-user-profiles-groups-and-communities');
                        $admin_message = '<p>'.__('New user created','profilegrid-user-profiles-groups-and-communities').'</p>'.$admin_html;
                        $pmemails->pm_send_admin_notification($subject,$admin_message);	
                }

                //$pmemails->pm_send_group_based_notification($gid,$user_id,'on_registration');
                $autoapproval = $dbhandler->get_global_option_value('pm_auto_approval',0);
                $send_user_activation_link = $dbhandler->get_global_option_value('pm_send_user_activation_link',0);
                if($autoapproval=='1' && $pmrequests->profile_magic_check_paid_group($gid)=='0')
                {
                    if($send_user_activation_link=='1')
                    {
                      $userstatus = '1';   
                      $pmrequests->pm_update_user_activation_code($user_id);
                      $pmemails->pm_send_activation_link($user_id,$this->profile_magic);
                    }
                    else
                    {
                        $userstatus = '0';
                        $pmemails->pm_send_group_based_notification($gid,$user_id,'on_user_activate');
                    }
                }
                else
                {
                    $userstatus = '1';
                    $accnt_review_notification = $dbhandler->get_global_option_value('pm_admin_account_review_notification',0);
                    if($pm_admin_notification==1 && $accnt_review_notification==1)
                    {
                        $review_subject = $dbhandler->get_global_option_value('pm_account_review_email_subject',__('New user awaiting review','profilegrid-user-profiles-groups-and-communities'));
                        $review_body = $dbhandler->get_global_option_value('pm_account_review_email_body',__('{{display_name}} has just registered in {{group_name}} group and waiting to be reviewed. To review this member please click the following link: {{profile_link}}','profilegrid-user-profiles-groups-and-communities'));
                        $review_body = $pmemails->pm_filter_email_content($review_body, $user_id,false,$gid);
                        $pmemails->pm_send_admin_notification($review_subject,$review_body);
                    }
                    
                }
                update_user_meta( $user_id,'rm_user_status',$userstatus);

        }

       public function pm_submit_user_registration_paypal($post,$files,$server,$gid,$fields,$user_id,$textdomain)
        {
                $pmrequests = new PM_request;
                $pm_payapl_request = new PM_paypal_request();
                if($pmrequests->profile_magic_check_paid_group($gid)>0)
                {
                    
                    switch($post['pm_payment_method'])
                    {
                        case 'paypal':
                            $pm_payapl_request->profile_magic_payment_process($post,$post["action"],$gid,$user_id,$textdomain);
                            break;
                        default:
                            do_action('profile_magic_custom_payment_process',$post,$gid,$user_id);
                            break;
                    }
                        
                }
        }
        
        public function pm_join_paid_group_payment($post,$gid,$user_id)
        {
                $pmrequests = new PM_request;
                $pm_payapl_request = new PM_paypal_request();
                if($pmrequests->profile_magic_check_paid_group($gid)>0 && isset($post['pm_payment_method']))
                {
                    
                    switch($post['pm_payment_method'])
                    {
                        case 'paypal':
                            $pm_payapl_request->profile_magic_join_group_payment_process($post,$post["action"],$gid,$user_id);
                            break;
                        default:
                            do_action('profile_magic_join_group_custom_payment_process',$post,$gid,$user_id);
                            break;
                    }
                        
                }
        }

        public function pm_payment_process($post,$request,$gid,$textdomain)
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $pm_payapl_request = new PM_paypal_request();
            if(isset($request["action"]) && $request["action"]!='process')
		{
			if(isset($request["uid"]))$uid = $request["uid"];else $uid = false;
			
			if($request["action"]=='re_process')
			{
                                $additional = "uid = $uid";
                                $payment_log = $dbhandler-> get_all_result('PAYPAL_LOG','*',1,'results',0,1,'id','DESC',$additional);
                                if(isset($payment_log))
                                {
                                    $payment_method = $payment_log[0]->pay_processor;
                                }
                                else
                                {
                                    $payment_method = 'paypal';
                                }
                                
                                if($payment_method=='paypal')
                                {
                                    $pm_payapl_request->profile_magic_repayment_process($uid,$gid);
                                }
                                else
                                {
                                    do_action('profile_magic_custom_repayment_process',$uid,$gid,$payment_method);
                                }
				
			}
			else
			{
				$pm_payapl_request->profile_magic_payment_process($post,$request["action"],$gid,$uid,$textdomain);
			}
			
			
			return false;
		}

	}
        
        public function pm_upload_image()
        {
            require( 'partials/crop.php');
            die;
        }
	
        public function pm_upload_cover_image()
        {
            require( 'partials/coverimg_crop.php');
            die;
        }
	
        public function pg_create_post_type()
        {
            
            register_post_type( 'profilegrid_blogs',
                array(
                  'labels' => array(
                    'name' => __( ' User Blogs','profilegrid-user-profiles-groups-and-communities' ),
                    'singular_name' => __( 'User Blog','profilegrid-user-profiles-groups-and-communities')
                  ),
                  'public' => true,
                  'has_archive' => true,
                  'rewrite' => array('slug' => 'profilegrid_blogs'),
                  'taxonomies' => array('post_tag'),
                  'supports' => array('title','editor','author','thumbnail','comments'),
                  'menu_position' => 85,
//                  'menu_icon' =>'dashicons-testimonial'
                )
              );
            
            add_theme_support( 'post-thumbnails' );
        }
        
        public function pm_load_pg_blogs()
        {
            $pmhtmlcreator = new PM_HTML_Creator($this->profile_magic,$this->version);
            $pmhtmlcreator->pm_get_user_blog_posts($_POST['uid'],$_POST['page'] );
            die;
        }
        
        public function pm_get_rid_by_uname()
        {
            $current_user = wp_get_current_user();
            $user = get_user_by('login', $_POST['uname']);
            if($user)
            {
                if(get_user_meta($user->ID,'rm_user_status', true)==0):
                    if($current_user->ID!=$user->ID)
                    {
                        echo $user->ID;
                    }
                endif;
            }
            die;
        }
        public function pm_show_friends_tab($uid,$gid)
	{
            $dbhandler = new PM_DBhandler;
            if($dbhandler->get_global_option_value('pm_friends_panel','0'))
            {
                echo '<li class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg-friends">'. __('Friends','profilegrid-user-profiles-groups-and-communities').'</a></li>';
            }
	}
        
        
	
        public function pm_show_friends_content($uid,$gid)
	{
            $dbhandler = new PM_DBhandler;
            if($dbhandler->get_global_option_value('pm_friends_panel','0'))
            {
                    echo '<div id="pg-friends" class="pm-dbfl pg-profile-tab-content">';
                    include 'partials/profile-magic-friends.php';
                    echo '</div>';
            }
	}
        
        public function pm_fetch_my_friends()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
                $pmfriends = new PM_Friends_Functions;
                $pmhtmlcreator = new PM_HTML_Creator($this->profile_magic,$this->version);
		$uid = filter_input(INPUT_POST, 'uid');
		$path =  plugin_dir_url(__FILE__);
                $pm_f_search = filter_input(INPUT_POST,'pm_f_search');
                $view = filter_input(INPUT_POST,'pm_friend_view');
                $limit = 20; // number of rows in page
                //echo $uid;die;
		$pagenum = filter_input(INPUT_POST, 'pagenum');
                
		if($pagenum)
		{
                    $pmhtmlcreator->pm_get_my_friends_html($uid,$pagenum,$pm_f_search,$limit,$view);         
		}
		die;
	}
        
        public function pm_fetch_friend_list_counter()
        {
            $pmfriends = new PM_Friends_Functions;
            $uid = filter_input(INPUT_POST, 'uid');
            $view = filter_input(INPUT_POST,'pm_friend_view');
            switch($view)
            {
                case 1:
                    echo $pmfriends->pm_count_my_friends($uid);
                    break;
                case 2:
                    echo $pmfriends->pm_count_my_friend_requests($uid);
                    break;
                case 3:
                    echo $pmfriends->pm_count_my_friend_requests($uid,1);
                    break;
            }
            die;
        }
        
        public function pm_fetch_my_suggestion()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
                $pmfriends = new PM_Friends_Functions;
		$identifier = 'FRIENDS';
		$uid = filter_input(INPUT_POST, 'uid');
		$path =  plugin_dir_url(__FILE__);
		$pagenum = filter_input(INPUT_POST, 'pagenum');
		$suggestions = $pmfriends->profile_magic_friends_suggestion($uid);
		if($pagenum)
		{
			$pm_u_search = filter_input(INPUT_POST,'pm_u_search');
			$limit = 10; // number of rows in page
			$pagenum = isset($pagenum) ? absint($pagenum) : 1;
			$offset = ( $pagenum - 1 ) * $limit;
			$meta_query_array = $pmrequests->pm_get_user_meta_query( filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING) );
			$date_query = $pmrequests->pm_get_user_date_query( filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING) );
			$suggestions = $pmfriends->profile_magic_friends_suggestion($uid);
			
			$users =  $dbhandler->pm_get_all_users($pm_u_search,$meta_query_array,'',$offset,$limit,'ASC','include',array(),$date_query,$suggestions);
			
			$pmfriends->profile_magic_friends_result_html($users,$uid);
		}
		die;
	}
        
        public function pm_add_friend_request()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
                $pmnotification = new Profile_Magic_Notification;
		$identifier = 'FRIENDS';
		$user1 = filter_input(INPUT_POST, 'user1');
		$user2 = filter_input(INPUT_POST, 'user2');
		$u1 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user1);
		$u2 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user2);
		$data = array();
		$data['user1'] = $u1;
		$data['user2'] = $u2;
		$date = date("Y-m-d h:i:s");
		$data['created_date'] = $date;
		$data['action_date'] = $date;
		$data['status'] = 1;
		$id = $dbhandler->insert_row($identifier,$data);
                $pmnotification->pm_friend_request_notification($u2, $u1)
		?>
        <span><?php _e('Request Sent','profilegrid-user-profiles-groups-and-communities');?></span>
        
        <?php
		die;
	}
	
        public function pm_remove_friend_suggestion()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
		$identifier = 'FRIENDS';
		$user1 = filter_input(INPUT_POST, 'user1');
		$user2 = filter_input(INPUT_POST, 'user2');
		$u1 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user1);
		$u2 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user2);
		$data = array();
		$data['user1'] = $u1;
		$data['user2'] = $u2;
		$date = date("Y-m-d h:i:s");
		$data['created_date'] = $date;
		$data['action_date'] = $date;
		$data['status'] = 5;
		$id = $dbhandler->insert_row($identifier,$data);
		echo $id;
		die;
	}
        
        public function pm_confirm_friend_request()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
                $pmfriends = new PM_Friends_Functions;
                $pmnotification = new Profile_Magic_Notification;
		$identifier = 'FRIENDS';
		$user1 = filter_input(INPUT_POST, 'user1');
		$user2 = filter_input(INPUT_POST, 'user2');
		$u1 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user1);
		$u2 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user2);
		$data = array();
		//$data['user1'] = $u1;
		//$data['user2'] = $u2;
		$date = date("Y-m-d h:i:s");
		//$data['created_date'] = $date;
		$data['action_date'] = $date;
		$data['status'] = 2;
		$requests = $pmfriends->profile_magic_is_exist_in_table($u1,$u2);
                $pmnotification->pm_friend_added_notification($u2,$u1);
		$dbhandler->update_row($identifier,'id',$requests->id,$data,array('%s','%d'),'%d');
		do_action('pm_friend_request_accepted',$u2,$u1);
                echo '<b>'.__('Request Accepted!','profilegrid-user-profiles-groups-and-communities').'</b><br />'.__('You are now friends','profilegrid-user-profiles-groups-and-communities');	
		die;
	}
        
        public function pm_reject_friend_request()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
                $pmfriends = new PM_Friends_Functions;
		$identifier = 'FRIENDS';
		$user1 = filter_input(INPUT_POST, 'user1');
		$user2 = filter_input(INPUT_POST, 'user2');
		$u1 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user1);
		$u2 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user2);
		$data = array();
		//$data['user1'] = $u1;
		//$data['user2'] = $u2;
		$date = date("Y-m-d h:i:s");
		//$data['created_date'] = $date;
		$data['action_date'] = $date;
		$data['status'] = 3;
		$requests = $pmfriends->profile_magic_is_exist_in_table($u1,$u2);
		$dbhandler->update_row($identifier,'id',$requests->id,$data,array('%s','%d'),'%d');
                $username2 = $pmrequests->pm_get_display_name($u2);
                do_action('pm_friend_request_rejected',$u2,$u1);
                echo '<b>'.__('Request Rejected!','profilegrid-user-profiles-groups-and-communities').'</b><br />'. sprintf(__("You cancelled friend request from %s.","profilegrid-user-profiles-groups-and-communities"),$username2);
		die;
	}
        
        public function pm_block_friend()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
                $pmfriends = new PM_Friends_Functions;
		$identifier = 'FRIENDS';
		$user1 = filter_input(INPUT_POST, 'user1');
		$user2 = filter_input(INPUT_POST, 'user2');
		$u1 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user1);
		$u2 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user2);
		$data = array();
		//$data['user1'] = $u1;
		//$data['user2'] = $u2;
		$date = date("Y-m-d h:i:s");
		//$data['created_date'] = $date;
		$data['action_date'] = $date;
		$data['status'] = 4;
		$requests = $pmfriends->profile_magic_is_exist_in_table($u1,$u2);
		$dbhandler->update_row($identifier,'id',$requests->id,$data,array('%s','%d'),'%d');
		echo '<b>'.__('Friend Blocked!','profilegrid-user-profiles-groups-and-communities').'</b><br />'.__('You have blocked this user','profilegrid-user-profiles-groups-and-communities');	
		die;
	}
        
        public function pm_unfriend_friend()
	{
		$pmrequests = new PM_request;
		$dbhandler = new PM_DBhandler;
                $pmfriends = new PM_Friends_Functions;
		$identifier = 'FRIENDS';
		$user1 = filter_input(INPUT_POST, 'user1');
		$user2 = filter_input(INPUT_POST, 'user2');
                $cancel_request = filter_input(INPUT_POST, 'cancel_request');
		$u1 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user1);
		$u2 = $pmrequests->pm_encrypt_decrypt_pass('decrypt',$user2);
		$data = array();
		//$data['user1'] = $u1;
		//$data['user2'] = $u2;
		$date = date("Y-m-d h:i:s");
		//$data['created_date'] = $date;
		$data['action_date'] = $date;
		$data['status'] = 6;
		$requests = $pmfriends->profile_magic_is_exist_in_table($u1,$u2);
                $dbhandler->update_row($identifier,'id',$requests->id,$data,array('%s','%d'),'%d');
		if($cancel_request==1):
                $dbhandler->remove_row($identifier,'id', $requests->id,'%d');
                echo '<b>'.__('Request Removed!','profilegrid-user-profiles-groups-and-communities').'</b>';
                else:
                         $username2 = $pmrequests->pm_get_display_name($u2);
                    echo '<b>'.__('Friend Removed!','profilegrid-user-profiles-groups-and-communities').'</b><br />'.sprintf(__("You have removed %s from your friend list.","profilegrid-user-profiles-groups-and-communities"),$username2);
                endif;
		
                	
		die;
	}
        
        public function pm_get_friends_notification()
	{
		$dbhandler = new PM_DBhandler;
		$identifier = 'FRIENDS';
		$timestamp = filter_input(INPUT_GET, 'timestamp');		
		$current_user = wp_get_current_user();
		$uid = $current_user->ID;		
		set_time_limit(0);
		while (true) {
			$last_ajax_call = isset($timestamp) ? (int)($timestamp) : null;
			$where = array('user2'=>$uid,'status'=>1);
			$last_change_data = $dbhandler->get_all_result($identifier,'*',$where);
			foreach($last_change_data as $last_row)
			{
				$last_change_time = $last_row->action_date; 
			}
					
			// get timestamp of when file has been changed the last time
			$last_change_in_data_file = strtotime($last_change_time);
		
			// if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
			if ($last_ajax_call == null || $last_change_in_data_file > $last_ajax_call) {
		
				// get content of data.txt
				$data = count($last_change_data);
				if(!isset($data) || empty($data))$data = '0';
				// put data.txt's content and timestamp of last data.txt change into array
				$result = array(
					'data_from_file' => $data,
					'timestamp' => $last_change_in_data_file
				);
		
				// encode to JSON, render the result (for AJAX)
				$json = json_encode($result);
				echo $json;
		
				// leave this loop step
				break;
		
			} else {
				// wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
				sleep( 1 );
				continue;
			}
		}

		
		die;
	}
        
        
        public function pm_right_side_options($uid,$gid)
        {
            $pmrequests = new PM_request;
            $dbhandler = new PM_DBhandler;
            $pmfriends = new PM_Friends_Functions;
            $PM_Messanger = new PM_Messenger;
            $current_user = wp_get_current_user();
            if($uid !=$current_user->ID && $dbhandler->get_global_option_value('pm_enable_private_messaging','1')==1):
                $messenger_url = $PM_Messanger->pm_get_message_url($uid);
            ?>
              <div class="pm-difr pm-pad20">
                  <a id="message_user" href="<?php echo $messenger_url; ?>" ><?php _e('Message','profilegrid-user-profiles-groups-and-communities');?></a>
            </div>
            <?php endif; 
            
            
            if($uid !=$current_user->ID && $dbhandler->get_global_option_value('pm_friends_panel','0')==1):
               echo '<div class="pm-difr pm-pad20">';
                $pmfriends->profile_magic_friend_list_button($current_user->ID, $uid);
                echo '</div>';
             endif; 
          
        }
        
        public function pm_delete_notification(){
            $notif_id = filter_input(INPUT_POST, 'id');
            $pm_notification = new Profile_Magic_Notification();
            $return = $pm_notification->pm_delete_notification($notif_id);
            echo $return;
            die;
        }
        
        public function pm_load_more_notification(){
            $loadnum = filter_input(INPUT_POST, 'loadnum');
            $pm_notification = new Profile_Magic_Notification();
            $pm_notification->pm_generate_notification_without_heartbeat($loadnum);
            die;
         
        }
        
        public function pm_read_all_notification(){
            $uid = get_current_user_id();
            $pm_notification = new Profile_Magic_Notification();
            $pm_notification->pm_mark_all_notification_as_read($uid);
            die;
         
        }
        
        public function pm_refresh_notification(){
             $pm_notification = new Profile_Magic_Notification();
            $pm_notification->pm_generate_notification_without_heartbeat();
            die;
        }
        
        public function profile_magic_custom_payment_fields($gid)
        {
            $pmrequests = new PM_request;
            $dbhandler = new PM_DBhandler;
            $paypal_enable = $dbhandler->get_global_option_value('pm_enable_paypal','0');
            
            if($pmrequests->profile_magic_check_paid_group($gid)>0):
             ?>        
        
        <div class="pmrow">
    
                <div class="pm-col">
                    <div class="pm-form-field-icon"></div>
                    <div class="pm-field-lable">
                        <label for=""><?php _e('Price','profilegrid-user-profiles-groups-and-communities');?></label>
                    </div>
                    <div class="pm-field-input">
                        <div class="pm_group_price">
              <?php if($dbhandler->get_global_option_value('pm_currency_position','before')=='before'):
                    echo $pmrequests->pm_get_currency_symbol().' '.$pmrequests->profile_magic_check_paid_group($gid);
                else:
                    echo $pmrequests->profile_magic_check_paid_group($gid).' '.$pmrequests->pm_get_currency_symbol();
                endif;
                ?>
            </div>
                        <div class="errortext" style="display:none;"></div>
                       
                    </div>
                </div>
                
            </div>
        <div class="pmrow">
                <div class="pm-col">
                    <div class="pm-form-field-icon"></div>
                    <div class="pm-field-lable">
                        <label for=""><?php _e('Payment Method','profilegrid-user-profiles-groups-and-communities');?><sup>*</sup></label>
                    </div>
                    <div class="pm-field-input pm_radiorequired">
                        <div class="pmradio">
                            <?php if($paypal_enable==1):?>
                            <div class="pm-radio-option"><input title="<?php _e('PayPal','profilegrid-user-profiles-groups-and-communities'); ?>" type="radio"  id="pm_payment_method" name="pm_payment_method" value="paypal" checked><?php _e('PayPal','profilegrid-user-profiles-groups-and-communities');?></div>
                            <?php endif;?>
                             <?php do_action('profile_magic_additional_payment_options',$gid); ?>
                        </div>
                        <div class="errortext" style="display:none;"></div>
                    </div>
                </div>
        </div>
             <?php
            endif;
        }
        
        public function profile_magic_check_paypal_config($msg)
        {
            $dbhandler = new PM_DBhandler;
            $paypal_enable = $dbhandler->get_global_option_value('pm_enable_paypal','0');
            if($paypal_enable==1)
            {
                $paypal_email = trim($dbhandler->get_global_option_value('pm_paypal_email'));
                if($paypal_email=='')
                {
                    $msg = __('Oops! It looks like the PayPal payment system is not configured properly. Please check its settings.','profilegrid-user-profiles-groups-and-communities');
                }
                else
                {
                    $msg = '';
                }
            }
            else
            {
                    $msg = 'disabled';
            }
            return $msg;
        }
        
        public function profile_magic_author_link($link,$author_id)
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            if($dbhandler->get_global_option_value('pm_auto_redirect_author_to_profile','0')==1)
            {
                $link = $pmrequests->pm_get_user_profile_url($author_id);
            }
            return $link;
        }
        
        public function profile_magic_allow_backend_screen_for_guest()
        {
            global $pagenow;
            // For Login screen
            if ( isset( $pagenow ) && $pagenow == 'wp-login.php' && !is_user_logged_in() && !isset( $_REQUEST['action'] ) && !isset($_REQUEST['pgr']) ) 
            {
                $dbhandler = new PM_DBhandler;
                $pmrequests = new PM_request;
                $allowed = $dbhandler->get_global_option_value('pm_guest_allow_backend_login_screen','1');
                $allowed = apply_filters('pg_whitelisted_wpadmin_access', $allowed );
                
                if($allowed==0)
                {
                    $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php?pgr=1'));
                    wp_redirect( esc_url_raw($redirect_url) );exit;
                }
            }
            
            if ( isset( $pagenow ) && $pagenow == 'wp-login.php' && !is_user_logged_in() && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'register' && !isset($_REQUEST['pgr']) ) 
            {
                $dbhandler = new PM_DBhandler;
                $pmrequests = new PM_request;
                $allowed = $dbhandler->get_global_option_value('pm_guest_allow_backend_register_screen','1');
                $allowed = apply_filters('pg_whitelisted_wpadmin_access', $allowed );
                if($allowed==0)
                {
                    $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_registration_page',site_url('/wp-login.php?action=register&pgr=1'));
                    wp_redirect( esc_url_raw($redirect_url) );exit;
                }
            }
             
			
        }
        
        public function pm_auto_logout_user()
        {
            $dbhandler = new PM_DBhandler;
            $redirect_url = '';
            $show_prompt = $dbhandler->get_global_option_value('pm_show_logout_prompt','0');
            if($dbhandler->get_global_option_value('pm_enable_auto_logout_user','0')=='1'):
                if(is_user_logged_in())
                {
                    $is_admin = user_can( intval( get_current_user_id() ),'manage_options' );
                    if(!$is_admin)
                    {
                        update_user_meta( get_current_user_id(), 'pm_login_status',0 );
                        wp_clear_auth_cookie();
                        $redirect = $dbhandler->get_global_option_value('pm_redirect_after_logout','0');
                        if($redirect!='0')
                        {
                            $redirect_url = get_permalink($redirect);
                            if($show_prompt=='0')
                            {
                                $redirect_url = add_query_arg( 'errors', 'inactivity', $redirect_url );
                            }
                        }
                        else
                        {
                            $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                            if($show_prompt=='0')
                            {
                                $redirect_url = add_query_arg( 'errors', 'inactivity', $redirect_url );
                            }
                        }
                        
                       $redirect_url =  esc_url_raw( $redirect_url );

                    }
                }
            endif;
            
            echo $redirect_url ;
            die;
       	
        }
        
        public function profile_magic_auto_logout_prompt_html()
        {
            $is_admin = user_can( intval( get_current_user_id() ),'manage_options' );
            if(is_user_logged_in() && !$is_admin)
            {
                require( 'partials/pm-autologout-prompt.php');
            }
        }
        
        public function pg_whitelisted_wpadmin_access( $allowed ) 
        {
                $dbhandler = new PM_DBhandler;
                $pmrequests = new PM_request;
                $allowed_ips = $dbhandler->get_global_option_value('pm_wpadmin_allow_ips','');
		if ($allowed_ips == '' )
                {
			return $allowed;
                }
		
		$ips = array_map("rtrim", explode(",", $allowed_ips));
		$user_ip = $pmrequests->pm_user_ip();

		if ( in_array( $user_ip, $ips ) )
			$allowed = 1;
		return $allowed;
		
	}
        
        public function pm_blocked_ips($args)
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $blocked_ips = $dbhandler->get_global_option_value('pm_blocked_ips','');
            //return $blocked_ips;
            if ($blocked_ips == '' )
              return;

            $ips = array_map("rtrim", explode(",", $blocked_ips));
            $user_ip = $pmrequests->pm_user_ip();
            //return $user_ip;
            foreach($ips as $ip) 
            {
                $ip = str_replace('*','',$ip); 
                if ( !empty( $ip ) && strpos($user_ip, $ip) === 0) 
                {
                    if( isset($args['form_type']) && $args['form_type']=='register')
                    {
                        return $pmrequests->profile_magic_get_error_message('blocked_ip','profilegrid-user-profiles-groups-and-communities');
                    }
                    else
                    {
                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                        $redirect_url = add_query_arg( 'errors', 'blocked_ip', $redirect_url );
                        wp_redirect( esc_url_raw( $redirect_url ) );exit();
                    }
                }
            }
	}
        
        public function pm_check_ip_during_login( $user, $username, $password ) {
            
		if (!empty($username)) {

			do_action("pg_blocked_user_ip",$args = array());
			do_action("pg_blocked_user_email", $args=array('username' => $username ) );
			
		}

		return $user;
	}
        
        public function pg_blocked_emails($args)
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            if(is_email($args['username']))
            {
                $useremail = $args['username'];
            }
            else
            {
                $user = get_user_by('login',$args['username']);
                if(isset($user) && isset($user->user_email))
                {
                    $useremail = $user->user_email;
                }
            }
            
            
            $blocked_emails = $dbhandler->get_global_option_value('pm_blocked_emails','');
            if ($blocked_emails=='' )
                return;
            $emails = array_map("rtrim", explode(",", $blocked_emails));
            
            if ( isset( $useremail ) && is_email( $useremail ) ) 
            {
                $domain = explode('@', $useremail );
                $check_domain = str_replace($domain[0], '*',$useremail);

                if ( in_array($useremail, $emails ) )
                {
                    if( isset($args['form_type']) && $args['form_type']=='register')
                    {
                        return $pmrequests->profile_magic_get_error_message('blocked_email','profilegrid-user-profiles-groups-and-communities');
                    }
                    else
                    {
                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                        $redirect_url = add_query_arg( 'errors', 'blocked_email_on_login', $redirect_url );
                        wp_redirect( esc_url_raw( $redirect_url ) );exit();
                    }
                    
                } 
                
                if ( in_array( $check_domain, $emails ) )
                {
                    if(isset($args['form_type']) && $args['form_type']=='register')
                    {
                        return $pmrequests->profile_magic_get_error_message('blocked_domain','profilegrid-user-profiles-groups-and-communities');
                    }
                    else
                    {
                        $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
                        $redirect_url = add_query_arg( 'errors', 'blocked_domain', $redirect_url );
                        wp_redirect( esc_url_raw( $redirect_url ) );exit();
                    }
                }   

            }

        }
        
        public function pg_blocked_emails_wp_registration($errors, $sanitized_user_login, $user_email )
        {
           $args = array();
           $args['username'] = $user_email;
           $args['form_type']='register';
           $is_blocked =  $this->pg_blocked_emails($args);
           $is_blocked_ip = $this->pm_blocked_ips($args);
           $post = array();
           $error = array();
           $post['user_login']=$sanitized_user_login;
           $post['user_email']=$user_email;
           $is_blocked_word = $this->pm_check_blocked_word_during_registration($error,$post);
           if(!empty($is_blocked))
           {
                $errors->add( 'blocked_email',$is_blocked );
           }
           
           if(!empty($is_blocked_ip))
           {
               $errors->add( 'blocked_ip',$is_blocked_ip );
           }
           
           if(!empty($is_blocked_word))
           {
               $errors->add( 'blocked_words',$is_blocked_word[0] );
           }
           return $errors;
        }
        
        public function pm_check_blocked_email_during_registration($error,$post)
        {
           if(!isset($_POST['user_email'])){ return $error;}
           $useremail = $post['user_email'];
           $args = array();
           $args['username'] = $post['user_email'];
           $args['form_type']='register';
           $is_blocked =  $this->pg_blocked_emails($args);
           if(!empty($is_blocked))
           {
               $error[] = $is_blocked;
           }
           return $error;
        }
        
        
        public function pm_check_blocked_word_during_registration($error,$post)
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            if(!isset($post['user_login']) || !isset($post['user_email']))
            {
                return $error;
            }

            if(isset($post['user_login']))
            {	
                $useremail = strtolower($post['user_login']);	
            }	
            else	
            {	
                $useremail = strtolower(substr($post['user_email'], 0, strrpos($post['user_email'], '@')));	

            }
           //echo $useremail;
          
            $words = strtolower($dbhandler->get_global_option_value('pm_blacklist_word',''));
            if ( $words != '' ) 
            {
                $words = array_map("rtrim", explode(",", $words));
                if(in_array($useremail,$words))
                {
                    $error[] =  $pmrequests->profile_magic_get_error_message('blocked_words','profilegrid-user-profiles-groups-and-communities');
                }
            }
           return $error;
        }
        
        public function pm_account_deletion_notification($user_id)
        {
            $dbhandler = new PM_DBhandler;
            $pmemails = new PM_Emails;
            $pmrequests = new PM_request;
            
            $dbhandler->remove_row('FRIENDS','user1',$user_id,'%d');
            $dbhandler->remove_row('FRIENDS','user2',$user_id,'%d');
            
            $gids = $pmrequests->profile_magic_get_user_field_value($user_id,'pm_group');
            $ugid = $pmrequests->pg_filter_users_group_ids($gids);
            $gid = $pmrequests->pg_get_primary_group_id($ugid);
            if(isset($gid))
            {
                $pmemails->pm_send_group_based_notification($gid,$user_id,'on_account_deleted');
            }
            
            $pm_admin_notification = $dbhandler->get_global_option_value('pm_admin_notification',0);
            $pm_admin_account_deletion_notification = $dbhandler->get_global_option_value('pm_admin_account_deletion_notification',0);
            if($pm_admin_notification==1 && $pm_admin_account_deletion_notification==1)
            {
                $subject = $dbhandler->get_global_option_value('pm_account_delete_email_subject',__('Account deleted','profilegrid-user-profiles-groups-and-communities'));
                $body = $dbhandler->get_global_option_value('pm_account_delete_email_body',__('{{display_name}} has just deleted their account.','profilegrid-user-profiles-groups-and-communities'));
                $message = $pmemails->pm_filter_email_content($body, $user_id);
                $pmemails->pm_send_admin_notification($subject,$message);
            }
        }
        
        public function pg_user_profile_pagetitle( $title, $sep = '' ) 
        {
            $dbhandler = new PM_DBhandler;
            $pmemails = new PM_Emails;
            $pmrequests = new PM_request;
            $profile_title = $dbhandler->get_global_option_value('pg_user_profile_seo_title','{{display_name}} | ' . get_bloginfo('name'));            
            if(get_the_ID()==$dbhandler->get_global_option_value('pm_user_profile_page',0))
            {
                if(isset($_REQUEST['uid']))
                {
                    $uid = $pmrequests->pm_get_uid_from_profile_slug($_REQUEST['uid']);
                }
                else
                {
                    $current_user = wp_get_current_user();
                    $uid = $current_user->ID;
                }
                
                $title = $pmemails->pm_filter_email_content($profile_title,$uid);
                
            }

            return $title;
            
        }
        
        public function pg_user_profile_metadesc()
        {
            $dbhandler = new PM_DBhandler;
            $pmemails = new PM_Emails;
            $pmrequests = new PM_request;
            $meta_content = $dbhandler->get_global_option_value('pg_user_profile_seo_desc');            
            
                    
            if(get_the_ID()==$dbhandler->get_global_option_value('pm_user_profile_page',0))
            {
                if(isset($_REQUEST['uid']))
                {
                    $uid = $pmrequests->pm_get_uid_from_profile_slug($_REQUEST['uid']);
                }
                else
                {
                    $current_user = wp_get_current_user();
                    $uid = $current_user->ID;
                }
                $user_info = get_user_by('ID', $uid);
                $content = $pmemails->pm_filter_email_content($meta_content,$uid);
                $avatar = get_avatar($user_info->user_email,150,'',false,array('class'=>'pm-user','force_display'=>true));
                $string =  $pmrequests->pm_get_display_name($uid);
                $title = $pmrequests->pg_get_strings_between_tags($string,'span');
                if($title=='')
                {
                    $title= $pmrequests->pm_get_display_name($uid);
                }
                ?>
                <meta name="description" content="<?php echo str_replace('\\', '', $content); ?>">
                <meta property="og:title" content="<?php echo $title; ?>" />
                <meta property="og:type" content="article" />
                
                <meta property="og:url" content="<?php echo $pmrequests->pm_get_user_profile_url($uid); ?>" />
                <meta property="og:description" content="<?php echo str_replace('\\', '', $content); ?>" />
                <?php
            }
        }
        
        public function pm_show_settings_tab($uid,$gid)
	{
            $current_user = wp_get_current_user();
            if($current_user->ID ==$uid)
            {
                echo '<li class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg-settings">'. __('Settings','profilegrid-user-profiles-groups-and-communities').'</a></li>';
            }
	}
	
        public function pm_show_settings_content($uid,$gid)
	{
            $current_user = wp_get_current_user();
            if($current_user->ID ==$uid)
            {
                    echo '<div id="pg-settings" class="pm-dbfl pg-profile-tab-content">';
                    include 'partials/profile-magic-settings.php';
                    echo '</div>';
            }
	}
        
        public function pm_comment_author($author, $comment_ID)
        {   
            global $comment;
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $comment = get_comment( $comment_ID );
            if($dbhandler->get_global_option_value('pm_auto_redirect_author_to_profile','0')==1 &&  isset( $comment->user_id ) && !empty( $comment->user_id ))
            {
                $link = $pmrequests->pm_get_user_profile_url($comment->user_id);
                $displayname = $pmrequests->pm_get_display_name($comment->user_id);
                $author = "<a href='".$link. "'>" .$displayname. "</a>";
                
            }
            return $author;
          
        }
        
        public function pg_post_published_notification($ID, $post)
        {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $pmemail = new PM_Emails;
            $userid = $post->post_author; /* Post author ID. */
            
            $pm_blog_notification_user = $dbhandler->get_global_option_value('pm_blog_notification_user');
            $gids = $pmrequests->profile_magic_get_user_field_value($userid,'pm_group');  
            $gid = $pmrequests->pg_filter_users_group_ids($gids);
            
            if(isset($gid) && !empty($gid) && $pm_blog_notification_user=="1")
            {
                if(isset($gid[0]))
                {
                    $groupid = $gid[0];
                    $pmemail->pm_send_group_based_notification($groupid,$userid,'on_published_new_post',$ID);
                }
                
            }
        }
        
        public function pg_set_toolbar()
        {
            if(!is_user_logged_in()){
                return;
            }
            
            $hide_tb = get_option('pm_hide_wp_toolbar', $default = 'no');
            $visible_for_admin = get_option('pm_hide_admin_toolbar', $default = 'no');
            if($hide_tb === 'yes'){
                if($visible_for_admin == 'yes')
                {
                    if(current_user_can('manage_options'))
                    {
                        show_admin_bar(true);
                    }
                    else
                    {
                        show_admin_bar( false );
                    }
                    
                }
                else
                {
                    show_admin_bar( false );
                }
            }
            else
            {
                show_admin_bar( true );
            }
        }
        
    public function pg_comment_link_to_profile($return,$author,$comment_ID)
    {
            $dbhandler = new PM_DBhandler;
            $pmrequests = new PM_request;
            $comment = get_comment( $comment_ID );
            if($dbhandler->get_global_option_value('pm_auto_redirect_author_to_profile','0')==1 &&  isset( $comment->user_id ) && !empty( $comment->user_id ))
            {
                $link = $pmrequests->pm_get_user_profile_url($comment->user_id);
                $displayname = $pmrequests->pm_get_display_name($comment->user_id);
                $return = "<a href='".$link. "'>" .$displayname. "</a>";
                
            }
            return $return;
    }
    
    public function pm_remove_file_attachment()
    {
        $key = filter_input(INPUT_POST, 'key');
        $value = filter_input(INPUT_POST, 'value');
        $current_user = wp_get_current_user();
        $user_attachments = get_user_meta($current_user->ID, $key,true);
        if($user_attachments != '')
        {
             $old_attachments = explode(',',$user_attachments);
             $index = array_search($value, $old_attachments);
             unset($old_attachments[$index]);
        }
        if(empty($old_attachments))
        {
            echo delete_user_meta($current_user->ID, $key);
        }
        else
        {
            $ids = implode(',', $old_attachments);
            echo update_user_meta($current_user->ID, $key, $ids);

        }
        die;
    }
    public function pm_edit_group_popup_html()
    {
        
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version); 
        $tab = $_POST['tab'];
        $type = $_POST['type'];
       
        if(is_array($_POST['id']))
        {
            $id = $_POST['id'];
        }
        else
        {
           $id = filter_input(INPUT_POST, 'id'); 
        }

        $gid = filter_input(INPUT_POST, 'gid');
        if($tab=='blog')
        {
            $html_generator->pg_blog_popup_html_generator($type, $id,$gid);
        }
        if($tab=='member')
        {
            $html_generator->pg_member_popup_html_generator($type, $id,$gid);
        }
        if($tab=='group')
        {
            $html_generator->pg_group_popup_html_generator($type, $id,$gid);
        }
        if($tab=='admins')
        {
            $html_generator->pg_admin_popup_html_generator($type, $id,$gid);
        }

        die;
    }

    public function pm_save_post_status()
    {

        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $pm_request = new PM_request;
        $postid = filter_input(INPUT_POST, 'post_id');
        $blog_status = filter_input(INPUT_POST, 'pm_change_blog_status');
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'save_pm_post_status' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        if(is_numeric($postid))
        {
            $change_status = wp_update_post(array('ID'    =>  $postid,'post_status'   => $blog_status));
            update_post_meta($postid,'pm_enable_custom_access','1');
            $html_generator->change_blog_status_success_popup($blog_status);
        }
        else
        {
            global $wpdb;
            $ids = maybe_unserialize($pm_request->pm_encrypt_decrypt_pass('decrypt',$postid));
            $i=0;
            foreach($ids as $id)
            {
                 $is_update = $wpdb->update( $wpdb->posts, array( 'post_status' => $blog_status ), array( 'ID' => $id ) );
                 update_post_meta($id,'pm_enable_custom_access','1');
                 clean_post_cache($id);
                 if($is_update)
                 {
                     $i++;
                 }
            }
            $change_status = array();
            $change_status['change_status'] = 'bulk';
            $change_status['count'] = $i;
            $html_generator->change_blog_status_success_popup($change_status);
        }

        die;
    }

    public function pm_save_post_content_access_level()
    {
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $pm_request = new PM_request;
        $postid = filter_input(INPUT_POST, 'post_id');
        $gid = filter_input(INPUT_POST,'gid');
        $pm_content_access = filter_input(INPUT_POST, 'pm_content_access');
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'save_pm_post_content_access_level' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );

        if(is_numeric($postid))
        {
            if(isset($pm_content_access)):
                if($pm_content_access==5)
                {
                    update_post_meta($postid,'pm_content_access','2');
                    update_post_meta($postid,'pm_content_access_group',$gid);
                    update_post_meta($postid,'pm_enable_custom_access','1');
                }
                else
                {
                    if($pm_content_access==2)
                    {
                        update_post_meta($postid,'pm_content_access_group','all');
                    }

                    update_post_meta($postid,'pm_content_access',$pm_content_access);
                    update_post_meta($postid,'pm_enable_custom_access','1');
                }
                $html_generator->change_blog_access_control_success_popup($pm_content_access);
            else:
                $html_generator->change_blog_access_control_success_popup('failed');
            endif;
        }
        else
        {
            $ids = maybe_unserialize($pm_request->pm_encrypt_decrypt_pass('decrypt',$postid));
            $i=0;
            foreach($ids as $id)
            {
                if($pm_content_access==5)
                {
                    $is_update = update_post_meta($id,'pm_content_access','2');
                    update_post_meta($id,'pm_content_access_group',$gid);
                    update_post_meta($id,'pm_enable_custom_access','1');
                }
                else
                {
                    if($pm_content_access==2)
                    {
                        update_post_meta($id,'pm_content_access_group','all');
                    }
                    $is_update = update_post_meta($id,'pm_content_access',$pm_content_access);
                    update_post_meta($id,'pm_enable_custom_access','1');
                }
                
                if($is_update)
                {
                    $i++;
                }
            }
            $change_status = array();
            $change_status['change_status'] = 'bulk';
            $change_status['count'] = $i;
            $html_generator->change_blog_access_control_success_popup($change_status);
        }


        die;
    }

    public function pm_save_edit_blog_post()
    {
        
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $postid = filter_input(INPUT_POST, 'post_id');
        $post_title = filter_input(INPUT_POST,'blog_title');
        $post_content = filter_input(INPUT_POST, 'blog_description');
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'save_pm_edit_blog_post' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        $change_status = wp_update_post(array('ID' => $postid,'post_title' => $post_title,'post_content' => $post_content));
        if($change_status)
        {
           $html_generator->sav_blog_post_success_popup('success');
        }
        else
        {
            $html_generator->sav_blog_post_success_popup('failed');
        }
        die;
    }

    public function pm_save_admin_note_content()
    {
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $pm_request = new PM_request;
        $postid = filter_input(INPUT_POST, 'post_id');
        $is_delete_request = filter_input(INPUT_POST,'delete_note');
        $admin_note_content = filter_input(INPUT_POST,'pm_admin_note_content');
        $admin_note_position = filter_input(INPUT_POST, 'pm_admin_note_position');
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        $admin_note_content = substr($admin_note_content, 0, 5000);
        if (!wp_verify_nonce($retrieved_nonce, 'save_pm_admin_note_content' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        if(is_numeric($postid))
        {
            if($is_delete_request==1)
            {
                 $html_generator->delete_admin_note_popup($postid);
            }
            else
            {
                update_post_meta($postid,'pm_admin_note_content',$admin_note_content);
                update_post_meta($postid,'pm_admin_note_position',$admin_note_position);
                $html_generator->save_admin_note_success_popup('success');
            }
        }
        else
        {
            $ids = maybe_unserialize($pm_request->pm_encrypt_decrypt_pass('decrypt',$postid));
            foreach($ids as $id)
            {
                update_post_meta($id,'pm_admin_note_content',$admin_note_content);
                update_post_meta($id,'pm_admin_note_position',$admin_note_position);
            }
            $change_status = array();
            $change_status['change_status'] = 'bulk';
            $change_status['count'] = count($ids);
            $html_generator->save_admin_note_success_popup($change_status);
        }

        die;   
    }

    public function pm_delete_admin_note()
    {
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $postid = filter_input(INPUT_POST, 'post_id');
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'delete_pm_admin_note' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        $is_delete = delete_post_meta($postid,'pm_admin_note_content');
        $is_delete = delete_post_meta($postid,'pm_admin_note_position');
        if($is_delete)
        {
           $html_generator->pm_delete_admin_note_success_popup('success');
        }
        else
        {
            //echo 'failed';
            $html_generator->pm_delete_admin_note_success_popup('failed');
        }
        die;

    }

    public function pm_send_message_to_author()
    {
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $pmrequests = new PM_request;
        $postid = filter_input(INPUT_POST, 'post_id');
        $type = filter_input(INPUT_POST, 'type');
        $content = filter_input(INPUT_POST, 'pm_author_message');
        $current_user = wp_get_current_user();
        $sid = $current_user->ID;
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'send_pm_message_to_author' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        if(is_numeric($postid))
        {
            if($type=='blog')
            {
                $post = get_post($postid);
                $rid = $post->post_author;
            }
            else
            {
                $rid = $postid;
            }
            $is_msg_sent = $pmrequests->pm_create_message($sid, $rid, $content);
            if($is_msg_sent)
            {
               $html_generator->author_msg_send_success_popup($rid);
            }
            else
            {
                //echo 'failed';
                $html_generator->author_msg_send_success_popup('failed');
            }
        }
        else
        {
            $ids = maybe_unserialize($pmrequests->pm_encrypt_decrypt_pass('decrypt',$postid));
            //print_r($ids);
            $i=0;
            foreach($ids as $id)
            {
                if($id==$sid)
                {
                    continue;
                }
                $result = $pmrequests->pm_create_message($sid, $id, $content);
                //print_r($result);
                if($result)
                {
                    $i = $i+1;
                }
                
            }
            $change_status = array();
            $change_status['change_status'] = 'bulk';
            $change_status['count'] = $i;
            $html_generator->author_msg_send_success_popup($change_status);
        }
        die;

    }

    public function pm_get_all_user_blogs_from_group()
    {
        $pmrequest = new PM_request;
        $gid = $_POST['gid'];
        $search_in = $_POST['search_in'];
        $sort_by = $_POST['sortby'];
        $search = $_POST['search'];
        $pagenum = $_POST['pagenum'];
        $limit = 10;
        $current_user = wp_get_current_user();
        update_user_meta($current_user->ID,'pg_blog_sort_limit',$limit);
        $pmrequest->pm_get_all_group_blogs($gid,$pagenum,$limit,$sort_by,$search_in,$search);
        die;
    }

    public function pm_invite_user()
    {
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $pmrequest = new PM_request;
        $pm_emails = new PM_Emails;
        $dbhandler = new PM_DBhandler;
        $gid = filter_input(INPUT_POST, 'gid');
        $emails = $_POST['pm_email_address'];
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'invite_pm_user' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        $message = '';
        foreach($emails as $email)
        {
            $user_id = email_exists($email);
            if($user_id)
            {
                $profile_url = $pmrequest->pm_get_user_profile_url($user_id);
                $gids = $pmrequest->profile_magic_get_user_field_value($user_id,'pm_group');
                $exist_group = $pmrequest->pg_filter_users_group_ids($gids);
                
                if(is_array($exist_group))
                {
                    $gid_array = $exist_group;
                } 
                else
                {
                    if($exist_group != '' && $exist_group != NULL)
                    {
                        $gid_array = array($exist_group);
                    }
                    else
                    {
                        $gid_array = array();
                    }
                }
                
                if(!in_array($gid,$gid_array))
                {
                    $pmrequest->profile_magic_join_group_fun($user_id, $gid,'open');

                    $message .= '<div class="pg-invited-user-result pg-group-user-info-box pg-invitation-failed pm-pad10 pm-bg pm-dbfl">
                        <div class="pm-difl pg-invited-user">'.get_avatar($email,26,'',false,array('force_display'=>true)).'</div>
                        <div class="pm-difl pg-invited-user-info">
                            <div class="pg-invited-user-email pm-dbfl">'.$email.' &nbsp;</div>
                            <div class="pm-dbfl">'. __('User added to the group','profilegrid-user-profiles-groups-and-communities').'
                                <div class="pm-difr"><a href="'.$profile_url.'" target="_blank">'.__('View Profile','profilegrid-user-profiles-groups-and-communities').'</a></div>
                            </div>
                        </div>
                    </div>';
                }
                else
                {
                    $group_name = $dbhandler->get_value('GROUPS','group_name',$exist_group[0]);
                    $group_link = $pmrequest->profile_magic_get_frontend_url('pm_group_page','',$gid);
                    $group_link = add_query_arg( 'gid',$gid,$group_link );

                   $message .=' <div class="pg-invited-user-result pg-group-user-info-box pg-invitation-failed pm-pad10 pm-bg pm-dbfl">
                        <div class="pm-difl pg-invited-user">'.get_avatar($email,26,'',false,array('force_display'=>true)).'</div>
                        <div class="pm-difl pg-invited-user-info">
                           <div class="pg-invited-user-email pm-dbfl">'.$email.' &nbsp;</div>
                            <div class="pm-dbfl">'.__("The user you are trying to add is already a member of this group",'profilegrid-user-profiles-groups-and-communities').'
                                <div class="pm-difr"><a href="'. $profile_url.'" target="_blank">'. __('View Profile','profilegrid-user-profiles-groups-and-communities').'</a></div>
                            </div>
                        </div>
                    </div>';

                }
            }
            else
            {
                //echo 'test';
                $pm_emails->pm_send_invite_link($email, $gid);
                $message .='<div class="pg-invited-user-result pg-group-user-info-box pg-invitation-success  pm-pad10 pm-bg pm-dbfl">
                        <div class="pm-difl pg-invited-user">'. get_avatar($email,26,'',false,array('force_display'=>true)).'</div>
                        <div class="pm-difl pg-invited-user-info">
                                <div class="pg-invited-user-email pm-dbfl">'.$email.' &nbsp;</div>
                            <div class="pm-dbfl">'.__('Invitation sent successfully.','profilegrid-user-profiles-groups-and-communities').'</div>
                        </div>
                    </div>';

            }
        }
        //echo $message;
        $html_generator->invitation_send_result_success_popup($message);
        die;   
    }

    public function pm_remove_user_from_group()
    {
        $pmrequests = new PM_request;
        $pm_emails = new PM_Emails;
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $user_id = filter_input(INPUT_POST, 'user_id');
        $gid = filter_input(INPUT_POST, 'gid');
        $current_user = wp_get_current_user();
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        
        if (!wp_verify_nonce($retrieved_nonce, 'remove_pm_user_from_group' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        if(is_numeric($user_id))
        {
            $result = $pmrequests->pg_leave_group($user_id,$gid);
            if($current_user->ID != $user_id)
            {
                $pm_emails->pm_send_remove_from_group_user_notification($user_id, $gid);
            }
            $html_generator->pm_remove_user_success_popup($result);
        }
        else
        {
            $ids = maybe_unserialize($pmrequests->pm_encrypt_decrypt_pass('decrypt',$user_id));
            foreach($ids as $id)
            {
                $result = $pmrequests->pg_leave_group($id,$gid);
                $pm_emails->pm_send_remove_from_group_user_notification($id, $gid);
            }
            $change_status = array();
            $change_status['change_status'] = 'bulk';
            $change_status['count'] = count($ids);
            $html_generator->pm_remove_user_success_popup($change_status);
        }

        die; 
    }

    public function pm_activate_user_in_group()
    {
        $pmrequests = new PM_request;
        $pmemails = new PM_Emails;
        $user_id = $_POST['uid'];
        $gid = $_POST['gid'];
        if(is_array($user_id))
        {
            foreach($user_id as $id)
            {
                update_user_meta($id,'rm_user_status','0');
                if(!empty($gid))
                {   
                    $pmemails->pm_send_group_based_notification($gid,$id,'on_user_activate');
                }
            }
        }
        else
        {
            update_user_meta($user_id,'rm_user_status','0');
            if(!empty($gid))
            {   
                $pmemails->pm_send_group_based_notification($gid,$user_id,'on_user_activate');
            }
        }
        die;
    }

    public function pm_get_all_users_from_group()
    {
        $pmrequest = new PM_request;
        $gid = filter_input(INPUT_POST, 'gid');
        $search_in = filter_input(INPUT_POST, 'search_in');
        $sort_by = filter_input(INPUT_POST, 'sortby');
        $search = filter_input(INPUT_POST, 'search');
        $pagenum = filter_input(INPUT_POST, 'pagenum');
        $limit = filter_input(INPUT_POST, 'limit');
        $current_user = wp_get_current_user();
        update_user_meta($current_user->ID,'pg_member_sort_limit',$limit);
        $pmrequest->pm_get_all_users_from_group($gid,$pagenum,$limit,$sort_by,$search_in,$search);
        die;
    }

    public function pm_deactivate_user_from_group()
    {
        $pmrequests = new PM_request;
        $pmemails = new PM_Emails;
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $user_id = filter_input(INPUT_POST, 'user_id');
        $gid = filter_input(INPUT_POST, 'gid');
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'deactivate_pm_user_from_group' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        if(is_numeric($user_id))
        {
            update_user_meta($user_id,'rm_user_status','1');
            do_action('pg_user_suspended',$user_id);
            if(!empty($gid))
            {   
                $pmemails->pm_send_group_based_notification($gid,$user_id,'on_user_deactivate');
            }
            $html_generator->pm_deactivate_user_success_popup('success');
        }
        else
        {
            $ids = maybe_unserialize($pmrequests->pm_encrypt_decrypt_pass('decrypt',$user_id));
            foreach($ids as $id)
            {
                update_user_meta($id,'rm_user_status','1');
                do_action('pg_user_suspended',$id);
                if(!empty($gid))
                {   
                    $pmemails->pm_send_group_based_notification($gid,$id,'on_user_deactivate');
                }
            }
            $change_status = array();
            $change_status['change_status'] = 'bulk';
            $change_status['count'] = count($ids);
            $html_generator->pm_deactivate_user_success_popup($change_status);
        }

        die; 
    }
    public function pm_generate_auto_password()
    {
        echo wp_generate_password();
        die;
    }

    public function pm_reset_user_password()
    {
        $html_generator = new PM_HTML_Creator($this->profile_magic,$this->version);
        $pmrequests = new PM_request;
        $pmemail = new PM_Emails;
        $user_id = filter_input(INPUT_POST, 'user_id');
        $gid = filter_input(INPUT_POST, 'gid');
        $password = filter_input(INPUT_POST,'pm_new_pass');
        $send_email = filter_input(INPUT_POST,'pm_email_password_to_user');
        $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
        if (!wp_verify_nonce($retrieved_nonce, 'reset_pm_user_password' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
        $newpass = $pmrequests->pm_encrypt_decrypt_pass('encrypt',$password);
        $name = $pmrequests->pm_get_display_name($user_id);
        update_user_meta( $user_id,'user_pass',$newpass);
        wp_set_password($password,$user_id);
        $this->profile_magic_set_logged_out_status($user_id);
        if($send_email)
        {
            $pmemail->pm_send_group_based_notification($gid,$user_id,'on_admin_reset_password');
        }

        $html_generator->pm_reset_user_password_success_popup($name,$send_email);
        die;
    }

    public function pm_get_pending_post_from_group()
    {
        $html_generator = new PM_HTML_Creator;
        $gid = filter_input(INPUT_POST, 'gid');
        echo $html_generator->pg_get_pending_post_count_html($gid);
        die;
    }
    
    public function pm_show_groups_tab_content($uid,$gid)
    {
        echo '<div id="pg-groups" class="pm-dbfl pg-profile-tab-content">';
        include 'partials/profile-magic-group-tab.php';
        echo '</div>';
    }
    
    public function pm_remove_user_group()
    {
        $pmrequests = new PM_request;
        $uid = filter_input(INPUT_POST, 'uid');
        $gid = filter_input(INPUT_POST, 'gid');
        $result = $pmrequests->pg_leave_group($uid,$gid);
        if($result=='success')
        {
            echo 'success';
        }
        die;
    }
    
    public function pm_decline_join_group_request()
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $pmemails = new PM_Emails;
        $uid = $_POST['uid'];
        if(is_numeric($uid))
        {
            $gid = filter_input(INPUT_POST, 'gid');
            $where = array('gid'=>$gid,'uid'=>$uid);
            $data = array('status'=>'2');
            $request_id = $dbhandler->get_value_with_multicondition('REQUESTS','id',$where);
            //$dbhandler->update_row('REQUESTS','id', $request_id,$data);
            $dbhandler->remove_row('REQUESTS','id',$request_id);
            $pmemails->pm_send_group_based_notification($gid,$uid,'on_request_denied');
        }
        else
        {
            $ids = maybe_unserialize($uid);
            foreach($ids as $id)
            {
                $gid = filter_input(INPUT_POST, 'gid');
                $where = array('gid'=>$gid,'uid'=>$id);
                $data = array('status'=>'2');
                $request_id = $dbhandler->get_value_with_multicondition('REQUESTS','id',$where);
               // $dbhandler->update_row('REQUESTS','id', $request_id,$data);
                $dbhandler->remove_row('REQUESTS','id',$request_id);
                $pmemails->pm_send_group_based_notification($gid,$id,'on_request_denied');
            }
            
        }
        
        
        
        echo 'success';
        die;
    }
    
    public function pm_approve_join_group_request()
    {
        $pmrequest = new PM_request;
        $dbhandler = new PM_DBhandler;
        $path =  plugins_url( '/partials/images/popup-close.png', __FILE__ );
        $gid = filter_input(INPUT_POST, 'gid');
        $uid = $_POST['uid'];
        $meta_query_array = $pmrequest->pm_get_user_meta_query(array('gid'=>$gid));
        $is_group_limit = $dbhandler->get_value('GROUPS','is_group_limit',$gid);
        $limit = $dbhandler->get_value('GROUPS','group_limit',$gid);
        $user_query = $dbhandler->pm_get_all_users_ajax('',$meta_query_array);
        $total_users_in_group = $user_query->get_total();
        if($is_group_limit==1)
        {
            if($limit > $total_users_in_group)
            {
                if(is_numeric($uid))
                {

                    $pmrequest->profile_magic_join_group_fun($uid, $gid,'open');   
                }
                else
                {
                    $ids = maybe_unserialize($uid);
                    foreach($ids as $id)
                    {
                        $pmrequest->profile_magic_join_group_fun($id, $gid,'open');
                    }
                }
                echo 'success';
                die;
            }
            else
            {
                $message  = $dbhandler->get_value('GROUPS','group_limit_message',$gid);
            ?>
                <div class="pm-popup-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
                    <?php echo __('User Limit Reached','profilegrid-user-profiles-groups-and-communities');?>
                      <div class="pm-popup-close pm-difr">
                          <img src="<?php echo $path; ?>" height="24px" width="24px">
                      </div>
                </div>
                <div class="pm-dbfl pm-pad10 pg-group-setting-popup-wrap">  
                    <div class="pmrow">  
                        <div class="pm-col">
                            <p><?php _e(sprintf('%s',$message) ,'profilegrid-user-profiles-groups-and-communities'); ?> </p>         
                        </div>
                    </div>            
                </div>

               <div class="pg-group-setting-popup-footer pm-dbfl">
                    <div class="pg-group-setting-bt pg-group-setting-close-btn pm-difl"><a class="pm-remove" onclick="pg_edit_popup_close()"><?php _e('Cancel','profilegrid-user-profiles-groups-and-communities');?></a></div> 
                </div>
            <?php
                die;
            }
            
        }
        else
        {
            if(is_numeric($uid))
            {

                $pmrequest->profile_magic_join_group_fun($uid, $gid,'open');   
            }
            else
            {
                $ids = maybe_unserialize($uid);
                foreach($ids as $id)
                {
                    $pmrequest->profile_magic_join_group_fun($id, $gid,'open');
                }
            }
            echo 'success';
            die;
        }
    }
    
    public function pm_get_all_requests_from_group()
    {
        $pmrequests = new PM_request;
        $gid = filter_input(INPUT_POST, 'gid');
        $sort_by = filter_input(INPUT_POST, 'sortby');
        $search = filter_input(INPUT_POST, 'search');
        $pagenum = filter_input(INPUT_POST, 'pagenum');
       // $current_user = wp_get_current_user();
        
        echo $pmrequests->pm_get_all_join_group_requests($gid,$pagenum,$limit=10,$sort_by,$search);
        die;
    }
    
    public function user_online_status(){
        // get the user activity the list
        $logged_in_users = get_transient('rm_user_online_status');

        // get current user ID
        $user = wp_get_current_user();

        // check if the current user needs to update his online status;
        // he does if he doesn't exist in the list
        $no_need_to_update = isset($logged_in_users[$user->ID])

            // and if his "last activity" was less than let's say ...15 minutes ago          
            && $logged_in_users[$user->ID] >  (time() - (15 * 60));

        // update the list if needed
        if(!$no_need_to_update){
          $logged_in_users[$user->ID] = time();
          set_transient('rm_user_online_status', $logged_in_users, $expire_in = (30*60)); // 30 mins 
        }
        
        wp_schedule_single_event(time(),'twicedaily','clean_user_online_status');
    }
    
    public function clean_user_online_status(){
        $logged_in_users = get_transient('rm_user_online_status');
        foreach($logged_in_users as $user=>$time){
            if(time()>= $time + 3600){
                unset($logged_in_users[$user]);
            }
        }
        set_transient('rm_user_online_status', $logged_in_users, $expire_in = (30*60));
    }
    
    public function profile_magic_set_logged_out_status($uid='')
    {
         if($uid=='')
         {
             $current_user = wp_get_current_user(); 
             $uid = $current_user->ID;
         }
         $logged_in_users = get_transient('rm_user_online_status');
        
         if(isset($logged_in_users) && is_array($logged_in_users) && !empty($logged_in_users) && isset($logged_in_users[$uid]))
         {
            unset($logged_in_users[$uid]);
         }
         set_transient('rm_user_online_status', $logged_in_users, $expire_in = (30*60));
    }
    
   

    public function profile_magic_rm_form_submission($form_id,$user_id,$rm_data)
    {
        $pmrequests = new PM_request;
        
        if(is_array($user_id))
        {
            $uid = $user_id['user_id'];
        }
        else { $uid = $user_id;}
            
        $form_type = $pmrequests->pm_check_rm_form_type($form_id);
        if($form_type=="1" && is_user_logged_in() && $user_id==null)
        {
            $user_id  = get_current_user_id();
            $uid = $user_id;
        }
        if($form_type=="1" && isset($user_id) && $user_id!=null)
        {
            $associate_groups = $pmrequests->pm_check_rm_form_associate_with_groups($form_id);
           
            if(!empty($associate_groups))
            {
                foreach($associate_groups as $group)
                {
                   $group_limit = $pmrequests->pm_check_group_limit($group);
                   if($group_limit!=''){echo $group_limit;continue;}
                   $group_type = $pmrequests->profile_magic_get_group_type($group);
                  
                   $pmrequests->profile_magic_join_group_fun($uid,$group,$group_type);
                   $mapping_fields = $pmrequests->pm_get_map_fields_with_rm_form($group);
                  
                   foreach($mapping_fields as $key => $map_field)
                   {
                       $map_with= $map_field['field_map_with'];
                       if(isset($map_with) && $map_with!='')
                       {
                            $rmvalue = $pmrequests->pg_get_filter_rm_value($map_field,$rm_data,$uid);
                            update_user_meta($uid,$key,$rmvalue);
                       }
                   }
                   unset($mapping_fields);
                }
            }
        }
    }
    
    public function pg_rm_registration_tab($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $title = $dbhandler->get_global_option_value('pm_rm_registrations_title',__('Registration','profilegrid-user-profiles-groups-and-communities'));
        if($dbhandler->get_global_option_value('pm_enable_rm_registrations_tab','0')==1 && class_exists('Registration_Magic'))
        {
            echo '<li class="pm-dbfl pm-border-bt pm-pad10"><a class="pm-dbfl" href="#pg_rm_registration_tab">'.$title.'</a></li>';
        }
    }
    
    public function pg_rm_registration_tab_content($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        
       
        if($dbhandler->get_global_option_value('pm_enable_rm_registrations_tab','0')==1 && class_exists('Registration_Magic'))
        {
          
            echo '<div id="pg_rm_registration_tab" class="pm-blog-desc-wrap pm-difl pm-section-content"> <div class="rmagic">';
            
            
           echo do_shortcode('[RM_Front_Submissions view="registrations"]');
           
            echo '</div> </div>';
        }
    }
    
    public function pg_rm_payment_tab($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $title = $dbhandler->get_global_option_value('pm_rm_payments_title',__('Payment History','profilegrid-user-profiles-groups-and-communities'));
        if($dbhandler->get_global_option_value('pm_enable_rm_payments_tab','0')==1 && class_exists('Registration_Magic'))
        {
            echo '<li class="pm-dbfl pm-border-bt pm-pad10"><a class="pm-dbfl" href="#pg_rm_payment_tab">'.$title.'</a></li>';
        }
    }
    
    public function pg_rm_payment_tab_content($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $user = get_user_by('ID',$uid);
       
        if($dbhandler->get_global_option_value('pm_enable_rm_payments_tab','0')==1 && class_exists('Registration_Magic'))
        {
            echo '<div id="pg_rm_payment_tab" class="pm-blog-desc-wrap pm-difl pm-section-content"><div class="rmagic">';
            echo do_shortcode('[RM_Front_Submissions view="payments"]');
            echo '</div></div>';
        }
    }
    
    public function pg_rm_inbox_tab($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $title = $dbhandler->get_global_option_value('pm_rm_inbox_title',__('Inbox','profilegrid-user-profiles-groups-and-communities'));
        
        if($dbhandler->get_global_option_value('pm_enable_rm_inbox_tab','0')==1 && defined('REGMAGIC_GOLD'))
        {
            $inbox = new RM_Front_Service;
            $user = get_user_by('ID',$uid);
            $user_email = $user->user_email;
            $count = $inbox->get_email_unread_count($user_email);
            echo '<li class="pm-dbfl pm-border-bt pm-pad10"><a class="pm-dbfl" href="#pg_rm_inbox_tab">'.$title.'<span id="pg_show_inbox"><b id="pg_show_inboxs" class="pg-rm-inbox">'. $count .'</b></span></a></li>';
        }
    }
    
    public function pg_rm_inbox_tab_content($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $user = get_user_by('ID',$uid);
       
        if($dbhandler->get_global_option_value('pm_enable_rm_inbox_tab','0')==1 && defined('REGMAGIC_GOLD'))
        {
            echo '<div id="pg_rm_inbox_tab" class="pm-blog-desc-wrap pm-difl pm-section-content"><div class="rmagic">';
            echo do_shortcode('[RM_Front_Submissions view="inbox"]');
            echo '</div></div>';
        }
    }
    
    public function pg_rm_orders_tab($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $title = $dbhandler->get_global_option_value('pm_rm_orders_title',__('Orders','profilegrid-user-profiles-groups-and-communities'));
        if($dbhandler->get_global_option_value('pm_enable_rm_orders_tab','0')==1 && defined('REGMAGIC_GOLD') && is_plugin_active( 'woocommerce/woocommerce.php' ))
        {
            echo '<li class="pm-dbfl pm-border-bt pm-pad10"><a class="pm-dbfl" href="#pg_rm_orders_tab">'.$title.'</a></li>';
        }
    }
    
    public function pg_rm_orders_tab_content($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $user = get_user_by('ID',$uid);
       
        if($dbhandler->get_global_option_value('pm_enable_rm_orders_tab','0')==1 && defined('REGMAGIC_GOLD') && is_plugin_active( 'woocommerce/woocommerce.php' ))
        {
            echo '<div id="pg_rm_orders_tab" class="pm-blog-desc-wrap pm-difl pm-section-content"><div class="rmagic">';
           //echo RM_DBManager::get_latest_submission_for_user($user->user_email);
            echo do_shortcode('[RM_Front_Submissions view="orders"]');
            echo '</div></div>';
        }
    }
     
    public function pg_rm_downloads_tab($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $title = $dbhandler->get_global_option_value('pm_rm_downloads_title',__('Downloads','profilegrid-user-profiles-groups-and-communities'));
        
        if($dbhandler->get_global_option_value('pm_enable_rm_downloads_tab','0')==1 && defined('REGMAGIC_GOLD') && is_plugin_active( 'woocommerce/woocommerce.php' ))
        {
            echo '<li class="pm-dbfl pm-border-bt pm-pad10"><a class="pm-dbfl" href="#pg_rm_download_tab">'.$title.'</a></li>';
        }
    }
    
    public function pg_rm_downloads_tab_content($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $user = get_user_by('ID',$uid);
       
        if($dbhandler->get_global_option_value('pm_enable_rm_downloads_tab','0')==1 && defined('REGMAGIC_GOLD') && is_plugin_active( 'woocommerce/woocommerce.php' ))
        {
            echo '<div id="pg_rm_download_tab" class="pm-blog-desc-wrap pm-difl pm-section-content"><div class="rmagic">';
           //echo RM_DBManager::get_latest_submission_for_user($user->user_email);
            echo do_shortcode('[RM_Front_Submissions view="downloads"]');
            echo '</div></div>';
        }
    }
    
    public function pg_rm_addresses_tab($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $title = $dbhandler->get_global_option_value('pm_rm_addresses_title',__('Addresses','profilegrid-user-profiles-groups-and-communities'));
        
        if($dbhandler->get_global_option_value('pm_enable_rm_addresses_tab','0')==1 && defined('REGMAGIC_GOLD') && is_plugin_active( 'woocommerce/woocommerce.php' ))
        {
            echo '<li class="pm-dbfl pm-border-bt pm-pad10"><a class="pm-dbfl" href="#pg_rm_addresses_tab">'.$title.'</a></li>';
        }
    }
    
    public function pg_rm_addresses_tab_content($uid,$gid)
    {
        $dbhandler = new PM_DBhandler;
        $pmrequests = new PM_request;
        $user = get_user_by('ID',$uid);
       
        if($dbhandler->get_global_option_value('pm_enable_rm_addresses_tab','0')==1 && defined('REGMAGIC_GOLD') && is_plugin_active( 'woocommerce/woocommerce.php' ))
        {
            echo '<div id="pg_rm_addresses_tab" class="pm-blog-desc-wrap pm-difl pm-section-content"><div class="rmagic">';
           //echo RM_DBManager::get_latest_submission_for_user($user->user_email);
            echo do_shortcode('[RM_Front_Submissions view="addresses"]');
            echo '</div></div>';
        }
    }
    
    public function pg_forget_password_page($lostpassword_url,$redirect )
    {
        $pmrequests = new PM_request;
        $forget_password_url = $pmrequests->profile_magic_get_frontend_url('pm_forget_password_page',site_url('/wp-login.php?action=lostpassword'));
        return $forget_password_url;
    }
    
    public function pm_send_message_notification($mid,$args)
    {
        
        $sid = $args[1];
        $rid = $args[2];
        $content = $args[3];
        $identifier = 'MSG_CONVERSATION';
        $dbhandler = new PM_DBhandler;
        $status = $dbhandler->get_value($identifier,'status',$mid,'m_id');
        if($status==2)
        {
            $notification = new Profile_Magic_Notification;
            $notification->pm_added_new_message_notification($rid,$sid,$content);
        }
        // Get the timestamp for the next event.
        $timestamp = wp_next_scheduled( 'pm_send_message_notification' );
        wp_unschedule_event( $timestamp, 'pm_send_message_notification', array($mid,$args) );
        wp_clear_scheduled_hook( 'pm_send_message_notification',array($mid,$args));
    }
    
    public function profile_magic_user_blogs($content)
    {
        return $this->profile_magic_get_template_html( 'profile-magic-user-blogs', $content );
    }
    
    public function pm_load_user_blogs_shortcode_posts()
    {
         $pmhtmlcreator = new PM_HTML_Creator($this->profile_magic,$this->version);
         if($_POST['authors']!='')
         {
            $author = explode(',',$_POST['authors']);
         }
         else
         {
             $author = array();
         }
         $post_type = explode(',',$_POST['posttypes']);
         //print_r($author);die;
            $pmhtmlcreator->pm_get_user_blogs_shortcode_posts($author,$post_type,$_POST['page']);
            die;
    }
    
    public function pg_get_group_page_link($page,$default,$gid)
    {
        $url = $default;
        if($page=='pm_group_page' && $gid!='')
        {
            $dbhandler = new PM_DBhandler;
            $identifier = 'GROUPS';
            $group_options = array();
            $row = $dbhandler->get_row($identifier,$gid);
            if(isset($row) && isset($row->group_options) && $row->group_options!="")
            {
                $group_options = maybe_unserialize($row->group_options);
            }

            if(!empty($group_options['group_page']) && $group_options['group_page']!="0")
            {
                $group_page = $group_options['group_page'];
                $post_status = get_post_status($group_page);
                if($post_status=='publish')
                {
                    $url = get_permalink($group_page);
                }
            }
            
        }
        
        return $url;
    }
    
    
}
