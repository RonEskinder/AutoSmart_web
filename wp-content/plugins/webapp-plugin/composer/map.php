<?php
/**
  * WPBakery Visual Composer Shortcodes settings
  *
  * @package VPBakeryVisualComposer
  *
 */

include_once( EF_ROOT . '/composer/params.php' );

// ==========================================================================================
// SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Modern image slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_modern_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Slider item', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_slider_item',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'as_child' => array( 'only' => 'webapp_modern_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'param_name' => 'image'
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Background style', 'js_composer' ),
                    'param_name' => 'text_style',
                    'value'      => array(
                        'Light' => 'dark',
                        'Dark'  => 'light'
                    )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Image title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea_html',
                    'heading'    => __( 'Image text', 'js_composer' ),
                    'holder'     => 'div',
                    'param_name' => 'content'
                ),
            )
        )
    );

    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_modern_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_slider_item extends WPBakeryShortCode {
        }
    }

// ==========================================================================================
// TESTIMONIALS SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Testimonials slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_testimonials_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_testimonials_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Testimonials slider item', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_testimonials_slider_item',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'as_child' => array( 'only' => 'webapp_testimonials_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'param_name' => 'images',
                    'description' => 'Select image of the author. Recommended 170x170 px.'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Author', 'js_composer' ),
                    'param_name' => 'author',
                    'description' => 'Author name.',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Position', 'js_composer' ),
                    'param_name' => 'position',
                    'description' => 'Position of the Author.',
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Text', 'js_composer' ),
                    'param_name' => 'testimonials',
                    'description' => 'Content of this testimonial.',
                ),
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Testimonials_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Testimonials_Slider_Item extends WPBakeryShortCode {
        }
    }

// ==========================================================================================
// VIDEO SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Video slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_video_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_video_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'description'             => __( 'Accordians Wrapper', 'js_composer' ),
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Video slider item', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_video_slider_item',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'as_child' => array( 'only' => 'webapp_video_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'param_name' => 'images'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title bold', 'js_composer' ),
                    'param_name' => 'titlebold'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Youtube id', 'js_composer' ),
                    'param_name' => 'link'
                ),
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Video_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Video_Slider_Item extends WPBakeryShortCode {
        }
    }
// ==========================================================================================
// Banner SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Banner slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_banner_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_banner_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'description'             => __( 'Accordians Wrapper', 'js_composer' ),
            'js_view'                 => 'VcColumnView',
            'params'   => array(

                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Speed of Slide', 'js_composer' ),
                    'param_name' => 'slidespeed',
                    'default' => '500',
                    "admin_label" => true,
                    'description' => 'The speed of slide transition in milisecond. eg for 1 second enter 1000.'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Delay of Slide', 'js_composer' ),
                    'param_name' => 'slidedelay',
                    'default' => '500',
                    "admin_label" => true,
                    'description' => 'The time particular slide is visible, before switching to next. in milliseconds. eg for 1 second enter 1000.'
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Hide button?', 'js_composer' ),
                    'default'    => 'false',
                    'param_name' => 'hide_button',
                    'value'      => array( __( 'Hide the navigation buttons of the slider. Please do not check this unless you only have 1 slide. Otherwise there is no way to go to next slide.', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Disable loop?', 'js_composer' ),
                    'default'    => 'false',
                    'param_name' => 'disable_dataloop',
                    'value'      => array( __( 'By default, slides are rotated in a loop. But if you want to stop on the end slide. Check this.', 'js_composer' ) => 'yes' )
                ),
            )
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Banner slider item', 'js_composer' ),
            'category' => __( 'Webapp Theme', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_banner_slider_item',
            'as_child' => array( 'only' => 'webapp_banner_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Background image', 'js_composer' ),
                    'param_name' => 'images',
                    'description' => 'This image appears in the background of the slide.'
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'param_name' => 'images2',
                    'description' => 'This image appears on the bottom middle of slide.'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                    'description' => 'Main title of slide.'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title bold', 'js_composer' ),
                    'param_name' => 'titlebold',
                    'description' => 'This adjoins to above title in Bold.'
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Subtitle', 'js_composer' ),
                    'param_name' => 'subtitle'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Text on button', 'js_composer' ),
                    'param_name' => 'i_text',
                    'value'      => '',

                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button link', 'js_composer' ),
                    'param_name' => 'link',
                    'value'      => ''
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color', 'js_composer' ),
                    'param_name' => 't_color'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Button background color', 'js_composer' ),
                    'param_name' => 'bg_color'
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon', 'templatation' ),
                    'param_name'  => 'i_class',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Text on button2', 'js_composer' ),
                    'param_name' => 'i_text2',
                    'value'      => '',
                    'description'      => 'Do you want another button ? If yes, enter its details below.'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button link2', 'js_composer' ),
                    'param_name' => 'link2',
                    'value'      => ''
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color2', 'js_composer' ),
                    'param_name' => 't_color2'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Button background color2', 'js_composer' ),
                    'param_name' => 'bg_color2'
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon 2', 'templatation' ),
                    'param_name'  => 'i_class2',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Banner_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Banner_Slider_Item extends WPBakeryShortCode {
        }
    }
// ==========================================================================================
// ONE IMAGE SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Single image slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_one_image_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_one_image_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Single image slider item', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_one_image_slider_item',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'as_child' => array( 'only' => 'webapp_one_image_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'description'    => __( 'Select image for this slide.', 'js_composer' ),
                    'param_name' => 'image',
                     "admin_label" => true,
               )
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_One_image_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_One_image_Slider_Item extends WPBakeryShortCode {
        }
    }
