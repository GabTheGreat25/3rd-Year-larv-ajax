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

// Route::post('register-auth', [
//     'uses' => 'LoginController@register',
//     'as' => 'user.register',
// ]);

// Route::get('register', [
//     'uses' => 'LoginController@getRegister',
// ]);

Route::get('/', function () {
    return view('welcome');
});

Route::post('login-auth', [
    'uses' => 'LoginController@login',
    'as' => 'user.login',
]);

Route::get('login', [
    'uses' => 'LoginController@getLogin',
]);

Route::get('logout',[
    'uses' => 'LoginController@logout',
    'as' => 'logout',
]);

Route::resource('admin', 'adminController');
route::view('/admin-index', 'admin.index');
route::view('/admin-register', 'admin.register');

Route::resource('operator', 'operatorController');
route::view('/operator-index', 'operator.index');
route::view('/operator-register', 'operator.register');

Route::resource('investor', 'investorController');
route::view('/investor-index', 'investor.index');
route::view('/investor-register', 'investor.register');

Route::resource('client', 'clientController');
route::view('/client-index', 'client.index');
route::view('/client-register', 'client.register');

Route::resource('service', 'serviceController');
route::view('/service-index', 'service.index');

Route::resource('camera', 'cameraController');
route::view('/camera-index', 'camera.index');

Route::resource('accessories', 'accessoriesController');
route::view('/accessories-index', 'accessories.index');






