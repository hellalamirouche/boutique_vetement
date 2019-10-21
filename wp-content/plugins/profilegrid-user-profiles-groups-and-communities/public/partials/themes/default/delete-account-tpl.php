<div class="pmagic">   
<!-----Form Starts----->
<form class="pmagic-form pm-dbfl" method="post" action="" id="pm_delete_account" name="pm_delete_account" onsubmit="return pm_delete_account_setting(this);">
     <div class="pmrow pg-alert-info pg-alert-danger">       
        <?php echo $dbhandler->get_global_option_value('pm_account_deletion_alert_text',__('Are you sure you want to delete your account? This will erase all of your account data from the site. To delete your account enter your password below','profilegrid-user-profiles-groups-and-communities'));?>
    </div>
     <div class="pmrow">        
        <div class="pm-col">
            <div class="pm-form-field-icon"></div>
            <div class="pm-field-lable">
                <label for="password"><?php _e('Password','profilegrid-user-profiles-groups-and-communities');?></label>
            </div>
            <div class="pm-field-input pm_required">
                <input type="password" class="" value="" id="password" name="password" >
                <div class="errortext"><?php if(isset($delete_error))echo $delete_error;?></div>
            </div>
        </div>
    </div>  
    <div class="buttonarea pm-full-width-container">
        <div class="all_errors" style="display:none;"></div>
      <input type="submit" value="<?php _e('Submit','profilegrid-user-profiles-groups-and-communities');?>" name="pm_delete_account">
    </div>
  </form>
</div>