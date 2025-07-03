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
        'imagen',
        'redes_id',
        'direccion_id'
    ];

    public function redes(): BelongsTo{
        return $this->belongsTo(redes::class, 'redes_id', 'id');
    }

    public function direccion(): BelongsTo{
        return $this->belongsTo(direccion::class, 'direccion_id', 'id');
    }

    public static function showEmprendimientos()
    {
        //$emprendimientos = emprendedores::select(['id', 'nombre', 'descripcion', 'imagen', 'categoria'])->get();
        $emprendimientos=emprendedores::all();
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

    public static function obtenerCategorias(){
        $categorias= Emprendedor::select(['categoria'])->distinct()->get();
        return $categorias;
    }
    public static function crearEmprendimiento($request, $path)
    {
        $idRedes = redes::crearRedes($request->instagram, $request->facebook, $request->whatsapp);  
        $idDireccion = direccion::crearDireccion($request->ciudad,$request->localidades, $request->calle,$request->altura);
        $emprendimiento = Emprendedor::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'imagen' => $path,
            'redes_id' => $idRedes,
            'direccion_id' => $idDireccion,
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
