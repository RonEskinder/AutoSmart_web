<?php
/**
 *
 * Testimonial Item
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_testimonial_item($atts, $content = '', $id = '') {
    
    extract( shortcode_atts( array(
        'name'      => '',
        'position'  => '',
        'image'     => '',
        'text'      => '',
        'background'=> '',
        'color'     => '',
        'date'      => '',
        'social_fb' => '',
        'social_in' => '',
        'social_tw' => '',
        'social_li' => '',
        'social_pi' => ''
        ), $atts ) );
    $img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
    $bg_color = ( isset( $background ) && ! empty( $background ) ) ? 'style="background-color: ' . $background . ' ;"' : '';
    $txt_color = ( isset( $color ) && ! empty( $color ) ) ? 'style="color: ' . $color . ' ;"' : '';
    $output = '';
$output  = '<div class="comments-fr-container animate-top">';
$output .= '<img src="'. $img .'" alt="photo">';
$output .= '<div class="fr-content">';
$output .= ( ! empty( $name ) ) ? '<div class="fr-name">' . $name . '</div>': '';
$output .= ( ! empty( $position ) ) ? '<span class="fr-position">' . $position . '</span>': '';
$output .= ( ! empty( $text ) ) ? '<p class="text">' . $text . '</p>': '';
$output .= '</div>';
$output .= '<div class="fr-info clearfix" ' . $bg_color . '>';
$output .= ( ! empty( $date ) ) ? '<div class="comm-data" ' . $txt_color . '>' .$date. '</div>': ''; 
$output .= '<div class="comm-social">';
$output .= ( ! empty( $social_fb ) ) ? '<a href="' . $social_fb . '" target="_blank"><i class="fa fa-facebook" ' . $txt_color . ' ></i></a>' : '';
    $output .= ( ! empty( $social_in ) ) ? '<a href="' . $social_in . '" target="_blank"><i class="fa fa-instagram" ' . $txt_color . '></i></a>' : '';
    $output .= ( ! empty( $social_tw ) ) ? '<a href="' . $social_tw . '" target="_blank"><i class="fa fa-twitter" ' . $txt_color . '></i></a>' : '';
    $output .= ( ! empty( $social_li ) ) ? '<a href="' . $social_li . '" target="_blank"><i class="fa fa-linkedin" ' . $txt_color . '></i></a>' : '';
    $output .= ( ! empty( $social_pi ) ) ? '<a href="' . $social_pi . '" target="_blank"><i class="fa fa-pinterest" ' . $txt_color . '></i></a>' : '';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

    return $output;
}
add_shortcode( 'webapp_testimonial_item', 'webapp_testimonial_item' );