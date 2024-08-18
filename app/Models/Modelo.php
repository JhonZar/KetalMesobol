<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Modelo
 *
 * @property $id
 * @property $nombre
 * @property $precio
 * @property $created_at
 * @property $updated_at
 *
 * @property ImagenModelo[] $imagenModelos
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Modelo extends Model
{


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'precio'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagenModelos()
    {
        return $this->hasMany(\App\Models\ImagenModelo::class, 'modelo_id','id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(\App\Models\Producto::class, 'id', 'id_modelo');
    }
    public function imagenes()
    {
        return $this->hasMany(ImagenModelo::class);
    }
}
