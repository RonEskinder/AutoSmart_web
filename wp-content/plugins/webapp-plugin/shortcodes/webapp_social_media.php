<?php
/**
 *
 * Social Media
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_social_media($atts, $content = '', $id = '') {
    
    extract( shortcode_atts( array(
        'icon'      => '',
        'link'      => '',
        'size'      => '',
        'i_color'   => '',
        'background'=> ''
        ), $atts ) );
    $f_size = ( isset( $size ) && ! empty( $size ) ) ? 'style="font-size: ' . $size . ' ;"' : '';
    $bg_color = ( isset( $background ) && ! empty( $background ) ) ? 'style="background-color: ' . $background . ' ;"' : '';
    $txt_color = ( isset( $i_color ) && ! empty( $i_color ) ) ? 'style="color: ' . $i_color . ' ;"' : '';
    $output = '';
$output  ='<div class="tour-social-ico animate-top">';
$output .='<a href="'. $link .'" ' . $bg_color .'> <i '. $f_size. ' class="fa ' . $icon . '" ' . $txt_color . '> </i></a>';
$output .='</div>';
    return $output;
}
add_shortcode( 'webapp_social_media', 'webapp_social_media' );