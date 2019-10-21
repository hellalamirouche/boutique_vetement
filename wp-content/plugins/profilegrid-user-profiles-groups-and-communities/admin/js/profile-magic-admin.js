/* uploader js */
jQuery(document).ready(function($){
	    $('.remove_icon').click(function(e) {
		$('.icon_id').val('');
		$('#icon_html img').hide();
		$('.remove_icon').hide();
		
	});
});
  
  jQuery(document).ready(function($){
    $( ".pm_calendar" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat:'yy-mm-dd',
      yearRange: "1980:2020"
    });
  });
  
jQuery(document).ready(function(){
    jQuery('.pm_action_button input').addClass('pm_disabled');
            jQuery('.pm_action_button input').attr('disabled','disabled');
jQuery('input[name="selected[]"]').click(function() {
        var atLeastOneIsChecked = jQuery('input[name="selected[]"]:checked').length > 0;
        if (atLeastOneIsChecked == true) {
			jQuery('.pm_action_button input').removeClass('pm_disabled');
            jQuery('.pm_action_button input').removeAttr('disabled');			
        } else {
			jQuery('.pm_action_button input').addClass('pm_disabled');
            jQuery('.pm_action_button input').attr('disabled','disabled');
        }
});
});	

jQuery(document).ready(function(){
    jQuery('#import_hidden_form').hide();
    jQuery('#import_users').prop('disabled',true);
    jQuery('#pm_export_users').submit(function(event){
        var validation =false;
        if(jQuery('#pm_groups').val() === undefined || jQuery('#pm_groups').val() === null)
        {
            alert('Select at least one group.');
        }
        else if(jQuery('#pm_fields').val() === undefined || jQuery('#pm_fields').val() === null)
        {
            alert(pm_error_object.atleast_one_field);
        }
        else if(jQuery('#pm_separator').val() === undefined || jQuery('#pm_separator').val() === null || jQuery('#pm_separator').val() === '' )
        {
            alert(pm_error_object.seprator_not_empty);
        }else
        {
            validation = true;
        }
        if(!validation){
            event.preventDefault();
        return false;
        }
    });
    
});

jQuery(document).ready(function($){
    var custom_uploader;
    $('.cover_image_button').click(function(e) {
		
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: { text: 'Choose Image' },
			library : { type : 'image' },
            multiple: false
        });
        
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
			if(attachment['type']=='image')
			{
                                 $('#pm_cover_image').val(attachment.id);
                                 $('#pg_upload_cover_image_preview').attr('src',attachment.url);
                                 $('.pg_cover_image_container').show();
			}
			
			
        });
        //Open the uploader dialog

		
        custom_uploader.open();
    });
});
/*uploader js end */

jQuery(document).ready(function($){
    var custom_uploader;
    $('.group_icon_button').click(function(e) {
		
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: pm_error_object.choose_image,
            button: { text: pm_error_object.choose_image },
			library : { type : 'image' },
            multiple: false
        });
        
        custom_uploader.on('select', function() {
			$('#icon_error').html('');
			$('#icon_html img').hide();
            attachment = custom_uploader.state().get('selection').first().toJSON();
			if(attachment['type']=='image')
			{
                                 $('.icon_id').val(attachment.id);
				 $('#group_icon_img').attr('src',attachment.url);
				 $('.user-profile-picture').children('td').children('img').attr('srcset',attachment.url);
                                 $('img.user-profile-image').attr('src',attachment.url);
				 $('#group_icon_img').show();
                                 $('#pg_upload_image_preview').attr('src',attachment.url);
                                 $('.pg_profile_image_container').show();
			}
			else
			{
				$('#group_icon_img').hide();
				$('#icon_error').html(pm_error_object.valid_image);
			}
			
        });
        //Open the uploader dialog

		
        custom_uploader.open();
    });
});
/*uploader js end */

function redirectpmform(id,page) 
{
   window.location = 'admin.php?page='+page+'&gid=' + id;
}

function add_pm_field(type,id) 
{
   window.location = 'admin.php?page=pm_add_field&type='+type+'&gid=' + id;
}

