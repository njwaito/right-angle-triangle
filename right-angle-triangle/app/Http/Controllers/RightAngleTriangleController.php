<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RightAngleTriangleController extends Controller {

	public function show() {

		return view( 'triangle' );

	}

	public function store( Request $request ) {

		$validated = $request->validate( [
			                                 'a' => 'required|numeric',
			                                 'b' => 'required|numeric',
			                                 'c' => 'required|numeric',
			                                 'theta' => 'required|numeric',
		                                 ] );

	}
}
