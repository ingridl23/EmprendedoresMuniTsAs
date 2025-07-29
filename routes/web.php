
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


Route::get('/noticias/buscadorTitulo', [noticiasController::class, 'filterNoticiasByTittle']); //Filtro para noticias por titulo
Route::get('/noticias/buscadorCategoria', [noticiasController::class, 'filterNoticiasByCategory']); //Filtro para noticias por categoria
Route::get('/noticias/buscadorFecha', [noticiasController::class, 'filterNoticiasByDate']); //Filtro para noticias por fecha

//RUTAS NOTICIAS ADMIN
Route::post("/noticias/cargarNuevaNoticia", [administradorController::class, "createNoticia"]);
Route::get('/noticias/nuevaNoticia', [administradorController::class, "showFormCreateNoticia"]); //Muestra formulario para cargar una nueva noticia
Route::get('/noticias/formEditarNoticia/{id}', [administradorController::class, "showFormEditNoticia"]); //Muestra formulario para editar los datos de una noticia
Route::PATCH('/noticias/{id}', [administradorController::class, "EditNoticia"]); //Edita la noticia con los datos que llegan del formulario
Route::DELETE('/noticias/{id}', [administradorController::class, "deleteNoticia"]); //Elimina la noticia segun el id único que tenga.

//RUTAS LOGIN
Route::post('/logout', [LoginController::class, 'logout']); //Cierra la sesión
Route::post('/login', [LoginController::class, 'login']); //invoca la logica del login admin
Route::get('/showlogin', [HomeController::class, 'showlogin'])->name("showlogin"); //invoca la vista del login admin (formulario)


Route::get('/', [HomeController::class, "index"]); //home del sitio emprendedores general, este seria nuestro index

//rutas del formulario de contacto
Route::get('/formar/parte', [FormSerParteController::class, "formarparte"]); // redireccionamiento al formulario para solicitar hablar con alguien de cultura
Route::post('/formulario-enviar', [FormSerParteController::class, 'enviar'])->name('formulario.enviar'); //ruta que envia  la regla post del formulario


//RUTAS EMPRENDEDORES
Route::get('/emprendedores/buscador', [EmprendedorController::class, 'filterEmprendimientosByName']); //Filtro para emprendedores por nombre
Route::get('/emprendedores', [EmprendedorController::class, "emprendedores"])->name("emprendedores"); //vista general para emprendedores
Route::get('emprendedores/user', [EmprendedorController::class, "obtenerRol"]); //Se usa en JS para obtener el rol y saber si es admin o no para mostrar contenido generado en JS
//(hay botones solo disponibles para admin)

Route::get('/emprendedor/{id}', [EmprendedorController::class, "showEmprendimientoId"]); // ruta para las secciones individuales del emprendedor

//  para admin
Route::get('/emprendedores/acciones', [administradorController::class, "emprendedores"]);

//RUTAS EMPRENDEDORES ADMIN
Route::get('/emprendedores/nuevoEmprendimiento', [administradorController::class, "showFormCrearEmprendimiento"]); //Muestra form para cargar nuevo emprendimiento
Route::post('/emprendedores/crearEmprendimiento', [administradorController::class, "crearEmprendimiento"]); //Carga el nuevo emprendimiento
Route::get('/emprendedores/formEditarEmprendimiento/{id}', [administradorController::class, "showFormEditarEmprendimiento"]); //Muestra form para editar emprendimiento
Route::patch('/emprendedores/{id}', [administradorController::class, "editarEmprendimiento"]); //Edita un emprendimiento en especifico por su ID.
Route::delete('/emprendedor/{id}', [administradorController::class, "eliminarEmprendimiento"]); //Elimina un emprendimiento por su ID


//rutas admin y roles
Auth::routes();

//vista de passwords reset
Route::get('/passwords/reset', [ResetPasswordController::class, "reset"]);

Route::get("/noticias", [noticiasController::class, "showNoticias"]);
Route::get("/noticias/{id}", [noticiasController::class, "showNoticia"]);


//programas
Route::get('/programas', [ProgramasController::class, "ShowPrograma"])->name('programas');;
