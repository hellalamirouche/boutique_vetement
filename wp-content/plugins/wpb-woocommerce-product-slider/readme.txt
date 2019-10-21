=== WPB WooCommerce Product Slider ===
Contributors: wpbean
Tags: woocommerce product slider, woocommerce product gallery slider, woocommerce product slider plugin, woocommerce product slider plugin free, woocommerce featured product slider, woocommerce widget product slider, woocommerce featured products slider, multiple product slider, on sale product carousel, product, product carousel, product content slider, woocommerce product slider plugin free, product contents carousel, product rotator, product slider, products slider, responsive product slider, woo slider, woocommerce, woocommerce product carousel, WooCommerce Products, woocommerce products slider, woocommerce slider, carousel, woocommerce image slider, woocommerce responsive slider, woocommerce advance slider, best woocommerce product slider, easy woocommerce product slider, woocommerce slider free, woocommerce slider plugin, slider for woocommerce, woocommerce category slider, product slider carousel for woocommerce, woocommerce product slider and carousel plugin
Requires at least: 4.0
Tested up to: 5.2.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WPB WooCommerce Product slider is most popular & best free WooCommerce product slider plugin.

== Description ==

WPB WooCommerce product slider comes with two different themes for different style product slider for your WooCommerce shop. It can show latest, featured, category, tags and selected products slider. With this plugin's shortcode you can show the product slider anywhere on you site. It has custom widgets for showing products slider in the sidebar and settings to customize the product slider. It's mobile responsive. Its features make this plugin number one free WooCommerce product slider.

We have thousands of active install of this plugin. If you are thinking to build a shopping site using WooCommerce, then WPB WooCommerce Product slider plugin is most required to you for taking your conversion rate to the next level.


