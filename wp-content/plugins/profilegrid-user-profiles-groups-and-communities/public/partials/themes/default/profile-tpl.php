<?php $pmhtmlcreator = new PM_HTML_Creator($this->profile_magic,$this->version);
$pmrequests = new PM_request;
$pagenum = filter_input(INPUT_GET, 'pagenum');
$rid = filter_input(INPUT_GET,'rid');
$pagenum = isset($pagenum) ? absint($pagenum) : 1;
$group_page_link = $pmrequests->profile_magic_get_frontend_url('pm_group_page','');

if(!empty($gid))
{
    $primary_gid = $pmrequests->pg_get_primary_group_id($gid);
    $group_page_link = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$primary_gid);
    $group_page_link = add_query_arg( 'gid',$primary_gid,$group_page_link );
    $groupinfo = $dbhandler->get_row('GROUPS',$primary_gid);
    $group_leader = maybe_unserialize($groupinfo->group_leaders);
}
else
{
    $gid='';
    $primary_gid = '';
}

?>
<div class="pmagic"> 
  <!-----Operationsbar Starts----->
  <div class="pm-group-view pm-dbfl">
    <div class="pm-header-section pm-dbfl pm-bg pm-border pm-radius5"> 
      <!-- cover page -->
      <div class="pm-cover-image pm-dbfl" <?php if($uid != $current_user->ID) echo 'id="pm-show-cover-image"';?> > 
          <?php 
          echo $pmrequests->profile_magic_get_cover_image($user_info->ID,'pm-cover-image');
          //echo wp_get_attachment_image($pmrequests->profile_magic_get_user_field_value($user_info->ID,''),'full',false,array('class'=>'pm-cover-image'));?>
        <?php if($uid == $current_user->ID):?>
        <div class="pm-bg-dk pg-profile-change-img dbfl" id="pm-coverimage-mask">
              <div id="pm-change-cover-image" class="pg-item-image-change">
                  <i class="fa fa-camera-retro" aria-hidden="true"></i>
                  <?php _e('Update Cover Image','profilegrid-user-profiles-groups-and-communities');?>
              </div>
          </div>
        <?php endif;?>
      </div>
      <!-- header section -->
      <div class="pm-profile-title-header pm-dbfl">
        <div  <?php if($uid != $current_user->ID) echo 'id="pm-show-profile-image"';?> class="pm-profile-image pm-difl pm-pad10"> <?php echo get_avatar($user_info->user_email,150,'',false,array('class'=>'pm-user','force_display'=>true));?>
          <?php if($uid == $current_user->ID):?>
         <div class="pm-bg-dk pg-profile-change-img">
            <div id="pm-change-image" class="pg-item-image-change">
                <i class="fa fa-camera-retro" aria-hidden="true"></i>
                <?php _e('Update Image','profilegrid-user-profiles-groups-and-communities');?></div>
          </div>
          <?php endif;?>
        </div>
        <div class="pm-profile-title pm-difl pm-pad10">
          <div class="pm-user-name pm-dbfl pm-clip"><?php echo $pmrequests->pm_get_display_name($uid);?></div>
           <?php if(!empty($gid)):?>
          <div class="pm-user-group-name pm-dbfl pm-clip">
              <a href='<?php echo esc_url($group_page_link ); ?>'>
                  <i class="fa fa-users" aria-hidden="true"></i>
                  <?php echo $groupinfo->group_name;?>
              </a>
               <?php $total_assign_group = count(array_unique($gid));if(!empty($gid) && is_array($gid) && $total_assign_group >1):?>
              <?php if($total_assign_group>2){ $group_count_String = __('more groups','profilegrid-user-profiles-groups-and-communities');}else{$group_count_String = __('more group','profilegrid-user-profiles-groups-and-communities');} ?>
              <div class="pg-more-groups"><a onclick="pg_open_group_tab()">+<?php echo count(array_unique($gid))-1 .' '.$group_count_String; ?> </a></div>
               <?php endif;?>
               <a></a> 
               
          </div>
          <?php endif;?>
           <?php do_action('profile_magic_show_additional_header_info',$uid);?>
        </div>
        <?php do_action('profile_magic_show_additional_header_info2',$uid);?>
          <div class="pm-group-icon pm-difr pm-pad10">
              
        <?php if(!empty($gid)):?>
            <div id="pg-group-badge">
                <div id="pg-group-badge-dock">
                 <?php $pmrequests->pg_get_user_groups_badge_slider($uid);?>
                </div>
            </div> 
        <?php endif;?>    
              

          </div>
      </div>
    </div>
    <div class="pm-profile-tabs pm-dbfl" id="pg-profile-tabs">
     <div class="pm-section-nav-horizental pm-dbfl">
      
      
        <ul class="mymenu pm-difl pm-profile-tab-wrap pm-border-bt" >	
            
            <li class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg-about"><?php _e('About','profilegrid-user-profiles-groups-and-communities');?></a></li>
            <li id="pg-profile-groups-tab" class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg-groups"><?php _e('Groups','profilegrid-user-profiles-groups-and-communities');?></a></li>
            <?php if($dbhandler->get_global_option_value('pm_enable_blog','1')==1):?>
            <li class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg-blog"><?php _e('Blog','profilegrid-user-profiles-groups-and-communities');?></a></li>
            <?php endif;?>
             <audio id="msg_tone" src="<?php echo $path ?>/images/sounds/msg_tone.mp3"></audio>
        
                <?php if($uid == $current_user->ID && $dbhandler->get_global_option_value('pm_enable_private_messaging','1')==1):?>
            <li class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg-messages" onClick="refresh_messenger();"><?php _e('Messages','profilegrid-user-profiles-groups-and-communities');?><b id="unread_thread_count" class=""></b></a></li>
            
               <?php endif;
            
               if($uid == $current_user->ID)
            {
                $pm_notification = new Profile_Magic_Notification();
                $unread_notification = $pm_notification->pm_get_user_unread_notification_count($current_user->ID);
                if($unread_notification==0){
                $unread_notification='';
                $unread_notification_class='';
                }else{
                    $unread_notification_class = "thread-count-show";
                }
            
            
            ?>            
            <li id="notification_tab" onclick="read_notification();" class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg-notifications" onclick="read_notification();"><?php _e('Notifications','profilegrid-user-profiles-groups-and-communities');?><b id="unread_notification_count" class="<?php echo $unread_notification_class; ?>"><?php echo $unread_notification;?></b></a></li>
            <?php
            } ?>
                
         
            <?php do_action( 'profile_magic_profile_tab',$uid,$primary_gid);?>
         </ul>
                    
       
             
     
      </div>
        
        <div id="pg-about" class="pm-difl pg-profile-tab-content">
        
            <div class="pm-section pm-dbfl" id="sections">
      <?php if($uid == $current_user->ID):
                $filter_uid = $pmrequests->pm_get_profile_slug_by_id($uid);
		$redirect_url = $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page',site_url('/wp-login.php'));
		$redirect_url = add_query_arg( 'user_id',$filter_uid,$redirect_url );
	?>
      <div class="pm-dbfl">    
      <div class="pm-edit-user pm-difl pm-pad10"> <a href="<?php echo esc_url( $redirect_url ); ?>" class="pm-dbfl">
          <i class="fa fa-pencil" aria-hidden="true"></i>
          <?php _e('Edit Profile','profilegrid-user-profiles-groups-and-communities');?></a> </div>
      </div>
      <?php endif; ?>
        <?php if(!empty($sections) && count($sections)>1):?>
                <svg onclick="show_pg_section_left_panel()" class="pg-left-panel-icon" fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.41 16.09l-4.58-4.59 4.58-4.59L14 5.5l-6 6 6 6z"/>
    <path d="M0-.5h24v24H0z" fill="none"/>
