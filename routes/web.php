<?php


use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmprendedorController;

Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index

Route::get('/emprendimientos', [EmprendedorController::class, "showEmprendimientos"]); //Muestra los emprendimientos
Route::get('/emprendimientos/categoria/{categoria}', [EmprendedorController::class, "filterEmprendimientosCategoria"]);
Route::get('/emprendimientos/nombre/{nombre}', [EmprendedorController::class, "filterEmprendimientosNombre"]);
Route::get('/emprendimientos/{categoria}/{nombre}', [EmprendedorController::class, "filterEmprendimientos"]);
Route::get('/emprendimientos/{id}', [EmprendedorController::class, "showEmprendimientoId"]);

// agregar para admins
