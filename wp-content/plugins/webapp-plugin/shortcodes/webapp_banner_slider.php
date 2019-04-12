<?php
/**
 *
 * Simple image slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_banner_slider( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
     'slidespeed'  => '500',
     'slidedelay'  => '5000',
     'hide_button' => '',
     'disable_dataloop' => 'no',
  ), $atts ) );
   $hide_button_css = ''; $dataloop = '1';
  if('yes' == $hide_button) $hide_button_css = 'tt-no-navigation';
  if('yes' == $disable_dataloop) $dataloop = '0';

  return '<div class="swiper-container '.$hide_button_css.' home-slider" data-autoplay="'.$slidedelay.'" data-loop="'.$dataloop.'" data-speed="'.$slidespeed.'" data-center="0" data-slides-per-view="1" data-mode="horizontal" >
  <div class="swiper-wrapper">' . do_shortcode( $content ) .'</div>
   <div class="pagination-hidden  pagination"></div>
   <a class="arrow-left-cus swiper-arrow-left" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
   <a class="arrow-right-cus swiper-arrow-right" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
   </div>';
}
add_shortcode( 'webapp_banner_slider', 'webapp_banner_slider' );

function webapp_banner_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
     'images'  => '',
     'images2'  => '',
     'title' => '',
     'titlebold' => '',
     'subtitle' => '',
      'i_text'         => '',
      'link'         => '',
      't_color'      => '',
      'bg_color'     => '',
      'i_class'      => '',
      'i_text2'         => '',
      'link2'         => '',
      't_color2'      => '',
      'bg_color2'     => '',
      'i_class2'      => ''
  ), $atts ) );

      $t_color = (!empty($t_color)) ? 'color: ' .$t_color. ';' : '' ;
      $bg_color = (!empty($bg_color)) ? 'background-color: ' .$bg_color. ';border-color: ' .$bg_color. ';' : '' ;
      $i_class = (!empty($i_class)) ? '<i class="'. $i_class .'"></i>' : '' ;

      $t_color2 = (!empty($t_color2)) ? 'color: ' .$t_color2. ';' : '' ;
      $bg_color2 = (!empty($bg_color2)) ? 'background-color: ' .$bg_color2. ';border-color: ' .$bg_color2. ';' : '' ;
      $i_class2 = (!empty($i_class2)) ? '<i class="'. $i_class2 .'"></i>' : '' ;

  $output = '';
      $url = ( is_numeric( $images ) && ! empty( $images ) ) ? wp_get_attachment_url( $images ) : '';
      $url2 = ( is_numeric( $images2 ) && ! empty( $images2 ) ) ? wp_get_attachment_url( $images2 ) : '';
      $output .= '<div class="swiper-slide slide-home" style="background-image:url('. $url .');">';
      $output .= '<div class="container"><div class="title-block title-block-home">';
      $output .= '<h1 class="title">'. $title.' <span>'. $titlebold .'</span> </h1>';
      $output .= '<p class="sub-title">'. $subtitle .'</p>';
      $output .= '<div class="btn-box">';
      $output .= '<a href="'. $link . '" class="button banner-btn-1" style="' .$t_color. ' ' . $bg_color . '">'. $i_class . $i_text .'</a>';
      $output .= '<a href="'. $link2 .'" class="button banner-btn-2" style="' .$t_color2. ' '. $bg_color2 . '">'. $i_class2 . $i_text2 .'</a>';
      $output .= '</div></div>';
      $output .= '<img class="hidden-xs" src="'. $url2 .'" alt="banner"/>';
      $output .= '</div></div>';
  return $output;
}
add_shortcode( 'webapp_banner_slider_item', 'webapp_banner_slider_item' );
