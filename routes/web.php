<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\administradorController;
use App\Http\Controllers\EmprendedorController;

use App\Http\Controllers\Auth\ConfirmPasswordController;

use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Auth\VerificationController;

use App\Http\Controllers\EmprendedoresController;

Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index
Route::get('/formarparte', [HomeController::class, "formarparte"]); // redireccionamiento al formulario para solicitar hablar con alguien de cultura


//agregar rutas para las secciones individuales del emprendedor
Route::get('/emprendedor', [EmprendedorController::class, "emprendedor"]);
Route::get('/emprendedores', [EmprendedoresController::class, "emprendedores"]); //vista general para emprendedores



// agregar para admin

Route::get('/emprendedores/nuevoEmprendimiento', [administradorController::class, "showFormCrearEmprendimiento"]);
Route::post('/emprendimientos/crearEmprendimiento', [administradorController::class, "crearEmprendimiento"]);

Route::get('/emprendedores/{id}', [EmprendedorController::class, "showEmprendimientoId"]);
Route::get('/emprendedores/formEditarEmprendimiento/{id}', [administradorController::class, "showFormEditarEmprendimiento"]);
Route::patch('/emprendedores/update/{id}', [administradorController::class, "editarEmprendimiento"]);

Route::delete('/emprendedores/delete/{id}', [administradorController::class, "eliminarEmprendimiento"]);

Route::get('emprendedores', [EmprendedorController::class, 'getEmprendimientos'])->name('emprendimientos'); //Muestra los emprendimientos

Auth::routes();
