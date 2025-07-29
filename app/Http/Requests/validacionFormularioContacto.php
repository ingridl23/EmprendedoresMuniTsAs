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

        return [
            'first_name' => 'bail|required|string|min:3|max:100',
            'email' => 'required|email|max:255',
            'description' => 'bail|required|string|min:20|max:300',
            'tel' => 'numeric|digits_between:8,11',
            'oculto' => 'nullable|string' // para el campo oculto
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'El nombre es necesario',
            'description.required' => 'La descripcion es necesaria',
            'first_name.string' => 'Debe ingresar un nombre valido',
            'description.string' => 'Debe ingresar una descripcion valida',
            'description.min' => 'Debe ingresar más de 20 caracteres',
            'first_name.min' => 'Debe ingresar más de una letra',
            'first_name.max' => 'No se puede ingresar más de 100 caracteres',
            'description.max' => 'No se puede ingresar más de 300 caracteres',
            'tel.numeric' => 'Debe ingresar un número de teléfono',
            'tel.digits_between' => 'El numero de telefono debe de tener entre 8 y 11 digitos',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El formato del email es inválido.',
            'email.max' => 'El email no puede tener más de 255 caracteres.',
        ];
    }
}
