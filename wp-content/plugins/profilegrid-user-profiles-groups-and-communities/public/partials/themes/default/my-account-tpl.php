
<div class="pmagic">   
<!-----Form Starts----->
<form class="pmagic-form pm-dbfl" method="post" action="" id="pm_my_account" name="pm_my_account" onsubmit="return pm_save_account_setting(this);">
     <div class="pmrow">        
        <div class="pm-col">
            <div class="pm-form-field-icon"></div>
            <div class="pm-field-lable">
                <label for="user_name"><?php _e('Username','profilegrid-user-profiles-groups-and-communities');?><sup class="pm_estric">*</sup></label>
            </div>
            <div class="pm-field-input pm_required">
                <input disabled="disabled" autocomplete="off" type="text" class="" value="<?php echo $pmrequests->profile_magic_get_user_field_value($uid,'user_login');?>" id="user_name" name="user_name" >
            </div>
        </div>
    </div>
     <div class="pmrow">        
        <div class="pm-col">
            <div class="pm-form-field-icon"></div>
            <div class="pm-field-lable">
                <label for="first_name"><?php _e('First Name','profilegrid-user-profiles-groups-and-communities');?></label>
            </div>
            <div class="pm-field-input">
                <input type="text" class="" value="<?php echo $pmrequests->profile_magic_get_user_field_value($uid,'first_name');?>" id="first_name" name="first_name" >
            </div>
        </div>
    </div>  
      
    <div class="pmrow">        
        <div class="pm-col">
            <div class="pm-form-field-icon"></div>
            <div class="pm-field-lable">
                <label for="last_name"><?php _e('Last Name','profilegrid-user-profiles-groups-and-communities');?></label>
            </div>
            <div class="pm-field-input">
                <input type="text" class="" value="<?php echo $pmrequests->profile_magic_get_user_field_value($uid,'last_name');?>" id="last_name" name="last_name" >
            </div>
        </div>
    </div>  
      
    <div class="pmrow">        
        <div class="pm-col">
            <div class="pm-form-field-icon"></div>
            <div class="pm-field-lable">
                <label for="user_email"><?php _e('Email','profilegrid-user-profiles-groups-and-communities');?><sup class="pm_estric">*</sup></label>
            </div>
            <div class="pm-field-input pm_email pm_user_email pm_required">
                <input title="" type="email" class="" value="<?php echo $pmrequests->profile_magic_get_user_field_value($uid,'user_email');?>" id="user_email" name="user_email" <?php if($dbhandler->get_global_option_value('pm_allow_user_to_change_email',0)==0){echo "disabled='disabled' autocomplete='off'";}?>>
                <div class="errortext" style="display:none;"></div>
                <?php 
                
                if(isset($error)){
                    $account_error = $error;
                    if($error=='email_exists'){
                    $account_error = __("This email is already registered. Please try with different email.",'profilegrid-user-profiles-groups-and-communities');
                    }
                    if($error == 'no_changes')
                    {
                     $account_error = __("No changes were made to the account details to be saved.",'profilegrid-user-profiles-groups-and-communities');
                    }
                    if($error =='invalid_password')
                    {
                        $account_error  = '';
                    }
                    
                    ?>
                <div class="useremailerror" style="color:red;"><?php echo $account_error;?></div>
                <?php } ?>
                
            </div>
        </div>
    </div>
      
    <div class="buttonarea pm-full-width-container">
        <div class="all_errors" style="display:none;"></div>
      <input type="submit" value="<?php _e('Submit','profilegrid-user-profiles-groups-and-communities');?>" name="my_account_submit">
    </div>
  </form>
</div>
