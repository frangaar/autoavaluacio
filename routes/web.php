<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('usuaris/{usuari}/change/password', [UsuariController::class,'changePassword'])->name('usuari.changePassword');

Route::get('/login', [UsuariController::class,'showLogin'])->name('login');
Route::post('/login', [UsuariController::class,'login']);
Route::get('/logout', [UsuariController::class,'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function(){

        $user = Auth::user();

        return view('home',compact('user'));
    });
});

Route::resource('usuaris',UsuariController::class);
