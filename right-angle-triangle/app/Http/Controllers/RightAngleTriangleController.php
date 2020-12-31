<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triangle;

class RightAngleTriangleController extends Controller {

	public function show() {

		$data['triangles'] = Triangle::all();

		$lastTriangle = $data['triangles']->last();

		if(!empty($lastTriangle)) {
			$data['a'] = $lastTriangle['a'];
			$data['b'] = $lastTriangle['b'];
			$data['c'] = $lastTriangle['c'];
			$data['theta'] = $lastTriangle['theta'];
		}

		return view( 'triangle', $data );

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

		$triangle = new Triangle;

		$triangle->a = $data['a'];
		$triangle->b = $data['b'];
		$triangle->c = $data['c'];
		$triangle->theta = $data['theta'];

		$triangle->save();

		return view( 'triangle', $data);

	}
}