// ==========================================================================================
// FULLWIDTH SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Tour slider', 'js_composer' ),
            'description'             => __( 'Used in Tour page, Image/Text slider.', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_fullwidth_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_fullwidth_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Tour slider item', 'js_composer' ),
            'category' => __( 'Webapp Theme', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_fullwidth_slider_item',
            'as_child' => array( 'only' => 'webapp_fulwidth_slider' ),
            'params'   => array(

                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Subtitle', 'js_composer' ),
                    'param_name' => 'subtitle'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color', 'js_composer' ),
                    'param_name' => 't_color'
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'description'    => __( 'This image appears on the bottom of the slide.', 'js_composer' ),
                    'param_name' => 'image',
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Background image', 'js_composer' ),
                    'description'    => __( 'This image used as a background of this slide.', 'js_composer' ),
                    'param_name' => 'bg_image'
                )
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Fullwidth_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Fullwidth_Slider_Item extends WPBakeryShortCode {
        }
    }

// ==========================================================================================
// ITEMS SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Tour image slider', 'js_composer' ),
            'description'                    => __( 'Slider w/ image & title/description.', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_items_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_items_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA image block slider item', 'js_composer' ),
            'category' => __( 'Webapp Theme', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_items_slider_item',
            'as_child' => array( 'only' => 'webapp_items_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'description'    => __( 'Select image for this slide.', 'js_composer' ),
                    'param_name' => 'image'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'description'    => __( 'Select Title for this slide.', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Subtitle', 'js_composer' ),
                    'description'    => __( 'Select Subtitle for this slide.', 'js_composer' ),
                    'param_name' => 'subtitle',
                    'value'      => ''
                )
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Items_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Items_Slider_Item extends WPBakeryShortCode {
        }
    }

// ==========================================================================================
// VERTICAL SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Vertical slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_vertical_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_vertical_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'description'             => __( 'Vertical slider with left image and content', 'js_composer' ),
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA vertical slider item', 'js_composer' ),
            'category' => __( 'Webapp Theme', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_vertical_slider_item',
            'as_child' => array( 'only' => 'webapp_vertical_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image phone1', 'js_composer' ),
                    'param_name' => 'images',
                    'description' => 'Select first image for the slide.'

                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image phone2', 'js_composer' ),
                    'param_name' => 'images2',
                    'description' => 'Select second image for the slide.(optional).'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea_html',
                    'heading'    => __( 'Description', 'js_composer' ),
                    'param_name' => 'content'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Text on button', 'js_composer' ),
                    'param_name' => 'i_text',
                    'value'      => '',
                    'description' => 'If you would like button, enter its title text.'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button link', 'js_composer' ),
                    'param_name' => 'link',
                    'value'      => ''
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color', 'js_composer' ),
                    'param_name' => 't_color'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Button background color', 'js_composer' ),
                    'param_name' => 'bg_color'
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon', 'templatation' ),
                    'param_name'  => 'i_class',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Text on button2', 'js_composer' ),
                    'param_name' => 'i_text2',
                    'value'      => '',
                    'description' => 'If you want additional button, enter its title and below settings.'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button link2', 'js_composer' ),
                    'param_name' => 'link2',
                    'value'      => ''
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color2', 'js_composer' ),
                    'param_name' => 't_color2'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Button background color2', 'js_composer' ),
                    'param_name' => 'bg_color2'
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon 2', 'templatation' ),
                    'param_name'  => 'i_class2',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Vertical_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Vertical_Slider_Item extends WPBakeryShortCode {
        }
    }

// ==========================================================================================
// VERTICAL IMAGE WITH TEXT SLIDER                                        -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Vertical Slider 2', 'js_composer' ),
            'description'                    => __( 'Vertical slider with image in middle.', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_vertical_image_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_vertical_image_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Vertical slider 2 item', 'js_composer' ),
            'category' => __( 'Webapp Theme', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_vertical_image_slider_item',
            'as_child' => array( 'only' => 'webapp_vertical_image_slider' ),
            'params'   => array(

                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon', 'templatation' ),
                    'param_name'  => 'icon',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon color', 'js_composer' ),
                    'param_name' => 'i_color'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Left side Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Left side content', 'js_composer' ),
                    'param_name' => 'l_content'
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'param_name' => 'image'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Right side Title', 'js_composer' ),
                    'param_name' => 'r_title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Right side Title span', 'js_composer' ),
                    'param_name' => 'r_title_span'
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Right side content', 'js_composer' ),
                    'param_name' => 'r_content'
                )
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Vertical_image_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Vertical_image_Slider_Item extends WPBakeryShortCode {
        }
    }

// ==========================================================================================
// PAYMENT SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Container slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_payment_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_payment_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'description'             => __( 'Slider inside green container.', 'js_composer' ),
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Slider background color', 'js_composer' ),
                    'description'    => __( 'This color used as a background of the container for the slide.', 'js_composer' ),
                    'param_name' => 'bg_color'
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Slider background image', 'js_composer' ),
                    'description'    => __( 'This image used as a background of whole row.', 'js_composer' ),
                    'param_name' => 'image'
                )
            )
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Container slider item', 'js_composer' ),
            'category' => __( 'Webapp Theme', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_payment_slider_item',
            'as_child' => array( 'only' => 'webapp_payment_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'description'    => __( 'Select image for this slide.', 'js_composer' ),
                    'param_name' => 'images'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title Bold', 'js_composer' ),
                    'description'    => __( 'This part of title appears as Bold', 'js_composer' ),
                    'param_name' => 'title_span',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'description'    => __( 'This part of title appears normal. It adjoins above title.', 'js_composer' ),
                    'param_name' => 'title',
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Content', 'js_composer' ),
                    'description'    => __( 'Text for this slide.', 'js_composer' ),
                    'param_name' => 'text'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color', 'js_composer' ),
                    'param_name' => 't_color'
                )
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Payment_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Payment_Slider_Item extends WPBakeryShortCode {
        }
    }

// ==========================================================================================
// HELP SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA Help slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_help_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_help_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'description'             => __( 'FAQ slider', 'js_composer' ),
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Help slider item', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_help_slider_item',
            'as_child' => array( 'only' => 'webapp_help_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'description'    => __( 'Cover image for this slide.', 'js_composer' ),
                    'param_name' => 'image'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'description'    => __( 'Title for this slide.', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Content', 'js_composer' ),
                    'description'    => __( 'Description of this slide.', 'js_composer' ),
                    'param_name' => 'text'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color', 'js_composer' ),
                    'param_name' => 't_color'
                )
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Help_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Help_Slider_Item extends WPBakeryShortCode {
        }
    }
// ==========================================================================================
// SALE SLIDER                                                                                   -
// ==========================================================================================
    vc_map(
        array(
            'name'                    => __( 'WA slider w/ CTA/button', 'js_composer' ),
            'description'                    => __( 'Used on Pricing page', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'webapp_sale_slider',
            'category'                => __( 'Webapp Theme', 'js_composer' ),
            'as_parent'               => array( 'only' => 'webapp_sale_slider_item' ),
            'content_element'         => true,
            'show_settings_on_create' => false,
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        )
    );
    vc_map(
        array(
            'name'     => __( 'WA Sale slider item', 'js_composer' ),
            'category' => __( 'Webapp Theme', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_sale_slider_item',
            'as_child' => array( 'only' => 'webapp_sale_slider' ),
            'params'   => array(
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image', 'js_composer' ),
                    'param_name' => 'image'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Sale Title', 'js_composer' ),
                    'description'    => __( 'This text appears before the price.', 'js_composer' ),
                    'param_name' => 'title',
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Price', 'js_composer' ),
                    'param_name' => 'price'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Price color', 'js_composer' ),
                    'param_name' => 'p_color'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Slide Title', 'js_composer' ),
                    'param_name' => 'item',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Slide bold title.', 'js_composer' ),
                    'description'    => __( 'This adjoins the above title in Bold.', 'js_composer' ),
                    'param_name' => 'item_span'
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Slide description', 'js_composer' ),
                    'param_name' => 'item_d'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Description text color', 'js_composer' ),
                    'param_name' => 't_color'
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add button?', 'js_composer' ),
                    'param_name' => 'add_button',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button text', 'js_composer' ),
                    'param_name' => 'button_t',
                    'dependency' => array( 'element' => 'add_button', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button link', 'js_composer' ),
                    'param_name' => 'link',
                    'dependency' => array( 'element' => 'add_button', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Button background color', 'js_composer' ),
                    'param_name' => 'button_color',
                    'dependency' => array( 'element' => 'add_button', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add icon to button?', 'js_composer' ),
                    'param_name' => 'add_icon',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
                    'dependency' => array( 'element' => 'add_button', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon', 'templatation' ),
                    'param_name'  => 'icon',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'dependency'  => array(
                        'element' => 'add_icon',
                        'value'   => array( 'yes' )
                    )
                ),
            )
        )
    );
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_webapp_Sale_Slider extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_webapp_Sale_Slider_Item extends WPBakeryShortCode {
        }
    }
// ==========================================================================================
// VIDEO                                                                           -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Youtube Video', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_video_demonstration',
            'description' => __( 'Can use as separator', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Youtube id', 'js_composer' ),
                    'param_name' => 'youtube',
                    'description' => 'Enter youtube video ID. Here is how to find ID https://www.youtube.com/watch?v=EKyirtVHsK0 . For other video sources, Use Video Player component instead.'
                )
            )
        )
    );

// ==========================================================================================
// Testimonial Item                                                                                -
// ==========================================================================================
    vc_map(
        array(
            'name'     => __( 'WA Testimonial item', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_testimonial_item',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'params'   => array(

                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Author Photo', 'js_composer' ),
                    'param_name' => 'image',
                    'description' => 'Add image for this testimonial author.'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Name', 'js_composer' ),
                    'param_name'  => 'name',
                    'value'       => '',
                    'description' => __( 'Author name', 'js_composer' ),
                    "admin_label" => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Position', 'js_composer' ),
                    'param_name'  => 'position',
                    'value'       => '',
                    'description' => __( 'Job position', 'js_composer' )
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Text', 'js_composer' ),
                    'param_name'  => 'text',
                    'value'       => '',
                    'description' => __( 'Add content for this testimonial.', 'js_composer' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Bottom background', 'js_composer' ),
                    'param_name' => 'background'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Post date', 'js_composer' ),
                    'param_name'  => 'date',
                    'value'       => '',
                    'description' => __( 'Add date of post', 'js_composer' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Font color of bottom section', 'js_composer' ),
                    'param_name' => 'color'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Facebook', 'js_composer' ),
                    'param_name'  => 'social_fb',
                    'value'       => '#',
                    'description' => __( 'Enter facebook social link url.', 'js_composer' ),
                    'group'       => 'Social URL'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Instagram', 'js_composer' ),
                    'param_name'  => 'social_in',
                    'value'       => '#',
                    'description' => __( 'Enter instagram social link url.', 'js_composer' ),
                    'group'       => 'Social URL'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Linkedin', 'js_composer' ),
                    'param_name'  => 'social_li',
                    'value'       => '#',
                    'description' => __( 'Enter linkedin social link url.', 'js_composer' ),
                    'group'       => 'Social URL'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Twitter', 'js_composer' ),
                    'param_name'  => 'social_tw',
                    'value'       => '#',
                    'description' => __( 'Enter twitter social link url.', 'js_composer' ),
                    'group'       => 'Social URL'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Pinterest', 'js_composer' ),
                    'param_name'  => 'social_pi',
                    'value'       => '#',
                    'description' => __( 'Enter pinterest social link url.', 'js_composer' ),
                    'group'       => 'Social URL'
                )
            )
        )
    );
// ==========================================================================================
// CUSTOM BUTTON                                                                               -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Custom Button', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_custom_button',
            'description' => __( 'Button with icon', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Text on button', 'js_composer' ),
                    'param_name' => 'text',
                    'value'      => '',
                    "admin_label" => true,
                    "description" => 'Button anchor text'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button link', 'js_composer' ),
                    'param_name' => 'link',
                    'value'      => ''
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color', 'js_composer' ),
                    'param_name' => 't_color'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Button background color', 'js_composer' ),
                    'param_name' => 'bg_color'
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add icon to button?', 'js_composer' ),
                    'param_name' => 'add_icon',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon', 'templatation' ),
                    'param_name'  => 'i_class',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'dependency'  => array( 'element' => 'add_icon', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon color', 'js_composer' ),
                    'param_name' => 'i_color',
                    'dependency' => array( 'element' => 'add_icon', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add border to button?', 'js_composer' ),
                    'param_name' => 'add_border',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Border color', 'js_composer' ),
                    'param_name' => 'border_color',
                    'dependency' => array( 'element' => 'add_border', 'value' => array( 'yes' ) )
                ),

            )
        )
    );
// ==========================================================================================
// SOCIAL MEDIA                                                                               -
// ==========================================================================================
    vc_map(
        array(
            'name'     => __( 'WA Social Media', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_social_media',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'params'   => array(

                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Add social icon', 'js_composer' ),
                    "admin_label" => true,
                    'param_name'  => 'icon',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Social link', 'js_composer' ),
                    'param_name' => 'link',
                    'value'      => ''
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon color', 'js_composer' ),
                    'param_name' => 'i_color'
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Background color', 'js_composer' ),
                    'param_name' => 'background'
                )
            )
        )
    );

// ==========================================================================================
// INFO LIST                                                                               -
// ==========================================================================================
    vc_map(
        array(
            'name'     => __( 'WA Info box', 'js_composer' ),
            'description'     => __( 'Info box with icon on left.', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_info_list',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'params'   => array(

                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    'value'      => '',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Description for this block', 'js_composer' ),
                    'param_name' => 'text',
                    'value'      => ''
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Font color', 'js_composer' ),
                    'param_name'  => 't_color',
                    'description' => __( 'Select color for text', 'js_composer' )
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Add icon', 'js_composer' ),
                    "admin_label" => true,
                    'param_name'  => 'icon',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Icon color', 'js_composer' ),
                    'param_name'  => 'i_color',
                    'description' => __( 'Select color for icon', 'js_composer' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon background color', 'js_composer' ),
                    'param_name' => 'background'
                )
            )
        )
    );

// ==========================================================================================
// CONTACT INFO                                                                             -
// ==========================================================================================
    vc_map(
        array(
            'name'     => __( 'WA Contact info', 'js_composer' ),
            'description'     => __( 'Used on testimonial page.', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'     => 'webapp_contact_info',
            'category' => __( 'Webapp Theme', 'js_composer' ),
            'params'   => array(

                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    'value'      => '',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Address', 'js_composer' ),
                    'param_name' => 'adress',
                    'value'      => ''
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Email', 'js_composer' ),
                    'param_name' => 'email',
                    'value'      => ''
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Phone', 'js_composer' ),
                    'param_name' => 'phone',
                    'value'      => ''
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Font color', 'js_composer' ),
                    'param_name'  => 't_color',
                    'description' => __( 'Select color for text', 'js_composer' )
                )
            )
        )
    );
// ==========================================================================================
// CUSTOM TITLE                                                                             -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Custom title', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_title',
            'description' => __( 'Styled title for theme', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Heading', 'js_composer' ),
                    'param_name' => 'size',
                    'value'      => array(
                        'H1' => 'h1',
                        'H2' => 'h2',
                        'H3' => 'h3',
                        'H4' => 'h4',
                        'H5' => 'h5',
                        'H6' => 'h6'
                    ),
                    'description' => 'Select tag for the heading, this also affects the font size.'

                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                     'description' => 'Main title.'
               ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title span', 'js_composer' ),
                    'param_name' => 'title_span',
                    'description' => 'This adjoins to above title in Bold.',
                    "admin_label" => true,
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Font color', 'js_composer' ),
                    'param_name'  => 'color',
                    'description' => __( 'Choose text color', 'js_composer' )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add separator?', 'js_composer' ),
                    'param_name' => 'separator',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Separator color', 'js_composer' ),
                    'param_name'  => 'color_sep',
                    'description' => __( 'Choose separator color', 'js_composer' ),
                    'dependency'  => array( 'element' => 'separator', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add subtitle?', 'js_composer' ),
                    'param_name' => 'add_sbt',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Subtitle', 'js_composer' ),
                    'param_name' => 'subtitle',
                    'dependency' => array( 'element' => 'add_sbt', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Subtitle color', 'js_composer' ),
                    'param_name'  => 's_color',
                    'description' => __( 'Choose subtitle color', 'js_composer' ),
                    'dependency'  => array( 'element' => 'add_sbt', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Align Left?', 'js_composer' ),
                    'param_name' => 'left_style',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
                    'description' => __( 'By default, title is center aligned, check if you want it to align left.', 'js_composer' ),
                ),

            )
        )
    );
// ==========================================================================================
// SUBSCRIBE                                                                            -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Subscribe', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_subscribe',
            'description' => __( 'MailChimp subscribe', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Enter your MailChimp form url', 'js_composer' ),
					"description" => sprintf( esc_html__( 'It can be found in Mailchimp / Lists / -Select list- / Signup forms / General Forms. eg:  http://eepurl.com/bShnOb. Note, this form is limited, if you want full flexibility please check %1$s', 'webapp-string' ), '<a href="http://kb.templatation.com/article/37-how-to-integrate-mailchimp-form" target="_blank">'.esc_html__( 'this guide', 'webapp-string' ).'</a>' ),
                    'param_name' => 'mc_form_url'
                ),
            )
        )
    );