</svg>
      <div class="pm-section-left-panel pm-section-nav-vertical pm-difl pm-border pm-radius5 pm-bg">
          
        <ul class="dbfl">
          <?php 
		  do_action( 'profile_magic_before_profile_section_tab',$uid,$primary_gid);
//		foreach($sections as $section):
//			echo '<li class="pm-dbfl pm-border-bt pm-pad10"><a class="pm-dbfl" href="#'.sanitize_key($section->section_name).$section->id.'">'.$section->section_name.'</a></li>';
//		endforeach;
                  
                $pmhtmlcreator->pg_get_profile_sections_tab_header($uid); 
		do_action( 'profile_magic_after_profile_section_tab',$uid,$primary_gid);
		
		?>
        </ul>
      </div>
        <?php endif;?>
      <?php 
	  do_action( 'profile_magic_before_profile_section_content',$uid,$primary_gid);
          if(!empty($sections)):
         if(count($sections)>1){echo '<div class="pm-section-right-panel">';}
	foreach($sections as $section):?>
      <div id="<?php echo sanitize_key($section->section_name).$section->id;?>" class="pm-section-content pm-difl <?php if(count($sections)==1)echo 'pm_full_width_profile'; ?>">
        <?php 
		$fields = $pmrequests->pm_get_frontend_user_meta($uid,$gid,$group_leader,'',$section->id,'"user_avatar","user_pass","user_name","heading","paragraph","confirm_pass"');
		$pmhtmlcreator->get_user_meta_fields_html($fields,$uid);
		?>
      </div>
      <?php endforeach; 
      if(count($sections)>1){echo '</div>';}
      endif;
	  do_action( 'profile_magic_after_profile_section_content',$uid,$primary_gid);
	  ?>
    </div>
            
        </div>
        
        <?php if($dbhandler->get_global_option_value('pm_enable_blog','1')==1):?>
        <?php $pm_submit_blog_page = esc_url_raw($pmrequests->profile_magic_get_frontend_url('pm_submit_blog',''));
        if($pm_submit_blog_page!='')
        {
            $string = 'href="'.$pm_submit_blog_page.'"';
        }
        else
        {
            $string = 'id="pm_submit_blog_page"';
        }
        ?>
        <div id="pg-blog" class="pm-difl pg-profile-tab-content">
            <?php  if($uid == $current_user->ID ):?>
            <div class="pg-blog-head pm-dbfl">
            <div class="pg-new-blog-button pm-border">
                <a <?php echo $string;?>><?php _e('New Blog Post','profilegrid-user-profiles-groups-and-communities');?></a>
            </div>
            </div>
            <?php endif;?>
            <div id="pg-blog-container" class="pm-dbfl">
            <?php
            $pmhtmlcreator->pm_get_user_blog_posts($uid);
            ?>
            </div>
        </div>
        <?php endif;?>
   
       <?php if($uid == $current_user->ID && $dbhandler->get_global_option_value('pm_enable_private_messaging','1')==1): ?>
        <div id="pg-messages" class="pm-dbfl pg-profile-tab-content">
        <?php
        if(!isset($rid)) 
            $rid='';
            $pmhtmlcreator->pm_get_user_messenger($rid);  
        ?>
            </div>
        <?php endif;?>
         <?php if($uid == $current_user->ID):?>
        <div id="pg-notifications" class="pm-difl pg-profile-tab-content">
        <?php $pmhtmlcreator->pm_get_notification_html($uid); ?>
         </div>
        <?php endif;?>
        <?php do_action( 'profile_magic_profile_tab_content',$uid,$primary_gid);?>

    </div>
      
      
  </div>
  
  <?php if($uid == $current_user->ID):?>
  <div class="pm-popup-mask"></div>
    <div id="pm-change-image-dialog">
    <div class="pm-popup-container pm-update-image-container pm-radius5">
      <div class="pm-popup-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
          <i class="fa fa-camera-retro" aria-hidden="true"></i>
        <?php _e('Change Profile Image','profilegrid-user-profiles-groups-and-communities');?>
          <div class="pm-popup-close pm-difr">
              <img src="<?php echo $path;?>images/popup-close.png" height="24px" width="24px">
          </div>
      </div>
      <div class="pm-popup-image pm-dbfl pm-bg pm-pad10"> 
          <?php echo get_avatar($user_info->user_email,150,'',false,array('class'=>'pm-user','id'=>'avatar-edit-img','force_display'=>true));?>
        <div class="pm-popup-action">
          <a type="button" class="btn btn-primary" id="change-pic"><?php _e('Change Image','profilegrid-user-profiles-groups-and-communities');?></a>
	  <div id="changePic" class="" style="display:none">
            <form id="cropimage" method="post" enctype="multipart/form-data" action="<?php echo admin_url( 'admin-ajax.php' );?>">
                <div class="pm-dbfl">
	           <label><?php _e('Upload your image','profilegrid-user-profiles-groups-and-communities');?></label>
                <input type="file" name="photoimg" id="photoimg" />
                    </div>
            <input type="hidden" name="action" value="pm_upload_image" id="action" />
            <input type="hidden" name="status" value="" id="status" />
            <input type="hidden" name="filepath" id="filepath" value="<?php echo $path;?>" />
            <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($user_info->ID); ?>" />
            <input type="hidden" name="user_meta" id="user_meta" value="<?php echo esc_attr('pm_user_avatar'); ?>" />
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <div id="preview-avatar-profile"></div>
	    <div id="thumbs" style="padding:5px; width:600px"></div>	
            </form>
            <div class="modal-footer">
                <button type="button" id="btn-cancel" class="btn btn-default"><?php _e('Cancel','profilegrid-user-profiles-groups-and-communities');?></button>
                <button type="button" id="btn-crop" class="btn btn-primary"><?php _e('Crop & Save','profilegrid-user-profiles-groups-and-communities');?></button>
            </div>
          </div>
          <form method="post" action="" enctype="multipart/form-data" onsubmit="return pg_prevent_double_click(this);">
            <input type="hidden" name="user_id" value="<?php echo esc_attr($user_info->ID); ?>" />
            <input type="hidden" name="user_meta" value="<?php echo esc_attr('pm_user_avatar'); ?>" />
            <input type="submit" value="<?php _e('Remove','profilegrid-user-profiles-groups-and-communities');?>" name="remove_image" id="pg_remove_profile_image_btn" />
          </form>
        </div>
        <p class="pm-popup-info pm-dbfl pm-pad10">
          <?php _e('For best visibility choose square image with minimum size of 200 x 200 pixels','profilegrid-user-profiles-groups-and-communities');?>
        </p>
      </div>
    </div>
  </div>
