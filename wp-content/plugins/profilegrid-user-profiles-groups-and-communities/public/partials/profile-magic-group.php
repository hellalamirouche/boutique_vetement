<?php
$dbhandler = new PM_DBhandler;
$pm_activator = new Profile_Magic_Activator;
$pmrequests = new PM_request;
$html_creator = new PM_HTML_Creator($this->profile_magic,$this->version);
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$gid = filter_input(INPUT_GET, 'gid');
$identifier = 'GROUPS';
if(!isset($gid))
$gid = $content['id'];
$current_user = wp_get_current_user();
$row = $dbhandler->get_row('GROUPS',$gid);
if(isset($_REQUEST["action"]) && $_REQUEST["action"]!='process')
{
    if(isset($_REQUEST["uid"]))$uid = $_REQUEST["uid"];else $uid = false;
    $pm_payapl_request = new PM_paypal_request();
    $pm_payapl_request->profile_magic_join_group_payment_process($_POST, $_REQUEST["action"],$gid,$uid);
    return false;
}
if(isset($_POST['remove_image']))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_pm_edit_group' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
	$groupid = filter_input(INPUT_POST,'group_id');
	
	if($groupid!=0)
	{
		$data = array('group_icon'=>'');
		$arg = array('%d');
	    $dbhandler->update_row($identifier,'id',$groupid,$data,$arg,'%d');
	}
	$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$groupid);
	$redirect_url = add_query_arg('gid',$groupid,$redirect_url);
	wp_redirect( esc_url_raw( $redirect_url ) );
	exit;
	
}

if(isset($_POST['cancel']))
{
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_pm_edit_group' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
	$groupid = filter_input(INPUT_POST,'group_id');
	$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$groupid);
	$redirect_url = add_query_arg('gid',$groupid,$redirect_url);
	wp_redirect( esc_url_raw( $redirect_url ) );
	exit;
}

if(isset($_POST['edit_group']))
{
	
	$retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
	if (!wp_verify_nonce($retrieved_nonce, 'save_pm_edit_group' ) ) die( __('Failed security check','profilegrid-user-profiles-groups-and-communities') );
	$groupid = filter_input(INPUT_POST,'group_id');
	$exclude = array("_wpnonce","_wp_http_referer","edit_group","group_id");
	$post = $pmrequests->sanitize_request($_POST,$identifier,$exclude);
	$filefield = $_FILES['group_icon'];
	$allowed_ext ='jpg|jpeg|png|gif';
	if(isset($filefield) && !empty($filefield))
	{
		$attachment_id = $pmrequests->make_upload_and_get_attached_id($filefield,$allowed_ext);
		$post['group_icon'] = $attachment_id;
	}
	
	if($post!=false)
	{
		foreach($post as $key=>$value)
		{
		  $data[$key] = $value;
		  $arg[] = $pm_activator->get_db_table_field_type($identifier,$key);
		}
	}
	if($groupid!=0)
	{
	    $dbhandler->update_row($identifier,'id',$groupid,$data,$arg,'%d');
	}
	$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$groupid);
	$redirect_url = add_query_arg('gid',$groupid,$redirect_url);
	wp_redirect( esc_url_raw( $redirect_url ) );
	exit;	
}

if(isset($_POST['pg_join_group']))
{
    $pg_uid = filter_input(INPUT_POST, 'pg_uid');
    $pg_join_gid = filter_input(INPUT_POST, 'pg_join_gid');
    $group_type = $pmrequests->profile_magic_get_group_type($pg_join_gid);
    $is_paid_group = $pmrequests->profile_magic_check_paid_group($pg_join_gid);
    if($is_paid_group>0)
    {
        $html_creator->pg_join_paid_group_html($pg_join_gid, $pg_uid);
    }
    else
    {
        $result = $pmrequests->profile_magic_join_group_fun($pg_uid, $pg_join_gid,$group_type);
       
        if($result==true)
        {
            $redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$pg_join_gid);
            $redirect_url = add_query_arg('gid',$pg_join_gid,$redirect_url);
            wp_redirect( esc_url_raw( $redirect_url ) );
            exit;	
        }
        
    }
}

if(isset($_POST['pg_join_paid_group']))
{
    $pg_uid = filter_input(INPUT_POST, 'pg_uid');
    $pg_join_gid = filter_input(INPUT_POST, 'pg_join_gid');
    do_action('profile_magic_join_group_registration_process',$_POST,$pg_join_gid,$pg_uid);
    do_action('profile_magic_join_paid_group_process',$_POST,$pg_join_gid,$pg_uid);
}

if(!isset($_POST['pg_join_group']) && !isset($_POST['pg_join_paid_group'])):
if(!empty($row))
{
	$pagenum = filter_input(INPUT_GET, 'pagenum');
	
	$pagenum = isset($pagenum) ? absint($pagenum) : 1;
	$limit = 10; // number of rows in page
	$offset = ( $pagenum - 1 ) * $limit;
        $hide_users = $pmrequests->pm_get_hide_users_array();
	$meta_query = array(
						'relation' => 'AND',
						array(
							'key'     => 'pm_group',
							'value'   => sprintf(':"%s";',$gid),
							'compare' => 'like'
						),
						array(
							'key'     => 'rm_user_status',
							'value'   => '0',
							'compare' => '='
						)
						
					);
        
	if($row->is_group_leader!=0)
        {
            $leaders = $pmrequests->pg_get_group_leaders($gid);
        }
	if(isset($group_leader))$exclude = array($group_leader);else{ $exclude = array(); $group_leader = 0;}
	$user_query =  $dbhandler->pm_get_all_users_ajax('',$meta_query,'',$offset,$limit,'ASC','ID',$hide_users);
	$total_users = $user_query->get_total();
        $users = $user_query->get_results();
        $num_of_pages = ceil( $total_users/$limit);
	$pagination = $dbhandler->pm_get_pagination($num_of_pages,$pagenum);
	if(filter_input(INPUT_GET, 'edit') && in_array($current_user->ID,$leaders) && is_user_logged_in())
	{
                 $themepath = $this->profile_magic_get_pm_theme('edit-group-tpl');
                 include $themepath;
	}
	else
	{
                 $themepath = $this->profile_magic_get_pm_theme('group-tpl');
                 include $themepath;	
	}
	
}
else
{
        echo '<div class="pmrow pg-alert-info pg-alert-warning">'.__( 'Sorry, this group is currently not accessible. Either it was deleted or its ID does not matches.','profilegrid-user-profiles-groups-and-communities' ).'</div>'; 
}
endif;
?>
