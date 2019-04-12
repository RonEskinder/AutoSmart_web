<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* Load the files for theme, with support for overriding the widget via a child theme.
/*-----------------------------------------------------------------------------------*/

include_once get_template_directory(). '/inc/theme-essentials.php';   // Theme Essentials
include_once get_template_directory(). '/inc/theme-options.php';      // Theme options
include_once get_template_directory(). '/inc/theme-functions.php';    // Custom theme functions
include_once get_template_directory(). '/inc/theme-metabox.php';      // Theme Metaboxes
include_once get_template_directory(). '/inc/theme-widgets.php';      // Theme widgets
include_once get_template_directory(). '/inc/theme-comments.php';     // Theme comments

/**
 * TGM class for plugin includes.
 */
if( is_admin() ){
	if (!( class_exists( 'TGM_Plugin_Activation' ) ))
		include( get_template_directory() . '/inc/tgm-activation/tt-plugins.php');
}

/**
 * Content Width
 */

if ( ! isset( $content_width ) )
	$content_width = 1140;


/**
 * VC integration
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
  include_once get_template_directory(). '/inc/integrations/visual-composer/vc-init.php';
}


/* WPML integration
 */
if ( function_exists('icl_object_id') ) {
  define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
}

/**
 * Basic Theme Setup
 */

if ( ! function_exists( 'tt_webapp_theme_setup' ) ) {

	function tt_webapp_theme_setup() {

		// Load the translations
		load_theme_textdomain( 'webapp', get_template_directory() . '/lang' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Add admin editor style.
		add_editor_style( 'inc/editor-style.css' );

		// Add custom background support.
		add_theme_support( 'custom-background', array( 'default-color' => 'ffffff' ) );

		// Enable Post Thumbnails ( Featured Image )
		add_theme_support( 'post-thumbnails' );

		// Title tag support
		add_theme_support( 'title-tag' );

		// Register Navigation Menus
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'webapp' ),
		) );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );
		add_image_size( 'tt-blog', 700, 400, true );
	}

} add_action( 'after_setup_theme', 'tt_webapp_theme_setup' );

