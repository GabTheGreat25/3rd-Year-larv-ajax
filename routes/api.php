<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\investorController;
use App\Http\Controllers\operatorController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\cameraController;
use App\Http\Controllers\accessoriesController;
use App\Http\Controllers\serviceController;





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

Route::post('/auth', [AuthController::class, "login"]);

Route::post('/admin', [adminController::class, "login"]);
Route::get('/admin', [adminController::class, "index"]);
Route::post('/admin', [adminController::class, "store"]);
Route::patch('/admin/{id}', [adminController::class, "update"]);
Route::delete('/admin/{id}', [adminController::class, "destroy"]);

Route::get('/investor', [investorController::class, "index"]);
Route::post('/investor', [investorController::class, "store"]);
Route::patch('/investor/{id}', [investorController::class, "update"]);
Route::delete('/investor/{id}', [investorController::class, "destroy"]);

Route::get('/operator', [operatorController::class, "index"]);
Route::post('/operator', [operatorController::class, "store"]);
Route::patch('/operator/{id}', [operatorController::class, "update"]);
Route::delete('/operator/{id}', [operatorController::class, "destroy"]);

Route::get('/client', [clientController::class, "index"]);
Route::post('/client', [clientController::class, "store"]);
Route::patch('/client/{id}', [clientController::class, "update"]);
Route::delete('/client/{id}', [clientController::class, "destroy"]);

Route::get('/camera', [cameraController::class, "index"]);
Route::post('/camera', [cameraController::class, "store"]);
Route::patch('/camera/{id}', [cameraController::class, "update"]);
Route::delete('/camera/{id}', [cameraController::class, "destroy"]);

Route::get('/accessories', [accessoriesController::class, "index"]);
Route::post('/accessories', [accessoriesController::class, "store"]);
Route::patch('/accessories/{id}', [accessoriesController::class, "update"]);
Route::delete('/accessories/{id}', [accessoriesController::class, "destroy"]);

Route::get('/service', [serviceController::class, "index"]);
Route::post('/service', [serviceController::class, "store"]);
Route::patch('/service/{id}', [serviceController::class, "update"]);
Route::delete('/service/{id}', [serviceController::class, "destroy"]);

Route::middleware('guest')->group(function () {
    Route::post('/camera/checkout',['uses' => 'cameraController@postCheckout',]); 
    Route::post('/accessories/checkout',['uses' => 'accessoriesController@postCheckout',]); 

    Route::redirect('/', 'login');

    Route::resource('comment', 'commentController');

    Route::get('/comment/viewComment/{id}',[
    'uses' => 'commentController@show',
    'as' => 'comment.viewComment'
    ]);

    Route::post('/comment/updateComment/{id}', [
    'uses' => 'commentController@update',
    'as' => 'comment.updateComment',
    ]);


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
    
    Route::view('/admin-register', 'admin.register');
    Route::resource('admin', 'adminController')->except(['index','edit','update','destroy','restore']);
    Route::view('/operator-register', 'operator.register');
    Route::resource('operator', 'operatorController')->except(['index','edit','update','destroy','restore']);
    Route::view('/investor-register', 'investor.register');
    Route::resource('investor', 'investorController')->except(['index','edit','update','destroy','restore']);
    Route::view('/client-register', 'client.register');
    Route::resource('client', 'clientController')->except(['index','edit','update','destroy','restore']);
});

