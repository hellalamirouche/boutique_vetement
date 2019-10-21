<div class="pg-group-setting-blog">
    <input type="hidden" id="pg-groupid" name="pg-groupid" value="<?php echo esc_attr($gid); ?>" />
    <div id="pg-group-setting-request-batch" class="pg-group-setting-request-batch pm-dbfl pm-pad10" style="display:none;">
         <div class="pm-difl pg-group-setting-blog-link"><a onclick="pg_edit_blog_bulk_popup('group','decline_request_bulk','<?php echo $gid;?>')" class="pm-remove"><?php _e('Decline','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link"><a onclick="pg_edit_blog_bulk_popup('group','accept_request_bulk','<?php echo $gid;?>')"><?php _e('Accept','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link"><a onclick="pg_edit_blog_bulk_popup('group','message_bulk','<?php echo $gid;?>')"><?php _e('Message','profilegrid-user-profiles-groups-and-communities');?></a></div>
    </div>
    <div class="pg-group-setting-head pm-dbfl" id="pg-members-setting-head">
        <div class="pg-group-sorting-ls pg-members-sortby pm-difl ">
            <div class="pg-sortby-alpha pm-difl">
                <span class="pg-group-sorting-title pm-difl"><?php _e("Sort by","profilegrid-user-profiles-groups-and-communities");?></span>
            <span class="pg-sort-dropdown pm-border pm-difl">
                <select class="pg-custom-select" name="request_sort_by" id="request_sort_by" onchange="pm_get_all_requests_from_group(1)">
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
                
            
        </div>
      
        <div class="pg-group-sorting-rs pm-difr">
            
            <div class="pm-difl pg-members-sortby">&nbsp;</div>
            <div class="pm-difl pg-add-member"><a onclick="pg_edit_blog_popup('member','add_user','','<?php echo $gid;?>')"><?php _e("Add","profilegrid-user-profiles-groups-and-communities");?></a></div> 
           
            <div class=" pg-member-search pm-difl"><input type="text" name="request_search" id="request_search" placeholder="<?php _e('Search', 'profilegrid-user-profiles-groups-and-communities'); ?>" onkeyup="pm_get_all_requests_from_group(1)"></div>
        </div>

    </div>

    <div class="" id="pm-edit-group-request-html-container">
        <?php
        $pmrequests = new PM_request;
        $pmrequests->pm_get_all_join_group_requests($gid, $pagenum = 1, $limit = 10);
        ?>
    </div>

</div>



