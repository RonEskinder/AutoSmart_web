<?php
/**
 *
 * Contact Info
 * @since 1.0.0
 * @version 1.1.0
 * 
 */
function webapp_contact_info($atts, $content = '', $id = '') {
    extract( shortcode_atts( array(
        'title'     => '',
        'adress'    => '',
        'email'     => '',
        'phone'     => '',
        't_color'   => ''
        ), $atts ) );
   
    $txt_color = ( isset( $t_color ) && ! empty( $t_color ) ) ? 'style="color: ' . $t_color . ' ;"' : '';
   
    $output = '';
$output  ='<div class="animate-right app-contact-container fadeInRight" style="text-align: center;">';
$output .= ($title) ? '<h3 ' . $txt_color . '>' . $title . '</h3>' : '';
$output .= ($adress) ? '<div class="contact-item" ' . $txt_color . '><address>' . $adress . ' </address> </div>' : '';
$output .= ($email) ? '<div class="contact-item"><a href="mailto: ' . $email . ' " ' . $txt_color . ' >' . $email . ' </a>
    </div>' : '';
$output .= ($phone) ? '<div class="contact-item"><a href="tel:' . $phone . ' " ' . $txt_color . ' >' . $phone . ' </a>
    </div>' : '';
$output .= '</div>';
    return $output;
}
add_shortcode( 'webapp_contact_info', 'webapp_contact_info' );