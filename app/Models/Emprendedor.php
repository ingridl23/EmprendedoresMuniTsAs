<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Database\Factories\EmprendedorFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprendedor extends Model
{
    use HasFactory;

    protected $table = 'emprendedor'; // tu tabla real

     protected static function newFactory()
    {
        return EmprendedorFactory::new();
    }

     protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'contacto',
        'redes_id',
        'imagen'
    ];

    public function redes(): BelongsTo {
        return $this->belongsTo(Redes::class, 'redes_id', 'id');
    }

}
