<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 *
 * @property $id
 * @property $id_rol
 * @property $nombre
 * @property $contra
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Role $role
 * @property AtencionSucursale[] $atencionSucursales
 * @property Existencia[] $existencias
 * @property HistorialEstado[] $historialEstados
 * @property Pedido[] $pedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Usuario extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_rol', 'nombre', 'contra', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'id_rol', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function atencionSucursales()
    {
        return $this->hasMany(\App\Models\AtencionSucursale::class, 'id', 'id_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function existencias()
    {
        return $this->hasMany(\App\Models\Existencia::class, 'id', 'id_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historialEstados()
    {
        return $this->hasMany(\App\Models\HistorialEstado::class, 'id', 'id_usuarios');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany(\App\Models\Pedido::class, 'id', 'id_usuario');
    }

    public function getAuthPassword()
    {
        return $this->contra;
    }
}
