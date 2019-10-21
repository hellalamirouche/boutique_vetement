<?php
$path =  plugin_dir_url(__FILE__);
$dbhandler = new PM_DBhandler;
$pmrequest = new PM_request;
$textdomain = $this->profile_magic;
$search_page = get_edit_post_link($pmrequest->pg_get_shortcode_page_id('PM_Search'));
$user_blog_page = get_edit_post_link($pmrequest->pg_get_shortcode_page_id('PM_User_Blogs'));
$registration_url =  get_edit_post_link($dbhandler->get_global_option_value('pm_registration_page'));
$group_page =  get_edit_post_link($dbhandler->get_global_option_value('pm_group_page'));
$groups_page =  get_edit_post_link($dbhandler->get_global_option_value('pm_groups_page'));
$login_page =  get_edit_post_link($dbhandler->get_global_option_value('pm_user_login_page'));
$profile_page =  get_edit_post_link($dbhandler->get_global_option_value('pm_user_profile_page'));
$forget_password_page =  get_edit_post_link($dbhandler->get_global_option_value('pm_forget_password_page'));
$blog_page =  get_edit_post_link($dbhandler->get_global_option_value('pm_submit_blog'));
?>
    <div class="pmagic">
    <div class="pg-scblock pg-scbg">
        <div class="pg-scblock pg-scpagetitle">
            <img src="<?php echo $path;?>images/pg-icon.png">
            <b><?php _e("ProfileGrid",'profilegrid-user-profiles-groups-and-communities');?></b> <span class="pg-blue"><?php _e("Shortcodes",'profilegrid-user-profiles-groups-and-communities');?></span></div> 
  
        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Registration Form as a Single Page",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $registration_url;?>" target="_blank"><span class="pg-code">[PM_Registration ID="x"]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-1.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("Displays sign up form for a group as a single page. Sections will be separated into separate blocks. Replace <i>x</i> with the Group ID.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Registration Form as Multi-Page",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $registration_url;?>" target="_blank"><span class="pg-code">[PM_Registration type="multipage" ID="x"]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-2.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("Displays sign up form for a group as a multi-page. Sections will be separated into pages. Replace x with the Group ID.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Single Group Page",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $group_page;?>" target="_blank"><span class="pg-code">[PM_Group ID="x"]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-3.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("Displays a Group with logo and description. Groups users are displayed below the Group Card. Replace x with the Group ID.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
   
       
        
   
        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Multi Group Page",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $groups_page;?>" target="_blank"><span class="pg-code">[PM_Groups]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-4.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("Displays all the Groups with logo, description and Sign Up buttons. Visitors can choose a Group to join.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Profile Page",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $profile_page;?>" target="_blank"><span class="pg-code">[PM_Profile]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-5.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("Single profile page used for displaying logged in user's profile.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Login Form",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $login_page;?>" target="_blank"><span class="pg-code">[PM_Login]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-6.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("A login form with Username/ Email and Password fields. Also has Forgot Password link.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
   
        

        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Password Retrieval Form",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $forget_password_page;?>" target="_blank"><span class="pg-code">[PM_Forget_Password]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-7.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("A page where users can enter their email to reset their lost password.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
        
        <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("USER BLOGS PAGE",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $user_blog_page;?>" target="_blank"><span class="pg-code">[PM_User_Blogs]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-14.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e('Displays all "User Blogs" posts in chronological order. Optional parameters: Username="x,y,z" User_ID="1,2,3" Include_Blog="true"','profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
      
   
            <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("Blog Submission Page",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $blog_page;?>" target="_blank"><span class="pg-code">[PM_Add_Blog]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-10.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("Allows users to post blogs if User Blogs are turned on. Blogs will be visible on respective profile pages.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
        
          <div class="pg-scsubblock">
            <div class="pg-scblock pg-sctitle"><?php _e("All Users Page",'profilegrid-user-profiles-groups-and-communities');?></div>
            <div class="pg-scblock"><a href="<?php echo $search_page;?>" target="_blank"><span class="pg-code">[PM_Search]</span></a></div>
            <div class="pg-scblock"><img class="pg-scimg" src="<?php echo $path;?>images/sc-9.jpg"></div>
            <div class="pg-scblock pg-scdesc"><?php _e("Shows all users with profile image and username on a single page with search capabilities.",'profilegrid-user-profiles-groups-and-communities');?></div>
            </div>
   
        
        <?php do_action('profilegrid_shortcode_desc');?>
        </div>
    </div>

