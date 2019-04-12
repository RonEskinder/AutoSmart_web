<?php
/*
Plugin Name: WooCommerce Credomatic PayCOM Payment Gateway
Description: Take credit card payments safely and securily direct on your checkout
Version: 1.1.0
Author: BAC Credomatic Nicaragua
Author URI: https://www.baccredomatic.com/es-ni
Text Domain: credomatic-paycom
Domain Path: /languages/
*/

defined( 'ABSPATH' ) || exit;

defined( 'CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_NAME' ) || define( 'CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_NAME', basename( dirname( __FILE__ ) ) );
defined( 'CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL' ) || define( 'CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_URL', plugins_url() . '/' . CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_NAME . '/' );
defined( 'CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH' ) || define( 'CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
defined( 'CREDOMATIC_PAYCOM_GATEWAY_URL' ) || define( 'CREDOMATIC_PAYCOM_GATEWAY_URL', 'https://paycom.credomatic.com/PayComBackEndWeb/common/requestPaycomService.go' );

require_once CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH . 'includes/class-wc-credomatic-paycom-gateway-installer.php';
require_once CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH . 'includes/class-wc-credomatic-paycom-gateway-credit-card-helper.php';
require_once CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH . 'includes/class-wc-credomatic-paycom-gateway-encryption-helper.php';
require_once CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH . 'includes/class-wc-credomatic-paycom-gateway-utilities.php';

function activate_wc_credomatic_paycom_gateway() {
	WC_Credomatic_PayCOM_Gateway_Installer::activate();
}

register_activation_hook( __FILE__, 'activate_wc_credomatic_paycom_gateway' );

add_action( 'plugins_loaded', 'wc_credomatic_paycom_gateway_init', 0 );

function wc_credomatic_paycom_gateway_init() {

	load_plugin_textdomain( 'credomatic-paycom', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	require_once CREDOMATIC_PAYCOM_GATEWAY_PLUGIN_DIR_PATH . 'includes/class-wc-credomatic-paycom-gateway-core.php';

	function add_wc_credomatic_paycom_gateway( $methods ) {
		$methods[] = 'WC_Credomatic_PayCOM_Gateway';
		return $methods;
	}

	add_filter( 'woocommerce_payment_gateways', 'add_wc_credomatic_paycom_gateway' );

}

?>
