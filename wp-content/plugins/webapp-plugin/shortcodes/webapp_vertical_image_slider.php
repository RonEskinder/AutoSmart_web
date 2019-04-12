<?php
/**
 *
 * Vertical image with text slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_vertical_image_slider( $atts, $content = '', $id = '' ) {
  return '<div class="vert-wr"><div class="bxslider">' . do_shortcode( $content ) . '</div></div>';
}
add_shortcode( 'webapp_vertical_image_slider', 'webapp_vertical_image_slider' );
function webapp_vertical_image_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'icon'         => '',
    'i_color'      => '',
    'title'        => '',
    'l_content'    => '',
    'image'        => '',
    'r_title'      => '',
    'r_title_span' => '',
    'r_content'    => ''
  ), $atts ) );
  $output = '';
  $img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
  $output .= '<div class="slide">';
  $output .= '<div class="row">';
  $output .= '<div class="col-md-4 col-xs-12 col-vertical">';
  $output .= '<div class="info-multimedia vertical-center">';
  $output .= ($icon) ? '<span class="fa animate-top ' . $icon . ' " style="color: ' . $i_color . ';"></span>' : '';
  $output .= ($title) ? '<h4 class="animate-top ">' . $title . '</h4>' : '';
  $output .= ($l_content) ? '<p class="animate-top"> ' . $l_content. '</p>' : '';
  $output .= '</div></div>';
  $output .= '<div class="col-md-4 col-xs-12"> <div class="tour-img-container"> <img class="animate-top" src="' . $img . '" alt="phone"></div></div>';
  $output .= '<div class="col-md-4  col-vertical">';
  $output .= '<div class="tour-text-container vertical-center">';
  $output .= ($r_title) ? '<h2 class="tour-title a animate-top">' . $r_title . ' <span> ' . $r_title_span . '</span> </h2>' : '';
  $output .= ($r_content) ? '<p class="animate-top">' . $r_content. '</p>' : '';
  $output .= '</div></div>';
  $output .= '</div></div>';
             
  return $output;
}
add_shortcode( 'webapp_vertical_image_slider_item', 'webapp_vertical_image_slider_item' );
