<?php

use App\Http\Controllers\AssociationFormController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\DooMailController;
use App\Http\Controllers\EntrepreneurMailController;
use App\Http\Controllers\EntrepreneurFormController;
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
Route::post('/entrepreneur-mail', [ EntrepreneurMailController::class , 'store']);
Route::post('/doo-mail', [ DooMailController::class , 'store']);
Route::post('/get-form-data', [ EntrepreneurFormController::class , 'index']);
Route::get('/association-form-data', [ AssociationFormController::class , 'index']);