<div class="pm-popup-mask"></div>
  <div id="pm-change-cover-image-dialog">
    <div class="pm-popup-container pm-update-image-container pm-radius5">
      <div class="pm-popup-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
        <?php _e('Change Cover Image','profilegrid-user-profiles-groups-and-communities');?>
          <div class="pm-popup-close pm-difr">
              <img src="<?php echo $path;?>images/popup-close.png" height="24px" width="24px">
          </div>
      </div>
      <div class="pm-popup-image pm-dbfl pm-pad10 pm-bg"> 
          <?php echo wp_get_attachment_image($pmrequests->profile_magic_get_user_field_value($user_info->ID,'pm_cover_image'),array(85,85),true,array('class'=>'pm-cover-image','id'=>'cover-edit-img'));?>
        <div class="pm-popup-action pm-dbfl pm-pad10">
          <a type="button" class="btn btn-primary" id="change-cover-pic"><?php _e('Change Cover Image','profilegrid-user-profiles-groups-and-communities');?></a>
	  <div id="changeCoverPic" class="" style="display:none">
            <form id="cropcoverimage" method="post" enctype="multipart/form-data" action="<?php echo admin_url( 'admin-ajax.php' );?>">
	    <label><?php _e('Upload Your Cover Image','profilegrid-user-profiles-groups-and-communities');?></label>
            <input type="file" name="coverimg" id="coverimg"  />
            <input type="hidden" name="action" value="pm_upload_cover_image" id="action" />
            <input type="hidden" name="cover_status" value="" id="cover_status" />
            <input type="hidden" name="cover_filepath" id="cover_filepath" value="<?php echo $path;?>" />
            <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($user_info->ID); ?>" />
            <input type="hidden" id="cx" name="cx" />
            <input type="hidden" id="cy" name="cy" />
            <input type="hidden" id="cw" name="cw" />
            <input type="hidden" id="ch" name="ch" />
            <input type="hidden" id="cover_minwidth" name="cover_minwidth" value="" />
           
            <div id="preview-cover-image"></div>
	    <div id="thumbs" style="padding:5px; width:600px"></div>	
            </form>
            <div class="modal-footer">
                <button type="button" id="btn-cover-cancel" class="btn btn-default"><?php _e('Cancel','profilegrid-user-profiles-groups-and-communities');?></button>
                <button type="button" id="btn-cover-crop" class="btn btn-primary"><?php _e('Crop & Save','profilegrid-user-profiles-groups-and-communities');?></button>
            </div>
          </div>
            
            
          <form method="post" action="" enctype="multipart/form-data" onsubmit="return pg_prevent_double_click(this);">     
            <input type="hidden" name="user_id" value="<?php echo esc_attr($user_info->ID); ?>" />
            <input type="hidden" name="user_meta" value="<?php echo esc_attr('pm_cover_image'); ?>" />
            <input type="submit" value="<?php _e('Remove','profilegrid-user-profiles-groups-and-communities');?>" name="remove_image" id="pg_remove_cover_image_btn" />
          </form>
        </div>
        <p class="pm-popup-info pm-dbfl pm-pad10">
          <?php _e('For best visibility choose a landscape aspect ratio image with size of <span id="pm-cover-image-width">1200</span> x 300 pixels','profilegrid-user-profiles-groups-and-communities');?>
        </p>
      </div>
    </div>
  </div>

