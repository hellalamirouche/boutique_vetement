<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	add_action('admin_menu', 'add_custom_myaccount_page');
	
	function add_custom_myaccount_page() 
	{

		$plugin_dir_url =  plugin_dir_url( __FILE__ );
		
		if ( empty ( $GLOBALS['admin_page_hooks']['phoeniixx'] ) ){
			add_menu_page( 'phoeniixx', __( 'Phoeniixx', 'phe' ), 'nosuchcapability', 'phoeniixx', NULL, $plugin_dir_url.'/assets/images/logo-wp.png', 57 );
		}	
        
		add_submenu_page( 'phoeniixx', 'Custom My Account', 'Custom My Account', 'manage_options', 'phoe_myaccount_setting', 'phoe_myaccount_setting' );	
	
	}
	
	function phoe_myaccount_setting()
	{
		wp_enqueue_style( 'phoen-wcmap4',  plugin_dir_url(__FILE__).'/assets/css/phoen-jquery-ui.css');
		
		wp_enqueue_script( 'script_myaccount_request', plugin_dir_url( __FILE__ ).'/assets/js/my_account.js', array( 'jquery' ));
		
		wp_enqueue_script( 'jquery-ui' );
		
		wp_enqueue_script( 'jquery-ui-sortable' );
		
		?> 
		<div id="profile-page" class="wrap">
			<?php
				if(isset($_GET['tab']))
				{
					$tab = sanitize_text_field( $_GET['tab'] );
				}
				else
				{
					$tab="";
				}
				
				
			?>
			<h2><?php _e('Custom My Account Plugin Options','custom-my-account');?>
			 
			</h2>
			<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
				
				<a class="nav-tab <?php if($tab == 'endpoints'|| $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=phoe_myaccount_setting&amp;tab=endpoints"><?php _e('Menu','custom-my-account');?></a>
				
				<a class="nav-tab <?php if($tab == 'premium'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=phoe_myaccount_setting&amp;tab=premium"><?php _e('Premium Version','custom-my-account');?></a>				
				
				<a class="nav-tab <?php if($tab == 'support'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=phoe_myaccount_setting&amp;tab=support"><?php _e('Support','custom-my-account');?></a>	

				<a class="nav-tab <?php if($tab == 'install'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=phoe_myaccount_setting&amp;tab=install"><?php _e('How to Install','custom-my-account');?></a>	

				<a class="nav-tab <?php if($tab == 'woocommerce-app'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=phoe_myaccount_setting&amp;tab=woocommerce-app"><?php _e('Woocommerce App','custom-my-account');?></a>	


			</h2>
		</div>
		<?php
		if($tab == 'endpoints' || $tab == '')
		{
			include(dirname(__FILE__).'/admin/endpoint_setting.php');
		}
		else if($tab == 'support' || $tab == '')
		{
			include(dirname(__FILE__).'/admin/support-tab.php');
			
		}else if($tab=='premium')

		{
           include(dirname(__FILE__).'/admin/premium-tab.php'); 
        }




        

        else if($tab=='install')

		{
           include(dirname(__FILE__).'/admin/How-to-install.php'); 
        }

        else if($tab=='woocommerce-app')

		{
           include(dirname(__FILE__).'/admin/Woocommerce-app.php'); 
        }
		


	}
?>