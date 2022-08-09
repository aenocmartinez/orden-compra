<?php

use App\Http\Controllers\OrdenController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [OrdenController::class, 'listarOrdenesDeCompra'])->name('home');

Route::get('orden/items', [OrdenController::class, 'listarItems']);
Route::get('ordenes', [OrdenController::class, 'listarOrdenesDeCompra'])->name('ordenes');
Route::get('nueva-orden', [OrdenController::class, 'crearOrdenDeCompra'])->name('orden.crear');
Route::post('agregar-item-a-orden', [OrdenController::class, 'agregarItemAOrden'])->name('orden.agregar-item');
Route::get('orden-de-compra/{id}/datos-de-pago', [OrdenController::class, 'buscarOrdenDeCompraParaPago'])->name('orden.buscar');
Route::post('orden-de-compra/pagar', [OrdenController::class, 'pagarOrdenDeCompra'])->name('orden.pagar');