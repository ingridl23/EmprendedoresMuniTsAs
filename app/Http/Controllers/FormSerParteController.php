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
                    'tel' => $request->tel,
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
                    'cv' => $cvPath,
                ];

                Empleo::create($empleoData);
            }
            // ========== EMPRENDEDOR ==========
            elseif ($subconjunto === 'emprendedor') {
                // Acá podrías guardar en otra tabla si quisieras
                Log::info('Formulario de emprendedor recibido.');
            }

            // ========== EMPRESA ==========
            elseif ($subconjunto === 'empresa') {
                // Acá también podrías guardar en otra tabla si lo necesitás
                Log::info('Formulario de empresa recibido.');
            }


            // Preparar datos para enviar por correo
            $data = $request->except('cv');
            $data['cv'] = $subconjunto === 'busqueda de empleo' ? $request->file('cv') : null;

            // Enviar correo en todos los casos

            Mail::to('oficina.empleo@tresarroyos.gov.ar')->send(new sendContactForm($data));

            return back()->with('success', 'Formulario enviado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al enviar el formulario: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al enviar el formulario.');
        }
    }
}
/*

    public function enviar(validacionFormularioContacto $request)
    {

        //   dd($request->all());
        //  dd($request->file('cv'));





        if ($request->filled('oculto')) {
            return back()->with("error", "formulario rechazado")->withInput();
        }
        if ($request->subconjuntos === 'busqueda de empleo' && !$request->hasFile('cv')) {
            return back()
                ->withErrors(['cv' => 'Debe subir su currículum.'])
                ->withInput();
        }
        try {
            $cvPath = null;

            if ($request->subconjuntos === 'busqueda de empleo') {
                if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
                    $cvPath = $request->file('cv')->store('cvs', 'public');
                } else {
                    return back()->withErrors(['cv' => 'Archivo de currículum inválido'])->withInput();
                }

             if($request->subconjuntos === "empresa"){

             }
                $empleoData = [
                    'nombre' => $request->first_name,
                    'asunto' => $request->asunto,
                    'email' => $request->email,
                    'tel' => $request->tel,
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
                    'cud' => filter_var($request->cud, FILTER_VALIDATE_BOOLEAN) ? 1 : 0,  //convierte los valores true o false en 0 o 1 para almacenar en la tabla de la bbdd
                    'dependencia' => filter_var($request->dependencia, FILTER_VALIDATE_BOOLEAN) ? 1 : 0,
                    'cv' => $cvPath,

                ];
                Empleo::create($empleoData);
            }





            $data = $request->except('cv'); // todos los datos menos el archivo
            $data['cv'] = $request->file('cv'); // agregás el archivo (UploadedFile)
            Log::info('Enviando mail con datos:', $data);
            Mail::to('oficina.empleo@tresarroyos.gov.ar')->send(new sendContactForm($data));
            return back()->with('success', 'Formulario enviado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al enviar el formulario: ' . $e->getMessage());
            dd($e->getMessage());
            return back()->with('error', 'Ocurrió un error al enviar el formulario verifique su conexion.');
        }
    }
}
*/
