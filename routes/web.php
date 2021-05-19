<?php

use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Models\Pedido;
use App\Models\Producto; 
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('producto',ProductoController::class)->middleware('auth');

Route::resource('proveedor',ProveedorController::class)->middleware('auth');

Route::resource('pedido',PedidoController::class)->middleware('auth');
Route::get('pedido/buscarFecha/{id}/{b}',[PedidoController::class,'buscarFecha'])->name('pedido.buscarFecha')->middleware('auth');