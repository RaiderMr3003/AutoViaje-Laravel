<?php

namespace App\Http\Controllers;

use App\Models\Autorizacion;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $fecha_min = $request->input('fecha_min');
        $fecha_max = $request->input('fecha_max');

        $query = Autorizacion::with(['personas', 'tipoPermiso']);

        if ($fecha_min) {
            $query->whereDate('fecha_ingreso', '>=', $fecha_min);
        }

        if ($fecha_max) {
            $query->whereDate('fecha_ingreso', '<=', $fecha_max);
        }

        $autorizaciones = $query->orderBy('fecha_ingreso', 'desc')
            ->orderBy('nro_kardex', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('autorizaciones.export', compact('autorizaciones', 'fecha_min', 'fecha_max'));
    }

    public function export(Request $request)
    {
        $fecha_min = $request->input('fecha_min');
        $fecha_max = $request->input('fecha_max');

        $query = Autorizacion::with(['personas', 'tipoPermiso']);

        if ($fecha_min) {
            $query->whereDate('fecha_ingreso', '>=', $fecha_min);
        }

        if ($fecha_max) {
            $query->whereDate('fecha_ingreso', '<=', $fecha_max);
        }

        $autorizaciones = $query->orderBy('nro_kardex', 'asc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers
        $sheet->setCellValue('A1', 'N° Cronológico');
        $sheet->setCellValue('B1', 'F. Ingreso');
        $sheet->setCellValue('C1', 'Tipo de Permiso');
        $sheet->setCellValue('D1', 'Participantes');
        $sheet->setCellValue('E1', 'Viaja a');

        $row = 2;
        foreach ($autorizaciones as $auth) {
            $startRow = $row;
            $participantes = $auth->personas;

            if ($participantes->isEmpty()) {
                $sheet->setCellValue('A' . $row, $auth->nro_kardex);
                $sheet->setCellValue('B' . $row, $auth->fecha_ingreso->format('d/m/Y'));
                $sheet->setCellValue('C' . $row, $auth->tipoPermiso->des_tppermi ?? '');
                $sheet->setCellValue('D' . $row, 'SIN PARTICIPANTES');
                $sheet->setCellValue('E' . $row, $auth->viaja_a);
                $row++;
            } else {
                foreach ($participantes as $index => $persona) {
                    if ($index === 0) {
                        $sheet->setCellValue('A' . $row, $auth->nro_kardex);
                        $sheet->setCellValue('B' . $row, $auth->fecha_ingreso ? $auth->fecha_ingreso->format('d/m/Y') : '');
                        $sheet->setCellValue('C' . $row, $auth->tipoPermiso->des_tppermi ?? '');
                        $sheet->setCellValue('E' . $row, $auth->viaja_a);
                    }
                    $sheet->setCellValue('D' . $row, $persona->nombres . ' ' . $persona->apellidos);
                    $row++;
                }

                $endRow = $row - 1;
                if ($startRow < $endRow) {
                    $sheet->mergeCells("A$startRow:A$endRow");
                    $sheet->mergeCells("B$startRow:B$endRow");
                    $sheet->mergeCells("C$startRow:C$endRow");
                    $sheet->mergeCells("E$startRow:E$endRow");
                }
            }
        }

        // Auto-size columns
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $fileName = "autorizaciones_" . ($fecha_min ?? 'inicio') . "_a_" . ($fecha_max ?? 'fin') . ".xlsx";

        return new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
