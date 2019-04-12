<?php
/**
 *
 * One Itmage slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_one_image_slider( $atts, $content = '', $id = '' ) {
return '<div class="swiper-container tour-slider swiper-container-horizontal" style="cursor: -webkit-grab;" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1" data-mode="horizontal"><div class="swiper-wrapper">' . do_shortcode( $content ) .
   '</div><div class="pagination pagination-hidden"></div>
  <a class="arrow-left swiper-arrow-left" href="#"><i class="arrow-left-white"></i></a>
                        <a class="arrow-right swiper-arrow-right" href="#"><i class="arrow-right-white"></i></a>
   </div>';
 
}
add_shortcode( 'webapp_one_image_slider', 'webapp_one_image_slider' );

function webapp_one_image_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'image'         => ''
  ), $atts ) );
  $output = '';
      $img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
    
      $output .= '<div class="swiper-slide swiper-slide-duplicate"><div class="tour-img-container">';
      $output .= '<img class="animate-top" src="' . $img . '" alt="phone">';
      $output .= '</div></div>';
  return $output;
}
add_shortcode( 'webapp_one_image_slider_item', 'webapp_one_image_slider_item' );