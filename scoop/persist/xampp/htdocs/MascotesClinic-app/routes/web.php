<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\LineaHistorialController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('propietarios', PropietarioController::class);
Route::resource('mascotas', MascotaController::class);
Route::resource('linea-historial', LineaHistorialController::class)
    ->parameters(['linea-historial' => 'lineaHistorial']);