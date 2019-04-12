<?php

defined( 'ABSPATH' ) || exit;

final class WC_Credomatic_PayCOM_Gateway_Installer {

	public static function activate() {

		global $wp_version;

		$plugin = 'wc-credomatic-paycom-gateway/wc-credomatic-paycom-gateway.php';
		$check_woocommerce = 'woocommerce/woocommerce.php';

		$required_php_version = '5.6.20';
		$required_wordpress_version = '4.5.3';
		$required_woocommerce_version = '2.6.1';

		$current_php_version = phpversion();
		$current_wordpress_version = $wp_version;

		if ( version_compare( $current_php_version, $required_php_version, '<' ) ) {
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
			}
			wp_die( static::build_error_message( 'PHP', $required_php_version, false ) );
		}

		if ( version_compare( $current_wordpress_version, $required_wordpress_version, '<' ) ) {
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
			}
			wp_die( static::build_error_message( 'WordPress', $required_wordpress_version, false ) );
		}

		if ( !in_array( $check_woocommerce, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
			}
			wp_die( static::build_error_message( 'WooCommerce', '', true ) );
		}

		$current_woocommerce_version = WC()->version;

		if ( version_compare( $current_woocommerce_version, $required_woocommerce_version, '<' ) ) {
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
			}
			wp_die( static::build_error_message( 'WooCommerce', $required_woocommerce_version, false ) );
		}
	}

	private static function build_error_message( $component, $required_version, $required_activation ) {

		$plugins_page_url = get_admin_url( null, 'plugins.php' );
		$return_link = '<a class="button button-large" href="' . $plugins_page_url . '">Go Back</a>';
		$opening_tag = '<div><p>';
		$closing_tag = '</p></div>';

		if ( $required_activation ) {
			$error_message = 'This plugin require <strong>' . esc_html( $component ) . '</strong> plugin activation.';
		}else {
			$error_message = 'This plugin require at least <strong>' . esc_html( $component ) . ' version ' . esc_html( $required_version ) . '</strong>';
		}

		return $opening_tag . $error_message . $closing_tag . $return_link;

	}

}
?>
