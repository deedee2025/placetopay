<?php

namespace deedee2025;

use deedee2025\PlaceToPay\Models\Auth;
use deedee2025\PlaceToPay\Models\PSETransactionRequest;
use SoapClient;

class PlaceToPay {
	private static $auth;
	private static $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';

	public static function authenticate( $login, $tranKey, $additional = null ) {
		self::$auth = new Auth( $login, $tranKey, $additional );
	}

	public static function createTransaction( PSETransactionRequest $request ) {
		$client   = new SoapClient( self::$wsdl );
		$response = $client->__soapCall( 'createTransaction', [
			'auth' => self::$auth,
			'transaction' => $request,
		] );
		var_dump($response);
	}
}