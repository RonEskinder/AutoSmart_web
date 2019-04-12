<?php
/*
Plugin Name: Webapp Plugin
Plugin URI: http://templatation.com
Author: Templatation
Author URI: http://templatation.com
Version: 1.1
Description: Includes Portfolio Custom Post Type and Visual Composer Shortcodes
Text Domain: webapp
*/

// Define Constants
defined('EF_ROOT')		or define('EF_ROOT', dirname(__FILE__));

if(!class_exists('webapp_Plugins')) {

	class webapp_Plugins {

		private $assets_js;

		public function __construct() {
			$this->assets_js	= plugins_url('/composer/js', __FILE__);
			$this->assets_css   = plugins_url('/composer/css', __FILE__);
			add_action('admin_init', array($this, 'webapp_load_map'));
			add_action( 'admin_print_scripts-post.php', array($this, 'vc_enqueue_scripts'), 99);
			add_action( 'admin_print_scripts-post-new.php', array($this, 'vc_enqueue_scripts'), 99);
			$this->webapp_load_shortcodes();
		}


		public function webapp_load_map() {
			if(class_exists('Vc_Manager')) {
				require_once( EF_ROOT .'/'. 'composer/map.php');
				require_once( EF_ROOT .'/'. 'composer/init.php');
			}
		}

		public function webapp_load_shortcodes() {

			foreach( glob( EF_ROOT . '/'. 'shortcodes/webapp_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'shortcodes/'. basename( $shortcode ) );
			}
			foreach( glob( EF_ROOT . '/'. 'shortcodes/vc_*.php' ) as $shortcode ) {
				require_once(EF_ROOT .'/'. 'shortcodes/'. basename( $shortcode ) );
			}

		}

		public function vc_enqueue_scripts() {
			wp_enqueue_script( 'vc-script', $this->assets_js .'/vc-script.js' ,  array('jquery'), '1.0.0', true );
			wp_enqueue_style( 'rs-vc-custom', $this->assets_css. '/vc-style.css' );
		}

	} // end of class

	new webapp_Plugins;
} // end of class_exists

//Include redux framework
if ( ! class_exists( 'Redux' && ! empty( $tt_temptt_components['theme_options'] ) ) ) {
	include dirname(__FILE__) . '/inc/redux/admin-init.php';
}

//Include CS framework
if ( ! class_exists( 'CSFramework' && ! empty( $tt_temptt_components['metaboxes'] ) ) ) {
	include dirname(__FILE__) . '/inc/cs-framework/cs-framework.php';
}
