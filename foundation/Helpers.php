<?php


function config( string $settingName ) {
	$allConfig = require __DIR__ . '/../config.php';

	return $allConfig[ $settingName ];
}

function dd( $data ) {
//	echo "<pre>";
	var_dump( $data );
//	echo "<pre>";
	die();
}


function view( $view, $data = [] ) {

	$path = __DIR__ . '/../app/views/' . str_replace( '.', '/', $view ) . '.view.php';

	if ( ! file_exists( $path ) ) {
		throw new ErrorException( 'View "' . $view . '"" Not Found' );
	}
	extract( $data );
	require $path;
}


function insert( $view ) {

	$path = __DIR__ . '/../app/views/' . str_replace( '.', '/', $view ) . '.view.php';

	if ( ! file_exists( $path ) ) {
		throw new ErrorException( 'View "' . $view . '"" Not Found' );
	}
	require $path;
}

function responseJson( array $data ) {
	header( 'Content-Type: application/json' );
	echo json_encode( $data );
}

function redirect( $path ) {
	header( "Location: /{$path}" );
}