<?php
/*
Plugin Name: Webapp Demo Content
Plugin URI: http://templatation.com/
Author: Templatation
Author URI: http://templatation.com/
Version: 1.0
Description: Adds a feature to import Webapp theme demo in Appearance > Theme setup wizard. Disable/delete from live site please.
Text Domain: templatation
*/

// Define Constants
defined('TT_ROOT')		or define('TT_ROOT', dirname(__FILE__));
defined('TT_VERSION')	or define('TT_VERSION', '1.0');

$tt_temptt_theme = wp_get_theme();
$tt_temptt_currtheme = strtolower( preg_replace( '#[^a-zA-Z]#', '', $tt_temptt_theme->get( 'Name' ) ) );
if( strpos($tt_temptt_currtheme,'child') ) {
    $tt_temptt_currtheme = strtolower( preg_replace( '#[^a-zA-Z]#', '', $tt_temptt_theme->get( 'Template' ) ) );
}
// Only do stuff if correct theme is activated.
if( 'webapp' == $tt_temptt_currtheme ) {

    require_once TT_ROOT .'/inc/envato_setup/envato_setup.php';
    require_once TT_ROOT .'/inc/envato_setup/envato_setup_init.php';

    //change theme name below to correct theme name.
    add_filter('webapp_theme_setup_wizard_username', 'webapp_set_theme_setup_wizard_username', 10);
    if( ! function_exists('webapp_set_theme_setup_wizard_username') ){
        function webapp_set_theme_setup_wizard_username($username){
            return 'templatation';
        }
    }

    add_filter('webapp_theme_setup_wizard_oauth_script', 'webapp_set_theme_setup_wizard_oauth_script', 10);
    if( ! function_exists('webapp_set_theme_setup_wizard_oauth_script') ){
        function webapp_set_theme_setup_wizard_oauth_script($oauth_url){
            return 'http://templatation.com/envato/api/server-script.php';
        }
    }

}