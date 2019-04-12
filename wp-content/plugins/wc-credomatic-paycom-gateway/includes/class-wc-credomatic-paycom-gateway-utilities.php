<?php

defined( 'ABSPATH' ) || exit();

final class WC_Credomatic_PayCOM_Gateway_Utilities {

	public static function check_transaction_authenticity( $response = array(), $key = '' ) {
		$hash = md5( implode( '|', array(
					$response['orderid'],
					$response['amount'],
					$response['response'],
					$response['transactionid'],
					$response['avsresponse'],
					$response['cvvresponse'],
					$response['time'],
					$key,
				) ) );
		return strcmp( $hash, $response['hash'] ) === 0;
	}

	public static function process_raw_response( $raw_response ) {
		$location = wp_remote_retrieve_header( $raw_response, 'location' );
		parse_str( $location, $output );
		if ( array_key_exists( 'response_code', $output ) && !empty( $output['response_code'] ) ) {
			$response_code = $output['response_code'];
			if ( $response_code == '100' ) {
				$output['response'] = 1;
			}elseif ( $response_code >= '200' && $response_code < '300' ) {
				$output['response'] = 2;
			}elseif ( $response_code >= '300' ) {
				$output['response'] = 3;
			}
			return static::filter_response( $output );
		}
		return false;
	}

	private static function filter_response( $response = array() ) {
		$keys_allowed = array(
			'response',
			'responsetext',
			'authcode',
			'transactionid',
			'avsresponse',
			'cvvresponse',
			'orderid',
			'type',
			'response_code',
			'username',
			'time',
			'amount',
			'purshamount',
			'hash',
		);
		return array_intersect_key( $response, array_flip( $keys_allowed ) );
	}

	public static function get_client_ip_address() {
		$ip_address = '';
		if ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$ip_address = getenv( 'HTTP_CLIENT_IP' );
		}elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$ip_address = getenv( 'HTTP_X_FORWARDED_FOR' );
		}elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
			$ip_address = getenv( 'HTTP_X_FORWARDED' );
		}elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
			$ip_address = getenv( 'HTTP_FORWARDED_FOR' );
		}elseif ( getenv( 'HTTP_FORWARDED' ) ) {
			$ip_address = getenv( 'HTTP_FORWARDED' );
		}elseif ( getenv( 'REMOTE_ADDR' ) ) {
			$ip_address = getenv( 'REMOTE_ADDR' );
		}else {
			$ip_address = 'UNKNOWN';
		}
		return $ip_address;
	}

}
