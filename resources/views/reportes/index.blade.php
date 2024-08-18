<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Generar Reportes | {{ config('app.name', 'KetalMesobol') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex h-screen bg-gray-900 font-sans nunito">
    <!-- Side bar -->
    <div id="sidebar" class="h-screen w-16 menu bg-gray-800 text-white px-4 flex items-center fixed shadow sidebar">
        <ul class="list-reset">
            <!-- Otros elementos del menú -->
            <li class="my-2 md:my-0">
                <a href="{{ route('reportes.index') }}" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-yellow-500">
                    <i class="fa fa-chart-bar fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Reportes</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">
        <!-- Main Content -->
        <div id="main-content" class="main-content-bg w-full flex-1 p-8">
            <main class="mt-4 bg-gray-700 p-8 rounded-lg shadow-lg h-full w-full max-w-full">
                <div class="content-bg p-6 rounded-lg shadow-lg h-full w-full max-w-full">
                    <h1 class="text-2xl font-bold text-white mb-6">Generar Reportes</h1>
                    <form action="{{ route('reportes.generar') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-white">Fecha Inicio</label>
                                <input type="date" name="fecha_inicio" class="w-full p-2 rounded border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-white">Fecha Fin</label>
                                <input type="date" name="fecha_fin" class="w-full p-2 rounded border border-gray-300">
                            </div>
                            <div>
                                <label class="block text-white">Tipo de Reporte</label>
                                <select name="tipo_reporte" class="w-full p-2 rounded border border-gray-300">
                                    <option value="diario">Diario</option>
                                    <option value="mensual">Mensual</option>
                                    <option value="anual">Anual</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Generar Reporte</button>
                        </div>
                    </form>
                    @if(session('success'))
                        <div class="mt-4 p-4 bg-green-500 text-white rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>

</html>
