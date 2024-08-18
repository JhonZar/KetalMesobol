<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HistorialEstado
 *
 * @property $id
 * @property $id_estado
 * @property $id_destinatario
 * @property $id_usuarios
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property Destinatario $destinatario
 * @property Estado $estado
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HistorialEstado extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_estado', 'id_destinatario', 'id_usuarios', 'fecha'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinatario()
    {
        return $this->belongsTo(\App\Models\Destinatario::class, 'id_destinatario', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'id_estado', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'id_usuarios', 'id');
    }
    
    
}
