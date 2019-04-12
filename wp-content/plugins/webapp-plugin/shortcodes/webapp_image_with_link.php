<?php
/**
 *
 * Banner
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_image_with_link($atts, $content = '', $id = '') {
    
    extract( shortcode_atts( array(
        'images'               => '',
        'image_link'           => ''
    ), $atts ) );
    $img = ( is_numeric( $images ) && ! empty( $images ) ) ? wp_get_attachment_url( $images ) : '';
    $output = '<a class="methods" href="' . $image_link . '"><img class="img-responsive" src="' . $img . '" alt="methods"> </a>';
return $output;
    
}
add_shortcode( 'webapp_image_with_link', 'webapp_image_with_link' );