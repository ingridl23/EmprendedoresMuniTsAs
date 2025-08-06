<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\validacionFormularioContacto;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendContactForm;
use App\Models\Empleo;

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
            $cvPath = null;

            if ($request->subconjuntos === 'busqueda de empleo') {

                if (!$request->hasFile('cv')) {
                    return back()->with('error', 'Debe subir su currículum.');
                }

                $cvPath = $request->file('cv')->store('cvs', 'public');
                //  tener el modelo Empleo y la migración correspondiente antes
                $empleoData = [
                    'nombre' => $request->nombre,
                    'asunto' => $request->asunto,
                    'email' => $request->email,
                    'telefono' => $request->telefono,
                    'edad' => $request->edad,
                    'dni' => $request->dni,
                    'ciudad' => $request->ciudad,
                    'localidad' => $request->localidad,
                    'formacion' => $request->formacion,
                    'nombre_curso' => $request->nombre_curso,
                    'description' => $request->description,
                    'referencia_laboral' => $request->referencia_laboral,
                    'referencia_rubro' => $request->referencia_rubro,
                    'referencia_actividad' => $request->referencia_actividad,
                    'contratista' => $request->contratista,
                    'referencia_telefonica' => $request->referencia_telefonica,
                    'cud' => $request->cud,
                    'dependencia' => $request->dependencia,
                    'cv_path' => $cvPath,

                ];
                Empleo::create($empleoData);
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
