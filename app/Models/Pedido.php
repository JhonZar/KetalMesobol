<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property $id
 * @property $id_cliente
 * @property $id_usuario
 * @property $id_sucursal
 * @property $precioTotal
 * @property $pagoACuenta
 * @property $saldo
 * @property $fecha
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Sucursale $sucursale
 * @property Usuario $usuario
 * @property Destinatario[] $destinatarios
 * @property DetalleVenta[] $detalleVentas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pedido extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cliente', 'id_usuario', 'id_sucursal', 'precioTotal', 'pagoACuenta', 'saldo', 'fecha', 'estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'id_cliente', 'id');
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
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinatarios()
    {
        return $this->hasMany(\App\Models\Destinatario::class, 'id_pedido','id' );
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleVentas()
    {
        return $this->hasMany(\App\Models\DetalleVenta::class, 'id_pedido','id' );
    }
    

}
