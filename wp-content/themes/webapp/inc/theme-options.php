<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* This file hooks the redux options panel. While Redux powered by TT FW plugin.
/*-----------------------------------------------------------------------------------*/

/* $redux_opt_name is tt_temptt_opt */

add_filter('redux/options/tt_temptt_opt/sections', 'tt_webapp_redux_options');

if ( ! function_exists( 'tt_webapp_redux_options' ) ) {
    function tt_webapp_redux_options( $sections ) {

	//reset themeoptions array
    $sections = array();

	$shortname = 'tt';

    /*
     *
     * ---> START SECTIONS
     *
     */

/*-----------------------------------------------------------------------------------*/
/* General Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title'  => esc_html__( 'General Settings', 'webapp' ),
        'id'     => 'general',
        'desc'   => esc_html__( 'General Settings.', 'webapp' ),
        //'icon'   => 'el el-home ',
        'customizer_width' => '400px',
    );
	// quick start.
    $sections[] = array(
        'title'            => esc_html__( 'Quick Start', 'webapp' ),
        'id'               => 'general-quickstart',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id' => $shortname . '_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Upload Logo', 'webapp' ),
                'subtitle'     => esc_html__( 'Upload a custom logo, if left blank it fetches default logo.', 'webapp' ),
                'desc' => esc_html__( 'Default logo size: 170x35', 'webapp' ),
            ),
            array(
                'id'       => $shortname . '_retina_favicon',
                'type'     => 'switch',
                'title'    => 'Retina Ready Logo',
                'subtitle' => esc_html__( 'Do you want sharp logo display on retina display devices?', 'webapp' ),
                'desc'     => esc_html__( 'To make logo look sharp on Retina devices, you need to upload double size logo above and turn it on to be able to enter desired width/height for logo image. If you are not sure what this means leave it off. Note: To comply with all retina devices app icon etc, please go to Appearance->customize->site identity.', 'webapp' ),
                'default'  => false
            ),
            array(
                'id' => $shortname . '_retina_logo_wh',
                'type'           => 'dimensions',
                'units'          => array( 'px' ),    // You can specify a unit value. Possible: px, em, %
                'units_extended' => 'true',  // Allow users to select any type of unit
                'title'          => esc_html__( 'Dimensions (Width/Height) Option', 'webapp' ),
                'subtitle'       => esc_html__( 'Enter desired Width and height for your retina logo. If you want logo to be retina ready, please upload double size version of logo above and enter the dimensions you want it to appear in. Recommended: 170 x 35.', 'webapp' ),
                'desc'       => esc_html__( ' Normally it will be half of actual retina logo image dimensions. Enter values without px eg: 50, 70 etc. Recommended: Leave blank to disable this. Note: If your logo is distorted, try keeping the Height field blank.', 'webapp' ),
                'required' => array( $shortname . '_retina_favicon', '=', true ),
                 'default'        => array(
                    'width'  => 0,
                    'height' => 0,
                )
            ),
            array(
                'id'    => $shortname . '_favicon_info1',
                'type'  => 'media',
                'url'      => true,
                'readonly'    => false,
                'title' => esc_html__( 'Favicon Icon', 'webapp' ),
                'desc'  => esc_html__( 'Upload a favicon if you are running below WP 4.3. Please go to Appearance-> customise -> site identity to upload favicon if you are running WordPress version 4.3 or above.', 'webapp' ),
            ),
           array(
                'id' => $shortname . '_enable_preloader',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable Preloader', 'webapp' ),
                'subtitle' => esc_html__( 'If enabled, page shows loading image before the content is loaded.', 'webapp' ),
                'default'  => true
           ),
            array(
                'id' => $shortname . '_preloader',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Customer Preloader image', 'webapp' ),
                'subtitle'     => esc_html__( 'If you have custom preloader image, upload here, otherwise default preload image will be used.', 'webapp' ),
                'required' => array( $shortname . '_enable_preloader', '=', true ),
            ),
           array(
                'id' => $shortname . '_enable_pluscursor',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable Plus Cursor', 'webapp' ),
                'subtitle' => esc_html__( 'If enabled, on blog page, image hover changes cursor to big + icon.', 'webapp' ),
                'default'  => true
           ),
           array(
                'id' => $shortname . '_enable_relatedposts',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable Related Posts', 'webapp' ),
                'subtitle' => esc_html__( 'If enabled, on single post page, Related posts shows.', 'webapp' ),
                'default'  => true
           ),
           array(
                'id' => $shortname . '_post_sharing',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable post sharing', 'webapp' ),
                'desc'   => esc_html__( 'If enabled, single post page shows sharing icons at the end of the post.', 'webapp' ),
                'default'  => true
            ),
           array(
                'id' => $shortname . '_enable_sticky',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable Sticky header', 'webapp' ),
                'subtitle' => esc_html__( 'If enabled, the header always stays even when you scroll down the page.', 'webapp' ),
                'default'  => true
           ),
           array(
                'id' => $shortname . '_gmap_api',
                'type'     => 'text',
                'title' => esc_html__( 'Google Map API', 'buildcon' ),
                'desc'  => sprintf( esc_html__( '%1$s for complete instructions to get an API key from Google itself.', 'buildcon' ), '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key">' . esc_html__( 'Click here', 'buildcon' ) . '</a>' ),
                'subtitle' => esc_html__( 'Since June 2016, Google requires an API key for displaying maps.', 'buildcon' ),
           ),

         )
    );

/*DISPLAY OPTIONS*/

    $sections[] = array(
        'title'            => esc_html__( 'Custom CSS', 'webapp' ),
        'id'               => 'display-options',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(

            array(
    			'id' => $shortname . '_custom_css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom CSS', 'webapp' ),
    			'subtitle' => esc_html__( 'Quickly add some CSS to your theme by adding it to this block.', 'webapp' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => ''
            ),

        )
    );

/*-----------------------------------------------------------------------------------*/
/* Style Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title'            => esc_html__( 'Styling', 'webapp' ),
        'id'               => 'body-options',
        'customizer_width' => '450px',
        'icon'   => 'el el-icon-brush',
/*        'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'webapp' ) . '<a href="//docs.reduxframework.com/core/fields/checkbox/" target="_blank">docs.reduxframework.com/core/fields/checkbox/</a>',*/
        'fields'           => array(

           array(
                'id' => $shortname . '_main_acnt_clr',
                'type'     => 'color',
                'title'    => esc_html__( 'Main Accent Color', 'webapp' ),
                'subtitle' => esc_html__( 'Main accent color of the theme. This is most used color throughout.', 'webapp' ),
                'desc'     => esc_html__( 'Default: #56cc91. Note: Some colors are powered by sprite image, and visual composer. They will need to be handled manually, contact support if you need help.', 'webapp' ),
                'default'  => ''
           ),

           array(
                'id' => $shortname . '_hdr_styling',
                'type'     => 'background',
                'output'   => array( '.overlay-nav' ),
                'title' => esc_html__( 'Header Settings', 'webapp' ),
                'desc'     => esc_html__( 'Note: Color only shows up if there is no image uploaded.', 'webapp' ),
                'subtitle' => esc_html__( 'In this theme, page content overlaps the header area. You can define default behaviour here for header area(When there is no hero image is defined on the page, this default setting shows up). This setting can be turned off from particular page metabox too.', 'webapp' ),
		        'default'  => array(
		            'background-image' => TT_TEMPTT_THEME_DIRURI. '/images/headerbg.jpg'
		        )
           ),

           array(
                'id' => $shortname . '_body_stng',
                'type'     => 'background',
                'output'   => array( '#main' ),
                'title' => esc_html__( 'Body Background Setting', 'webapp' ),
                'desc'     => esc_html__( 'Note: Color only shows up if there is no image uploaded.', 'webapp' ),
                'subtitle' => esc_html__( 'You can customize body section here. Choose a color and setup as per your liking.', 'webapp' ),
		        'default'  => array(
		            'background-color' => '',
		        )
           ),

            array(
                'id' => $shortname . '_tt_ft_bg',
                'type'     => 'background',
                'output'   => array( 'footer.footer' ),
                'desc'     => esc_html__( 'Note: Color only shows up if there is no image uploaded.', 'webapp' ),
                'title'    => esc_html__( 'Footer Background', 'webapp' ),
                'subtitle' => esc_html__( 'Select background color for footer area, where widgets appear.', 'webapp' ),
            ),

        )
        );

/*-----------------------------------------------------------------------------------*/
/* Layout Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title' => esc_html__( 'Layout (Header)', 'webapp' ),
        'id'               => 'layout-options',
        'desc'   => esc_html__( 'Layout Settings for Header.', 'webapp' ),
        'icon'   => 'el el-photo ',
        'customizer_width' => '400px',
        'fields'           => array(


           /*array(
    			'id' => $shortname . '_top_nav_color',
                'type'     => 'color',
			 	'title' => esc_html__( 'Top Nav Bar Color', 'webapp' ),
                'subtitle' => esc_html__( 'Pick a custom color for Top nav bar or add a hex color code. Default: #1b1542', 'webapp' ),
                'default'  => '#1b1542',
                'required' => array( $shortname . '_enable_topbar', '=', true )
           ),*/
           array(
                'id' => $shortname . '_js_topbar_notice',
                'type'   => 'info',
                'notice' => false,
                'style'  => 'info',
                'title' => esc_html__( 'Toppest Bar Settings', 'webapp' ),
                'desc'   => esc_html__( 'Below settings are for the top most navigation bar which is optional. It adds some usual user interface items. There is limited space on this bar , so be careful in choosing what part you really need. You can try it out and disable things later if bar goes out of space.', 'webapp' )
           ),
           array(
                'id' => $shortname . '_enable_topbar',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable Top Nav Bar', 'webapp' ),
                'subtitle' => esc_html__( 'Enable/Disable the Top most nav bar globally.', 'webapp' ),
                'default'  => false
           ),
            array(
    			'id' => $shortname . '_top_nav_left_layout',
                'type'     => 'sorter',
                'title'    => 'Top nav left content',
                'subtitle' => 'You can place content as you want, on left side of the top nav. Sort them, or disable by moving them back to Available column. Note that here you can only enable/disable/sort them, their actual content can be controlled from the options below. Note: Email/phone to be entered in Social/contact setting below.',
                'compiler' => 'true',
                'options'  => array(
                    'enabled'  => array(
                        'email'     => 'Email',
                        'phone'   => 'Phone',
                    ),
                    'disabled' => array(
                        'teaser_text'   => 'Text',
                        'wpml_lang'   => 'WPML Languages',
                        'social'   => 'Social Icons',
                        'custommenu'   => 'Custom Menu',
                        'spacer'   => 'Blank Space',
                        'spacer2'   => 'Blank Space2',
                    ),
                ),
                'required' => array( $shortname . '_enable_topbar', '=', true )
            ),
            array(
    			'id' => $shortname . '_top_nav_right_layout',
                'type'     => 'sorter',
                'title'    => 'Top nav right content',
                'subtitle' => 'You can place content as you want, on right side of the top nav. Sort them, or disable by moving them back to Available column. Note that here you can only enable/disable/sort them, their actual content can be controlled from the options below. Note: Email/phone to be entered in Social/contact setting below.',
                'compiler' => 'true',
                'options'  => array(
                    'enabled'  => array(
                        'social'   => 'Social Icons',
                    ),
                    'disabled' => array(
                        'email'     => 'Email',
                        'phone'   => 'Phone',
                        'teaser_text'   => 'Text',
                        'wpml_lang'   => 'WPML Languages',
                        'custommenu'   => 'Custom Menu',
                        'spacer'   => 'Blank Space',
                        'spacer2'   => 'Blank Space2',
                    ),
                ),
                'required' => array( $shortname . '_enable_topbar', '=', true )
            ),

           array(
                'id' => $shortname . '_ttext_text',
                'type'     => 'text',
                'title' => esc_html__( 'Teaser Text', 'webapp' ),
                'subtitle' => esc_html__( 'Teaser text is short sentence that you want to highlight. eg : Our helpline number : xyz. This text appears on left most side of top bar.', 'webapp' ),
                'required' => array( $shortname . '_enable_topbar', '=', true )
           ),

            array(
                'id' => $shortname . '_top_nav_menu',
                'type'     => 'select',
                'data'     => 'menus',
                'title'    => esc_html__( 'Select Menu', 'webapp' ),
                'subtitle' => esc_html__( 'To display custom menu, please create a new menu in Appearance -> Menus and then select it here.', 'webapp' ),
                'required' => array( $shortname . '_enable_topbar', '=', true )
            ),
        )
    );


