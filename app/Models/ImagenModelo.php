<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImagenModelo
 *
 * @property $id
 * @property $modelo_id
 * @property $url
 * @property $created_at
 * @property $updated_at
 *
 * @property Modelo $modelo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ImagenModelo extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['modelo_id', 'url'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modelo()
    {
        return $this->belongsTo(\App\Models\Modelo::class, 'modelo_id', 'id');
    }
    

}
