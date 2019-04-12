<?php
/**
 *
 * Icon
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_icon($atts, $content = '', $id = '') {
	
	extract( shortcode_atts( array(
		'title'	    	=> '',
		'subtitle'	    => '',
		'i_class'	    => '',
		'i_size'		=> '',
		'i_color'	    => '',
		'i_border'      => '',
		'b_color'	    => '',
		'add_text'		=> '',
		'i_text'  		=> '',
		'custom_icon'  		=> '',
		't_color'		=> ''
		), $atts ) );
	
	$output = '';
    $t_color = (!empty($t_color)) ? 'color: ' .$t_color. ';' : '' ;

	if ( $i_border == 'yes' ) {
		$icon_border = ( isset( $b_color ) && ! empty( $b_color ) ) ? 'style="border: 2px solid ' . $b_color . ';"' : '';

	$i_size = ( !empty( $i_size ) ) ? 'font-size: ' . $i_size . ';' : '';
	$i_color = ( !empty( $i_color ) ) ? 'color: ' . $i_color . ';' : '';
	if( ! empty( $custom_icon ) ) {
		$b_icon = '<i class="iconsg '.$custom_icon.' " style="' . $i_size . ' ' . $i_color . '"></i>';
	} else {
        $b_icon = '<i class=" fa '.$i_class.' " style="' . $i_size . ' ' . $i_color . '"></i>';
	  }

	$output .= '<div class="tm-head-container bounce-in-h delay-200">'; 
	$output .= '<div class="tm-info-block" ' . $icon_border . '>';
	$output .= '<div class="tm-ico">';
	if ( ! empty( $b_icon ) ) {
		$output .= $b_icon;
	}
	
	 $output .= ($i_text) ? '<span class="tm-number" style="' . $t_color . ' ">' . $i_text . '</span>' : '';
	 $output .= '</div>';
	  $output .= '</div>';
	 $output .= '<h3 class="tm-head-title" style="' . $t_color . '" >'. $title .'</h3><span class="tm-info-text" style="' . $t_color . '">'. $subtitle .'</span>';
	 $output .= '</div>';
	return $output;
}
}
add_shortcode( 'webapp_icon', 'webapp_icon' );

