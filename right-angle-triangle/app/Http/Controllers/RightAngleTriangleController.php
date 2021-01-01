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
			                                 'a' => ['required', 'numeric', 'regex:/\A[+-]?\d+(?:\.\d{1,2})?\z/'],
			                                 'b' => ['required', 'numeric', 'regex:/\A[+-]?\d+(?:\.\d{1,2})?\z/'],
			                                 'c' => ['required', 'numeric', 'regex:/\A[+-]?\d+(?:\.\d{1,2})?\z/', 'gt:a', 'gt:b'],
			                                 'theta' => ['required', 'numeric', 'regex:/\A[+-]?\d+(?:\.\d{1,2})?\z/', 'max:89.99'],
		                                 ] );

		$lastTriangle = Triangle::all()->last();

		// Create a new Triangle object with the user input values.
		$triangle = new Triangle;
		$triangle->a = $request->input('a');
		$triangle->b = $request->input('b');
		$triangle->c = $request->input('c');
		$triangle->theta = $request->input('theta');

		// Based on which inputs the user changed, detect which values need to be solved for.
		$triangle = $this->setTriangleAttributeChanges( $lastTriangle, $triangle );

		// echo '<pre>';
		// print_r($triangle);
		// echo '</pre>';
		// die();

		$triangle = $this->solveTriangle( $triangle );

		$triangle->save();

		// TODO: check if there's a way to avoid making this query again in this function... not sure if fresh() will load new instances
		$data['triangles'] = Triangle::all();

		$lastTriangle = $data['triangles']->last();

		if(!empty($lastTriangle)) {
			$data['a'] = $lastTriangle['a'];
			$data['b'] = $lastTriangle['b'];
			$data['c'] = $lastTriangle['c'];
			$data['theta'] = $lastTriangle['theta'];
		}

		return view( 'triangle', $data);

	}

	private function setTriangleAttributeChanges( Triangle $previous, Triangle $current ) {
		$toReturn = new Triangle();

		// If this is the first Triangle being entered, then accept all parameters
		if( empty( $previous->a ) && empty( $previous->b ) && empty( $previous->c ) && empty( $previous->theta ) ) {
			$toReturn = $current;
		} else {

			// TODO: This isn't very elegant... must be a better way
			if( $previous->theta !== $current->theta ) {
				$toReturn->theta = $current->theta;
				$toReturn->b = $previous->b;
			} elseif( ($previous->a !== $current->a) && ($previous->b !== $current->b) ) {
				$toReturn->a = $current->a;
				$toReturn->b = $current->b;
			} elseif( ($previous->a !== $current->a) && ($previous->c !== $current->c) ) {
				$toReturn->a = $current->a;
				$toReturn->c = $current->c;
			} elseif( ($previous->b !== $current->b) && ($previous->c !== $current->c) ) {
				$toReturn->b = $current->b;
				$toReturn->c = $current->c;
			} elseif( $previous->a !== $current->a ) {
				$toReturn->a = $current->a;
				$toReturn->b = $previous->b;
				$toReturn->c = $previous->c;
			} elseif( $previous->b !== $current->b ) {
				$toReturn->b = $current->b;
				$toReturn->a = $previous->a;
				$toReturn->c = $previous->c;
			} elseif( $previous->c !== $current->c ) {
				$toReturn->c = $current->c;
				$toReturn->a = $previous->a;
				$toReturn->b = $previous->b;
			}

		}

		return $toReturn;
	}

	private function solveTriangle( Triangle $triangle ) {

		if( !empty( $triangle->theta ) ) {
			$triangle = $this->solveTriangleUsingTheta( $triangle );
		} else {
			$triangle = $this->solveTriangleUsingTwoSides( $triangle );
		}

		return $triangle;
	}

	private function solveTriangleUsingTwoSides( Triangle $triangle ) {

		// Solve for the sides of the triangle. If a faulty value was provided for "c" it will be overwritten here.
		if( !empty( $triangle->a ) && !empty( $triangle->b ) ) {
			$triangle->c = round( hypot( (float) $triangle->a, (float) $triangle->b ), 2 );
		} elseif( !empty($triangle->a) && !empty($triangle->c ) ) {
			$triangle->b = round( sqrt( (float) ($triangle->c * $triangle->c) - (float) ( $triangle->a * $triangle->a ) ), 2 );
		} elseif( !empty( $triangle->b ) && !empty($triangle->c) ) {
			$triangle->a = round( sqrt( (float) ($triangle->c * $triangle->c) - (float) ( $triangle->b * $triangle->b ) ), 2 );
		}

		// Since we have all three sides of the triangle now we can solve for theta.
		if( empty( $triangle->theta ) ) {
			$triangle->theta = round( rad2deg( asin($triangle->a / $triangle->c ) ), 2 );
		}

		return $triangle;
	}

	private function solveTriangleUsingTheta( Triangle $triangle ) {

		if( !empty( $triangle->a ) ) {
			$triangle->c = round( $triangle->a / sin( (float) deg2rad( $triangle->theta ) ), 2 );
		} elseif( !empty( $triangle->b ) ) {
			$triangle->c = round( $triangle->b / cos( (float) deg2rad( $triangle->theta ) ), 2 );
		} elseif( !empty( $triangle->c ) ) {
			$triangle->a = round( $triangle->c * sin( (float) deg2rad( $triangle->theta ) ), 2 );
		}

		$triangle = $this->solveTriangleUsingTwoSides( $triangle );

		return $triangle;
	}
}
