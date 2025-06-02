<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, "invoke"]); //home del sitio emprendedores general, este seria nuestro index
