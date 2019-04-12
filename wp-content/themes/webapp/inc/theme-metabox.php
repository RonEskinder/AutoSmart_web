<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* This file hooks the metaboxes to Metabox system powered by TT FW plugin.
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* CS meta boxes override                                                            */
/*-----------------------------------------------------------------------------------*/
// framework options filter example
if( !function_exists( 'tt_temptt_metas_opt' )) {
	function tt_temptt_metas_opt( $options ) {



// Lets create options that we will use mostly, in page, product, pages
	$tt_temptt_default_meta =  array(
						// begin: a section
						array(
							'name'   => 'section_1',
							'title'  => 'General Settings',
							'icon'   => 'fa fa-cog',
							// begin: fields
							'fields' => array(

								array(
									'id'      => '_single_enable_overlap',
									'type'    => 'switcher',
									'title'   => esc_html__( 'Enable overlapping of header area on this page', 'webapp' ),
									'label'   => esc_html__( 'When enabled, the page content starts right from the top. Recommended to enable if you enable hero section below.', 'webapp' ),
									'default' => false
								),
						array(
						  'id'    => '_hide_title_display',
						  'type'  => 'switcher',
						  'title' => esc_html__( 'Hide default title display in middle content area.', 'webapp' ),
						  'desc'  => esc_html__( 'In some case, you might want to hide the default title display. Check this to hide title. If you are not sure about it  leave it unchecked. N/A for woocommerce products.', 'webapp' ),
						  'default' => true
						),

								array(
									'id'      => '_single_enable_headline',
									'type'    => 'switcher',
									'title'   => esc_html__( 'Enable hero/banner section from this page', 'webapp' ),
									'label'   => esc_html__( 'Appears after header and before content area.', 'webapp' ),
									'default' => false
								),
								array(
									'id'         => '_single_hightlight_text',
									'type'       => 'text',
									'title'      => esc_html__( 'Enter highlight text.', 'webapp' ),
									'label'   => esc_html__( 'Main title for Hero section.', 'webapp' ),
									'dependency' => array( '_single_enable_highlight', '==', 'true' ),
								),
								array(
									'id'         => '_single_headline_title',
									'type'       => 'text',
									'title'      => esc_html__( 'Main Title.', 'webapp' ),
									'label'   => esc_html__( 'In this theme, later part of title can be bold. Enter that bold text here. Leave blank if not sure.', 'webapp' ),
									'dependency' => array( '_single_enable_headline', '==', 'true' ),
								),
									array(
									'id'         => '_single_headline_title_bold',
									'type'       => 'text',
									'title'      => esc_html__( 'Main Title Bold.', 'webapp' ),
									'dependency' => array( '_single_enable_headline', '==', 'true' ),
								),

								array(
									'id'    => '_single_page_img',
									'type'  => 'upload',
									'title' => esc_html__( 'Background image', 'webapp' ),
									'desc'  => esc_html__( 'This image appears in background of hero section.', 'webapp' ),
									'dependency' => array( '_single_enable_headline', '==', 'true' ),
								),
								array(
									  'id'      => '_single_page_color',
									  'type'    => 'color_picker',
									  'title'   => esc_html__( 'Background color.', 'webapp' ),
									  'desc'    => esc_html__( 'You can choose to have background color, also, if you make this color transparent, it will work as overlay color on the image chosen above.', 'webapp' ),
									  'default' => '',
									  'rgba'    => true,
									  'dependency' => array( '_single_enable_headline', '==', 'true' ),
								),

								array(
									'id'      => '_single_enable_tpadding',
									'type'    => 'switcher',
									'title'   => esc_html__( 'Enable Top padding', 'webapp' ),
									'label'   => esc_html__( 'When enabled, the page has some white space on the top. Recommended to disable if you want page builder to cover from top of this page.', 'webapp' ),
									'default' => true
								),
								array(
									'id'      => '_single_enable_bpadding',
									'type'    => 'switcher',
									'title'   => esc_html__( 'Enable bottom padding', 'webapp' ),
									'label'   => esc_html__( 'When enabled, the page has some space on the bottom before footer starts. Recommended to disable if you want page builder to cover till last of this page.', 'webapp' ),
									'default' => true
								),

							), // end: fields
						), // end: a section

				);

/* Start creating meta options. */

$options = array(); // remove old options

// -----------------------------------------
// Page Metabox Options                    -
// -----------------------------------------



		$options[] = array(
			'id'        => '_tt_meta_page_opt',
			'title'     => 'Page Options',
			'post_type' => 'page',
			'context'   => 'normal',
			'priority'  => 'default',
			'sections'  => $tt_temptt_default_meta

		);
		$options[] = array(
			'id'        => '_tt_meta_page_opt',
			'title'     => 'Posts Options',
			'post_type' => 'post',
			'context'   => 'normal',
			'priority'  => 'default',
			'sections'  => $tt_temptt_default_meta

		);

		// Note : Meta options for CPTs are triggered from plugin as needed by this theme.
		return $options;

	}

	add_filter( 'cs_metabox_options', 'tt_temptt_metas_opt' );
}