Route::middleware('auth:api')->group(function () {

    Route::view('/home', 'home');

    Route::middleware('role:admin')->group(function () {
        Route::view('/admin-index', 'admin.index');
        Route::resource('admin', 'adminController')->except(['create', 'store']);
        Route::get('/admin/all',['uses' => 'adminController@getadminAll','as' => 'admin.getadminall'] );
        Route::post('admin/post/{id}','adminController@update');
        Route::patch('/admin/restore/{id}', 'adminController@restore');
        Route::view('/client-index', 'client.index');
        Route::resource('client', 'clientController')->except(['create', 'store']);
        Route::get('/client/all',['uses' => 'clientController@getclientAll','as' => 'client.getclientall'] );
        Route::post('client/post/{id}','clientController@update');
        Route::patch('/client/restore/{id}', 'clientController@restore');
        Route::view('/operator-index', 'operator.index');
        Route::resource('operator', 'operatorController')->except(['create', 'store']);
        Route::get('/operator/all',['uses' => 'operatorController@getoperator','as' => 'operator.getoperatorall'] );
        Route::post('operator/post/{id}','operatorController@update');
        Route::patch('/operator/restore/{id}', 'operatorController@restore');
        Route::view('/investor-index', 'investor.index');
        Route::resource('investor', 'investorController')->except(['create', 'store']);
        Route::get('/investor/all',['uses' => 'investorController@getinvestorAll','as' => 'investor.getinvestorall'] );
        Route::post('investor/post/{id}','investorController@update');
        Route::patch('/investor/restore/{id}', 'investorController@restore');
        Route::view('/transaction-index', 'transaction.index');
        Route::resource('transaction', 'transactionController');
        Route::get('/transaction/all',['uses' => 'transactionController@gettransactionAll','as' => 'transaction.gettransactionall'] );
        Route::post('transaction/post/{id}','transactionController@update');
    });

    Route::middleware('role:operator')->group(function () {
        // Route::view('/operator-index', 'operator.index');
        // Route::resource('operator', 'operatorController')->except(['create', 'store']);
        // Route::get('/operator/all',['uses' => 'operatorController@getoperator','as' => 'operator.getoperatorall'] );
        // Route::post('operator/post/{id}','operatorController@update');
        // Route::patch('/operator/restore/{id}', 'operatorController@restore');
    });

    Route::middleware('role:investor')->group(function () {
        // Route::view('/investor-index', 'investor.index');
        // Route::resource('investor', 'investorController')->except(['create', 'store']);
        // Route::get('/investor/all',['uses' => 'investorController@getinvestorAll','as' => 'investor.getinvestorall'] );
        // Route::post('investor/post/{id}','investorController@update');
        // Route::patch('/investor/restore/{id}', 'investorController@restore');
    });

    Route::middleware('role:client')->group(function () {
        Route::view('/camera-transaction', 'transaction.camera-transaction');
        Route::view('/accessories-transaction', 'transaction.accessories-transaction');
    });

    Route::middleware('role:admin,client,operator')->group(function () {
        Route::view('/service-index', 'service.index');
        Route::get('/service/all',['uses' => 'serviceController@getserviceAll','as' => 'service.getserviceall'] );
        Route::resource('service', 'serviceController');
        Route::post('service/post/{id}','serviceController@update');
    });

    Route::middleware('role:admin,client,investor')->group(function () {
        Route::view('/camera-index', 'camera.index');
        Route::get('/camera/all',['uses' => 'cameraController@getcameraAll','as' => 'camera.getcameraall'] );
        Route::resource('camera', 'cameraController');
        Route::post('camera/post/{id}','cameraController@update');

        Route::view('/accessories-index', 'accessories.index');
        Route::get('/accessories/all',['uses' => 'accessoriesController@getaccessoriesAll','as' => 'accessories.getaccessoriesall'] );
        Route::resource('accessories', 'accessoriesController');
        Route::post('accessories/post/{id}','accessoriesController@update');
    });

    Route::middleware('role:admin,investor')->group(function () {
        Route::view('/searchService', 'search.searchService');
        Route::view('/searchCamTransaction', 'search.searchCamTransaction');
        Route::view('/searchAccTransaction', 'search.searchAccTransaction');
        Route::get('/action','searchController@searchService' )->name('action');
        Route::get('/action1','searchController@searchCamTransaction' )->name('action1');
        Route::get('/action2','searchController@searchAccTransaction' )->name('action2');
        Route::post('search','searchController@searchService');
        Route::post('searchh','searchController@searchCamTransaction');
        Route::post('searchhh','searchController@searchAccTransaction');
        
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
    });
});


