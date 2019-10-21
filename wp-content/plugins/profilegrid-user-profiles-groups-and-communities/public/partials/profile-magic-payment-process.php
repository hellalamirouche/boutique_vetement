<?php
$textdomain = $this->profile_magic;
$dbhandler = new PM_DBhandler;
$pmrequests = new PM_request;
$p = new profile_magic_paypal_class; // paypal class
$p->admin_mail 	= $pmrequests->profile_magic_get_admin_email(); // set notification email
$p->sendbox = $dbhandler->get_global_option_value('pm_paypal_test_mode');
$p->from_mail = $pmrequests->profile_magic_get_from_email();
switch($action){
	case "process": // case process insert the form data in DB and process to the paypal
		$form_fields->crf_insert_submission($entry_id,$content['id'],'payment_status','pending');
		$form_fields->crf_insert_submission($entry_id,$content['id'],'invoice',$_POST["invoice"]);
		$this_script =get_permalink();
		$sign = strpos($this_script,'?')?'&':'?';
		$p->add_field('business', $dbhandler->get_global_option_value('pm_paypal_email')); // Call the facilitator eaccount
		$p->add_field('cmd', $_POST["cmd"]); // cmd should be _cart for cart checkout
		$p->add_field('upload', '1');
		$p->add_field('return', $this_script.$sign.'action=success&id='.$entry_id); // return URL after the transaction got over
		$p->add_field('cancel_return', $this_script.$sign.'action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction
		$p->add_field('notify_url', $this_script.$sign.'action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
		$p->add_field('currency_code',$dbhandler->get_global_option_value('pm_paypal_currency'));
		$p->add_field('invoice', $_POST["invoice"]);
		$p->add_field('custom',$user_id);
		$p->add_field('page_style',$dbhandler->get_global_option_value('pm_paypal_page_style'));
		$p->add_field('item_name_1','Group Name');
		$p->add_field('amount_1',$amount);
		$p->submit_paypal_post(); // POST it to paypal
		//$p->dump_fields(); die;// Show the posted values for a reference, comment this line before app goes live
		break;
	case "success": // success case to show the user payment got success
		echo '<div id="crf-form">';
		echo "<div class='info-text'>".__('Payment Transaction Done Successfully','profilegrid-user-profiles-groups-and-communities')."</br>";
		echo '</div></div>';
		/*Show Success Message start*/
		//$form_fields->crf_get_success_message($content['id']);
		//$form_fields->crf_get_sumission_token_number($content['id'],$_REQUEST['id']);
		/*Show Success Message end*/
		/*Get redirection start*/
		//$redirect_option = $form_fields->crf_get_form_option_value('redirect_option',$content['id']);
		//$url = $form_fields->crf_get_redirect_url($content['id'],$redirect_option);
		/*if($redirect_option!='none')
		{	
			header('refresh: 5; url='.$url);
		}*/
	break;
	case "cancel": // case cancel to show user the transaction was cancelled
	echo '<div id="crf-form">';
		echo "<div class='info-text'>".__('Transaction Cancelled','profilegrid-user-profiles-groups-and-communities')."</br>";
		echo '</div></div>';
	break;
	case "ipn": // IPN case to receive payment information. this case will not displayed in browser. This is server to server communication. PayPal will send the transactions each and every details to this case in secured POST menthod by server to server. 
		$trasaction_id  = $_POST["txn_id"];
		$payment_status = strtolower($_POST["payment_status"]);
		$invoice		= $_POST["invoice"];
		$entry_id = $_POST["custom"];
		$log_array		= maybe_serialize($_POST);
		$log_check 		= $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $crf_paypal_log WHERE txn_id = %s", $trasaction_id ) );
		if ($log_check <= 0) {
            $data = array(
                'txn_id' => $trasaction_id,
                'log' => $log_array,
                'posted_date' => date("Y-m-d H:i:s")
            );
            $wpdb->insert($crf_paypal_log,$data);
		} else {
            $data = array(
                'log' => $log_array
            );
            $where = array(
                'txn_id' => $trasaction_id
            );
            $wpdb->update($crf_paypal_log,$data,$where);
		} // Save and update the logs array

		$paypal_log_id		= $wpdb->get_var( $wpdb->prepare( "SELECT id FROM $crf_paypal_log WHERE txn_id = %s",$trasaction_id ) );
		if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic
			$form_fields->crf_insert_submission($entry_id,$content['id'],'trasaction_id',$trasaction_id);
			$form_fields->crf_insert_submission($entry_id,$content['id'],'paypal_log_id',$paypal_log_id);
			$form_fields->crf_update_submission($entry_id,'payment_status',$payment_status);
			$form_fields->crf_update_submission($entry_id,'invoice',$invoice);
			$subject = __('Instant Payment Notification - Recieved Payment','profilegrid-user-profiles-groups-and-communities');
			//$p->send_report($subject); // Send the notification about the transaction
			if($form_type=='reg_form' && $payment_status=='completed')
			{
				$userid = $form_fields->crf_create_new_user($entry_id);
				if(!is_wp_error($userid))
				{
					$form_fields->crf_insert_user_meta($entry_id,$userid);
					$form_fields->crf_create_user_notification($entry_id);
				}
			}
		}else{
			$subject = __('Instant Payment Notification - Payment Fail','profilegrid-user-profiles-groups-and-communities');
			//$p->send_report($subject); // failed notification
		}
	break;
}	
		
?>
