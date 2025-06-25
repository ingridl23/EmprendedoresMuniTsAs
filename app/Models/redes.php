<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redes extends Model
{
    use HasFactory;

    protected $table = 'redes'; // tu tabla real

     protected $fillable = [
        'instagram',
        'facebook'
    ];

 public function emprendedor(): HasOne
{
    return $this->hasOne(Emprendedor::class, 'redes_id', 'id');
}

}