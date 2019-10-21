<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class-profile-magic-request
 *
 * @author ProfileGrid
 */
class Profile_Magic_access_options {
//put your code here

	
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $profile_magic    The ID of this plugin.
	 */
	private $profile_magic;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $profile_magic       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $profile_magic, $version ) {

		$this->profile_magic = $profile_magic;
		$this->version = $version;

	}

	public function profile_magic_access_meta_box()
	{
		add_meta_box( 'profile-magic-access-metabox', __( 'ProfileGrid','profilegrid-user-profiles-groups-and-communities'),array( $this, 'pm_display_meta_box' ), 'page');
		add_meta_box( 'profile-magic-access-metabox', __( 'ProfileGrid','profilegrid-user-profiles-groups-and-communities'),array( $this, 'pm_display_meta_box' ), 'post');
                add_meta_box( 'profile-magic-access-metabox', __( 'ProfileGrid','profilegrid-user-profiles-groups-and-communities'),array( $this, 'pm_display_meta_box' ), 'profilegrid_blogs');
                add_meta_box( 'profile-magic-access-metabox', __( 'ProfileGrid','profilegrid-user-profiles-groups-and-communities'),array( $this, 'pm_display_meta_box' ), 'pg_groupwall');
	}
	
	public function pm_display_meta_box($post)
	{
		include 'partials/access-meta-box.php';
	}
	
	public function profile_magic_save_access_meta($post_id)
	{
		if(isset($post_id))
		{
			if(isset($_POST['pm_enable_custom_access']))
			{
				update_post_meta($post_id,'pm_enable_custom_access',$_POST['pm_enable_custom_access']);	
			}
			else
			{
				update_post_meta($post_id,'pm_enable_custom_access',0);
			}
			
			if(isset($_POST['pm_content_access']))
			{
				update_post_meta($post_id,'pm_content_access',$_POST['pm_content_access']);
			}
			
			if(isset($_POST['pm_content_access_group']))
			{
				update_post_meta($post_id,'pm_content_access_group',$_POST['pm_content_access_group']);
			}
		}
		
	}
	
	public function profile_magic_check_content_access($content)
	{
		$id = get_the_ID();
                $author_id =  get_the_author_meta('ID');
                $pmfriends = new PM_Friends_Functions;
                $pmrequests = new PM_request;
                $admin_note = get_post_meta($id,'pm_admin_note_content',true);
                if(trim($admin_note)!='')
                {
                    $note = '<div class="pg-admin-note">'.$admin_note.'</div>';
                    $note_position = get_post_meta($id,'pm_admin_note_position',true);
                    if($note_position=='top')
                    {
                        $content = $note.$content;
                    }
                    else
                    {
                        $content = $content.$note;
                    }
                    
                }
                
		if(get_post_meta($id,'pm_enable_custom_access',true)==1)
		{
			if(get_post_meta($id,'pm_content_access',true)==2)
			{
				  if ( is_user_logged_in() ) 
				  {
                                        $uid = get_current_user_id();
					if(get_post_meta($id,'pm_content_access_group',true)!='all')
					{
						$gids = maybe_unserialize(get_user_meta($uid,'pm_group',true));
                                                $user_group = $pmrequests->pg_filter_users_group_ids($gids);
                                                if(!empty($user_group))
                                                {
                                                    if(!is_array($user_group))
                                                    {
                                                        $user_group=array($user_group);
                                                    }
                                                }
                                                else
                                                {
                                                    $user_group = array();
                                                }
                                                if(!in_array(get_post_meta($id,'pm_content_access_group',true),$user_group))
						{
							 $error = $pmrequests->profile_magic_get_error_message('not_permitted','profilegrid-user-profiles-groups-and-communities');
					  		 $content = $this->profile_magic_content_access_message($error);
						}
					}
				  }
				  else
				  {
					  $error = $pmrequests->profile_magic_get_error_message('loginrequired','profilegrid-user-profiles-groups-and-communities');
					  $content = $this->profile_magic_content_access_message($error);
				  }
			}
                        
                        if(get_post_meta($id,'pm_content_access',true)==3)
                        {
                            if ( is_user_logged_in() ) 
				  {
                                        $author_friends = $pmfriends->profile_magic_my_friends($author_id);
                                        $uid = get_current_user_id();
                                        if($uid!=$author_id)
                                        {
                                            if(!in_array($uid,$author_friends))
                                            {
                                                $error = $pmrequests->profile_magic_get_error_message('not_permitted','profilegrid-user-profiles-groups-and-communities');
                                                $content = $this->profile_magic_content_access_message($error);
                                            }
                                        }
				  }
				  else
				  {
					  $error = $pmrequests->profile_magic_get_error_message('loginrequired','profilegrid-user-profiles-groups-and-communities');
					  $content = $this->profile_magic_content_access_message($error);
				  }
                        }
                        
                        if(get_post_meta($id,'pm_content_access',true)==4)
                        {
                            if ( is_user_logged_in() ) 
				  {
                                        $uid = get_current_user_id();
					if($uid!=$author_id)
					{
                                            $error = $pmrequests->profile_magic_get_error_message('not_permitted','profilegrid-user-profiles-groups-and-communities');
                                            $content = $this->profile_magic_content_access_message($error);
					}
				  }
				  else
				  {
					  $error = $pmrequests->profile_magic_get_error_message('loginrequired','profilegrid-user-profiles-groups-and-communities');
					  $content = $this->profile_magic_content_access_message($error);
				  }
                        }
                        
                        if(get_post_meta($id,'pm_content_access',true)==5)
			{
				  if ( is_user_logged_in() ) 
				  {
                                        $uid = get_current_user_id();
					$author_groups = get_user_meta($author_id,'pm_group',true);
					$user_group = get_user_meta($uid,'pm_group',true);
                                        if(!empty($user_group))
                                        {
                                            if(!is_array($user_group))
                                            {
                                                $user_group=array($user_group);
                                            }
                                        }
                                        else
                                        {
                                            $user_group = array();
                                        }
                                        
                                        if(!empty($author_groups))
                                        {
                                            if(!is_array($author_groups))
                                            {
                                                $author_groups=array($author_groups);
                                            }
                                        }
                                        else
                                        {
                                            $author_groups = array();
                                        }
                                        $is_group_member = array_intersect($author_groups, $user_group);
                                        if(empty($is_group_member))
                                        {
                                                 $error = $pmrequests->profile_magic_get_error_message('not_permitted','profilegrid-user-profiles-groups-and-communities');
                                                 $content = $this->profile_magic_content_access_message($error);
                                        }
					
				  }
				  else
				  {
					  $error = $pmrequests->profile_magic_get_error_message('loginrequired','profilegrid-user-profiles-groups-and-communities');
					  $content = $this->profile_magic_content_access_message($error);
				  }
			}
                        
                        
		}
                
		return $content;	
	}
	
	public function profile_magic_content_access_message($error)
	{
		$content = '<div class="pm-login-box-error"><span>';
		$content .= $error;
		$content .= '</span>
		</div>';	
		return $content;
	}
	
        public function profile_magic_get_the_excerpt_filter_admin_note($content)
        {
            $id = get_the_ID();
            $author_id =  get_the_author_meta('ID');
            $pmfriends = new PM_Friends_Functions;
            $pmrequests = new PM_request;
            $admin_note = get_post_meta($id,'pm_admin_note_content',true);
            if(trim($admin_note)!='')
            {
               $content =  str_replace($admin_note,"",$content);
            }
            
            return $content;
        }






// class end
}