function pm_show_hide(obj,primary,secondary,trinary)
{	
	a = jQuery(obj).is(':checked');
	if (a == true)
	 {
		jQuery('#'+primary).show(500);
		if(secondary!='')
		{
			jQuery('#'+secondary).hide(500);
		}
		if(trinary!='')
		{
			jQuery('#'+trinary).hide(500);
		}
		
		if(obj.id=='is_group_limit')
		{
			jQuery('#grouplimit_html .uiminput').addClass('pm_required');
			jQuery('#group_limit_message_html .uiminput').addClass('pm_textarea_required');
		}
		if(obj.id=='is_group_leader')
		{
                        jQuery('#groupleaderhtml .uiminput:first').addClass('pm_admin_label');
//			jQuery('#groupleaderhtml .uiminput:last').addClass('pm_required');
			jQuery('#groupleaderhtml .uiminput:last').addClass('pm_group_leader_name');
//                        jQuery('#groupleaderhtml .uiminput:last').addClass('pm_select_required');
                        jQuery('#groupleaderhtml .uiminput.pm_primary_admin').addClass('pm_select_required');
			/* jQuery('.pg-no-group-manager-related-field .uiminput').addClass('pm_select_required');*/
                        jQuery('.pg-no-group-manager-related-field').show();
		}
		if(obj.id=='is_paid_group')
		{
			jQuery('#paidgrouphtml .uiminput:first').addClass('pm_required');
		}
		
		if(obj.id=='display_on_profile')
		{
			jQuery('#field_visibility_option .uiminput').addClass('pm_radio_required');
		}
                
                if(obj.id=='pm_enable_recaptcha')
		{
			jQuery('#pm_recaptcha_site_key_wrapper .uiminput').addClass('pm_required');
                        jQuery('#pm_recaptcha_secret_key_wrapper .uiminput').addClass('pm_required');
		}
                
                if(obj.id=='pm_enable_facebook_connect')
		{
			jQuery('#pm_facebook_connect_html .uiminput').addClass('pm_required');
                        jQuery('#pm_facebook_connect_html .uiminput').addClass('pm_required');
		}
                
                if(obj.id=='pm_enable_google_connect')
		{
			jQuery('#pm_google_connect_html .uiminput').addClass('pm_required');
                        jQuery('#pm_google_connect_html .uiminput').addClass('pm_required');
		}
                
                if(obj.id=='pm_enable_linkedin_connect')
		{
			jQuery('#pm_linkedin_connect_html .uiminput').addClass('pm_required');
                        jQuery('#pm_linkedin_connect_html .uiminput').addClass('pm_required');
		}
                
                if(obj.id=='pm_enable_twitter_connect')
		{
			jQuery('#pm_twitter_connect_html .uiminput').addClass('pm_required');
                        jQuery('#pm_twitter_connect_html .uiminput').addClass('pm_required');
		}
                
                if(obj.id=='pm_enable_instagram_connect')
		{
			jQuery('#pm_instagram_connect_html .uiminput').addClass('pm_required');
                        jQuery('#pm_instagram_connect_html .uiminput').addClass('pm_required');
		}
                
                if(obj.id=='pm_enable_auto_logout_user')
		{
			jQuery('#enable_auto_logout_user_html .uiminput:first').addClass('pm_required');
		}
                
                if(obj.id=='pm_enable_reset_password_limit')
                {
                    jQuery('#pm_reset_password_limt_html .uiminput:first').addClass('pm_required');
                }
                
                if(obj.id=='enable_mailchimp')
                {
                    jQuery('#mailchimp_html .uiminput:first').addClass('pm_checkbox_required');
                }
                
                if(obj.id=='enable_notification')
                {
                    /* jQuery('#notification_html .uiminput').addClass('pm_select_required');*/
                }
                
                if(obj.id=='enable_group_admin_notification')
                {
                   /* jQuery('#admin_notification_html .uiminput').addClass('pm_select_required');*/
                }
                
                if(obj.id=='enable_tabs_privacy')
                {
                    jQuery('#tabs_privacy_html .uiminput').addClass('pm_radio_required');
                }
                
                if(obj.id=='enable_on_admin_reset_password')
                {
                    jQuery('#enable_on_admin_reset_password_html .uiminput').addClass('pm_select_required');
                }
                
                if(obj.id=='enable_on_admin_removal')
                {
                    jQuery('#enable_on_admin_removal_html .uiminput').addClass('pm_select_required');
                }
                
                if(obj.id=='enable_on_admin_assignment')
                {
                    jQuery('#on_admin_assignment_html .uiminput').addClass('pm_select_required');
                }
                
                if(obj.id=='pm_enable_geolocation')
                {
                    jQuery('#pm_geolocation_html #pm_map_api_key_row .uiminput').addClass('pm_required');
                }
                
                if(obj.id=='admin_only')
                {
                    jQuery('#show_signup').hide(500);
                    jQuery('#signup_html').hide(500);
                    jQuery('#privacy').hide(500);
                    jQuery('#pg_rm_field_html').hide(500);
                    jQuery('#default_registration_form_heading').hide(500);
                }
                		
	}
	else 
	{
		jQuery('#'+primary).hide(500);
		if(secondary!='')
		{
			jQuery('#'+secondary).show(500);
		}
		if(trinary!='')
		{
			jQuery('#'+trinary).show(500);
		}
                
		if(obj.id=='is_group_limit')
		{
			jQuery('#grouplimit_html .uiminput').removeClass('pm_required');
			jQuery('#group_limit_message_html .uiminput').removeClass('pm_textarea_required');
		}
		if(obj.id=='is_group_leader')
		{
                        jQuery('#groupleaderhtml .uiminput:first').removeClass('pm_admin_label');
//			jQuery('#groupleaderhtml .uiminput:last').removeClass('pm_required');
			jQuery('#groupleaderhtml .uiminput:last').removeClass('pm_group_leader_name');
                        jQuery('#groupleaderhtml .uiminput:last').removeClass('pm_select_required');
			jQuery('#groupleaderhtml .uiminput:last .user_name_error').html('');
                        jQuery('#groupleaderhtml .uiminput.pm_primary_admin').removeClass('pm_select_required');
                        jQuery('.pg-no-group-manager-related-field .uiminput').removeClass('pm_select_required');
                        jQuery('.pg-no-group-manager-related-field').hide();
		}
		if(obj.id=='is_paid_group')
		{
			jQuery('#paidgrouphtml .uiminput:first').removeClass('pm_required');
		}
		if(obj.id=='display_on_profile')
		{
			jQuery('#field_visibility_option .uiminput').removeClass('pm_radio_required');
		}
                if(obj.id=='pm_enable_recaptcha')
		{
			jQuery('#pm_recaptcha_site_key_wrapper .uiminput').removeClass('pm_required');
                        jQuery('#pm_recaptcha_secret_key_wrapper .uiminput').removeClass('pm_required');
		}
                if(obj.id=='pm_enable_facebook_connect')
		{
			jQuery('#pm_facebook_connect_html .uiminput').removeClass('pm_required');
                        jQuery('#pm_facebook_connect_html .uiminput').removeClass('pm_required');
		}
                
                if(obj.id=='pm_enable_google_connect')
		{
			jQuery('#pm_google_connect_html .uiminput').removeClass('pm_required');
                        jQuery('#pm_google_connect_html .uiminput').removeClass('pm_required');
		}
                
                if(obj.id=='pm_enable_linkedin_connect')
		{
			jQuery('#pm_linkedin_connect_html .uiminput').removeClass('pm_required');
                        jQuery('#pm_linkedin_connect_html .uiminput').removeClass('pm_required');
		}
                
                if(obj.id=='pm_enable_twitter_connect')
		{
			jQuery('#pm_twitter_connect_html .uiminput').removeClass('pm_required');
                        jQuery('#pm_twitter_connect_html .uiminput').removeClass('pm_required');
		}
                
                if(obj.id=='pm_enable_instagram_connect')
		{
			jQuery('#pm_instagram_connect_html .uiminput').removeClass('pm_required');
                        jQuery('#pm_instagram_connect_html .uiminput').removeClass('pm_required');
		}
                
                if(obj.id=='pm_enable_auto_logout_user')
		{
			jQuery('#enable_auto_logout_user_html .uiminput:first').removeClass('pm_required');
		}
                
                if(obj.id=='pm_enable_reset_password_limit')
                {
                    jQuery('#pm_reset_password_limt_html .uiminput:first').removeClass('pm_required');
                }
                if(obj.id=='enable_mailchimp')
                {
                    jQuery('#mailchimp_html .uiminput:first').removeClass('pm_checkbox_required');
                }
                
                if(obj.id=='enable_notification')
                {
                    jQuery('#notification_html .uiminput').removeClass('pm_select_required');
                }
                
                if(obj.id=='enable_group_admin_notification')
                {
                    jQuery('#admin_notification_html .uiminput').removeClass('pm_select_required');
                }
                
                if(obj.id=='enable_tabs_privacy')
                {
                    jQuery('#tabs_privacy_html .uiminput').removeClass('pm_radio_required');
                }
                
                if(obj.id=='enable_on_admin_reset_password')
                {
                    jQuery('#enable_on_admin_reset_password_html .uiminput').removeClass('pm_select_required');
                }
                
                if(obj.id=='enable_on_admin_removal')
                {
                    jQuery('#enable_on_admin_removal_html .uiminput').removeClass('pm_select_required');
                }
                
                if(obj.id=='enable_on_admin_assignment')
                {
                    jQuery('#on_admin_assignment_html .uiminput').removeClass('pm_select_required');
                }
                
                if(obj.id=='pm_enable_geolocation')
                {
                    jQuery('#pm_geolocation_html #pm_map_api_key_row .uiminput').removeClass('pm_required');
                }
                
                if(obj.id=='admin_only')
                {
                    jQuery('#show_signup').show(500);
                    jQuery('#signup_html').show(500);
                    jQuery('#privacy').show(500);
                    jQuery('#pg_rm_field_html').show(500);
                    jQuery('#default_registration_form_heading').hide(500);
                }
	}
	
}

