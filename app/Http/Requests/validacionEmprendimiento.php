<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validacionEmprendimiento extends FormRequest
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
            'nombre'=>'bail|required|string|min:1|max:100',
            'descripcion'=>'bail|required|string|min:1',
            'categoria'=>'bail|required|string|min:1|max:60',
            'imagen'=>'bail|required|image|mimes:jpeg,jpg,png',
            'facebook'=>'nullable|string|min:1|max:100',
            'instagram'=>'nullable|string|min:1|max:100',
            'whatsapp'=>'numeric|digits_between:8,11',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=>'El nombre es necesario',
            'descripcion.required'=>'La descripcion es necesaria',
            'categoria.required'=>'La categoria es necesaria',
            'imagen.required'=>'La imagen es necesaria',
            'nombre'=>'bail|required|string|min:1|max:100',
            'nombre.string'=>'Debe ingresar un nombre valido',
            'descripcion.string'=>'Debe ingresar una descripcion valida',
            'imagen.mimes'=>'El formato de la imagen debe de ser en: jpeg,jpg,png',
            'whatsapp.digits_between'=>'El numero de telefono debe de tener entre 8 y 11 digitos'
        ];
    }
}
