<?php

namespace deedee2025\PlaceToPay\Models;

class Authentication {
	private $login;
	private $tranKey;
	private $seed;
	private $additional;

	public function __construct( $login, $tranKey, $additional = null ) {
		$this->login      = $login;
		$this->seed       = date( 'c' );
		$this->tranKey    = sha1( $this->seed . $tranKey, false );
		$this->additional = $additional;
	}
}