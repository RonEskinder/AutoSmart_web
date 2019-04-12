<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------
 *
 * This file contains required functions for the theme.
 * @templatation.com
 *
-----------------------------------------------------------------------------------*/

add_action( 'wp_head', 'tt_webapp_wp_head', 9 );
if ( ! function_exists( 'tt_webapp_wp_head' ) ) {
/**
 * Output the default ttFramework "head" markup in the "head" section.
 * @since  2.0.0
 * @return void
 */
function tt_webapp_wp_head() {
	do_action( 'tt_webapp_wp_head_before' );

	// Output custom favicon icons
	if ( function_exists( 'tt_webapp_custom_favicon' ) && ! function_exists( 'wp_site_icon' ) )
		tt_webapp_custom_favicon();
	// Output custom styles to Head.
	if ( function_exists( 'tt_webapp_custom_styling' ) )
		tt_webapp_custom_styling();

	do_action( 'tt_webapp_wp_head_after' );
} // End tt_webapp_wp_head()
}

/*-----------------------------------------------------------------------------------*/
/* tt_get_dynamic_value() */
/* Replace values in a provided array with theme options, if available. */
/*
/* $settings array should resemble: $settings = array( 'theme_option_without_tt' => 'default_value' );
/*
/* @since 4.4.4 */
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'tt_temptt_opt_values' )) {
	function tt_temptt_opt_values( $settings ) {
		global $tt_temptt_opt;

		if ( is_array( $tt_temptt_opt ) ) {
			foreach ( $settings as $k => $v ) {

				if ( is_array( $v ) ) {
					foreach ( $v as $k1 => $v1 ) {
						if ( isset( $tt_temptt_opt[ 'tt_' . $k ][ $k1 ] ) && ( $tt_temptt_opt[ 'tt_' . $k ][ $k1 ] != '' ) ) {
							$settings[ $k ][ $k1 ] = $tt_temptt_opt[ 'tt_' . $k ][ $k1 ];
						}
					}
				} else {
					if ( isset( $tt_temptt_opt[ 'tt_' . $k ] ) && ( $tt_temptt_opt[ 'tt_' . $k ] != '' ) ) {
						$settings[ $k ] = $tt_temptt_opt[ 'tt_' . $k ];
					}
				}
			}
		}

		return $settings;
	} // End tt_temptt_opt_values()
}


/*-----------------------------------------------------------------------------------*/
/* tt_temptt_get_option() */
/* Replace values in a provided variable with theme options, if available. */
/*
 * field id should be without tt_
 */
/* TT @since 6.0 */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_temptt_get_option' ) ) {
	function tt_temptt_get_option( $var, $default = false ) {
		global $tt_temptt_opt;

		if ( isset( $tt_temptt_opt[ 'tt_' . $var ] ) ) {
			$var = $tt_temptt_opt[ 'tt_' . $var ];
		} else {
			$var = $default;
		}

		return $var;
	} // End tt_temptt_get_option()
}

/*-----------------------------------------------------------------------------------*/
/* Add a class to body_class if fullwidth slider to appear. */
/*-----------------------------------------------------------------------------------*/

add_filter( 'body_class','tt_webapp_body_class', 10 );// Add layout to body_class output

if ( ! function_exists( 'tt_webapp_body_class' ) ) {
function tt_webapp_body_class( $classes ) {

	global $tt_temptt_opt, $wp_query;
	$current_page_template = $single_data2 = $tt_post_id = $single_enable_headline = $single_enable_overlap = '';

	//setting up defaults.
	$settings6 = tt_temptt_opt_values( array(  'enable_sticky' => '1',
												'img_corner'    => '1',
												'enable_pluscursor'    => '1',
											 ) );

	if ( !is_404() && !is_search() ) {
		if ( ! empty( $wp_query->post->ID ) ) {
			$tt_post_id = $wp_query->post->ID;
		}
	}
	$single_data2 = get_post_meta( $tt_post_id, '_tt_meta_page_opt', true );
	if( is_array($single_data2) ) {
		if ( isset( $single_data2['_single_enable_headline'] ) ) $single_enable_headline = $single_data2['_single_enable_headline'];
		if ( isset( $single_data2['_single_enable_overlap'] ) ) $single_enable_overlap = $single_data2['_single_enable_overlap'];
		if ( isset( $single_data2['_single_enable_bpadding'] ) ) $single_enable_bpadding = $single_data2['_single_enable_bpadding'];
		if ( isset( $single_data2['_single_enable_tpadding'] ) ) $single_enable_tpadding = $single_data2['_single_enable_tpadding'];
	}

	if ( !is_page() && (!isset($single_enable_headline) || empty($single_enable_headline)) ) $single_enable_headline = false;
	if ( !isset($single_enable_overlap) ) $single_enable_overlap = false;
	if ( !isset($single_enable_bpadding) ) $single_enable_bpadding = true;
	if ( !isset($single_enable_tpadding) ) $single_enable_tpadding = true;

	// fetching which page template is being used to render current post/page.
	if ( !empty($tt_post_id) ) { $current_page_template = get_post_meta($tt_post_id, '_wp_page_template', true); }
	if ( is_singular()) { $classes[] = 'tt-single'; } // add a custom class if single item is displayed except blog template is being used, for styling purpose.
	if ( $single_enable_headline ) { $classes[] = 'hdline_set'; }
	if ( $settings6['enable_sticky'] ) { $classes[] = 'header-sticky'; }
	if ( ! empty( $single_enable_overlap )) { $classes[] = 'hdr-overlap'; } else { $classes[] = 'hdr-no-overlap'; }
	if ( $settings6['enable_pluscursor'] ) { $classes[] = 'plus-cursor'; } // add a custom class if + cursor is on.
	if ( ! $single_enable_bpadding && ! is_page('blog') ) { $classes[] = 'no-bpadd'; }
	if ( ! $single_enable_tpadding && ! is_page('blog') ) { $classes[] = 'no-tpadd'; }
	if ( ! class_exists( 'Redux' ) ) { $classes[] = 'no-redux'; }
	return $classes;
  }
}

/*-----------------------------------------------------------------------------------*/
/* Load custom logo. */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_logo' ) ) {
function tt_webapp_logo () {
	global $tt_temptt_opt;
	$width = $height = $style = $logo = '';
	$settingsl = array(
					'retina_favicon' => '0',
					'texttitle' => '0',
					'logo' => '',
					'retina_logo_wh' => '',
				);
	$settingsl = tt_temptt_opt_values( $settingsl );

	if ( $settingsl['texttitle'] == '1' ) return; // Get out if we're not displaying the logo.

	$logo = esc_url( TT_TEMPTT_THEME_DIRURI . 'images/logo2.png' );
	if ( isset( $tt_temptt_opt['tt_logo']['url'] ) && $tt_temptt_opt['tt_logo']['url'] != '' ) { $logo = $tt_temptt_opt['tt_logo']['url'] ; }
	if ( is_ssl() ) { $logo = str_replace( 'http://', 'https://', $logo ); }
?>

	<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
	 <?php if ( '0' == $settingsl['retina_favicon'] ) { ?>
		<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	 <?php } else {
       if( $settingsl['retina_logo_wh']['width'] != '0px' && $settingsl['retina_logo_wh']['width'] != 'px' ) {
			if (strpos($settingsl['retina_logo_wh']['width'],'px') !== false) {
				$width = 'width:'.$settingsl['retina_logo_wh']['width'].';';
			}
			else{
				$width = 'width:'.$settingsl['retina_logo_wh']['width'].'px;';
			}
        }
        if ($settingsl['retina_logo_wh']['height'] != '0px' && $settingsl['retina_logo_wh']['height'] != 'px') {
			if (strpos($settingsl['retina_logo_wh']['height'],'px') !== false) {
				$height = 'height:'.$settingsl['retina_logo_wh']['height'].';';
			}
			else{
				$height = 'height:'.$settingsl['retina_logo_wh']['height'].'px;';
			}
        }
		if ( !empty($width) ) $style .= $width;
		if ( !empty($height) ) $style .= $height ;
		if ( !empty($style) ) $style = 'style="'.$style.'"';
		?>
		<img src="<?php echo esc_url( $logo ); ?>" <?php echo wp_strip_all_tags( $style ); ?> alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	 <?php } ?>
	</a>
<?php
} // End tt_webapp_logo()
}

/*-----------------------------------------------------------------------------------*/
/* Load custom favicon. */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'tt_webapp_favicon_info' ) ) {
function tt_webapp_favicon_info () {
	global $tt_temptt_opt;
	$fv = '';

	$fv = esc_url( TT_TEMPTT_THEME_DIRURI . 'favicon.ico' );
	if ( isset( $tt_temptt_opt['tt_favicon_info1']['url'] ) && $tt_temptt_opt['tt_favicon_info1']['url'] != '' ) { $fv = $tt_temptt_opt['tt_favicon_info1']['url'] ; }
	if ( is_ssl() ) { $fv = str_replace( 'http://', 'https://', $fv ); }
?>
    <link href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="shortcut icon" type="image/x-icon" />
	<link href="<?php echo esc_url( $fv ); ?>" rel="shortcut icon" type="image/x-icon" />
<?php
} // End tt_webapp_favicon_info()
}


/*-----------------------------------------------------------------------------------*/
/* Post/page title
/*-----------------------------------------------------------------------------------*/
// returns title based on the requirement.

