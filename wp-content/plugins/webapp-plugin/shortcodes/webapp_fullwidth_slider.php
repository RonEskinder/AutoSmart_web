<?php
/**
 *
 * Fullwidth slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_fullwidth_slider( $atts, $content = '', $id = '' ) {
return '<div class="customer-slider-container slider-modern"><div class="swiper-container customer-slider swiper-container-horizontal" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1" data-mode="horizontal" >
<div class="swiper-wrapper">' . do_shortcode( $content ) .'</div>
<div class="pagination-hidden  pagination"></div><a class="arrow-left arrow-left-fw swiper-arrow-left" href="#"><i class="arrow-left-white"></i></a>
                        <a class="arrow-right arrow-right-fw swiper-arrow-right" href="#"><i class="arrow-right-white"></i></a></div></div>';
 
}
add_shortcode( 'webapp_fullwidth_slider', 'webapp_fullwidth_slider' );

function webapp_fullwidth_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'title'         => '',
    'subtitle'      => '',
    't_color'       => '',
    'image'         => '',
    'bg_image'      => ''
  ), $atts ) );
  $output = '';
      $img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
      $background = ( is_numeric( $bg_image ) && ! empty( $bg_image ) ) ? wp_get_attachment_url( $bg_image ) : '';
      $output .= '<div class="swiper-slide customer-slide tour-slide" style="background-image:url('. $background .');">';
      $output .= '<div class="container-center"><div class="title-block title-block-tour"><div class="mbottom40"></div> ';
      $output .= ($title) ? '<h1 class="title"><span>'. $title.'</span> </h1>' : '';
      $output .= ($subtitle) ? '<p class="sub-title">'. $subtitle .'</p>' : '';
      $output .= '</div>';
      $output .= ($img) ? '<img src=' . $img . '>' : '';
      $output .= '</div></div>';
  return $output;
}
add_shortcode( 'webapp_fullwidth_slider_item', 'webapp_fullwidth_slider_item' );
