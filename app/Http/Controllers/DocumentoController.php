<?php

namespace App\Http\Controllers;

use App\Models\Autorizacion;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DocumentoController extends Controller
{
    public function descargar(Request $request, $id)
    {
        $autorizacion = Autorizacion::with(['personas', 'tipoPermiso'])->findOrFail($id);

        // Selección de plantilla según el tipo de permiso
        $id_tppermi = $autorizacion->id_tppermi;
        $plantillaPath = storage_path("app/templates/plantilla{$id_tppermi}.docx");

        if (!file_exists($plantillaPath)) {
            return back()->with('error', "No se encontró la plantilla para este tipo de permiso ($id_tppermi).");
        }

        $templateProcessor = new TemplateProcessor($plantillaPath);

        // Reemplazo de datos generales
        $templateProcessor->setValue('kardex', strtoupper($autorizacion->nro_kardex ?? ''));
        $templateProcessor->setValue('encargado', strtoupper($autorizacion->encargado ?? ''));
        $templateProcessor->setValue('tipo_permiso', strtoupper($autorizacion->tipoPermiso->des_tppermi ?? ''));
        $templateProcessor->setValue('fecha_ingreso', $this->fechaEnLetras($autorizacion->fecha_ingreso));
        $templateProcessor->setValue('viaja_a', strtoupper($autorizacion->viaja_a ?? ''));
        $templateProcessor->setValue('observaciones', strtoupper($autorizacion->observaciones ?? ''));
        $templateProcessor->setValue('tiempo_viaje', strtoupper($autorizacion->tiempo_viaje ?? ''));

        // Transporte
        $transporte = \DB::table('tp_transporte')->where('id_tptrans', $autorizacion->id_tptrans)->first();
        $templateProcessor->setValue('tp_transporte', $transporte ? strtoupper($transporte->des_tptrans) : 'DESCONOCIDO');

        // Obtener todas las relaciones (descripciones) para filtrar
        $relaciones = \DB::table('tp_relacion')->pluck('descripcion', 'id_tp_relacion');

        // Padres / Tutores
        $padres = $autorizacion->personas->filter(function ($p) use ($relaciones) {
            $desc = $relaciones[$p->pivot->id_tp_relacion] ?? '';
            return in_array($desc, ['Padre', 'Madre']);
        });

        $textoPadreMadre = new TextRun();
        $indexPadre = 0;
        foreach ($padres as $padre) {
            if ($indexPadre > 0) {
                $textoPadreMadre->addText(" Y ");
            }

            $textoPadreMadre->addText(strtoupper($padre->nombres . ' ' . $padre->apellidos), ['bold' => true]);
            $textoPadreMadre->addText(", CON ");

            $tpDoc = \DB::table('tp_documento')->where('id_tpdoc', $padre->id_tpdoc)->first();
            $textoPadreMadre->addText($tpDoc->abrev_tpdoc ?? 'DOC', ['bold' => true]);
            $textoPadreMadre->addText(" N° ", ['bold' => true]);
            $textoPadreMadre->addText($padre->num_doc, ['bold' => true]);

            $nacionalidad = \DB::table('nacionalidades')->where('id_nacionalidad', $padre->id_nacionalidad)->first()->gentilicio ?? 'N/A';
            $direccion = $padre->direccion ?? 'N/A';
            $ubigeo = \DB::table('ubigeo')->where('id_ubigeo', $padre->id_ubigeo)->first();
            $distrito = $ubigeo->nom_dis ?? 'N/A';
            $provincia = $ubigeo->nom_prov ?? 'N/A';
            $departamento = $ubigeo->nom_dpto ?? 'N/A';

            $textoPadreMadre->addText(", DE NACIONALIDAD " . strtoupper($nacionalidad) . ", DOMICILIADO(A) EN " . strtoupper($direccion) . ", DISTRITO DE " . strtoupper($distrito) . ", PROVINCIA DE " . strtoupper($provincia) . ", DEPARTAMENTO DE " . strtoupper($departamento));
            $indexPadre++;
        }

        if ($padres->isEmpty()) {
            $textoPadreMadre->addText("NO SE HAN REGISTRADO PADRES O TUTORES.");
        }

        $templateProcessor->setComplexValue('padres_info', $textoPadreMadre);

        // Menores
        $menores = $autorizacion->personas->filter(function ($p) use ($relaciones) {
            return ($relaciones[$p->pivot->id_tp_relacion] ?? '') === 'Menor';
        });

        $menorhijo = $menores->count() > 1 ? "MIS MENORES HIJOS()" : "MI MENOR HIJO(A)";
        $templateProcessor->setValue('menorhijo', $menorhijo);

        $listaMenores = new TextRun();
        $indexMenor = 0;
        foreach ($menores as $menor) {
            if ($indexMenor > 0) {
                $listaMenores->addText(" Y ");
            }

            $listaMenores->addText(strtoupper($menor->nombres . ' ' . $menor->apellidos), ['bold' => true]);
            $listaMenores->addText(", IDENTIFICADO(A) CON ");

            $tpDoc = \DB::table('tp_documento')->where('id_tpdoc', $menor->id_tpdoc)->first();
            $listaMenores->addText($tpDoc->abrev_tpdoc ?? 'DOC', ['bold' => true]);
            $listaMenores->addText(" N° ", ['bold' => true]);
            $listaMenores->addText($menor->num_doc, ['bold' => true]);
            $listaMenores->addTextBreak();
            $listaMenores->addText("DE: ");
            $listaMenores->addText(strtoupper($menor->edad . ' ' . ($menor->tipo_edad ?? 'AÑOS')) . " DE EDAD.", ['bold' => true]);
            $indexMenor++;
        }
        $templateProcessor->setComplexValue('lista_menores', $listaMenores);

        // Firmantes
        $firmantes = $autorizacion->personas->filter(function ($p) {
            return in_array($p->pivot->firma, ['SI', 'HUELLA']);
        });

        $listaFirmantes = $firmantes->map(fn($f) => strtoupper($f->nombres . ' ' . $f->apellidos))->implode("\n \n");
        $templateProcessor->setValue('firmantes', $listaFirmantes ?: "NO SE HAN REGISTRADO FIRMANTES.");

        // Generar archivo
        $kardexStr = $autorizacion->nro_kardex ? "_{$autorizacion->nro_kardex}" : "";
        $outputFileName = "Autorizacion_viaje{$kardexStr}.docx";
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $templateProcessor->saveAs($tempFile);

        return response()->download($tempFile, $outputFileName)->deleteFileAfterSend(true);
    }

    private function fechaEnLetras($fecha)
    {
        if (!$fecha)
            return '';
        $date = Carbon::parse($fecha);

        $dias = [
            1 => 'PRIMERO',
            2 => 'DOS',
            3 => 'TRES',
            4 => 'CUATRO',
            5 => 'CINCO',
            6 => 'SEIS',
            7 => 'SIETE',
            8 => 'OCHO',
            9 => 'NUEVE',
            10 => 'DIEZ',
            11 => 'ONCE',
            12 => 'DOCE',
            13 => 'TRECE',
            14 => 'CATORCE',
            15 => 'QUINCE',
            16 => 'DIECISÉIS',
            17 => 'DIECISIETE',
            18 => 'DIECIOCHO',
            19 => 'DIECINUEVE',
            20 => 'VEINTE',
            21 => 'VEINTIUNO',
            22 => 'VEINTIDÓS',
            23 => 'VEINTITRÉS',
            24 => 'VEINTICUATRO',
            25 => 'VEINTICINCO',
            26 => 'VEINTISÉIS',
            27 => 'VEINTISIETE',
            28 => 'VEINTIOCHO',
            29 => 'VEINTINUEVE',
            30 => 'TREINTA',
            31 => 'TREINTA Y UNO'
        ];

        $meses = [
            1 => 'ENERO',
            2 => 'FEBRERO',
            3 => 'MARZO',
            4 => 'ABRIL',
            5 => 'MAYO',
            6 => 'JUNIO',
            7 => 'JULIO',
            8 => 'AGOSTO',
            9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE',
            11 => 'NOVIEMBRE',
            12 => 'DICIEMBRE'
        ];

        $dia = $dias[$date->day] ?? $date->day;
        $mes = $meses[$date->month] ?? $date->month;
        $anio = $this->anioEnLetras($date->year);

        return "{$dia} DE {$mes} DE {$anio}";
    }

    private function anioEnLetras($anio)
    {
        $anios = [
            2020 => 'DOS MIL VEINTE',
            2021 => 'DOS MIL VEINTIUNO',
            2022 => 'DOS MIL VEINTIDÓS',
            2023 => 'DOS MIL VEINTITRÉS',
            2024 => 'DOS MIL VEINTICUATRO',
            2025 => 'DOS MIL VEINTICINCO',
            2026 => 'DOS MIL VEINTISÉIS',
            2027 => 'DOS MIL VEINTISIETE',
            2028 => 'DOS MIL VEINTIOCHO',
            2029 => 'DOS MIL VEINTINUEVE',
            2030 => 'DOS MIL TREINTA',
            2031 => 'DOS MIL TREINTA Y UNO',
            2032 => 'DOS MIL TREINTA Y DOS',
        ];

        return $anios[$anio] ?? $anio;
    }
}
