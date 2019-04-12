<?php
/**
 *
 * Custom Button
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_custom_button($atts, $content = '', $id = '') {
    
    extract( shortcode_atts( array(
        'text'         => '',
        'link'         => '',
        't_color'      => '',
        'bg_color'     => '',
        'add_icon'     => '',
        'i_class'      => '',
        'i_color'      => '',
        'border_color' => ''
        ), $atts ) );
    
  
    $icon_color = ( isset( $i_color ) && ! empty( $i_color ) ) ? 'style="color: ' . $i_color . ' ;"' : '';
    $border_color = (!empty($border_color)) ? 'border-color: ' .$border_color. ';' : '' ;
    $t_color = (!empty($t_color)) ? 'color: ' .$t_color. ';' : '' ;
    $bg_color = (!empty($bg_color)) ? 'background-color: ' .$bg_color. ';' : '' ;


    $output = '';
$output  = '<div class="btn-box">'; 
$output .= '<a href="' . $link . '" class="button" style="' . $border_color . ' ' . $t_color. ' ' . $bg_color . '">';
$output .= ( ! empty( $i_class ) ) ? '<i class="button-icon fa ' . $i_class . ' " ' .$icon_color . '> </i>': '';
$output .= ( ! empty( $text ) ) ?  $text : '';
$output .= '</a>';
$output .= '</div>';

    return $output;
}
add_shortcode( 'webapp_custom_button', 'webapp_custom_button' );