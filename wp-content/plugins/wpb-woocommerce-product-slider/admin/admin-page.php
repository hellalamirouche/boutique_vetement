<?php

/**
 * WPB WooCommerce Products Slider Plugin
 *
 * Template file for admin page
 *
 * Author: WpBean
 */

wp_enqueue_style( 'wpb-wps-admin');
wp_enqueue_script( 'jquery' );

$wpb_wps_plugin_data = get_plugin_data( WPB_WPS_PLUGIN_DIR_FILE );
$version = $wpb_wps_plugin_data['Version'];
?>

<div class="wrap wpb-about-wrap">
	<h2 class="nav-tab-wrapper">
		<a href="#wpb_wps_welcome" class="nav-tab" id="wpb_wps_welcome-tab"><?php esc_html_e( 'Welcome', WPB_WPS_TEXTDOMAIN ) ?></a>
		<a href="#wpb_wps_how_top_use" class="nav-tab" id="wpb_wps_how_top_use-tab"><?php esc_html_e( 'How to use', WPB_WPS_TEXTDOMAIN ) ?></a>
		<a href="#wpb_wps_shortcode" class="nav-tab" id="wpb_wps_shortcode-tab"><?php esc_html_e( 'ShortCodes', WPB_WPS_TEXTDOMAIN ) ?></a>
		<a href="#wpb_wps_shortcode_parameters" class="nav-tab" id="wpb_wps_shortcode_parameters-tab"><?php esc_html_e( 'ShortCode Parameters', WPB_WPS_TEXTDOMAIN ) ?></a>
	</h2>
	<div class="metabox-holder">
		<div id="wpb_wps_welcome" class="group">
			<h1><?php esc_html_e( 'WPB WooCommerce Products Slider - ', WPB_WPS_TEXTDOMAIN ) ;?><?php echo esc_html( $version ) ?></h1>
			<div class="wpb-about-text">
				<p>WPB WooCommerce product slider comes with two different themes for different style product slider for your WooCommerce shop. It can show latest, featured, category, tags and selected products slider. <br><br> With this plugin’s shortcode you can show the product slider anywhere on you site. It has custom widgets for showing products slider in the sidebar and settings to customize the product slider. It’s mobile responsive. Its features make this plugin number one free WooCommerce product slider.</p>

				<p>We have thousands of active install of this plugin. If you are thinking to build a shopping site using WooCommerce, then WPB WooCommerce Product slider plugin is most required to you for taking your conversion rate to the next level.</p>
			</div>
			<div class="wpb_plugin_btns">
				<a class="wpb_button wpb_button_lg wpb_button_success" href="https://wpbean.com/downloads/wpb-woocommerce-product-slider-pro/" target="_blank"><i class="dashicons dashicons-star-filled"></i> Go Premium!</a>
				<a class="wpb_button wpb_button_lg wpb_button_warning" href="http://docs.wpbean.com/docs/wpb-woocommerce-products-slider-free-version/installing/" target="_blank"><i class="dashicons dashicons-format-aside"></i> Documentation</a>
			</div>
		</div>
		<div id="wpb_wps_how_top_use" class="group">
			<h3><?php esc_html_e( 'How to use:', WPB_WPS_TEXTDOMAIN );?></h3>
			<ol>
				<li>Install it as a regular WordPress plugin</li>
				<li>Before install the plugin make sure you have WooCommerce plugin installed and active.</li>
				<li>Use this plugin’s ShortCode to show the products slider on your site.</li>
				<li>You can adjust the plugin from the plugin settings and shortcode parameters.</li>
			</ol>
		</div>
		<div id="wpb_wps_shortcode" class="group">
			<h3><?php esc_html_e( 'ShortCode:', WPB_WPS_TEXTDOMAIN );?></h3>
			<ol>
				<li><b>Basic Use.</b> Will show latest 12 products in slider.<input type="text" value='[wpb-product-slider posts="12"]'></li>
				<li><b>Featured Products Slider</b><input type="text" value='[wpb-product-slider product_type="featured"]'></li>
				<li><b>Category Products Slider.</b> Add comma separated product category ids in category parameter.<input type="text" value='[wpb-product-slider product_type="category" category="22,26,33,37"]'></li>
				<li><b>Tags Products Slider.</b> Add comma separated product tag ids in category parameter.<input type="text" value='[wpb-product-slider product_type="tags" tags="22,26,33,37"]'></li>
				<li><b>Products Slider by Product Ids.</b> Add comma separated product ids in id parameter.<input type="text" value='[wpb-product-slider product_type="id" id="22,26,33,37"]'></li>
				<li><b>Change Slider Theme.</b> Accepted values : hover_effect, grid_no_animation .<input type="text" value='[wpb-product-slider theme="grid_no_animation"]'></li>
				<li><b>Change Slider Theme.</b> Accepted values : hover_effect, grid_no_animation .<input type="text" value='[wpb-product-slider theme="grid_no_animation"]'></li>
				<li><b>Slider Order and OrderBy.</b><input type="text" value='[wpb-product-slider orderby="date" order="DESC"]'></li>
				<li><b>Slider options.</b><input type="text" value='[wpb-product-slider autoplay="true" loop="true" nav="true" pagination="false"]'></li>
				<li><b>Slider Columns in Different Screen Sizes.</b><input type="text" value='[wpb-product-slider items="4" items_desktop_small="3" items_tablet="2" items_mobile="1"]'></li>
			</ol>
		</div>
		<div id="wpb_wps_shortcode_parameters" class="group">
			<h3><?php esc_html_e( 'ShortCode Parameters:', WPB_WPS_TEXTDOMAIN );?></h3>
			<ol>
				<li><b>title</b>Slider Title. Accepted value: Any text.</li>
				<li><b>posts</b>Number of products to show in slider. Accepted value: Any number. Default: 12</li>
				<li><b>product_type</b>Slider product type. Accepted value: latest, featured, category, tags, id Default: latest</li>
				<li><b>theme</b>Slider theme. Accepted value: hover_effect, grid_no_animation Default: hover_effect</li>
				<li><b>show_reviews</b>Show product rating in slider. Accepted value: on, off Default: off</li>
				<li><b>show_price</b>Show product price in slider. Accepted value: on, off Default: on</li>
				<li><b>show_cart</b>Show product add to cart button in slider. Accepted value: on, off Default: on</li>
				<li><b>orderby</b>Slider products orderby. Accepted value: none, ID, author, title, name, type, date, modified, rand, menu_order. Etc. Default: date</li>
				<li><b>order</b>Slider products order. Accepted value: ASC, DESC. Default: DESC</li>
				<li><b>autoplay</b>Slider autoplay. Accepted value: true, false. Default: true</li>
				<li><b>loop</b>Slider loop. Accepted value: true, false. Default: true</li>
				<li><b>nav</b>Show slider navigation. Accepted value: true, false. Default: true</li>
				<li><b>slideby</b>Number of items to slide on Navigation click. Navigation slide by x. "page" string can be set to slide by page. Default: 1.</li>
				<li><b>pagination</b>Show slider pagination. Accepted value: true, false. Default: false</li>
				<li><b>pagination_number</b>Show slider pagination number counting. Accepted value: true, false. Default: false</li>
				<li><b>items</b>Slider column in default large screen. Accepted value: any number Default: 4</li>
				<li><b>items_desktop_small</b>Slider column in small desktop screen. Accepted value: any number Default: 3</li>
				<li><b>items_tablet</b>Slider column in tablet screen. Accepted value: any number Default: 2</li>
				<li><b>items_mobile</b>Slider column in mobile screen. Accepted value: any number Default: 1</li>
				<li><b>category</b>Product category ids. Accepted value: comma separated product category ids. product_type must be category.</li>
				<li><b>tags</b>Product tag ids. Accepted value: comma separated product tag ids. product_type must be tags.</li>
				<li><b>id</b>Product ids. Accepted value: comma separated product ids. product_type must be id.</li>
				<li><b>disable_loop_on</b>Disable slider loop if the number of products is less than or equal to (disable_loop_on). Accepted value: number. Default: 3.</li>
			</ol>
		</div>
	</div>

	<?php wpb_wps_pro_version_info(); ?>
