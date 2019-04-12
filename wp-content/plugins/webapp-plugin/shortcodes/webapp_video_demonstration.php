<?php
/**
 *
 * Title
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_video_demonstration($atts, $content = '', $id = '') {
	  extract( shortcode_atts( array(
	    'youtube'    => '',
	  ), $atts ) );
	$output  = '';
	
	$output .= '<div class="close-video"></div>'; 
	$output .= '<iframe class="video" src="" ></iframe>';
	$output .= '<a class="play animate-fade home-play" id="play" data-src="https://www.youtube.com/embed/' . $youtube . '?rel=0&amp;autoplay=1"  href="#"></a>';
	
	return $output;
}
add_shortcode( 'webapp_video_demonstration', 'webapp_video_demonstration' );