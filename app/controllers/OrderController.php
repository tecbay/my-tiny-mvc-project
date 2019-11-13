<?php


use Rakit\Validation\Validator;

class OrderController {

	public function home() {
		$data = Request::inputs();

		view( 'pages.home', [ 'asd' => $asd ] );
	}

	public function contact() {
		view( 'pages.contact-us' );
	}


	public function show() {

	}

	public function store() {

		$data       = Request::inputs();
		$validator  = new Validator;
		$validation = $validator->make( $data, [
			'name'                => 'required',
			'email'               => 'required|email',
			'password'            => 'required|min:6',
			'confirm_password'    => 'required|same:password',
			'avatar'              => 'required|uploaded_file:0,500K,png,jpeg',
			'skills'              => 'array',
			'skills.*.id'         => 'required|numeric',
			'skills.*.percentage' => 'required|numeric'
		] );
// then validate
		$validation->validate();

		if ( $validation->fails() ) {
			// handling errors
			$errors = $validation->errors();
			echo "<pre>";
			print_r( $errors->firstOfAll() );
			echo "</pre>";
			exit;
		} else {
			// validation passes
			echo "Success!";
		}

		view( 'pages.home' );
	}


	public function get() {
		$data = Request::inputs();

		view( 'pages.home', [ 'asd' => $asd ] );
	}
}