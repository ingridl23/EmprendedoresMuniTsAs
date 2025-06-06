<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\EmprendedorController;


Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index

//agregar rutas para las secciones individuales del emprendedor
Route::get('/emprendedor', [EmprendedorController::class, "emprendedor"]);
Route::get('/info', [EmprendedorController::class, "infoMaps"]);
Route::get('/About', [EmprendedorController::class, "About"]);
Route::get('/productos', [EmprendedorController::class, "products"]);


// agregar para admin
