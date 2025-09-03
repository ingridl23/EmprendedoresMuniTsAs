<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @class Controller
 *
 * @brief Controlador para la gestión de base de emprendimientos y publicaciones por dentro del proyecto.
 *
 * Este controller define las operaciones bases para los demas controllers que extienden del mismo.
 *
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * Constructor del controlador.
     *
     * Define los foundation necesarios para el resto de los controllers

     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
