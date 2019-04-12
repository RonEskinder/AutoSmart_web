<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$tt_temptt_opt = get_option( '$tt_temptt_opt' );

/*-----------------------------------------------------------------------------------*/
/* Theme essentials! */
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'do_shortcode');

update_option('revslider-notices', false);
set_transient( '_redux_activation_redirect', false, 30 );
delete_transient( '_dslc_activation_redirect_1' );


/**
 * Add default options and show Options Panel after activate
 * @since  4.0.0
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	// Flush rewrite rules.
	flush_rewrite_rules();
	// redirect
	$tt_update_log = get_option( 'tt_webapp_updates_log');
	if( ! is_array($tt_update_log) ) tt_webapp_activate_redirect(); // only redirect if its first time activation
}

// Adding redirect
function tt_webapp_activate_redirect() {

	header( 'Location: ' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) );

} // End tt_webapp_activate_redirect()



// Adding versions
add_action( 'current_screen', 'tt_webapp_update_version' );
function tt_webapp_update_version( $current_screen ) {
	if ( 'appearance_page_tgmpa-install-plugins' == $current_screen->base ) {
		if( function_exists( 'tt_webapp_firstInst_notice' )) add_action( 'admin_notices', 'tt_webapp_firstInst_notice' ); // add notice.
	}
	if ( 'toplevel_page__templatation' == $current_screen->base ) {

		$woo_theme = wp_get_theme();
		$woo_this_theme_ver = $woo_theme->get( 'Version' );
		$theme_update_log = get_option( 'tt_webapp_updates_log');

        if ( ! $theme_update_log ) $theme_update_log = array();

		// First update
		if ( ! in_array('1.0', $theme_update_log) ) {
			array_unshift($theme_update_log, '1.0');
			update_option( 'tt_webapp_updates_log', $theme_update_log);
		}

		if ( ! in_array($woo_this_theme_ver, $theme_update_log) ) {
			array_unshift($theme_update_log, $woo_this_theme_ver);
			update_option( 'tt_webapp_updates_log', $theme_update_log);
		}

	}
}
if( !function_exists( 'tt_webapp_firstInst_notice' )) {
	function tt_webapp_firstInst_notice() {

			 print '<div class="updated notice is-dismissible" style="padding: 25px 12px;"><span style="text-align:center;font-weight: bold;color:green;"> ' .
		     esc_html__( 'Thanks for Activating Webapp WordPress theme.', 'buildcon' ) . '</span>'
			 . '<br /> <br />' .

		     esc_html__( 'Theme requires few bundled plugins to function on its full power. Please Install and Activate plugins below.', 'buildcon' )

			 . '<br />' .

		     esc_html__( 'You can choose not to install any particular plugin if you do not need it. ', 'buildcon' )

			 . '<br /> <br />' .

			 '<span style="text-align:center;font-weight: bold;color:green;"> ' .
		     esc_html__( 'After plugins are activated, Click Dashboard on left top, then go to Appearance > Theme Setup Wizard for further setup.', 'buildcon' ) . '</span>'

		     . '</div>';
	}
}


/**
 * Register Sidebars
 */

if ( ! function_exists( 'tt_webapp_widgets_init' ) ) {
function tt_webapp_widgets_init() {
    if ( ! function_exists( 'register_sidebar' ) )
        return;

    register_sidebar(array( 'name' => esc_html__( 'Sidebar widgets', 'webapp' ),'id' => 'default-sidebar',
    	'description' => esc_html__( 'Default sidebar.', 'webapp' ),
    	'before_widget' => '<div id="%1$s" class="widget-block %2$s">','after_widget' => 
    	'</div>','before_title' => 
    	'<h3 class="element-title">','after_title' => '</h3>'));

    // Footer widgetized areas
	$total = tt_temptt_get_option( 'footer_sidebars', 4 );
	if ( ! $total ) $total = 4;
	for ( $i = 1; $i <= intval( $total ); $i++ ) {
		register_sidebar( array( 'name' => sprintf( esc_html__( 'Footer %d', 'webapp' ), $i ), 'id' => sprintf( 'footer-%d', $i ), 'description' => sprintf( esc_html__( 'Widgetized Footer Region %d.', 'webapp' ), $i ), 'before_widget' => '<div id="%1$s" class="ftr-widget widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="ftr-title">', 'after_title' => '</h3>' ) );
	}

} // End the_widgets_init()
}

add_action( 'widgets_init', 'tt_webapp_widgets_init' );


