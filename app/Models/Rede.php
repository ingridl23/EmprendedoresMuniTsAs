<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rede
 *
 * @property $id
 * @property $instagram
 * @property $facebook
 * @property $whatsapp
 * @property $created_at
 * @property $updated_at
 *
 * @property App\Models\Emprendedor[] $emprendedors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Rede extends Model
{


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['instagram', 'facebook', 'whatsapp'];
}
