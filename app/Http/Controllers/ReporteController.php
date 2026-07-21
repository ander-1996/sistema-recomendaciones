<?php

namespace App\Http\Controllers;

use App\Models\Recomendacion;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {

        $total = Recomendacion::count();

        $cumplidas = Recomendacion::where('estado','Cumplida')->count();

        $enProceso = Recomendacion::where('estado','En proceso')->count();

        $pendientes = Recomendacion::where('estado','Pendiente')->count();

        $vencidas = Recomendacion::where('estado','Vencida')->count();


        // Datos para gráfica por estado

        $porEstado = [
            'Cumplidas' => $cumplidas,
            'En proceso' => $enProceso,
            'Pendientes' => $pendientes,
            'Vencidas' => $vencidas
        ];


        // Datos para gráfica por institución

        $porInstitucion = Recomendacion::select(
                'institucions.nombre',
                DB::raw('count(*) as total')
            )
            ->join(
                'institucions',
                'recomendaciones.institucion_id',
                '=',
                'institucions.id'
            )
            ->groupBy('institucions.nombre')
            ->get();


        return view('reportes.index', compact(
            'total',
            'cumplidas',
            'enProceso',
            'pendientes',
            'vencidas',
            'porEstado',
            'porInstitucion'
        ));

    }

    public function exportarExcel()
{
    $recomendaciones = Recomendacion::with('institucion')
        ->get();


    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();


    // Encabezados

    $sheet->setCellValue('A1','Código');
    $sheet->setCellValue('B1','Institución');
    $sheet->setCellValue('C1','Recomendación');
    $sheet->setCellValue('D1','Tipo');
    $sheet->setCellValue('E1','Prioridad');
    $sheet->setCellValue('F1','Responsable');
    $sheet->setCellValue('G1','Estado');
    $sheet->setCellValue('H1','Fecha cumplimiento');


    $fila = 2;


    foreach($recomendaciones as $recomendacion){

        $sheet->setCellValue(
            "A".$fila,
            $recomendacion->codigo
        );

        $sheet->setCellValue(
            "B".$fila,
            $recomendacion->institucion->nombre ?? ''
        );

        $sheet->setCellValue(
            "C".$fila,
            $recomendacion->recomendacion
        );

        $sheet->setCellValue(
            "D".$fila,
            $recomendacion->tipo
        );

        $sheet->setCellValue(
            "E".$fila,
            $recomendacion->prioridad
        );

        $sheet->setCellValue(
            "F".$fila,
            $recomendacion->responsable
        );

        $sheet->setCellValue(
            "G".$fila,
            $recomendacion->estado
        );

        $sheet->setCellValue(
            "H".$fila,
            $recomendacion->fecha_cumplimiento
        );


        $fila++;

    }


    $writer = new Xlsx($spreadsheet);


    $archivo = "recomendaciones.xlsx";


    $ruta = storage_path($archivo);


    $writer->save($ruta);


    return response()->download($ruta)->deleteFileAfterSend(true);
}

public function pdf($id)
{
    $recomendacion = Recomendacion::with([
        'institucion',
        'seguimientos.usuario'
    ])->findOrFail($id);


    $pdf = Pdf::loadView(
        'reportes.recomendacion_pdf',
        compact('recomendacion')
    );


    return $pdf->download(
        'recomendacion_'.$recomendacion->codigo.'.pdf'
    );
}

}