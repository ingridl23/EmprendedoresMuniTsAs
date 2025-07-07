<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendContactForm;


class FormSerParteController extends Controller
{




    public function formarparte()
    {
        return view("emprendedor.formulario");
    }




    public function enviar(Request $request)
    {

        if ($request->filled('oculto')) {
            return back()->with("error", "formulario rechazado posible bot detectado"); // posible bot detectado
        }
        $validated = $request->validate([

            "first_name" => ["required", "string", "min:5", "max:110"],
            "email" => ["required", "email"],
            "tel" => ["required", "digits_between:8,11"],
            "description" => ["required", "string", "min:80", "max:250"]

        ]);

        Mail::to('ingrid.ledesma@tresarroyos.gov.ar')->send(new sendContactForm($request->all()));



        return back()->with('success', 'Formulario enviado correctamente.');

        //dd($request->input());
        dd($request->all()); // Agregalo temporalmente
    }
}
