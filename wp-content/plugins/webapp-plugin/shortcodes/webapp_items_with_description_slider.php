<?php
/**
 *
 * Items with description slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_items_slider( $atts, $content = '', $id = '' ) {
return '<div class="screen-slider-container"><div class="swiper-container tour-slider t-slider-four swiper-container-horizontal" style="cursor: -webkit-grab;" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4" data-mode="horizontal">
<div class="swiper-wrapper">' . do_shortcode( $content ) .'</div>
<div class="pagination-screen pagination swiper-pagination-clickable"></div>
</div></div>';
 
}
add_shortcode( 'webapp_items_slider', 'webapp_items_slider' );

function webapp_items_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'image'    => '',
    'title'    => '',
    'subtitle' => ''   
  ), $atts ) );
  $output = '';
      $img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
    
      $output .= '<div class="swiper-slide"> <div class="screen-slide-content animate-left delay-800">';
      $output .= '<img class="animate-top" src="' . $img . '" alt="phone">';
      $output .= ($title) ? '<h3 class="benefits-title">' . $title . '</h3>' : '';
      $output .= ($subtitle) ? '<p class="main-text">' . $subtitle . '</p>' : '';
      $output .= '</div></div>';
  return $output;
}
add_shortcode( 'webapp_items_slider_item', 'webapp_items_slider_item' );