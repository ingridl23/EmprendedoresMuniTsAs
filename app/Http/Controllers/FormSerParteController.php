<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\validate;

class FormSerParteController extends Controller
{
    public function index()
    {
        return view("emprendedor.formulario");
    }

    public function send(Request $request)
    {
        $this->validate($request, [

            "name" => "required|string|min:5|max:110",
            "email" => "required|email ",
            "tel" => "required| tel|min:8|max:14",
            "subject" => "required| string|min:20|max:250"

        ]);
        dd($request->input());
    }
}
