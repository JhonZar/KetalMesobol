<!DOCTYPE html>
<html>
<head>
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            position: relative;
            z-index: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .header img {
            width: 100px;
            position: absolute;
            top: 0;
            right: 0;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            padding-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            position: relative;
            z-index: 1;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .table-header {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .table-body tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
        .highlight-red {
            color: red;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px; /* Adjust size as needed */
            opacity: 0.1;
            transform: translate(-50%, -50%);
            z-index: 0;
        }
        .product-row {
            background-color: #f9f9f9;
            font-style: italic;
        }
        .product-row td {
            border-top: none;
        }
        .product-link {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $titulo }}</h1>
    </div>
    <img src="{{ $imagenBase64 }}" alt="Logo" class="watermark">
    <table>
        <thead>
            <tr class="table-header">
                <th>ID</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Sucursal</th>
                <th>Precio Total</th>
                <th>Pago a Cuenta</th>
                <th>Saldo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody class="table-body">
            @foreach($pedidos as $pedido)
            <tr @if($pedido->saldo > 0) class="highlight-red" @endif>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ $pedido->id }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ $pedido->cliente->nombre }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ $pedido->usuario->nombre }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ $pedido->sucursale->nombre }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ number_format($pedido->precioTotal, 2) }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ number_format($pedido->pagoACuenta, 2) }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ number_format($pedido->saldo, 2) }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y') }}</td>
                <td rowspan="{{ $pedido->detalleVentas->count() + 1 }}">{{ ucfirst($pedido->estado) }}</td>
            </tr>
            @foreach($pedido->detalleVentas as $detalle)
            <tr>
                <td><a href="{{ route('products.show', $detalle->producto->id) }}" class="product-link">{{ $detalle->producto->nombre }}</a></td>
                <td>{{ $detalle->cantidad }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    <div class="total">
        Total de Pedidos: {{ $pedidos->count() }}
    </div>
</body>
</html>
