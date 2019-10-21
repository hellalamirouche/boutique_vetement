<?php

/**
 * WPB WooCommerce Product slider
 * By WpBean
 */


if ( !class_exists('wpb_wps_lite_settings' ) ):
class wpb_wps_lite_settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }
	
    function admin_menu() {
        add_submenu_page(
            WPB_WPS_TEXTDOMAIN . '-about',
            esc_html__( 'Settings', WPB_WPS_TEXTDOMAIN ),
            esc_html__( 'Settings', WPB_WPS_TEXTDOMAIN ),
            apply_filters( 'wpb_wps_settings_user_capability', 'manage_options' ),
            WPB_WPS_TEXTDOMAIN . '-settings',
            array( $this, 'wpb_wps_plugin_page' )
        );
    }
	// setings tabs
    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'wpb_wps_general',
                'title' => esc_html__( 'General Settings', WPB_WPS_TEXTDOMAIN )
            ),
            array(
                'id'    => 'wpb_wps_slider_settings',
                'title' => esc_html__( 'Slider Settings', WPB_WPS_TEXTDOMAIN )
            ),
            array(
                'id'    => 'wpb_wps_style',
                'title' => esc_html__( 'Style Settings', WPB_WPS_TEXTDOMAIN )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wpb_wps_general' => array(
                array(
                    'name'      => 'wpb_wps_number',
                    'label'     => esc_html__( 'Number of Products', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Number of Product to show in slider. Default 12.', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'number',
                    'default'   => 12
                ),
				array(
                    'name'    => 'wpb_wps_product_type',
                    'label'   => esc_html__( 'Product Type', WPB_WPS_TEXTDOMAIN ),
                    'desc'    => esc_html__( 'Select product type for slider.', WPB_WPS_TEXTDOMAIN ),
                    'type'    => 'select',
                    'default' => 'latest',
                    'options' => array(
                        'latest'    => esc_html__( 'Latest Products', WPB_WPS_TEXTDOMAIN ),
                        'featured'  => esc_html__( 'Featured Products', WPB_WPS_TEXTDOMAIN ),
                        'category'  => esc_html__( 'Category Products', WPB_WPS_TEXTDOMAIN ),
                        'tags'      => esc_html__( 'Tag Products', WPB_WPS_TEXTDOMAIN ),
                        'id'        => esc_html__( 'Products From ID', WPB_WPS_TEXTDOMAIN ),
                    )
                ),
                array(
                    'name'    => 'wpb_wps_orderby',
                    'label'   => esc_html__( 'Product Orderby', WPB_WPS_TEXTDOMAIN ),
                    'desc'    => esc_html__( 'Select product orderby for slider. Default: Date.', WPB_WPS_TEXTDOMAIN ),
                    'type'    => 'select',
                    'default' => 'date',
                    'options' => array(
                        'none'          => esc_html__( 'None', WPB_WPS_TEXTDOMAIN ),
                        'date'          => esc_html__( 'Date', WPB_WPS_TEXTDOMAIN ),
                        'ID'            => esc_html__( 'ID', WPB_WPS_TEXTDOMAIN ),
                        'author'        => esc_html__( 'Author', WPB_WPS_TEXTDOMAIN ),
                        'title'         => esc_html__( 'Title', WPB_WPS_TEXTDOMAIN ),
                        'name'          => esc_html__( 'Name', WPB_WPS_TEXTDOMAIN ),
                        'rand'          => esc_html__( 'Rand', WPB_WPS_TEXTDOMAIN ),
                        'menu_order'    => esc_html__( 'Menu Order', WPB_WPS_TEXTDOMAIN ),
                        'modified'      => esc_html__( 'Modified', WPB_WPS_TEXTDOMAIN ),
                    )
                ),
                array(
                    'name'    => 'wpb_wps_order',
                    'label'   => esc_html__( 'Product Order', WPB_WPS_TEXTDOMAIN ),
                    'desc'    => esc_html__( 'Select product order for slider. Default: DESC.', WPB_WPS_TEXTDOMAIN ),
                    'type'    => 'select',
                    'default' => 'DESC',
                    'options' => array(
                        'ASC'          => esc_html__( 'ASC', WPB_WPS_TEXTDOMAIN ),
                        'DESC'         => esc_html__( 'DESC', WPB_WPS_TEXTDOMAIN ),
                    )
                ),
                array(
                    'name'    => 'wpb_wps_slider_theme',
                    'label'   => esc_html__( 'Slider Theme', WPB_WPS_TEXTDOMAIN ),
                    'desc'    => esc_html__( 'Select a theme for slider.', WPB_WPS_TEXTDOMAIN ),
                    'type'    => 'select',
                    'default' => 'hover_effect',
                    'options' => array(
                        'hover_effect'          => esc_html__( 'Theme Hover Effect', WPB_WPS_TEXTDOMAIN ),
                        'grid_no_animation'     => esc_html__( 'Theme Box', WPB_WPS_TEXTDOMAIN ),
                    )
                ),
                array(
                    'name'      => 'wpb_wps_show_reviews',
                    'label'     => esc_html__( 'Show Product Review in Slider', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                ),
                array(
                    'name'      => 'wpb_wps_show_price',
                    'label'     => esc_html__( 'Show Product Price in Slider', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                    'default'   => 'on'
                ),
                array(
                    'name'      => 'wpb_wps_show_cart',
                    'label'     => esc_html__( 'Show Add to Cart button in Slider', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                    'default'   => 'on'
                ),
                array(
                    'name'              => 'wpb_wps_categories',
                    'label'             => esc_html__( 'Product Categories', WPB_WPS_TEXTDOMAIN ),
                    'desc'              => esc_html__( 'Comma separated product category ids.', WPB_WPS_TEXTDOMAIN ),
                    'placeholder'       => esc_html__( '20,23,27', WPB_WPS_TEXTDOMAIN ),
                    'type'              => 'text',
                ),
                array(
                    'name'              => 'wpb_wps_tags',
                    'label'             => esc_html__( 'Product Tags', WPB_WPS_TEXTDOMAIN ),
                    'desc'              => esc_html__( 'Comma separated product tag ids.', WPB_WPS_TEXTDOMAIN ),
                    'placeholder'       => esc_html__( '20,23,27', WPB_WPS_TEXTDOMAIN ),
                    'type'              => 'text',
                ),
                array(
                    'name'              => 'wpb_wps_ids',
                    'label'             => esc_html__( 'Product IDs', WPB_WPS_TEXTDOMAIN ),
                    'desc'              => esc_html__( 'Comma separated product ids.', WPB_WPS_TEXTDOMAIN ),
                    'placeholder'       => esc_html__( '20,23,27', WPB_WPS_TEXTDOMAIN ),
                    'type'              => 'text',
                ),
            ),

            'wpb_wps_slider_settings' => array(
                array(
                    'name'      => 'wpb_wps_items',
                    'label'     => esc_html__( 'Number of Column', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Slider number of columns in large screen. Default: 4', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'number',
                    'default'   => 4
                ),
                array(
                    'name'      => 'wpb_wps_items_desktop_small',
                    'label'     => esc_html__( 'Number of Columns Small Desktop', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Slider number of columns in small desktop. Default: 3', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'number',
                    'default'   => 3
                ),
                array(
                    'name'      => 'wpb_wps_items_tablet',
                    'label'     => esc_html__( 'Number of Columns Tablet', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Slider number of columns in tablet. Default: 2', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'number',
                    'default'   => 2
                ),
                array(
                    'name'      => 'wpb_wps_items_mobile',
                    'label'     => esc_html__( 'Number of Columns Mobile', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Slider number of columns in mobile. Default: 1', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'number',
                    'default'   => 1
                ),
                array(
                    'name'      => 'wpb_slider_autoplay',
                    'label'     => esc_html__( 'Slider Auto Play', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                    'default'   => 'on'
                ),
                array(
                    'name'      => 'wpb_slider_loop',
                    'label'     => esc_html__( 'Slider Loop', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                    'default'   => 'on'
                ),
                array(
                    'name'      => 'wpb_slider_navigation',
                    'label'     => esc_html__( 'Slider Navigation', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                    'default'   => 'on'
                ),
                array(
                    'name'              => 'wpb_slider_slideby',
                    'label'             => esc_html__( 'Number of items to slide on Navigation click', WPB_WPS_TEXTDOMAIN ),
                    'desc'              => esc_html__( 'Navigation slide by x. "page" string can be set to slide by page. Default: 1', WPB_WPS_TEXTDOMAIN ),
                    'default'           => esc_html__( '1', WPB_WPS_TEXTDOMAIN ),
                    'type'              => 'text',
                ),
                array(
                    'name'      => 'wpb_slider_pagination',
                    'label'     => esc_html__( 'Slider Pagination', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                ),
                array(
                    'name'      => 'wpb_slider_pagination_number',
                    'label'     => esc_html__( 'Slider Pagination Number Counting', WPB_WPS_TEXTDOMAIN ),
                    'desc'      => esc_html__( 'Yes Please!', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'checkbox',
                ),

            ),
            'wpb_wps_style' => array(
				array(
                    'name'      => 'wpb_wps_primary_color',
                    'label'     => esc_html__( 'Primary Color', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'color',
                    'default'   => '#1abc9c'
                ),
				array(
                    'name'      => 'wpb_wps_primary_color_dark',
                    'label'     => esc_html__( 'Primary Color Dark', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'color',
                    'default'   => '#16a085'
                ),
                array(
                    'name'      => 'wpb_wps_primary_color_light',
                    'label'     => esc_html__( 'Primary Color Light', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'color',
                    'default'   => '#8BCFC2'
                ),
                array(
                    'name'      => 'wpb_wps_secondary_color',
                    'label'     => esc_html__( 'Secondary Color', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'color',
                    'default'   => '#999999'
                ),
				array(
                    'name'      => 'wpb_wps_secondary_color_light',
                    'label'     => esc_html__( 'Secondary Color Light', WPB_WPS_TEXTDOMAIN ),
                    'type'      => 'color',
                    'default'   => '#cccccc'
                )
            )
        );
		return $settings_fields;
    }
	
	// warping the settings
    function wpb_wps_plugin_page() {
        ?>
            <?php do_action ( 'wpb_wps_before_settings' ); ?>
            <div class="wpb_wps_settings_area">
                <div class="wrap wpb_wps_settings">
                    <?php
                        $this->settings_api->show_navigation();
                        $this->settings_api->show_forms();
                    ?>
                </div>
                <div class="wpb_wps_settings_content">
                    <?php do_action ( 'wpb_wps_settings_content' ); ?>
                </div>
            </div>
            <?php do_action ( 'wpb_wps_after_settings' ); ?>
        <?php
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }
        return $pages_options;
    }
}
endif;

$settings = new wpb_wps_lite_settings();