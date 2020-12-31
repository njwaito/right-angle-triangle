<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

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

		$data['a'] = $request->input('a');
		$data['b'] = $request->input('b');
		$data['c'] = hypot( (int) $data['a'], (int) $data['b'] );
		$data['theta'] = rad2deg( asin($data['a'] / $data['c'] ) );

		return view( 'triangle', $data);

	}
}
