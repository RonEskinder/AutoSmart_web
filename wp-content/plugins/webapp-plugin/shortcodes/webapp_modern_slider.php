<?php
/**
 *
 * webapp modern slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_modern_slider( $atts, $content = '', $id = '' ) {
	return '<div class="hero-slider"><ul class="slides">' . do_shortcode( $content ) . '</div></div>';
}
add_shortcode( 'webapp_modern_slider', 'webapp_modern_slider' );
function webapp_slider_item($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'image'		 => '',
		'text_style' => '',
		'title'		 => '',
		'text' 		 => ''
		), $atts ) );
	$text_class = ( $text_style == 'dark' ) ? 'text-light' : '';
	$url = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
	$output = '';
	if( ! empty( $url ) ) {
		$output .= '<li class="slide" style="background-image: url(' . $url . ')">';
		$output .= '<div class="overlay overlay-' . $text_style . '"></div>';
		$output .= '<div class="slide-caption ' . $text_class . '">';
		$output .= '<h4 class="text-capitalize">' . $title . '</h4>';
		$output .= '<h6>' . $content . '</h6>';
		$output .= '</div>';
		$output .= '</li>';
	}
	return $output;
}
add_shortcode( 'webapp_slider_item', 'webapp_slider_item' );
