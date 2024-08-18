<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Materiale
 *
 * @property $id
 * @property $id_cat
 * @property $nombre
 * @property $precio
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property DetalleMateriale[] $detalleMateriales
 * @property ImagenMateriale[] $imagenMateriales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Materiale extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cat', 'nombre', 'precio'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'id_cat', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleMateriales()
    {
        return $this->hasMany(\App\Models\DetalleMateriale::class, 'material_id','id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagenMateriales()
    {
        return $this->hasMany(\App\Models\ImagenMateriale::class, 'material_id','id' );
    }
    

}
