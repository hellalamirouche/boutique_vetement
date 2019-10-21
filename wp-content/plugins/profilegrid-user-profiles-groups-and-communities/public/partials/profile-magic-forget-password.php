<?php
global $wpdb;
$textdomain = $this->profile_magic;
$path =  plugin_dir_url(__FILE__);
$pmrequests = new PM_request;
$pm_error = '';
// Retrieve possible errors from request parameters
$attributes['errors'] = array();

if ( isset( $_REQUEST['errors'] ) ) {
    $error_codes = explode( ',', $_REQUEST['errors'] ); 
    foreach ( $error_codes as $error_code ) 
	{
        $attributes['errors'][]=  $pmrequests->profile_magic_get_error_message($error_code,$textdomain);
    }
}

if ( count( $attributes['errors'] ) > 0 )
{
	foreach ( $attributes['errors'] as $error )
	{
		$pm_error .= '<span>'.$error.'</span>';
	}
}
if(isset($_REQUEST['key']) && isset($_REQUEST['login']))
{
   
    $attributes['login'] = $_REQUEST['login'];
    $attributes['key'] = $_REQUEST['key'];
    // Error messages
    $errors = array();
    if ( isset( $_REQUEST['error'] ) ) 
    {
            $error_codes = explode( ',', $_REQUEST['error'] );
            foreach ( $error_codes as $code ) 
            {
                    $errors []= $pmrequests->profile_magic_get_error_message($code,$this->profile_magic);
            }
    }
    $attributes['errors'] = $errors;
    
    if ( count( $attributes['errors'] ) > 0 )
    {
            foreach ( $attributes['errors'] as $error )
            {
                    $pm_error .= '<span>'.$error.'</span>';
            }
    }
                 
    $themepath = $this->profile_magic_get_pm_theme('password-reset-form-tpl');
}
else
{
    $themepath = $this->profile_magic_get_pm_theme('forget-password-form-tpl');
}
include $themepath;
?>
