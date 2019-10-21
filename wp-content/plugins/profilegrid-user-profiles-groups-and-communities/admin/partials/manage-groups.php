<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$identifier = 'GROUPS';
$pagenum = filter_input(INPUT_GET, 'pagenum');
$pagenum = isset($pagenum) ? absint($pagenum) : 1;
$limit = 11; // number of rows in page
$offset = ( $pagenum - 1 ) * $limit;
$totalgroups = $dbhandler->pm_count($identifier);
$groups =  $dbhandler->get_all_result($identifier,'*',1,'results',$offset,$limit,'id','desc');
$num_of_pages = ceil( $totalgroups/$limit);
$pagination = $dbhandler->pm_get_pagination($num_of_pages,$pagenum);
?>
<div class="pm_notification"></div>
<div class="pmagic"> 
  
  <!-----Operationsbar Starts----->
  <a href="https://profilegrid.co/multi-group-users-and-group-manager/" class="pg-upcoming-version-notice" target="_blank">
      <?php _e("Learn what's new in version 3.0","profilegrid-user-profiles-groups-and-communities") ?>
  </a>
  <form name="pm_manage_groups" id="pm_manage_groups" action="admin.php?page=pm_add_group" method="post">
  <div class="operationsbar">
    <div class="pmtitle">
      <?php _e('Group Manager','profilegrid-user-profiles-groups-and-communities');?>
    </div>
    <div class="icons"><a href="admin.php?page=pm_settings"> <img src="<?php echo $path;?>images/global-settings.png"></a> </div>
    <div class="nav">
      <ul>
        <li>
        <input type="submit" class="pm_add_new" id="pm_add_new" value="<?php _e('Add New','profilegrid-user-profiles-groups-and-communities');?>" />
        </li>
        <li class="pm_action_button"><input type="submit" class="pm_disabled" name="duplicate" id="duplicate" value="<?php _e('Duplicate','profilegrid-user-profiles-groups-and-communities');?>" disabled></li>
        <li class="pm_action_button"><input type="submit" class="pm_disabled" name="delete" id="delete" value="<?php _e('Delete','profilegrid-user-profiles-groups-and-communities');?>" onclick="return pg_confirm('<?php _e('You are going to delete selected groups permanently. This action cannot be undone. Please confirm.','profilegrid-user-profiles-groups-and-communities');?>')" disabled></li>
        <li class="pm_action_button"><a href="https://profilegrid.co/profilegrid-starter-guide" target="_blank"><?php _e('Starter Guide','profilegrid-user-profiles-groups-and-communities');?><span class="dashicons dashicons-book-alt"></span></a></li>
      </ul>
    </div>
  </div>
  
  <!-------Contentarea Starts----->
  
  <div class="pmagic-cards">
    <div class="pm-card">
      <div class="pm-new-form">
        <input type="text" name="group_name" id="group_name">
        <div class="errortext" id="group_error" style="display:none;"><?php _e('This is required field','profilegrid-user-profiles-groups-and-communities');?></div>
        <input type="hidden" name="group_id" id="group_id" value="" />
        <input type="hidden" name="associate_role" id="associate_role" value="subscriber">
        <?php wp_nonce_field('save_pm_add_group'); ?>
        <input type="submit" value="<?php _e('Create New Group','profilegrid-user-profiles-groups-and-communities');?>" name="submit_group" id="submit_group" onclick="return check_validation()" />
      </div>
    </div>
    <?php if(!empty($groups)):
    foreach($groups as $group):
	
	$meta_query_array = $pmrequests->pm_get_user_meta_query(array('gid'=>$group->id));
	$date_query = $pmrequests->pm_get_user_date_query(array('gid'=>$group->id));
	$user_query =  $dbhandler->pm_get_all_users_ajax('',$meta_query_array,'',0,3,'DESC','ID');
        $total_users = $user_query->get_total();
        $users = $user_query->get_results();
        
	?>
    <div class="pm-card">
      <div class="cardtitle">
        <input type="checkbox" name="selected[]" value="<?php echo $group->id;?>" />
          <i class="fa fa-users" aria-hidden="true"></i>
          <a href="admin.php?page=pm_add_group&id=<?php echo $group->id;?>"><?php echo $group->group_name;?></a>    
           
      </div>
      <div class="pm-card-icon"><?php echo $pmrequests->pg_get_group_card_icon_link($group->id); ?></div>  
      
      <div class="pm-last-submission"> <b><?php _e("Members",'profilegrid-user-profiles-groups-and-communities');?></b></div>
      <?php foreach($users as $user):?>
      <div class="pm-last-submission"><a href="admin.php?page=pm_profile_view&id=<?php echo $user->ID; ?>"><?php echo get_avatar($user->user_email,16,'',false,array('class'=>'pm-user','force_display'=>true));?> </a> <?php _e("At",'profilegrid-user-profiles-groups-and-communities');?> <?php echo $user->user_registered;?> </div>
      <?php endforeach;?>
      <?php if($total_users>3):?>
      <div class="pm-last-submission"> <?php _e('(...)','profilegrid-user-profiles-groups-and-communities');?><a href="admin.php?page=pm_user_manager&gid=<?php echo $group->id; ?>"> <?php _e("and",'profilegrid-user-profiles-groups-and-communities');?> <span class="card-submissions"><?php echo $total_users-3;?> </span> <?php _e("more",'profilegrid-user-profiles-groups-and-communities');?> </a> </div>
      <?php endif;?>
      <div class="pm-form-shortcode-row"><?php echo 'ID '.$group->id.'';?></div>
      <div class="pm-form-links">
        <div class="pm-form-row"><a href="admin.php?page=pm_add_group&id=<?php echo $group->id;?>"><?php _e('Settings','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-form-row"><a href="admin.php?page=pm_profile_fields&gid=<?php echo $group->id;?>"><?php _e('Fields','profilegrid-user-profiles-groups-and-communities');?></a></div>
      </div>
    </div>
    <?php endforeach;?>
    <?php else: ?>
    <?php _e( 'You have not created any groups yet. Once you have created a new group, it will appear here.','profilegrid-user-profiles-groups-and-communities' ); ?>
    <?php endif;?>
    
    
  </div>
 <?php echo $pagination;?>
  
 </form>
    <div class="pm_note">
        <p align="center"><?php _e('Note: Groups are optional. If you do not wish to create multiple groups, you can use the default group for all user profiles and sign ups.','profilegrid-user-profiles-groups-and-communities');?></p>
    </div>
    <?php $pmrequests->pm_five_star_review_banner();?>
</div>
