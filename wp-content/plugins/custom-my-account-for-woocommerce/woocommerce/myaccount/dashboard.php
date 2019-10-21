<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account-dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce;

if(!isset($_GET['temp'])){
	
	$phoen_data_dashb = get_option('phoen-endpoint-dashboard');
	
	$entered_data = str_replace('\"','"',$phoen_data_dashb['content']);
	
	$entered_data = str_replace("\'","'",$entered_data);

	$content = apply_filters( 'the_content', $entered_data);
	
	$content = str_replace( ']]>', ']]&gt;', $content );
	
	//if($phoen_das_text==0) echo "<p>".apply_filters( 'pcmac_woocommerce_custom_my_account', $content)."</p>";
	?>
	<p><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
	?></p>

	<p><?php
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
	?></p>
	<?php 
	echo apply_filters( 'pcmac_woocommerce_custom_my_account', $content);
	
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );
	?>
	<script>
		jQuery(document).ready(function(){
			
			jQuery('.phoen_nav_tab li:first').addClass('is-active');
			jQuery('.phoen_nav_tab li:first a').trigger('click');
				
		});
	</script>
	<?php
}else{
	
	$custom_tab = $_GET['temp'];

	$phoen_data_dashb = get_option('phoen-endpoint-'.$custom_tab);

	$entered_data = str_replace('\"','"',$phoen_data_dashb['content']);
	$entered_data = str_replace("\'","'",$entered_data);
	
	$content = apply_filters( 'the_content', $entered_data);
	
	$content = str_replace( ']]>', ']]&gt;', $content );
	
	echo apply_filters( 'pcmac_woocommerce_custom_my_account', $content);
	
}

	
?>