function pm_map_field_show_hide(val,id)
{
    if(val==1)
    {
        jQuery(id).show();
    }
    else
    {
        jQuery(id).hide();
    }
}

function pm_show_hide_field_option(a,primary)
{
	/*define showing elements */
	/*jQuery('#signup_html').css('visibility','visible');
        jQuery('#signup_html').show(500);
	jQuery('#signup_html').css('height','inherit');
	jQuery('#signup_html').css('padding','inherit');
	jQuery('#signup_html').css('margin','inherit');*/
	jQuery('#show_signup').show(500);
	jQuery('#displayonprofile').show(500);
      
    
		
	jQuery('#'+primary+' .uimrow').hide();
	if(a=="")
	{
		jQuery('#'+primary).hide(500);	
	}
	else
	{
		jQuery('#'+primary).show();
		jQuery('#css_class_attribute_html').show(500);
		
	}
        
        if( a== 'user_avatar' || a=='description' || a =='user_url' || a == 'first_name' || a == 'last_name' || a == 'user_name' || a == 'user_pass' || a == 'confirm_pass' || a == 'user_email')
        {
            jQuery('#adminonly').hide();
        }
       
	
	if (a == 'user_name' || a == 'user_pass' || a == 'confirm_pass' || a == 'user_email') 
	{
		jQuery('#signup_html').hide(500);
                jQuery('#pg_rm_field_html').hide(500);
		jQuery('#signup_html').css('visibility','hidden');
		jQuery('#signup_html').css('height','0px');
		jQuery('#signup_html').css('padding','0px');
		jQuery('#signup_html').css('margin','0px');
		
	}
	
	
	
	if (a == 'text' || a == 'first_name' || a == 'last_name' || a == 'repeatable_text' || a == 'number' || a=='mobile_number' || a == 'phone_number')
	{
		jQuery('#place_holder_text_html').show(500);
		jQuery('#maximum_length_html').show(500);
	}
	
	if(a == 'email')
	{
		jQuery('#place_holder_text_html').show(500);
	}
	if (a == 'select'|| a=='multi_dropdown') 
	{
		jQuery('#default_value_html').show(500);
		jQuery('#field_options_html').show(500);
		jQuery('#first_option_html').show(500);
                jQuery('#field_options_html .uiminput').addClass('pm_textarea_option_required');
		
		
	}
        else
        {
            jQuery('#field_options_html .uiminput').removeClass('pm_textarea_option_required');
        }
        
	if (a == 'radio' || a == 'checkbox') 
	{
		jQuery('#default_value_html').show(500);
		jQuery('#field_options_radio_html').show(500);
		jQuery('#pm_radio_field_other_option_html .pm_add_other_button').show(500);
                jQuery('#field_options_radio_html .uiminput').addClass('pm_radio_option_required');
	}
        else
        {
            jQuery('#field_options_radio_html .uiminput').removeClass('pm_radio_option_required');
        }
        
	
	if (a == 'radio') 
	{
		jQuery('#pm_radio_field_other_option_html .pm_add_other_button').hide(500);
	}
	
	if (a == 'textarea' || a == 'description') 
	{
		jQuery('#place_holder_text_html').show(500);
		jQuery('#maximum_length_html').show(500);
		jQuery('#columns_html').show(500);
		jQuery('#rows_html').show(500);
	}
	if (a == 'file') 
	{
		jQuery('#allowed_file_types_html').show(500);	
	}
	if (a == 'term_checkbox') 
	{
		jQuery('#term_and_condition_html').show(500);	
	}
	
	if (a == 'heading') 
	{
		jQuery('#heading_text_html').show(500);
		jQuery('#heading_tag_html').show(500);
	}
	if (a == 'paragraph') 
	{
		jQuery('#paragraph_text_html').show(500);
	}
	
	if(a == 'heading' || a == 'paragraph' || a == 'user_pass' || a == 'confirm_pass' || a == 'user_email' || a == 'divider'||a == 'spacing' )
	{
		jQuery('#show_signup').hide();
		jQuery('#signup_html').hide();
		jQuery('#displayonprofile').hide();
		jQuery('#displayprofilehtml').hide();
	}
        
        if(a== 'user_email')
        {
            jQuery('#displayonprofile').show();
        }
	
	if(a == 'user_pass' || a == 'confirm_pass' )
	{
		jQuery('#show_signup').show();
	}
	
	if(a=='user_avatar' || a == 'user_name')
	{
		jQuery('#displayonprofile').hide();
		jQuery('#displayprofilehtml').hide();
	}
	
	if (a == 'pricing') 
	{
		jQuery('#price_html').show(500);
	}
        
        if(a=='file'||a=='user_avatar'||a=='heading'||a=='paragraph'||a=='confirm_pass'||a=='user_pass'||a=='user_url'||a=='user_name'||a == 'divider'||a == 'spacing')
	{
            jQuery('#displayonsearch').hide();
        }else{
            jQuery('#displayonsearch').show();
        }
        
        if(a=='birth_date'){
                jQuery('#dateofbirth').show();
                 if(jQuery('#set_dob_range').attr("checked")){
           jQuery('#dateofbirth_range').show(500);
       }else{
           jQuery('#dateofbirth_range').hide(500);
       }
        }else{
           jQuery('#dateofbirth').hide();
           jQuery('#dateofbirth_range').hide(500); 
        }
        
      if(a=='address'){
          
          jQuery('#address_pane').show();
          jQuery('#address_pane .uiminput').addClass('pm_checkbox_required');
      }else{
          jQuery('#address_pane .uiminput').removeClass('pm_checkbox_required');
          jQuery('#address_pane').hide();
      }
	
        if(a=='facebook'||a=='twitter'||a=='google'||a=='linked_in'||a=='youtube'||a=='instagram'){
            jQuery('#place_holder_text_html').show(500);
        }
		
}

function pm_insert_field_in_email(a)
{
	tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, a);
}

function insert_form_shortcode(a)
{
	tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, a);
	tb_remove(); return false;	
}

