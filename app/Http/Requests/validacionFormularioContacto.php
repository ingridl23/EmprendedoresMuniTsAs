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

    public function store(Request $request)
    {
        if ($request->filled('oculto')) {
            return back()->with("error", "formulario rechazado "); // posible bot detectado
        }

        $this->validate($request, $this->rules());
        return back()->with('success', ' Enviado exitosamente');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'nombre-apellido' => 'bail|required|string|min:3|max:100',
            'email' => 'required|email|max:255',
            'descripcion' => 'bail|required|string|min:20|max:300',
            'telefono' => 'numeric|digits_between:8,11'
        ];
    }
    public function messages()
    {
        return [
            'nombre-apellido.required' => 'El nombre es necesario',
            'descripcion.required' => 'La descripcion es necesaria',
            'nombre-apellido.string' => 'Debe ingresar un nombre valido',
            'descripcion.string' => 'Debe ingresar una descripcion valida',
            'descripcion.min' => 'Debe ingresar más de 20 caracteres',
            'nombre-apellido.min' => 'Debe ingresar más de una letra',
            'nombre-apellido.max' => 'No se puede ingresar más de 100 caracteres',
            'descripcion.max' => 'No se puede ingresar más de 300 caracteres',
            'telefono.numeric' => 'Debe ingresar un número de teléfono',
            'telefono.digits_between' => 'El numero de telefono debe de tener entre 8 y 11 digitos',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El formato del email es inválido.',
            'email.max' => 'El email no puede tener más de 255 caracteres.',
        ];
    }
}
