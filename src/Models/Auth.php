<?php

namespace deedee2025\PlaceToPay\Models;

class Auth {
	private $login;
	private $tranKey;
	private $seed;
	private $additional;
	private $hash;

	public function __construct( $login, $tranKey, $additional = null ) {
		$this->login      = $login;
		$this->tranKey    = $tranKey;
		$this->additional = $additional;
		$this->seed       = date( 'c' );
		$this->hash       = sha1( $this->seed . $this->tranKey, false );
	}
}