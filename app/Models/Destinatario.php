<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Destinatario
 *
 * @property $id
 * @property $id_pedido
 * @property $id_cliente
 * @property $id_producto
 * @property $cantidad
 * @property $fecha_Entrega
 * @property $id_talla
 * @property $obs
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Pedido $pedido
 * @property Producto $producto
 * @property Talla $talla
 * @property HistorialEstado[] $historialEstados
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Destinatario extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_pedido', 'id_cliente', 'id_producto', 'cantidad', 'fecha_Entrega', 'id_talla', 'obs'];


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
    public function pedido()
    {
        return $this->belongsTo(\App\Models\Pedido::class, 'id_pedido', 'id');
    }
    
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
    public function talla()
    {
        return $this->belongsTo(\App\Models\Talla::class, 'id_talla', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historialEstados()
    {
        return $this->hasMany(\App\Models\HistorialEstado::class, 'id_destinatario','id', );
    }
    
    
    public function getUltimoEstadoAttribute()
    {
        $ultimoHistorial = $this->historialEstados()->orderBy('created_at', 'desc')->first();
        return $ultimoHistorial ? $ultimoHistorial->estado->nombre : 'Sin estado';
    }
    public function getEstadosDisponiblesAttribute()
    {
        $estadosRegistrados = $this->historialEstados()->pluck('id_estado')->toArray();
        return Estado::whereNotIn('id', $estadosRegistrados)->get();
    }
}
