<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Existencia
 *
 * @property $id
 * @property $id_producto
 * @property $id_usuario
 * @property $id_sucursal
 * @property $fecha
 * @property $cantidad
 * @property $tipo_Transaccion
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto $producto
 * @property Sucursale $sucursale
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Existencia extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_producto', 'id_usuario', 'id_sucursal', 'fecha', 'cantidad', 'tipo_Transaccion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class, 'id_producto', 'id');
    }
    
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
