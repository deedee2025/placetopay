<?php

namespace deedee2025\PlaceToPay;

use deedee2025\PlaceToPay\Models\Authentication;
use deedee2025\PlaceToPay\Models\PSETransactionRequest;
use deedee2025\PlaceToPay\Models\Forms;
use SoapClient;

class PlaceToPay {
	private static $auth;
	private static $wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';

	public static function authenticate( $login, $tranKey, $additional = null ) {
		self::$auth = new Authentication( $login, $tranKey, $additional );
	}

	public static function getBankList() {
		$client   = new SoapClient( self::$wsdl );
		$response = $client->__soapCall( 'getBankList', array( [ 'auth' => self::$auth ] ) );

		return $response->getBankListResult->item;
	}

	public static function createTransaction( PSETransactionRequest $request, $saveOnSession = false, $sessionVar = 'PSEtransactions' ) {
		$client   = new SoapClient( self::$wsdl );
		$response = $client->__soapCall( 'createTransaction', array(
			[
				'auth'        => self::$auth,
				'transaction' => $request,
			]
		) );
		if ( $saveOnSession ) {
			if ( ! self::isSessionStarted() ) {
				session_start();
			}
			$transactionIds          = empty( $_SESSION[ $sessionVar ] ) ? [] : $_SESSION[ $sessionVar ];
			$transObj                = new \stdClass();
			$transObj->transactionID = $response->createTransactionResult->transactionID;
			$transObj->returnCode    = $response->createTransactionResult->returnCode;
			$transactionIds[]        = $transObj;
			$_SESSION[ $sessionVar ] = $transactionIds;
		}

		return $response->createTransactionResult;
	}

	public static function getTransactionInformation( $transactionID ) {
		$client   = new SoapClient( self::$wsdl );
		$response = $client->__soapCall( 'getTransactionInformation', array(
			[
				'auth'          => self::$auth,
				'transactionID' => $transactionID,
			]
		) );

		return $response->getTransactionInformationResult;
	}

	public static function getStoredTransactionsInfo( $sessionVar = 'PSEtransactions' ) {
		if ( ! self::isSessionStarted() ) {
			session_start();
		}

		$result = [];
		if ( ! empty( $_SESSION[ $sessionVar ] ) ) {
			foreach ( $_SESSION[ $sessionVar ] as $transId ) {
				$response                          = PlaceToPay::getTransactionInformation( $transId->transactionID );
				$result[ $transId->transactionID ] = $response;
			}
		}

		return $result;
	}

	public static function printRequestForm( $url ) {
		$banks = self::getBankList();
		Forms::PSETansactionRequestForm( $banks, $url );
	}

	protected static function isSessionStarted() {
		if ( php_sapi_name() !== 'cli' ) {
			if ( version_compare( phpversion(), '5.4.0', '>=' ) ) {
				return session_status() === PHP_SESSION_ACTIVE ? true : false;
			} else {
				return session_id() === '' ? false : true;
			}
		}

		return false;
	}
}