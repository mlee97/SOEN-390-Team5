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
use App\Http\Controllers\AssemblyController;
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

Route::group(['middleware' => ['auth', 'assembly.access.only']], function () {
    Route::get('/assembly', [AssemblyController::class, 'goToAssemblyView'])
        ->middleware('auth')
        ->name("assembly");
});

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
Route::post('/change-job-info', [JobController::class, 'updateJobInfo'])
    ->name('change.job.info');

Route::get('/', function () {
    return view('welcome');
})
    ->middleware('auth')
    ->name('home');

//Machine Routes given `manufacturer.quality.access.only` middleware (prevents non-manufacturing from accessing this route)
Route::group(['middleware' => ['auth', 'manufacturer.quality.access.only']], function () {
    Route::get('/machine-status', [MachineController::class, 'goToMachineManagement'])
        ->name('machine.status');

    Route::get('change-status/{id}', [MachineController::class, 'changeStatus'])
        ->name('change.status');
});

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

    Route::get('/logging-CSV-export', [LogController::class, 'exportLogsCSV'])
        ->name('logging.export');

    Route::get('/logging-PDF-export', [LogController::class, 'exportLogsPDF'])
        ->name('loggingPDF.export');
});

Route::get('/login', [UserController::class, 'goToLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [UserController::class, 'loginUser'])
    ->middleware('guest');

Route::post('/logout', [UserController::class, 'logoutUser'])
    ->middleware('auth')
    ->name('logout');


//Inventory Routes given `inventory.access.only` middleware (prevents non-inventory from accessing this route)
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
    Route::post('/mark-received', [ShippingController::class, 'markReceived'])
        ->name('mark.received');
});

//Accountant Routes given `Accountant.access.only` middleware (prevents non-accountant from accessing this route)
Route::group(['middleware' => ['auth', 'accountant.access.only']], function () {

    // Executes "goToAccoutantView" method in the AccountantController when the route is "/accountant".
    Route::get('/accountant', [AccountantController::class, 'goToAccoutantView'])
        ->name('accountant');

    // Executes Accountant export functions (csv and PDF)
    Route::get('/sales-CSV-export', [AccountantController::class, 'exportSalesCSV'])
        ->name('saleCSV.export');

    Route::get('/sales-PDF-export', [AccountantController::class, 'exportSalesPDF'])
        ->name('salePDF.export');

    Route::get('/orders-CSV-export', [AccountantController::class, 'exportOrdersCSV'])
        ->name('orderCSV.export');

    Route::get('/orders-PDF-export', [AccountantController::class, 'exportOrdersPDF'])
        ->name('orderPDF.export');
});

//Sales Routes given `Sales.access.only` middleware (prevents non-sales from accessing this route)
Route::group(['middleware' => ['auth', 'sales.access.only']], function () {

    // Executes "goToSalesView" method in the SaleController when the route is "/sales".
    Route::get('/sales', [SaleController::class, 'goToSalesView'])
        ->name('sales');

    Route::post('/sales', [SaleController::class, 'saveSaleOrder'])
        ->name('save.sale.order');
});


