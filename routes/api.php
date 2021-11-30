<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\PriceListMailController;
use App\Http\Controllers\PriceListFormController;
use App\Http\Controllers\ReCaptchaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/mail', [ ContactMailController::class, 'store']);
Route::post('/entrepreneur-mail', [ PriceListMailController::class , 'store']);
//
Route::post('/get-form-data', [ PriceListFormController::class , 'index']);
Route::post('/recaptcha/validate', [ ReCaptchaController::class , 'index']);
//

// Route::post('login', [AuthController::class, 'authenticate']);
// Route::post('register', [AuthController::class, 'register']);

// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::get('get_user', [AuthController::class, 'get_user']);
// });
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


