<?php


namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class validacionEmprendimiento  extends FormRequest
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
            'nombre' => 'bail|required|string|min:3|max:100',
            'descripcion' => 'bail|required|string|min:1',
            'categoria' => 'bail|required|string|min:1|max:60',

            'imagenes' => 'required|array|max:5',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048|dimensions:max_width=1920,max_height=1080',
            'facebook' => 'nullable|string|min:1|max:100',
            'instagram' => 'nullable|string|min:1|max:100',
            'whatsapp' => 'numeric|digits_between:8,11',
            'ciudad' => 'bail|required|string|min:1|max:100',
            'calle' => 'bail|required|string|min:1|max:100',
            'altura' => 'required|numeric|min:1',
            "localidad" => "required|string"
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

            'ciudad' => 'Es necesario agregar la ciudad donde se encuentra el emprendimiento',
            'localidad' => 'Es necesario agregar la localidad donde se encuentra el emprendimiento',
            'calle' => 'Es necesario agregar la calle donde se encuentra el emprendimiento',
            'altura' => 'Es necesario agregar la altura de la calle donde se encuentra el emprendimiento',
            'nombre.min' => 'El nombre debe contener al menos un caracter',
            'nombre.max' => 'El nombre no debe contener más de 100 caracteres',
        ];
    }
}
