<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\validacionFormularioContacto;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendContactForm;
use App\Models\Empleo;
use Illuminate\Support\Facades\Validator;


class FormSerParteController extends Controller
{



    public function formarparte()
    {
        return view("emprendedor.formulario");
    }



    public function enviar(validacionFormularioContacto $request)
    {
        if ($request->filled('oculto')) {
            return back()->with("error", "Formulario rechazado")->withInput();
        }

        try {
            $cvPath = null;
            $subconjunto = $request->subconjuntos;
            $data = []; // valor por defecto

            if ($subconjunto === 'busqueda de empleo') {
                // Subir el archivo CV si está presente
                if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
                    $cvPath = $request->file('cv')->store('cvs', 'public');
                } else {
                    return back()->withErrors(['cv' => 'Archivo de currículum inválido'])->withInput();
                }

                // Guardar en la base de datos
                $empleoData = [
                    'nombre' => $request->first_name,
                    'asunto' => $request->asunto,
                    'email' => $request->email,
                    'telefono' => $request->tel,
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
                    'cud' => filter_var($request->cud, FILTER_VALIDATE_BOOLEAN) ? 1 : 0,
                    'dependencia' => filter_var($request->dependencia, FILTER_VALIDATE_BOOLEAN) ? 1 : 0,
                    'cv_path' => $cvPath,
                ];

                Empleo::create($empleoData);


                // Preparar datos para enviar por correo si es busqueda de empleo
                $data = $request->except('cv');
                $data['cv'] = $request->file('cv');
            }
            // ========== EMPRENDEDOR ==========
            elseif ($subconjunto === 'emprendedor') {

                $data =  $request->all();
            }
            // ========== EMPRESA ==========
            elseif ($subconjunto === 'empresa') {

                $data =  $request->all();
            }


            // Enviar correo en todos los casos
            Mail::to('oficina.empleo@tresarroyos.gov.ar')->send(new sendContactForm($data));

            return back()->with('success', 'Formulario enviado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al enviar el formulario: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al enviar el formulario.');
        }
    }
}
