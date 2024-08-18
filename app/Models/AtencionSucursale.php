<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AtencionSucursale
 *
 * @property $id
 * @property $id_usuario
 * @property $id_sucursal
 * @property $fechaInicio
 * @property $fechaFin
 * @property $created_at
 * @property $updated_at
 *
 * @property Sucursale $sucursale
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AtencionSucursale extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_usuario', 'id_sucursal', 'fechaInicio', 'fechaFin'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursale()
    {
        return $this->belongsTo(\App\Models\Sucursale::class, 'id_sucursal', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'id_usuario', 'id');
    }
    

}
