<?php

defined( 'ABSPATH' ) || exit();

final class WC_Credomatic_PayCOM_Gateway_Encryption_Helper {

	public static function encrypt( $public_key_file_path, $merchant_key_to_encrypt ) {

		$public_key_file = fopen( $public_key_file_path, 'r' );
		$public_key = fread( $public_key_file, 8192 );
		fclose( $public_key_file );

		openssl_get_publickey( $public_key );
		openssl_public_encrypt( $merchant_key_to_encrypt, $merchant_key_encrypted_non_base64, $public_key );

		return base64_encode( $merchant_key_encrypted_non_base64 );
	}

	public static function decrypt( $key_file_path, $merchant_key_to_decrypt ) {

		$private_key_file = fopen( $key_file_path, "r" );
		$private_key    = fread( $private_key_file, 8192 );

		openssl_get_privatekey( $private_key );
		$merchant_key_on_binary_format = base64_decode( $merchant_key_to_decrypt );
		openssl_private_decrypt( $merchant_key_on_binary_format, $merchant_key_decrypted, $private_key );

		return $merchant_key_decrypted;
	}
}

?>
