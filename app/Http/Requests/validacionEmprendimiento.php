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

    public function store(Request $request){
         if ($request->filled('oculto')) {
            return back()->with("error", "formulario rechazado posible bot detectado"); // posible bot detectado
        }

        $this->validate($request, $this->rules());
        return back()->with('success', ' Se agrega un emprendedor correctamente.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){

        return [
            'nombre' => 'bail|required|string|min:1|max:100',
            'descripcion' => 'bail|required|string|min:1',
            'categoria' => 'bail|required|string|min:1|max:60',
            'imagen' => 'bail|required|image|mimes:jpeg,jpg,png,webp',
            'facebook' => 'nullable|string|min:1|max:100',
            'instagram' => 'nullable|string|min:1|max:100',
            'whatsapp' => 'numeric|digits_between:8,11',
            'ciudad' => 'bail|required|string|min:1|max:100',
            'calle' => 'bail|required|string|min:1|max:100',
            'altura' => 'required|numeric|min:1',
            "localidad" =>"required|string|min:9|max:25"
        ];

        
        //  Mail::to('ingridmilagrosledesma@gmail.com')->send(new sendContactForm($request->all()));
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
            'altura' => 'Es necesario agregar la altura de la calle donde se encuentra el emprendimiento'
        ];
    }
}
