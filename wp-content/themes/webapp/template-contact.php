<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Contact Page
 *
 * The contact form page template displays the a
 * simple contact form in your website's content area.
 *
 */
 
global $tt_temptt_opt;
get_header();
 
$nameError = '';
$emailError = '';
$commentError = '';

//If the form is submitted
if( isset( $_POST['submitted'] ) ) {

	//Check to see if the honeypot captcha field was filled in
	if( trim( $_POST['checking'] ) !== '' ) {
		$captchaError = true;
	} else {

		//Check to make sure that the name field is not empty
		if( trim( $_POST['contactName'] ) === '' ) {
			$nameError =  esc_html__( 'You forgot to enter your name.', 'webapp' );
			$hasError = true;
		} else {
			$name = trim( $_POST['contactName'] );
		}

		//Check to make sure sure that a valid email address is submitted
		if( trim( $_POST['email'] ) === '' )  {
			$emailError = esc_html__( 'You forgot to enter your email address.', 'webapp' );
			$hasError = true;
		} else if ( ! eregi( "^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email'] ) ) ) {
			$emailError = esc_html__( 'You entered an invalid email address.', 'webapp' );
			$hasError = true;
		} else {
			$email = trim( $_POST['email'] );
		}

		//Check to make sure comments were entered
		if( trim( $_POST['comments'] ) === '' ) {
			$commentError = esc_html__( 'You forgot to enter your comments.', 'webapp' );
			$hasError = true;
		} else {
			$comments = stripslashes( trim( $_POST['comments'] ) );
		}

		//If there is no error, send the email
		if( ! isset( $hasError ) ) {

			$emailTo = get_option( 'tt_contactform_email' );
			$subject = esc_html__( 'Contact Form Submission from ', 'webapp' ).$name;
			$sendCopy = trim( $_POST['sendCopy'] );
			$body = sprintf( esc_html__( "Name: %s \n\nEmail: %s \n\nComments: %s", 'webapp' ), $name, $email, $comments );
			$headers = esc_html__( 'From: ', 'webapp') . "$name <$email>" . "\r\n" . esc_html__( 'Reply-To: ', 'webapp' ) . $email;

			wp_mail( $emailTo, $subject, $body, $headers );

			if( $sendCopy == true ) {
				$subject = esc_html__( 'You emailed ', 'webapp' ) . get_bloginfo( 'title' );
				$headers = esc_html__( 'From: ', 'webapp' ) . "$name <$emailTo>";
				wp_mail( $email, $subject, $body, $headers );
			}

			$emailSent = true;

		}
	}
}
?>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function() {
	jQuery( 'form#contactForm').submit(function() {
		jQuery( 'form#contactForm .error').remove();
		var hasError = false;
		jQuery( '.requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				var labelText = jQuery(this).prev( 'label').text();
				jQuery(this).parent().append( '<span class="alert alert-danger"><?php esc_html_e( 'You forgot to enter your', 'webapp' ); ?> '+labelText+'.</span>' );
				jQuery(this).addClass( 'inputError' );
				hasError = true;
			} else if(jQuery(this).hasClass( 'email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).prev( 'label').text();
					jQuery(this).parent().append( '<span class="alert alert-danger"><?php esc_html_e( 'You entered an invalid', 'webapp' ); ?> '+labelText+'.</span>' );
					jQuery(this).addClass( 'inputError' );
					hasError = true;
				}
			}
		});
		if(!hasError) {
			var formInput = jQuery(this).serialize();
			jQuery.post(jQuery(this).attr( 'action'),formInput, function(data){
				jQuery( 'form#contactForm').slideUp( "fast", function() {
					jQuery(this).before( '<p class="tick"><?php esc_html_e( '<strong>Thanks!</strong> Your email was successfully sent.', 'webapp' ); ?></p>' );
				});
			});
		}

		return false;

	});
});
//-->!]]>
</script>

