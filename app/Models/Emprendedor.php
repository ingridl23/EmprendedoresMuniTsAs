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
use App\Models\categoria;

/**
 * @class Emprendedor
 * Representa una emprendedor dentro del sistema.
 *
 * @package App\Models
 * @property $id
 * @property $nombre
 * @property $descripcion
 * @property $categoria_id
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
    /** @var string $table Nombre de la tabla asociada */
    protected $table = 'emprendedor'; // tu tabla real

    protected static function newFactory()
    {
        return EmprendedorFactory::new();
    }
    use HasFactory;



    /** @var array $fillable Campos asignables en masa */
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
        'redes_id',
        'direccion_id',
    ];



    /**
     * Relación: un emprendedor puede tener varias redes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function redes(): BelongsTo
    {
        return $this->belongsTo(redes::class, 'redes_id', 'id');
    }

    /**
     * Relación: un emprendedor puede tener una direccion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */

    public function direccion(): BelongsTo
    {
        return $this->belongsTo(direccion::class, 'direccion_id', 'id');
    }

    /**
     * Relación: un emprendedor puede tener varios horarios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    ////////////////////////////////////////////


    /**
     * Relación: un emprendedor puede tener varias imagenes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function imagenes()
    {
        return $this->hasMany(Imagenes::class);
    }


    /**
     * Relación: un emprendedor puede pertenecer a una categoria.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }


    /**
     * Visualizar todos los emprendimientos presentes en el sistema:
     *
     * @return \Illuminate\Database\Eloquent\Collection , devuelve una coleccion de emprendimientos.
     */
    public static function showEmprendimientos()
    {
        //$emprendimientos = emprendedores::select(['id', 'nombre', 'descripcion', 'imagen', 'categoria'])->get();
        $emprendimientos = Emprendedor::all();
        if (count($emprendimientos) > constants::VALORMIN) {
            return $emprendimientos;
        }
        return null;
    }


    /**
     * Visibilizar un emprendimiento vigente en el sistema:
     *
     * Al seleccionar un emprendimiento cargado se devuelven sus datos persistidos dentro del sistema.
     *
     *
     * @param int $id, ID de identificacion para el emprendimiento seleccionado.
     *
     * @return Response, devuelve un emprendimiento seleccionado junto a sus datos.
     *  @throws \Exception Si ocurre un error al persistir datos.
     */

    public static function showEmprendimientoId($id)
    {
        $emprendimiento = Emprendedor::with(['redes', 'direccion'])->where('emprendedor.id', $id)->get();
        if (count($emprendimiento) > constants::VALORMIN) {
            $emprendimiento = $emprendimiento[0];
            return $emprendimiento;
        }
        return null;
    }

    /**
     * Obtener todas las categorías registradas para el sistema.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public static function obtenerCategoriasEmprendedoresAgrupados()
    {
        return Emprendedor::with('categoria')->get()->groupBy('categoria_id');
    }

    /* public static function obtenerCategorias()
    {
        return [
            'Gastronomía',
            'Indumentaria',
            'Tecnología',
            'Servicios',
            'Artesanía',
        ];
    }
*/
    /////////////////////////////////////////////



    /**   Modificar un emprendimiento:
     *
     * Al seleccionar un emprendimiento cargado se devuelven sus datos persistidos dentro del sistema.
     * Se valida los datos actualizados y recibidos desde el formulario y son persistidos nuevamente,
     * asociando también redes sociales, dirección, horarios e imágenes modificadas.

     * @param mixed $emprendimiento Datos  del emprendimiento.
     *
     *
     *
     * @throws \Exception Si ocurre un error al subir las imágenes a Cloudinary.
     *  @throws \Exception Si ocurre un error al persistir datos.
     */



    public static function editarEmprendimiento($emprendimiento)
    {
        $emprendimientoEdit = $emprendimiento->save();
        return $emprendimientoEdit;
    }

    /**
     * Eliminar un emprendimiento con sus redes, direccion y horarios asociados:
     *
     * @param int id, ID único del emprendimiento seleccionado.
     *  @throws \Exception Si ocurre un error al persistir datos.
     */
    public static function eliminarEmprendimiento($emprendimiento)
    {
        $emprendimientoEliminar = $emprendimiento->delete();
        return $emprendimientoEliminar;
    }

    /**
     *  Retornar ultimos 6 emprendedores:
     *
     * Esta funcionalidad retorna 6 emprendedores aleatoriamente persistidos en el sistema.
     *
     *
     * @return \Illuminate\Http\Collection redirige la informacion  retornando los ultimos emprendedores cargados aleatoriamente.
     */
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
