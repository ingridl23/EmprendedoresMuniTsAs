<?php


namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class validacionFormularioContacto  extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'bail|required|string|min:3|max:100',
            'asunto' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'nullable|numeric|digits_between:8,11',
            'description' => 'bail|required|string|min:20|max:300',
            'oculto' => 'nullable|string',
            'subconjuntos' => 'required',


        ];

        $subconjunto = $this->input('subconjuntos');
        if ($subconjunto === 'empresa') {

            $rules['nombre_empresa'] = 'bail|required|string|max:255';
        }

        if ($subconjunto === 'emprendedor') {

            $rules['club_emprendedor'] = 'required';
        }

        if ($subconjunto === 'busqueda de empleo') {

            $rules += [
                'edad' => 'required|numeric|between:18,35',
                'dni' => 'required|digits_between:6,8',
                'ciudad' => 'bail|required|string|min:1|max:100',
                "localidad" => "required|string",
                'formacion' => 'required',
                'referencia_laboral' => 'required|string',
                'referencia_rubro' => 'required|string',
                'referencia_actividad' => 'required|string',
                'contratista' => 'required|string',
                'referencia_telefonica' => 'required|numeric|digits_between:8,11',
                'cud' => 'required|string',
                'dependencia' => 'required|string',
                'cv' => 'required|file|mimes:pdf|max:2048',
            ];
            // Si formación es "curso", se requiere nombre del curso
            if ($this->input('formacion') === 'curso') {
                $rules['nombre_curso'] = 'required|string';
            }
        }
        return $rules;
    }




    //  $subconjunto = $this->input('subconjuntos');
    /*
        // Comunes a todos menos "busqueda de empleo"
        if ($subconjunto === 'empresa' || $subconjunto === 'emprendedor') {
            $rules['description'] = 'required|string|min:20|max:300';
        }
*/
    // Si es búsqueda de empleo, se piden más campos
    /*     if ($subconjunto === 'busqueda de empleo') {
            $rules += [
                'edad' => 'required|numeric|between:18,50',
                'dni' => 'required|digits_between:6,8',
                'ciudad' => 'required',
                'localidad' => 'required',
                'description' => 'required|string|min:20|max:300',
                'cv' => 'required|file|mimes:pdf|max:2048',
                'formacion' => 'required',
                'referencia_laboral' => 'required|string',
                'referencia_rubro' => 'required|string',
                'referencia_actividad' => 'required|string',
                'contratista' => 'required|string',
                'referencia_telefonica' => 'required|numeric|digits_between:8,11',
                'cud' => 'required|string',
                'dependencia' => 'required|string',
            ];

            // Si formación es "curso", se requiere nombre del curso
            if ($this->input('formacion') === 'curso') {
                $rules['nombre_curso'] = 'required|string';
            }
        }

        return $rules;
    }

*/



    public function messages()
    {
        return [
            'first_name.required' => 'El nombre es necesario',
            'first_name.string' => 'Debe ingresar un nombre válido',
            'first_name.min' => 'Debe ingresar más de una letra',
            'first_name.max' => 'No se puede ingresar más de 100 caracteres',

            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El formato del email es inválido.',
            'email.max' => 'El email no puede tener más de 255 caracteres.',

            'description.required' => 'La descripción es necesaria',
            'description.string' => 'Debe ingresar una descripción válida',
            'description.min' => 'Debe ingresar más de 20 caracteres',
            'description.max' => 'No se puede ingresar más de 300 caracteres',

            'tel.numeric' => 'Debe ingresar un número de teléfono válido',
            'tel.digits_between' => 'El número de teléfono debe tener entre 8 y 11 dígitos',

            'subconjuntos.required' => 'Debe seleccionar una opción',
            'asunto.required' => 'Debe completar el campo asunto.',
            'asunto.string' => 'El asunto debe ser una cadena de texto válida.',

            'cv.required' => 'Debe subir su currículum en formato PDF.',
            'cv.file' => 'El archivo debe ser válido.',
            'cv.mimes' => 'Solo se acepta formato PDF.',
            'cv.max' => 'El archivo no debe superar los 2 MB.',

            'edad.required' => 'Debe indicar su edad.',
            'edad.numeric' => 'La edad debe ser un número.',
            'edad.between' => 'La edad debe estar entre 18 y 35 años.',

            'dni.required' => 'Debe ingresar su DNI.',
            'dni.numeric' => 'El DNI debe ser numérico.',
            'dni.min' => 'El DNI debe tener al menos 6 cifras.',

            'formacion.required' => 'Debe indicar su nivel de formación.',
            'nombre_curso.required' => 'Debe indicar el nombre del curso.',

            'referencia_laboral.required' => 'Debe completar la referencia laboral.',
            'referencia_rubro.required' => 'Debe completar el rubro.',
            'referencia_actividad.required' => 'Debe completar la actividad.',
            'contratista.required' => 'Debe completar el campo contratista.',
            'referencia_telefonica.required' => 'Debe ingresar un teléfono de referencia.',
            'referencia_telefonica.numeric' => 'El teléfono debe ser numérico.',
            'referencia_telefonica.digits_between' => 'Debe tener entre 8 y 11 dígitos.',
            'cud.required' => 'Debe completar el campo CUD.',
            'dependencia.required' => 'Debe completar el campo dependencia.',
            'club_emprendedor.required' => 'Debe seleccionar una opcion.',
        ];
    }
}
