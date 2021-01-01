<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\RightAngleTriangleController;
use App\Notifications\TestComplete;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get( '/mail', function() {
	Notification::route('mail', 'fake_email@lendtech.com')
		->notify(new TestComplete());
	return new App\Mail\ReportLog();
});
Route::get( '/', [ RightAngleTriangleController::class, 'show' ] );
Route::post( '/', [ RightAngleTriangleController::class, 'store' ] );
