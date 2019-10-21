
<div class="pg-group-setting-blog">
    <input type="hidden" id="pg-groupid" name="pg-groupid" value="<?php echo esc_attr($gid); ?>" />
    <div id="pg-group-setting-blog-batch" class="pg-group-setting-blog-batch pm-dbfl pm-pad10" style="display:none;">
        <div class="pm-difl pg-group-setting-blog-link"><a onclick="pg_edit_blog_bulk_popup('blog','change_status_bulk','<?php echo $gid;?>')"><?php _e('Change Status','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link"><a onclick="pg_edit_blog_bulk_popup('blog','access_control_bulk','<?php echo $gid;?>')"><?php _e('Access Control','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link"><a onclick="pg_edit_blog_bulk_popup('blog','add_admin_note_bulk','<?php echo $gid;?>')"><?php _e('Add Note','profilegrid-user-profiles-groups-and-communities');?></a></div>
        <div class="pm-difl pg-group-setting-blog-link pm-blog-message-link"><a onclick="pg_edit_blog_bulk_popup('blog','message_bulk','<?php echo $gid;?>')"><?php _e('Message','profilegrid-user-profiles-groups-and-communities');?></a></div>
    </div>
    <div class="pg-group-setting-head pm-dbfl" id="pg-group-setting-head">
        <div class="pg-group-sorting-ls pg-members-sortby pm-difl ">
            <div class="pg-sortby-alpha pm-difl">
                <span class="pg-group-sorting-title pm-difl"><?php _e("Sort by","profilegrid-user-profiles-groups-and-communities");?></span>
                <span class="pg-sort-dropdown pm-border pm-difl">
                <select class="pg-custom-select" name="blog_sort_by" id="blog_sort_by" onchange="pm_get_all_user_blogs_from_group(1)">
                    <option value="title_asc"><?php _e('Alphabetically A-Z', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="title_desc"><?php _e('Alphabetically Z-A', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="modified_desc"><?php _e('Last Modified First', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="modified_asc"><?php _e('Oldest Modified First', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="pending_post"><?php _e('Pending Review', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                </select>
            </span>
            </div>
            <!-- <div class="pg-sortby-number pm-difl">
             <span class="pg-sort-dropdown pm-border">
                <select class="pg-custom-select" name="pg_blog_sort_limit" id="pg_blog_sort_limit" onchange="pm_get_all_user_blogs_from_group(1)">
                    <option value="10" <?php selected('10',get_user_meta($current_user->ID,'pg_blog_sort_limit',true));?>><?php _e('10','profilegrid-user-profiles-groups-and-communities')  ?></option>
                    <option value="50" <?php selected('50',get_user_meta($current_user->ID,'pg_blog_sort_limit',true));?>><?php _e('50', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    <option value="100" <?php selected('100',get_user_meta($current_user->ID,'pg_blog_sort_limit',true));?>><?php _e('100', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                </select>
            </span>
            </div> -->
            
        </div>
     
        <div class="pg-group-sorting-rs pm-difr">
            <div class="pm-difl pg-add-member"><a href="">&nbsp;</a></div> 
            <div class="pm-difl pg-members-sortby">
                <span class="pg-sort-dropdown pm-border">
                    <select class="pg-custom-select" id="blog_search_in" name="blog_search_in" onchange="pm_get_all_user_blogs_from_group(1)">
                        <option value="post_title"><?php _e('Post Title', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                        <option value="author_name"><?php _e('Author Name', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                        <option value="post_tag"><?php _e('Post Tags', 'profilegrid-user-profiles-groups-and-communities'); ?></option>
                    </select>
                </span>

            </div>
            <div class="pg-member-search pm-difl"><input type="text" name="blog_search" id="blog_search" placeholder="<?php _e('Search', 'profilegrid-user-profiles-groups-and-communities'); ?>" onkeyup="pm_get_all_user_blogs_from_group(1)"></div>
        </div>

    </div>
    
    <div class="" id="pm-edit-group-blog-html-container">
        <?php
        $pmrequests = new PM_request;
        $pmrequests->pm_get_all_group_blogs($gid, $pagenum = 1, $limit = 10);
        ?>
    </div>

</div>



