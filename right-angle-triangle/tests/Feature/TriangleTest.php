<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestComplete;

class TriangleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
    public function testMyTest() {
    	$response = $this->post('/', [
    		'a' => 5,
		    'b' => 6,
		    'c' => 10, // This will get overridden
		    'theta' => 0 // This will get overridden
	    ]);

    	Notification::route('mail', 'fake_email@lendtech.com')
	                                            ->notify(new TestComplete());

	    $response->assertStatus(200);
    }
}
