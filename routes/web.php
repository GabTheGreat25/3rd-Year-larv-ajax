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

Route::view('/camera-transaction', 'transaction.camera-transaction');
Route::view('/accessories-transaction', 'transaction.accessories-transaction');

Route::post('/camera/checkout',[
    'uses' => 'cameraController@postCheckout',
    'as' => 'checkout'
]); 
Route::post('/accessories/checkout',[
    'uses' => 'accessoriesController@postCheckout',
    'as' => 'checkout'
]); 

Route::view('/searchService', 'search.searchService');
Route::view('/searchCamTransaction', 'search.searchCamTransaction');
Route::view('/searchAccTransaction', 'search.searchAccTransaction');
Route::get('/action','searchController@searchService' )->name('action');
Route::get('/action1','searchController@searchCamTransaction' )->name('action1');
Route::get('/action2','searchController@searchAccTransaction' )->name('action2');

Route::view('/charts', 'charts.index');
Route::get('/operator-chart',[
    'uses' => 'chartController@operatorChart',
]);
Route::get('/sales-chart',[
    'uses' => 'chartController@salesChart',
]);

Route::get('/acc-chart',[
    'uses' => 'chartController@accChart',
]);

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

Route::get('auth/facebook/redirect',[
    'uses' => 'LoginController@facebookRedirect',
    'as' => 'facebookRedirect',
]);

Route::get('auth/facebook/callback',[
    'uses' => 'LoginController@facebookCallback',
    'as' => 'facebookCallback',
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

Route::resource('transaction', 'transactionController');
Route::view('/transaction-index', 'transaction.index');

Route::get("/camera-receipt", [
    "uses" => 'cameraController@getCameraReceipt',
    "as" => "camera.receipt",
]);

Route::get("download-camera-pdf", [
    "uses" => 'cameraController@downloadCameraPDF',
    "as" => "camera.downloadPDF",
]);

Route::get("/accessories-receipt", [
    "uses" => 'accessoriesController@getAccessoriesReceipt',
    "as" => "accessories.receipt",
]);

Route::get("download-accessories-pdf", [
    "uses" => 'accessoriesController@downloadAccessoriesPDF',
    "as" => "accessories.downloadPDF",
]);