if (!function_exists( 'tt_temptt_post_title')) {
function tt_temptt_post_title( $tag='' ){

	global $wp_query;
	$tt_post_id = $single_item_layout = $tt_lay_content = $tt_lay_sidebar = $single_data2 = '';
	if( empty($tag)) $tag = 'h3';

		if ( ! is_404() && ! is_search() ) {
			if ( ! empty( $wp_query->post->ID ) ) {
				$tt_post_id = $wp_query->post->ID;
			}
		}
		if ( ! empty( $tt_post_id ) ) {
			$single_data2 = get_post_meta( $tt_post_id, '_tt_meta_page_opt', true );
		}
		if ( is_array( $single_data2 ) ) {
			if ( !empty( $single_data2['_hide_title_display'] ) ) {
				return '';
			}
		}

	return '<div class="single-post-title"><'.$tag. ' class="ml-title">'. get_the_title() .'</'.$tag.'></div>';
}
}
/*-----------------------------------------------------------------------------------*/
/* return excerpt with given charlent.                                               */
/*-----------------------------------------------------------------------------------*/
// source https://codex.wordpress.org/Function_Reference/get_the_excerpt
if (!function_exists( 'tt_webapp_excerpt_charlength')) {
	function tt_webapp_excerpt_charlength( $charlength ) {
		$excerpt = get_the_excerpt();
		$charlength ++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex   = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo esc_attr($subex);
			}
			echo '...';
		} else {
			echo esc_attr($excerpt);
		}
	}
}
/*-----------------------------------------------------------------------------------*/
/* Templatation , render featured post thumb function.                               */
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'tt_webapp_post_thumb') ) {
	function tt_webapp_post_thumb( $width = null, $height = null, $lightbox = true, $crop = true, $srconly = false, $id = '' ) {
		global $tt_temptt_opt, $post;
		if( empty($id) ) $id = get_the_ID();
		if( empty($id) ) return ''; // no id, nothing left to do.
		$output = $single_w = $single_h = $featuredimg = '';

		$featuredimg =  get_post_thumbnail_id($id);
		$featuredimg = wp_get_attachment_image_src( $featuredimg, 'full' );
		$featuredimg = $featuredimg[0];

		if( !isset( $featuredimg ) || empty ( $featuredimg ) ) return ''; // no image found, return.

		// if width and height is not given, we dont need to resize so output the full image.
		if( empty( $width ) || empty ( $height ) ) {

			if( $srconly ) { $returnimg = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' ); $returnimg = $returnimg[0]; }
			else $returnimg = get_the_post_thumbnail($id, 'full');

			return $returnimg;
		}

		$featuredimg = tt_webapp_aq_resize( $featuredimg, $width, $height, $crop, false ); // this returns an array if image was cropped, and url otherwise.

		if( is_array( $featuredimg )) {
			$output = '
				<a class="post-img" href="'.$featuredimg[0].'">
						<img width="'.$featuredimg[1].'" height="'.$featuredimg[2].'" class="img-responsive" alt="" src="'.$featuredimg[0].'">
				</a>
			';
			if ( !$lightbox ) $output = '<img width="'.$featuredimg[1].'" height="'.$featuredimg[2].'" class="img-responsive" alt="" src="'.$featuredimg[0].'">'; // if no lightbox needed, turn the link off.
		}
		else $output = '<img class="img-responsive" alt="" src="'.$featuredimg.'">'; // image was not cropped so AQ returned URL.

		if( $srconly )  $output = isset($featuredimg[0]) ? $featuredimg[0] : $featuredimg;
		return $output;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Adding hero images for pages                                                      */
/*-----------------------------------------------------------------------------------*/
if( !function_exists('tt_webapp_hero_section') ) {
	function tt_webapp_hero_section() {
	global $tt_temptt_opt, $wp_query;
	$tt_post_id = $bg_output = $single_page_img = $single_enable_headline = $single_headline_heading1 = $single_headline_heading2 = $single_headline_message = '';
	if ( is_404() || is_search() ) return;
	if( isset($wp_query->post->ID)) $tt_post_id = $wp_query->post->ID;
	if(is_home()) $tt_post_id = get_option( 'page_for_posts' );
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() ) {
			$tt_post_id = get_option( 'woocommerce_shop_page_id' );
		}
		if ( is_account_page() ) {
			$tt_post_id = get_option( 'woocommerce_myaccount_page_id' );
		}
		if ( is_checkout() ) {
			$tt_post_id = get_option( 'woocommerce_checkout_page_id' );
		}
		if ( is_cart() ) {
			$tt_post_id = get_option( 'woocommerce_cart_page_id' );
		}
	}
	if( empty($tt_post_id) ) return; // nothing left to do!

	// fetching value from single posts .
	$single_data2 = get_post_meta( $tt_post_id, '_tt_meta_page_opt', true );
	if( is_array($single_data2) ) {
		if ( isset( $single_data2['_single_enable_headline'] ) ) $single_enable_headline = $single_data2['_single_enable_headline'];
		if ( isset( $single_data2['_single_headline_title'] ) ) $single_headline_heading1 = esc_attr($single_data2['_single_headline_title']);
		if ( isset( $single_data2['_single_headline_title_bold'] ) ) $single_headline_heading2 = esc_attr($single_data2['_single_headline_title_bold']);
		if ( isset( $single_data2['_single_headline_message'] ) ) $single_headline_message = esc_textarea($single_data2['_single_headline_message']);
		if ( isset( $single_data2['_single_page_img'] ) ) $single_page_img = esc_textarea($single_data2['_single_page_img']);
		if ( isset( $single_data2['_single_page_color'] ) ) $single_page_color = esc_attr($single_data2['_single_page_color']);
	}
	// setting defaults
	if ( !is_page() && (!isset($single_enable_headline) || empty($single_enable_headline)) ) $single_enable_headline = false;
	if( !$single_enable_headline ) return; // do nothing if headline not set.
	ob_start();
		empty($single_page_img) ? $bg_output = 'background:#2C1E53' : $bg_output = $single_page_img ;
		?>
<div class="header-relative header-home">
            <div class="clip">
                <div class="bg bg-bg">
                    <img class="center-image" src="<?php echo esc_attr($bg_output); ?>" alt="bg"/>
                </div>
	            <div class="overlay-clr" style="<?php echo 'background-color: '. $single_page_color.';'; ?>"></div>
            </div>
            <div class="container">
                <div class="title-block title-block_mod">
                    <h1><?php echo esc_attr($single_headline_heading1); ?> <span><?php echo esc_attr($single_headline_heading2); ?></span></h1>
                </div>
            </div>
        </div>
		<?php
	echo ob_get_clean(); // all variables in html blcok are already escaped. we can output directly.
	}
}
add_action( 'tt_before_container', 'tt_webapp_hero_section' );



/*-----------------------------------------------------------------------------------*/
/* Topnav function */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'templatation_topnav_content' ) ) {
function templatation_topnav_content () {

	if ( tt_temptt_get_option( 'enable_topbar', 0 ) == '0' ) return; // do nothing if nav bar is disabled.

	// Fetch left side content
	$top_nav_left_layout = tt_temptt_get_option('top_nav_left_layout', '');
	$nav_left_layout = $top_nav_left_layout['enabled'];

	// Fetch right side content
	$top_nav_right_layout = tt_temptt_get_option('top_nav_right_layout', '');
	$nav_right_layout = $top_nav_right_layout['enabled'];

$output = '
<div class="top-line hidden-xs">
	<div class="container">';

$output .= '
	<!-- Start left side content -->
	<div class="left-content">';
	$output .= templatation_topnav_content_render( $nav_left_layout );
	$output .=
	'</div><!-- .left-content -->';

$output .= '
	<!-- Start right side content -->
	<div class="right-content">';
	$output .= templatation_topnav_content_render( $nav_right_layout );
	$output .=
	'</div><!-- .right-content -->';

$output .= '
	</div>
</div>';

	$output = apply_filters('tt_topnav_content_before_output', $output);

	return  $output;
} // End templatation_topnav_content()
}