<div id="main" class="main-container section">
	<?php do_action( 'tt_before_container' ); ?>
	<div class="container">
		<?php do_action( 'tt_after_container_start' ); ?>
		<div class="row">
			<div class="contacts col-md-12">

            <?php if( isset( $emailSent ) && $emailSent == true ) { ?>

                <p class="info"><?php esc_html_e( 'Your email was successfully sent.', 'webapp' ); ?></p>

            <?php } else { ?>

                <?php if ( have_posts() ) { ?>

                <?php while ( have_posts() ) { the_post(); ?>

						<div class="title-block">
							<h3 class="ml-title"><?php the_title(); ?></h3>
						</div>

						<?php the_content(); ?>

			            <!-- render google map -->
						<div class="map"><?php if( function_exists('tt_webapp_gmap')) echo tt_webapp_gmap(); ?></div>

						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-5 contactlists">

								<?php if (isset($tt_temptt_opt['tt_contact_title'])) { ?><div class="ml-title"><?php echo esc_html( $tt_temptt_opt['tt_contact_title'] ); ?></div>
								<?php } ?>
								<?php if (isset($tt_temptt_opt['tt_contact_intro'])) { ?><div class="article"><?php echo esc_html( $tt_temptt_opt['tt_contact_intro'] ); ?></div>
								<?php } ?>
								<div class="contact-block">
									<div class="inform-category email">
			    						<?php if (isset($tt_temptt_opt['tt_contactform_email']) && $tt_temptt_opt['tt_contactform_email'] != '' ) { ?> <a href="mailto:<?php echo sanitize_email( $tt_temptt_opt['tt_contactform_email'] ); ?>"><?php echo sanitize_email( $tt_temptt_opt['tt_contactform_email'] ); ?></a><?php } ?>
			    					</div>

			    					<div class="inform-category ph">
			    						<?php if (isset($tt_temptt_opt['tt_contact_number']) && $tt_temptt_opt['tt_contact_number'] != '' ) { ?>  <a href="tel:<?php echo preg_replace('/(\W*)/', '', $tt_temptt_opt['tt_contact_number']); ?>"><?php echo esc_attr( $tt_temptt_opt['tt_contact_number'] ); ?></a><?php } ?>
			    					</div>

			    					<div class="inform-category fax">
			    						<?php if (isset($tt_temptt_opt['tt_contact_fax']) && $tt_temptt_opt['tt_contact_fax'] != '' ) { echo  esc_attr($tt_temptt_opt['tt_contact_fax']) ; ?><?php } ?>
			    					</div>

			    					<div class="inform-category addr">
			    						<?php if (isset($tt_temptt_opt['tt_contact_address']) && $tt_temptt_opt['tt_contact_address'] != '' ) { echo nl2br( esc_html( $tt_temptt_opt['tt_contact_address'] ) ); } ?>
			    					</div>
			    					<?php  if ( shortcode_exists( $tt_temptt_opt['tt_contact_twitter'] ) ) { echo do_shortcode( $tt_temptt_opt['tt_contact_twitter'] ); } ?>
								</div>
							</div>
							<div class="col-md-7">
								<div class="comment">
									<div class="ml-title"><?php esc_html_e( 'Get in Touch with us', 'webapp' ); ?></div>
				                    <?php if( isset( $hasError ) || isset( $captchaError ) ) { ?>
				                        <p class="alert alert-danger"><?php esc_html_e( 'There was an error submitting the form.', 'webapp' ); ?></p>
				                    <?php } ?>

				                    <?php if ( $tt_temptt_opt['tt_contactform_email'] == '' ) { ?>
				                         <p class="alert alert-danger"><?php esc_html_e( 'E-mail has not been setup properly. Please add your contact e-mail in Theme-options!.', 'webapp' ); ?></p><?php } ?>

					                    <form action="<?php the_permalink(); ?>" id="contactForm" method="post">

					                        <ol class="forms">
					                            <li><label for="contactName"><?php esc_html_e( 'Name', 'webapp' ); ?></label>
					                                <input type="text" name="contactName" id="contactName" value="<?php if( isset( $_POST['contactName'] ) ) { echo esc_attr( $_POST['contactName'] ); } ?>" class="txt requiredField" />
					                                <?php if($nameError != '') { ?>
					                                    <span class="alert alert-danger"><?php echo esc_attr($nameError);?></span>
					                                <?php } ?>
					                            </li>

					                            <li><label for="email"><?php esc_html_e( 'Email', 'webapp' ); ?></label>
					                                <input type="text" name="email" id="email" value="<?php if( isset( $_POST['email'] ) ) { echo esc_attr( $_POST['email'] ); } ?>" class="txt requiredField email" />
					                                <?php if($emailError != '') { ?>
					                                    <span class="alert alert-danger"><?php echo esc_attr($emailError);?></span>
					                                <?php } ?>
					                            </li>

					                            <li class="textarea"><label for="commentsText"><?php esc_html_e( 'Message', 'webapp' ); ?></label>
					                                <textarea name="comments" id="commentsText" rows="20" cols="30" class="requiredField"><?php if( isset( $_POST['comments'] ) ) { echo esc_textarea( $_POST['comments'] ); } ?></textarea>
					                                <?php if( $commentError != '' ) { ?>
					                                    <span class="alert alert-danger"><?php echo esc_attr($commentError); ?></span>
					                                <?php } ?>
					                            </li>
					                            <li class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if( isset( $_POST['sendCopy'] ) && $_POST['sendCopy'] == true ) { echo ' checked="checked"'; } ?> /><label for="sendCopy"><?php esc_html_e( 'Send a copy of this email to yourself', 'webapp' ); ?></label></li>
					                            <li class="screenReader"><label for="checking" class="screenReader"><?php esc_html_e( 'If you want to submit this form, do not enter anything in this field', 'webapp' ); ?></label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if( isset( $_POST['checking'] ) ) { echo esc_attr( $_POST['checking'] ); } ?>" /></li>
					                            <li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><input class="submit button" type="submit" value="<?php esc_attr_e( 'Submit', 'webapp' ); ?>" /></li>
					                        </ol>
					                    </form>
								</div>
							</div>
						</div>
                    <?php
                        } // End WHILE Loop
                    } // End if
                } // End else
                ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>