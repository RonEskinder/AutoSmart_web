<?php
/**
 *
 * SUBSCRIBE
 * @since 1.0.0
 * @version 1.1.0
 * 
 */

function webapp_subscribe($atts, $content = '', $id = '') {
	extract( shortcode_atts( array(
	    'mc_form_url'    => '',
	  ), $atts ) );

	$output  = '';
	if( empty($mc_form_url) ) return 'Please enter mailchimp API key and list ID.';
	ob_start(); ?>
	<div class="form-subscribe animate-top">

    		<?php if ( $mc_form_url != "" ) : ?>
			<!-- Begin MailChimp Signup Form -->
				<form class="validate newsletter-form" action="<?php echo $mc_form_url; ?>" method="post" target="popupwindow" onsubmit="window.open('<?php echo $mc_form_url; ?>', 'popupwindow', 'scrollbars=yes,width=650,height=520');return true">
					<input type="text" name="EMAIL" class="required email subscribe-email" value="<?php _e('E-mail','templatation'); ?>"  id="mce-EMAIL" onfocus="if (this.value == '<?php _e('E-mail','templatation'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('E-mail','templatation'); ?>';}">
					<button type="submit" class="btn-subscribe"><i class="mail-white-ico mail-ico"></i><?php _e('subscribe','templatation'); ?></button>
				</form>
			<!--End mc_embed_signup-->
			<?php endif; ?>


	</div>
	<?php
	$output = ob_get_clean();
	return $output;
}

add_shortcode( 'webapp_subscribe', 'webapp_subscribe' );

