<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $id_talla
 * @property $id_colores
 * @property $id_modelo
 * @property $nombre
 * @property $precio_estimado
 * @property $precio_vendedor
 * @property $cantidad
 * @property $descripcion
 * @property $tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property Colore $colore
 * @property Modelo $modelo
 * @property Talla $talla
 * @property Destinatario[] $destinatarios
 * @property DetalleMateriale[] $detalleMateriales
 * @property DetalleVenta[] $detalleVentas
 * @property Existencia[] $existencias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{

    use HasFactory;
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_talla',
        'id_colores',
        'id_modelo',
        'id_sucursal',
        'nombre',
        'precio_estimado',
        'precio_vendedor',
        'cantidad',
        'descripcion',
        'tipo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colore()
    {
        return $this->belongsTo(\App\Models\Colore::class, 'id_colores', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modelo()
    {
        return $this->belongsTo(\App\Models\Modelo::class, 'id_modelo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function talla()
    {
        return $this->belongsTo(\App\Models\Talla::class, 'id_talla', 'id');
    }
    /**
     * Relación con la tabla sucursales.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursal()
    {
        return $this->belongsTo(\App\Models\Sucursale::class, 'id_sucursal', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinatarios()
    {
        return $this->hasMany(\App\Models\Destinatario::class, 'id', 'id_producto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleMateriales()
    {
        return $this->hasMany(\App\Models\DetalleMateriale::class, 'producto_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleVentas()
    {
        return $this->hasMany(\App\Models\DetalleVenta::class, 'id', 'id_producto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function existencias()
    {
        return $this->hasMany(\App\Models\Existencia::class, 'id', 'id_producto');
    }
    public function getAvailableStock()
    {
        // Devuelve el valor de la columna 'cantidad' que representa el stock actual.
        return $this->cantidad;
    }

}
