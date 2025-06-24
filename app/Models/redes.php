<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redes extends Model
{
    use HasFactory;

    protected $table = 'redes';

    protected $fillable = [
        'nombre',
        'url',
        // otros campos si tenés
    ];

    /**
     * Relación con el modelo Emprendedor
     * Una red puede tener muchos emprendedores
     */
    public function emprendedores()
    {
        return $this->hasMany(Emprendedor::class, 'redes_id', 'id');
    }
}