<div class="pm-popup-mask"></div>    

<div id="pm-edit-group-popup" style="display: none;">
    <div class="pm-popup-container" id="pg_edit_group_html_container">
     
        
    </div>
</div>
    <?php if($dbhandler->get_global_option_value('pm_enable_blog','1')==1):?>

      
               <div class="pg-blog-dialog-mask" style="<?php if(isset($_POST['pg_blog_submit']))echo 'display:block';?>"></div>
          <div id="pm-add-blog-dialog" style="<?php if(isset($_POST['pg_blog_submit']))echo 'display:block';?>">
            <div class="pm-popup-container pm-radius5">
              <div class="pm-popup-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
                  <i class="fa fa-key" aria-hidden="true"></i>
                <?php _e('Submit New Blog Post','profilegrid-user-profiles-groups-and-communities');?>
                  <?php if(!isset($_POST['pg_blog_submit'])):?>
                  <div class="pm-popup-close pm-difr"><img src="<?php echo $path;?>images/popup-close.png" height="24px" width="24px"></div>
                  <?php endif;?>
              </div>
              <div class="pm-popup-image">
                <div class="pm-popup-action pm-dbfl pm-pad10 pm-bg">
                  <?php echo do_shortcode('[PM_Add_Blog]');?>
                </div>
              </div>
            </div>
          </div>
    <?php endif;?>
  <?php else: ?>
