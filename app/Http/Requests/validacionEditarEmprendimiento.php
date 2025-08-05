<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\validacionEmprendimiento;

class validacionEditarEmprendimiento extends validacionEmprendimiento
{
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
            'imagenes' => 'required|array|max:5',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'facebook'=>'nullable|string|min:1|max:100',
            'instagram'=>'nullable|string|min:1|max:100',
            'whatsapp'=>'integer|digits_between:8,11|min:1',
            'ciudad'=>'bail|required|string|min:1|max:100',
            'localidad'=>'bail|required|string',
            'calle'=>'bail|required|string|min:1|max:100',
            'altura'=>'required|integer|min:1',
        ];
    }
}