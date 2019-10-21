<?php $pmrequests = new PM_request; ?>
<div class="pmagic">
    <div class="pm-users-search-page pm-dbfl">
        <div class="pm-user-search pm-dbfl pm-border-bt pm-bg-lt">
            <form name="pm-search-form" id="pm-advance-search-form" method="post" class="pm-dbfl" >
                <div class="pm-search-box pm-dbfl pm-pad10">
                    <?php if (get_the_ID()): ?>
                        <input type="hidden" name="page_id" value="<?php echo get_the_ID(); ?>" />
                    <?php endif; ?>
                    <input id='pagenum' type="hidden" name="pagenum" value="1" />

                    <input type="hidden" name="status" value="0" />  
                    <input type="hidden" name="action" value='pm_advance_user_search' />
                    <input type="text" class="pm-search-input pm-advances-search-text pm-difl" name="pm_search" 
                           onkeyup="pm_advance_user_search('')"   value="<?php if (isset($_GET['pm_search'])) echo esc_attr( filter_input(INPUT_GET, 'pm_search', FILTER_SANITIZE_STRING) ); ?>"> 

                </div>
                <div class="pm-adv-search-button pm-dbfl pm-pad10">
                    <input type="submit" form='unknown' id="reset_btn" name="pm_reset" class="pm-search-submit pm-difl"  value="<?php _e('Reset','profilegrid-user-profiles-groups-and-communities'); ?>" /> 
                    <input type="submit" form='unknown' id="advance_search_option" name="advance_search_button" class="pm-search-submit pm-difl"  value="<?php _e('Advance','profilegrid-user-profiles-groups-and-communities'); ?>" />
                </div>

                <div class="pm-dbfl pm-pad10" id="advance_search_pane">
                <div class="pm-dbfl pm-search-box">
                    <select name="gid" class="pm-search-input" id="advance_search_group" onchange="pm_change_search_field(this.value)" >
                        <option value=""><?php _e('Select A Group','profilegrid-user-profiles-groups-and-communities'); ?></option>
                        <?php
                        foreach ($groups as $group) {
                            ?>
                            <option value="<?php echo $group->id; ?>" <?php if (!empty($gid)) selected($gid, $group->id); ?>>
                                <?php echo $group->group_name; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>                      
                    <ul class="pm-filters" id="advance_seach_ul"><?php
                    $fields = $dbhandler->get_all_result('FIELDS');
                    foreach ($fields as $field) {
                        $gid = $field->associate_group;
                        $is_group_exist = $pmrequests->pg_check_if_group_exist($gid);
                        if(!$is_group_exist)
                        {
                            continue;
                        }
                        
                        
                        if ($field->field_options != "")
                            $field_options = maybe_unserialize($field->field_options);
                        $exclude = array('file', 'user_avatar', 'heading', 'paragraph', 'confirm_pass', 'user_pass');
                        if (!in_array($field->field_type, $exclude)) {

                            if (isset($field_options['display_on_search']) && ($field_options['display_on_search'] == 1)) {
                                
                                 if(isset($field_options['admin_only']) && $field_options['admin_only']=="1" && !is_super_admin() )
                                {
                                   continue;
                                }
                                ?>
                        <li class="pm-filter-item"><input type="checkbox" name="match_fields" onclick="pm_advance_user_search()"  value="<?php echo "$field->field_key"; ?>" ><span class="pm-filter-value"><?php _e($field->field_name,'profilegrid-user-profiles-groups-and-communities'); ?></span></li>


                                <?php
                            }
                        }
                    }
                    ?>
                    </ul>
                </div>
                     
        <div id="pm_result_pane" >
            
        </div>
            </form>
        </div>

    </div>
</div>
