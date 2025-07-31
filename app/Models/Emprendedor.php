<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\constants;
use Database\Factories\EmprendedorFactory;
use Database\Factories\imagenesFactory;
use Database\Factories\HorarioFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Imagenes;
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
        return $this->hasMany(Imagenes::class);
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
        $emprendimiento = Emprendedor::with(['redes', 'direccion'])->where('emprendedor.id', $id)->get();
        if (count($emprendimiento) > constants::VALORMIN) {
            $emprendimiento = $emprendimiento[0];
            return $emprendimiento;
        }
        return null;
    }



    /////////////////////////////////////////////
    public static function obtenerCategoriasEmprendedoresAgrupados()
    {
        $categorias = Emprendedor::all()->groupBy('categoria');
        return $categorias;
    }
    public static function obtenerCategorias()
    {
        return [
            'Gastronomía',
            'Indumentaria',
            'Tecnología',
            'Servicios',
            'Artesanía',
        ];
    }

    /////////////////////////////////////////////


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
