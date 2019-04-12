<?php
/**
 *
 * Simple image slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_vertical_slider( $atts, $content = '', $id = '' ) {
  return '<div class="powerfull-slider-container"><div class="bxslider">' . do_shortcode( $content ) . '</div></div>';
}
add_shortcode( 'webapp_vertical_slider', 'webapp_vertical_slider' );
function webapp_vertical_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'images'  => '',
    'images2'  => '',
    'title' => '',
    'i_text'       => '',
    'i_text2'      => '',
    'link'         => '',
    't_color'      => '',
    'bg_color'     => '',
    'i_class'      => '',
    'link2'        => '',
    't_color2'     => '',
    'bg_color2'    => '',
    'i_class2'     => ''
  ), $atts ) );
  $output = '';

    $t_color = (!empty($t_color)) ? 'color: ' .$t_color. ';' : '' ;
    $bg_color = (!empty($bg_color)) ? 'background-color: ' .$bg_color. ';' : '' ;
    $i_class = (!empty($i_class)) ? '<i class="'. $i_class .'"></i>' : '' ;

    $t_color2 = (!empty($t_color2)) ? 'color: ' .$t_color2. ';' : '' ;
    $bg_color2 = (!empty($bg_color2)) ? 'background-color: ' .$bg_color2. ';' : '' ;
    $i_class2 = (!empty($i_class2)) ? '<i class="'. $i_class2 .'"></i>' : '' ;

      $url = ( is_numeric( $images ) && ! empty( $images ) ) ? wp_get_attachment_url( $images ) : '';
      $url2 = ( is_numeric( $images2 ) && ! empty( $images2 ) ) ? wp_get_attachment_url( $images2 ) : '';
      $output .= '<div class="slide">';
      $output .= '<div class="row">';
      $output .= '<div class="col-sm-4 phone-hide col-sm-offset-1">';
      $output .= '<div class="phone-powerfull-block">';
      $output .= '<img class="phone-white animate-left" src="'. $url .'" alt="white"/>';
      $output .= '<img class="phone-black animate-left" src="'. $url2 .'" alt="phone"/></div></div>';
      $output .= '<div class="col-sm-7 ">';
      $output .= '<div class="powerfull-info">';
      $output .= '<h3 class="animate-top">'. $title .'</h3><div class="powerfull-info-text animate-top">' . $content . '</div>';
      $output .= '<div class="btn-box btn-box-powerfull animate-top">';
      $output .= '<a href="'. $link . '" class="button banner-btn-1" style="' .$t_color. $bg_color . '"> '. $i_class . $i_text .'</a>';
      $output .= '<a href="'. $link2 .'" class="button btn_grey banner-btn-3" style="' .$t_color2 . $bg_color2 . '"> '. $i_class2 . $i_text2 .'</a>';
     
      $output .= '</div></div></div></div></div>';
 
  
  return $output;
}
add_shortcode( 'webapp_vertical_slider_item', 'webapp_vertical_slider_item' );



                
                    
                    
                    
                        
                            
                                
                                
                               
                                   
                               
                            
                        
          
                