function add_section_validation()
{
    
	jQuery('.errortext').html('');
	jQuery('.errortext').hide();
	jQuery('.all_error_text').html('');
	jQuery('input').removeClass('warning');
	
	jQuery('.pm_required').each(function (index, element) { //Validation for number type custom field
		var value = jQuery(this).children('input').val();
		var value2 = jQuery.trim(value);
		if (value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').show();
		}
		
	});
	var b = '';
		b = jQuery('.errortext').each(function () {
			var a = jQuery(this).html();
			b = a + b;
			jQuery('.all_error_text').html(b);
		});
		var error = jQuery('.all_error_text').html();
		if (error == '') {
			return true;
		} else {
			return false;
		}
                
}

function add_group_validation()
{
	jQuery('.errortext').html('');
	jQuery('.errortext').hide();
	jQuery('.all_error_text').html('');
	jQuery('input').removeClass('warning');
	jQuery('select').removeClass('warning');
	jQuery('number').removeClass('warning');
	
	jQuery('.pm_admin_label').each(function (index, element) { //Validation for number type custom field
		var value = jQuery(this).children('input').val();
                var regex = /^[a-zA-Z0-9 ]+$/;
		var value2 = jQuery.trim(value);
                
		if (value2!='' && !value2.match(regex)) {
			jQuery(this).children('.errortext').html(pm_error_object.valid_group_name);
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').show();
		}
		
	});
	
        jQuery('.pm_required').each(function (index, element) { //Validation for number type custom field
		var value = jQuery(this).children('input').val();
		var value2 = jQuery.trim(value);
		if (value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').show();
		}
		
	});
                
	jQuery('.pm_textarea_required').each(function (index, element) { //Validation for number type custom field
		var value = tinyMCE.get('group_limit_message').getContent();
		var value2 = jQuery.trim(value);
		if (value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
		else
		{
			jQuery(this).children('.errortext').html('');
			jQuery(this).children('.errortext').hide();
		}
		
	});
	
	jQuery('.pm_select_required').each(function (index, element) { //Validation for number type custom field
		var value = jQuery(this).children('select').val();
		var value2 = jQuery.trim(value);
		if (value == "" || value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
			jQuery(this).children('select').addClass('warning');
		}
	});
	
	jQuery('.pm_checkbox_required').each(function (index, element) { //Validation for number type custom field
	var checkboxlenght = jQuery(this).children('ul').children('li').children('input[type="checkbox"]:checked');
	
	var atLeastOneIsChecked = checkboxlenght.length > 0;
	if (atLeastOneIsChecked == true) {
	}else{
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	
	});
        
        jQuery('.pm_group_admin_required').each(function (index, element) { //Validation for number type custom field
	var checkboxlenght = jQuery(this).children('input[type="checkbox"]:checked');
	
	var atLeastOneIsChecked = checkboxlenght.length > 0;
        
	if (atLeastOneIsChecked == true) {
	}else{
			jQuery(this).children('.errortext').html(pm_error_object.group_manager_first);
			jQuery(this).children('.errortext').show();
		}
	
	});
        
	jQuery('.pm_radio_required').each(function (index, element) { //Validation for number type custom field
	var radiolenght = jQuery(this).children('ul').children('li').children('input[type="radio"]:checked');
	var atLeastOneIsChecked = radiolenght.length > 0;
	if (atLeastOneIsChecked == true) {
		
	}
	else
	{
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
	}
	
	});
        
	var b = '';
		b = jQuery('.errortext').each(function () {
			var a = jQuery(this).html();
			b = a + b;
			c = jQuery('.user_name_error').html();
			b = b + c;
			jQuery('.all_error_text').html(b);
		});
		var error = jQuery('.all_error_text').html();
		if (error == '') {
			return true;
		} else {
                        
                    
                    jQuery('.errortext').each(function () {
			var a = jQuery(this).html();
                        if(a!='')
                        {
                            var elOffset = jQuery(this).parents('.uimrow').offset().top;
                             
                            jQuery('html,body').animate({
                               scrollTop:  elOffset - 50
                           }, 'slow');
                            return false;
                        }
                        
                        });
                        
                        
			return false;
		}
}


function add_field_validation()
{
	jQuery('.errortext').html('');
	jQuery('.errortext').hide();
	jQuery('.all_error_text').html('');
	jQuery('input').removeClass('warning');
	jQuery('select').removeClass('warning');
	jQuery('number').removeClass('warning');
	
	jQuery('.pm_required').each(function (index, element) { //Validation for number type custom field
		var value = jQuery(this).children('input').val();
		var value2 = jQuery.trim(value);
		if (value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').show();
		}
		
	});
	
	jQuery('.pm_textarea_required').each(function (index, element) { //Validation for number type custom field
		var value = tinyMCE.get('group_limit_message').getContent();
		var value2 = jQuery.trim(value);
		if (value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
		else
		{
			jQuery(this).children('.errortext').html('');
			jQuery(this).children('.errortext').hide();
		}
		
	});
	
        jQuery('.pm_textarea_option_required').each(function (index, element) { //Validation for number type custom field
		var value = jQuery(this).children('textarea').val();
               
		var value2 = jQuery.trim(value);
		if (value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
		else
		{
			jQuery(this).children('.errortext').html('');
			jQuery(this).children('.errortext').hide();
		}
		
	});
        
	jQuery('.pm_select_required').each(function (index, element) { //Validation for number type custom field
		var value = jQuery(this).children('select').val();
		var value2 = jQuery.trim(value);
		if (value == "" || value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
			jQuery(this).children('select').addClass('warning');
		}
	});
	
	jQuery('.pm_checkbox_required').each(function (index, element) { //Validation for number type custom field
	var checkboxlenght = jQuery(this).children('ul').children('li').children('input[type="checkbox"]:checked');
	
	var atLeastOneIsChecked = checkboxlenght.length > 0;
	if (atLeastOneIsChecked == true) {
	}else{
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	
	});
	
	jQuery('.pm_radio_required').each(function (index, element) { //Validation for number type custom field
	var radiolenght = jQuery(this).children('ul').children('li').children('input[type="radio"]:checked');
	var atLeastOneIsChecked = radiolenght.length > 0;
	if (atLeastOneIsChecked == true) {
		
	}
	else
	{
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
	}
	
	});
        
        jQuery('.pm_radio_option_required').each(function (index, element) { //Validation for number type custom field
	var value = jQuery(this).children('ul').children('li').children('input[type="text"]').val();
	var value2 = jQuery.trim(value);
		if (value == "" || value2== "") {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
			jQuery(this).children('select').addClass('warning');
		}
	
	});
        
        
	
	var b = '';
		b = jQuery('.errortext').each(function () {
			var a = jQuery(this).html();
			b = a + b;
			jQuery('.all_error_text').html(b);
		});
		var error = jQuery('.all_error_text').html();
		if (error == '') {
			return true;
		} else {
			return false;
		}
}

function add_pm_admin_email_option()
{
	var b = '<li class="pm_radio_option_field"><span class="pm_handle"></span><input type="text" name="pm_admin_email[]" value=""><span class="pm_remove_field" onClick="remove_pm_radio_option(this)">' + pm_error_object.delete + '</span></li>';
jQuery('#field_options_radio_html ul#radio_option_ul_li_field').append(b);
jQuery('#radio_option_ul_li_field .pm_radio_option_field:last input').focus();
	
}

function add_pm_radio_option() {
var b = '<li class="pm_radio_option_field"><span class="pm_handle"></span><input type="text" name="field_options[radio_option_value][]" value=""><span class="pm_remove_field" onClick="remove_pm_radio_option(this)">' + pm_error_object.delete + '</span></li>';
jQuery('#field_options_radio_html ul#radio_option_ul_li_field').append(b);
jQuery('#radio_option_ul_li_field .pm_radio_option_field:last input').focus();
}

function remove_pm_radio_option(a)
{
	jQuery(a).parent('li.pm_radio_option_field').remove();
}

function add_pm_other_option()
{
var a = '<li class="pm_radio_option_field"><input type="text" value="Their answer" disabled><span class="removefield pm_remove_field" onClick="remove_pm_other_option(this)">' + pm_error_object.delete + '</span><input type="hidden" name="field_options[radio_option_value][]" value="chl_other" /></li>';
jQuery('#pm_radio_field_other_option_html').append(a);
jQuery('.pm_add_other_button').hide();	
}

function remove_pm_other_option(a)
{
	jQuery(a).parent('li').remove();	
	jQuery('.pm_add_other_button').show();
}
function show_hide_search_text()
{
	jQuery('#search_keyword').remove();
	jQuery('#search').val('');	
}

function check_validation()
{
	var group_name = jQuery('#group_name').val();
	if(jQuery.trim(group_name)=='')
	{
		jQuery('#group_error').show();
		return false;		
	}
	else
	{
		jQuery('#group_error').hide();
		return true;	
	}
}

function check_group_leader_name(str)
{
	/*jQuery('.pm_group_leader_name').each(function (index, element) {
		var field = this;
		var username = jQuery(this).children('input').val();
		var data = {
						'action': 'pm_check_user_exist',
						'type': 'validateUserName',
						'userdata' : username
					};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
		jQuery.post(pm_ajax_object.ajax_url, data, function(response) {                    
			if(response=='false')
			{
				jQuery(field).children('input').addClass('warning');
				jQuery(field).children('.user_name_error').html('Sorry, username does not exist.');
				jQuery(field).children('.user_name_error').show();
			}
			else
			{
				jQuery(field).children('.user_name_error').html('');
                                jQuery(field).children('input').removeClass('warning');
			}
		});		
	});*/
    jQuery('.pm_group_leader_name').each(function (index, element) {
		var field = this;
		var username = jQuery(this).children('input').val();
                var x = new Array();
                x = str.split(",");
                var response = jQuery.inArray(username, x) > -1 
                console.log(response);
                if(response==false)
                {
                        jQuery(field).children('input').addClass('warning');
                        jQuery(field).children('.user_name_error').html(pm_error_object.no_user_search);
                        jQuery(field).children('.user_name_error').show();
                }
                else
                {
                        jQuery(field).children('.user_name_error').html('');
                        jQuery(field).children('input').removeClass('warning');
                }
            });
   
    
    
    
}


function pm_ajax_sections_dropdown(gid)
{
	var data = {
					'action': 'pm_section_dropdown',
					'gid': gid
				};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
		if(response)
		{
			jQuery('#associate_section').html(response);
		}
		
	});		
		
}

jQuery(function () {
jQuery('.pm_sortable_tabs').sortable({
		axis: 'y',
		opacity: 0.7,
		handle: '.pm-slab-drag-handle',
		update: function (event, ui) {
			var list_sortable = jQuery(this).sortable('toArray').toString();
			var data = {
				'action': 'pm_set_section_order',
				'list_order': list_sortable
			};
			jQuery.post(pm_ajax_object.ajax_url, data, function(response) {});		
			// change order in the database using Ajax
		}
	});
});

jQuery(function () {
	jQuery('.pm_sortable_fields').sortable({
		axis: 'y',
		opacity: 0.7,
		handle: '.pm-slab-drag-handle',
		update: function (event, ui) {
				var list_sortable = jQuery(this).sortable('toArray').toString();
				var data = {
				'action': 'pm_set_field_order',
				'list_order': list_sortable
			};
			jQuery.post(pm_ajax_object.ajax_url, data, function(response) {});
		}
	});
});


jQuery(document).ready(function(){
    jQuery("#pm-field-selection-popup").click(function(){
        jQuery(".pm-popup").css("visibility", "visible");
        jQuery(".pm-curtains").css("visibility", "visible");
    });
});

jQuery(document).ready(function(){
    jQuery(".pm-popup-close").click(function(){
        jQuery(".pm-popup").css("visibility", "hidden");
        jQuery(".pm-curtains").css("visibility", "hidden");
    });
});

jQuery(function($) {
   $( "#tabs" ).tabs();  
});

jQuery(function($) {
   $( "#sections" ).tabs(); 
 });
	
function pm_open_tab(a)
{
	jQuery('.ui-tabs-panel').hide();
	jQuery('#'+a).show();
}

function pm_add_repeat(obj)
{
	a= jQuery(obj).parent('a').parent('div.pm_repeat').clone();
	jQuery(a).children('input').val('');
	jQuery(obj).parent('a').parent('div.pm_repeat').parent('div.pm-field-input').append(a);
}

function pm_remove_repeat(obj)
{
	jQuery(obj).parent('a').parent('div.pm_repeat').remove();
}

function pm_test_smtp_connection() {
	 	jQuery('#smtptestconn a').hide();
		jQuery('#smtptestconn img').show();
		jQuery('#smtptestconn .result').html('');
        pm_smtp_test_email_address = jQuery("#pm_smtp_test_email_address").val();
		pm_smtp_host = jQuery("#pm_smtp_host").val();
		pm_smtp_encription = jQuery("#pm_smtp_encription").val();
		pm_smtp_port = jQuery("#pm_smtp_port").val();
		pm_smtp_authentication = jQuery("#pm_smtp_authentication").val();
		pm_smtp_username = jQuery("#pm_smtp_username").val();
		pm_smtp_from_email_name = jQuery("#pm_smtp_from_email_name").val();
		pm_smtp_from_email_address = jQuery("#pm_smtp_from_email_address").val();
		pm_smtp_password = jQuery("#pm_smtp_password").val();
		//alert(pm_smtp_authentication);
                var data = {
				'action': 'pm_test_smtp',
                                'pm_smtp_test_email_address': pm_smtp_test_email_address,
				'pm_smtp_host': pm_smtp_host,
				'pm_smtp_encription': pm_smtp_encription,
				'pm_smtp_port': pm_smtp_port,
				'pm_smtp_authentication': pm_smtp_authentication,
				'pm_smtp_username': pm_smtp_username,
				'pm_smtp_from_email_name': pm_smtp_from_email_name,
				'pm_smtp_from_email_address': pm_smtp_from_email_address,
				'pm_smtp_password': pm_smtp_password
				};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
                //make ajax call to check_username.php
				//alert(response);
				jQuery('#smtptestconn a').show()
				jQuery('#smtptestconn img').hide();
                if (jQuery.trim(response) == "1") {
                   jQuery('#smtptestconn span.result').html('<span class="smtp_success">' + pm_error_object.success + '</span>');
                } else {
                    jQuery('#smtptestconn span.result').html('<span class="smtp_failed">' + pm_error_object.failure + '</span>');
                }
                //dump the data received from PHP page
            });
    }
    
function pm_change_group_notice(a,id)
{
    if(confirm(pm_error_object.change_group))
    {
        
    }
    else
    {
        jQuery(a).val(id);
    }
}

function pg_confirm(message)
{
    if(confirm(message))
    {
        return true;
    }
    else
    {
        return false;
    }

}

function pm_ajax_export_fields_dropdown()
{
    //var values = jQuery("#pm_groups:selected").val();
     var values = [];
     
        jQuery.each(jQuery("#pm_groups option:selected"), function(){            
            values.push(jQuery(this).val());
        });
     if(values.length !== 0)
     {
        var data = {
				'action': 'pm_load_export_fields_dropdown',
				'groups': values
				};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
                jQuery('#pm-fields-container').html(response);
            });
        }
        else{
                jQuery('#pm-fields-container').empty();
        }
}



