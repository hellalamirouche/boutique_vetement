<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$current_user = wp_get_current_user();
$pm_error = '';

if(isset($_POST['upload_image']))
{
	$filefield = $_FILES['user_image'];
	$allowed_ext ='jpg|jpeg|png|gif';
	if($_POST['user_id']==$current_user->ID)
	{
		$attachment_id = $pmrequests->make_upload_and_get_attached_id($filefield,$allowed_ext);
		update_user_meta($_POST['user_id'],$_POST['user_meta'],$attachment_id);	
	}
	$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page',site_url('/wp-login.php'));
	wp_redirect( esc_url_raw($redirect_url ) );
	exit;
}

if(isset($_POST['remove_image']))
{
	if($_POST['user_id']==$current_user->ID)
	{
		update_user_meta($_POST['user_id'],$_POST['user_meta'],'');	
                if($_POST['user_meta']=='pm_user_avatar')
                {
                    do_action('pm_remove_profile_image',$_POST['user_id']);
                }
                
                if( $_POST['user_meta']=='pm_cover_image')
                {
                    do_action('pm_remove_cover_image',$_POST['user_id']);
                }
	}
	$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page',site_url('/wp-login.php'));
	wp_redirect( esc_url_raw($redirect_url) );
	exit;
}

if(isset($_POST['edit_profile']))
{
    
	$gids = $pmrequests->profile_magic_get_user_field_value($_POST['euid'],'pm_group');
        $gid = $pmrequests->pg_filter_users_group_ids($gids);
        if(is_array($gid)){$gid_array = $gid;} else{$gid_array = array($gid);}
	$exclude = "associate_group in(".implode(',',$gid_array).") and field_type not in('user_name','user_email','user_avatar','user_pass','confirm_pass','paragraph','heading')";
        $fields =  $dbhandler->get_all_result('FIELDS', $column = '*',1,'results',0,false, $sort_by = 'ordering',false,$exclude);
	//$errors = $pmrequests->profile_magic_frontend_server_validation($_POST,$_FILES,$_SERVER,$fields,$textdomain,'edit_profile');	
	//print_r($errors);die;
        if(empty($errors))
	{
            $pmrequests->pm_update_user_custom_fields_data($_POST,$_FILES,$_SERVER,$gid,$fields,$_POST['euid']);
            do_action('profile_magic_update_user_meta',$_POST,$_FILES,$_SERVER,$gid,$fields,$_POST['euid'],$textdomain);
	}
        
        if(isset($_POST['pg_rd']))
        {
            $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$_POST['gid']);
            $redirect_url = $redirect_url = add_query_arg('gid',$_POST['gid'],$redirect_url);
        }
        else
        {
            $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page',site_url('/wp-login.php'));
        }
	
	wp_redirect( esc_url_raw($redirect_url) );
	exit;
}

if(isset($_POST['canel_edit_profile']))
{
    $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page',site_url('/wp-login.php'));
	wp_redirect( esc_url_raw($redirect_url) );
	exit;
}

if(isset($content['id']))$uid = $content['id'];else $uid = filter_input(INPUT_GET, 'uid');
if(isset($uid))
{
     $uid = $pmrequests->pm_get_uid_from_profile_slug($uid);
}
if(!isset($uid) && is_user_logged_in()){$uid = $current_user->ID;}
if(isset($uid))
{
    $user_info = get_userdata($uid);
    if(!empty($user_info)):
	$avatar = get_avatar($user_info->user_email, 274,'',false,array('class'=>'pm-user','force_display'=>true));
	$userrole = $pmrequests->get_userrole_name($uid);
	
	$gids = maybe_unserialize($pmrequests->profile_magic_get_user_field_value($uid,'pm_group'));
        $gid = $pmrequests->pg_filter_users_group_ids($gids);
	
        if(!empty($gid))
        {
            $gid_in = "gid in(".implode(',',$gid).")";
            $sections =  $dbhandler->get_all_result('SECTION',array('id','section_name'),1,'results',0,false,'gid,ordering',false,$gid_in);
        }
        if(is_user_logged_in())$filter_user_id = $pmrequests->pm_get_profile_slug_by_id($current_user->ID);
        if(filter_input(INPUT_GET, 'user_id') && (is_super_admin($current_user->ID ) || filter_input(INPUT_GET, 'user_id')==$filter_user_id || $pmrequests->pg_check_in_single_group_is_user_group_leader($current_user->ID,filter_input(INPUT_GET, 'gid'))))
        {
            $edit_uid = filter_input(INPUT_GET, 'user_id');
            $edit_uid = $pmrequests->pm_get_uid_from_profile_slug($edit_uid);
            $gids = maybe_unserialize($pmrequests->profile_magic_get_user_field_value($edit_uid,'pm_group'));
            $gid = $pmrequests->pg_filter_users_group_ids($gids);

            if(!empty($gid))
            {
                $gid_in = "gid in(".implode(',',$gid).")";
                $sections =  $dbhandler->get_all_result('SECTION',array('id','section_name'),1,'results',0,false,'gid,ordering',false,$gid_in);
            }
            $themepath = $this->profile_magic_get_pm_theme('edit-profile-tpl');
            include $themepath;
        }
        else
        {
            if($pmrequests->profile_magic_check_profile_access_permission($uid))
            {
            $themepath = $this->profile_magic_get_pm_theme('profile-tpl');
            include $themepath;
            echo '<input type="hidden" value="'.$uid.'" name="pm-uid" id="pm-uid" />';
            }
            else 
            {
                 _e('You are not authorized to view this profile','profilegrid-user-profiles-groups-and-communities');
            }
        }
            
       
    else:
        echo '<div class="pm_message">'.__('This user does not exists.','profilegrid-user-profiles-groups-and-communities').'</div>';
    endif;   
	
}
else
{
	$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_login_page',site_url('/wp-login.php'));
	$redirect_url = add_query_arg( 'errors','loginrequired', $redirect_url );
	wp_redirect( esc_url_raw( $redirect_url ) );
	exit;	
}
if($dbhandler->get_global_option_value('pm_enable_live_notification','1')=='1')
{
    wp_enqueue_script( 'profile-magic-heartbeat.js', plugin_dir_url( __FILE__ ) . '../js/profile-magic-heartbeat.js', array( 'jquery' ), $this->version, true );
}              
?>