/*-----------------------------------------------------------------------------------*/
/* Topnav render function */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'templatation_topnav_content_render' ) ) {
function templatation_topnav_content_render ( $nav_layout = null ) {
	global $tt_temptt_opt;
	$output =  "";
	$topsettings = array(
					'enable_topbar'         => '1',
					//'enable_showhide'     => '1',
					'ttext_icon'            => '',
					'ttext_text'            => '',
					'contact_number'        => '',
					'contactform_email'     => '',
					'top_nav_menu'          => '',
					'top_nav_email_icon'    => '1',
					'top_nav_phone_icon'    => '1',
					'connect_rss'           => '',
					'connect_twitter'       => '',
					'connect_facebook'      => '',
					'connect_youtube'       => '',
					'connect_flickr'        => '',
					'connect_linkedin'      => '',
					'connect_pinterest'     => '',
					'connect_instagram'     => '',
					'connect_googleplus'    => '',
					'feed_url'              => ''
					);

	$topsettings = tt_temptt_opt_values( $topsettings );

ob_start();

// available content blocks.
// email, text_icon, text, phone_icon, phone, wpml_lang, search, social

if ($nav_layout): foreach ($nav_layout as $key=>$value) {

    switch($key) {

        case 'email':

			if ( !empty( $topsettings['contactform_email'] )) { ?>
			<span>
				<a href="mailto:<?php echo sanitize_email($topsettings['contactform_email']); ?>"><?php echo sanitize_email($topsettings['contactform_email']); ?></a>
			</span>
			<?php }


        break;

        case 'teaser_text':

			if ( $topsettings['ttext_text'] != '' ) { echo '<span class="tt-top-teaser">'. stripslashes( esc_attr( $topsettings['ttext_text'] )) .'</span>';  }

        break;

        case 'phone':

			if ( !empty( $topsettings['contact_number'] )) { ?>
			<span>
				<a href="tel:<?php echo preg_replace('/(\W*)/', '', $topsettings['contact_number']); ?>"><?php echo esc_attr($topsettings['contact_number']); ?></a>
			</span>
			<?php }

        break;

        case 'wpml_lang':

						do_action('icl_language_selector');

        break;

        case 'custommenu':

		            if ( !empty( $topsettings['top_nav_menu'] ) ) {
		                wp_nav_menu( array( 'depth'          => 1,
		                                    'sort_column'    => 'menu_order',
		                                    'container'      => 'ul',
		                                    'menu_class'     => 'top-nav sup-nav',
		                                    'menu'        => $topsettings['top_nav_menu'],
		                ) );
		            }

        break;

        case 'spacer':

		            ?>
	                <div class="topnav-spacer"></div>
	        <?php

        break;

        case 'spacer2':

		            ?>
	                <div class="topnav-spacer"></div>
	        <?php

        break;

        case 'social':
					?>
					<div class="social">
						<?php if ( !empty( $topsettings['connect_twitter'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_twitter'] ); ?>" class="twitter" title="Twitter"></a>
						<?php } if ( !empty( $topsettings['connect_facebook'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_facebook'] ); ?>" class="facebook" title="Facebook"></a>
						<?php } if ( !empty( $topsettings['connect_youtube'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_youtube'] ); ?>" class="youtube" title="YouTube"></a>
						<?php } if ( $topsettings['connect_rss' ] == "1" ) { ?>
						<a href="<?php if ( $topsettings['feed_url'] ) { echo esc_url( $topsettings['feed_url'] ); } else { echo get_bloginfo_rss('rss2_url'); } ?>" class="subscribe" title="RSS"></a>
						<?php } if ( !empty( $topsettings['connect_flickr'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_flickr'] ); ?>" class="flickr" title="Flickr"></a>
						<?php } if ( !empty( $topsettings['connect_linkedin'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_linkedin'] ); ?>" class="linkedin" title="LinkedIn"></a>
						<?php } if ( !empty( $topsettings['connect_pinterest'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_pinterest'] ); ?>" class="pinterest" title="Pinterest"></a>
						<?php } if ( !empty( $topsettings['connect_instagram'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_instagram'] ); ?>" class="instagram" title="Instagram"></a>
						<?php } if ( !empty( $topsettings['connect_googleplus'] ) ) { ?>
						<a href="<?php echo esc_url( $topsettings['connect_googleplus'] ); ?>" class="googleplus" title="Google+"></a>
						<?php } ?>
					</div>
					<?php
        break;

    }

}

endif;
	$output = ob_get_clean();
	return $output;

} //templatation_topnav_content_render
}
/*-----------------------------------------------------------------------------------*/
/* Misc small functions for visuals.                                                 */
/*-----------------------------------------------------------------------------------*/
// Adding span tag in category widgets for styling purpose
add_filter('wp_list_categories', 'tt_webapp_cat_count');
function tt_webapp_cat_count($links) {
  $links = str_replace('</a> (', ' <span>(', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}


// adding filter to add class in previous/next post button.
add_filter('next_post_link', 'tt_webapp_post_link_attr');
add_filter('previous_post_link', 'tt_webapp_post_link_attr');
function tt_webapp_post_link_attr($output) {
    $injection = 'class="button"';
    return str_replace('<a href=', '<a '.$injection.' href=', $output);
}

// modifying search form.
function tt_webapp_search_form( $form ) {
    $form = '<form method="get" id="searchform" class="searchform search-form" action="' . esc_url(home_url( '/' )) . '" >
    <div><label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'webapp' ) . '</label>
    <input class="search-field" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'. esc_html__( 'Search&hellip;', 'webapp' ) .'"  />
<div class="searchsubmit-btn">
 <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Go', 'webapp' ) .'">
 <i class="fa fa-search" aria-hidden="true"></i>
</div>
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'tt_webapp_search_form', 100 );
/*-----------------------------------------------------------------------------------*/
/* Breadcrumb display */
/*-----------------------------------------------------------------------------------*/
// use Yoast

/*-----------------------------------------------------------------------------------*/
/* Comment Form Fields */
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* Comment Form Settings */
/*-----------------------------------------------------------------------------------*/

	add_filter( 'comment_form_default_fields', 'tt_webapp_cmntform_fields' );

	if ( ! function_exists( 'tt_webapp_cmntform_fields' ) ) {
		function tt_webapp_cmntform_fields ( $fields ) {

		
			$fields =  array(
				'author' => '<div class="form-group group-input group-input-first">' .
							'<label for="type-text">' . esc_html__( 'Your Name *', 'webapp' ) . '</label>' .
							'<input id="author"  class="commentary-input comm-field" name="author"  />' .
							'</div>',
				'email'  => '<div class="form-group group-input ">' .
							'<label for="type-text">' . esc_html__( 'Your Email *', 'webapp' ) . '</label>' .
				            '<input id="email" class="commentary-input comm-field" name="email"  type="text"  />' .
				            '</div>',
			);

			//$commenter = wp_get_current_commenter();

			$required_text = ' <span class="required">(' . esc_html__( 'Required', 'webapp' ) . ')</span>';

			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );

			return $fields;

		} // End tt_webapp_cmntform_fields()
	}

	


	add_filter( 'comment_form_defaults', 'tt_webapp_cmntform_settings' );

	if ( ! function_exists( 'tt_webapp_cmntform_settings' ) ) {
		function tt_webapp_cmntform_settings ( $settings ) {
			   $settings['comment_field']  = '<div class="form-group form-group-text"><label>'. esc_html__( 'Your Comment *', 'webapp' ) .'</label>' .
			   								'<textarea id="comment" class="commentary-textarea comm-field"  name="comment" aria-required="true"></textarea></div>';
			return $settings;

		} // End tt_webapp_cmntform_settings()

			$settings['comment_notes_before'] = '';
			$settings['comment_notes_after'] = '';
			$settings['label_submit'] = esc_html__( 'SUBMIT', 'webapp' );
			$settings['cancel_reply_link'] = esc_html__( 'Click here to cancel reply.', 'webapp' );
  // redefine your own textarea (the comment body)
     
	}


/*-----------------------------------------------------------------------------------*/
/**
 * tt_webapp_archive_desc()
 *
 * Display a description, if available, for the archive being viewed (category, tag, other taxonomy).
 *
 * @since V1.0.0
 * @uses do_atomic(), get_queried_object(), term_description()
 * @echo string
 * @filter tt_webapp_archive_desc
 */

if ( ! function_exists( 'tt_webapp_archive_desc' ) ) {
	function tt_webapp_archive_desc ( $echo = true ) {
		do_action( 'tt_webapp_archive_desc' );
		$description = '';
		// Archive Description, if one is available.
		$term_obj = get_queried_object();
		if(is_array($term_obj))
		$description = term_description( $term_obj->term_id, $term_obj->taxonomy );

		if ( $description != '' ) {
			// Allow child themes/plugins to filter here ( 1: text in DIV and paragraph, 2: term object )
			$description = apply_filters( 'tt_webapp_archive_desc', '<div class="archive-description">' . $description . '</div><!--/.archive-description-->', $term_obj );
		}

		if ( $echo != true ) { return $description; }

		echo esc_attr($description);
	} // End tt_webapp_archive_desc()
}


/*-----------------------------------------------------------------------------------*/
/* Check if WooCommerce is activated */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_is_wc' ) ) {
	function tt_webapp_is_wc() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Truncate */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_truncate' ) ) {
	function tt_webapp_truncate($text, $limit, $sep='...') {
		if (str_word_count($text, 0) > $limit) {
			$words = str_word_count($text, 2);
			$pos = array_keys($words);
			$text = strip_tags( $text );
			$text = substr($text, 0, $pos[$limit]) . $sep;
		}
		return $text;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Fixing the font size for the tag cloud widget.                                    */
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function tt_webapp_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;
	// Add the blog name
	$title .= $sep." ".get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary: , commenting cause below results in an warning.
/*	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( esc_html__( 'Page %s', '_s' ), max( $paged, $page ) );
	}*/

	return $title;
}
//add_filter( 'wp_title', 'tt_webapp_wp_title', 10, 2 );



/*-----------------------------------------------------------------------------------*/
/* Function for Adding Retina support, thanks to C.bavota                            */
/*-----------------------------------------------------------------------------------*/
add_filter( 'wp_generate_attachment_metadata', 'tt_webapp_retina_attchmt_meta', 10, 2 );
/**
 * Retina images
 *
 * This function is attached to the 'wp_generate_attachment_metadata' filter hook.
 */
if ( ! function_exists( 'tt_webapp_retina_attchmt_meta' ) ) {
function tt_webapp_retina_attchmt_meta( $metadata, $attachment_id ) {
    foreach ( $metadata as $key => $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $image => $attr ) {
                if ( is_array( $attr ) )
                    tt_webapp_retina_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
            }
        }
    }

    return $metadata;
}
}
/**
 * Create retina-ready images
 *
 * Referenced via tt_webapp_retina_attchmt_meta().
 */
if ( ! function_exists( 'tt_webapp_retina_create_images' ) ) {
function tt_webapp_retina_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}
}
add_filter( 'delete_attachment', 'tt_webapp_delete_retina_images' );
/**
 * Delete retina-ready images
 *
 * This function is attached to the 'delete_attachment' filter hook.
 */
if ( ! function_exists( 'tt_webapp_delete_retina_images' ) ) {
function tt_webapp_delete_retina_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    $upload_dir = wp_upload_dir();
	if (isset($meta["file"])) {
		$path = pathinfo( $meta["file"] );
		foreach ( $meta as $key => $value ) {
			if ( "sizes" === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
				}
			}
		}
	}
}
}


/*-----------------------------------------------------------------------------------*/
/* tt_webapp_prev_post function */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_prev_post' ) ) {
	function tt_webapp_prev_post() {
		$output    = '';
		$prev_post = get_adjacent_post( true, '', true );
		if ( is_a( $prev_post, 'WP_Post' ) ) {
			$output = '<div class="fl"><a class="tt_prev_post button" title="'. get_the_title( $prev_post->ID ) .'" href="' . get_permalink( $prev_post->ID ) . '">' . esc_html__( 'Previous Post', 'webapp' ) . '</a></div>';
		}

		return $output;
	} // End tt_webapp_prev_post()
}
/*-----------------------------------------------------------------------------------*/
/* tt_webapp_next_post function */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_next_post' ) ) {
	function tt_webapp_next_post() {
		$output    = '';
		$prev_post = get_adjacent_post( true, '', false );
		if ( is_a( $prev_post, 'WP_Post' ) ) {
			$output = '<div class="fr"><a class="tt_next_post button" title="'. get_the_title( $prev_post->ID ) .'" href="' . get_permalink( $prev_post->ID ) . '">' . esc_html__( 'Next Post', 'webapp' ) . '</a></div>';
		}

		return $output;
	} // End tt_webapp_next_post()
}

/*-----------------------------------------------------------------------------------*/
/* tt_webapp_post_title function */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_post_title' ) ) {
function tt_webapp_post_title ( ) {

	$hide_title_display = $tt_page_title = $titlesettings = ''; $id = get_the_ID();
	$hide_title_display = get_post_meta( $id, '_tt_meta_page_opt', true );
	if( isset($hide_title_display['_hide_title_display'])) $titlesettings = $hide_title_display['_hide_title_display'];

	ob_start(); ?>
		<header class="post-header lc_tt_title">
			<ul>
				<li><?php the_time( 'M j, Y' ); ?></li>
				<li><?php if(!comments_open($id)) echo 'Comments Off'; else comments_popup_link( esc_html__( 'Zero comments', 'webapp' ), esc_html__( '1 Comment', 'webapp' ), esc_html__( '% Comments', 'webapp' ) ); ?></li>
			</ul>
			<h1><?php if( strlen( get_the_title()) > 1 ) { ?> <a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'webapp' ); ?>"><?php the_title(); ?></a> <?php } ?></h1>
		</header>
		<?php

	$tt_post_title = ob_get_clean();
	if( is_singular() ){
		if( empty($titlesettings) || $titlesettings == '0' ) {
			echo esc_attr($tt_post_title);
		} // display title if not being hidden in single post.
	}
	else { echo esc_attr($tt_post_title); }
	} // End tt_webapp_post_title()
}

/*-----------------------------------------------------------------------------------*/
/* tt_webapp_page_title function */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_page_title' ) ) {
function tt_webapp_page_title ( ) {

	$hide_title_display = $tt_page_title = $titlesettings = '';
	$hide_title_display = get_post_meta( get_the_ID(), '_tt_meta_page_opt', true );
	if( isset($hide_title_display['_hide_title_display'])) $titlesettings = $hide_title_display['_hide_title_display'];

	ob_start();
	if ( empty($titlesettings) || $titlesettings == '0' ) { ?>
		<header class="post-header">
			<h1><?php if( strlen( get_the_title()) > 1 ) the_title(); ?></h1>
		</header>
		<?php
	} // display title if not being hidden in single page/post.

	$tt_page_title = ob_get_clean();
	echo esc_attr($tt_page_title);

	} // End tt_webapp_page_title()
}


function tt_webapp_lc_search_sc() {
	global $post;
	$id = get_the_ID();
	$show_fake = false;

	if ( get_post_type( $id ) == 'tt_misc' ) {
		$show_fake = true;
	}

	if ( $show_fake ) {
		return '<div class="dslc-notification dslc-red">Search Form appears here.</div>';
	}
	else {

		ob_start();
		get_search_form();

		$output = ob_get_clean();
		if ( get_post_type( $id ) == 'tt_misc' ) {
			$output = '[tt_lc_search] Shortcode';
		}

		return $output;
	}
}


function tt_webapp_lc_title(){
	global $tt_temptt_opt, $post;
	$post_id = get_the_ID();
	$show_fake = true;

	$hide_title_display = $titlesettings = "";
	if ( is_singular() ) {
		$show_fake = false;
	}

	if ( get_post_type( $post_id ) == 'dslc_templates' ) {
		$show_fake = true;
	}

	if ( $show_fake ) {
		return '<div class="dslc-notification dslc-red">Post Title Appears Here.</div>';
	}
	else {
		$hide_title_display = get_post_meta( $post_id, '_tt_meta_post_opt', true );
		if ( is_array( $hide_title_display ) ) {
			$titlesettings = $hide_title_display['_hide_title_display'];
		}
		if ( ! isset( $titlesettings ) || $titlesettings == '0' ) {
			ob_start(); ?>
			<header class="post-header lc_tt_title">
				<ul>
					<li><?php the_time( 'M j, Y' ); ?></li>
					<li><?php comments_popup_link( esc_html__( 'Zero comments', 'webapp' ), esc_html__( '1 Comment', 'webapp' ), esc_html__( '% Comments', 'webapp' ) ); ?></li>
				</ul>
				<h1><?php the_title(); ?></h1>
			</header>
		<?php } // display title if not being hidden in single page/post.
		$output = ob_get_clean();

		return $output;
	}
}

function tt_webapp_tt_numComments() {
	$tt_numComments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( $tt_numComments == 0 ) {
		$comments = esc_html__('No comments yet.', 'webapp');
	} elseif ( $tt_numComments > 1 ) {
		$comments = $num_comments . esc_html__(' Comments', 'webapp');
	} else {
		$comments = esc_html__('1 Comment', 'webapp');
	}

	$output = $comments;

	return '<h2><span>'. $output .'</span></h2>';
}

/*-----------------------------------------------------------------------------------*/
/* Function to get copyrights. */
/*-----------------------------------------------------------------------------------*/


if (!function_exists('tt_webapp_copy_f')) {
	function tt_webapp_copy_f() {

	global $tt_temptt_opt;
	$settings = array (
		'footer_right_text' => ''
	);

	$settings = tt_temptt_opt_values( $settings );


	print esc_html($settings['footer_right_text']);
	}
}


/*-----------------------------------------------------------------------------------*/
/* Add Custom Styling to HEAD */
/*-----------------------------------------------------------------------------------*/
// this is hooked into wp_head.

if ( ! function_exists( 'tt_webapp_custom_styling' ) ) {
	function tt_webapp_custom_styling( $force = false ) {
		global $tt_temptt_opt;
		$output = $woo_hdr_class = $body_image = '';
		// Get options
		$settings = array(
						'main_acnt_clr' => '',
						'custom_css' => ''
						);
		$settings = tt_temptt_opt_values( $settings );

		if($force) { // we have been forced to show specific colors.
			$settings['main_acnt_clr'] = $tt_temptt_opt['tt_main_acnt_clr'];
		}

		// Type Check for Array
		if ( is_array($settings) ) {

		if ( ! ( $settings['main_acnt_clr'] == '' )) { // only if user changed!
			$output .= '


body .yikes-easy-mc-form input[type=email]:focus, .commentary-input:focus, .commentary-textarea:focus,.figure figcaption,.acount-users,.subscribe-email:focus,.slider-menu-item.active, .slider-menu-item.focus,.slider-menu-item:hover,.nav > ul  > li.current-menu-item > a,.categories-links a.cat-all,.pager-container .next, .pager-container .prev,.button,.circle-style li:before,.message-box,.element-social a ,.widget_search form,button, html input[type="button"], input[type="reset"], input[type="submit"],.subscribe-email:focus, .contact-form-container .form-control:focus,input:focus, select:focus, textarea:focus, .avatar, .button:hover,.ftr-social a:hover
{ border-color: '.$settings['main_acnt_clr'].'; }

body .yikes-easy-mc-form .yikes-easy-mc-submit-button, .pager-container a.active, .pager-container span.p-point.active, .pager-container .page-numbers.current,.post-title:after,.table tr td:first-of-type .help-info:hover .help,.table tr td:first-of-type .help:hover,.offers-status,.offers-container:hover,.mask-wrapper .send-file ,.fr-info,.pagination-video .swiper-pagination-bullet,.start-arrow,.tour-social-ico a,.section_mod_green,.btn-subscribe,.section-logos,.benefits-list:hover .benefits-text-ico,.benefits-icon,.section-you-get,.bx-wrapper .bx-pager.bx-default-pager a.active,.pagination-small .swiper-pagination-bullet-active,.pager-container .next, .pager-container .prev,.pager-container a.active, .pager-container span.p-point.active, .pager-container  .page-numbers.current,.button,.number-style li:before,.line-style li:before,.message-box_green,.single-article .article-tags-container a:hover,.tag:hover, .tag.act,.tagcloud a:hover,.element-social a.elem-p-ico:hover,.element-social a ,.category-list li.active a:after, .list-meta li.active a:after,.widget_categories li a:hover:after, .list-meta li a:hover:after,.element-title:after,button, html input[type="button"], input[type="reset"], input[type="submit"],.wpcf7-submit, .swiper-active-switch,.top-line .social a, .scrollup, .popular-post a:first-of-type:hover:after,.sub-menu, p.separator, .wa-mainbg, .post-img:hover:after, #lang_sel ul li ul, .btn-subscribe:hover, .offers-container .highlight, .footer .sidebar-widget-title .title::after, .ftr-widget .ftr-title::after,.ftr-social a:hover
{ background-color:'.$settings['main_acnt_clr'].'; }

.reply:hover,.reply,.post-title a:hover,.post-info i,.help-sub-title span,.hot-price span,.table-caption tr th sup,.table-caption tr th span,.acount-users,.offers-container:hover .start-now:hover ,.btn-now:hover,.customer-name,.benefits-list .benefits-text-ico,.menu-item-has-children:hover > a,.sub-menu li a:hover ,.nav-mobile .sup-nav li a:hover,.nav-mobile ul li.active a,.menu-item-has-children:hover > a,.sup-nav li a:hover ,.nav ul li.current-menu-item.menu-item-has-children > a,.nav > ul  > li.current-menu-item > a,.nav ul li a:hover,.dropcontainer ul li:hover ,.ac-container input:checked + label,.ac-container label:hover,.tabs input:checked + label, .tabss input:checked + label,.categories-links a.cat-all,.categories-links a:hover,.pager-container a:hover, .pager-container span.p-point:hover,.btn-white-green,.button:hover,.message-box .text,.twitters-info a.vis:hover,.twitters-info a.act:hover ,.twitters-info a.act,.post-link:hover,.category-list li.active a, .list-meta li.active a,.category-list li a:hover span, .list-meta li a:hover span,.category-list li a:hover, .list-meta li a:hover ,.widget_categories li a span, .list-meta li a span,.widget_categories  li a:hover,.widget-block a:hover,.widget_nav_menu .sub-menu a:hover,.sticky .post-title a:before,button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover,#alert .message, .reply a,a.banner-btn-1:hover, .info-post span i, a.button:hover i, .element-social a:hover .fa, .contact-block .fa, .menu-item span.arrow-down-green .fa, .arrow-left-cus, .arrow-right-cus, .arrow-left, .arrow-right, #lang_sel .icl_lang_sel_current:after, .btn-box .button:hover a, .btn-box .button:hover i, .btn-box i.button-icon, .footer-read-more a, .powerfull-info-text ul li::after,.ftr-contact::before
{ color: '.$settings['main_acnt_clr'].'; }

.btn-subscribe:hover{ opacity: .6;transition: opacity 0.2s linear 0s;}
						'

			;
		}


		} // End If Statement

			if ( $settings['custom_css'] != '' ) {
				$output .= $settings['custom_css'];
			}

        // add header height css
        if ( function_exists( 'tt_webapp_header_height' ) ) {
          $output .= tt_webapp_header_height();
        }


		// Output styles
		if ( isset( $output ) && $output != '' ) {
			$output = strip_tags( $output );
			// Remove space after colons
			$output = str_replace(': ', ':', $output);
			// Remove whitespace
			$output = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '   ', '    '), '', $output);

			$output = "\n" . "<!-- Theme Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo  $output; // its already sanitized by redux.
		}

	} // End tt_webapp_custom_styling()
}



/*-----------------------------------------------------------------------------------*/
/* Function for color switcher and lang switcher. */
/*-----------------------------------------------------------------------------------*/
/*
 * it only works on demo websites, where its needed by the way.
 */
if( strpos(get_site_url(),'livedemo.wpengine') || strpos(get_site_url(),'livedemo.staging.wpengine') ) {
	add_action('webapp_after_body', 'tt_temptt_clr_switcher');
	add_action('wp_head', 'tt_temptt_clr_switcher_scripts');
	add_filter('tt_topnav_content_before_output', 'tt_temptt_add_demo_switcher',100);
}

if (!function_exists('tt_temptt_clr_switcher_scripts')) {
	function tt_temptt_clr_switcher_scripts() {
		$output = '';
		ob_start(); ?>
	<script type="text/javascript" src="<?php  echo get_template_directory_uri(); ?>/inc/switcher/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/switcher/jscript_styleswitcher.js"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/switcher/styleswitcher.css" />

	<?php
		$output = ob_get_clean();
		print $output; // its safe to output, all variables already escaped above.
}}


if (!function_exists('tt_temptt_add_demo_switcher')) {
	function tt_temptt_add_demo_switcher($output) {
$output = '';
	ob_start(); ?>

<div class="top-line hidden-xs">
	<div class="container">

	<!-- Start left side content -->
	<div class="left-content"></div><!-- .left-content -->
	<!-- Start left side content -->
	<div class="right-content">
		<div id="lang_sel">
		    <ul>
		        <li>
		            <a class="lang_sel_sel icl-en" href="#">
		                <img title="English" alt="en" src="<?php echo get_template_directory_uri();?>/inc/switcher/flags/en.png" class="iclflag">
										&nbsp;
		                <span class="icl_lang_sel_current icl_lang_sel_native">English</span>
		            </a>
		            <ul>
		                <li class="icl-fr">
		                    <a href="http://livedemo.wpengine.com/webapp/?lang=fr">
		                        <img title="French" alt="fr" src="<?php echo get_template_directory_uri();?>/inc/switcher/flags/fr.png" class="iclflag">&nbsp;
		                        <span class="icl_lang_sel_native">French</span>
		                    </a>
		                </li>
		                <li class="icl-fr">
		                    <a href="http://livedemo.wpengine.com/webapp/?lang=fr">
		                        <img title="French" alt="fr" src="<?php echo get_template_directory_uri();?>/inc/switcher/flags/de.png" class="iclflag">&nbsp;
		                        <span class="icl_lang_sel_native">German</span>
		                    </a>
		                </li>
		                <li class="icl-fr">
		                    <a href="http://livedemo.wpengine.com/webapp/?lang=fr">
		                        <img title="French" alt="fr" src="<?php echo get_template_directory_uri();?>/inc/switcher/flags/it.png" class="iclflag">&nbsp;
		                        <span class="icl_lang_sel_native">Italian</span>
		                    </a>
		                </li>
		                <li class="icl-fr">
		                    <a href="http://livedemo.wpengine.com/webapp/?lang=fr">

		                        <span class="icl_lang_sel_native">Demo Only</span>
		                    </a>
		                </li>
		            </ul>
		        </li>
		    </ul>
		</div>

		<div class="topnav-spacer"></div>
        <div class="social">
			<a title="Twitter" class="twitter" href="#"></a>
			<a title="Facebook" class="facebook" href="#"></a>
			<a title="Flickr" class="flickr" href="#"></a>
		</div>
	</div><!-- .right-content -->
	</div>
</div>

<?php	$output = ob_get_clean();
		return $output;
	}

}


if (!function_exists('tt_temptt_clr_switcher')) {
	function tt_temptt_clr_switcher( ) {
		$ttcookie1 = $ttcookie2 = '' ;
		if(isset($_COOKIE['ttcookie1'])) {
			$ttcookie1 = '#' . $_COOKIE['ttcookie1'];
		} else {
			$ttcookie1 = '#56cc91';
		}
		if(isset($_COOKIE['ttcookie2'])) {
			$ttcookie2 = '#' . $_COOKIE['ttcookie2'];
		} else {
			$ttcookie2 = '#FE5454';
		}
		ob_start(); ?>

<!-------------------------------------------------------------------/
Color switcher for demo, to be removed from live website.
<!------------------------------------------------------------------->

	<?php
	if( $ttcookie1 != '#56cc91' /*|| $ttcookie2 != 'FE5454'*/ ) { // only trigger following if user actually changed colors
		global $tt_temptt_opt;
		$tt_temptt_opt['tt_main_acnt_clr'] = $ttcookie1;
		$tt_temptt_opt['tt_second_color']  = $ttcookie2;
		tt_webapp_custom_styling(true);

	}
	?>
<!-- ADD Switcher -->
<div class="demo_changer">
	<div class="demo-icon"><i class="fa fa-gear"></i></div>
	<div class="form_holder">
		<p class="color-title"><?php esc_attr_e('THEME OPTIONS', 'webapp'); ?></p>

		<div class="predefined_styles">
			<div class="clear"></div>
		</div>
		<p><?php esc_attr_e('Change color', 'webapp'); ?></p>
		<div class="color-box">
			<div class="col-col">
				<div  id="colorSelector">
					<div class="inner-color" style="background-color: <?php  echo esc_attr($ttcookie1);?>"></div>
				</div>
				<p><?php esc_attr_e('Select base Color', 'webapp'); ?></p>
			</div>
<!--			<div class="col-col">
				<div  id="colorSelector_2">
					<div class="inner-color" style="background-color: <?php /* echo esc_attr($ttcookie2);*/?>"></div>
				</div>
				<p><?php /*esc_attr_e('Color 2', 'webapp'); */?></p>
			</div>
-->		</div>
		<span class="switcherbutton clear switchspan"><a rel="stylesheet" class="switchapply switchinner" href=""><?php esc_attr_e('APPLY COLOR', 'webapp'); ?></a></span>
		<span class="switcherbutton switcherreset clear switchspan"><a rel="stylesheet" class="switcherreset switchinner" href=""><?php esc_attr_e('RESET TO DEFAULT', 'webapp'); ?></a></span>
		<span class="clear switchspan alignl"><?php esc_attr_e('Note: Some colors are controlled by Slider & Pagebuilder.', 'webapp'); ?></span>
		<span class="clear switchspan"><a rel="stylesheet" class="normallink" href="http://livedemo.wpengine.com/webapp/">Multipage Version</a></span>
		<span class="clear switchspan"><a rel="stylesheet" class="normallink" href="http://livedemo.wpengine.com/webapp-onepage/">Onepage Version</a></span>
		<span class="clear switchspan"><a rel="stylesheet" class="buy normallink" href="http://themeforest.net/item/webapp-app-saas-wordpress-theme/15174633?ref=templatation"><?php esc_attr_e('Purchase Webapp', 'webapp'); ?></a></span>
	</div>
</div>

<!-- END Switcher -->
<!-------------------------------------------------------------------/
EOF Color switcher for demo, to be removed from live website.
<!------------------------------------------------------------------->
<?php
		$output = ob_get_clean();
		print $output; // its safe to output, all variables already escaped above.
	}
}

/*-----------------------------------------------------------------------------------*/
/* Header Height fuction. */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_header_height' ) ) {
function tt_webapp_header_height() {

    $outputheaderstyle = $headerstyle = $maps_single_height = '';

	//setting up defaults.
	$settings10 = array(
					'header_height' => '',
					);
	$settings10 = tt_temptt_opt_values( $settings10 );

	if( isset($settings10['header_height']['height']))
	$headerstyle = $settings10['header_height']['height'];
	if ( !empty($headerstyle) )
	$outputheaderstyle .= '.header { min-height: '. $headerstyle .' !important; }'; // setting up header height overriding everything else

	// Output styles
	if ( $outputheaderstyle != '' ) {
		$outputheaderstyle = strip_tags($outputheaderstyle);
		return stripslashes( $outputheaderstyle );
	}
} // End tt_webapp_logo_offset()
}

/*-----------------------------------------------------------------------------------*/
/* Logo offset fuction. */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'tt_webapp_logo_offset' ) ) {
/**
 * Output CSS for logo adjustments
 */
function tt_webapp_logo_offset() {
	global $tt_temptt_opt;
    $outputlogostyle = $top = $topactive = $marginleft = '';
	//setting up defaults.
	$settings10 = array(
					'logo_left_offset' => '0',
					'logo_top_offset' => '0'
					);

	$settings10 = tt_temptt_opt_values( $settings10 );
	$logo_left_offset = $logo_top_offset = "0"; // setting up default
	if( !empty($settings10['logo_left_offset']) ) $logo_left_offset = str_replace("px","",$settings10['logo_left_offset']['width']);
	if( !empty($settings10['logo_top_offset']) ) $logo_top_offset = str_replace("px","",$settings10['logo_top_offset']['height']);

	if( ( $logo_left_offset == "0" ) && ( $logo_top_offset == "0" ) ) return; // do nothing if 0,0 is entered == reset.

	if( $logo_left_offset <> "0" ) $outputlogostyle .= 'header .logo { margin-left: '. $logo_left_offset .'px; }'; // setting up left offset
	if( $logo_top_offset <> "0" ) $outputlogostyle .= 'header .logo { margin-top: '. $logo_top_offset .'px; }';  // setting up top offset


	// Output styles
	if ( $outputlogostyle != '' ) {
		$outputlogostyle = '@media (min-width: 801px){ ' .$outputlogostyle. '}'; // output it only on desktop
		$outputlogostyle = strip_tags($outputlogostyle);
		return stripslashes( $outputlogostyle );
	}
} // End tt_webapp_logo_offset()
}



