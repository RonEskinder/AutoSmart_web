<?php
/**
 *
 * Help slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_help_slider( $atts, $content = '', $id = '' ) {

return  '<div class="help-slider-container">
          <div class="swiper-container customer-slider swiper-container-horizontal"  data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1" data-mode="horizontal" style="cursor: -webkit-grab;">
              <div class="swiper-wrapper">' . do_shortcode( $content ) . '</div> 
          
          <div class="pagination-customer pagination-help pagination swiper-pagination-clickable"></div>
          <div class="container container-arrow">
                  <a class="arrow-left-cus" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                  <a class="arrow-right-cus" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>';
}
add_shortcode( 'webapp_help_slider', 'webapp_help_slider' );
function webapp_help_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'image'        => '',
    'title'        => '',
    'text'         => '',
    't_color'      => ''
  ), $atts ) );
  $output = '';
      $img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
      $output .= '<div class="swiper-slide customer-slide help-slide" data-swiper-slide-index="0">';
      $output .= '<div class="container container-slide">';
      $output .= '<div class="help-img-box"><img src="' . $img . '" alt="hand"></div>';
      $output .= '<div class="help-container">';
      $output .= ($title) ? '<h2 class="help-title" style="color: ' . $t_color . ';">' . $title . '</h2>' : '';
      $output .= ($text) ? '<p class="info-text" style="color: ' . $t_color . ';"> ' . $text . ' </p>' : '';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
  return $output;
}
add_shortcode( 'webapp_help_slider_item', 'webapp_help_slider_item' );