<?php

use App\Http\Controllers\UserController;
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
Route::get('/assembly', function(){
    return view ('assembly');
})
->middleware('auth')
->name("assembly");

Route::get('/inventory', function(){
    return view ('inventory');
})
->middleware('auth')
->name("inventory");


Route::get('/', function () {
    return view('welcome');
})
    ->middleware('auth')
    ->name('home');

//IT Routes grouped together & given `it.access.only` middleware (prevents non-IT personal from accessing these routes)
Route::group(['middleware' => ['auth' ,'it.access.only']], function () {
    Route::get('/create-user', [UserController::class, 'goToCreateUser']);

    Route::post('/create-user', [UserController::class, 'createUser'])
        ->name('create.user');

    Route::get('/user-management', [UserController::class, 'goToUserManagement'])
        ->name('user.management');

    Route::post('/update-user', [UserController::class, 'updateUser'])
        ->name('update.user');
});

Route::get('/login', [UserController::class, 'goToLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [UserController::class, 'loginUser'])
    ->middleware('guest');

Route::post('/logout', [UserController::class, 'logoutUser'])
    ->middleware('auth')
    ->name('logout');