/*-----------------------------------------------------------------------------------*/
/* Function for showing google map inside container.                                 */
/*-----------------------------------------------------------------------------------*/
/*if (!function_exists('tt_webapp_gmap')) {
	function tt_webapp_gmap() {
 	global $tt_temptt_opt;
	$settings7 = $gmap = "";

	ob_start();

	   if ( isset($tt_temptt_opt['tt_contactform_map_coords']) && $tt_temptt_opt['tt_contactform_map_coords'] != '' ) { $geocoords = $tt_temptt_opt['tt_contactform_map_coords']; }  else { $geocoords = ''; } ?>
		<?php if ($geocoords != '') { ?>
		<?php tt_webapp_maps_contact_output("geocoords=$geocoords"); ?>
		<?php }

	$gmap =  ob_get_clean();
	return $gmap;

}
}*/

/*-----------------------------------------------------------------------------------*/
/* Google Maps */
/*-----------------------------------------------------------------------------------*/
// Thanks Adii.

/*function tt_webapp_maps_contact_output($args){
	global $tt_temptt_opt;

	if ( !is_array($args) )
		parse_str( $args, $args );

	extract($args);
	$mode = '';
	$streetview = 'off';
	$map_height = $tt_temptt_opt['tt_maps_single_height'];
//	$featured_w = $tt_temptt_opt['tt_home_featured_w']['width'];
//	$featured_h = $tt_temptt_opt['tt_home_featured_h']['height'];
	$zoom = $tt_temptt_opt['tt_maps_default_mapzoom'];
	$type = $tt_temptt_opt['tt_maps_default_maptype'];
	$marker_title = $tt_temptt_opt['tt_contact_title'];
	if ( $zoom == '' ) { $zoom = 6; }
//	$lang = $tt_temptt_opt['tt_maps_directions_locale'];
	$locale = '';
	if(!empty($lang)){
		$locale = ',locale :"'.$lang.'"';
	}
	$extra_params = ',{travelMode:G_TRAVEL_MODE_WALKING,avoidHighways:true '.$locale.'}';

	if(empty($map_height)) { $map_height = 250;}

	if(is_home() && !empty($featured_h) && !empty($featured_w)){
	?>
    <div id="single_map_canvas" style="width:<?php echo esc_attr($featured_w); ?>px; height: <?php echo esc_attr($featured_h); ?>px"></div>
    <?php } else { ?>
    <div id="single_map_canvas" style="width:100%; height: <?php echo esc_attr($map_height); ?>px"></div>
    <?php } ?>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize() {


			<?php if($streetview == 'on'){ ?>


			<?php } else { ?>

			  	<?php switch ($type) {
			  			case 'G_NORMAL_MAP':
			  				$type = 'ROADMAP';
			  				break;
			  			case 'G_SATELLITE_MAP':
			  				$type = 'SATELLITE';
			  				break;
			  			case 'G_HYBRID_MAP':
			  				$type = 'HYBRID';
			  				break;
			  			case 'G_PHYSICAL_MAP':
			  				$type = 'TERRAIN';
			  				break;
			  			default:
			  				$type = 'ROADMAP';
			  				break;
			  	} ?>

			  	var myLatlng = new google.maps.LatLng(<?php echo esc_attr($geocoords); ?>);
				var myOptions = {
				  zoom: <?php echo esc_attr($zoom); ?>,
				  center: myLatlng,
				  mapTypeId: google.maps.MapTypeId.<?php echo esc_attr($type); ?>
				};
				<?php if( $tt_temptt_opt['tt_maps_scroll'] == '1'){ ?>
			  	myOptions.scrollwheel = false;
			  	<?php } ?>
			  	var map = new google.maps.Map(document.getElementById("single_map_canvas"),  myOptions);

				<?php if($mode == 'directions'){ ?>
			  	directionsPanel = document.getElementById("featured-route");
 				directions = new GDirections(map, directionsPanel);
  				directions.load("from: <?php echo esc_attr($from); ?> to: <?php echo esc_attr($to); ?>" <?php if($walking == 'on'){ echo esc_attr($extra_params);} ?>);
			  	<?php
			 	} else { ?>

			  		var point = new google.maps.LatLng(<?php echo esc_attr($geocoords); ?>);
	  				var root = "<?php echo constant('TT_TEMPTT_THEME_DIRURI'); ?>";
	  				var callout = '<?php echo preg_replace("/[\n\r]/","<br/>", $tt_temptt_opt['tt_maps_callout_text']); ?>';
	  				var the_link = '<?php echo get_permalink(get_the_id()); ?>';
	  				<?php $title = str_replace(array('&#8220;','&#8221;'),'"', $marker_title); ?>
	  				<?php $title = str_replace('&#8211;','-',$title); ?>
	  				<?php $title = str_replace('&#8217;',"`",$title); ?>
	  				<?php $title = str_replace('&#038;','&',$title); ?>
	  				var the_title = '<?php echo html_entity_decode($title) ?>';

	  			<?php
			 	if(is_page()){
/*			 		$custom = $tt_temptt_opt['tt_cat_custom_marker_pages'];
					if(!empty($custom)){
						$color = $custom;
					}
					else {
						$color = $tt_temptt_opt['tt_cat_colors_pages'];
						if (empty($color)) {
							$color = 'red';
						}
					}*/
					/*$color = 'default';
			 	?>
			 		var color = '<?php echo esc_attr($color); ?>';
			 		createMarker(map,point,root,the_link,the_title,color,callout);
			 	<?php } else { ?>
			 		var color = '<?php echo esc_attr($tt_temptt_opt['tt_cat_colors_pages']); ?>';
	  				createMarker(map,point,root,the_link,the_title,color,callout);
				<?php
				}
					if(isset($_POST['tt_maps_directions_search'])){ ?>

					directionsPanel = document.getElementById("featured-route");
 					directions = new GDirections(map, directionsPanel);
  					directions.load("from: <?php echo htmlspecialchars($_POST['tt_maps_directions_search']); ?> to: <?php echo esc_textarea($address); ?>" <?php if($walking == 'on'){ echo esc_attr($extra_params);} ?>);



					directionsDisplay = new google.maps.DirectionsRenderer();
					directionsDisplay.setMap(map);
    				directionsDisplay.setPanel(document.getElementById("featured-route"));

					<?php if($walking == 'on'){ ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.WALKING;
					<?php } else { ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.DRIVING;
					<?php } ?>
					var start = '<?php echo htmlspecialchars($_POST['tt_maps_directions_search']); ?>';
					var end = '<?php echo esc_textarea($address); ?>';
					var request = {
       					origin:start,
        				destination:end,
        				travelMode: travelmodesetting
    				};
    				directionsService.route(request, function(response, status) {
      					if (status == google.maps.DirectionsStatus.OK) {
        					directionsDisplay.setDirections(response);
      					}
      				});

  					<?php } ?>
				<?php } ?>
			<?php } ?>


			  }
			  function handleNoFlash(errorCode) {
				  if (errorCode == FLASH_UNAVAILABLE) {
					alert("Error: Flash doesn't appear to be supported by your browser");
					return;
				  }
				 }

		initialize();

		});
	jQuery(window).load(function(){

		var newHeight = jQuery('#featured-content').height();
		newHeight = newHeight - 5;
		if(newHeight > 300){
			jQuery('#single_map_canvas').height(newHeight);
		}

	});

	</script>

<?php
}*/

