<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$path =  plugin_dir_url(__FILE__);
$textdomain = $this->profile_magic;
$pg_function = new Profile_Magic_Basic_Functions($this->profile_magic, $this->version);
?>

<div class="pmagic">
    

    <div class="pg-scblock "> 

        <div class="pg-scblock pg-scpagetitle">
            <img src="<?php echo $path; ?>images/pg-icon.png">
            <b><?php _e("ProfileGrid",'profilegrid-user-profiles-groups-and-communities'); ?></b> <span class="pg-blue"><?php _e("Extensions",'profilegrid-user-profiles-groups-and-communities'); ?></span>
        </div> 
        <div class="pg-exts-bundle-banner dbfl"><a href="https://profilegrid.co/extensions/" target="_blank"><img src="<?php echo $path; ?>images/extensions-bundle-banner.jpg" class="" alt=""></a></div>
        <div class="pg-ext-list" id="the-list">

            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a href="http://profilegrid.co/extensions/" class=" open-plugin-details-modal" target="_blank">
                               <?php _e('Group Wall','profilegrid-user-profiles-groups-and-communities');?>

                            <img src="<?php echo $path; ?>images/pg-groupwall.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                           <?php $pg_function->pg_get_extension_button('GROUPWALL');?>
                        </ul></div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("A brand new ProfileGrid extension that adds social activity to your User Groups. Now users can create new posts, comment on other users' posts and browse Group timeline. Group wall is accessible from Group page as a new tab.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            
             <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                               <?php _e('Stripe Payment System','profilegrid-user-profiles-groups-and-communities');?>

                            <img src="<?php echo $path; ?>images/stripe-logo.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('STRIPE');?>
                        </ul>
                    </div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e('Start accepting credit cards on your site for Group memberships and registrations by integrating popular Stripe payment gateway.','profilegrid-user-profiles-groups-and-communities');?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                               <?php _e("User Display Name","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/display_name.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('DISPLAY_NAME');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Now take complete control of your users' display names. Mix and match patterns and add predefined suffixes and prefixes. There's a both global and per group option allowing display names in different groups stand out!","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
                 <div class="plugin-card pg-ext-card ">
        
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a href="http://profilegrid.co/extensions/" class="open-plugin-details-modal">
                               <?php _e("Group Photos","profilegrid-user-profiles-groups-and-communities");?> 

                            <img src="<?php echo $path; ?>images/group-photos.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('GROUP_PHOTOS');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Allow your users to create and share Photo Albums within their Groups. There's also an option for public photos. Users can enlarge and comment on different photos. ","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a href="http://profilegrid.co" target="_blank"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("Custom Profile Slugs","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/userid_slug.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('CUSTOM_PROFILE_SLUG');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Define how your user profile URL's will appear to site visitors and search engines. Take control of your user profile permalinks and add dynamic slugs.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                            <?php _e("Custom Group Fields","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/group-custom-fields.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('CUSTOM_GROUP_FIELDS');?>
                        </ul>			</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Create and add custom fields to groups too! Now your user groups can have more detailed information and personality just like your user profile pages.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("Geolocation","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/geolocation.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('GEOLOCATION');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Generate maps showing locations of all users or specific groups using simple shortcodes. Get location data from registration form.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("Frontend Group Creator","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/frontend-group.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('FRONTEND_GROUP');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Allow registered users to create new Groups on front end. These Groups behave and work just like regular ProfileGrid groups.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            
              
            
            
            
            
                <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/" style="text-transform:none;">
                           <?php _e("bbPress INTEGRATION","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/bbpress.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                       <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('BBPRESS');?>
                        </ul>			</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Integrate ProfileGrid user profile properties and sign up system with the ever popular bbPress community forums plugin.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                            <?php _e("WooCommerce Integration","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/pg-woocommerce.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('WOOCOMMERCE');?>
                        </ul>					</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Combine the power of ProfileGrid's user groups with WooCommerce cart to provide your users ultimate shopping experience.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions">
                            <?php _e("MailChimp Integration","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/pg-mailchimp.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('MAILCHIMP');?>
                        </ul>					</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Assign ProfileGrid users to MailChimp lists with custom field mapping and options for users to manage subscriptions.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
      
           <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("Social Login","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/social-connect.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('SOCIALLOGIN');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Allow your users to sign up and login using their favourite social network accounts. Social accounts can be managed from Profile settings.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("Custom Profile Tabs","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/custom-profile-tab.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('CUSTOM_TAB');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Add personalized tabs in user profiles to suit your business or industry. Add user authored content from any custom post type or shortcode (or add specific content) with different privacy levels. Open doors to endless possibilities - Integrate user profiles with other plugins supporting custom post or shortcode format.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                    </div>
                </div>

            </div>
            
            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("Frontend Group Manager","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/frontend-group-manager.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('FRONTEND_GROUP_MANAGER');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Offer more power and control to your Group Managers. They can edit Groups, approve membership requests, moderate blogs, manage users, etc. from a dedicated frontend Group management area.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                        <p>&nbsp;</p>
                    </div>
                </div>

            </div>
            
            
             <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("ProfileGrid Advanced WooCommerce Integration","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/pg-woo-advanced-icon.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('ADVANCED_WOOCOMMERCE');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Enhance the power of ProfileGrid's integration with WooCommerce by adding in integrations with WooCommerce extensions.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                        <p>&nbsp;</p>
                    </div>
                </div>

            </div>

            <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/">
                              <?php _e("ProfileGrid Multi Group Managers","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/multi-admins.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('MULTI_ADMINS');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Don't stay limited to just one Manager per Group. Unlock the ability to have more than one Managers for your ProfileGrid User Groups now. With all of them sharing the same level of control.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                        <p>&nbsp;</p>
                    </div>
                </div>

            </div>
            
             <div class="plugin-card pg-ext-card">
                <div class="plugin-card-top">
                    <div class="name column-name">
                        <h3>
                            <a target="_blank"  href="http://profilegrid.co/extensions/" style="text-transform: none;">
                              <?php _e("myCRED INTEGRATION","profilegrid-user-profiles-groups-and-communities");?>

                            <img src="<?php echo $path; ?>images/pg-mycred-integration.png" class="plugin-icon" alt="">
                            </a>
                        </h3>
                    </div>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <?php $pg_function->pg_get_extension_button('MYCRED');?>
                        </ul>				</div>
                    <div class="desc column-description">
                        <p class="pg-col-desc"><?php _e("Integrate popular points system for WordPress with ProfileGrid to reward your users. Display ranks and badges on user profile pages, give incentive for activities on site or penalize based on pre-set rules.","profilegrid-user-profiles-groups-and-communities");?></p>
                        <p class="authors"> <cite><?php _e('By','profilegrid-user-profiles-groups-and-communities');?> <a target="_blank" href="http://profilegrid.co"><?php _e('ProfileGrid','profilegrid-user-profiles-groups-and-communities');?></a></cite></p>
                        <p>&nbsp;</p>
                    </div>
                </div>

            </div>

        </div>


    </div>


</div>
