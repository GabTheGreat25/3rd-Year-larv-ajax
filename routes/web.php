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

Route::redirect('/', 'login');

Route::post('login-auth', [
    'uses' => 'LoginController@login',
    'as' => 'user.login',
]);

Route::get('login', [
    'uses' => 'LoginController@getLogin',
    'as' => 'login',
]);

Route::get('logout',[
    'uses' => 'LoginController@logout',
    'as' => 'logout',
]);

Route::view('/home', 'home');

Route::resource('comment', 'commentController');

Route::get('/comment/viewComment/{id}',[
    'uses' => 'commentController@show',
    'as' => 'comment.viewComment'
]);

Route::post('/comment/updateComment/{id}', [
    'uses' => 'commentController@update',
    'as' => 'comment.updateComment',
]);

Route::resource('admin', 'adminController');
Route::view('/admin-index', 'admin.index');
Route::view('/admin-register', 'admin.register');

Route::resource('operator', 'operatorController');
Route::view('/operator-index', 'operator.index');
Route::view('/operator-register', 'operator.register');

Route::resource('investor', 'investorController');
Route::view('/investor-index', 'investor.index');
Route::view('/investor-register', 'investor.register');

Route::resource('client', 'clientController');
Route::view('/client-index', 'client.index');
Route::view('/client-register', 'client.register');

Route::resource('service', 'serviceController');
Route::view('/service-index', 'service.index');

Route::resource('camera', 'cameraController');
Route::view('/camera-index', 'camera.index');

Route::resource('accessories', 'accessoriesController');
Route::view('/accessories-index', 'accessories.index');





