<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(isset($_POST['phoen_reset']))
{
	//$arg ='dashboard,downloads,orders,edit-account,edit-address,customer-logout';
	$arg ='dashboard,downloads,orders,edit-account,edit-address,customer-logout,support-ticket';

	$dashbord =array(
		'active'=>'1',
		'label'=>'Dashboard',
		'icon'=>'tachometer',
		'content'=>'',
		'type'=>'pre'
	); 
	
	$my_downloads =array(
		'active'=>'1',
		'slug'=>'downloads',
		'label'=>'My Downloads',
		'icon'=>'download',
		'content'=>'[my_downloads_content]',
		'type'=>'pre'
	); 
	
	$view_orders =array(
		'active'=>'1',
		'slug'=>'orders',
		'label'=>'My Orders',
		'icon'=>'file-text-o',
		'content'=>'[view_order_content]',
		'type'=>'pre'
	); 
	
	$edit_account =array(
		'active'=>'1',
		'slug'=>'edit-account',
		'label'=>'Edit Account',
		'icon'=>'pencil-square-o',
		'content'=>'',
		'type'=>'pre'
	); 
	
	$edit_address =array(
		'active'=>'1',
		'slug'=>'edit-address',
		'label'=>'Edit Address',
		'icon'=>'pencil-square-o',
		'content'=>'',
		'type'=>'pre'
	); 
	
	$log_out =array(
		'active'=>'1',
		'slug'=>'customer-logout',
		'label'=>'Logout',
		'icon'=>'pencil-square-o',
		'type'=>'pre'
	);
	
	$payment_methods =array(
		'active'=>'1',
		'slug'=>'payment-methods',
		'label'=>'Payment Methods',
		'icon'=>'pencil-square-o',
	); 
	
	update_option('phoen-endpoint', $arg);
	update_option('phoen-endpoint-dashboard', $dashbord);
	update_option('phoen-endpoint-downloads', $my_downloads);
	//update_option('phoen-endpoint-payment-methods', $payment_methods);
	update_option('phoen-endpoint-orders', $view_orders);
	update_option('phoen-endpoint-edit-account', $edit_account);
	update_option('phoen-endpoint-edit-address', $edit_address);
	update_option('phoen-endpoint-customer-logout', $log_out);
	
	
	
}


if(isset($_POST['submit']))
{
	$data = get_option('phoen-endpoint');

	$endpoint = explode(',',$data);
	
	foreach($endpoint as $point)
	{
		
		$value = isset($_POST["phoen-endpoint-".$point.""])?$_POST["phoen-endpoint-".$point.""]:'';
		 
		$check = update_option('phoen-endpoint-'.$point.'', $value);
	}
	
	$endpoints = sanitize_text_field($_POST['endpoints-order']);
	
	update_option('phoen-endpoint',$endpoints);
	
	
	?>

		<div class="updated" id="message">

			<p><strong><?php _e('Menus updated.','custom-my-account');?></strong></p>

		</div>

	<?php
}
?>

<form method="post" action="">

	<table class="form-table" style="background:#fff;">
		
		<tbody>
			
			
			
			<tr valign="top">	
				
				<th>
				
					<h3><?php _e('Manage Menus','custom-my-account');?></h3>
				
				</th>
				
				<td class="phoen-endpoint-container">
					
					<ul class="endpoints ui-sortable" id="sortable">
					
					<?php 

						$data = get_option('phoen-endpoint');
				
	 
						$endpoint = explode(',',$data);
						
						foreach($endpoint as $ep)
						{
						
							$row = get_option('phoen-endpoint-'.$ep.''); 
							
						if(!empty($row))	
						{
							?>					
					
							<li style="border: 1px solid #dfdfdf;" class="endpoint ui-sortable-handle ui-state-default">
								
								<span style="float:left;">
									<input type="checkbox" <?php if(isset($row['active']) && $row['active']==1){echo 'checked';}?> value="1" name="phoen-endpoint-<?php echo $ep.'[active]'; ?>">
								</span>
								<?php $endpoint_label = isset($row['label'])?str_replace("\'", "'", $row['label']):'';
								$endpoint_label = str_replace('\"','"', $endpoint_label);
									?>
								<div class="header" >
									<label for="phoen-endpoint-<?php echo $ep.'-active';?>"><?php echo ucfirst($endpoint_label);?></label>
								</div>
								 
								<div class="options" style="display:none;">
								
									<table class="form-table">
										<tbody>
											<tr>
											<?php 
											if($ep!="dashboard"){?>
												<tr>
													<th><?php _e('Slug','custom-my-account');?></th>
													<td><input type="text" name="phoen-endpoint-<?php echo $ep.'[slug]'; ?>" value="<?php echo isset($row['slug'])?strtolower($row['slug']):''; ?>"></td>
													 
												</tr>
											<?php } ?>
											<?php  	
													$endpoint_label = isset($row['label'])?str_replace("\'", "'", $row['label']):'';
													$endpoint_label = str_replace('\"','"', $endpoint_label);
											?>
											
												<tr>
													<th><?php _e('Label','custom-my-account');?></th>
													<td><input type="text" name="phoen-endpoint-<?php echo $ep.'[label]'; ?>" value="<?php echo ucfirst($endpoint_label); ?>"></td>
												</tr>
												<tr>
													<td><input type="hidden" name="phoen-endpoint-<?php echo $ep.'[type]'; ?>" value="<?php echo isset($row['type'])?$row['type']:''; ?>"></td>
												</tr>
												<?php
												if($ep!='downloads' && $ep!='orders' && $ep!='edit-account' && $ep!='edit-address' && $ep!='customer-logout' || $ep!='support-ticket'){?>
													
														<tr class="phoen_content_<?php echo $ep; ?>" style="display:<?php echo $custom_content_show;?>;"> 
														
														<?php if($ep!='support-ticket'){ ?>
															<th><?php _e('Custom Content','custom-my-account');?></th>
															
															<td><?php $settings = array( 'media_buttons' => false ); $content = isset($row['content'])?$row['content']:''; $editor_id="phoen-endpoint-".$ep;  $text_area ="phoen-endpoint-".$ep.'[content]'; echo wp_editor( stripcslashes($content), $editor_id, array( 'textarea_name' => $text_area ,'media_buttons' => false));?></td>
														</tr>
													<?php 
														}
												} ?>	
												
											</tr> 
										</tbody>
									</table>
								</div>
								<input type="hidden" class="phoen-endpoint-order" name="phoen-endpoint-order" value="<?php echo $ep;?>">
							</li>
						<?php 
						}
						} ?>
						
					</ul>
					
					<input type="hidden" name="endpoints-order" class="endpoints-order" name="endpoints-order" value="<?php echo get_option('phoen-endpoint');?>">
				</td>
			</tr>
			
		</tbody>
	</table>
	<p class="submit">
		<input type="submit" value="Save changes" class="button button-primary" id="submit" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" onclick="return confirm('If you continue with this action, you will reset all options in this page.\nAre you sure?');" value="Reset Defaults" class="button-secondary" name="phoen_reset">
	</p>
</form>