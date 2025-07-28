<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\constants;
use Database\Factories\EmprendedorFactory;
use Database\Factories\imagenFactory;
use Database\Factories\HorarioFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Imagen;
use App\Models\Horario;

/**
 * Class Emprendedor
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $categoria
 * @property $redes_id
 * @property $horario_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Emprendedor extends Model
{
    protected $perPage = 20;
    protected $table = 'emprendedor'; // tu tabla real

    protected static function newFactory()
    {
        return EmprendedorFactory::new();
    }
    use HasFactory;



    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'redes_id',
        'direccion_id',
        'horario_id'
    ];

    public function redes(): BelongsTo
    {
        return $this->belongsTo(redes::class, 'redes_id', 'id');
    }

    public function direccion(): BelongsTo
    {
        return $this->belongsTo(direccion::class, 'direccion_id', 'id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    ////////////////////////////////////////////
    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    public static function showEmprendimientos()
    {
        //$emprendimientos = emprendedores::select(['id', 'nombre', 'descripcion', 'imagen', 'categoria'])->get();
        $emprendimientos = Emprendedor::all();
        if (count($emprendimientos) > constants::VALORMIN) {
            return $emprendimientos;
        }
        return null;
    }

    public static function showEmprendimientoId($id)
    {
        $emprendimiento = Emprendedor::with(['redes', 'direccion', 'horario_id '])->where('emprendedor.id', $id)->get();
        if (count($emprendimiento) > constants::VALORMIN) {
            $emprendimiento = $emprendimiento[0];
            return $emprendimiento;
        }
        return null;
    }



    /////////////////////////////////////////////
    public static function obtenerCategorias()
    {
        $categorias = Emprendedor::all()->groupBy('categoria');
        return $categorias;
    }
    /////////////////////////////////////////////
    public  static function crearEmprendimiento($request, $path)
    {
        $idRedes = redes::crearRedes($request->instagram, $request->facebook, $request->whatsapp);

        $idDireccion = direccion::crearDireccion($request->ciudad, $request->localidad, $request->calle, $request->altura);

        $emprendimiento = Emprendedor::create([

            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,

            'redes_id' => $idRedes,
            'direccion_id' => $idDireccion,

        ]);
        // Luego creamos el horario con el ID del emprendedor
        horario::crearHorario(
            $request->dia,
            $request->hora_de_apertura,
            $request->hora_de_cierre,
            $request->participa_feria,
            $request->cerrado,
            $emprendimiento->id
        );
        //  Guardar las imágenes (vienen en el form)
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $archivo) {
                $path = $archivo->store('img', 'public'); // guarda en /app/public/storage/img/
                $emprendimiento->imagenes()->create([
                    'url' => $path
                ]);
            }
        }

        return $emprendimiento;
    }

    public static function editarEmprendimiento($emprendimiento)
    {
        $emprendimiento->save();
    }

    public static function eliminarEmprendimiento($emprendimiento)
    {
        $emprendimiento->delete();
    }


    public static function traerAleatoriamenteSeis()
    {
        return Emprendedor::with('imagenes') // traer las imágenes asociadas
            ->inRandomOrder()
            ->limit(6)
            ->get();
    }



    //traer ultimos 6 emprendedores
    /*  public static function ultimosEmprendedores($cantidad = 6)
    {
        return Emprendedor::with('imagenes') //  esto trae las imágenes relacionadas
            ->orderBy('created_at', 'desc')
            ->limit($cantidad)
            ->get();
    }*/
}
