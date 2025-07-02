<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\validate;
use Illuminate\Support\Facades\Mail;

use App\Mail\sendContactForm;





class FormSerParteController extends Controller
{




    public function formarparte()
    {
        return view("emprendedor.formulario");
    }



    public function send() {}

    public function enviar(Request $request)
    {


        $validated = $request->validate([

            "name" => ["required", "string", "min:5", "max:110"],
            "email" => ["required ", " email "],
            "tel" => ["required", "digits_between:8,14"],
            "subject" => ["required", " string", "min:80", "max:250"]

        ]);

        Mail::to('ingridmilagrosledesma@gmail.com')->send(new sendContactForm($request->all()));

        return back()->with('success', 'Formulario enviado correctamente.');

        //dd($request->input());
        dd($request->all()); // Agregalo temporalmente
    }
}
