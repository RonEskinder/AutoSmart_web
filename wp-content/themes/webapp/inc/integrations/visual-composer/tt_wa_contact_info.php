<?php
if ( ! defined( 'ABSPATH' ) ) { die( '-1' ); }
/*
 * Templatation.com
 *
 * Block with icon on top for VC
 *
 */


function tt_wa_contact_info_shortcode_fn_vc() {

	vc_map(
		array(
			"icon" => 'tt-vc-block',
			"name" => esc_html__("WA Contact block", 'webapp'),
			"base" => "tt_wa_contact_info_shortcode",
			'description' => esc_html__( 'Block with icon, title and subtitle.', 'webapp' ),
			"category" => esc_html__('Webapp Theme', 'webapp'),
			"params" => array(

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Custom Icon Class', 'webapp' ),
                    'param_name' => 'icon_custom',
                    'value' => '',
                    'description' => esc_html__( 'This theme comes with some custom icon fonts. If you know class name, please enter here. Note that if you enter something here, below icon selection will make no difference. Font families included in theme are http://graphicburger.com/stroke-gap-icons-webfont/ Enter values like: stroke-icon icon-Users).', 'webapp' ),
                ),

                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'webapp' ),
                    'param_name' => 'icon_contact',
                    'value' => '', 
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'webapp' )
                ),

                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'webapp' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'value'       => '',
                ),

                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Description text', 'webapp' ),
                    'param_name'  => 'description',
                    'value'       => '',
                ),

			)
		)
	);
	
}
add_action( 'vc_before_init', 'tt_wa_contact_info_shortcode_fn_vc' );

if(class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_tt_wa_contact_info_shortcode extends WPBakeryShortCode {
	}
}