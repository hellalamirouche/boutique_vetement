<?php
$pmrequests = new PM_request;
$options = maybe_unserialize($row->group_options);
$row = $dbhandler->get_row('GROUPS',$gid);
$leaders = array();
if($row->is_group_leader!=0)
{
    $leaders = $pmrequests->pg_get_group_leaders($gid);
}
if($leaders =='')
{
    $leaders = array();
}
if(!empty($options) && isset($options['is_hide_group_card']) && $options['is_hide_group_card']==1)
{
    $show_group_card =0;
}else 
{ $show_group_card =1;}
?>
<div class="pmagic">
    <?php if($show_group_card==1):?>
       <div class="pm-group-card-box pm-dbfl pm-border-bt">
         <div class="pm-group-card pm-dbfl pm-border pm-bg pm-radius5">
            <div class="pm-group-title pm-dbfl pm-bg-lt pm-pad10 pm-border-bt">
            <i class="fa fa-users" aria-hidden="true"></i>
			<?php echo $row->group_name;?>
            <?php 
			
			if(is_user_logged_in() && in_array($current_user->ID,$leaders)):
			$edit_group = $pmrequests->profile_magic_get_frontend_url('pm_group_page','',$gid);
			$edit_group = add_query_arg( 'gid',$gid,$edit_group );
			$edit_group = add_query_arg( 'edit','1',$edit_group );
			?>
           <div class="pm-edit-group"><a href="<?php echo esc_url( $edit_group ); ?>" class="pm_button"><?php _e('Edit','profilegrid-user-profiles-groups-and-communities');?></a></div>
            <?php endif;?>
            </div>
             <div class="pm-group-image pm-difl pm-border">
                  <?php echo $pmrequests->profile_magic_get_group_icon($row); ?>
                   
                  <?php $pmrequests->profile_magic_get_join_group_button($gid);?>
                 
             </div>
             <div class="pm-group-description pm-difl pm-bg pm-pad10 pm-border">
         
         		<?php 
                            if(!class_exists('Profilegrid_Group_Multi_Admins')):                         
                                if(isset($leaders) && !empty($leaders) && $pagenum==1):
                                $profile_url = $pmrequests->profile_magic_get_frontend_url('pm_user_profile_page','');
                                $profile_url = add_query_arg( 'uid',$leaders['primary'],$profile_url );
                                ?>
                                <div class="pm-card-row pm-dbfl">
                                    <div class="pm-card-label pm-difl"><?php echo $pmrequests->pm_get_group_admin_label($gid); ?></div>
                                    <div class="pm-card-value pm-difl pm-group-leader-small pm-difl">
                                         <a href="<?php echo $profile_url ;?>"><?php echo $pmrequests->pm_get_display_name($leaders['primary']);?></a>
                                <?php echo get_avatar($leaders['primary'],16,'',false,array('class'=>'pm-infl','force_display'=>true));?>

                                        </div>
                                 </div>
        		<?php   endif;
                            else:
                                do_action('pm_show_multi_admins',$gid);
                            endif;
                        
                        ?>
         
         
                 
                 
                 <div class="pm-card-row pm-dbfl">
                    <div class="pm-card-label pm-difl"><?php _e('Members','profilegrid-user-profiles-groups-and-communities');?></div>
                    <div class="pm-card-value pm-difl"><?php echo $total_users?></div>
                 </div>
                 
                 <?php if(!empty($row->group_desc)):?>
                  <div class="pm-card-row pm-dbfl">
                    <div class="pm-card-label pm-difl"><?php _e('Details','profilegrid-user-profiles-groups-and-communities');?></div>
                    <div class="pm-card-value pm-difl"><?php echo $row->group_desc;?></div>
                 </div>
                 <?php endif;?>
                 <?php do_action('profile_magic_show_group_fields_option',$options);?>
             </div>
           </div>
           
           

        </div>
    
     <?php else:?>
    
    <div class="pm-difl pm-pad10"><?php $pmrequests->profile_magic_get_join_group_button($gid);?></div>
   <?php endif;?>
   <?php $requested = $pmrequests->profile_magic_check_is_requested_to_join_group($gid,$current_user->ID);
   if($requested!=null)
    {
       $requested_options = maybe_unserialize($requested[0]->options);
       echo '<div class="pm-dbfl pm-pad10"><div class="pg-alert-warning pg-alert-info">';
       _e(sprintf('You sent membership request to join this Group on %s',$requested_options['request_date']),'profilegrid-user-profiles-groups-and-communities'); ?>
    <?php if(!empty($leaders)):
        if(isset($leaders['primary'])){$group_admin_id = $leaders['primary'];}else{$group_admin_id = $leaders[0];}
        ?>
    <br />
       <a onclick="pg_edit_blog_popup('member','message','<?php echo $group_admin_id;?>','<?php echo $gid;?>')"><?php echo sprintf(__("Send a message to %s","profilegrid-user-profiles-groups-and-communities"),$pmrequests->pm_get_group_admin_label($gid));?></a>
           <?php
           endif;
       echo '</div></div>';
    }
    ?>
    <div id="pg_group_tabs" class="pm-section-nav-horizental pm-dbfl">
        <ul class="pm-difl pm-profile-tab-wrap pm-border-bt">	
       
            <li class="pm-profile-tab pm-pad10"><a class="pm-dbfl" href="#pg_members"><?php _e('Members','profilegrid-user-profiles-groups-and-communities');?></a></li>
             <?php do_action( 'profile_magic_group_photos_tab',$current_user->ID,$gid);?>
            
        </ul>
        
        <div id="pg_members" class="pm-dbfl pg-profile-tab-content">
<?php
        $pmhtmlcreator = new PM_HTML_Creator($this->profile_magic,$this->version);
        if(!empty($users))
        {
            foreach($users as $user) 
            {

                     $pmhtmlcreator->get_group_page_fields_html($user->ID,$gid,$leaders,150,array('class'=>'user-profile-image'));
            }
        }
        else
        {
            echo '<div class="pg-alert-warning pg-alert-info">';
            _e('No User Profile is registered in this Group','profilegrid-user-profiles-groups-and-communities');
            echo '</div>';
        }
	
	echo '<div class="pm_clear"></div>'.$pagination;
	

?>
          </div>
        
        <?php do_action( 'profile_magic_group_photos_tab_content',$current_user->ID,$gid);?>
        
        
      </div>
            
   
    </div>
<div class="pm-popup-mask"></div>    

<div id="pm-edit-group-popup" style="display: none;">
    <div class="pm-popup-container" id="pg_edit_group_html_container">
     
        
    </div>
</div>