</div>

<div class="clear"></div>

<div class="wpb_wpbean_socials">
	<h4><?php esc_html_e( 'For getting updates of our plugins, features update, WordPress new trend, New web technology etc. Follows Us.', WPB_WPS_TEXTDOMAIN );?></h4>
	<a href="https://twitter.com/wpbean" title="Follow us on Twitter" class="wpb_twitter" target="_blank"><?php esc_html_e( 'Follow Us On Twitter', WPB_WPS_TEXTDOMAIN );?></a>
	<a href="https://plus.google.com/u/0/+WpBean/posts" title="Follow us on Google+" class="wpb_googleplus" target="_blank"><?php esc_html_e( 'Follow Us On Google Plus', WPB_WPS_TEXTDOMAIN );?></a>
	<a href="https://www.facebook.com/wpbean" title="Follow us on Facebook" class="wpb_facebook" target="_blank"><?php esc_html_e( 'Like Us On FaceBook', WPB_WPS_TEXTDOMAIN );?></a>
	<a href="https://www.youtube.com/user/wpbean/videos" title="Follow us on Youtube" class="wpb_youtube" target="_blank"><?php esc_html_e( 'Subscribe Us on YouTube', WPB_WPS_TEXTDOMAIN );?></a>
	<a href="https://wpbean.com/support/" title="Get Support" class="wpb_support" target="_blank"><?php esc_html_e( 'Get Support', WPB_WPS_TEXTDOMAIN );?></a>
</div>

<script>
    jQuery(document).ready(function($) {

        // Switches option sections
        $('.group').hide();
        var activetab = '';
        if (typeof(localStorage) != 'undefined' ) {
            activetab = localStorage.getItem("activetab");
        }
        if (activetab != '' && $(activetab).length ) {
            $(activetab).fadeIn();
        } else {
            $('.group:first').fadeIn();
        }
        $('.group .collapsed').each(function(){
            $(this).find('input:checked').parent().parent().parent().nextAll().each(
            function(){
                if ($(this).hasClass('last')) {
                    $(this).removeClass('hidden');
                    return false;
                }
                $(this).filter('.hidden').removeClass('hidden');
            });
        });

        if (activetab != '' && $(activetab + '-tab').length ) {
            $(activetab + '-tab').addClass('nav-tab-active');
        }
        else {
            $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
        }
        $('.nav-tab-wrapper a').click(function(evt) {
            $('.nav-tab-wrapper a').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active').blur();
            var clicked_group = $(this).attr('href');
            if (typeof(localStorage) != 'undefined' ) {
                localStorage.setItem("activetab", $(this).attr('href'));
            }
            $('.group').hide();
            $(clicked_group).fadeIn();
            evt.preventDefault();
        });

        $(".wpb-about-wrap input[type='text']").on("click", function () {
		   $(this).select();
		});
	});
</script>