<?php


use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmprendedorController;
use App\Http\Controllers\administradorController;


Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index


Route::get('/emprendimientos/nuevoEmprendimiento', [administradorController::class,"showFormCrearEmprendimiento"]);
Route::post('/emprendimientos/crearEmprendimiento',[administradorController::class, "crearEmprendimiento"]);

Route::get('/emprendimientos/formEditarEmprendimiento/{id}', [administradorController::class,"showFormEditarEmprendimiento"]);
Route::patch('/emprendimientos/{id}', [administradorController::class,"editarEmprendimiento"]);

Route::delete('/emprendimientos/{id}', [administradorController::class,"eliminarEmprendimiento"]);

Route::get('emprendimientos', [App\Http\Controllers\EmprendedorController::class, 'getEmprendimientos'])->name('emprendimientos'); //Muestra los emprendimientos
Route::get('/emprendimientos/{id}', [EmprendedorController::class, "showEmprendimientoId"]);

Route::get('emprendimientos/buscador', [App\Http\Controllers\EmprendedorController::class, 'filterEmprendimientosByName'])->name('filterByName');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