/*-----------------------------------------------------------------------------------*/
/* Function to retrieve tags. */
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'tt_webapp_get_tags' )) {
	function tt_webapp_get_tags(){
		$tags = get_the_tags();
		$tags_count = 0;
	    $html = '<p class=tagtitle>'. esc_html__('tags ', 'webapp') .'&nbsp;</p>';
		if( !is_array($tags) ) return;
	    foreach ($tags as $tag){
		    $tags_count ++;
	        $tag_link = get_tag_link($tag->term_id);
						if ( $tags_count > 1 ) {
							$html .= ' '; // tag separator here
						}

	        $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='tag {$tag->slug}'>";
	        $html .= "{$tag->name}</a>";
	    }
	    echo '<div class="detail-tags">'. $html .'</div>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Function to retrieve categories. */
/*-----------------------------------------------------------------------------------*/
/*
 * it can either return single category or all categories separated by comma.
 * by default it returns all category separated by comma but if single category is required, just pass 'single' into the fn.
 *
 */
if (!function_exists('tt_webapp_get_cats')) {
	function tt_webapp_get_cats( $return='' ) {
		global $post, $wp_query;
		$output = '';
		$post_type_taxonomies = get_object_taxonomies( get_post_type(), 'objects' );
		foreach ( $post_type_taxonomies as $taxonomy ) {
			if ( $taxonomy->hierarchical == true ) {

				$cats       = get_the_terms( get_the_ID(), $taxonomy->name );
				$cats_count = 0;
				if ( $cats ) {
					foreach ( $cats as $cat ) {
						$cats_count ++;
						if ( $cats_count > 1 && $return == 'single' ) {
							break;
						}
						if ( $cats_count > 1 ) {
							$output .= ', ';
						}
						$output .= '<a class="tt_cats" href="' . get_term_link( $cat, $taxonomy->name ) . '">' . $cat->name . '</a>';
					}
				}
			}
		}
		return $output;
	}
}




/*-----------------------------------------------------------------------------------*/
/* Allowed tags                                                                      */
/*-----------------------------------------------------------------------------------*/

if(!( function_exists('tt_webapp_allowed_tags') )){
	function tt_webapp_allowed_tags(){
		return array(
		    'img' => array(
		        'src' => array(),
		        'alt' => array(),
		        'class' => array(),
		        'style' => array(),
		    ),
		    'a' => array(
		        'href' => array(),
		        'title' => array(),
		        'class' => array(),
		        'target' => array()
		    ),
		    'br' => array(),
		    'div' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'span' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'h1' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'h2' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'h3' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'h4' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'h5' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'h6' => array(
		        'class' => array(),
		        'style' => array(),
		    ),
		    'style' => array(),
		    'em' => array(),
		    'strong' => array(),
		    'p' => array(
		    	'class' => array(),
		        'style' => array(),
		    ),
		);
	}
}

function tt_webapp_css_allow($allowed_attr) {

    if (!is_array($allowed_attr)) {
        $allowed_attr = array();
    }

    $allowed_attr[] = 'display';
    $allowed_attr[] = 'background-image';
    $allowed_attr[] = 'url';

    return $allowed_attr;
} add_filter('safe_style_css','tt_webapp_css_allow');

/*-----------------------------------------------------------------------------------*/
/* Adding Yoast seo Breadcrumbs                                                      */
/*-----------------------------------------------------------------------------------*/

if( !function_exists('tt_webapp_add_breadcrumb') ) {
	function tt_webapp_add_breadcrumb() {
	$output = '';
	if( is_front_page() ) return; // no need of breadcrumb on homepage.
	ob_start(); ?>
				<div class="row">
					<?php
					 if ( function_exists('yoast_breadcrumb') ) {
						 yoast_breadcrumb('<div class="breadcrumbs col-xs-12">','</div>');
					 }
					?>
				</div>

		<?php
	$output = ob_get_clean();
	echo wp_kses_post($output);

	}
}
add_action( 'tt_after_container_start', 'tt_webapp_add_breadcrumb' );

/*-----------------------------------------------------------------------------------*/
/* Adding preloader                                                                  */
/*-----------------------------------------------------------------------------------*/

if( !function_exists('tt_webapp_preloader') ) {
	function tt_webapp_preloader() {

	if ( isset( $tt_temptt_opt['tt_logo']['url'] ) && $tt_temptt_opt['tt_logo']['url'] != '' ) { $logo = $tt_temptt_opt['tt_logo']['url'] ; }

	$output = '';

	//setting up defaults.
	$settings6 = tt_temptt_opt_values( array(
											'enable_preloader' => '1',
											'preloader' => '',
												) );

	if( !$settings6['enable_preloader'] ) return; // disabled from admin.
	ob_start(); ?>

    <!-- LOADER -->
    <div class="loader">
        <div class="load">
            <div class="load-animation">
	            <?php if(isset($settings6['preloader']['url']) && $settings6['preloader']['url'] != '') { ?>
                <span class="custom-preloader"><img src="<?php echo esc_url($settings6['preloader']['url']); ?>" alt=""/></span>
				<?php } else {  ?>
                <span class="load-item"><img src="<?php echo constant('TT_TEMPTT_THEME_DIRURI'); ?>images/load.png" alt=""/></span>
                <span class="load-item load-item-revers"><img src="<?php echo constant('TT_TEMPTT_THEME_DIRURI'); ?>images/load.png" alt=""/></span>
                <span class="load-item delay-200"><img src="<?php echo constant('TT_TEMPTT_THEME_DIRURI'); ?>images/load.png" alt=""/></span>
				<?php } ?>
            </div>
        </div>
    </div>

	<?php
	$output = ob_get_clean();
	echo wp_kses_post($output);

	}
}


/*-----------------------------------------------------------------------------------*/
/* Image Resizer script for on the fly resizing                                     */
/*-----------------------------------------------------------------------------------*/
// Source: https://github.com/syamilmj/Aqua-Resizer

if( ! class_exists('tt_webapp_Aq_Resize') ) {

	/**
	 * Image resizing class
	 *
	 * @since 1.0
	 */
	class tt_webapp_Aq_Resize {

		/**
		 * The singleton instance
		 */
		static private $instance = null;

		/**
		 * No initialization allowed
		 */
		private function __construct() {}

		/**
		 * No cloning allowed
		 */
		private function __clone() {}

		/**
		 * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
		 */
		static public function getInstance() {
			if(self::$instance == null) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Run, forest.
		 */
		public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = true ) {

			// Validate inputs.
			if ( ! $url || ( ! $width && ! $height ) ) return false;

			$upscale = true;

			// Caipt'n, ready to hook.
			if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

			// Define upload path & dir.
			$upload_info = wp_upload_dir();
			$upload_dir = $upload_info['basedir'];
			$upload_url = $upload_info['baseurl'];

			$http_prefix = "http://";
			$https_prefix = "https://";

			/* if the $url scheme differs from $upload_url scheme, make them match
			   if the schemes differe, images don't show up. */
			if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
				$upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
			}
			elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
				$upload_url = str_replace($https_prefix,$http_prefix,$upload_url);
			}


			// Check if $img_url is local.
			if ( false === strpos( $url, $upload_url ) ) return false;

			// Define path of image.
			$rel_path = str_replace( $upload_url, '', $url );
			$img_path = $upload_dir . $rel_path;

			// Check if img path exists, and is an image indeed.
			if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

			// Get image info.
			$info = pathinfo( $img_path );
			$ext = $info['extension'];
			list( $orig_w, $orig_h ) = getimagesize( $img_path );

			// Get image size after cropping.
			$dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
			$dst_w = $dims[4];
			$dst_h = $dims[5];

			// Return the original image only if it exactly fits the needed measures.
			if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
				$img_url = $url;
				$dst_w = $orig_w;
				$dst_h = $orig_h;
			} else {
				// Use this to check if cropped image already exists, so we can return that instead.
				$suffix = "{$dst_w}x{$dst_h}";
				$dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
				$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

				if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
					// Can't resize, so return false saying that the action to do could not be processed as planned.
					return $url;
				}
				// Else check if cache exists.
				elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
					$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
				}
				// Else, we resize the image and return the new resized image url.
				else {

					$editor = wp_get_image_editor( $img_path );

					if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
						return $url;

					$resized_file = $editor->save();

					if ( ! is_wp_error( $resized_file ) ) {
						$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
						$img_url = $upload_url . $resized_rel_path;
					} else {
						return $url;
					}

				}
			}

			// Okay, leave the ship.
			if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

			// Return the output.
			if ( $single ) {
				// str return.
				$image = $img_url;
			} else {
				// array return.
				$image = array (
					0 => $img_url,
					1 => $dst_w,
					2 => $dst_h
				);
			}

			return $image;
		}

		/**
		 * Callback to overwrite WP computing of thumbnail measures
		 */
		function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
			if ( ! $crop ) return null; // Let the wordpress default function handle this.

			// Here is the point we allow to use larger image size than the original one.
			$aspect_ratio = $orig_w / $orig_h;
			$new_w = $dest_w;
			$new_h = $dest_h;

			if ( ! $new_w ) {
				$new_w = intval( $new_h * $aspect_ratio );
			}

			if ( ! $new_h ) {
				$new_h = intval( $new_w / $aspect_ratio );
			}

			$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

			$crop_w = round( $new_w / $size_ratio );
			$crop_h = round( $new_h / $size_ratio );

			$s_x = floor( ( $orig_w - $crop_w ) / 2 );
			$s_y = floor( ( $orig_h - $crop_h ) / 2 );

			return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
		}

	}

}


