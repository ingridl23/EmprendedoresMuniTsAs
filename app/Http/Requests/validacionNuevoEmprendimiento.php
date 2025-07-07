<?php

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class validacionNuevoEmprendimiento extends FormRequest
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
    public function rules(Request $request)
    {



        if ($request->filled('oculto')) {
            return back()->with("error", "formulario rechazado posible bot detectado"); // posible bot detectado
        }
        $validated = $request->validate([

            'first_name' => ['bail|required|string|min:1|max:100'],
            'description' => ['bail|required|string|min:1'],
            'category' => ['bail|required|string|min:1|max:60'],
            'image' => ['bail|required|image|mimes:jpeg,jpg,png,webp'],
            'facebook' => ['nullable|string|min:1|max:100'],
            'instagram' => ['nullable|string|min:1|max:100'],
            'whatsapp' => ['numeric|digits_between:8,11'],
            'city' => ['bail|required|string|min:1|max:100'],
            'calle' => ['bail|required|string|min:1|max:100'],
            'address' => ['required|numeric|min:1'],
            "localidad" => ["required|string|min:9|max:25"]
        ]);

        //  Mail::to('ingridmilagrosledesma@gmail.com')->send(new sendContactForm($request->all()));



        return back()->with('success', ' Se agrega un emprendedor correctamente.');
    }
    public function messages()
    {
        return [
            'first_name.required' => 'El nombre es necesario',
            'description.required' => 'La descripcion es necesaria',
            'category.required' => 'La categoria es necesaria',
            'image.required' => 'La imagen es necesaria',
            'first_name' => 'bail|required|string|min:1|max:100',
            'first_name.string' => 'Debe ingresar un nombre valido',
            'description.string' => 'Debe ingresar una descripcion valida',
            'image.mimes' => 'El formato de la imagen debe de ser en: jpeg,jpg,png,webp',
            'whatsapp.numeric' => 'Debe ingresar un número de teléfono',
            'whatsapp.digits_between' => 'El numero de telefono debe de tener entre 8 y 11 digitos',
            'city' => 'Es necesario agregar la ciudad donde se encuentra el emprendimiento',
            'localidad' => 'Es necesario agregar la localidad donde se encuentra el emprendimiento',
            'calle' => 'Es necesario agregar la calle donde se encuentra el emprendimiento',
            'adress' => 'Es necesario agregar la altura de la calle donde se encuentra el emprendimiento'
        ];
    }
}
