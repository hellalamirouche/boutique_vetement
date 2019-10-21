<?php
/*
Plugin Name: Delete Duplicate Posts
Plugin Script: delete-duplicate-posts.php
Plugin URI: https://cleverplugins.com
Description: Remove duplicate blogposts on your blog! Searches and removes duplicate posts and their post meta tags. You can delete posts, pages and other Custom Post Types enabled on your website.
Version: 4.2.1
Author: cleverplugins.com
Author URI: https://cleverplugins.com
Min WP Version: 4.7
Max WP Version: 5.1
Text Domain: delete-duplicate-posts
Domain Path: /languages



== Changelog ==

= 4.2.1 = 
* Direct link to support forum
* Fixed missing file in 3rd party SDK.

= 4.2 =
* Fix - the limitation on how many posts were deleted per batch did not always work, it does not.
* PHP notices removed from the log thank you @brianbrown

= 4.1.9.5 =
* Security fix

= 4.1.9.4 =
* Two more intervals added to list for automatic cleaning- every 5 minutes and every minute.

= 4.1.9.3 =
* Fixed bugs introduced with updating to WordPress 4.9.1 - Thank you to all who reported the problem.

= 4.1.9.2 =
* Fixed esc_sql() for WordPress 4.8.3

= 4.1.9.1 =
* Fix missing 3rd party scripts.

= 4.1.9 =
* Optimized delete routines - Thank you Claire and Vaclav :-) Up to 20-30% faster deleting.
* Added timing functions so you can see how long it takes to delete in the log.
* Permanently delete posts and pages - no longer goes to trash.
* Fix - The log is now shown with latest events at top.
* Updated 3rd party scripts - Freemius update 1.2.1.7.1 to 1.2.2.9

= 4.1.8 =
* Updated Freemius SDK.
* Fixing problem with keeping latest or oldests posts.

= 4.1.7 =
* Fixed PHP Notification - Logs were not automatically cleaned.

= 4.1.6 =
* Fixed missing icon
* Listed freemius as contributer

= 4.1.5 =
* Fixing PHP Warning if no post types selected

= 4.1.3 =
* Fixed a mistake in Freemius configuration :-/

= 4.1.2 =
* Added language .pot file
* Improved Danish translation
* Added Fremius for more usage details - Opt-in

= 4.1.1 =
* Fix PHP notices
* Clean up code comments
* Logo now in Retina
* Minor text changes

= 4.1 =
* Fixes which kinds of posts that can be cleaned- Thanks Mark
* Option up from max 250 posts to 500 - Thanks Mark.
* Improved visual style in the table listing.

= 4.0.2 =
* Fixes problem with cron job not working properly.
* New: Choose interval for automated cron job to run.
* Adds 3 cron interval 10 min, 15 min and 30 minutes to WordPress.
* Minor PHP Notice fix.
* Code cleaning up


= 4.0.1 =
* Added log notes for cron jobs and manual cleaning.
* Added missing screenshots, banners and icons.

= 4.0 =
* Big rewrite, long overdue, many bugs fixed
* NEW: Choose between post types.
* Optional cron job now runs every hour, not every half hour.
* The log was broken, it has now been fixed.
* Removed unused and old code.
* Improved plugin layout.

*/

// Create a helper function for easy SDK access.
function ddp_fs() {
	global $ddp_fs;

	if ( ! isset( $ddp_fs ) ) {
				// Include Freemius SDK.
		require_once dirname(__FILE__) . '/freemius/start.php';

		$ddp_fs = fs_dynamic_init( array(
			'id'                  => '925',
			'slug'                => 'delete-duplicate-posts',
			'type'                => 'plugin',
			'public_key'          => 'pk_0af9f9e83f00e23728a55430a57dd',
			'is_premium'          => false,
			'has_addons'          => false,
			'has_paid_plans'      => false,
			'menu'                => array(
				'slug'           => 'delete-duplicate-posts.php',
				'parent'         => array(
					'slug' => 'tools.php',
				),
			),
		) );
	}

	return $ddp_fs;
}

// Init Freemius.
ddp_fs();
// Signal that SDK was initiated.
do_action( 'ddp_fs_loaded' );


