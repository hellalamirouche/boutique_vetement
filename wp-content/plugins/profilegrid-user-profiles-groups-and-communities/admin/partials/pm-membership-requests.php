<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$pmemails = new PM_Emails;
$path =  plugin_dir_url(__FILE__); 
$pagenum = filter_input(INPUT_GET, 'pagenum');
$gid = filter_input(INPUT_GET, 'gid');
$current_user = wp_get_current_user();
$pagenum = isset($pagenum) ? absint($pagenum) : 1;
$limit = 10; // number of rows in page
$offset = ( $pagenum - 1 ) * $limit;
//if(filter_input(INPUT_GET,'result')=='Search'){$pagenum=1;}
if(filter_input(INPUT_GET,'approve'))
{
	$selected = filter_input(INPUT_GET, 'selected', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        //print_r($selected);die;
	if(isset($selected)):
	foreach($selected as $id)
	{
            $request = $dbhandler->get_row('REQUESTS',$id,'id');
            //print_r($request);die;
            $update = $pmrequests->profile_magic_join_group_fun($request->uid,$request->gid,'open');
	}
	endif;
        wp_redirect( esc_url_raw('admin.php?page=pm_requests_manager') );exit;
}

if(filter_input(INPUT_GET,'decline'))
{
	$selected = filter_input(INPUT_GET, 'selected', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
	if(isset($selected)):
	foreach($selected as $id)
	{
                $request = $dbhandler->get_row('REQUESTS',$id,'id');
		$dbhandler->remove_row('REQUESTS','id',$id);
                $pmemails->pm_send_group_based_notification($request->gid,$request->uid,'on_request_denied');
	}
	endif;
        wp_redirect( esc_url_raw('admin.php?page=pm_requests_manager') );exit;
}


if(isset($_GET['search'])) $search = filter_input( INPUT_GET, 'search', FILTER_SANITIZE_STRING );else $search = '';

$groups =  $dbhandler->get_all_result('GROUPS',array('id','group_name'));
$user_request = array();
if(isset($gid) && $gid!='')
{
    
    $where = array('gid'=>$gid,'status'=>'1');
}
else
{
     $where = array('status'=>'1');
}
 $requested = $dbhandler->get_all_result('REQUESTS','*',$where,'results');
//echo count($requested);die;
 $additional = '';
if(!empty($requested))
{
    foreach($requested as $request)
    {
        $user = get_user_by('ID', $request->uid);
        if(isset($user) && !empty($user))
        {
            $user_request[] = $request->id;
        }
    }
    if(!empty($user_request))
    {
    $rid = implode(',',$user_request);
    $additional = 'and id in('.$rid.')';
    }
    else
    {
        $additional = 'and id in(0)';
    }
}
$results = $dbhandler->get_all_result('REQUESTS','*', $where,'results', $offset, $limit,'id','asc',$additional);        
$total_users = count($user_request);
$num_of_pages = ceil( $total_users/$limit);
$pagination = $dbhandler->pm_get_pagination($num_of_pages,$pagenum);
?>

<div class="pmagic"> 
  
  <!-----Operationsbar Starts----->
  <form name="request_manager" id="request_manager" action="" method="get">
  <input type="hidden" name="page" value="pm_requests_manager" />
  <input type="hidden" id="pagenum" name="pagenum" value="1" />
  <div class="operationsbar">
    <div class="pmtitle">
      <?php _e('Membership Requests','profilegrid-user-profiles-groups-and-communities');?>
    </div>
   
    <div class="nav">
      <ul>
      
        <li class="pm_action_button"><input type="submit" name="approve" value="<?php _e("Approve",'profilegrid-user-profiles-groups-and-communities');?>" /></li>
        <li class="pm_action_button"><input type="submit" name="decline" value="<?php _e("Decline",'profilegrid-user-profiles-groups-and-communities');?>" /></li>
        
        <li class="pm-form-toggle">
            <select name="gid" id="gid" onChange="jQuery('#pagenum').val(1);submit()">
            <option value=""><?php _e('Select A Group','profilegrid-user-profiles-groups-and-communities');?></option>
            <?php
                          foreach($groups as $group)
                          {?>
            <option value="<?php echo $group->id;?>" <?php if(!empty($gid))selected($gid,$group->id);?>><?php echo $group->group_name; ?></option>
            <?php }
                          ?>
          </select>
        </li>
      </ul>      
    </div>
  </div>
 
  <!--------Operationsbar Ends-----> 
  
  <!-------Contentarea Starts-----> 
  
  <!----Table Wrapper---->
  
  <div class="pmagic-table"> 
    
    <!----Sidebar---->
   
    <table style="width:100%">
      <tr>
        <th>Sr.</th>
        <th>&nbsp;</th>
        <th><?php _e('Image','profilegrid-user-profiles-groups-and-communities');?></th>
        <th><?php _e('Name','profilegrid-user-profiles-groups-and-communities');?></th>
        <th><?php _e('Email','profilegrid-user-profiles-groups-and-communities');?></th>
        <th><?php _e('Request Date','profilegrid-user-profiles-groups-and-communities');?></th>
        <th><?php _e('Group','profilegrid-user-profiles-groups-and-communities');?></th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php
                        if(!empty($results))
                        {
                            $i = 1 + $offset;
                            foreach($results as $entry)
                            {
                                
                                $user = get_user_by('ID',$entry->uid);
                                if(!$user || empty($user))
                                {
                                    continue;
                                }
                                    $avatar = get_avatar($user->user_email, 30,'',false,array('force_display'=>true) );
                                    $request_options = maybe_unserialize ($entry->options);
                                    $groupname = $dbhandler->get_value('GROUPS', 'group_name',$entry->gid);
                                    ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><input type="checkbox" name="selected[]" value="<?php echo $entry->id; ?>" /></td>
            <td><div class="tableimg"> <a href="admin.php?page=pm_profile_view&id=<?php echo $user->ID;?>"><?php echo $avatar;?></a> </div></td>
            <td><?php echo $user->display_name;?></td>
            <td><?php echo $user->user_email;?></td>
            <td><?php echo $pmrequests->pm_change_date_in_different_format($request_options['request_date'],'request');?></td>
            <td><?php echo $groupname;?></td>
            
                      <?php $i++;} 
                        }
                        else
                        {
                            echo '<div class="pg-notice pg-alert">';
                            if(isset($gid) && $gid!='')
                            {
                                 _e('No user matches your search.','profilegrid-user-profiles-groups-and-communities');
                            }
                            else
                            {
                                 _e('If you have assigned Group Managers with Frontend Group Manager extension installed, they can Manage Group Membership requests for respective closed Groups from Group Management page. As a site Administrator, you too can approve or reject membership requests directly from the dashboard. This is helpful when you do not plan to assign Group Managers or do not have Frontend Group Manager extension installed.','profilegrid-user-profiles-groups-and-communities');
                            }
                            
                            echo '</div>';
                        }
?>
            
          </tr>

    </table>
  </div>
  <?php echo $pagination;?>
  </form>
</div>