<div class="pm-popup-mask"></div>    

    <div id="pm-show-profile-image-dialog">
        <div class="pm-popup-container">

            <div class="pm-popup-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
                <div class="pm-popup-close pm-difr">
                    <img src="<?php echo $path; ?>images/popup-close.png" height="24px" width="24px">
                </div>
            </div> 

            <div class="pm-popup-image pm-dbfl pm-pad10 pm-bg">    
                <?php echo get_avatar($user_info->user_email, 512,'',false,array('force_display'=>true)); ?>
            </div>

        </div>
    </div>

<div class="pm-popup-mask"></div>    
    <div id="pm-show-cover-image-dialog">
        <div class="pm-popup-container">
            <div class="pm-popup-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
                <div class="pm-popup-close pm-difr">
                    <img src="<?php echo $path; ?>images/popup-close.png" height="24px" width="24px">
                </div>
            </div>

            <div class="pm-popup-image pm-dbfl pm-pad10 pm-bg">    
                <?php echo $pmrequests->profile_magic_get_cover_image($user_info->ID, 'pm-cover-image'); ?>
            </div>
        </div>
    </div>



<?php endif;?>
</div>
<div class="pm-popup-mask"></div>    

<div id="pm-edit-group-popup" style="display: none;">
    <div class="pm-popup-container" id="pg_edit_group_html_container">
     
        
    </div>
</div>

