<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

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
    return view('auth.login');
});

// Llamas a vista index
/* 
Route::get('/usuarios', function () {
    return view('usuarios.index');
});
*/

// Llamas a vista create
// Route::get('/usuarios/create', [UsuariosController::class,'create']);

// Con esta instricción podemos acceder a todas las URLs de Usuarios (Creat, edit, form, index...)

Route::resource('usuarios', UsuariosController::class)->middleware('auth');

Auth::routes(['register'=> false, 'reset'=> false]);

Route::get('/home', [UsuariosController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'],function () {
    Route::get('/', [UsuariosController::class, 'index'])->name('home'); 
});

