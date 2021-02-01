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
})
    ->middleware('auth')
    ->name('home');

Route::get('/user-management', [\App\Http\Controllers\UserController::class, 'getAllUsers'])
    ->middleware('auth')
    ->name('user.management');

//TODO: Group routes together
Route::get('/create-user', [\App\Http\Controllers\UserController::class, 'createUserPage'])
    ->middleware('auth');

Route::post('/create-user', [\App\Http\Controllers\UserController::class, 'createUser'])
    ->name('create.user');

require __DIR__ . '/auth.php';
