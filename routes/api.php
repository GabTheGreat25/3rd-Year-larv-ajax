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
// Route::post('register-auth', [
//     'uses' => 'LoginController@register',
//     'as' => 'user.register',
// ]);

// Route::get('register', [
//     'uses' => 'LoginController@getRegister',
// ]);

Route::post('login-auth', [
    'uses' => 'LoginController@login',
    'as' => 'user.login',
]);
Route::get('login', [
    'uses' => 'LoginController@getLogin',
]);
Route::get('logout',[
    'uses' => 'LoginController@logout',
]);

Route::middleware('auth:api')->group(function () {

    Route::get('/', function () {
    return view('welcome');
    });

Route::view('/admin-index', 'admin.index');
Route::view('/admin-register', 'admin.register');
Route::get('/admin/all',['uses' => 'adminController@getadminAll','as' => 'admin.getadminall'] );
Route::resource('admin', 'adminController');
Route::post('admin/post/{id}','adminController@update');
Route::patch('/admin/restore/{id}', 'adminController@restore');

Route::view('/operator-index', 'operator.index');
Route::view('/operator-register', 'operator.register');
Route::get('/operator/all',['uses' => 'operatorController@getoperator','as' => 'operator.getoperatorall'] );
Route::resource('operator', 'operatorController');
Route::post('operator/post/{id}','operatorController@update');
Route::patch('/operator/restore/{id}', 'operatorController@restore');

route::view('/investor-index', 'investor.index');
Route::view('/investor-register', 'investor.register');
Route::get('/investor/all',['uses' => 'investorController@getinvestorAll','as' => 'investor.getinvestorall'] );
Route::resource('investor', 'investorController');
Route::post('investor/post/{id}','investorController@update');
Route::patch('/investor/restore/{id}', 'investorController@restore');

route::view('/client-index', 'client.index');
Route::view('/client-register', 'client.register');
Route::get('/client/all',['uses' => 'clientController@getclientAll','as' => 'client.getclientall'] );
Route::resource('client', 'clientController');
Route::post('client/post/{id}','clientController@update');
Route::patch('/client/restore/{id}', 'clientController@restore');


route::view('/service-index', 'service.index');
Route::view('/service-register', 'service.register');
Route::get('/service/all',['uses' => 'serviceController@getserviceAll','as' => 'service.getserviceall'] );
Route::resource('service', 'serviceController');
Route::post('service/post/{id}','serviceController@update');
Route::patch('/service/restore/{id}', 'serviceController@restore');

route::view('/camera-index', 'camera.index');
Route::view('/camera-register', 'camera.register');
Route::get('/camera/all',['uses' => 'cameraController@getcameraAll','as' => 'camera.getcameraall'] );
Route::resource('camera', 'cameraController');
Route::post('camera/post/{id}','cameraController@update');
Route::patch('/camera/restore/{id}', 'cameraController@restore');

route::view('/accessories-index', 'accessories.index');
Route::view('/accessories-register', 'accessories.register');
Route::get('/accessories/all',['uses' => 'accessoriesController@getaccessoriesAll','as' => 'accessories.getaccessoriesall'] );
Route::resource('accessories', 'accessoriesController');
Route::post('accessories/post/{id}','accessoriesController@update');
Route::patch('/accessories/restore/{id}', 'accessoriesController@restore');
});


