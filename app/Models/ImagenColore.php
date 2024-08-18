<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImagenColore
 *
 * @property $id
 * @property $color_id
 * @property $url
 * @property $created_at
 * @property $updated_at
 *
 * @property Colore $colore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ImagenColore extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['color_id', 'url'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colore()
    {
        return $this->belongsTo(\App\Models\Colore::class, 'color_id', 'id');
    }
    

}
