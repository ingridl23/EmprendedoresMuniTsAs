<?php


use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;





Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index


 Route::get('/layout', function () {
       return view('layouts.templateEmprendedores');
   });


Route::get('emprendimientos', [App\Http\Controllers\EmprendedorController::class, 'getEmprendimientos'])->name('emprendimientos');
Route::get('emprendimientos/buscador', [App\Http\Controllers\EmprendedorController::class, 'filterEmprendimientosByName'])->name('filterByName');
//agregar rutas para las secciones individuales del emprendedor
// agregar para admin
