<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\validacionFormularioContacto;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendContactForm;


class FormSerParteController extends Controller
{




    public function formarparte()
    {
        return view("emprendedor.formulario");
    }



    public function enviar(validacionFormularioContacto $request)
    {

        //dd($request->all());
        //  dd($request->file('cv'));

        if ($request->filled('oculto')) {
            return back()->with("error", "formulario rechazado "); // posible bot detectado
        }

        try {

            //  Si eligió “búsqueda de empleo”, guardamos los datos y el CV
            if ($request->subconjuntos === 'busqueda de empleo') {
                $cvPath = $request->file('cv')->store('cvs', 'public');

                // Asegurate de tener el modelo Empleo y la migración correspondiente
                \App\Models\Empleo::create([
                    'nombre' => $request->nombre,
                    'asunto' => $request->asunto,
                    'email' => $request->email,
                    'telefono' => $request->telefono,
                    'cv_path' => $cvPath,
                ]);
            }






            $data = $request->except('cv'); // todos los datos menos el archivo
            $data['cv'] = $request->file('cv'); // agregás el archivo (UploadedFile)
            Mail::to('oficina.empleo@tresarroyos.gov.ar')->send(new sendContactForm($data));
            return back()->with('success', 'Formulario enviado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al enviar el formulario: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al enviar el formulario verifique su conexion.');
        }
    }
}
