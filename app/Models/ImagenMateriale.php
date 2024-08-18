<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImagenMateriale
 *
 * @property $id
 * @property $material_id
 * @property $url
 * @property $created_at
 * @property $updated_at
 *
 * @property Materiale $materiale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ImagenMateriale extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['material_id', 'url'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materiale()
    {
        return $this->belongsTo(\App\Models\Materiale::class, 'material_id', 'id');
    }
    

}
