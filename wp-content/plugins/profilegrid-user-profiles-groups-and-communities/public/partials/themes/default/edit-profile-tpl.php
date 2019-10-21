<?php 
wp_enqueue_style( 'wp-jquery-ui-dialog' );
$edit_uid = filter_input(INPUT_GET, 'user_id');
$group_id = filter_input(INPUT_GET, 'gid');
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$pm_customfields = new PM_Custom_Fields;
$edit_uid = $pmrequests->pm_get_uid_from_profile_slug($edit_uid);
if(is_array($gid)){$gid_array = $gid;} else{$gid_array = array($gid);}
$exclude = "associate_group in(".implode(',',$gid_array).") and field_type not in('user_name','user_email','user_avatar','user_pass','confirm_pass','paragraph','heading')";
$is_field =  $dbhandler->get_all_result('FIELDS', $column = '*',1,'results',0,false, $sort_by = 'ordering',false,$exclude);
$rd = filter_input(INPUT_GET, 'rd');
?>
<div class="pmagic"> 
  <!-----Operationsbar Starts----->
  <div class="pm-group-view pm-dbfl pm-bg-lt">
    <?php if(isset($is_field) && !empty($is_field)):?>  
      
    <form class="pmagic-form pm-dbfl" method="post" action="" id="pm_edit_form" name="pm_edit_form"  enctype="multipart/form-data">
        <input type="hidden" name="gid" id="gid" value="<?php echo esc_attr($group_id); ?>" />
        <input type="hidden" name="euid" id="euid" value="<?php echo esc_attr($edit_uid); ?>" />
        <?php if(isset($rd) && $rd!=''):?>
        <input type="hidden" name="pg_rd" id="pg_rd" value="1" />
        <?php endif;?>
        <div class="pm-edit-heading">
        <h1>
          <?php _e('Edit Profile','profilegrid-user-profiles-groups-and-communities');?>
        </h1>
          <div class="pg-edit-action-wrap pm-dbfl">
        <span class="pm-edit-action pm-difl">
            <span class="pm-edit-action-save"><input type="submit" name="edit_profile" value="<?php _e('Save','profilegrid-user-profiles-groups-and-communities');?>" onclick="return profile_magic_frontend_validation(this.form);"/></span>
            <span class="pm-edit-action-cancel"> <input type="submit" name="canel_edit_profile" value="<?php _e('Cancel','profilegrid-user-profiles-groups-and-communities');?>" /></span>
        </span>
        <span class="pm-edit-link pm-difr">
            <a href="#" onclick="pm_expand_all_conent()" class="pm-difl"><?php _e('Expand','profilegrid-user-profiles-groups-and-communities');?></a>
            <a href="#" onclick="pm_collapse_all_conent()" class="pm-difl"><?php _e('Collapse','profilegrid-user-profiles-groups-and-communities');?></a>
        </span>
          </div>
      </div>
      <div id="pm-accordion" class="pm-dbfl">
        <?php 
        $exclude = 'and '.$exclude;
foreach($sections as $section):
    
    $fields =  $dbhandler->get_all_result('FIELDS', $column = '*',array('associate_section'=>$section->id),'results',0,false, $sort_by = 'ordering',false,$exclude);

echo '<div class="pm-accordian-title pm-dbfl pm-border pm-bg pm-pad10">'.$section->section_name.'</div>';
	?>
        <div id="<?php echo sanitize_key($section->section_name);?>" class="pm-accordian-content pm-dbfl pm-pad10">
          <?php 
		 	 if(isset($fields) && !empty($fields))
			 {
				 foreach($fields as $field)
				 {
					echo '<div class="pmrow">';
					$value = $pmrequests->profile_magic_get_user_field_value($edit_uid,$field->field_key);
					$pm_customfields->pm_get_custom_form_fields($field,$value,$this->profile_magic);
					echo '</div>';	 
				 }
				 echo '<div class="all_errors" style="display:none;"></div>';
				 
			 }

	?>
        </div>
        <?php	
endforeach;
?>
      </div>
    </form>
      
      <?php else:?>
      <div class="pg-edit-profile-notice"><?php _e('There are no profile fields to edit. Profile fields are added by admin to individual User Groups.','profilegrid-user-profiles-groups-and-communities');?> <a href="<?php echo $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page',site_url('/wp-login.php'));?>"><?php _e('Back to Profile','profilegrid-user-profiles-groups-and-communities');?></a></div>
      <?php endif;?>
      
  </div>
</div>
<div id="pg-remove-attachment-dialog" title="<?php _e('Confirm!','profilegrid-user-profiles-groups-and-communities');?>" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><?php _e('Are you sure you want delete the attachment?','profilegrid-user-profiles-groups-and-communities');?></p>
</div>
