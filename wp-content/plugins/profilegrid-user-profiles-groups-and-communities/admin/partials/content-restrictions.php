<?php
$path = plugin_dir_url(__FILE__);
?>
<div class="uimagic">
    <form name="pm_content_restriction" id="pm_content_restriction" method="post">
        <!-----Dialogue Box Starts----->
        <div class="content">
           
                <div class="uimheader">
                    <?php _e('Content Restrictions','profilegrid-user-profiles-groups-and-communities'); ?>
                </div>
    
        
            
            <div class="uimrow">
                
                <div class="update-nag">
                 <?php
                 _e('Content Restriction is build into ProfileGrid. To restrict content of a post or a page, scroll down while editing it, and you will find a ProfileGrid options box (see the image below).Tweak settings of this box to restrict the accessibility of post or page you are editing.','profilegrid-user-profiles-groups-and-communities');
                 ?>
                </div>
            </div>
            
            <div class="uimrow">
                <img class="pg-content-restriction-img" src="<?php echo $path.'images/pg-content-restrictions.jpg';?>"
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
