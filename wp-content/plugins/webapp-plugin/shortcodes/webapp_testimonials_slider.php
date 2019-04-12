<?php
/**
 *
 * Simple image slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_testimonials_slider( $atts, $content = '', $id = '' ) {
  return '<div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1" data-mode="horizontal" ><div class="swiper-wrapper">' . do_shortcode( $content ) . '</div><div class="pagination-customer  pagination"></div>
<a class="arrow-left-cus swiper-arrow-left" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
<a class="arrow-right-cus swiper-arrow-right" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
  </div>';
}
add_shortcode( 'webapp_testimonials_slider', 'webapp_testimonials_slider' );
function webapp_testimonials_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'images'  => '',
    'testimonials' => '',
    'author' => '',
    'position' => ''
  ), $atts ) );
  $output = '';
      $url = ( is_numeric( $images ) && ! empty( $images ) ) ? wp_get_attachment_url( $images ) : '';
      $output .= '<div class="swiper-slide customer-slide">';
      $output .= '<img class="img-customer animate-fade" src="'. $url .'" alt="customer"/>';
      $output .= '<p class="customet-text animate-fade">' . $testimonials . '</p>';
      $output .= '<div class="customer-name animate-fade"> '. $author .', <span>'. $position .'</span> </div>';
      $output .= '</div>';
  return $output;
}
add_shortcode( 'webapp_testimonials_slider_item', 'webapp_testimonials_slider_item' );

                
                    
                    
                    
                        
                            
                                
                                
                               
                                   
                               
                            
                        
          
                
