<?php
/**
 *
 * Title
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_title($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'title'	    => '',
		'title_span'=> '',
		'size'	    => 'h1',
		'color'		=> '',
		'separator' => '',
		'color_sep' => '',
		'add_sbt'	=> '',
		'subtitle'	=> '',
		's_color'	=> '',
		'left_style'	=> 'no'
		), $atts ) );
	$t_color = ( isset( $color ) && ! empty( $color ) ) ? 'style="color: ' . $color . ' ;"' : '';
	$s_color = ( isset( $s_color ) && ! empty( $s_color ) ) ? 'style="color: ' . $s_color . ' ;"' : '';
	$output = '';
	$left = '';
	if ( $left_style == 'yes' ) { 
		$left = 'left_styles';
	}
	if ( ! empty( $title ) ) {
		$output .= '<' . $size . ' class="section-title ' . $left . '" ' . $t_color . '>' . $title . '<span> '. $title_span . '</span> </' . $size . '>';
	}
	if ( $separator == 'yes' ) {
		$color_separator = ( isset( $color_sep ) && ! empty( $color_sep ) ) ? 'style="background-color: ' . $color_sep . ';"' : '';
		
		$output .= '<p class="separator ' . $left . ' " ' . $color_separator . '></p>';
	}
	 $output .= ($subtitle) ? '<div class="main-text animate-fade ' . $left . '" ' . $s_color . ' ">' . $subtitle . '</div>' : '';
	return $output;
}
add_shortcode( 'webapp_title', 'webapp_title' );