<?php


use Rakit\Validation\Validator;

class OrderController {

	/**
	 * @throws ErrorException
	 */
	public function home() {
		$orders = new Order();
		$orders = $orders->all();

		view( 'pages.home', compact( 'orders' ) );
	}

	/**
	 * @throws ErrorException
	 */
	public function contact() {
		view( 'pages.contact-us' );
	}


	/**
	 *  Storing Data
	 */
	public function store() {

		$data       = Request::inputs();
		$validator  = new Validator;
		$validation = $validator->make( $data, [
			'amount'      => 'required|numeric|max:10',
			'buyer'       => 'required|max:255',
			'receipt_id'  => 'required|max:20',
			'items'       => 'required|max:255',
			'buyer_email' => 'required|email',
			'note'        => 'required|max:255',
			'city'        => 'required|max:20',
			'phone'       => 'required|max:20',
			'entry_by'    => 'required|numeric|max:10'
		] );
		// validate
		$validation->validate();
		if ( $validation->fails() ) {
			$errors = $validation->errors();;

			return responseJson( [ 'data' => $errors->firstOfAll() ] );
		}

		$order = new Order();
		$order->insert( array_merge( $data, [
			'hash_key' => hash( 'sha512', $data['receipt_id'] ),
			'buyer_ip' => Request::ip(),
			'entry_at' => date( 'Y-m-d' ),
		] ) );

		return responseJson( [ 'data' => 'ok', '' ] );

	}


	/**
	 * Fetching Data
	 */
	public function get() {
		$order = new Order();

		return responseJson( $order->all() );
	}

	public function getByDate() {
		$data       = Request::inputs();
		$validator  = new Validator;
		$validation = $validator->make( $data, [
			'from' => 'required|date',
			'to'   => 'required|date',
		] );
		// validate
		$validation->validate();
		if ( $validation->fails() ) {
			$errors = $validation->errors();;

			return responseJson( [ 'data' => $errors->firstOfAll() ] );
		}
		$order = new Order();

		return responseJson( $order->whereDate( 'entry_at', $data['from'], $data['to'] )->get() );
	}

	public function getByReciptId() {
		$data       = Request::inputs();
		$validator  = new Validator;
		$validation = $validator->make( $data, [
			'id' => 'required|numeric',
		] );
		// validate
		$validation->validate();
		if ( $validation->fails() ) {
			$errors = $validation->errors();;

			return responseJson( [ 'data' => $errors->firstOfAll() ] );
		}
		$order = new Order();

		return responseJson( $order->where( 'receipt_id', '=', $data['id'] )->get() );

	}
}