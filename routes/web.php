<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

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

// Auth routes (login, register, etc.)
Auth::routes();

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Group all /home/client routes and protect with auth middleware
Route::middleware('auth')->prefix('home')->group(function () {
    // All client routes now start with /home/client
    Route::resource('client', ClientController::class);

    // These are already included in the resource route, but can be defined explicitly if needed
    Route::get('client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('client/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

});

Route::get('/adminOptions',function(){return view('admin');})->middleware('can:view_page_admin');