require  dirname(__FILE__) . '/vendor/persist-admin-notices-dismissal/persist-admin-notices-dismissal.php';

function ddp_action_admin_notices() {
	if ( ! PAnD::is_admin_notice_active( 'ddp-leavereview-14' ) ) {
		return;
	}
	$screen = get_current_screen();

	if ($screen->id<>'tools_page_delete-duplicate-posts') {
		return;
	}

	$pretotal = get_option('ddp_deleted_duplicates');

	if  (( $pretotal !== false ) && ($pretotal>0)) {

		?>
		<div data-dismissible="ddp-leavereview-14" class="updated notice notice-success is-dismissible">
			<?php
			echo '<h3>'.$pretotal.' duplicates deleted</h3>'; 
			?>
			<p><?php 
			printf( __( "Hey, I noticed this plugin has deleted %s duplicate posts for you - that's awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.", 'delete-duplicate-posts'), $pretotal )
			?></p>
			<ul>
				<li>
					<a href="https://wordpress.org/support/plugin/delete-duplicate-posts/reviews/?rate=5#new-post" target="_blank"><?php _e('Leave a review', 'delete-duplicate-posts'); ?></a>
				</li>
<?php
/*
				<li>
					<a href="#" class="dismiss-notice"><?php _e('Maybe later', 'delete-duplicate-posts'); ?></a>
				</li>
*/
	?>
			</ul>
		</div>
		<?php
	}// over 0

	?>

	<?php
}
add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'ddp_action_admin_notices' );


function ddp_fs_custom_connect_message_on_update(
	$message,
	$user_first_name,
	$plugin_title,
	$user_login,
	$site_link,
	$freemius_link
) {
	return sprintf(
		__( 'Hey %1$s' ) . ',<br>' .
		__( 'Please help us improve %2$s! If you opt-in, some data about your usage of %2$s will be sent to %5$s. If you skip this, that\'s okay! %2$s will still work just fine.', 'delete-duplicate-posts' ),
		$user_first_name,
		'<b>' . $plugin_title . '</b>',
		'<b>' . $user_login . '</b>',
		$site_link,
		$freemius_link
	);
}

ddp_fs()->add_filter('connect_message_on_update', 'ddp_fs_custom_connect_message_on_update', 10, 6);

