<?php


class Router {

	public static $routes = [
		'GET'  => [],
		'POST' => []
	];


	public static function get( string $url, string $controller ) {

		self::$routes['GET'][ trim( $url, '/' ) ] = $controller;
	}


	public static function post( string $url, string $controller ) {
		self::$routes['POST'][ trim( $url, '/' ) ] = $controller;
	}

	public static function direct( string $url, string $method ) {
		if ( array_key_exists( trim( $url, '/' ), self::$routes[ $method ] ) ):
			$controller = explode( '@', self::$routes[ $method ][ trim( $url, '/' ) ] );;
			$class         = $controller[0];
			$classMethod   = $controller[1];
			$controllerObj = ( new $class );

			if ( ! method_exists( $controllerObj, $classMethod ) ) {
				throw new Exception(
					"{$controller} does not respond to the {$classMethod} action."
				);
			}
			$controllerObj->$classMethod();
		endif;
	}
}