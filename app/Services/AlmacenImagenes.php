<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Guarda las imágenes nuevas en el servidor (public/imagenes) y borra tanto
 * las locales como las viejas que siguen alojadas en Cloudinary.
 */
class AlmacenImagenes
{
    /** Prefijo del public_id de las imágenes guardadas en el servidor. */
    public const PREFIJO_LOCAL = 'local:';

    /**
     * Guarda la imagen en public/imagenes/{carpeta} con un nombre aleatorio.
     *
     * @return array{url: string, public_id: string}
     * @throws \RuntimeException Si no se pudo guardar el archivo.
     */
    public static function guardar(UploadedFile $archivo, string $carpeta): array
    {
        $ruta = $archivo->store($carpeta, 'imagenes');
        if ($ruta === false) {
            throw new \RuntimeException('No se pudo guardar la imagen.');
        }

        return [
             'url' => '/imagenes/' . $ruta,
            'public_id' => self::PREFIJO_LOCAL . $ruta,
        ];
    }

    /**
     * Borra la imagen: del servidor si es local, de Cloudinary si es una imagen vieja.
     */
    public static function eliminar(?string $publicId): void
    {
        if ($publicId === null || $publicId === '') {
            return;
        }

        if (str_starts_with($publicId, self::PREFIJO_LOCAL)) {
            Storage::disk('imagenes')->delete(substr($publicId, strlen(self::PREFIJO_LOCAL)));
            return;
        }

        Cloudinary::uploadApi()->destroy($publicId);
    }
}