function pm_upload_csv()
{   jQuery('#import_hidden_form').show(200);
    jQuery("#pm_import_users").ajaxForm({
        target: '#pm_import_hidden_field',
        success:    function() {
                
                }
        }).submit();
}

function pm_upload_jsonfile()
{   
    jQuery("#pm_import_options").ajaxForm({
        target: '#pm_import_result',
        success:    function() {
                
                }
        }).submit();
    return false;    
}

jQuery(document).ready(function(){
    jQuery( "#import_pm_group").change(function(){
    data = {
	            targetUrl: pm_ajax_object.ajax_url,
                    action: 'pm_upload_csv',
	            pm_import_step: '2',
                    pm_separator:jQuery('#pm_separator').val(),
                    import_pm_group:jQuery('#import_pm_group').val(),
                    attachment_id:jQuery('#attachment_id').val()
	        };
                
                jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
                    if(response)
                    {
                        jQuery('#pm_import_step').val('3');
                        jQuery('#preview-csv-file').html(response);
                        jQuery('#import_users').prop('disabled',false);
                    }	
                });	
    });
    
});

jQuery(document).ready(function(){
    jQuery( "#import_users").click(function(){
        
    sep = jQuery('#pm_separator').val();
    group = jQuery('#import_pm_group').val();
    if(sep=='' || group=='')
    {
        if(sep=='')
        {
           alert(pm_error_object.seprator_not_empty);
        }
        else if(group=='')
        {
           alert(pm_error_object.select_group); 
        }
    }
    else
    {
     jQuery("#import_users").hide();
     jQuery("#pm_import_user_loader").show();
    jQuery("#pm_import_users").ajaxForm({
        target: '#pm_import_preview',
        success:    function() {
                jQuery("#pm_import_user_loader").hide();
                }
        }).submit();
    
     }
    });
    
});

