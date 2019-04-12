<?php
/**
 *
 * Sale slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_sale_slider( $atts, $content = '', $id = '' ) {

return  '<div class="swiper-container slider-home slider-pricing" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1" data-mode="horizontal" >
            <div class="swiper-wrapper">' . do_shortcode( $content ) . '</div>
          
          <div class="pagination-pric pagination pagination-home pagination-video"></div></div>';
}
add_shortcode( 'webapp_sale_slider', 'webapp_sale_slider' );
function webapp_sale_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'image'        => '',
    'title'        => '',
    'price'        => '',
    'p_color'      => '',
    'item'         => '',
    'item_span'    => '',
    'item_d'       => '',
    't_color'      => '',
    'button_t'     => '',
    'link'         => '',
    'button_color' => '',
    'icon'         => ''
  ), $atts ) );
    $img = '';
    $t_color = (!empty($t_color)) ? 'color: ' .$t_color. ';' : '' ;
    $p_color = (!empty($p_color)) ? 'color: ' .$p_color. ';' : '' ;
    $button_color = (!empty($button_color)) ? 'background: ' .$button_color. ';' : '' ;
    $icon = (!empty($icon)) ? '<i class="'. $icon .'" style=""></i>' : '' ;

  $output = '';
      $img = ( is_numeric( $image ) && ! empty( $image ) ) ? wp_get_attachment_url( $image ) : '';
      $img = (!empty($img)) ? 'background-image:url(' . $img . ');' : '' ;

      $output .= '<div class="swiper-slide slide-home slide-pricing" style="' . $img . '">';
      $output .= '<div class="container">';
      $output .= '<div class="title-block">';
      $output .= '<h2 class="hot-price" style="' . $t_color. '">' . $title . '<span style="' . $p_color. '"> ' . $price . '</span></h2>';
      $output .= '<h1 style="' . $t_color. '">' . $item . '<span style="' . $t_color. '"> ' . $item_span. '</span></h1>';
      $output .= '<p class="sub-title" style="color:' . $t_color. ';">' . $item_d . '</p>';
      $output .= ($button_t) ? '<div class="btn-box"> <button type="button" class="button btn-learn" style="' . $button_color . '"><a href="' . $link  . '" style=""> '. $icon .' ' . $button_t . ' </a> </button></div>' : '';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
  return $output;
}
add_shortcode( 'webapp_sale_slider_item', 'webapp_sale_slider_item' );