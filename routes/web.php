
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\administradorController;
use App\Http\Controllers\EmprendedorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\EmprendedoresController;
use App\Http\Controllers\FormSerParteController;
use App\Http\Controllers\noticiasController;
use App\Http\Controllers\ProgramasController;

Route::get('/emprendedores/buscador', [EmprendedorController::class, 'filterEmprendimientosByName']);
Route::post('/logout', [LoginController::class, 'logout']); //Cierra la sesión
//rutas form admin
Route::post('/login', [LoginController::class, 'login']); //invoca la logica del login admin
Route::get('/showlogin', [HomeController::class, 'showlogin'])->name("showlogin"); //invoca la vista del login admin


Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index

//rutas del formulario de contacto
Route::get('/formar/parte', [FormSerParteController::class, "formarparte"]); // redireccionamiento al formulario para solicitar hablar con alguien de cultura
Route::post('/formulario-enviar', [FormSerParteController::class, "enviar"])->name("formulario.enviar"); //ruta que envia  la regla post del formulario



Route::get('/emprendedores', [EmprendedorController::class, "emprendedores"])->name("emprendedores"); //vista general para emprendedores

Route::get('emprendedores/user', [EmprendedorController::class, "obtenerRol"]);

// ruta para las secciones individuales del emprendedor
Route::get('/emprendedor/{id}', [EmprendedorController::class, "showEmprendimientoId"]);

// agregar para admin
Route::get('/emprendedores/acciones', [administradorController::class, "emprendedores"]);

Route::get('/emprendedores/nuevoEmprendimiento', [administradorController::class, "showFormCrearEmprendimiento"]);
Route::post('/emprendedores/crearEmprendimiento', [administradorController::class, "crearEmprendimiento"]);

//Route::get('/emprendedores/{id}', [EmprendedorController::class, "showEmprendimientoId"]);
Route::get('/emprendedores/formEditarEmprendimiento/{id}', [administradorController::class, "showFormEditarEmprendimiento"]);
Route::patch('/emprendedores/{id}', [administradorController::class, "editarEmprendimiento"]);

Route::delete('/emprendedor/{id}', [administradorController::class, "eliminarEmprendimiento"]);

Auth::routes();

//vista de passwords reset
Route::get('/passwords/reset', [ResetPasswordController::class, "reset"]);

//rutas noticias

Route::get("/noticias", [noticiasController::class, "showNoticias"]);
//Route::get("/noticias/{id}", [noticiasController::class, "showNoticia"]);
Route::get("/noticias/{id}", [noticiasController::class, "showNoticia"]); // ruta temporal para poder editar el template
//programas
Route::get("/programas", [ProgramasController::class, "showProgramas"]);
// ruta para la iteracion de ultimos emprendedores añadidos
Route::get('/programas/emprendedor', [programasController::class, "showEmprendedores"]);
Route::get('/ultimosemprendedores', [HomeController::class, "showUltimosEmprendedores"]);