jQuery(document).ready(function(){
jQuery( "#your-profile" ).submit(function(){
    var email_val = "";
	var formid = 'your-profile';
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	jQuery('.errortext').html('');
	jQuery('.errortext').hide();
	jQuery('.all_errors').html('');
	jQuery('.warning').removeClass('warning');

jQuery('#'+formid+' .pm_email').each(function (index, element) {
		var email = jQuery(this).children('input').val();
		var isemail = regex.test(email);
		if (isemail == false && email != "") {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_email);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_number').each(function (index, element) {
		var number = jQuery(this).children('input').val();
		var isnumber = jQuery.isNumeric(number);
		if (isnumber == false && number != "") {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_number);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_datepicker').each(function (index, element) {
		var date = jQuery(this).children('input').val();
		var pattern = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;
    	if (date != "" && !pattern.test(date)) {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_date);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_required').each(function (index, element) {
		var value = jQuery(this).children('input').val();
		var value = jQuery.trim(value);
		if (value == "") {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_select_required').each(function (index, element) {
		var value = jQuery(this).children('select').val();
		var value = jQuery.trim(value);
		if (value == "") {
			jQuery(this).children('select').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_textarearequired').each(function (index, element) {
		var value = jQuery(this).children('textarea').val();
		var value = jQuery.trim(value);
		if (value == "") {
			jQuery(this).children('textarea').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_checkboxrequired').each(function (index, element) {
		var checkboxlenght = jQuery(this).children('.pmradio').children('.pm-radio-option').children('input[type="checkbox"]:checked');
		var atLeastOneIsChecked = checkboxlenght.length > 0;
		if (atLeastOneIsChecked == true) {
		}else{
			//jQuery(this).children('textarea').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_radiorequired').each(function (index, element) {
		var checkboxlenght = jQuery(this).children('.pmradio').children('.pm-radio-option').children('input[type="radio"]:checked');
		var atLeastOneIsChecked = checkboxlenght.length > 0;
		if (atLeastOneIsChecked == true) {
		}else{
			//jQuery(this).children('textarea').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_fileinput .pm_repeat').each(function (index, element) {
		var val = jQuery(this).children('input').val().toLowerCase();
		var allowextensions = jQuery(this).children('input').attr('data-filter-placeholder');
		if(allowextensions=='')
		{
			allowextensions = pm_error_object.allow_file_ext;
		}
		
		allowextensions = allowextensions.toLowerCase();
		var regex = new RegExp("(.*?)\.(" + allowextensions + ")$");
		if(!(regex.test(val)) && val!="") {
		
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.file_type);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_repeat_required .pm_repeat').each(function (index, element) {
		var value = jQuery(this).children('input').val();
		var value = jQuery.trim(value);
		if (value == "") {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_user_pass').each(function (index, element) {
		var password = jQuery(this).children('input').val();
		var passwordlength = password.length;
		if(password !="")
		{
			if(passwordlength < 7)
			{
				jQuery(this).children('input').addClass('warning');
				jQuery(this).children('.errortext').html(pm_error_object.short_password);
				jQuery(this).children('.errortext').show();
			}
		}
	});
	
	jQuery('#'+formid+' .pm_confirm_pass').each(function (index, element) {
		var confirm_pass = jQuery(this).children('input').val();
		var password = password = jQuery('#'+formid+' .pm_user_pass').children('input').val();
		if(password != confirm_pass)
		{
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.pass_not_match);
			jQuery(this).children('.errortext').show();
		}
	});
	
	jQuery('#'+formid+' .pm_recaptcha').each(function (index, element) {
		var response = grecaptcha.getResponse();
				//recaptcha failed validation
		if (response.length == 0) {
			jQuery(this).children('.errortext').html(pm_error_object.required_field);
			jQuery(this).children('.errortext').show();
		}
	});
        
        jQuery('#'+formid+' .pm_facebook_url').each(function (index, element) {
		var number = jQuery(this).children('input').val();
                if (!validate_facebook_url(number)) {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_facebook_url);
			jQuery(this).children('.errortext').show();
		}
	});
        
        jQuery('#'+formid+' .pm_twitter_url').each(function (index, element) {
		var number = jQuery(this).children('input').val();
                if (!validate_twitter_url(number)) {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_twitter_url);
			jQuery(this).children('.errortext').show();
		}
	});

            
        jQuery('#'+formid+' .pm_google_url').each(function (index, element) {
		var number = jQuery(this).children('input').val();
                if (!validate_google_url(number)) {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_google_url);
			jQuery(this).children('.errortext').show();
		}
	});
        
                
        jQuery('#'+formid+' .pm_linked_in_url').each(function (index, element) {
		var number = jQuery(this).children('input').val();
                if (!validate_linked_in_url(number)) {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_linked_in_url);
			jQuery(this).children('.errortext').show();
		}
	});
        
                
        jQuery('#'+formid+' .pm_youtube_url').each(function (index, element) {
		var number = jQuery(this).children('input').val();
                if (!validate_youtube_url(number)) {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_youtube_url);
			jQuery(this).children('.errortext').show();
		}
	});
        
                
        jQuery('#'+formid+' .pm_instagram_url').each(function (index, element) {
		var number = jQuery(this).children('input').val();
                if (!validate_instagram_url(number)) {
			jQuery(this).children('input').addClass('warning');
			jQuery(this).children('.errortext').html(pm_error_object.valid_instagram_url);
			jQuery(this).children('.errortext').show();
		}
	});
	
	var b = '';
	 jQuery('#'+formid+' .errortext').each(function () {
		var a = jQuery(this).html();
		b = a + b;
	});
	
	if (jQuery('#'+formid+' .usernameerror').length > 0) 
		{
			c = jQuery('.usernameerror').html();
			b = c + b;
		}
		
		if (jQuery('#'+formid+' .useremailerror').length > 0) 
		{
			d = jQuery('.useremailerror').html();
			b = d + b;
		}
	jQuery('#'+formid+' .all_errors').html(b);
	var error = jQuery('#'+formid+' .all_errors').html();
	if (error == '') {
		return true;
	} else {
		return false;
	}
});
});

