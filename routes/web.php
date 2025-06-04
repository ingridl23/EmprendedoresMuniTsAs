<?php


use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmprendedorController;

Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index

Route::get('/emprendimientos', [EmprendedorController::class, "showEmprendimientos"]); //Muestra los emprendimientos
Route::get('/emprendimientos/{id}', [EmprendedorController::class, "showEmprendimientoId"]);
//agregar rutas para las secciones individuales del emprendedor
// agregar para admins
