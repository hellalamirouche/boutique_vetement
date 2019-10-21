<?php
$pm_u_search = filter_input(INPUT_GET,'pm_u_search');
$requests = $pmfriends->profile_magic_my_friends_requests($uid);
if(!empty($requests))
{
	$user_query =  $dbhandler->pm_get_all_users_ajax($pm_u_search,$meta_query_array,'',$offset,$limit,'ASC','include',array(),$date_query,$requests);
	$total_users = $user_query->get_total();
        $users = $user_query->get_results();
        $num_of_requests_pages = ceil( $total_users/$limit);
	?>	
        <div class="pm-friend-action-bar pm-dbfl">
              <button class="pm-difr pm-delete" onclick="pm_multiple_friends_request_delete('<?php echo $u1;?>')"><?php _e('Delete','profilegrid-user-profiles-groups-and-communities');?></button>
              <button class="pm-difr " onclick="pm_multiple_friends_request_accept('<?php echo $u1;?>')"><?php _e('Accept','profilegrid-user-profiles-groups-and-communities');?></button>
        </div>
	<div class="pm-my-requests">
	<?php $pmfriends->profile_magic_friends_result_html($users,$uid,2);?>
	</div>
	<?php if($num_of_requests_pages>1):?>
	<div class="pm-more-request-result">
	<button id="pm_load_more_request" value="2" onclick="pm_load_more_request(<?php echo $uid;?>,this.value,<?php echo $num_of_requests_pages;?>)"><?php _e('Load More Result','profilegrid-user-profiles-groups-and-communities');?></button>
	<div class="pm-loader-img-request"><img src="<?php echo $path;?>images/ajax-loader.gif" width="" height=""/></div>
	</div>
	<?php endif;
	
}
else
{
	echo '<p class="pm-no-result-found">'.__('No new requests','profilegrid-user-profiles-groups-and-communities').'</p>';
	
}
?>