if ( ! function_exists('tt_webapp_aq_resize') ) {

	/**
	 * Resize an image using tt_webapp_Aq_Resize Class
	 *
	 * @since 1.0
	 *
	 * @param string $url     The URL of the image
	 * @param int    $width   The new width of the image
	 * @param int    $height  The new height of the image
	 * @param bool   $crop    To crop or not to crop, the question is now
	 * @param bool   $single  If true only returns the URL, if false returns array
	 * @param bool   $upscale If image not big enough for new size should it upscale
	 * @return mixed If $single is true return new image URL, if it is false return array
	 *               Array contains 0 = URL, 1 = width, 2 = height
	 */
	function tt_webapp_aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
		$aq_resize = tt_webapp_Aq_Resize::getInstance();
		return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
	}

}

class trueTopPostsWidget extends WP_Widget {
 
	/*
	 * создание виджета
	 */
	function __construct() {
		parent::__construct(
			'true_top_widget', 
			'Popular Post', // заголовок виджета
			array( 'description' => 'Popular post' ) // описание
		);
	}
 
	/*
	 * фронтэнд виджета
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
		$posts_per_page = $instance['posts_per_page'];
 
		print $args['before_widget'];
 
		if ( ! empty( $title ) )
			print $args['before_title'] . $title . $args['after_title'];
 
		$q = new WP_Query("posts_per_page=$posts_per_page&orderby=comment_count");
		if( $q->have_posts() ):
			?><?php
			while( $q->have_posts() ): $q->the_post();?>
			<div class="popular-post">
				<?php if ( has_post_thumbnail()) { ?>
                <a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail(); ?>
                </a>
           <?php } ?>
                 <a class="post-link" href="<?php the_permalink() ?>"> <?php the_title() ?> </a>
                <div class="info-post">
                    <span class="post-data"><i class="fa fa-calendar"></i><?php the_time( 'd.j.Y' ); ?></span>
                    <span class="post-comment"><i class="fa fa-comment-o"></i><?php comments_number( '0', '1', '% responses' ); ?></span>
                </div>
           </div>
				<?php
			endwhile;
			?><?php
		endif;
		wp_reset_postdata();
 
		print $args['after_widget'];
	}
 
	/*
	 * бэкэнд виджета
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'posts_per_page' ] ) ) {
			$posts_per_page = $instance[ 'posts_per_page' ];
		}
		?>
		<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>">Title</label>
			<input class="widefat" id="<?php print esc_attr($this->get_field_id( 'title' )); ?>" name="<?php print esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php print esc_attr($this->get_field_id( 'posts_per_page' )); ?>">Amount:</label>
			<input id="<?php print esc_attr($this->get_field_id( 'posts_per_page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_per_page' )); ?>" type="text" value="<?php print ($posts_per_page) ? esc_attr( $posts_per_page ) : '5'; ?>" size="3" />
		</p>
		<?php 
	}
 
	/*
	 * сохранение настроек виджета
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '5'; // по умолчанию выводятся 5 постов
		return $instance;
	}
}
 
/*
 * регистрация виджета
 */
function true_top_posts_widget_load() {
	register_widget( 'trueTopPostsWidget' );
}
add_action( 'widgets_init', 'true_top_posts_widget_load' );




//Widget with the link
class widget_link extends WP_Widget {

