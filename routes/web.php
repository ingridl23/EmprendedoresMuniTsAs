<?php


use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;




Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index

//agregar rutas para las secciones individuales del emprendedor
// agregar para admin
