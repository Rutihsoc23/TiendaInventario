<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController; // ¡Importa el controlador!

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ¡CAMBIO HECHO! Ahora la ruta raíz carga la lista de productos.
Route::get('/', [ProductoController::class, 'index']);

// Esta línea crea todas las rutas necesarias para el CRUD de productos
// (La dejamos tal cual, está perfecta)
Route::resource('productos', ProductoController::class);
