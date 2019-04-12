<?php
if ( ! defined( 'ABSPATH' ) ) { die( '-1' ); }
/*
 * Templatation.com
 *
 * VC integration
 *
 */

// Set VC as theme.
if( function_exists('vc_set_as_theme') ){
	function tt_temptt_vcAsTheme() {
		vc_set_as_theme(true);
	}
	add_action( 'vc_before_init', 'tt_temptt_vcAsTheme' );
}

// Initialize VC modules.

include( get_template_directory() . '/inc/integrations/visual-composer/tt_wa_gmap.php');
include( get_template_directory() . '/inc/integrations/visual-composer/tt_wa_contact_info.php');
include( get_template_directory() . '/inc/integrations/visual-composer/tt_wa_list.php');