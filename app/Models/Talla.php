<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Talla
 *
 * @property $id
 * @property $talla
 * @property $genero
 * @property $created_at
 * @property $updated_at
 *
 * @property Destinatario[] $destinatarios
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Talla extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['talla', 'genero'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinatarios()
    {
        return $this->hasMany(\App\Models\Destinatario::class, 'id', 'id_talla');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(\App\Models\Producto::class, 'id', 'id_talla');
    }
    

}
