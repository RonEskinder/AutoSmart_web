<?php
/**
 *
 * Title
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_benefit($atts, $content = '', $id = '') {
	  extract( shortcode_atts( array(
	    'title'    => '',
	    'text'    => '',
	    'class'    => '',
	    'bg'  => '',
	    'custom_icon'  => ''
	  ), $atts ) );
	$output = $b_icon = '';
	if( ! empty( $custom_icon ) ) {
		$b_icon = '<i class="iconsg '.$custom_icon.' "></i>';
	} else {
        $b_icon = '<i class=" fa '.$class.' "></i>';
	  }
	$bg = ( ! empty( $bg ) ) ? 'background-color: ' . $bg . ' ;"' : '';
	$output .= '<div class="col-benefits bounce-in delay-300">'; 
	$output .= '<div class="benefits-icon" style="' . $bg . '" >';
	if( '' != $b_icon ) $output .= $b_icon;
	$output .= '</div>';
	$output .= '<h3 class="benefits-title">'. $title .'</h3>';
	$output .= '<p class="benefits-text">'. $text .'</p>';
	$output .= '</div>';
	return $output;
}
add_shortcode( 'webapp_benefit', 'webapp_benefit' );
