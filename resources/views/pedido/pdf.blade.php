<!DOCTYPE html>
<html>

<head>
    <title>Comprobante de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center; /* Alinea verticalmente al centro */
            padding-bottom: 20px;
            border-bottom: 2px solid #d4b582;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
        }

        .company-details {
            text-align: right;
            flex: 1;
        }

        .company-details h2 {
            margin: 0;
            font-size: 22px;
            color: #d4b582;
        }

        .company-details p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #d4b582;
            margin-bottom: 20px;
        }

        .section {
            margin-top: 20px;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #d4b582;
        }

        .section p {
            margin: 5px 0;
            font-size: 14px;
        }

        .products-table,
        .destinatarios-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-radius: 4px;
            overflow: hidden;
        }

        .products-table th,
        .products-table td,
        .destinatarios-table th,
        .destinatarios-table td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 14px;
        }

        .products-table th,
        .destinatarios-table th {
            background-color: #333;
            color: #d4b582;
            text-align: left;
        }

        .products-table td,
        .destinatarios-table td {
            background-color: #f9f9f9;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            border-top: 2px solid #d4b582;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                @php
                    $path = public_path('imagenes/ketalMesobol.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $base64 }}" alt="Logo de la Empresa">
            </div>
            <div class="company-details">
                <h2>Ketal Mesobol</h2>
                <p>Rio Seco - Ex Tranca</p>
                <p>73849382</p>
            </div>
        </div>
        <h1>Comprobante de Pedido</h1>

        <div class="section">
            <h2>Detalles del Pedido</h2>
            <p><strong>ID Pedido:</strong> {{ $pedido->id }}</p>
            <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
        </div>

        <div class="section">
            <h2>Información del Cliente</h2>
            <p><strong>Nombre:</strong> {{ $pedido->cliente->nombre }}</p>
            <p><strong>CI:</strong> {{ $pedido->cliente->ci }}</p>
            <p><strong>Dirección:</strong> {{ $pedido->cliente->direccion }}</p>
            <p><strong>Teléfono:</strong> {{ $pedido->cliente->telefono }}</p>
            <p><strong>Email:</strong> {{ $pedido->cliente->email }}</p>
        </div>
        @if ($pedido->detalleVentas->isNotEmpty())
            <div class="section">
                <h2>Detalles de Venta</h2>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detalleVentas as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->producto->descripcion }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->precion_unitario }}</td>
                                <td>{{ $detalle->cantidad * $detalle->precion_unitario }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($pedido->destinatarios->isNotEmpty())
            <div class="section">
                <h2>Destinatarios</h2>
                <table class="destinatarios-table">
                    <thead>
                        <tr>
                            <th>Destinatario</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha de Entrega</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->destinatarios as $destinatario)
                            <tr>
                                <td>{{ $destinatario->cliente->nombre }}</td>
                                <td>{{ $destinatario->producto->nombre }}</td>
                                <td>{{ $destinatario->cantidad }}</td>
                                <td>{{ $destinatario->fecha_Entrega }}</td>
                                <td>{{ $destinatario->obs }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="section">
            <h2>Resumen de Pago</h2>
            <p><strong>Precio Total:</strong> {{ $pedido->precioTotal }}</p>
            <p><strong>Pago A Cuenta:</strong> {{ $pedido->pagoACuenta }}</p>
            <p><strong>Saldo:</strong> {{ $pedido->saldo }}</p>
        </div>

        <div class="footer">
            <p>Gracias por su compra. Si tiene alguna pregunta sobre este comprobante, por favor contáctenos.</p>
            <p>Z. Rio Seco Ex Tranca | 73928394 </p>
        </div>
    </div>
</body>

</html>
