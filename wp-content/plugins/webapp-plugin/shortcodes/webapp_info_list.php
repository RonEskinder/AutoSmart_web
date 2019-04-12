<?php
/**
 *
 * Info List
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_info_list($atts, $content = '', $id = '') {
    
    extract( shortcode_atts( array(
        'title'		=> '',
        'text'		=> '',
        't_color'	=> '',
        'icon'      => '',
        'link'      => '',
        'i_color'   => '',
        'background'=> ''
        ), $atts ) );
    $bg_color = ( isset( $background ) && ! empty( $background ) ) ? 'style="background-color: ' . $background . ' ;"' : '';
    $txt_color = ( isset( $t_color ) && ! empty( $t_color ) ) ? 'style="color: ' . $t_color . ' ;"' : '';
    $icon_color = ( isset( $i_color ) && ! empty( $i_color ) ) ? 'style="color: ' . $i_color . ' ;"' : '';
    $output = '';
$output  ='<div class="info-list-item animate-top">';
$output .= ($title) ? '<h4 ' . $txt_color . '>' . $title . '</h4>' : '';
$output .= ($text) ? '<p ' .$txt_color. '>' . $text . '</p>' : '';
$output .= '<span class="big-data" ' . $bg_color . '><i class="fa ' . $icon. '" ' . $icon_color . '></i></span>';
$output .= '</div>';
    return $output;
}
add_shortcode( 'webapp_info_list', 'webapp_info_list' );