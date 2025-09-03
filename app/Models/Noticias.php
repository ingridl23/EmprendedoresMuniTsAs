<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\constants;
use Database\Factories\NoticiasFactory;
use Illuminate\Support\Str;


/**
 * @class Noticias
 * Representa una noticia dentro del sistema.
 *
 * @package App\Models
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $nombre
 * @property $descripcion
 * @property $categoria
 * @property $imagen
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Noticias extends Model
{
    protected $perPage = 10;

    /** @var string $table Nombre de la tabla asociada */
    protected $table = "noticias";

    protected static function newFactory()
    {
        return NoticiasFactory::new();
    }
    use HasFactory;
    /** @var array $fillable Campos asignables en masa */
    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'imagen',
        'imagen_public_id'
    ];




    /**
     * Obtener las ultimas publicaciones registradas en el sistema:
     * @param int $cantidad
     * @return \Illuminate\Database\Eloquent\Collection , devuelve una coleccion limitada de publicaciones segun la query solicitada (atributo cantidad)
     */
    public static function getUltimasNoticias($cantidad = 10)
    {
        return Noticias::orderBy('created_at', 'desc')
            ->paginate($cantidad);
    }


    /**
     * Busqueda de una publicacion vigente en el sistema:
     *@param mixed $id, ID de identificacion para la publicacion seleccionada
     * @return \Illuminate\Database\Eloquent\Collection , devuelve la coleccion encontrada de publicaciones.
     */

    public static function showNoticiasId($id)
    {
        $noticia = Noticias::where('noticias.id', $id)->get();
        if (count($noticia) > constants::VALORMIN) {
            $noticia = $noticia[0];
            return $noticia;
        }
    }


    /**
     * Obtener todas las categorías de publicaciones registradas en el sistema:
     *@param int $cantidad
     * @return \Illuminate\Database\Eloquent\Collection , devuelve una coleccion limitada de publicaciones segun criterio de la query(atributo cantidad).
     */

    public static function obtenerCategoriasNoticias($cantidad = 10)
    {

        return Noticias::with(['categoria']) // relacion
            ->orderBy('created_at', 'desc')
            ->take($cantidad)
            ->get();
    }


    /**
     * Obtener todas las categorías de publicaciones registradas en el sistema:
     *
     * @return \Illuminate\Database\Eloquent\Collection , devuelve una coleccion completa de publicaciones segun criterio de la query.
     */
    public static function obtenerNoticiasCategorias()
    {
        $categorias = Noticias::all()->groupBy("categoria");
        return $categorias;
    }

    /**
     * Obtener las categorias cargadas:
     *
     * @return Array, Categorias cargadas
     */
    public static function obtenerCategorias()
    {
        return [
            'Bolsa De Empleo',
            'Evento',

        ];
    }



    /**
     *  Dar de alta publicaciones:
     *
     *Una vez validados los datos del formulario se persisten en el sistema,asociado por la categoria a la que pertenece.
     *
     * @param mixed $request
     * @param string $path
     * @param int $imagen_public_id
     * @return Response , devuelve una publicacion junto a sus datos
     * @throws \Exception Si ocurre un error al persistir los datos en el sistema.
     */



    public static function createNoticia($request, $path, $imagen_public_id)
    {
        $noticia = Noticias::create([
            'titulo' => $request->titulo,
            'categoria' => Str::ucfirst($request->categoria),
            'descripcion' => Str::ucfirst($request->descripcion),
            'imagen' => $path,
            'imagen_public_id' => $imagen_public_id,
            'created_at' => date('m-d-Y G:i:s'),
            'updated_at' => date('m-d-Y G:i:s'),
        ]);
        return $noticia;
    }


    /**
     * Modificar una publicacion en el sistema:
     *@param  mixed $noticia, publicacion selecionada para modificar.
     * @return Response , devuelve la publicacion modificada.
     */

    public static function editNoticia($noticia)
    {
        $noticia->save();
    }
    /**
     * Dar de baja una publicacion en el sistema:
     *@param  mixed $noticia, publicacion selecionada para eliminar.
     * @return Response , devuelve la publicacion eliminada.
     */

    public static function deleteNoticia($noticia)
    {
        $eliminado = $noticia->delete();
        return $eliminado;
    }


    /**
     * Modificar una publicacion en el sistema en relacion a su imagen asociada:
     * @param string $url
     * @param int $imagen_public_id
     *@param  mixed $noticia, publicacion selecionada para modificar.
     * @return Response , devuelve la imagen modificada de una publicacion asociada.
     */
    public static function editarImagen($noticia, $url, $imagen_public_id)
    {
        $noticia->imagen = $url;
        $noticia->imagen_public_id = $imagen_public_id;
        $noticiaEdit = $noticia->save();
        /*$noticia = $noticia->update([
            'imagen' => $url,
            'imagen_public_id' => $imagen_public_id,
        ]);*/
        return $noticiaEdit;
    }
}
