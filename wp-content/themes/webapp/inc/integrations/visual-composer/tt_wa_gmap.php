<?php
if ( ! defined( 'ABSPATH' ) ) { die( '-1' ); }
/*
 * Templatation.com
 *
 *Image with info for VC
 *
 */


function tt_wa_map_shortcode_fn_vc() {

	vc_map(
		array(
			"icon" => 'tt-vc-block',
			"name" => esc_html__("WA Google map", 'webapp'),
			"base" => "tt_wa_map_shortcode",
			'description' => esc_html__( 'Google map (with marker).', 'webapp' ),
            "category" => esc_html__('Webapp Theme', 'webapp'),
			"params" => array(

	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Latitude', 'webapp' ),
	                'description'     => esc_html__( 'Google map Latitude', 'webapp' ),
	                'param_name'  => 'latitude',
	                'value'       => '-37.812802'
	            ),

	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Longitude', 'webapp' ),
	                'description'     => esc_html__( 'Google map Longitude', 'webapp' ),
	                'param_name'  => 'longitude',
	                'value'       => '144.956981'
	            ),

				 array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Custom Marker Image', 'webapp' ),
                    'param_name' => 'marker',
                    'value' => '',
                    'description' => esc_html__( 'Note marker only appears if you put something in Marker text below. Width and Height should be less than 80px', 'webapp' ),
                ),

	            array(
	                'type'        => 'textfield',
	                'heading'     => esc_html__( 'Map zoom', 'webapp' ),
	                'param_name'  => 'zoom',
	                'description' => 'Map zooming value. Max # 19, Min # 0.',
	                'value'       => 12
	            ),

                array(
                    'type'       => 'textarea',
                    'heading'    => esc_html__( 'Marker text', 'webapp' ),
                    'description'    => esc_html__( 'This block appears when clicked on Marker image, you can enter your address here. If left empty, marker icon too will not show, if you want only marker to show, please use VC default gMap module.', 'webapp' ),
                    'holder'     => 'div',
                    'param_name' => 'marker_text'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Map Height', 'webapp' ),
                    'description'    => esc_html__( 'By default, height of the  map is 400px , enter if you want custom height. Note: Enter without px, eg: 500.', 'webapp' ),
                    'param_name' => 'map_height'
                )
			)
		)
	);
	
}
add_action( 'vc_before_init', 'tt_wa_map_shortcode_fn_vc' );

if(class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_tt_wa_map_shortcode extends WPBakeryShortCode {
	}
}