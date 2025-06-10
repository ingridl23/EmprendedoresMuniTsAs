<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\EmprendedorController;

use App\Http\Controllers\EmprendedoresController;

Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index
Route::get('/formarparte', [HomeController::class, "formarparte"]); // redireccionamiento al formulario para solicitar hablar con alguien de cultura


//agregar rutas para las secciones individuales del emprendedor
Route::get('/emprendedo/{{$id}}', [EmprendedorController::class, "emprendedor"]);
Route::get('/emprendedores', [EmprendedoresController::class, "emprendedores"]); //vista general para emprendedores
Route::get('/info', [EmprendedorController::class, "infoMaps"]);
Route::get('/About', [EmprendedorController::class, "About"]);
Route::get('/productos', [EmprendedorController::class, "products"]);

// agregar para admin
