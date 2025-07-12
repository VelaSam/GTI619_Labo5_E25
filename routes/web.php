<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PostController;
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

Route::resource('client', ClientController::class);
Route::get('client/{id}/edit', 'ClientController@edit')->name('client.edit');
Route::put('client/{id}', 'ClientController@update')->name('client.update');
Route::delete('client/{id}', 'ClientController@destroy')->name('client.destroy');


// Test routes (https://laracasts.com/series/laravel-6-from-scratch)
Route::get('/test', function () {
    $name = request('name');

    return view('test', [
        'name' => $name
    ]);
});

Route::get('/posts/{post}', [PostController::class, 'show']);
