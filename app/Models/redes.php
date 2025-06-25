<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Redes extends Model
{
    use HasFactory;

    protected $table = 'redes'; // tu tabla real

     protected $fillable = [
        'instagram',
        'facebook',
        'whatsapp'
    ];

 public function emprendedor(): HasOne
{
    return $this->hasOne(Emprendedor::class, 'redes_id', 'id');
}

}