function validate_facebook_url(val)
{
    if (val != "") {
        if (/(?:https?:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*?(\/)?([\w\-\.]*)/i.test(val))
        {
            return true;
        } else
        {
            return false;
        }
    } else {
        return true;
    }

}

function validate_twitter_url(val)
{
    if (val != '') {
        if (/(ftp|http|https):\/\/?((www|\w\w)\.)?twitter.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/i.test(val)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

function validate_google_url(val)
{
    if (val != '') {
        if (/((http:\/\/(plus\.google\.com\/.*|www\.google\.com\/profiles\/.*|google\.com\/profiles\/.*))|(https:\/\/(plus\.google\.com\/.*)))/i.test(val)) {
            return true;
        } else {
            return false;
        }

    } else {
        return true;
    }
}

function validate_linked_in_url(val)
{
    if (val != '') {
        if (/(ftp|http|https):\/\/?((www|\w\w)\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/i.test(val)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

function validate_youtube_url(val)
{
    if (val != '') {
        if (/(ftp|http|https):\/\/?((www|\w\w)\.)?youtube.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/i.test(val)) {
            return true;
        } else {
            return false;
        }

    } else {
        return true;
    }
}

function validate_instagram_url(val)
{
    if (val != '') {
        var regex = /(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/([A-Za-z0-9-_]+)/;
        if (val.match(regex)) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

 jQuery(document).ready(function(){
    jQuery('#the-list').find( '[data-slug="profilegrid-user-profiles-groups-and-communities"] span.deactivate a' ).click(function(event){
        
       jQuery("#pg-deactivate-feedback-dialog-wrapper, .pg-modal-overlay ").show();
       pgDeactivateLocation = jQuery(this).attr('href');
        event.preventDefault();
    });
    
    jQuery ("#pg-deactivate-feedback-dialog-wrapper .pg-modal-close, .pg-modal-overlay, #pg-feedback-cancel-btn").click( function(){
        
              jQuery("#pg-deactivate-feedback-dialog-wrapper, .pg-modal-overlay").hide();
        
    });
    jQuery("input[name='pg_feedback_key']").change(function(){
                  
                       var pg_selectedVal= jQuery(this).val();
                       var pg_reasonElement= jQuery("#pg_reason_" + pg_selectedVal);
                       jQuery(".pg-deactivate-feedback-dialog-input-wrapper .pginput").hide();
                       if(pg_reasonElement!==undefined)
                       {
                         pg_reasonElement.show();  
                       }
                });
    
    jQuery("#pg-feedback-btn").click(function(){
                    var selectedVal= jQuery("input[name='pg_feedback_key']:checked").val();
                    if(selectedVal===undefined){
                        location.href= pgDeactivateLocation;
                        return;
                    }
                        
                    var pg_feedbackInput= jQuery("input[name='pg_reason_"+ selectedVal + "']");
                     var data = {
                        'action': 'pg_post_feedback',
                        'feedback': jQuery("input[name='pg_feedback_key']:checked").val(),
                        'msg': pg_feedbackInput.val()
                        
                    };
                    jQuery(".pg-ajax-loader").show();
                    jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
                         jQuery(".pg-ajax-loader").hide();
                         location.href= pgDeactivateLocation;  
                    });
                });
});



jQuery(document).ready(function($) {
    var a = jQuery('.pmagic .pg-scblock .pg-scsubblock');
for( var i = 0; i < a.length; i+=3 ) {
    a.slice(i, i+3).wrapAll('<div class="pg-scblock"></div>');
}
});

jQuery(document).ready(function(){
    jQuery(".pg-dismissible").click(function()
    {
        
        var notice_name = jQuery(this).attr('id');
        var data = {'action': 'pm_dismissible_notice','notice_name': notice_name};
	jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
            
        });
                    
    })

});

jQuery(document).ready(function(){
    jQuery(".pgrm-dismissible").click(function()
    {
        
        var notice_name = jQuery(this).attr('id');
        var rm_form_id = jQuery(this).attr('data-rmid');
        var data = {'action': 'pm_dismissible_notice','notice_name': notice_name,'rm_form_id':rm_form_id};
	jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
            
        });
                    
    })

});

function check_is_tmpl_associate()
{
    event.preventDefault();
    jQuery("#pm_import_user_loader").show();
    var searchIDs = [];
    jQuery(".pg-selected-email-tmpl:checkbox:checked").map(function(){
      searchIDs.push(jQuery(this).val());
    });
    var data = {'action': 'pm_check_associate_tmpl','searchIDs': searchIDs};
    jQuery.post(pm_ajax_object.ajax_url, data, function(response) 
    {
        if(response!='')
        {
            alert(response);
            jQuery("#pm_import_user_loader").hide();
        }
        else
        {
            jQuery('#email_manager').submit();
            //jQuery("#pm_import_user_loader").hide();
        }
    });
    
}

function pg_remove_profile_image()
{
  
    $('.icon_id').val('');
    $('#group_icon_img').attr('src','');
    $('.user-profile-picture').children('td').children('img').attr('srcset','');
    $('#group_icon_img').show();
    $('#pg_upload_image_preview').attr('src','');
    $('.pg_profile_image_container').hide();
   
}

function pm_remove_cover_image()
{
    jQuery('.cover_icon_id').val('');
    jQuery('.pg_upload_cover_image_preview').attr('src','');
    jQuery('.pg_cover_image_container').hide();
}    


jQuery(document).ready(function($){
    var custom_uploader;
    $('.pm_choose_image_btn').click(function(e) {
		var parent_div = $(this).parent('.uiminput');
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: pm_error_object.choose_image,
            button: { text: pm_error_object.choose_image },
			library : { type : 'image' },
            multiple: false
        });
        
        custom_uploader.on('select', function() {
			$(parent_div).children('.errortext').html('');
			$(parent_div).children('.pm_preview_img').hide();
            attachment = custom_uploader.state().get('selection').first().toJSON();
            var file_size =  parseInt(attachment.filesizeInBytes);
            var file_width = parseInt(attachment.sizes.full.width);
            var file_height = parseInt(attachment.sizes.full.height);
            var max_file_size = parseInt(pm_upload_object.pg_profile_image_max_file_size);
            var minimum_width = pm_upload_object.pg_profile_photo_minimum_width;
            if(minimum_width=='DEFAULT'){ minimum_width = 150}else {minimum_width = parseInt(minimum_width);}
            
			if(attachment['type']=='image')
			{
                            if(file_size>max_file_size)
                            {
                                $(parent_div).children('span').children('.pm_preview_img').hide();
				$(parent_div).children('.errortext').html(pm_upload_object.error_max_profile_filesize);
                            }
                            else if(file_width<minimum_width)
                            {
                                $(parent_div).children('span').children('.pm_preview_img').hide();
				$(parent_div).children('.errortext').html(pm_upload_object.error_min_profile_width);
                            }
                            else
                            {
           		         $(parent_div).children('.icon_id').val(attachment.id);
				 $(parent_div).children('span').children('.pm_preview_img').attr('src',attachment.url);
				 $(parent_div).children('.pm_preview_img').show();
                                 $(parent_div).children('span').show();
                                 
                             }
			}
			else
			{
				$(parent_div).children('span').children('.pm_preview_img').hide();
				$(parent_div).children('.errortext').html(pm_error_object.valid_image);
			}
			
        });
        //Open the uploader dialog

		
        custom_uploader.open();
    });
});

jQuery(document).ready(function($){
    var custom_uploader;
    $('#field_cover_icon_button').click(function(e) {
		var parent_div = $(this).parent('.uiminput');
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: pm_error_object.choose_image,
            button: { text: pm_error_object.choose_image },
			library : { type : 'image' },
            multiple: false
        });
        
        custom_uploader.on('select', function() {
			$(parent_div).children('.errortext').html('');
			$(parent_div).children('.pm_preview_img').hide();
            attachment = custom_uploader.state().get('selection').first().toJSON();
            var file_size =  parseInt(attachment.filesizeInBytes);
            var file_width = parseInt(attachment.sizes.full.width);
            var file_height = parseInt(attachment.sizes.full.height);
            var max_file_size = parseInt(pm_upload_object.pg_profile_image_max_file_size);
            var minimum_width = pm_upload_object.pg_cover_photo_minimum_width;
            if(minimum_width=='DEFAULT'){ minimum_width = 800}else {minimum_width = parseInt(minimum_width);}
            
			if(attachment['type']=='image')
			{
                            if(file_width<minimum_width || file_height<300)
                            {
                                $(parent_div).children('span').children('.pm_preview_img').hide();
				$(parent_div).children('.errortext').html(pm_upload_object.error_min_cover_width);
                            }
                            else
                            {
           		         $(parent_div).children('.cover_icon_id').val(attachment.id);
				 $(parent_div).children('span').children('.pm_preview_img').attr('src',attachment.url);
				 $(parent_div).children('.pm_preview_img').show();
                                 $(parent_div).children('span').show();
                                 
                             }
			}
			else
			{
				$(parent_div).children('span').children('.pm_preview_img').hide();
				$(parent_div).children('.errortext').html(pm_error_object.valid_image);
			}
			
        });
        //Open the uploader dialog

		
        custom_uploader.open();
    });
});
/*uploader js end */

function pm_make_require_group_field(id,value)
{
    if(value=='yes')
    {
        jQuery('#'+id).children('.uiminput').addClass('pm_group_admin_required');
    }
    else
    {
        jQuery('#'+id).children('.uiminput').removeClass('pm_group_admin_required');
    }
}

function pm_show_hide_group_type_options(str)
{
   if(str=='hide')
   {
       jQuery('.pg-close-group-related-field .uiminput').removeClass('pm_select_required');
       jQuery('.pg-close-group-related-field').hide();
   }
   else
   {
       /*jQuery('.pg-close-group-related-field .uiminput').addClass('pm_select_required');*/
       jQuery('.pg-close-group-related-field').show();
   }
}

function pgrm_change_helptext(id)
{
   var data = {action: 'pm_get_rm_helptext',id:id};
    jQuery.post(pm_ajax_object.ajax_url, data, function(response) 
    {
        jQuery('#pgrm_help_text').html(response);
    });
}
 
function pg_create_group_page(gid)
{
    var data = {action: 'pg_create_group_page',gid:gid};
    jQuery.post(pm_ajax_object.ajax_url, data, function(response) {
        if(response)
        {
            location.reload();
        }
    });
}
