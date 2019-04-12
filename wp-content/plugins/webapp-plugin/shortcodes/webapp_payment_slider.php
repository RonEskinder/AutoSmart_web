<?php
/**
 *
 * Payment slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_payment_slider( $atts, $content = '', $id = '' ) {
 
 extract( shortcode_atts( array(
  'bg_color'     => '',
  'image'        => ''
), $atts ) );
  $background = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
  return  '<div class="payment-container clearfix" style="background: url('.$background.') no-repeat center;"> 
            <div class="payment-info" style="background: ' . $bg_color . ';">
              <div class="swiper-container payment-slider swiper-container-horizontal" data-loop="1">
                <div class="swiper-wrapper">' . do_shortcode( $content ) . '</div>
              <div class="payment-pagination swiper-pagination-clickable"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
              </div>
              </div>
            </div>';
}
add_shortcode( 'webapp_payment_slider', 'webapp_payment_slider' );
function webapp_payment_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'images'       => '',
    'title'        => '',
    'title_span'   => '',
    'text'         => '',
    't_color'      => '',
    'bg_color'     => ''
  ), $atts ) );
  $output = '';
      $img = ( is_numeric( $images ) && ! empty( $images ) ) ? wp_get_attachment_url( $images ) : '';
      $output .= '<div class="swiper-slide deckript-slide">';
      $output .= '<img src="' . $img . '" alt="payment info">';
      $output .= ($title) ? '<h2 style="color: ' . $t_color . ' ;"> <span> ' .$title_span. ' </span> ' . $title . ' </h2>' : '';
      $output .= ($text) ? '<p style="color: ' . $t_color . ' ;">' . $text . '</p>' : '';
      $output .= '</div>';
  return $output;
}
add_shortcode( 'webapp_payment_slider_item', 'webapp_payment_slider_item' );