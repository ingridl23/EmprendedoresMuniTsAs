<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validacionEditarEmprendimiento extends FormRequest
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
            'imagen'=>'image|mimes:jpeg,jpg,png',
            'facebook'=>'nullable|string|min:1|max:100',
            'instagram'=>'nullable|string|min:1|max:100',
            'whatsapp'=>'integer|digits_between:8,11|min:1',
            'ciudad'=>'bail|required|string|min:1|max:100',
            'localidad'=>'bail|required|string',
            'calle'=>'bail|required|string|min:1|max:100',
            'altura'=>'required|integer|min:1',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es necesario',
            'descripcion.required' => 'La descripcion es necesaria',
            'categoria.required' => 'La categoria es necesaria',
            'imagen.required' => 'La imagen es necesaria',
            'nombre.string' => 'Debe ingresar un nombre valido',
            'descripcion.string' => 'Debe ingresar una descripcion valida',
            'imagen.mimes' => 'El formato de la imagen debe de ser en: jpeg,jpg,png,webp',
            'whatsapp.numeric' => 'Debe ingresar un número de teléfono',
            'whatsapp.digits_between' => 'El numero de telefono debe de tener entre 8 y 11 digitos',
            'ciudad' => 'Es necesario agregar la ciudad donde se encuentra el emprendimiento',
            'localidad' => 'Es necesario agregar la localidad donde se encuentra el emprendimiento',
            'calle' => 'Es necesario agregar la calle donde se encuentra el emprendimiento',
            'altura' => 'Es necesario agregar la altura de la calle donde se encuentra el emprendimiento',
            'nombre.min' => 'El nombre debe contener al menos un caracter',
            'nombre.max' => 'El nombre no debe contener más de 100 caracteres',
        ];
    }
}