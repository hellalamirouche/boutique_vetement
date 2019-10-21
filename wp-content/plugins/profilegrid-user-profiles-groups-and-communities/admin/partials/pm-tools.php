<?php
global $wpdb;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
?>

<div class="uimagic">
  <div class="content pm_settings_option">
    <div class="uimheader">
      <?php _e( 'Tools','profilegrid-user-profiles-groups-and-communities' ); ?>
    </div>
    <div class="uimsubheader"> </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_export_users">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/export-users.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Export Users','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Exporting made super simple!','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
      </div>
    </a> 
    </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_import_users">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/import-users.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Import Users','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Different options to add users to your site from CSV file','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
      </div>
    </a> 
    </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_export_options">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/export-options.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Save Configuration','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Download plugin settings file.','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
      </div>
    </a> 
    </div>
    
    <div class="uimrow"> 
    <a href="admin.php?page=pm_import_options">
      <div class="pm_setting_image"> 
      	<img src="<?php echo $path;?>images/import-options.png" class="options" alt="options"> 
      </div>
      <div class="pm-setting-heading"> 
          <span class="pm-setting-icon-title"><?php _e( 'Load Configuration','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
          <span class="pm-setting-description"><?php _e( 'Upload plugin settings file.','profilegrid-user-profiles-groups-and-communities' ); ?></span> 
      </div>
    </a> 
    </div>
      
      <div class="buttonarea">
          <a href="admin.php?page=pm_settings">
              <div class="cancel">&#8592; &nbsp;
                  <?php _e('Back','profilegrid-user-profiles-groups-and-communities');?>
              </div>
          </a>
      </div>
      
  </div>
</div>