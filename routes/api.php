<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
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

// Route::post('login', [LoginController::class, 'login']);
Route::post('login-auth', [
    'uses' => 'LoginController@login',
    'as' => 'user.login',
]);

Route::post('register-auth', [
    'uses' => 'LoginController@register',
    'as' => 'user.register',
]);

Route::get('login', [
    'uses' => 'LoginController@getLogin',
]);

Route::get('register', [
    'uses' => 'LoginController@getRegister',
]);

Route::get('logout',[
    'uses' => 'LoginController@logout',
]);

route::view('/admin-index', 'admin.index');
route::view('/admin-register', 'admin.register');
Route::get('/admin/all',['uses' => 'adminController@getadminAll','as' => 'admin.getadminall'] );
Route::resource('admin', 'adminController');
Route::post('admin/post/{id}','adminController@update');
Route::patch('/admin/restore/{id}', 'adminController@restore');

// Route::middleware('auth:api')->group(function () {
    route::view('/accessories-index', 'accessories.index');
    route::view('/camera-index', 'camera.index');
    route::view('/operator-index', 'operator.index');
    route::view('/service-index', 'service.index');


    route::view('/investor-index', 'investor.index');
Route::get('/investor/all',['uses' => 'investorController@getinvestorAll','as' => 'investor.getinvestorall'] );
Route::resource('investor', 'investorController');
Route::post('investor/post/{id}','investorController@update');


    Route::get('/accessories/all',['uses' => 'accessoriesController@getaccessoriesAll','as' => 'accessories.getaccessoriesall'] );
    Route::get('/camera/all',['uses' => 'cameraController@getcameraAll','as' => 'camera.getcameraall'] );

    Route::get('/operator/all',['uses' => 'operatorController@getoperator','as' => 'operator.getoperatorall'] );
    Route::get('/service/all',['uses' => 'serviceController@getserviceAll','as' => 'service.getserviceall'] );


    Route::resource('operator', 'operatorController');
    Route::post('operator/post/{id}','operatorController@update');


    Route::resource('accessories', 'accessoriesController');
    Route::post('accessories/post/{id}','accessoriesController@update');    

    Route::resource('camera', 'cameraController');
    Route::post('camera/post/{id}','cameraController@update');


    Route::resource('service', 'serviceController');
    Route::post('service/post/{id}','serviceController@update');
// });





// dito lalagay lang resource tapos yung all para lang makita yung mga data mo in json format tapos itong post para maoverride fucking update na bulok HAHAHAHA


