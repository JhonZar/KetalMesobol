<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Pedidos {{ $reportType }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .header {
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Pedidos {{ $reportType }}</h1>
        <p>Fecha: {{ $date }}</p>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Número de Pedido</th>
                    <th>Cliente</th>
                    <th>Productos</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->cliente->nombre }}</td>
                        <td>
                            @foreach ($pedido->productos as $producto)
                                {{ $producto->nombre }} ({{ $producto->pivot->cantidad }})<br>
                            @endforeach
                        </td>
                        <td>{{ $pedido->total }}</td>
                        <td>{{ $pedido->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