    // Create Widget
    function widget_link() {
        parent::__construct(false, $name = 'WA: Info & Social', array('description' => 'Displays information and social links.'));
    }

    // Widget Content
    function widget($args, $instance) {
        extract( $args );
        $simple_title = strip_tags($instance['simple_title']);
        $simple_link = $instance['simple_link'];
        $link_text = strip_tags($instance['link_text']);
        $simple_text = $instance['simple_text'];

        ?>

		<?php if (!empty($simple_title)) {?>
		<div class="sidebar-widget-title">
			<h4 class="title"><?php echo esc_attr($simple_title); ?></h4>
		</div>
		<?php } ?>
		<div class="widget-lpinfo">
			<?php echo wp_kses_post($simple_text) ?>
		</div>
		<?php if (!empty($link_text)) { ?>
		<div class="footer-read-more">
			<a href="<?php echo esc_url($simple_link); ?>"><?php echo esc_attr($link_text); ?> <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a>
		</div>
		<?php } ?>
	    <?php

	    if( tt_temptt_get_option('footer_social_co', '0')) { // social icons

		    //Setup default variables, overriding them if the "Theme Options" have been saved.
		    $settings = array(
			    'feed_url'           => '',
			    'connect_rss'        => '',
			    'connect_twitter'    => '',
			    'connect_facebook'   => '',
			    'connect_youtube'    => '',
			    'connect_flickr'     => '',
			    'connect_linkedin'   => '',
			    'connect_pinterest'  => '',
			    'connect_instagram'  => '',
			    'connect_googleplus' => ''
		    );
		    $settings = tt_temptt_opt_values( $settings );
		    ?>
		    <div class="widget-social-links">
			    <?php if ( $settings['connect_rss'] == "1" ) { ?>
				    <a href="<?php if ( $settings['feed_url'] ) {
					    echo esc_url( $settings['feed_url'] );
				    } else {
					    echo get_bloginfo_rss( 'rss2_url' );
				    } ?>" class="subscribe" title="RSS"><i class="fa fa-rss mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_twitter'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_twitter'] ); ?>" class="twitter" title="Twitter"><i
						    class="fa fa-twitter mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_facebook'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_facebook'] ); ?>" class="facebook" title="Facebook"><i
						    class="fa fa-facebook mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_youtube'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_youtube'] ); ?>" class="youtube" title="YouTube"><i
						    class="fa fa-youtube mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_flickr'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_flickr'] ); ?>" class="flickr" title="Flickr"><i
						    class="fa fa-flickr mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_linkedin'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_linkedin'] ); ?>" class="linkedin" title="LinkedIn"><i
						    class="fa fa-linkedin mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_pinterest'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_pinterest'] ); ?>" class="pinterest"
				       title="Pinterest"><i class="fa fa-pinterest mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_instagram'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_instagram'] ); ?>" class="instagram"
				       title="Instagram"><i class="fa fa-instagram mysocial_style"></i></a>

