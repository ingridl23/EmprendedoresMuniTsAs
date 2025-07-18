<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\constants;
use Database\Factories\NoticiasFactory;


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
        'imagen'
    ];

    /*
    public static function showNoticias()
    {
        $noticias = Noticias::all();
        if (count($noticias) > constants::VALORMIN) {
            return $noticias;
        }
        return null;
    }
*/
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








    public static function crearNoticia($request, $path)
    {

        $noticia = Noticias::create([
            'id' => $request->id,
            //timestamps?
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'imagen' => $path,

        ]);
    }

    public static function editarNoticia($noticia)
    {
        $noticia->save();
    }

    public static function eliminarNoticia($noticia)
    {
        $noticia->delete();
    }
}
