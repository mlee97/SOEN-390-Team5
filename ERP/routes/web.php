<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AccountantController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\MachineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicPDFController;

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

Route::get('/assembly', function () {
    return view('assembly');
})
    ->middleware('auth')
    ->name("assembly");

//Jobs routes to see, create, delete and update jobs
Route::get('/jobs', [JobController::class, 'goToJobManagement'])
    ->middleware('auth')
    ->name('jobs');
Route::get('/create-job', [JobController::class, 'goToCreateJob'])
    ->middleware('auth');
Route::post('/create-job', [JobController::class, 'createJob'])
    ->middleware('auth')
    ->name('create.job');
Route::get('delete-job/{job_id}', [JobController::class, 'deleteJob']);
Route::get('/toggle-job-status/{job_id}', [JobController::class, 'updateJobStatus']);

Route::get('/', function () {
    return view('welcome');
})
    ->middleware('auth')
    ->name('home');

//Machine status routes to see and change the current status of a particular machine
Route::get('/machine-status', [MachineController::class, 'goToMachineManagement'])
    ->middleware('auth')
    ->name('machine-status');

Route::get('change-status/{id}', [MachineController::class, 'changeStatus'])
    ->name('change.status');


//IT Routes grouped together & given `it.access.only` middleware (prevents non-IT personal from accessing these routes)
Route::group(['middleware' => ['auth', 'it.access.only']], function () {
    Route::get('/create-user', [UserController::class, 'goToCreateUser']);

    Route::post('/create-user', [UserController::class, 'createUser'])
        ->name('create.user');

    Route::get('/user-management', [UserController::class, 'goToUserManagement'])
        ->name('user.management');

    Route::post('/update-user', [UserController::class, 'updateUser'])
        ->name('update.user');

    Route::get('/logging', [LogController::class, 'goToLogManagement'])
        ->name('logging.main');

    Route::get('/logging-export', [LogController::class, 'exportLogs'])
        ->name('logging.export');

    Route::get('/PDF/logs', [LogController::class, 'pdf']);
});

Route::get('/login', [UserController::class, 'goToLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [UserController::class, 'loginUser'])
    ->middleware('guest');

Route::post('/logout', [UserController::class, 'logoutUser'])
    ->middleware('auth')
    ->name('logout');


//Inventory Routes given `inventory.access.only` middleware (prevents non-inventory or non-IT personal from accessing this route)
Route::group(['middleware' => ['auth', 'inventory.access.only']], function () {
    Route::get('/inventory', [BikeController::class, 'goToInventory'])
        ->name('inventory');

    Route::post('/create-bike', [BikeController::class, 'createBike'])
        ->name('create.bike');

    Route::post('/create-part', [PartController::class, 'createPart'])
        ->name('create.part');

    Route::post('/create-material', [MaterialController::class, 'createMaterial'])
        ->name('create.material');

    Route::post('/create-order', [OrderController::class, 'createOrder'])
        ->name('create.order');

    Route::post('/edit-bike', [BikeController::class, 'editBike'])
        ->name('edit.bike');

    Route::post('/edit-part', [PartController::class, 'editPart'])
        ->name('edit.part');

    Route::post('/edit-material', [MaterialController::class, 'editMaterial'])
        ->name('edit.material');

    Route::get('deleteBike/{id}', [BikeController::class, 'destroy']);

    Route::get('deletePart/{id}', [PartController::class, 'destroy']);

    Route::get('deleteMaterial/{id}', [MaterialController::class, 'destroy']);

    Route::get('update-bike/{id}', [BikeController::class, 'updateBike'])
        ->name('update.bike');
});

//Shipping Routes given `shipping.access.only` middleware (prevents non-shipping users from accessing this route)
Route::group(['middleware' => ['auth' ,'shipping.access.only']], function () {
    Route::get('/shipping', [ShippingController::class, 'goToShipping'])
        ->name('shipping');
    Route::get('/toggle-order-status/{id}', [ShippingController::class, 'toggleOrderStatus'])
        ->name('toggle.order.status');
});

// Executes "goToAccoutantView" method in the AccountantController when the route is "/accountant".
Route::get('/accountant', [AccountantController::class, 'goToAccoutantView'])
    ->name('accountant');

Route::get('/sale-export', [SaleController::class, 'exportSales'])
    ->name('sale.export');


    
