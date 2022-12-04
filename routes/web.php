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

// Route::post('signin', [
//     'uses' => 'LoginController@login',
//     'as' => 'user.signin',
// ]);

Route::get('/signup', function () {
    return view('signup');
});

Route::resource('operator', 'operatorController');
route::view('/operator-index', 'operator.index');

Route::resource('accessories', 'accessoriesController');
route::view('/accessories-index', 'accessories.index');

Route::resource('camera', 'cameraController');
route::view('/camera-index', 'camera.index');

Route::resource('service', 'serviceController');
route::view('/service-index', 'service.index');

// Route::resource('investor', 'investorController');
// route::view('/investor-index', 'investor.index');