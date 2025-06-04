<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmprendedorController extends Controller
{
    public function emprendedor()
    {

        return view('emprendedor.templateEmprendedor');
    } // devolvera la seccion para un emprendedor

    public function infoMaps()
    {

        return view('emprendedor.templateInfoMaps');
    } // devolvera la seccion de contacto del emprendedor

    public function About()
    {

        return view('emprendedor.templateAbout');
    } // devolvera informacion del emprendedor

    public function products()
    {

        return view('emprendedor.templateproducts');
    }  // devuelve la vista de productos dentro del empendedor
}
