<?php

namespace deedee2025\PlaceToPay\Models;

class Person {
	protected $document;
	protected $documentType;
	protected $firstName;
	protected $lastName;
	protected $company;
	protected $emailAddress;
	protected $city;
	protected $province;
	protected $phone;
	protected $country;
	protected $mobile;

	public function __construct( $params ) {
		if ( is_array( $params ) ) {
			$this->document     = $params['document'];
			$this->documentType = $params['documentType'];
			$this->firstName    = $params['firstName'];
			$this->lastName     = $params['lastName'];
			$this->company      = $params['company'];
			$this->emailAddress = $params['emailAddress'];
			$this->city         = $params['city'];
			$this->province     = $params['province'];
			$this->phone        = $params['phone'];
			$this->country      = $params['country'];
			$this->mobile       = $params['mobile'];

			// Validate mandatory fields
			foreach ( get_object_vars( $this ) as $key => $attribute ) {
				if ( !isset( $attribute ) ) {
					throw ( new \Exception( "$key is not defined" ) );
				}
			}
		} else {
			throw ( new \Exception( "Invalid params" ) );
		}
	}
}