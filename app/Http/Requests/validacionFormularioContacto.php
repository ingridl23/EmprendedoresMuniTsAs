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
            'email' => 'required|email|max:255',
            'tel' => 'nullable|numeric|digits_between:8,11',
            'oculto' => 'nullable|string',
            'subconjuntos' => 'required',
            'asunto' => 'required|string|max:100',
            'ciudad' => 'required',
            'localidad' => 'required',
        ];

        $subconjunto = $this->input('subconjuntos');

        // Comunes a todos menos "busqueda de empleo"
        if ($subconjunto === 'empresa' || $subconjunto === 'emprendedor') {
            $rules['description'] = 'required|string|min:20|max:300';
        }

        // Si es búsqueda de empleo, se piden más campos
        if ($subconjunto === 'busqueda de empleo') {
            $rules += [
                'description' => 'required|string|min:20|max:300',
                'cv' => 'required|file|mimes:pdf|max:2048',
                'edad' => 'required|numeric|between:10,15',
                'dni' => 'required|numeric|min:100000',
                'formacion' => 'required',
                'referencia-laboral' => 'required|string',
                'referencia-rubro' => 'required|string',
                'referencia-actividad' => 'required|string',
                'contratista' => 'required|string',
                'referencia-telefonica' => 'required|numeric|digits_between:8,11',
                'cud' => 'required|string',
                'dependencia' => 'required|string',
            ];

            // Si formación es "curso", se requiere nombre del curso
            if ($this->input('formacion') === 'curso') {
                $rules['nombre-curso'] = 'required|string';
            }
        }

        return $rules;
    }





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
            'edad.between' => 'La edad debe estar entre 10 y 15 años.',

            'dni.required' => 'Debe ingresar su DNI.',
            'dni.numeric' => 'El DNI debe ser numérico.',
            'dni.min' => 'El DNI debe tener al menos 6 cifras.',

            'formacion.required' => 'Debe indicar su nivel de formación.',
            'nombre-curso.required' => 'Debe indicar el nombre del curso.',

            'referencia-laboral.required' => 'Debe completar la referencia laboral.',
            'referencia-rubro.required' => 'Debe completar el rubro.',
            'referencia-actividad.required' => 'Debe completar la actividad.',
            'contratista.required' => 'Debe completar el campo contratista.',
            'referencia-telefonica.required' => 'Debe ingresar un teléfono de referencia.',
            'referencia-telefonica.numeric' => 'El teléfono debe ser numérico.',
            'referencia-telefonica.digits_between' => 'Debe tener entre 8 y 11 dígitos.',
            'cud.required' => 'Debe completar el campo CUD.',
            'dependencia.required' => 'Debe completar el campo dependencia.',
        ];
    }
}
