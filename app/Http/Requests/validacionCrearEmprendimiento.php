<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validacionCrearEmprendimiento extends FormRequest
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
            'categoria'=>'string|min:1|max:60',
            'nombre'=>'string|min:1|max:100',
            'descripcion'=>'string|min:1',
            'imagen'=>'image|mimes:jpeg,jpg,png',
            'instagram'=>'string|min:1|max:100',
            'facebook'=>'string|min:1|max:100',
            'whatsapp'=>'numeric|digits_between:8,11',
        ];
    }
}
