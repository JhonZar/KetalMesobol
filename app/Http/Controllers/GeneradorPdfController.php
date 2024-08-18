<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class GeneradorPdfController extends Controller
{
    protected function generarPDF($pedidos, $titulo)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $imagenBase64 = $this->convertirImagenABase64('imagenes/ketalMesobol.png');
        $view = view('reportes.pedidos', compact('pedidos', 'titulo', 'imagenBase64'))->render();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream($titulo . '.pdf', ['Attachment' => false]);
    }

    protected function convertirImagenABase64($ruta)
    {
        $rutaCompleta = public_path($ruta);
        $tipo = pathinfo($rutaCompleta, PATHINFO_EXTENSION);
        $data = file_get_contents($rutaCompleta);
        $base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($data);

        return $base64;
    }

    public function reporteDiario()
    {
        $hoy = Carbon::today();
        $pedidos = Pedido::whereDate('fecha', $hoy)->get();
        $titulo = 'Reporte Diario ' . $hoy->toDateString();

        return $this->generarPDF($pedidos, $titulo);
    }

    public function reporteMensual()
    {
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;
        $pedidos = Pedido::whereMonth('fecha', $mesActual)
                         ->whereYear('fecha', $anioActual)
                         ->get();
        $titulo = 'Reporte Mensual ' . $mesActual . '-' . $anioActual;

        return $this->generarPDF($pedidos, $titulo);
    }

    public function reporteAnual()
    {
        $anioActual = Carbon::now()->year;
        $pedidos = Pedido::whereYear('fecha', $anioActual)->get();
        $titulo = 'Reporte Anual ' . $anioActual;

        return $this->generarPDF($pedidos, $titulo);
    }


    public function index()
    {
        return view('reportes.index');
    }

    public function generar(Request $request)
    {
        // Lógica para generar el reporte según los filtros aplicados
        // Esto puede incluir consultas a la base de datos y generación de PDF

        // Por ejemplo:
        // $fechaInicio = $request->input('fecha_inicio');
        // $fechaFin = $request->input('fecha_fin');
        // $tipoReporte = $request->input('tipo_reporte');

        // Realizar consultas y generar el reporte...

        return redirect()->route('reportes.index')->with('success', 'Reporte generado exitosamente.');
    }
}
