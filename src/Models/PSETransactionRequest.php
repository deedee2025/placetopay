<?php

namespace deedee2025\PlaceToPay\Models;

use deedee2025\PlaceToPay\Models\Person;

class PSETransactionRequest {
	private $bankCode;
	private $bankInterface;
	private $returnURL;
	private $reference;
	private $description;
	private $language;
	private $currency;
	private $totalAmount;
	private $taxAmount;
	private $devolutionBase;
	private $tipAmount;
	private $payer;
	private $buyer;
	private $shipping;
	private $ipAddress;
	private $userAgent;
	private $additionalData;

	public function __construct( $params ) {
		if ( is_array( $params ) ) {

			$this->bankCode       = $params['bankCode'];
			$this->bankInterface  = $params['bankInterface'];
			$this->returnURL      = $params['returnURL'];
			$this->reference      = $params['reference'];
			$this->description    = $params['description'];
			$this->language       = $params['language'];
			$this->currency       = $params['currency'];
			$this->totalAmount    = $params['totalAmount'];
			$this->taxAmount      = $params['taxAmount'];
			$this->devolutionBase = $params['devolutionBase'];
			$this->tipAmount      = $params['tipAmount'];
			$this->payer          = $params['payer'] instanceof Person ? $params['payer'] : new Person( $params['payer'] );
			$this->buyer          = $params['buyer'] instanceof Person ? $params['buyer'] : new Person( $params['buyer'] );
			$this->shipping       = $params['shipping'] instanceof Person ? $params['shipping'] : new Person( $params['shipping'] );
			$this->additionalData = $params['additionalData'];
			$this->ipAddress      = $params['ipAddress'];
			$this->userAgent      = $params['userAgent'];

			// Validate mandatory fields
			foreach ( get_object_vars( $this ) as $key => $attribute ) {
				if ( ! isset( $attribute ) && $key != 'additionalData' ) {
					throw ( new \Exception( "$key is not defined" ) );
				}
			}
		} else {
			throw ( new \Exception( "Invalid params" ) );
		}
	}
}