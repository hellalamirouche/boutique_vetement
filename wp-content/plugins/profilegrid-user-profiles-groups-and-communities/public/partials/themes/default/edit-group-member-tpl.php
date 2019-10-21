<div class="pg-group-setting-blog">
    <input type="hidden" id="pg-groupid" name="pg-groupid" value="<?php echo esc_attr($gid); ?>" />
    <div id="pg-group-setting-member-batch" class="pg-group-setting-member-batch pm-dbfl pm-pad10" style="display:none;">
         <div class="pm-difl pg-group-setting-blog-link"><a onclick="pg_edit_blog_bulk_popup('member','remove_user_bulk','<?php echo $gid;?>')" class="pm-remove"><?php _e('Remove','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link pm-suspend-link"><a onclick="pg_edit_blog_bulk_popup('member','deactivate_user_bulk','<?php echo $gid;?>')"><?php _e('Suspend','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link pm-activate-link"><a onclick="pg_activate_bulk_users('<?php echo $gid;?>')"><?php _e('Activate','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link pm-message-link"><a onclick="pg_edit_blog_bulk_popup('member','message_bulk','<?php echo $gid;?>')"><?php _e('Message','profilegrid-user-profiles-groups-and-communities');?></a></div>
    </div>
    <div class="pg-group-setting-head pm-dbfl" id="pg-members-setting-head">
        <div class="pg-group-sorting-ls pg-members-sortby pm-difl ">
            <div class="pg-sortby-alpha pm-difl">
                <span class="pg-group-sorting-title pm-difl"><?php _e("Sort by","profilegrid-user-profiles-groups-and-communities");?></span>
            <span class="pg-sort-dropdown pm-border pm-difl">
                <select class="pg-custom-select" name="member_sort_by" id="member_sort_by" onchange="pm_get_all_users_from_group(1)">
                    <option value="first_name_asc"><?php _e('First Name Alphabetically A - Z', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="first_name_desc"><?php _e('First Name Alphabetically Z - A', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="last_name_asc"><?php _e('Last Name Alphabetically A - Z', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="last_name_desc"><?php _e('Last Name Alphabetically Z- A', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="latest_first"><?php _e('Latest First', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="oldest_first"><?php _e('Oldest First', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="suspended"><?php _e('Suspended', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                </select>
            </span>
                </div>
<!--                <div class="pg-sortby-number pm-difl">
                <span class="pg-sort-dropdown pm-border">
                <select class="pg-custom-select" name="pg_member_sort_limit" id="pg_member_sort_limit" onchange="pm_get_all_users_from_group(1)">
                    <option value="10" <?php // selected('10',get_user_meta($current_user->ID,'pg_member_sort_limit',true));?>><?php // _e('10','profilegrid-user-profiles-groups-and-communities')  ?></option>
                    <option value="50" <?php // selected('50',get_user_meta($current_user->ID,'pg_member_sort_limit',true));?>><?php // _e('50', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="100" <?php // selected('100',get_user_meta($current_user->ID,'pg_member_sort_limit',true));?>><?php // _e('100', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                </select>
            </span>
                </div>-->
            
        </div>
      
        <div class="pg-group-sorting-rs pm-difr">
            <div class="pm-difl pg-add-member"><a onclick="pg_edit_blog_popup('member','add_user','','<?php echo $gid;?>')"><?php _e('Add','profilegrid-user-profiles-groups-and-communities');?></a></div> 
            <div class="pm-difl pg-members-sortby">
                <span class="pg-sort-dropdown pm-border">
                    <select class="pg-custom-select" id="member_search_in" name="member_search_in" onchange="pm_get_all_users_from_group(1)">
                        <option value=""><?php _e('Select a Field','profilegrid-user-profiles-groups-and-communities');?></option>
                        <?php
                        $fields = $dbhandler->get_all_result('FIELDS', $column = '*', array('associate_group' => $gid), 'results', 0, false, $sort_by = 'ordering');
                        foreach($fields as $field)
                        {
                            $exclude = array('file','user_avatar','heading','paragraph','confirm_pass','user_pass');
                            if (!in_array($field->field_type, $exclude))
                            {
                                echo '<option value="'.$field->field_key.'">'.$field->field_name.'</option>';	
                            }
                        }
                        ?>
                    </select>
                </span>

            </div>
            <div class=" pg-member-search pm-difl"><input type="text" name="member_search" id="member_search" placeholder="<?php _e('Search', 'profilegrid-user-profiles-groups-and-communities'); ?>" onkeyup="pm_get_all_users_from_group(1)"></div>
        </div>

    </div>

    <div class="" id="pm-edit-group-member-html-container">
        <?php
        $pmrequests = new PM_request;
        $pmrequests->pm_get_all_users_from_group($gid, $pagenum = 1, $limit = 10);
        ?>
    </div>

</div>