if ( ! function_exists( 'tt_webapp_load_scripts' ) ) {
	function tt_webapp_load_scripts() {

		wp_enqueue_script( "comment-reply" );

		// Scripts
		if( tt_temptt_get_option('gmap_api') ) {
			$gmap_api = tt_temptt_get_option('gmap_api');
			wp_register_script( 'goog_maps', 'http://maps.google.com/maps/api/js?key='.$gmap_api, '', null, true );
		} else
			wp_register_script( 'goog_maps', 'http://maps.google.com/maps/api/js', '', null, true );
		wp_register_script( 'g_maps', TT_TEMPTT_THEME_DIRURI . 'assets/js/map.js', '', null, true );

/*		wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js?sensor-true', '', null, true );
		wp_enqueue_style( 'google-maps-markers', TT_TEMPTT_THEME_DIRURI . 'assets/js/markers.js', '', null, true );
		wp_enqueue_script( 'map', TT_TEMPTT_THEME_DIRURI . 'assets/js/map.js', array( 'jquery' ),null, true );*/

		wp_enqueue_script( 'bx', TT_TEMPTT_THEME_DIRURI . 'assets/js/plugins.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'mainjs', TT_TEMPTT_THEME_DIRURI . 'assets/js/main.js', array( 'jquery' ), null, true );
		// Styles
		wp_enqueue_style( 'themestyle', TT_TEMPTT_THEME_DIRURI . 'assets/css/themestyle.css', '', null );
		wp_enqueue_style( 'base', TT_TEMPTT_THEME_DIRURI . 'style.css', '', null );

		// Fonts
		wp_enqueue_style( 'tt-fonts', tt_webapp_g_fonts(), array(), null );

	} //tt_webapp_load_scripts
	add_action( 'wp_enqueue_scripts', 'tt_webapp_load_scripts' );
}

// calling google fonts needed for this theme.
if ( ! function_exists( 'tt_webapp_g_fonts' ) ) {
	/**
	 * @return string Google fonts URL for the theme.
	 */
	function tt_webapp_g_fonts() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'webapp' ) ) {
			$fonts[] = 'Open Sans:400italic,600italic,700italic,700,600,800,400';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
}


// admin styles.
if ( ! function_exists( 'tt_webapp_admin_styles' ) ) {
	function tt_webapp_admin_styles() {

		wp_enqueue_style( 'theme-admin-css', TT_TEMPTT_THEME_DIRURI . 'assets/css/tt-admin.css' );

	} add_action('admin_enqueue_scripts', 'tt_webapp_admin_styles', 200);
}


/**
 * Pagination
 */

function tt_webapp_post_pagination( $atts = NULL ) {

	$show_numbers = true;

	if ( ! $show_numbers ) {

		?>
			<div class="classic-pagination clearfix">

				<div class="fl">
					<?php previous_posts_link(); ?>
					&nbsp;
				</div>

				<div class="fr">
					&nbsp;
					<?php next_posts_link(); ?>
				</div>

			</div><!-- .classic-pagination -->
		<?php

	} else {

		global $paged;

		if ( ! isset( $atts['force_number'] ) ) $force_number = false; else $force_number = $atts['force_number'];
		if ( ! isset( $atts['pages'] ) ) $pages = false; else $pages = $atts['pages'];
		$range = 2;

		$showitems = ($range * 2)+1;

		if ( empty ( $paged ) ) { $paged = 1; }

		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) {
				$pages = 1;
			}
		}

		if( 1 != $pages ) {

			?>
			<div class="page-pagination pager-container pager-article">
				<ul class="clearfix">
					<?php

						if($paged > 2 && $paged > $range+1 && $showitems < $pages) { echo "<li class='inactive'><a class='num-type far-prev' href='".get_pagenum_link(1)."'></a></li>"; }
						if($paged > 1 && $showitems < $pages) { echo "<li class='inactive'><a class='num-type tt-prev' href='".get_pagenum_link($paged - 1)."' ></a></li>"; }

						for ($i=1; $i <= $pages; $i++){
							if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
								echo ($paged == $i)? "<li class='active'><a class='active num-type' href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li class='inactive'><a class='num-type inactive' href='".get_pagenum_link($i)."'>".$i."</a></li>";
							}
						}

						if ($paged < $pages && $showitems < $pages) { echo "<li class='inactive'><a class='num-type tt-next' href='".get_pagenum_link($paged + 1)."'></a></li>"; }
						if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) { echo "<li class='inactive'><a class='num-type far-next'  href='".get_pagenum_link($pages)."'></a></li>"; }

					?>
				</ul>
			</div><!-- .pagination --><?php
		}

	}

}

/* end */