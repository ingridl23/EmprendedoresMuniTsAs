<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\constants;
use Database\Factories\NoticiasFactory;
use Illuminate\Support\Str;


/**
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $nombre
 * @property $descripcion
 * @property $categoria
 * @property $imagen
 *  * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Noticias extends Model
{
    protected $perPage = 10;
    protected $table = "noticias";

    protected static function newFactory()
    {
        return NoticiasFactory::new();
    }
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'imagen',
        'imagen_public_id'
    ];


    public static function getUltimasNoticias($cantidad = 10)
    {
        return Noticias::orderBy('created_at', 'desc')
            ->paginate($cantidad);
    }


    public static function showNoticiasId($id)
    {
        $noticia = Noticias::where('noticias.id', $id)->get();
        if (count($noticia) > constants::VALORMIN) {
            $noticia = $noticia[0];
            return $noticia;
        }
    }
    public static function obtenerCategoriasNoticias($cantidad = 10)
    {

        return Noticias::with(['categoria']) // relacion
            ->orderBy('created_at', 'desc')
            ->take($cantidad)
            ->get();
    }

    
    public static function obtenerNoticiasCategorias()
    {
        $categorias = Noticias::all()->groupBy("categoria");
        return $categorias;
    }

     /**
     * Obtiene las categorias cargadas 
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

    public static function editNoticia($noticia)
    {
        $noticia->save();
    }

    public static function deleteNoticia($noticia)
    {
        $eliminado=$noticia->delete();
        return $eliminado;
    }

    public static function editarImagen($noticia, $url, $imagen_public_id){
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
