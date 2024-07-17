<?php

use App\Http\Controllers\AluguelController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConsoleController;
use App\Models\Console;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    $consoles = Console::all();
    return view('welcome', compact('consoles'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clientes', ClienteController::class);
Route::resource('alugueis', AluguelController::class);
Route::resource('consoles', ConsoleController::class);
