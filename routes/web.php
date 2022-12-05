<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

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

Route::resource('operator', 'operatorController');
route::view('/operator-index', 'operator.index')->name('operator');

Route::resource('accessories', 'accessoriesController');
route::view('/accessories-index', 'accessories.index');

Route::resource('camera', 'cameraController');
route::view('/camera-index', 'camera.index');

Route::resource('service', 'serviceController');
route::view('/service-index', 'service.index');

Route::resource('investor', 'investorController');
route::view('/investor-index', 'investor.index');