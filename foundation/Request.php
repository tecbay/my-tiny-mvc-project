<?php


class Request {

	protected static $REQUEST_URI;
	protected static $REQUEST_METHOD;
	protected static $IP;
	protected static $GET_DATA;
	protected static $POST_DATA;

	public function __construct() {
		self::$REQUEST_URI    = $_SERVER['REQUEST_URI'];
		self::$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
		self::$IP      = $_SERVER['REMOTE_ADDR'];
		self::$GET_DATA       = $_GET;
		self::$POST_DATA      = $_POST;
	}

	public function process() {

		Router::direct(
			parse_url( self::$REQUEST_URI, PHP_URL_PATH ),
			self::$REQUEST_METHOD );
	}

	public static function ip() {
		return self::$IP;
	}
	
	public static function inputs():array {
		if ( 'POST' == self::$REQUEST_METHOD ) {
			return self::$POST_DATA;
		}

		return self::$GET_DATA;
	}
}