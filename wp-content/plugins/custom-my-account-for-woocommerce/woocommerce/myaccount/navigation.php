<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 *
*/
if ( ! defined( 'ABSPATH' ) ) {   
	exit;
}

global $woocommerce;	

do_action( 'woocommerce_before_account_navigation' );

$data = get_option('phoen-endpoint');

$endpoint = explode(',',$data);

?>
	<nav class="woocommerce-MyAccount-navigation phoen_custom_account">
		
		<ul class="phoen_nav_tab"><?php
			foreach($endpoint as $ep)
			{
			
				$endpints_row = get_option('phoen-endpoint-'.$ep.'');
				
				$endpoint_label = isset($endpints_row['label'])?str_replace("\'", "'", $endpints_row['label']):'';
				$endpoint_label = str_replace('\"','"', $endpoint_label);
				
				if(isset($endpints_row['active']) && $endpints_row['active'] == 1 && isset($endpints_row['type']) && $endpints_row['type'] == 'pre'){
					
					if(isset($endpints_row['slug'])){
						$endpoint_slug = $endpints_row['slug'];
					}else{
						$endpoint_slug = '';
					}
				
				?>
					<li class="<?php echo wc_get_account_menu_item_classes($endpoint_slug); ?>">
						<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint_slug ) ); ?>"><?php echo esc_html($endpoint_label); ?></a>
					</li>
				<?php
				}
				
			} ?>
		</ul>
	</nav>

<?php  do_action( 'woocommerce_after_account_navigation' ); ?>
