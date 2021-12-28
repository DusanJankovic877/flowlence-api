<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
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
Route::post('/save-post-image', [ ImageController::class , 'store']);
Route::get('/get-image/{filename}', [ ImageController::class , 'show']);
Route::post('/save-edited-images', [ ImageController::class , 'update']);
Route::post('/save-edited-post', [ PostController::class , 'update']);
Route::get('/get-posts', [ PostController::class , 'index']);
Route::get('/get-posts/{id}', [ PostController::class , 'show']);
Route::get('/edit-posts/{id}', [ PostController::class , 'edit']);

Route::post('/create-post', [ PostController::class , 'store']);
// Route::get('image/{filename}',PostController::class 'show');
//

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

});