>[Upgrade to the Pro Version Now!&raquo;](https://wpbean.com/downloads/wpb-woocommerce-product-slider-pro/)  |  [DEMO](http://demo1.wpbean.com/wpb-woocommerce-product-slider-pro/)  |  [Support](http://wpbean.com/support/) |  [Documentation](http://docs.wpbean.com/docs/wpb-woocommerce-products-slider-free-version/installing/)


### Plugin Features:

* Featured products slider.
* Latest products slider.
* Category products slider.
* Tag products slider.
* Products slider by selected product ids.
* Two different custom themes for slider.
* Control slider columns for phone, tab, small screen.
* Slider autoplay, loop, pagination, navigation enable or disable option.
* Product rating, price and cart enable or disable option.
* Flat, responsive and modern design.
* Shortcode System
* Advance setting panel.
* Custom widget for easy use in sidebar areas.
* Product order & orderby. 
* All modern browser support.
* Build with HTML5 & CSS3.
* RTL language support.
* Translation ready. 
* Works with all WordPress Themes.
* Easy and user-friendly setup.
* Online Documentation.
* Very Lightweight & many more.

### Pro version features:

* Six different themes for different slider style with theme style customizer. See the demo.
* Product slider from specific categories of products. Include or exclude categories.
* Product slider from specific tags of products. Include or exclude tags.
* Product slider from specific selected products.
* Product slider for specific products by product SKU.
* Product slider from product attribute and attribute values.
* Product slider for on sell products.
* Product slider for best selling products.
* Product slider based on a keyword search.
* Product Slider by Author IDs.
* Product Slider by Product date query. 
* Amazing new shortcode builder with all necessary options.
* Visual Composer custom element.
* Enable or disable option for the title, category, price, review, even add to cart button also.
* Shortcode attribute for product image height & width.
* Product image crop on the fly.
* Option for remove out of stock products from slider.
* YITH WooCommerce quick view, compare and wish list plugin’s support added.
* Priority support.
* Video Documentation.


### PRO version new features:

https://www.youtube.com/watch?v=bCD6kexPsOI

### PRO version video documentation:

https://www.youtube.com/watch?v=abgnW7wN5pY&feature=youtu.be


### You may also like our some other WooCommerce plugins

>[WPB WooCommerce Related Products Slider](https://wordpress.org/plugins/wpb-woocommerce-related-products-slider/)  |  [Woocommerce Image Zoom](https://wordpress.org/plugins/woocommerce-image-zoom/)  |  [WooCommerce LightBox](https://wordpress.org/plugins/woocommerce-lightbox/) |  [WooCommerce Custom Tab Manager](https://wordpress.org/plugins/wpb-woocommerce-custom-tab-manager/) |  [WooCommerce Category Slider](https://wordpress.org/plugins/wpb-woocommerce-category-slider/)

== Installation ==

* Install it as a regular WordPress plugin

* Before install the plugin make sure you have WooCommerce plugin installed already. 

Method 1 (Upload):

1. Go to your Wordpress admin then go to Plugins > Add new > Upload

2. Then select the installable file fom you download folder.

3. Upload and active the plugin and you are ready to go.

Method 2 (FTP):

1. Upload the plugin to your server plugin directory and make sure you don't upload the zip file.

2. Then go back to your Wordpress admin and go to Plugins > Installed Plugins

3. If you successfully upload the plugin You will find WPB WOO Product Slider here.

4. Active the plugin and you are ready to go.

>[Details documentation](http://docs.wpbean.com/docs/wpb-woocommerce-products-slider-free-version/installing/)


== Frequently asked questions ==

= What's the shortcode for this plugin? =
Default shortcode is [wpb-product-slider] , this shortcode accepts some parameters. Follow the documentation.

= How to change the slider products image size? =
By default, our slider just calls the WooCommerce product loop thumbnail template. That means it's the same size as your shop page products image. So if your theme has WooCommerce support you should able to change the image size from theme customizer. You can follow this [article](https://atlantisthemes.com/woocommerce-single-product-image/ "How To Change Woocommerce Product Image Size") for details.

Or you can use our plugin filter hook to change it. For using this filter you have to add a parameter (woo_image) in our product slider shortcode.
Here is an example of the shortcode - 
> `[wpb-product-slider posts="12" autoplay="true" woo_image="false"]`

After adding the woo_image with its value false, add [this](https://gist.github.com/wpbean/65ada51b5e6f11acb3c716a416ebffaf "WPB WooCommerce Product Slider (Free version) image size change") PHP code on your theme functions.php file. Add your own image size on the code.

== Screenshots ==
1. WPB Woocommerce Product Slider output
2. WPB Woocommerce Product Slider general settings
3. WPB Woocommerce Product Slider slider settings
4. WPB Woocommerce Product Slider style settings
5. WPB Woocommerce Product Slider widget
6. WPB Woocommerce Product Slider shortcode in page

== Changelog ==

= version 2.0.7.6 =
* New shortcode perimeter added for disabling slider loop.

= version 2.0.7.5 =
* New filter hook (wpb_wps_product_archive_thumbnail_size) added for image size changing.

= version 2.0.7.4 =
* New ShortCode parameter (woo_image) added for showing older image. 

= version 2.0.7.3 =
* Small style issue fixed.
* WooCommerce default loop image function used for showing slider image.

= version 2.0.7.2 =
* Small issue fixed.

= version 2.0.7.1 =
* Added WordPress 5.2 and WooCommerce 3.6.2 support.

= version 2.0.6.9 =
* Added WordPress 5.1.1 and WooCommerce 3.6.1 support.

= version 2.0.6.8 =
* Added WordPress 5.0.2 and WooCommerce 3.5.3 support.
* Gutenberg compatibility added.

= version 2.0.6.7 =
* Added WordPress 4.9.8 and WooCommerce 3.4.4 support

= version 2.0.6.6 =
* Added WordPress 4.9.6 and WooCommerce 3.4.0 support

= version 2.0.6.5 =
* Added WordPress 4.9.6 and WooCommerce 3.3.5 support.

= version 2.0.6.4 =
* WooCommerce 3.3.3 support added.

= version 2.0.6.3 =
* WooCommerce 3.3.1 support added.

= version 2.0.6.1 =
* WooCommerce 3.0 featured products & Cart button fixed.

= version 2.0.6 =
* Samll issue fixed for pagination number counting.

= version 2.0.5 =
* Slider pagination number counting feature added.
* slide to move on naivation click, or slide per page feature added. 

= version 2.0.4 =
* Product title linked to the product details.
* Add to cart button enable/disable issue fixed.

= version 2.0.3 =
* It's a massive update. Rebuild the plugin.
* ShortCode updated.
* Widget updated.
* Settings updated.
* Documentation updated.
* Owl Carousel version updated to latest version.
* Bunch of new features added.

= version 2.0.2 =
* Added WooCommerce 3.0 support.

= version 2.0.1 =
* Added WordPress 4.7 support.

= version 2.0 =
* Added translation support.

= version 1.0.9 =
* WordPress 4.6 compatible.

= version 1.0.7 =
* Documentation updated.

= version 1.0.4 =
* Feature products slider widget's bug  fixed.

= version 1.0.3 =
* More lighter then before.
* Some small bug fixed.
* Clean up all codes.
* Remove unnecessery files & codes.
* WordPress 4.4.1 & WooCommerce 2.5.1 compatibility tested.

= version 1.0.1 =
* Fixed a small bug.

= version 1.0 =
* Initial release
