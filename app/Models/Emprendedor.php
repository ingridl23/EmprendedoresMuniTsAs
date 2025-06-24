<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprendedor extends Model
{
    use HasFactory;

    protected $table = 'emprendedor';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'redes_id', // asegurate que esta columna exista en tu tabla
        // agregá acá otros campos si tu tabla tiene más
    ];

    /**
     * Relación con el modelo Redes
     * Un emprendedor pertenece a una red
     */
    public function redes()
    {
        return $this->belongsTo(Redes::class, 'redes_id', 'id');
    }
}
