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

    /**
     * Arma el patrón LIKE para los buscadores públicos a partir del parámetro "busqueda".
     *
     * Valida que sea texto de hasta 100 caracteres y escapa los comodines % y _ (y la barra
     * invertida, que es el carácter de escape de MySQL) para que se busquen como texto común.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null Patrón "%texto%", o null si la búsqueda no es válida.
     */
    protected function patronBusqueda(\Illuminate\Http\Request $request): ?string
    {
        $busqueda = $request->query('busqueda', '');
        if (!is_string($busqueda) || mb_strlen($busqueda) > 100) {
            return null;
        }
        return '%' . str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $busqueda) . '%';
    }
}
