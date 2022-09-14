<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Firsebase\CrudFirebaseController;

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
// Route::get('index','CrudFirebaseController@index')->name('index');
Route::get('/index', [CrudFirebaseController::class, 'index'])->name('index');

Route::post('/submit', [CrudFirebaseController::class, 'store'])->name('submit');
Route::get('/delete/{id}', [CrudFirebaseController::class, 'delete'])->name('delete');

Route::get('/edit/{id}', [CrudFirebaseController::class, 'edit'])->name('edit');

Route::get('/update/{id}', [CrudFirebaseController::class, 'update'])->name('update');
Auth::routes();

Route::get('/home', [CrudFirebaseController::class, 'home'])->name('home');

    Route::post('/store-token', [CrudFirebaseController::class, 'updateDeviceToken'])->name('store.token');
    Route::post('/send-web-notification', [CrudFirebaseController::class, 'sendNotification'])->name('send.web-notification');
