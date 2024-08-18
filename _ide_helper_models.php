<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 * @property Sucursale $sucursale
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale query()
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale whereIdSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AtencionSucursale whereUpdatedAt($value)
 */
	class AtencionSucursale extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Categoria
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 * @property Materiale[] $materiales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $materiales_count
 * @method static \Illuminate\Database\Eloquent\Builder|Categoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|Categoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categoria whereUpdatedAt($value)
 */
	class Categoria extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Cliente
 *
 * @property $id
 * @property $nombre
 * @property $ci
 * @property $direccion
 * @property $telefono
 * @property $email
 * @property $created_at
 * @property $updated_at
 * @property Destinatario[] $destinatarios
 * @property Pedido[] $pedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $destinatarios_count
 * @property-read int|null $pedidos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereUpdatedAt($value)
 */
	class Cliente extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Colore
 *
 * @property $id
 * @property $codigo
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 * @property ImagenColore[] $imagenColores
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $imagen_colores_count
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Colore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Colore query()
 * @method static \Illuminate\Database\Eloquent\Builder|Colore whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colore whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Colore whereUpdatedAt($value)
 */
	class Colore extends \Eloquent {}
}

namespace App\Models{
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
 * @property Cliente $cliente
 * @property Pedido $pedido
 * @property Producto $producto
 * @property Talla $talla
 * @property HistorialEstado[] $historialEstados
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read mixed $estados_disponibles
 * @property-read mixed $ultimo_estado
 * @property-read int|null $historial_estados_count
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereFechaEntrega($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereIdCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereIdPedido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereIdTalla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereObs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destinatario whereUpdatedAt($value)
 */
	class Destinatario extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DetalleMateriale
 *
 * @property $id
 * @property $producto_id
 * @property $material_id
 * @property $created_at
 * @property $updated_at
 * @property Materiale $materiale
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale query()
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleMateriale whereUpdatedAt($value)
 */
	class DetalleMateriale extends \Eloquent {}
}

namespace App\Models{
/**
 * Class DetalleVenta
 *
 * @property $id
 * @property $id_pedido
 * @property $id_producto
 * @property $cantidad
 * @property $precion_unitario
 * @property $created_at
 * @property $updated_at
 * @property Pedido $pedido
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta query()
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta whereIdPedido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta wherePrecionUnitario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetalleVenta whereUpdatedAt($value)
 */
	class DetalleVenta extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Estado
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 * @property HistorialEstado[] $historialEstados
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $historial_estados_count
 * @method static \Illuminate\Database\Eloquent\Builder|Estado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Estado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Estado query()
 * @method static \Illuminate\Database\Eloquent\Builder|Estado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Estado whereUpdatedAt($value)
 */
	class Estado extends \Eloquent {}
}

namespace App\Models{
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
 * @property Producto $producto
 * @property Sucursale $sucursale
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereIdSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereTipoTransaccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Existencia whereUpdatedAt($value)
 */
	class Existencia extends \Eloquent {}
}

namespace App\Models{
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
 * @property Destinatario $destinatario
 * @property Estado $estado
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado query()
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado whereIdDestinatario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado whereIdEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado whereIdUsuarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistorialEstado whereUpdatedAt($value)
 */
	class HistorialEstado extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ImagenColore
 *
 * @property $id
 * @property $color_id
 * @property $url
 * @property $created_at
 * @property $updated_at
 * @property Colore $colore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenColore whereUrl($value)
 */
	class ImagenColore extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ImagenMateriale
 *
 * @property $id
 * @property $material_id
 * @property $url
 * @property $created_at
 * @property $updated_at
 * @property Materiale $materiale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenMateriale whereUrl($value)
 */
	class ImagenMateriale extends \Eloquent {}
}

namespace App\Models{
/**
 * Class ImagenModelo
 *
 * @property $id
 * @property $modelo_id
 * @property $url
 * @property $created_at
 * @property $updated_at
 * @property Modelo $modelo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo whereModeloId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImagenModelo whereUrl($value)
 */
	class ImagenModelo extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Materiale
 *
 * @property $id
 * @property $id_cat
 * @property $nombre
 * @property $precio
 * @property $created_at
 * @property $updated_at
 * @property Categoria $categoria
 * @property DetalleMateriale[] $detalleMateriales
 * @property ImagenMateriale[] $imagenMateriales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $detalle_materiales_count
 * @property-read int|null $imagen_materiales_count
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereIdCat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Materiale whereUpdatedAt($value)
 */
	class Materiale extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Modelo
 *
 * @property $id
 * @property $nombre
 * @property $precio
 * @property $created_at
 * @property $updated_at
 * @property ImagenModelo[] $imagenModelos
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $imagen_modelos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ImagenModelo> $imagenes
 * @property-read int|null $imagenes_count
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modelo whereUpdatedAt($value)
 */
	class Modelo extends \Eloquent {}
}

namespace App\Models{
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
 * @property Cliente $cliente
 * @property Sucursale $sucursale
 * @property Usuario $usuario
 * @property Destinatario[] $destinatarios
 * @property DetalleVenta[] $detalleVentas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $destinatarios_count
 * @property-read int|null $detalle_ventas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereIdCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereIdSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido wherePagoACuenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido wherePrecioTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pedido whereUpdatedAt($value)
 */
	class Pedido extends \Eloquent {}
}

namespace App\Models{
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
 * @property Colore $colore
 * @property Modelo $modelo
 * @property Talla $talla
 * @property Destinatario[] $destinatarios
 * @property DetalleMateriale[] $detalleMateriales
 * @property DetalleVenta[] $detalleVentas
 * @property Existencia[] $existencias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property int $id_sucursal
 * @property-read int|null $destinatarios_count
 * @property-read int|null $detalle_materiales_count
 * @property-read int|null $detalle_ventas_count
 * @property-read int|null $existencias_count
 * @property-read \App\Models\Sucursale $sucursal
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdColores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdModelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdTalla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto wherePrecioEstimado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto wherePrecioVendedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereUpdatedAt($value)
 */
	class Producto extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Role
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 * @property Usuario[] $usuarios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $usuarios_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Sucursale
 *
 * @property $id
 * @property $nombre
 * @property $direccion
 * @property $telefono
 * @property $estado
 * @property $created_at
 * @property $updated_at
 * @property AtencionSucursale[] $atencionSucursales
 * @property Existencia[] $existencias
 * @property Pedido[] $pedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $atencion_sucursales_count
 * @property-read int|null $existencias_count
 * @property-read int|null $pedidos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursale whereUpdatedAt($value)
 */
	class Sucursale extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Talla
 *
 * @property $id
 * @property $talla
 * @property $genero
 * @property $created_at
 * @property $updated_at
 * @property Destinatario[] $destinatarios
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $destinatarios_count
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Talla newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Talla newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Talla query()
 * @method static \Illuminate\Database\Eloquent\Builder|Talla whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talla whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talla whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talla whereTalla($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Talla whereUpdatedAt($value)
 */
	class Talla extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $password
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
 * @property Role $role
 * @property AtencionSucursale[] $atencionSucursales
 * @property Existencia[] $existencias
 * @property HistorialEstado[] $historialEstados
 * @property Pedido[] $pedidos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read int|null $atencion_sucursales_count
 * @property-read int|null $existencias_count
 * @property-read int|null $historial_estados_count
 * @property-read int|null $pedidos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereContra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereIdRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereUpdatedAt($value)
 */
	class Usuario extends \Eloquent {}
}