			    <?php }
			    if ( $settings['connect_googleplus'] != "" ) { ?>
				    <a href="<?php echo esc_url( $settings['connect_googleplus'] ); ?>" class="googleplus"
				       title="Google+"><i class="fa fa-google-plus mysocial_style"></i></a>
			    <?php } ?>

		    </div>
	    <?php
	    }
     }

    // Update and save the widget
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    // If widget content needs a form
    function form($instance) {
        //widgetform in backend
        $simple_title = strip_tags($instance['simple_title']);
        $simple_link = $instance['simple_link'];
        $link_text = strip_tags($instance['link_text']);
        $simple_text = $instance['simple_text'];
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('simple_title')); ?>">Widget title: </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('simple_title')); ?>" name="<?php echo esc_attr($this->get_field_name('simple_title')); ?>" type="text" value="<?php echo esc_attr($simple_title); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('simple_text')); ?>">Text: </label>
                <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('simple_text')); ?>" name="<?php echo esc_attr($this->get_field_name('simple_text')); ?>"><?php echo wp_kses_post($simple_text); ?></textarea>
            </p>
            <p>
                <label for="<?php echo esc_html($this->get_field_id('simple_link')); ?>">Link: </label>
                <input class="widefat" id="<?php echo esc_html($this->get_field_id('simple_link')); ?>" name="<?php echo esc_html($this->get_field_name('simple_link')); ?>" type="text" value="<?php echo esc_html($simple_link); ?>" />
            </p>
            <p>
                <label for="<?php echo  esc_attr($this->get_field_id('link_text')); ?>">Link text: </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link_text')); ?>" name="<?php echo esc_attr($this->get_field_name('link_text')); ?>" type="text" value="<?php echo esc_attr($link_text); ?>" />
            </p>


        <?php
    }

}

register_widget('widget_link');


if ( ! function_exists( 'webapp_update_to_icons' ) ) {
	function webapp_update_to_icons() {
	$tt_logo_url = $tt_hdrbg = '';

	$tt_options = get_option( 'tt_temptt_opt' );
	if( isset($tt_options['tt_logo']['url']))
	$tt_logo_url = $tt_options['tt_logo']['url'];
	if( isset($tt_options['tt_hdr_styling']['background-image']))
	$tt_hdrbg = $tt_options['tt_hdr_styling']['background-image'];

	if( strpos($tt_logo_url,'wpengine') ) {
		$tt_options['tt_logo']['url'] = '';
		update_option( 'tt_temptt_opt', $tt_options );
	}
	if( strpos($tt_hdrbg,'wpengine') ) {
		$tt_options['tt_hdr_styling']['background-image'] = get_template_directory_uri() . '/images/headerbg.jpg';
		update_option( 'tt_temptt_opt', $tt_options );
	}
	}
	webapp_update_to_icons(); /*function to update icons to use from theme folder native.*/
}

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
