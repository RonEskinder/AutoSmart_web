<?php

defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'WC_Payment_Gateway_CC' ) ) {
	exit;
}

function wc_credomatic_paycom_gateway_encrypt_key() {
	$key_file_path = CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH . 'keys/credomatic.public.key.pem';
	$encrypted_key = '';
	if ( isset( $_POST['key'] ) ) {
		$key = htmlentities( wp_strip_all_tags( $_POST['key'] ) );
		$encrypted_key = WC_Credomatic_PayCOM_Gateway_Encryption_Helper::encrypt( $key_file_path, $key );
	}else {
		WC_Credomatic_PayCOM_Gateway::log( __( 'An error occurred during the merchant key encryption', 'credomatic-paycom' ), $_POST );
	}
	echo $encrypted_key;
	wp_die();
}

add_action( 'wp_ajax_wc_credomatic_paycom_gateway_encrypt_key' , 'wc_credomatic_paycom_gateway_encrypt_key' );

final class WC_Credomatic_PayCOM_Gateway extends WC_Payment_Gateway_CC {

	private static $logger = false;

	public function __construct() {

		$this->id = 'credomatic';
		$this->icon = CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL . 'assets/img/credomatic-paycom-gateway-checkout-icon.png';
		$this->has_fields = true;
		$this->method_title = __( 'Credomatic PayCOM', 'credomatic-paycom' );
		$this->method_description = __( 'Pay with your credit card via Credomatic PayCOM', 'credomatic-paycom' );

		$this->init_form_fields();
		$this->init_settings();

		$this->title = __( 'Credomatic', 'credomatic-paycom' );
		$this->enabled = $this->get_option( 'enabled' );
		$this->username = $this->get_option( 'username' );
		$this->key = $this->get_option( 'key' );
		$this->key_id = $this->get_option( 'key_id' );
		$this->processor_id = $this->get_option( 'processor_id' );
		$this->timeout = $this->get_option( 'timeout' );

		add_action( 'admin_notices', array( $this, 'check_option_force_ssl_checkout' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_assets' ) );
		add_action( 'woocommerce_credit_card_form_end', array( $this, 'after_cc_form' ) );

	}

	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title' => __( 'Enable/Disable', 'credomatic-paycom' ),
				'type' => 'checkbox',
				'label' => __( 'Enable Credomatic PayCOM payment', 'credomatic-paycom' ),
				'default' => 'yes',
			),
			'username' => array(
				'title' => __( 'Username', 'credomatic-paycom' ),
				'type' => 'text',
				'description' => __( 'Credomatic api username', 'credomatic-paycom' ),
				'default' => '',
			),
			'key' => array(
				'title' => __( 'Key', 'credomatic-paycom' ),
				'type' => 'textarea',
				'description' => __( 'Credomatic private key api', 'credomatic-paycom' ),
				'default' => '',
			),
			'key_id' => array(
				'title' => __( 'Key ID', 'credomatic-paycom' ),
				'type' => 'textarea',
				'description' => __( 'Credomatic public key api', 'credomatic-paycom' ),
				'default' => '',
			),
			'processor_id' => array(
				'title' => __( 'Processor id', 'credomatic-paycom' ),
				'type' => 'text',
				'description' => __( 'Processing terminal identifier', 'credomatic-paycom' ),
				'default' => '',
			),
			'timeout' => array(
				'title' => __( 'Timeout', 'credomatic-paycom' ),
				'type' => 'text',
				'description' => __( 'Timeout request', 'credomatic-paycom' ),
				'default' => 45,
			),
		);
	}

	public function admin_options() {
		if ( current_user_can( 'manage_options' ) ) {
?>
				<div class="credomatic-wrap">
					<div class="credomatic-icon"></div>
					<h2><?php echo esc_html__( 'WooCommerce Credomatic PayCOM Payment Gateway', 'credomatic-paycom' ); ?></h2>
					<p><?php echo esc_html__( 'Take credit card payments safely and securily direct on your checkout using the WooCommerce Credomatic PayCOM Payment Gateway.', 'credomatic-paycom' )?></p>
					<table class="form-table">
						<?php $this->generate_settings_html(); ?>
					</table>
				</div>
			<?php
		}else {
			$current_user = wp_get_current_user();
			if ( $current_user instanceof WP_User ) {
				static::log( sprintf( __( 'The current user %s is trying to access the plugin settings options', 'credomatic-paycom' ), $current_user->user_login ), null );
			}
			echo '<div class="error"><p>' . esc_html__( 'The current user does not have sufficient permissions to access the configuration options of this component. Contact the site administrator for more information.', 'credomatic-paycom' ) . '</p></div>';
		}
	}

	public function validate_fields() {

		$generic_error_message = __( 'Please check the data and try again', 'credomatic-paycom' );

		$card_number = $this->get_post_field( 'credomatic-card-number' );
		$cvc = $this->get_post_field( 'credomatic-card-cvc' );
		$card_expiry = $this->get_post_field( 'credomatic-card-expiry' );
		$card_holder = $this->get_post_field( 'credomatic-card-holder' );

		if ( !WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::validate_card_number( $card_number ) ) {
			wc_add_notice( $generic_error_message, 'error' );
			return false;
		}

		if ( !WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::validate_cvc( $cvc ) ) {
			wc_add_notice( $generic_error_message, 'error' );
			return false;
		}

		if ( !WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::validate_card_expiry( $card_expiry ) ) {
			wc_add_notice( $generic_error_message, 'error' );
			return false;
		}

		if ( !WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::validate_card_holder( $card_holder ) ) {
			wc_add_notice( $generic_error_message, 'error' );
			return false;
		}

		return true;

	}

	public function process_payment( $order_id ) {

		$order  = new WC_Order( $order_id );
		$amount = number_format( $order->get_total(), 2, '.', '' );
		$username = sanitize_text_field( $this->username );
		$key = $this->decrypt_key( sanitize_text_field( $this->key ) );
		$key_id = $this->decrypt_key( sanitize_text_field( $this->key_id ) );
		$processor_id = sanitize_text_field( $this->processor_id );
		$timeout = absint( sanitize_text_field( $this->timeout ) );
		$time = time();
		$redirect = $this->get_return_url( $order );
		$hash = md5( implode( '|', array( $order_id, $amount, $time, $key ) ) );

		$ccnumber = $this->get_credit_card_data( 'credomatic-card-number', 'card-number' );
		$cvv = $this->get_credit_card_data( 'credomatic-card-cvc', 'card-cvc' );
		$ccexp = $this->get_credit_card_data( 'credomatic-card-expiry', 'card-expiry' );
		$card_holder = $this->get_credit_card_data( 'credomatic-card-holder', 'card-holder' );

		$params = array(
			'username' => $username,
			'type' => 'auth',
			'key_id' => $key_id,
			'hash' => $hash,
			'time' => $time,
			'redirect' => $redirect,
			'ccnumber' => $ccnumber,
			'ccexp' => $ccexp,
			'amount' => $amount,
			'orderid' => $order_id,
			'cvv' => $cvv,
		);

		if ( !empty( $processor_id ) ) {
			$params['processor_id'] = $processor_id;
		}

		if ( $timeout < 45 || $timeout > 60 ) {
			$timeout = 45;
		}

		$raw_response = wp_safe_remote_post( CREDOMATIC_PAYCOM_GATEWAY_URL, array(
				'body' => http_build_query( $params, '', '&' ),
				'timeout' => $timeout,
				'redirection' => 0,
				'sslverify' => false,
				'headers' => array(),
				'cookies' => array(),
				'httpversion' => '1.1',
			) );

		if ( is_wp_error( $raw_response ) ) {
			static::log( $raw_response->get_error_message(), $raw_response );
			$order->add_order_note( __( 'There was a communication error when trying to connect to Credomatic servers.', 'credomatic-paycom' ) );
			wc_add_notice( __( 'Sorry for the inconvenience, there has been an error while trying to communicate with the bank\'s servers. Please try again later or contact the shop owner', 'credomatic-paycom' ), 'error' );
			return array(
				'result' => 'fail',
				'redirect' => '',
			);
		}

		if ( !wp_remote_retrieve_header( $raw_response, 'location' ) ) {
			static::log( __( 'The HTTP response header "Location" is not in the response returned by the server.', 'credomatic-paycom' ), $raw_response );
			$order->add_order_note( __( 'Unexpected content, malformed response returned by the server. The response headers are not found.', 'credomatic-paycom' ) );
			wc_add_notice( __( 'Sorry for the inconvenience, there has been an error while trying to get response from the bank\'s servers. Please try again later or contact the shop owner', 'credomatic-paycom' ), 'error' );
			return array(
				'result' => 'fail',
				'redirect' => '',
			);
		}

		$trx_response = WC_Credomatic_PayCOM_Gateway_Utilities::process_raw_response( $raw_response );

		if ( !$trx_response ) {
			static::log( __( 'There was an error processing the response returned by the bank, the answer does not have the required elements.', 'credomatic-paycom' ), $trx_response );
			$order->add_order_note( __( 'There was an error processing the response returned by the server, unexpected content, there are no elements in the response that can be processed.', 'credomatic-paycom' ) );
			wc_add_notice( __( 'Sorry for the inconvenience, there has been an error while trying to get response from the bank\'s servers. Please try again later or contact the shop owner', 'credomatic-paycom' ), 'error' );
			return array(
				'result' => 'fail',
				'redirect' => '',
			);
		}

		$response_code = $trx_response['response_code'];

		if ( $response_code >= '300' ) {
			static::log( __( 'An error related to the payment gateway has occurred, please see the details of the response, possibly due to a bad configuration.', 'credomatic-paycom' ), $trx_response );
			$order->add_order_note( __( 'There was an error with bank payment platform, please check the configuration parameters of the plugin.', 'credomatic-paycom' ) );
			wc_add_notice( __( 'Sorry for the inconvenience, there has been an error while trying to get response from the bank\'s servers. Please try again later or contact the shop owner', 'credomatic-paycom' ), 'error' );
			return array(
				'result' => 'fail',
				'redirect' => '',
			);
		}

		$is_authentic = WC_Credomatic_PayCOM_Gateway_Utilities::check_transaction_authenticity( $trx_response, $key );

		if ( !$is_authentic ) {
			static::log( __( 'There was an error while trying to verify the hash response returned by the server, check the details of the response.', 'credomatic-paycom' ), $trx_response );
			$order->add_order_note( __( 'There was an error, can not guarantee the authenticity of the response returned by the bank.', 'credomatic-paycom' ) );
			wc_add_notice( __( 'Sorry for the inconvenience, there has been an error while trying to get response from the bank\'s servers. Please try again later or contact the shop owner', 'credomatic-paycom' ), 'error' );
			return array(
				'result' => 'fail',
				'redirect' => '',
			);
		}

		if ( $response_code == '100' ) {

			static::log( __( 'Transaction was approved', 'credomatic-paycom' ), $trx_response );

			$order_notes  = __( 'Transaction was approved', 'credomatic-paycom' ) . PHP_EOL;
			$order_notes .= __( 'Cardholder', 'credomatic-paycom' ) . ': ' . $card_holder . PHP_EOL;
			$order_notes .= __( 'Transaction identifier', 'credomatic-paycom' ) . ': ' . $trx_response['transactionid'] . PHP_EOL;
			$order_notes .= __( 'Authorization code', 'credomatic-paycom' ) . ': ' . $trx_response['authcode'] . PHP_EOL;
			$order_notes .= __( 'Last 4 card digits', 'credomatic-paycom' ) . ': ' . WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::get_last_4_digits( $ccnumber );

			$order->add_order_note( $order_notes );
			$order->payment_complete();
			WC()->cart->empty_cart();

			return array(
				'result' => 'success',
				'redirect' => $this->get_return_url( $order ),
			);

		}elseif ( $response_code >= '200' || $response_code < '300' ) {

			static::log( __( 'Transaction was declined', 'credomatic-paycom' ), $trx_response );

			$order->add_order_note( __( 'Transaction was declined by processor', 'credomatic-paycom' ) );
			wc_add_notice( __( 'Transaction was declined by your bank or card issuer', 'credomatic-paycom' ), 'error' );
			return array(
				'result' => 'fail',
				'redirect' => '',
			);

		}else {

			static::log( __( 'Transaction was rejected by gateway', 'credomatic-paycom' ), $trx_response );

			$order->add_order_note( __( 'Transaction was rejected by gateway', 'credomatic-paycom' ) );
			wc_add_notice( __( 'No response from payment gateway server. Please try again later or contact the shop owner', 'credomatic-paycom' ), 'error' );
			return array(
				'result' => 'fail',
				'redirect' => '',
			);

		}

	}

	public function check_option_force_ssl_checkout() {
		if ( ( get_option( 'woocommerce_force_ssl_checkout' )==='no' ) && ( $this->enabled==='yes' ) ) {
			static::log( __( 'Checkout page is not secure, please enable "Force Secure Checkout" option in checkout settings', 'credomatic-paycom' ), null );
			echo '<div class="error"><p>' . sprintf( __( 'WooCommerce Credomatic PayCOM Payment Gateway is enable and the "<strong><a href="%s">force secure checkout</a></strong>" option is disable; your checkout is not secure!. Please enable this option an ensure your server has a valid SSL certificate.', 'credomatic-paycom' ), admin_url( 'admin.php?page=wc-settings&tab=checkout' ) ) . '</p></div>';
		}
	}


	public function after_cc_form( $gateway_id ) {
		if ( $gateway_id !== $this->id ) {
			return;
		}
		woocommerce_form_field( 'credomatic-card-holder', array(
				'type' => 'text',
				'label' => __( 'Cardholder', 'credomatic-paycom' ),
				'class' => array( 'form-row-wide' ),
				'placeholder' => __( 'Cardholder', 'credomatic-paycom' ),
				'required' => true,
				'maxlength' => 50,
				'input_class' => array( 'credomatic-card-holder' ),
				'value' => '',
				'custom_attributes' => array(
					'autocomplete' => 'off',
				),
			) );
	}

	private function get_credit_card_data( $field_name, $attribute_type ) {
		$field = $this->get_post_field( $field_name );
		switch ( $attribute_type ) {
		case 'card-number':
			$formatted_field = WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::format_card_number( $field );
			break;
		case 'card-cvc':
			$formatted_field = WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::format_cvc( $field );
			break;
		case 'card-expiry':
			$formatted_field = WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::format_card_expiry( $field );
			break;
		case 'card-holder':
			$formatted_field = WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper::format_card_holder( $field );
			break;
		default:
			$formatted_field = false;
			break;
		}
		return $formatted_field;
	}

	private function get_post_field( $field_name = '' ) {
		return isset( $_POST[$field_name] )? htmlentities( wp_strip_all_tags( $_POST[$field_name] ) ) : null;
	}

	private function decrypt_key( $key ) {
		$key_file_path = CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH . 'keys/credomatic.private.key.pem';
		return WC_Credomatic_PayCOM_Gateway_Encryption_Helper::decrypt( $key_file_path, $key );
	}

	public function enqueue_public_assets() {
		wp_enqueue_script( 'credomatic-jquery-alphanum', CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL . 'assets/js/jquery.alphanum.js',
			array( 'jquery' ), '1.0.25', true );

		wp_enqueue_script( 'credomatic-paycom-gateway-frontend', CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL . 'assets/js/wc-credomatic-paycom-gateway-frontend.js', array( 'jquery', 'credomatic-jquery-alphanum' ), '1.1.0', true );
	}

	public function enqueue_admin_assets() {
		wp_enqueue_style( 'credomatic-paycom-gateway-admin', CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL . 'assets/css/wc-credomatic-paycom-gateway-admin.css', '1.1.0', 'all' );

		wp_enqueue_script( 'credomatic-paycom-gateway-jquery-validate', CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array( 'jquery' ), '1.4.1', true );

		wp_enqueue_script( 'credomatic-paycom-gateway-admin', CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL . 'assets/js/wc-credomatic-paycom-gateway-admin.js', array( 'jquery', 'credomatic-paycom-gateway-jquery-validate' ), '1.1.0', true );
	}

	public static function log( $message = '', $data = array() ) {

		global $wp_version;

		if ( empty( static::$logger ) ) {
			static::$logger = new WC_Logger();
		}

		$log_entry  = '[' . __( 'BEGIN OF LOG ENTRY', 'credomatic-paycom' ) . ']' . PHP_EOL;
		$log_entry .= __( 'Client IP address', 'credomatic-paycom' ) . ': ' . WC_Credomatic_PayCOM_Gateway_Utilities::get_client_ip_address() . PHP_EOL;
		$log_entry .= __( 'WooCommerce Version', 'credomatic-paycom' ) . ': ' . WC()->version . PHP_EOL;
		$log_entry .= __( 'WordPress version', 'credomatic-paycom' ) . ': ' . $wp_version . PHP_EOL;
		$log_entry .= __( 'Blog name', 'credomatic-paycom' ) . ': ' . get_bloginfo( 'name' ) . PHP_EOL;
		$log_entry .= __( 'Site URL', 'credomatic-paycom' ) . ': ' . network_site_url( '/' ) . PHP_EOL;
		$log_entry .= __( 'Message', 'credomatic-paycom' ) . ': ' . $message . PHP_EOL;

		if ( is_array( $data ) ) {
			if ( array_key_exists( 'response_code', $data ) && !empty( $data['response_code'] ) ) {
				$log_entry .= __( 'Response code', 'credomatic-paycom' ) . ': ' . $data['response_code'] . PHP_EOL;
				$log_entry .= __( 'Response text', 'credomatic-paycom' ) . ': ' . $data['responsetext'] . PHP_EOL;
				$log_entry .= __( 'Authorization code', 'credomatic-paycom' ) . ': ' . !empty( $data['authcode'] ) ? $data['authcode'] : __( 'Code not present', 'credomatic-paycom' ) . PHP_EOL;
			}
			$log_entry .= __( 'Response detail', 'credomatic-paycom' ) . ': ' . print_r( $data, true ) . PHP_EOL;
		}

		$log_entry .= '[' . __( 'END OF LOG ENTRY', 'credomatic-paycom' ) . ']' . PHP_EOL;

		static::$logger->add( 'credomatic-paycom-gateway', $log_entry );
	}
}

?>