// ==========================================================================================
// BENEFIT                                                                          -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Round icon', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_benefit',
            'description' => __( 'Round icon with title/description', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Description Text', 'js_composer' ),
                    'param_name' => 'text'
                ),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Theme Specific Icon",'js_composer'),
					"description" => sprintf( esc_html__( 'This theme comes with few specific icons. Enter their code. Keep it blank to use common icons chosen below. You can check theme custom icons list %1$s e.g. icon-Medal', 'webapp-string' ), '<a href="http://templatation.com/themesinclude/icons/Stroke-Gap-Icons/demo.html" target="_blank">'.esc_html__( 'Here', 'webapp-string' ).'</a>' ),
					"param_name" => "custom_icon",
					"value" => "",
			    ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Add icon, only works if you above field is blank.', 'js_composer' ),
                    'param_name'  => 'class',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Background color', 'js_composer' ),
                    'param_name'  => 'bg',
                    'description' => __( 'Choose Background', 'js_composer' )
                ),
            )
        )
    );
// ==========================================================================================
// BENEFITS                                                                         -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Benefits block', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_benefits',
            'description' => __( 'Image in middle with 6 content blocks.', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title1', 'js_composer' ),
                    'param_name' => 'title1',
                    "admin_label" => true,
                    "description" => __( 'Title for block 1.', 'js_composer' ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Text1', 'js_composer' ),
                    'param_name' => 'text1',
                    "description" => __( 'Description text for block 1.', 'js_composer' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading'    => __( 'Choose icon for block 1.', 'js_composer' ),
                    'param_name' => 'class1',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'description' => __( 'Select icon for block 1.', 'buildcon' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title2', 'js_composer' ),
                    'param_name' => 'title2',
                    "description" => __( 'Title for block 2.', 'js_composer' ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Text2', 'js_composer' ),
                    'param_name' => 'text2',
                    "description" => __( 'Description text for block 2.', 'js_composer' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading'    => __( 'Choose icon for block 2.', 'js_composer' ),
                    'param_name' => 'class2',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'description' => __( 'Select icon for block 2.', 'buildcon' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title3', 'js_composer' ),
                    'param_name' => 'title3',
                    "description" => __( 'Title for block 3.', 'js_composer' ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Text3', 'js_composer' ),
                    'param_name' => 'text3',
                    "description" => __( 'Description text for block 3.', 'js_composer' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading'    => __( 'Choose icon for block 3.', 'js_composer' ),
                    'param_name' => 'class3',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'description' => __( 'Select icon for block 3.', 'buildcon' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title4', 'js_composer' ),
                    'param_name' => 'title4',
                    "description" => __( 'Title for block 4.', 'js_composer' ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Text4', 'js_composer' ),
                    'param_name' => 'text4',
                    "description" => __( 'Description text for block 4.', 'js_composer' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading'    => __( 'Choose icon for block 4.', 'js_composer' ),
                    'param_name' => 'class4',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'description' => __( 'Select icon for block 4.', 'buildcon' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title 5', 'js_composer' ),
                    'param_name' => 'title5',
                    "description" => __( 'Title for block 5.', 'js_composer' ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Text 5', 'js_composer' ),
                    'param_name' => 'text5',
                    "description" => __( 'Description text for block 5.', 'js_composer' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading'    => __( 'Choose icon for block 5.', 'js_composer' ),
                    'param_name' => 'class5',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'description' => __( 'Select icon for block 5.', 'buildcon' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title 6', 'js_composer' ),
                    'param_name' => 'title6',
                    "description" => __( 'Title for block 6.', 'js_composer' ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Text 6', 'js_composer' ),
                    'param_name' => 'text6',
                    "description" => __( 'Description text for block 6.', 'js_composer' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading'    => __( 'Choose icon for block 6.', 'js_composer' ),
                    'param_name' => 'class6',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'description' => __( 'Select icon for block 6.', 'buildcon' )
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image phone 1', 'js_composer' ),
                    'param_name' => 'image1',
                    "description" => __( 'Image 1.', 'js_composer' ),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Image phone 2', 'js_composer' ),
                    'param_name' => 'image2',
                    "description" => __( 'Image 2, this image appears side by side with image 1. Optional.', 'js_composer' ),
                )

            )
        )
    );


// ==========================================================================================
// ICON                                                                                -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Icon', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_icon',
            'description' => __( 'Icon with text and description.', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Theme Specific Icon",'js_composer'),
					"description" => sprintf( esc_html__( 'This theme comes with few specific icons. Enter their code. Keep it blank to use common icons chosen below. You can check theme custom icons list %1$s e.g. icon-Medal', 'webapp-string' ), '<a href="http://templatation.com/themesinclude/icons/Stroke-Gap-Icons/demo.html" target="_blank">'.esc_html__( 'Here', 'webapp-string' ).'</a>' ),
					"param_name" => "custom_icon",
					"value" => "",
			    ),
                array(
                    'type' => 'iconpicker',
                    'heading'     => __( 'Add icon, only works if you above field is blank.', 'js_composer' ),
                    'param_name' => 'i_class',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Font size', 'js_composer' ),
                    'param_name'  => 'i_size',
                    'value'       => '',
                    'description' => __( 'Add icon font size. eg: 15px', 'js_composer' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Icon color', 'js_composer' ),
                    'param_name' => 'i_color'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Title', 'js_composer' ),
                    'param_name'  => 'title',
                    'value'       => '',
                    'description' => __( 'Add title for this icon block.', 'js_composer' ),
                    "admin_label" => true,
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => __( 'Subtitle', 'js_composer' ),
                    'param_name'  => 'subtitle',
                    'value'       => '',
                    'description' => __( 'Add subtitle for this icon block.', 'js_composer' )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add border?', 'js_composer' ),
                    'param_name' => 'i_border',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Border color', 'js_composer' ),
                    'param_name' => 'b_color',
                    'dependency' => array( 'element' => 'i_border', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add small text under icon?', 'js_composer' ),
                    'description'    => __( 'This text appears inside the icon box.', 'js_composer' ),
                    'param_name' => 'add_text',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Small text', 'js_composer' ),
                    'param_name' => 'i_text',
                    'dependency' => array( 'element' => 'add_text', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => __( 'Text color', 'js_composer' ),
                    'param_name' => 't_color',
                    'dependency' => array( 'element' => 'add_text', 'value' => array( 'yes' ) )
                ),
            )
        )
    );


// ==========================================================================================
// CUSTOM BANNER                                                                            -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Custom banner', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_custom_banner',
            'description' => __( 'Image with text and button', 'js_composer' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Heading', 'js_composer' ),
                    'param_name' => 'size',
                    'value'      => array(
                        'H1' => 'h1',
                        'H2' => 'h2',
                        'H3' => 'h3',
                        'H4' => 'h4',
                        'H5' => 'h5',
                        'H6' => 'h6'
                    )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    "admin_label" => true,
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => __( 'Background image', 'js_composer' ),
                    'param_name' => 'image'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Link text', 'js_composer' ),
                    'param_name' => 'link_text'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Link url', 'js_composer' ),
                    'param_name' => 'link_url'
                )
            )
        )
    );
// ==========================================================================================
// SIMPLE SLIDER                                                                                -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Simple slider', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_simple_slider',
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'description' => __( 'Image slider', 'js_composer' ),
            'params'      => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => __( 'Slides', 'js_composer' ),
                    'param_name'  => 'images',
                    'description' => __( 'Images for sliding.', 'js_composer' )
                )
            )
        )
    );

// ==========================================================================================
// IMAGE WITH THE LINK                                                                            -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Brands icon', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_image_with_link',
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => __( 'Image', 'js_composer' ),
                    'param_name'  => 'images',
                    'description' => __( 'Select image for the brand.', 'js_composer' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Image Link', 'js_composer' ),
                    'param_name' => 'image_link',
                    'description' => __( 'Enter link for the brand. Optional', 'js_composer' )
                ),
            )
        )
    );
// ==========================================================================================
// PRICING TABLE                                                                           -
// ==========================================================================================
    vc_map(
        array(
            'name'        => __( 'WA Pricing Table', 'js_composer' ),
            "icon"        => 'tt-vc-block',
            'base'        => 'webapp_pricing',
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'params'      => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Heading', 'js_composer' ),
                    'param_name' => 'size',
                    'description' => 'Select heading tag for the table, this is useful for SEO and text size purpose. Recommended: h4',
                    'value'      => array(
                        'H1' => 'h1',
                        'H2' => 'h2',
                        'H3' => 'h3',
                        'H4' => 'h4',
                        'H5' => 'h5',
                        'H6' => 'h6'
                    )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Title', 'js_composer' ),
                    'param_name' => 'title',
                    'description' => 'Title for this price plan.',
                    "admin_label" => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Price', 'js_composer' ),
                    'param_name'  => 'price',
                    'description' => __( 'Price for this price plan.', 'js_composer' )
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Pricing period', 'js_composer' ),
                    'param_name'  => 'price_p',
                    'description' => __( 'Pricing period. Like per month, per year. This appears as substring on the price. (Optional)', 'js_composer' )
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Pricing text', 'js_composer' ),
                    'description'    => __( 'Text for this pricing plan. Normally used to add feature lists.', 'js_composer' ),
                    'param_name' => 'price_description'
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add button?', 'js_composer' ),
                    'param_name' => 'btn',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button text', 'js_composer' ),
                    'param_name' => 'btntext',
                    'dependency' => array( 'element' => 'btn', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Button link', 'js_composer' ),
                    'param_name' => 'btnlink',
                    'dependency' => array( 'element' => 'btn', 'value' => array( 'yes' ) )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Add icon to button?', 'js_composer' ),
                    'param_name' => 'add_icon',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
                    'dependency' => array( 'element' => 'btn', 'value' => array( 'yes' ) )
                ),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Theme Specific Icon",'js_composer'),
					"description" => sprintf( esc_html__( 'This theme comes with few specific icons. Enter their code. Keep it blank to use common icons chosen below. You can check theme custom icons list %1$s e.g. icon-Medal', 'webapp-string' ), '<a href="http://templatation.com/themesinclude/icons/Stroke-Gap-Icons/demo.html" target="_blank">'.esc_html__( 'Here', 'webapp-string' ).'</a>' ),
					"param_name" => "custom_icon",
					"value" => "",
                    'dependency'  => array(
                        'element' => 'add_icon',
                        'value'   => array( 'yes' )
                    )
			    ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Add icon, only works if you above field is blank.', 'js_composer' ),
                    'param_name'  => 'b_icon',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                    'dependency'  => array(
                        'element' => 'add_icon',
                        'value'   => array( 'yes' )
                    )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => __( 'Highlight this table ?', 'js_composer' ),
                    'param_name' => 'highlight',
                    'value'      => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Highlight text', 'js_composer' ),
                    'description'    => __( 'Enter custom highlight text. Default : Best Value!', 'js_composer' ),
                    'value' => 'Best Value!',
                    'param_name' => 'highlighttext',
                    'dependency' => array( 'element' => 'highlight', 'value' => array( 'yes' ) )
                ),
            )
        )
    );
/*
 * Templatation.com
 *
 * Banner with label slider for VC
 *
 */

function tt_gm_list_fn_vc() {
    vc_map(
        array(
            'name'                    => __( 'List' , 'templatation' ),
            "icon"        => 'tt-vc-block',
            'base'                    => 'tt_gm_list_shortcode',
            'description' => __( 'List types', 'templatation' ),
            'as_parent'               => array('only' => 'tt_gm_list_item_shortcode'),
            'content_element'         => true,
            "js_view" => 'VcColumnView',
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            "params" => array(
                array(
                    'type'      => 'dropdown',
                    'heading'     => __( 'Select type of list', 'js_composer' ),
                    'param_name'  => 'list_type',
                    'value'       => array(
                        'List with icon'    =>  'style_1',
                        'Number list'     =>  'style_2'
                    )
                ),
            ),
        )
    );
}
add_action( 'vc_before_init', 'tt_gm_list_fn_vc' );
// Nested Element
function tt_gm_list_item_fn_vc() {
    vc_map(
        array(
            'name'            => __('Item list', 'templatation'),
            "icon"        => 'tt-vc-block',
            'base'            => 'tt_gm_list_item_shortcode',
            'description'     => __( 'Item list', 'templatation' ),
            'category'    => __( 'Webapp Theme', 'js_composer' ),
            'content_element' => true,
            'as_child'        => array('only' => 'tt_gm_list_shortcode'), // Use only|except attributes to limit parent (separate multiple values with comma)
            'params'          => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Name item', 'js_composer' ),
                    'param_name'  => 'title',
                    'value'       => '',
                    'description' => __( 'Name item', 'js_composer' ),
                    "admin_label" => true,
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Item color', 'templatation' ),
                    'param_name'  => 'itemcolor',
                    'value'       => '',
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => __( 'Select icon', 'templatation' ),
                    'param_name'  => 'type_icon',
                    'value'       => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'iconsPerPage' => 300,
                    ),
                ),
                 array(
                     'type'        => 'colorpicker',
                     'heading'     => __( 'Icon color', 'templatation' ),
                     'param_name'  => 'iconcolor',
                     'value'       => '',
                 ),
            ),
        )
    );
}
add_action( 'vc_before_init', 'tt_gm_list_item_fn_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_tt_gm_list_shortcode extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_tt_gm_list_item_shortcode extends WPBakeryShortCode {

    }
}