<?php
$path = plugin_dir_url(__FILE__);
$url = 'https://profilegrid.co/extensions/woocommerce-integration/';
?>
<div class="uimagic">
    <form name="pm_woocommerce_extension" id="pm_woocommerce_extension" method="post">
        <!-----Dialogue Box Starts----->
        <div class="content">
           
                <div class="uimheader">
                    <?php _e('Woocommerce Integration','profilegrid-user-profiles-groups-and-communities'); ?>
                </div>
    
        
            
            <div class="uimrow">
                
                <div class="update-nag">
                 <?php
                 echo sprintf(__('Display WooCommerce data beautifully inside User Profiles. Download our WooCommerce extension from <a target="_blank" href="%s">here.</a> ','profilegrid-user-profiles-groups-and-communities'),$url);
                 ?>
                </div>
            </div>
            
            <div class="uimrow">
                <img class="pg-woocommerce-extension-img" src="<?php echo $path.'images/pg-woocommerce-extension.png';?>"
            </div>

            <div class="buttonarea"> <a href="admin.php?page=pm_settings">
                    <div class="cancel">&#8592; &nbsp;
<?php _e('Cancel','profilegrid-user-profiles-groups-and-communities'); ?>
                    </div>
                </a>
                
            </div>
        </div>
</div>
    </form>
</div>
