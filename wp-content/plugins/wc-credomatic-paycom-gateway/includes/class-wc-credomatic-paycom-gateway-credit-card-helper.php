<?php

defined( 'ABSPATH' ) || exit;

final class WC_Credomatic_PayCOM_Gateway_Credit_Card_Helper {

	public static function validate_card_number( $card_number='' ) {
		$number = static::format_card_number( $card_number );
		$number_length = strlen( $number );
		$parity = $number_length % 2;
		$total = 0;
		for ( $i = 0; $i < $number_length; $i++ ) {
			$digit = $number[$i];
			if ( $i % 2 == $parity ) {
				$digit*=2;
				if ( $digit>9 ) {
					$digit-=9;
				}
			}
			$total+=$digit;
		}
		return $total % 10 == 0;
	}

	public static function validate_cvc( $cvc='' ) {
		return preg_match( '/^[0-9]{3,4}$/', $cvc );
	}

	public static function validate_card_expiry( $card_expiry='' ) {
		$card_expiry = preg_replace( '/\s+/', '', $card_expiry );
		$parts = explode( '/', $card_expiry );
		$expiry_month = $parts[0];
		$expiry_year = $parts[1];
		if ( preg_match( '/^\d{2}\/\d{2}$/', $card_expiry ) ) {
			$expiry_year = '20' . $expiry_year;
		}
		if ( $expiry_year < date( 'Y' ) ) {
			return false;
		}elseif ( $expiry_month < date( 'm' ) && $expiry_year == date( 'Y' ) ) {
			return false;
		}
		return true;
	}

	public static function validate_card_holder( $cardholder='' ) {
		$cardholder = preg_replace( '/\s+/', '', $cardholder );
		if ( ctype_alpha( $cardholder ) ) {
			return true;
		}else {
			return false;
		}
	}

	public static function format_card_number( $card_number='' ) {
		return preg_replace( '/\D/', '', $card_number );
	}

	public static function format_cvc( $cvc='' ) {
		return preg_replace( '/\D/', '', $cvc );
	}

	public static function format_card_expiry( $card_expiry='' ) {
		$card_expiry = preg_replace( '/\s+/', '', $card_expiry );
		$parts = explode( '/', $card_expiry );
		if ( preg_match( '/^\d{2}\/\d{4}$/', $card_expiry ) ) {
			$ccexp = $parts[0] . substr( $parts[1], -2 );
		}else if ( preg_match( '/^\d{2}\/\d{2}$/', $card_expiry ) ) {
				$ccexp = $parts[0] . $parts[1];
			}
		return $ccexp;
	}

	public static function format_card_holder( $cardholder='' ) {
		return strtoupper( $cardholder );
	}

	public static function get_last_4_digits( $card_number ) {
		return substr( $card_number, -4 );
	}

}

?>
