<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\constants;
use Database\Factories\EmprendedorFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Emprendedor
 *
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $categoria
 * @property $redes_id
 * @property $imagen
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Emprendedor extends Model
{
    protected $perPage = 20;
    protected $table = 'emprendedores'; // tu tabla real

    protected static function newFactory()
    {
        return EmprendedorFactory::new();
    }
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'imagen',
        'redes_id',
    ];

    public function redes(): BelongsTo
    {
        return $this->belongsTo(Redes::class, 'redes_id', 'id');
    }

    public static function showEmprendimientos()
    {
        $emprendimientos = emprendedores::select(['id', 'nombre', 'descripcion', 'imagen'])->get();
        if (count($emprendimientos) > constants::VALORMIN) {
            return $emprendimientos;
        }
        return null;
    }

    public static function showEmprendimientoId($id)
    {
        $emprendimiento = emprendedores::join('redes', 'redes_id', '=', 'redes.id')->where('emprendedores.id', $id)->get();
        if (count($emprendimiento) > constants::VALORMIN) {
            $emprendimiento = $emprendimiento[0];
            return $emprendimiento;
        }
        return null;
    }

    public static function crearEmprendimiento($request, $path)
    {
        $redes = redes::create([
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
        ]);
        $emprendimiento = emprendedores::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'imagen' => $path,
            'redes_id' => $redes->id,
        ]);
    }

    public static function editarEmprendimiento($emprendimiento)
    {
        $emprendimiento->save();
    }

    public static function eliminarEmprendimiento($emprendimiento)
    {
        $emprendimiento->delete();
    }
}
