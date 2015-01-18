<?php

/*** Custom Exception Classes for Error Handling ***/

class DefaultNetworkNotFoundException extends Exception {

	public function __construct($message, $code = 404)
	{
		parent::__construct($message ? : "Resource Not Found", $code);
	}
}

class WhmcsApiErrorException extends Exception {

	public function __construct($message, $code = 401)
	{
		parent::__construct($message ? : "Failed to complete WHMCS API", $code);
	}
}