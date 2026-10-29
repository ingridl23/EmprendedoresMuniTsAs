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
            'descripcion' => 'bail|required|string|min:10',
            'categoria' => 'bail|required|exists:categoria,id',
            'imagenes' => 'required|array|max:5',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:max_width=1920,max_height=1080',
            'facebook' => 'nullable|string|min:3|max:100',
            'instagram' => 'nullable|string|min:3|max:100',
            'whatsapp' => 'numeric|digits_between:8,11',
            'ciudad' => 'bail|required|string',
            'calle' => 'bail|required|string',
            'altura' => 'required|numeric|min:1',
            "localidad" => "required|string"
        ] + self::reglasHorarios();
    }

    /**
     * Reglas de los horarios del formulario (crear y editar emprendimiento).
     *
     * Los días son los que arma la vista administradores/emprendedores/form.blade.php. Las horas
     * aceptan HH:MM y también HH:MM:SS, porque al editar el input se carga con la hora de la base.
     *
     * @return array<string, string|array<int, string>>
     */
    public static function reglasHorarios(): array
    {
        // En formato array: la regex contiene "|" y en formato texto Laravel lo tomaría como separador de reglas
        $hora = ['nullable', 'regex:/^([01]\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/'];
        return [
            'horarios' => 'required|array:Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo',
            'horarios.*' => 'array',
            'horarios.*.hora_de_apertura' => $hora,
            'horarios.*.hora_de_cierre' => $hora,
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no debe superar los 100 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',

            'categoria.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
            'categoria_id' => 'required|exist:categoria_id',
            'imagenes.required' => 'Debes subir al menos una imagen.',
            'imagenes.array' => 'Las imágenes deben enviarse como un arreglo.',
            'imagenes.max' => 'No puedes subir más de 5 imágenes.',

            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Las imágenes deben estar en formato: jpeg, png, jpg, gif o webp.',
            'imagenes.*.max' => 'Cada imagen no debe pesar más de 2 MB.',
            'imagenes.*.dimensions' => 'Cada imagen debe tener un máximo de 1920px de ancho y 1080px de alto.',

            'facebook.string' => 'El enlace de Facebook debe ser un texto.',
            'facebook.min' => 'El enlace de Facebook debe tener al menos 3 caracteres.',
            'facebook.max' => 'El enlace de Facebook no debe superar los 100 caracteres.',

            'instagram.string' => 'El enlace de Instagram debe ser un texto.',
            'instagram.min' => 'El enlace de Instagram debe tener al menos 3 caracteres.',
            'instagram.max' => 'El enlace de Instagram no debe superar los 100 caracteres.',

            'whatsapp.numeric' => 'El número de WhatsApp debe contener solo números.',
            'whatsapp.digits_between' => 'El número de WhatsApp debe tener entre 8 y 11 dígitos.',

            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.string' => 'La ciudad debe ser un texto.',

            'calle.required' => 'La calle es obligatoria.',
            'calle.string' => 'La calle debe ser un texto.',

            'altura.required' => 'La altura de la calle es obligatoria.',
            'altura.numeric' => 'La altura de la calle debe ser un número.',
            'altura.min' => 'La altura de la calle debe ser mayor a 0.',

            'localidad.required' => 'La localidad es obligatoria.',
            'localidad.string' => 'La localidad debe ser un texto.',

            'horarios.required' => 'Los horarios son obligatorios.',
            'horarios.array' => 'Los horarios no tienen un formato válido.',
            'horarios.*.hora_de_apertura.regex' => 'La hora de apertura debe tener el formato HH:MM.',
            'horarios.*.hora_de_cierre.regex' => 'La hora de cierre debe tener el formato HH:MM.',
        ];
    }
}
