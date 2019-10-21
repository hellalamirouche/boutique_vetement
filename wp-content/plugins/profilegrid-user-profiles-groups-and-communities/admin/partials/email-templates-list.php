<?php
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__); 
$identifier = 'EMAIL_TMPL';
$pagenum = filter_input(INPUT_GET, 'pagenum');
$pagenum = isset($pagenum) ? absint($pagenum) : 1;
$limit = 20; // number of rows in page
$offset = ( $pagenum - 1 ) * $limit;
$i = 1 + $offset;
$totalemails = $dbhandler->pm_count($identifier);
$emails =  $dbhandler->get_all_result($identifier,'*',1,'results',$offset,$limit,'id');
$num_of_pages = ceil( $totalemails/$limit);
$pagination = $dbhandler->pm_get_pagination($num_of_pages,$pagenum);
if(isset($_GET['selected']))
{
	$selected = filter_input(INPUT_GET, 'selected', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $count_selected =  count($selected);
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
                        $msg = sprintf(__('The Email Template you are trying to delete is being used for notifications by group %s. Disassociate the template before deleting.','profilegrid-user-profiles-groups-and-communities'),$exist_tmpl);
                    }  
                } 
                else
                {
                    $dbhandler->remove_row($identifier,'id',$tid,'%d');
                }
		
	}
	
        wp_redirect( esc_url_raw('admin.php?page=pm_email_templates') );exit;
}

?>

<div class="pmagic"> 
  
  <!-----Operationsbar Starts----->
  <form name="email_manager" id="email_manager" action="" method="get">
    <input type="hidden" name="page" value="pm_email_templates" />
    <input type="hidden" name="pagenum" value="<?php echo $pagenum;?>" />
    <div class="operationsbar">
      <div class="pmtitle">
        <?php _e('Email Templates','profilegrid-user-profiles-groups-and-communities');?>
      </div>
      <div class="nav">
        <ul>
          <li><a href="admin.php?page=pm_add_email_template">
              <i class="fa fa-plus" aria-hidden="true"></i>
            <?php _e('New Template','profilegrid-user-profiles-groups-and-communities');?>
            </a></li>
            <li class="pm_action_button"><a>
                  <input type="submit" name="delete" value="<?php _e('Delete','profilegrid-user-profiles-groups-and-communities');?>" onclick="return check_is_tmpl_associate();" />
            </a></li>
            <div id="pm_import_user_loader" style="display:none;">
              <img src="<?php echo $path;?>images/ajax-loader.gif" />
          </div>
        </ul>
      </div>
    </div>
    <!--------Operationsbar Ends-----> 
    
    <!-------Contentarea Starts-----> 
    
    <!----Table Wrapper---->
    <?php if(isset($emails) && !empty($emails)):?>
    <div class="pmagic-table"> 
      
      <!----Sidebar---->
      
      <table class="pg-email-list">
        <tr>
          <th>&nbsp;</th>
            <th>&nbsp;</th>
          <th><?php _e('SR','profilegrid-user-profiles-groups-and-communities');?></th>
          <th><?php _e('Name','profilegrid-user-profiles-groups-and-communities');?></th>
          <th><?php _e('Subject','profilegrid-user-profiles-groups-and-communities');?></th>
          <th><?php _e('Action','profilegrid-user-profiles-groups-and-communities');?></th>
        </tr>
        <?php
	 	
			foreach($emails as $email)
			{
				?>
        <tr>
            <td><input type="checkbox" name="selected[]" class="pg-selected-email-tmpl" value="<?php echo $email->id; ?>" /></td>
          <td><i class="fa fa-envelope" aria-hidden="true"></i></td>
          <td><?php echo $i;?></td>
          <td><?php echo $email->tmpl_name;?></td>
          <td><?php echo $email->email_subject;?></td>
          <td><a href="admin.php?page=pm_add_email_template&id=<?php echo $email->id;?>">
<!--              <i class="fa fa-eye" aria-hidden="true"></i>-->
            <?php _e('Edit','profilegrid-user-profiles-groups-and-communities');?>
            </a></td>
        </tr>
        <?php $i++; }?>
      </table>
    </div>
    
    <?php echo $pagination;?>
    <?php else:?>
	<div class="pm_message"><?php _e('You haven’t created any email templates yet. Why don’t you go ahead and create one now!','profilegrid-user-profiles-groups-and-communities');?></div>
	<?php endif;?>
  </form>
</div>
