<?php
/**
 *
 * Banner
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_pricing($atts, $content = '', $id = '') {
    
    extract( shortcode_atts( array(
        'size'                 => 'h1',
        'title'                => '',
        'price'                => '',
        'price_p'              => '',
        'price_description'    => '',
        'btntext'              => '',
        'btnlink'              => '',
        'b_icon'              => '',
        'highlight'            => '',
        'highlighttext'        => '',
        'custom_icon'           => ''
    ), $atts ) );
    if( $highlighttext == '' ) $highlighttext = 'Best Value!';
    $highlight = ($highlight == 'yes') ? $highlight = '<span class=highlight>'.$highlighttext.'</span>' : '' ;

	if( ! empty( $custom_icon ) ) {
		$b_icon = '<i class="'.$custom_icon.' "></i>';
	} else {
        $b_icon = '<i class="'.$b_icon.' "></i>';
	  }

    $output = '<div class="offers-container" style="text-align: center;">';
    $output .= $highlight;
    $output .= '<' . $size . ' class="offers-title">' . $title . '</' .  $size . '>';
    $output .= ($price) ? '<div class="offers-status">' . $price . '<sup> ' . $price_p .'</sup> </div>' : '';
    $output .= ($price_description) ? '<p class="offers-list">' . $price_description . '</p>' : '';
    if ( ! empty( $btntext ) && ! empty( $btnlink ) ) {
        $output .= '<a href="' . $btnlink . '" class="start-now button">';
        if( '' != $b_icon ) $output .= $b_icon;
        $output .= $btntext . '</a>';
    }
    $output .= '</div>';
return $output;
    
}
add_shortcode( 'webapp_pricing', 'webapp_pricing' );
