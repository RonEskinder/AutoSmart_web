<?php
/**
 *
 * Simple image slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function webapp_video_slider( $atts, $content = '', $id = '' ) {
  return '<div class="video-container-slider">
            <div id="close-video" class="close-video"></div>
            <iframe class="video-sl video" src="" ></iframe>
     
                <div class="swiper-container video-slider" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1" data-mode="horizontal">
                    <div class="swiper-wrapper">' . do_shortcode( $content ) .'</div>
                
              <div class="pagination pagination-video"></div>
              </div>
          </div>';
}
add_shortcode( 'webapp_video_slider', 'webapp_video_slider' );

function webapp_video_slider_item( $atts, $content = '', $id = '' ) {
  extract( shortcode_atts( array(
    'images'  => '',
    'title' => '',
    'titlebold' => '',
    'link' => ''
  ), $atts ) );
  $output = '';
      $url = ( is_numeric( $images ) && ! empty( $images ) ) ? wp_get_attachment_url( $images ) : '';
  
      $output .= '<div class="swiper-slide video-slide" style="background-image:url('. $url .');">';
      $output .= '<div class="container">';
      $output .= '<h2 class="video-title"> '. $title .' <a class="play sl-play " data-src="https://www.youtube.com/embed/'. $link .'?rel=0&amp;autoplay=1"  href="#"></a><span>'. $titlebold .' </span></h2>';
      $output .= '</div></div>';
  return $output;
}
add_shortcode( 'webapp_video_slider_item', 'webapp_video_slider_item' );

        
                            
                            
                                
                                    
                                    
                                    
                                      
                                
                                
                                
                           
                


                
                    
                    
                    
                        
                            
                                
                                
                               
                                   
                               
                            
                        
          
                
