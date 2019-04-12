<?php
/**
 *
 * Title
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_benefits($atts, $content = '', $id = '') {
	  extract( shortcode_atts( array(
	  	'image1'    => '',
	  	'image2'    => '',
	    'title1'    => '',
	    'text1'    => '',
	    'class1'    => '',
	    'title2'    => '',
	    'text2'    => '',
	    'class2'    => '',
	    'title3'    => '',
	    'text3'    => '',
	    'class3'    => '',
	    'title4'    => '',
	    'text4'    => '',
	    'class4'    => '',
	    'title5'    => '',
	    'text5'    => '',
	    'class5'    => '',
	    'title6'    => '',
	    'text6'    => '',
	    'class6'    => ''
	  ), $atts ) );
	$output  = '';
    $img1 = ( is_numeric( $image1 ) && ! empty( $image1 ) ) ? wp_get_attachment_url( $image1 ) : '';
    $img2 = ( is_numeric( $image2 ) && ! empty( $image2 ) ) ? wp_get_attachment_url( $image2 ) : '';
	
	$output .= '<div class="col-sm-12 col-md-3">'; 
	$output .= '<div class="benefits-list benefits-customization animate-left delay-400 benefits-list-left">';
	$output .= '<h3 class="benefits-title">' . $title1 . '</h3>';
	$output .= '<p class="benefits-text">' . $text1 . '</p>';
	$output .= '<div class="benefits-text-ico"><i class="fa '. $class1 .'"></i></div>';
	$output .= '</div>';
	$output .= '<div class="benefits-list benefits-customization animate-left delay-400 benefits-list-left">';
	$output .= '<h3 class="benefits-title">' . $title2 . '</h3>';
	$output .= '<p class="benefits-text">' . $text2 . '</p>';
	$output .= '<div class="benefits-text-ico"><i class="fa '. $class2 .'"></i></div>';
	$output .= '</div>';
	$output .= '<div class="benefits-list benefits-customization animate-left delay-400 benefits-list-left">';
	$output .= '<h3 class="benefits-title">' . $title3 . '</h3>';
	$output .= '<p class="benefits-text">' . $text3 . '</p>';
	$output .= '<div class="benefits-text-ico"><i class="fa '. $class3 .'"></i></div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="col-sm-6 col-device">';
	$output .= '<div class="benefits-device">';
	$output .= '<img class="benefits-device-1 animate-left delay-400" src="'. $img1 .'"/>';
	$output .= '<img class="benefits-device-2 animate-right delay-400" src="'. $img2 .'"/>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="col-sm-12 col-md-3">'; 
	$output .= '<div class="benefits-list benefits-customization animate-left delay-400 benefits-list-right">';
	$output .= '<h3 class="benefits-title">' . $title4 . '</h3>';
	$output .= '<p class="benefits-text">' . $text4 . '</p>';
	$output .= '<div class="benefits-text-ico"><i class="fa '. $class4 .'"></i></div>';
	$output .= '</div>';
	$output .= '<div class="benefits-list benefits-customization animate-left delay-400 benefits-list-right">';
	$output .= '<h3 class="benefits-title">' . $title5 . '</h3>';
	$output .= '<p class="benefits-text">' . $text5 . '</p>';
	$output .= '<div class="benefits-text-ico"><i class="fa '. $class5 .'"></i></div>';
	$output .= '</div>';
	$output .= '<div class="benefits-list benefits-customization animate-left delay-400 benefits-list-right">';
	$output .= '<h3 class="benefits-title">' . $title6 . '</h3>';
	$output .= '<p class="benefits-text">' . $text6 . '</p>';
	$output .= '<div class="benefits-text-ico"><i class="fa '. $class6 .'"></i></div>';
	$output .= '</div>';
	$output .= '</div>';
	return $output;
}
add_shortcode( 'webapp_benefits', 'webapp_benefits' );
