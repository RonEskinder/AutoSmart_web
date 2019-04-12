<?php
/*
 * Templatation.com
 *
 * Banner with label slider for VC
 *
 */

function tt_wa_list_fn_vc()
{
    vc_map(
        array(
            "icon" => 'tt-vc-block',
            'name' => esc_html__('WA List', 'webapp'),
            'base' => 'tt_wa_list_shortcode',
            'description' => esc_html__('List box', 'webapp'),
            'as_parent' => array('only' => 'tt_wa_list_item_shortcode'),
            'content_element' => true,
            "js_view" => 'VcColumnView',
            "category" => esc_html__('Webapp Theme', 'webapp'),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Type of list', 'webapp'),
                    'param_name' => 'list',
                    'value' => array(
                        'List with icon' => 'type_1',
                        'List with number' => 'type_2',
                    )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('List column', 'webapp'),
                    'param_name' => 'list_col',
                    'value' => array(
                        '1 column' => 'col_1',
                        '2 column' => 'col_2',
                    )
                ),
            ),
        )
    );
}

add_action('vc_before_init', 'tt_wa_list_fn_vc');
// Nested Element
function tt_wa_list_item_fn_vc()
{
    vc_map(
        array(
            'name' => esc_html__('WA list Item', 'webapp'),
            'base' => 'tt_wa_list_item_shortcode',
            'description' => esc_html__('Item list', 'webapp'),
            "category" => esc_html__('Webapp Theme', 'webapp'),
            'content_element' => true,
            'as_child' => array('only' => 'tt_wa_list_shortcode'), // Use only|except attributes to limit parent (separate multiple values with comma)
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Name item', 'webapp'),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'value' => '',
                    'description' => esc_html__('Enter list name', 'webapp'),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Item color', 'webapp'),
                    'param_name' => 'itemcolor',
                    'value' => '',
                ),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Theme Specific Icon",'webapp'),
					"description" => sprintf( esc_html__( 'This theme comes with few specific icons. Enter their code. Keep it blank to use common icons chosen below. You can check theme custom icons list %1$s e.g. icon-Medal', 'webapp' ), '<a href="http://templatation.com/themesinclude/icons/Stroke-Gap-Icons/demo.html" target="_blank">'.esc_html__( 'Here', 'webapp' ).'</a>' ),
					"param_name" => "custom_icon",
					"value" => "",
			    ),
                array(
                    'type' => 'iconpicker',
                    'heading'     => esc_html__( 'Add icon, only works if you above field is blank.', 'webapp' ),
                    'param_name' => 'type_icon',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__('Icon color', 'webapp'),
                    'param_name' => 'iconcolor',
                    'value' => '',
                ),
            ),
        )
    );
}

add_action('vc_before_init', 'tt_wa_list_item_fn_vc');

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_tt_wa_list_shortcode extends WPBakeryShortCodesContainer
    {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_tt_wa_list_item_shortcode extends WPBakeryShortCode
    {

    }
}