<?php
/**
 *
 * Contact
 *
 */
function webapp_contact_fn($atts, $content = '', $id = '') {
	$output  = '';
		 $defaults = array(
			'address' => '', // name of the firm
			'phone' => '',
			'email' => '',
			'facebook' => '',
			'twitter' => '',
			'google' => '',
		);
		extract(shortcode_atts( $defaults, $atts));
		// building the widget details.
		ob_start(); ?>
					 <div class="col-contact">
                        <div class="contact-container">
                            <div class="ftr-contact contact-address">
	                            <?php if( !empty( $address ) ) { echo '<address>'. esc_attr($address) .'</address>' ; } ?>
                            </div>
                            <div class="ftr-contact contact-mail">
	                            <?php if( !empty( $email ) ) { echo '<a href="mailto:'. esc_attr($email) .'">'. esc_attr($email) .'</a>' ; } ?>
                            </div>
                            <div class="ftr-contact contact-phone">
	                            <?php if( !empty( $phone ) ) { echo '<a href="'. esc_attr($phone) .'">'. esc_attr($phone) .'</a>' ; } ?>
                            </div>
                        </div>
                        <div class="col-social">
                            <div class="ftr-social">
	                            <?php if( !empty( $facebook ) ) { echo '<a href="'. esc_attr($facebook) .'"><i class="fa fa-facebook"></i></a>' ; } ?>
	                            <?php if( !empty( $twitter ) ) { echo '<a href="'. esc_attr($twitter) .'"><i class="fa fa-twitter"></i></a>' ; } ?>
	                            <?php if( !empty( $google ) ) { echo '<a href="'. esc_attr($google) .'"><i class="fa fa-google-plus"></i></a>' ; } ?>
                            </div>
                        </div>
                    </div>
		<?php $contactwidget = ob_get_clean();
		return $contactwidget;
}
add_shortcode( 'webapp_contact', 'webapp_contact_fn' );