if (!class_exists('delete_duplicate_posts')) {
	class delete_duplicate_posts {
		var $optionsName 				= 'delete_duplicate_posts_options_v4';
		var $localizationDomain = "delete-duplicate-posts";
		var $options 						= array();

		function __construct(){
			$locale = get_locale();
			$mo = dirname(__FILE__) . "/languages/" . 'delete-duplicate-posts' . "-".$locale.".mo";
			load_plugin_textdomain( 'delete-duplicate-posts', FALSE,  dirname( __FILE__ )  . '/languages/' );
			add_action('admin_head', array(&$this, 'set_custom_help_content'), 1, 2); // loads help tab
			$this->getOptions();

			add_action("admin_menu", array(&$this,"admin_menu_link"));
			add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));
			register_activation_hook(__FILE__,array(&$this,"install")); // TODO - register deactivation hooks
			add_action('ddp_cron', array(&$this,"cleandupes"));
			add_action('cron_schedules', array(&$this,"add_cron_intervals"));
		}


		function timerstart($watchname) {
			set_transient('ddp_' . $watchname, microtime(true), 60 * 60 * 1);
		}

		function timerstop($watchname, $digits = 3) {
			$return = round(microtime(true) - get_transient('ddp_' . $watchname), $digits);
			delete_transient('ddp_' . $watchname);
			return $return;
		}


		function cleandupes($manualrun='0') {
			$this->timerstart('ddp_totaltime'); // start total timer
			$this->getOptions();
			$this->options['ddp_running']=TRUE;

			if ($manualrun=='0') {
				$this->log(__('Cron job running.','delete-duplicate-posts'));
			}
			else {
				$this->log(__('Manually cleaning.','delete-duplicate-posts'));
			}

			global $wpdb;
			$table_name = $wpdb->prefix . "posts";
			$limit=$this->options['ddp_limit'];
				if (!$limit<>'') $limit=50; //defaults to 10!
				//if ($manualrun=='1') $limit=9999;
				$order=$this->options['ddp_keep'];
				if (($order<>'oldest') AND ($order<>'latest')) { // verify default value has been set.
					$this->options['ddp_keep']='oldest';
				}

				if ($order=='oldest') $minmax="MIN(id)";
				if ($order=='latest') $minmax="MAX(id)";
				// get custom post types and loop for query.
				$ddp_pts_arr = $this->options['ddp_pts'];
				if ($ddp_pts_arr) {
					$ddp_pts = '';
					foreach ($ddp_pts_arr as $key => $dpa ) {
						$ddp_pts .= '"'.$dpa.'",';
					}
				}
				else {
					$ddp_pts = '';
				}
				$ddp_pts = rtrim($ddp_pts,',' );

				if ( $ddp_pts <> '' ) {
					$query="select bad_rows.ID, bad_rows.post_title, post_type
					from $table_name as bad_rows
					inner join (
					select post_title,id, ".$minmax." as save_this_post_id
					from $table_name
					WHERE (
					`post_status` = 'publish'
					AND
					`post_type` in (".$ddp_pts.")
					)
					group by post_title
					having count(*) > 1
					) as good_rows on good_rows.post_title = bad_rows.post_title
					and good_rows.save_this_post_id <> bad_rows.id
					and (bad_rows.post_status='publish' OR bad_rows.post_status='draft')
					order by post_title,id
					limit $limit
					;";
				}

				$dupes = $wpdb->get_results($query);
				$dupescount = count($dupes);
				$resultnote='';
				$dispcount=0;

				if ($dupes) {
					foreach ($dupes as $dupe) {
						$postid=$dupe->ID;


						$title=substr($dupe->post_title,0,35);

						if ($postid<>''){
							$this->timerstart('deletepost_'.$postid);
							$result = wp_delete_post($postid, true); // LARS ADD "TRUE" Param ssss
							$timespent = $this->timerstop('deletepost_'.$postid);
							if (!$result) {
								$this->log(sprintf( __( "Error, problem deleting %s '%d'", 'delete-duplicate-posts'), $dupe->post_type, $postid));
							}
							else {
								$dispcount++;
								$pretotal = get_option('ddp_deleted_duplicates');
								if ( $pretotal !== false ) {
									$pretotal++;
									update_option('ddp_deleted_duplicates',$pretotal);
								}
								else {
									update_option('ddp_deleted_duplicates',1);
								}

								$this->log(sprintf( __( "Deleted %s '%s' (id: %s) in %s sec.", 'delete-duplicate-posts'), $dupe->post_type, $title, $postid, $timespent ));
							}
						}
					} // foreach ($dupes as $dupe)
				} // if ($dupes)


				if ($dispcount>0) {
					$totaltimespent = $this->timerstop('ddp_totaltime',0);
					$this->log(sprintf( __( "A total of %s duplicate posts were deleted in %s sec.", 'delete-duplicate-posts'), $dispcount, $totaltimespent));

					if ($manualrun>0) {
						?>
						<div class="notice notice-success"> 
							<p><?php
							printf( __( "A total of %s duplicate posts were deleted.", 'delete-duplicate-posts'), $dispcount)
							?></p>
						</div>
						<?php
					} // manualrun

				}


				// Mail logic...
				if (($dispcount>0) &&($manualrun=='1') && ($this->options['ddp_statusmail'])) {

					$adminemail = get_option('admin_email'); // get admins email

					$blogurl = site_url();

					$messagebody = sprintf( __( "Hi Admin, I have deleted <strong>%d</strong> posts on your blog, %s.<br><br><em>You are receiving this e-mail because you have turned on e-mail notifications by the plugin, Delete Duplicate Posts.</em>",'delete-duplicate-posts'), $dispcount, $blogurl);

					$messagebody .= "<br>Made by <a href='https://cleverplugins.com' target='_blank'>cleverplugins.com</a>";
					$headers = "From: $blogurl <$adminemail>" . "\r\n";
					$mailstatus = wp_mail($adminemail, __('Deleted Duplicate Posts Status','delete-duplicate-posts'), $messagebody, $headers);

					if ($mailstatus) {
						$this->log(sprintf( __( "Status email sent to %s.", 'delete-duplicate-posts'), $adminemail));
					}
				}
				$this->options['ddp_running']=FALSE;
			}

			function add_cron_intervals($schedules) {
				$schedules['1min'] = array(
					'interval' => 60,
					'display' => __('Every minute','delete-duplicate-posts')
				);
				$schedules['5min'] = array(
					'interval' => 300,
					'display' => __('Every 5 minutes','delete-duplicate-posts')
				);
				$schedules['10min'] = array(
					'interval' => 600,
					'display' => __('Every 10 minutes','delete-duplicate-posts')
				);
				$schedules['15min'] = array(
					'interval' => 900,
					'display' => __('Every 15 minutes','delete-duplicate-posts')
				);
				$schedules['30min'] = array(
					'interval' => 1800,
					'display' => __('Every 30 minutes','delete-duplicate-posts')
				);
				return $schedules;
			}

			function log($text) {
				global $wpdb;
				$ddp_logtable = $wpdb->prefix . "ddp_log";
				$result = $wpdb->query( $wpdb->prepare(
					"
					INSERT INTO $ddp_logtable
					( datime, note )
					VALUES ( %s, %s )
					",
					current_time('mysql'),
					$text
				) );
				$total = (int) $wpdb->get_var("SELECT COUNT(*) FROM `$ddp_logtable`;");
				if ($total>1000) {
					$targettime = $wpdb->get_var("SELECT `datime` from `$ddp_logtable` order by `datime` DESC limit 500,1;");
					$query="DELETE from `$ddp_logtable`  where `datime` < '$targettime';";
					$success= $wpdb->query ($query);
				}
			}

			function admin_enqueue_scripts() {
				$screen = get_current_screen();
				if (is_object($screen) && ($screen->id == 'tools_page_delete-duplicate-posts') ) {
					wp_enqueue_style('ddpcss', plugins_url('/css/delete-duplicate-posts.css', __FILE__));
				}
			}

			function install () {
				global $wpdb;
				require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
				$table_name = $wpdb->prefix . "ddp_log";
				if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
					$sql = "CREATE TABLE $table_name (
					id bigint(20) NOT NULL AUTO_INCREMENT,
					datime timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
					note tinytext NOT NULL,
					PRIMARY KEY (id)
				);";
				dbDelta($sql);
			}
			$this->saveAdminOptions();
			wp_clear_scheduled_hook('ddp_cron'); // deactivate it just in case it was turned on.
			$this->log(__( "Plugin activated.", 'delete-duplicate-posts'));
		}

		function getOptions() {
			if (get_option('delete_duplicate_posts_options')) {
				delete_option('delete_duplicate_posts_options'); // Clean old version to allow default values to be set.
			}

			if (!$theOptions = get_option($this->optionsName)) {
				$theOptions = array('ddp_running'=>'false');
				update_option($this->optionsName, $theOptions);
			}
			$this->options = $theOptions;

		}

		function saveAdminOptions(){
			return update_option($this->optionsName, $this->options);
		}

		function admin_menu_link() {
			add_management_page('Delete Duplicate Posts', 'Delete Duplicate Posts', 'manage_options', basename(__FILE__), array(&$this,'admin_options_page'));
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'filter_plugin_actions'), 10, 2 ); // Adds the Settings link to the plugin page
		}

		function filter_plugin_actions($links, $file) {
			$settings_link = '<a href="tools.php?page=' . basename(__FILE__) . '">' . __('Settings','delete-duplicate-posts') . '</a>';
			array_unshift( $links, $settings_link ); // before other links
			return $links;
		}

		function set_custom_help_content() {
			$screen = get_current_screen();

			if ($screen->id == 'tools_page_delete-duplicate-posts') {
				$screen->add_help_tab(array( 'id'      => 'ddp_help',
					'title'   => __('Usage and FAQ','delete-duplicate-posts'),
					'content' => "
					<h4>".__('What does this plugin do?','delete-duplicate-posts')."</h4>
					<p>".__('Helps you clean duplicate posts from your blog. The plugin checks for blogposts on your blog with the same title.','delete-duplicate-posts')."</p>
					<p>".__("It can run automatically via WordPress's own internal CRON-system, or you can run it automatically.",'delete-duplicate-posts')."</p>
					<p>".__('It also has a nice feature that can send you an e-mail when Delete Duplicate Posts finds and deletes something (if you have turned on the CRON feature).','delete-duplicate-posts')."</p>
					<h4>".__('Help! Something was deleted that was not supposed to be deleted!','delete-duplicate-posts')."</h4>
					<p>".__('I am sorry for that, I can only recommend you restore the database you took just before you ran this plugin.','delete-duplicate-posts')."</p>
					<p>".__('If you run this plugin, manually or automatically, it is at your OWN risk!','delete-duplicate-posts')."</p>
					<p>".__('I have done my best to avoid deleting something that should not be deleted, but if it happens, there is nothing I can do to help you.','delete-duplicate-posts')."</p>
					<p><a href='https://cleverplugins.com' target='_blank'>cleverplugins.com</a>.</p>"
				)
			);
			}
		}


		function admin_options_page() {

		// DELETE NOW
			if ( (isset($_POST['deleteduplicateposts_delete'] ) ) AND (isset($_POST['_wpnonce'] ) ) )  {
				if  (wp_verify_nonce($_POST['_wpnonce'], 'ddp-clean-now')){
				$this->cleandupes(1); // use the value 1 to indicate it is being run manually.
			}
		}

		// RUN NOW!!
		if(isset($_POST['ddp_runnow'])){
			if (! wp_verify_nonce($_POST['_wpnonce'], 'ddp-update-options') ) die(__('Whoops! Some error occured, try again, please!','delete-duplicate-posts'));
		}


		// SAVING OPTIONS
		if  (isset($_POST['delete_duplicate_posts_save'])){
			if (! wp_verify_nonce($_POST['_wpnonce'], 'ddp-update-options') ) {
				die(__('Whoops! There was a problem with the data you posted. Please go back and try again.','delete-duplicate-posts'));
			}

				//echo "<pre>".print_r($_POST,true)."</pre>"; // debug
			$posttypes = array();

			if (isset($_POST['ddp_pts'])) {
				$optionArray = $_POST['ddp_pts'];
					//$posttypes = $_POST['ddp_pts'];
				for ($i=0; $i<count($optionArray); $i++) {
					$posttypes[] = sanitize_text_field($optionArray[$i]);
				}
			}

			if (isset($_POST['ddp_enabled'])) $this->options['ddp_enabled'] = ($_POST['ddp_enabled']=='on')?true:false;
			$this->options['ddp_statusmail'] = ( (isset($_POST['ddp_statusmail'])) && ($_POST['ddp_statusmail']=='on'))?true:false;
			$this->options['ddp_schedule'] = sanitize_text_field($_POST['ddp_schedule']);
			$this->options['ddp_keep'] = sanitize_text_field($_POST['ddp_keep']);
			$this->options['ddp_pts'] = $posttypes;
			$this->options['ddp_limit'] = sanitize_text_field($_POST['ddp_limit']);
			if (isset($this->options['ddp_enabled'])) {
				wp_clear_scheduled_hook('ddp_cron');
				$interval = $this->options['ddp_schedule'];
				if (!$interval) $interval = 'hourly';
				wp_schedule_event(time(), $interval, 'ddp_cron');
				$nextscheduled = wp_next_scheduled('ddp_cron');
			}

			$this->saveAdminOptions();
			echo '<div class="updated fade"><p>'.__('Your changes were successfully saved.','delete-duplicate-posts').'</p></div>';
		}

		// CLEARING THE LOG
		if(isset($_POST['ddp_clearlog'])) {
			if (! wp_verify_nonce($_POST['_wpnonce'], 'ddp_clearlog_nonce') ) die(__('Whoops! Some error occured, try again, please!','delete-duplicate-posts'));
			global $wpdb;
			$table_name_log = $wpdb->prefix . "ddp_log";
			$wpdb->query ("TRUNCATE `$table_name_log`;");
			echo '<div class="updated"><p>'.__('The log was cleared.','delete-duplicate-posts').'</p></div>';
			unset($wpdb);
		}

		global $wpdb;

		$table_name = $wpdb->prefix . "posts";

		$pluginfo=get_plugin_data(__FILE__);
		$version=$pluginfo['Version'];
		$name=$pluginfo['Name'];
		?>
		<div class="wrap">
			<h2>Delete Duplicate Posts</h2>
			<div class="notice notice-info">

				<a href="https://cleverplugins.com" target="_blank" style="float: right;"><img src='<?php echo plugin_dir_url(__FILE__); ?>cleverpluginslogo.png' height="54" width="300" alt="<?php _e('Visit cleverplugins.com','delete-duplicate-posts'); ?>"></a>
				<p>Have you checked out our free SEO Booster plugin? <a href="https://wordpress.org/plugins/seo-booster/" target="_blank">wordpress.org/plugins/seo-booster/</a><br/>
					<p>Read more on <a href="https://cleverplugins.com/">cleverplugins.com</a> or <a href="<?php echo admin_url('plugin-install.php?s=seo+booster+cleverplugins.com&tab=search&type=term'); ?>" target="_blank">click here to install now</a></p>
				</div>


				<div id="dashboard">

					<?php


					if ($this->options['ddp_enabled'] ) {
						$nextscheduled = wp_next_scheduled('ddp_cron');
						if (!$nextscheduled<>'') { // plugin active, but the cron needs to be activated also..
							wp_clear_scheduled_hook('ddp_cron');
							$interval = $this->options['ddp_schedule'];
							if (!$internal) $interval = 'hourly';
							wp_schedule_event(time(), $internal, 'ddp_cron');
							$nextscheduled = wp_next_scheduled('ddp_cron');
						}
					}
					else {
						wp_clear_scheduled_hook('ddp_cron');
					}

					// get custom post types and loop for queary.
					$ddp_pts_arr = $this->options['ddp_pts'];

					if ((isset($ddp_pts_arr)) && (is_array($ddp_pts_arr)) ) {
						$ddp_pts = '';
						foreach ($ddp_pts_arr as $key => $dpa ) {
							$ddp_pts .= '"'.$dpa.'",';
						}
					}
					else {
						$ddp_pts = '';
					}

					$ddp_pts = rtrim($ddp_pts,',' );

					$order=$this->options['ddp_keep'];

				if (($order<>'oldest') AND ($order<>'latest')) { // verify default value has been set.
					$this->options['ddp_keep']='oldest';
				}

				if ($order=='oldest') $minmax="MIN(id)";
				if ($order=='latest') $minmax="MAX(id)";


				if ($ddp_pts<>'') {

					$query="select bad_rows.ID, bad_rows.post_title, post_type
					from $table_name as bad_rows
					inner join (
					select post_title,id, ".$minmax." as save_this_post_id
					from $table_name
					WHERE (
					`post_status` = 'publish'
					AND
					`post_type` in (".$ddp_pts.")
					)
					group by post_title
					having count(*) > 1
					) as good_rows on good_rows.post_title = bad_rows.post_title
					and good_rows.save_this_post_id <> bad_rows.id
					and (bad_rows.post_status='publish' OR bad_rows.post_status='draft')
					order by post_title,id;";
				}


//var_dump($query);

				$dupes = $wpdb->get_results($query);
				$dupescount = count($dupes);


				$pretotal = get_option('ddp_deleted_duplicates');



				if ($dupescount) {

					?>
					<div class="statusdiv">
						<h3><?php
						echo sprintf( __('I have discovered %d duplicate posts', 'delete-duplicate-posts'), $dupescount); ?></h3>
						<?php
						$plugurl = WP_CONTENT_URL . '/plugins/' .plugin_basename(__FILE__) ;
						?>
						<table class="wp-list-table widefat fixed striped posts" cellspacing="0">
							<thead>
								<tr>
									<th><?php _e('ID','delete-duplicate-posts'); ?></th>
									<th><?php _e('Title','delete-duplicate-posts'); ?></th>
									<th><?php _e('Post Type','delete-duplicate-posts'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($dupes as $dupe) {
									$postid=$dupe->ID;
									$title=substr($dupe->post_title,0,120);
									echo "<tr>
									<td>".$postid."</td>
									<td><a href='".get_permalink($postid)."' target='_blank'>".$title."</a>
									</td>
									<td>".$dupe->post_type."</td>
									</tr>";
								}
								?>
							</tbody>
						</table>
						<p class="warning"><?php _e('We recommend you always make a backup before running this tool. Changes are permanent!','delete-duplicate-posts');?></p>
						<form method="post" id="ddp_runcleannow">
							<?php wp_nonce_field('ddp-clean-now'); ?>
							<p align="center"><input type="submit" name="deleteduplicateposts_delete" class="button-primary" value="<?php _e('Delete duplicates','delete-duplicate-posts'); ?>" /></p>
							<?php
							$limit=$this->options['ddp_limit'];
							echo '<p class="center">'.sprintf( __( "Deletes %s per click.", 'delete-duplicate-posts'), $limit).'</p>';
							?>
							<p>
							</form>
						</div>
						<hr>
						<?php
					} // if ($dupescount)
				else { // no dupes found!
					?>
					<div class="statusdiv">
						<h3><?php _e('You have no duplicate posts right now.','delete-duplicate-posts');?></h3>
						<p>
							<?php
							$nextscheduled = wp_next_scheduled('ddp_cron');

							if ($nextscheduled) echo '<p class="cronstatus center">'.__('You have enabled CRON, so I am running on automatic. I will take care of everything...','delete-duplicate-posts').'</p>';

							if ($nextscheduled) {
								echo '<p class="center">'.sprintf( __( "Next automated check %s. Current time %s", 'delete-duplicate-posts'), date_i18n(get_option('date_format').' '.get_option('time_format'),$nextscheduled), date_i18n(get_option('date_format').' '.get_option('time_format'),time()) ).'</p>';
							}
							?>
						</p>
					</div>
					<?php
				}
				?>
			</div>
			<div id="configuration">
				<h3><?php _e('Settings', 'delete-duplicate-posts'); ?></h3>

				<form method="post" id="delete_duplicate_posts_options">
					<?php wp_nonce_field('ddp-update-options'); ?>
					<table width="100%" cellspacing="2" cellpadding="5" class="form-table">

						<tr valign="top">
							<th><label for="ddp_enabled"><?php _e('Which post types?:', 'delete-duplicate-posts'); ?></label></th>
							<td>
								<?php
								$builtin = array(
									'post',
									'page',
									'attachment'
								);
								$args = array(
									'public'   => true,
									'_builtin' => false
								);
								$output = 'names'; // names or objects, note names is the default
								$operator = 'and'; // 'and' or 'or'
								$post_types = get_post_types( $args, $output, $operator );
								$post_types = array_merge($builtin, $post_types);
								$checked_post_types = $this->options['ddp_pts'];
								if ($post_types) {
									?>
									<ul class="radio">
										<?php
										$step=0;
										if (!is_array($checked_post_types)) $checked_post_types = array();
										foreach ($post_types as $pt) {
											$checked = array_search($pt,$checked_post_types,true);
											?>
											<li>
												<input type="checkbox" name="ddp_pts[]" id="ddp_pt-<?php echo $step;?>" value="<?php echo $pt; ?>" <?php if ($checked !== false) echo ' checked';?>/>
												<label for="ddp_pt-<?php echo $step; ?>"><?php echo $pt; ?></label>
											</li>
											<?php
											$step++;
										}
										?>
									</ul>
									<?php
								}
								?>
							</td>
						</tr>

						<tr valign="top">
							<th><label for="ddp_enabled"><?php _e('Enable automatic deletion?:', 'delete-duplicate-posts'); ?></label></th><td><input type="checkbox" id="ddp_enabled" name="ddp_enabled" <?php if ($this->options['ddp_enabled']==true) echo 'checked="checked"' ?>>
								<p><em><?php _e('Clean duplicates automatically. Runs every hour.', 'delete-duplicate-posts'); ?></em></p>
							</td>
						</tr>


						<tr>
							<th><label for="ddp_schedule"><?php _e('How often?:', 'delete-duplicate-posts'); ?></label></th><td>

								<select name="ddp_schedule" id="ddp_schedule">
									<?php
									$schedules = wp_get_schedules();
									if ($schedules) {
										foreach ($schedules as $key => $sch) {
											?>
											<option value="<?php echo $key; ?>" <?php if ($this->options['ddp_schedule']==$key) echo 'selected="selected"'; ?>><?php echo $sch['display']; ?></option>
											<?php
										}
									}
									?>
								</select>
								<p><em><?php _e('How often should the cron job run?', 'delete-duplicate-posts'); ?></em></p>
							</td>
						</tr>


						<tr>
							<th><label for="ddp_keep"><?php _e('Delete which posts?:', 'delete-duplicate-posts'); ?></label></th><td>

								<select name="ddp_keep" id="ddp_keep">
									<option value="oldest" <?php if ($this->options['ddp_keep']=='oldest') echo 'selected="selected"'; ?>><?php _e('Keep oldest post','delete-duplicate-posts'); ?></option>
									<option value="latest" <?php if ($this->options['ddp_keep']=='latest') echo 'selected="selected"'; ?>><?php _e('Keep latest post','delete-duplicate-posts'); ?></option>
								</select>


								<p><em><?php _e('Keep the oldest or the latest version of duplicates? Default is keeping the oldest, and deleting any subsequent duplicate posts', 'delete-duplicate-posts'); ?></em></p>
							</td>
						</tr>
						<tr>
							<th><label for="ddp_statusmail"><?php _e('Send status mail?:', 'delete-duplicate-posts'); ?></label></th><td><input type="checkbox" id="ddp_statusmail" name="ddp_statusmail" <?php if ($this->options['ddp_statusmail']==true) echo 'checked="checked"'; ?>>
								<p><em><?php _e('Sends a status email if duplicates have been found.', 'delete-duplicate-posts'); ?></em></p>
							</td>
						</tr>
						<tr valign="top">
							<th><label for="ddp_limit"><?php _e('Delete at maximum :', 'delete-duplicate-posts'); ?></label></th><td><select name="ddp_limit">
								<?php
								for($x = 1; $x <= 10; $x++) {
									$val=($x*50);
									echo "<option value='$val' ";
									if ($this->options['ddp_limit']==$val) echo "selected";
									echo ">$val</option>";
								}
								?>
							</select>
							<?php _e('duplicates.', 'delete-duplicate-posts'); ?>
							<p><em><?php _e('Setting a limit is a good idea, especially if your site is on a busy server.', 'delete-duplicate-posts'); ?></em></p>
						</td>
					</tr>
					<th colspan=2><input type="submit" class="button-primary" name="delete_duplicate_posts_save" value="<?php _e('Save Settings', 'delete-duplicate-posts'); ?>" /></th>
				</tr>

			</table>

		</form>
	</div>



	<div id="log">

		<h3><?php _e('The Log', 'delete-duplicate-posts'); ?></h3>
		<textarea rows="16" class="large-text" name="ddp_log" id="ddp_log"><?php
		$table_name_log = $wpdb->prefix . "ddp_log";
		$query = "SELECT * FROM `".$table_name_log."` order by `id` DESC";
		$loghits = $wpdb->get_results($query, ARRAY_A);
		if ($loghits){
			foreach ($loghits as $hits) {
				echo $hits['datime'].' '.$hits['note']."\n";
			}
		}

		?></textarea>
		<p>
			<form method="post" id="ddp_clearlog">
				<?php wp_nonce_field('ddp_clearlog_nonce'); ?>

				<input class="button-secondary" type="submit" name="ddp_clearlog" value="<?php _e('Reset log','delete-duplicate-posts'); ?>" />
			</form>
		</p>

	</div>
</div>
<?php
}


	} //End Class
}

if (class_exists('delete_duplicate_posts')) {
	$delete_duplicate_posts_var = new delete_duplicate_posts();
}
?>