/*-----------------------------------------------------------------------------------*/
/* Footer Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title' => esc_html__( 'Footer Customization', 'webapp' ),
        'id'               => 'footer-settings1',
        'customizer_width' => '450px',
        'fields'           => array(



           array(
                'id' => $shortname . '_footer_sidebars',
                'type'     => 'image_select',
                'title' => esc_html__( 'Footer Widget Areas', 'webapp' ),
                'subtitle' => esc_html__( 'Select how many footer widget areas you want to display.', 'webapp' ),
                'desc'     => esc_html__( 'Select default sidebar position for the website, you can override this setting on per post/page level too.', 'webapp' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '0' => array(
                        'img' => TT_TEMPTT_THEME_DIRURI .'inc/images/footer-widgets-0.png',
                    ),
                    '1' => array(
                        'img' => TT_TEMPTT_THEME_DIRURI .'inc/images/footer-widgets-1.png',
                    ),
                    '2' => array(
                        'img' => TT_TEMPTT_THEME_DIRURI .'inc/images/footer-widgets-2.png',
                    ),
                    '3' => array(
                        'img' => TT_TEMPTT_THEME_DIRURI .'inc/images/footer-widgets-3.png',
                    ),
                    '4' => array(
                        'img' => TT_TEMPTT_THEME_DIRURI .'inc/images/footer-widgets-4.png',
                    ),
                ),
                'default'  => '3'
           ),
            array(
                'id' => $shortname . '_footer_social_co',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable Footer Social icons', 'webapp' ),
                'subtitle' => esc_html__( 'If enabled, social icons appear below the WA: Info & Social widget.', 'webapp' ),
                 'default'  => false
            ),
          array(
                'id' => $shortname . '_extreme_footer_notice',
                'type'   => 'info',
                'notice' => false,
                'style'  => 'info',
                'title' => esc_html__( 'Footer area customization', 'webapp' ),
                'desc'   => esc_html__( 'Customize footer area here. Note: Background colors for footer areas can be changed from Styling tab.', 'webapp' )
           ),
           array(
                'id' => $shortname . '_footer_left_text',
                'type'     => 'textarea',
                'title' => esc_html__( 'Footer left', 'webapp' ),
                'subtitle' => esc_html__( 'This text appears on left side of extreme footer area.', 'webapp' ),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => ''
           ),
           array(
                'id' => $shortname . '_footer_right_text',
                'type'     => 'textarea',
                'title' => esc_html__( 'Footer right', 'webapp' ),
                'subtitle' => esc_html__( 'This text appears on right side of extreme footer area.', 'webapp' ),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default'  => ''
           ),

        )
    );

/*-----------------------------------------------------------------------------------*/
/* Social Settings                                                                  */
/*-----------------------------------------------------------------------------------*/

    $sections[] = array(
        'title' => esc_html__( 'Social / Contact Settings', 'webapp' ),
        'id'               => 'connect-settings',
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id' => $shortname . '_contact_number',
                'type'     => 'text',
                'title' => esc_html__( 'Telephone', 'webapp' ),
                'subtitle' => esc_html__( 'Enter your telephone number', 'webapp' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname.'_contactform_email',
                'type'     => 'text',
                'title' => esc_html__( 'Contact Form E-Mail', 'webapp' ),
                'subtitle' => esc_html__( "Enter your E-mail address to use on the 'Contact Form' page Template.", 'webapp' ),
                'default'  => '',
            ),

           array(
                'id' => $shortname . '_subs_connect_notice',
                'type'   => 'info',
                'notice' => false,
                'style'  => 'info',
                'title' => esc_html__( 'Social Settings', 'webapp' ),
                'desc'   => esc_html__( 'These social icons appears on top navigation bar, if they are enabled in Layout section, and if they have values.', 'webapp' )
           ),
/*            array(
                'id' => $shortname . '_connect_rss',
                'type'     => 'switch',
                'title' => esc_html__( 'Enable RSS', 'webapp' ),
                'subtitle' => esc_html__( 'Enable the subscribe and RSS icon.', 'webapp' ),
                 'default'  => true
            ),*/
            array(
                'id' => $shortname . '_connect_twitter',
                'type'     => 'text',
                'title' => esc_html__( 'Twitter URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. http://www.twitter.com/templatation', 'webapp' ), '<a href="http://www.twitter.com/">'.esc_html__( 'Twitter', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname . '_connect_facebook',
                'type'     => 'text',
                'title' => esc_html__( 'Facebook URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. http://www.facebook.com/templatation', 'webapp' ), '<a href="http://www.facebook.com/">'.esc_html__( 'Facebook', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname . '_connect_youtube',
                'type'     => 'text',
                'title' => esc_html__( 'YouTube URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. http://www.youtube.com/templatation', 'webapp' ), '<a href="http://www.youtube.com/">'.esc_html__( 'YouTube', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname . '_connect_flickr',
                'type'     => 'text',
                'title' => esc_html__( 'Flickr URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. http://www.flickr.com/templatation', 'webapp' ), '<a href="http://www.flickr.com/">'.esc_html__( 'Flickr', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname . '_connect_linkedin',
                'type'     => 'text',
                'title' => esc_html__( 'LinkedIn URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. http://www.linkedin.com/in/templatation', 'webapp' ), '<a href="http://www.www.linkedin.com.com/">'.esc_html__( 'LinkedIn', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname . '_connect_pinterest',
                'type'     => 'text',
                'title' => esc_html__( 'Pinterest URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. http://www.pinterest.com/templatation', 'webapp' ), '<a href="http://www.pinterest.com/">'.esc_html__( 'Pinterest', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname . '_connect_instagram',
                'type'     => 'text',
                'title' => esc_html__( 'Instagram URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. http://www.instagram.com/templatation', 'webapp' ), '<a href="http://www.instagram.com/">'.esc_html__( 'Instagram', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
            array(
                'id' => $shortname . '_connect_googleplus',
                'type'     => 'text',
                'title' => esc_html__( 'Google+ URL', 'webapp' ),
                'subtitle' => sprintf( esc_html__( 'Enter your %1$s URL e.g. https://plus.google.com/104560124403688998123/', 'webapp' ), '<a href="http://plus.google.com/">'.esc_html__( 'Google+', 'webapp' ).'</a>' ),
                'default'  => '',
            ),
        )
    );

    return $sections;

    }
}

