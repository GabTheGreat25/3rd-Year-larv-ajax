<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



route::view('/operator-index', 'operator.index');
route::view('/service-index', 'service.index');

Route::get('/operator/all',['uses' => 'operatorController@getoperatorAll','as' => 'operator.getoperatorall'] );

Route::resource('operator', 'operatorController');
Route::post('operator/post/{id}','operatorController@update');

Route::get('/service/all',['uses' => 'serviceController@getserviceAll','as' => 'service.getserviceall'] );

Route::resource('service', 'serviceController');
Route::post('service/post/{id}','serviceController@update');

// dito lalagay lang resource tapos yung all para lang makita yung mga data mo in json format tapos itong post para maoverride fucking update na bulok HAHAHAHA


