<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use App\Models\DetalleOperacion;
use App\Models\Financiera;
use App\Models\Fisico;
use App\Models\FormularioCuatro;
use App\Models\MemoriaOperacion;
use App\Models\Semaforo;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ReporteController extends Controller
{
    public function usuarios(Request $request)
    {
        $filtro =  $request->filtro;
        $usuarios = User::where('id', '!=', 1)->get();
        if ($filtro == 'Rango de fechas') {
            $request->validate([
                'fecha_ini' => 'required|date',
                'fecha_fin' => 'required|date',
            ]);
            $usuarios = User::where('id', '!=', 1)->whereBetween('fecha_registro', [$request->fecha_ini, $request->fecha_fin])->get();
        }

        if ($filtro == 'Tipo de usuario') {
            $request->validate([
                'tipo' => 'required',
            ]);
            $usuarios = User::where('id', '!=', 1)->where('tipo', $request->tipo)->get();
        }

        if ($filtro == 'Unidad Organizacional') {
            $request->validate([
                'tipo' => 'required',
            ]);
            $usuarios = User::where('id', '!=', 1)->where('unidad_id', $request->unidad_id)->get();
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('Usuarios.pdf');
    }

    public function saldo_presupuesto(Request $request)
    {
        $filtro =  $request->filtro;
        $unidad_id =  $request->unidad_id;
        $formulario_id =  $request->formulario_id;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;
        $formularios = FormularioCuatro::all();
        if ($filtro != "Todos") {
            switch ($filtro) {
                case "Unidad Organizacional":
                    $formularios = FormularioCuatro::where("unidad_id", $unidad_id)->get();
                    break;
                case "Código PEI":
                    $formularios = FormularioCuatro::where("id", $formulario_id)->get();
                    break;
                case "Rango de fechas":
                    $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.saldo_presupuesto', compact('formularios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('EjecucionPresupuestos.pdf');
    }

    public function ejecucion_presupuestos(Request $request)
    {
        $filtro =  $request->filtro;
        $unidad_id =  $request->unidad_id;
        $formulario_id =  $request->formulario_id;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;


        $formularios = [];
        if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
            $formularios = FormularioCuatro::where("unidad_id", Auth::user()->unidad_id)->get();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                }
            }
        } else {
            $formularios = FormularioCuatro::all();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Unidad Organizacional":
                        $formularios = FormularioCuatro::where("unidad_id", $unidad_id)->get();
                        break;
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
                        break;
                }
            }
        }

        $pdf = PDF::loadView('reportes.ejecucion_presupuestos', compact('formularios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('EjecucionPresupuestos.pdf');
    }

    public function formulario_cuatro(Request $request)
    {
        $filtro =  $request->filtro;
        $unidad_id =  $request->unidad_id;
        $formulario_id =  $request->formulario_id;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;

        $formularios = [];
        if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
            $formularios = FormularioCuatro::where("unidad_id", Auth::user()->unidad_id)->get();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                }
            }
        } else {
            $formularios = FormularioCuatro::all();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Unidad Organizacional":
                        $formularios = FormularioCuatro::where("unidad_id", $unidad_id)->get();
                        break;
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
                        break;
                }
            }
        }


        $pdf = PDF::loadView('reportes.formulario_cuatro', compact('formularios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('formulario_cuatro.pdf');
    }
    public function formulario_cinco(Request $request)
    {
        $filtro =  $request->filtro;
        $unidad_id =  $request->unidad_id;
        $formulario_id =  $request->formulario_id;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;

        $formularios = [];

        if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
            $formularios = FormularioCuatro::where("unidad_id", Auth::user()->unidad_id)->get();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                }
            }
        } else {
            $formularios = FormularioCuatro::all();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Unidad Organizacional":
                        $formularios = FormularioCuatro::where("unidad_id", $unidad_id)->get();
                        break;
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
                        break;
                }
            }
        }


        $pdf = PDF::loadView('reportes.formulario_cinco', compact('formularios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('formulario_cinco.pdf');
    }
    public function memoria_calculos(Request $request)
    {
        $filtro =  $request->filtro;
        $unidad_id =  $request->unidad_id;
        $formulario_id =  $request->formulario_id;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;

        $formularios = [];

        if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
            $formularios = FormularioCuatro::where("unidad_id", Auth::user()->unidad_id)->get();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])
                            ->where("unidad_id", Auth::user()->unidad_id)
                            ->get();
                        break;
                }
            }
        } else {
            $formularios = FormularioCuatro::all();
            if ($filtro != "Todos") {
                switch ($filtro) {
                    case "Unidad Organizacional":
                        $formularios = FormularioCuatro::where("unidad_id", $unidad_id)->get();
                        break;
                    case "Código PEI":
                        $formularios = FormularioCuatro::where("id", $formulario_id)->get();
                        break;
                    case "Rango de fechas":
                        $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
                        break;
                }
            }
        }


        $pdf = PDF::loadView('reportes.memoria_calculos', compact('formularios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('memoria_calculos.pdf');
    }
    public function saldos_actividad(Request $request)
    {
        $formulario_id =  $request->formulario_id;
        $operacion_id =  $request->operacion_id;
        $actividad_id =  $request->actividad_id;
        $actividad = DetalleOperacion::find($actividad_id);

        $pdf = PDF::loadView('reportes.saldos_actividad', compact("actividad"))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('saldos_actividad.pdf');
    }
    public function saldos_partida(Request $request)
    {
        $formulario_id =  $request->formulario_id;
        $memoria_operacion_id =  $request->memoria_operacion_id;
        $memoria_operacion = MemoriaOperacion::find($memoria_operacion_id);
        $pdf = PDF::loadView('reportes.saldos_partida', compact("memoria_operacion"))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('saldos_partida.pdf');
    }
    public function fisicos(Request $request)
    {
        $filtro =  $request->filtro;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;
        $fisicos = Fisico::all();
        if ($filtro != "Todos") {
            $fisicos = Fisico::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
        }

        $pdf = PDF::loadView('reportes.fisicos', compact("fisicos"))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('fisicos.pdf');
    }
    public function financieros(Request $request)
    {
        $filtro =  $request->filtro;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;
        $financieros = Financiera::all();
        if ($filtro != "Todos") {
            $financieros = Financiera::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
        }

        $pdf = PDF::loadView('reportes.financieros', compact("financieros"))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('financieros.pdf');
    }
    public function semaforos(Request $request)
    {
        $filtro =  $request->filtro;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;
        $semaforos = Semaforo::all();
        if ($filtro != "Todos") {
            $semaforos = Semaforo::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
        }

        $pdf = PDF::loadView('reportes.semaforos', compact("semaforos"))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('semaforos.pdf');
    }

    public function ejecucion_presupuestos_g(Request $request)
    {
        $filtro =  $request->filtro;
        if ($filtro == 'Rango de fechas') {
            $request->validate([
                'fecha_ini' => 'required|date',
                'fecha_fin' => 'required|date',
            ]);
        }
        $unidad_id =  $request->unidad_id;
        $fecha_ini =  $request->fecha_ini;
        $fecha_fin =  $request->fecha_fin;

        if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
            $unidads = Unidad::where("id", Auth::user()->unidad_id)->get();
        } else {
            $unidads = Unidad::all();
            if ($filtro != "Todos") {
                if ($filtro == "Unidad Organizacional") {
                    $unidads = Unidad::where("id", $unidad_id)->get();
                }
            }
        }

        $categories = [];
        $presupuestos = [];
        $ejecutados = [];
        $saldos = [];


        foreach ($unidads as $unidad) {
            $categories[] = $unidad->nombre;
            if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
                $formularios = FormularioCuatro::where("unidad_id", $unidad->id)->where("id", Auth::user()->unidad_id)->get();
            } else {
                $formularios = FormularioCuatro::where("unidad_id", $unidad->id)->get();
            }
            if ($filtro == "Rango de fechas") {
                if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
                    $formularios = FormularioCuatro::where("unidad_id", $unidad->id)->whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->where("id", Auth::user()->unidad_id)->get();
                } else {
                    $formularios = FormularioCuatro::where("unidad_id", $unidad->id)->whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
                }
            }
            if (count($formularios) > 0) {
                // buscar los valores
                $suma_presupuestos = 0;
                $suma_ejecutados = 0;
                $suma_saldos = 0;
                foreach ($formularios as $formulario) {
                    if ($formulario->memoria_calculo) {
                        foreach ($formulario->memoria_calculo->operacions as $operacion) {
                            $total_usado = Certificacion::where("mo_id", $operacion->id)->sum("presupuesto_usarse");
                            $suma_ejecutados += (float)$total_usado;
                            $saldo = (float) $operacion->total - (float) $total_usado;
                            $suma_saldos += (float)$saldo;
                        }
                        $suma_presupuestos += (float)$formulario->memoria_calculo->total_final;
                    }
                }
                $presupuestos[] =  (float)number_format($suma_presupuestos, 2, ".", "");
                $ejecutados[] =  (float)number_format($suma_ejecutados, 2, ".", "");
                $saldos[] =  (float)number_format($suma_saldos, 2, ".", "");
            } else {
                $presupuestos[] = 0;
                $ejecutados[] = 0;
                $saldos[] = 0;
            }
        }

        return response()->JSON([
            "categories" => $categories,
            "presupuestos" => $presupuestos,
            "ejecutados" => $ejecutados,
            "saldos" => $saldos,
        ]);
    }

    public function formulario_cuatro_excel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator("ADMIN")
            ->setLastModifiedBy('Administración')
            ->setTitle('Formularios')
            ->setSubject('Formularios')
            ->setDescription('Formularios')
            ->setKeywords('PHPSpreadsheet')
            ->setCategory('Listado');

        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');

        $styleTexto = [
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $styleTextoForm = [
            'font' => [
                'bold' => true,
                'size' => 10,
            ],
        ];

        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 9,
                'color' => ['argb' => 'ffffff'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '0062A5']
            ],
        ];


        $styleArray2 = [
            'font' => [
                'bold' => true,
                'size' => 9,
                'color' => ['argb' => 'ffffff'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '0062A5']
            ],
        ];

        $estilo_conenido = [
            'font' => [
                'size' => 8,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $formulario_cuatro = FormularioCuatro::find($request->id);

        $fila = 1;
        $sheet->setCellValue('A' . $fila, "MATRIZ - PROGRAMACIÓN OPERATIVA ANUAL - GESTIÓN " . date("Y"));
        $sheet->mergeCells("A" . $fila . ":U" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila . ':U' . $fila)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A' . $fila . ':U' . $fila)->applyFromArray($styleTexto);
        $fila++;
        $sheet->setCellValue('A' . $fila, "ARTICULACIÓN DE ACCIONES Y OPERACIONES");
        $sheet->mergeCells("A" . $fila . ":U" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila . ':U' . $fila)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A' . $fila . ':U' . $fila)->applyFromArray($styleTexto);
        $fila++;
        $sheet->setCellValue('L' . $fila, "FORMULARIO 4");
        $sheet->mergeCells("L" . $fila . ":M" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('L' . $fila . ':M' . $fila)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('L' . $fila . ':M' . $fila)->applyFromArray($styleTextoForm);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'CÓDIGO PEI');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, $formulario_cuatro->codigo_pei);
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'OBJETIVO ESTRATÉGICO INSTITUCIONAL');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, $formulario_cuatro->accion_institucional);
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'INDICADOR');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, $formulario_cuatro->indicador);
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'CODIGO POA');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, $formulario_cuatro->codigo_poa);
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'ACCIÓN DE CORTO PLAZO DE GESTIÓN');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, $formulario_cuatro->accion_corto);
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'RESULTADO ESPERADO GESTIÓN');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, $formulario_cuatro->resultado_esperado);
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'PRESUPUESTO PROGRAMADO GESTIÓN');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, number_format($formulario_cuatro->presupuesto, 2) . " ");
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'PONDREACIÓN %');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, number_format($formulario_cuatro->ponderacion, 2) . " ");
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, 'UNIDAD ORGANIZACIONAL');
        $sheet->getStyle('A' . $fila)->applyFromArray($styleArray);
        $sheet->setCellValue('B' . $fila, $formulario_cuatro->unidad->nombre);
        $sheet->mergeCells("B" . $fila . ":U" . $fila);  //COMBINAR
        $sheet->getStyle('B' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);

        $fila++;
        $fila++;
        $sheet->setCellValue('A' . $fila, 'Código Operación(1)');
        $sheet->mergeCells("A" . $fila . ":A" . ($fila + 2));  //COMBINAR CELDAS
        $sheet->setCellValue('B' . $fila, 'Operación(2)');
        $sheet->mergeCells("B" . $fila . ":B" . ($fila + 2));  //COMBINAR CELDAS
        $sheet->setCellValue('C' . $fila, 'Ponderación');
        $sheet->mergeCells("C" . $fila . ":C" . ($fila + 2));  //COMBINAR CELDAS
        $sheet->setCellValue('D' . $fila, 'Resultado intermedio esperado(3)');
        $sheet->mergeCells("D" . $fila . ":D" . ($fila + 2));  //COMBINAR CELDAS
        $sheet->setCellValue('E' . $fila, 'Medios de verificación(4)');
        $sheet->mergeCells("E" . $fila . ":E" . ($fila + 2));  //COMBINAR CELDAS
        $sheet->setCellValue('F' . $fila, 'Código Act.(5)');
        $sheet->mergeCells("F" . $fila . ":F" . ($fila + 2));  //COMBINAR CELDAS
        $sheet->setCellValue('G' . $fila, 'Actividad/Tarea(6)');
        $sheet->mergeCells("G" . $fila . ":G" . ($fila + 2));  //COMBINAR CELDAS
        $sheet->setCellValue('H' . $fila, 'Programación de ejecución de operaciones y actividades(7)');
        $sheet->mergeCells("H" . $fila . ":S" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('T' . $fila, 'Fecha prevista de ejecución(8)');
        $sheet->mergeCells("T" . $fila . ":U" . $fila);  //COMBINAR CELDAS
        $fila++;
        $sheet->setCellValue('H' . $fila, '1er Trim.');
        $sheet->mergeCells("H" . $fila . ":J" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('K' . $fila, '2do Trim.');
        $sheet->mergeCells("K" . $fila . ":M" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('N' . $fila, '3er Trim.');
        $sheet->mergeCells("N" . $fila . ":P" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('Q' . $fila, '4to Trim.');
        $sheet->mergeCells("Q" . $fila . ":S" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('T' . $fila, 'Inicio');
        $sheet->setCellValue('U' . $fila, 'Final');
        $fila++;
        $sheet->setCellValue('H' . $fila, 'E');
        $sheet->setCellValue('I' . $fila, 'F');
        $sheet->setCellValue('J' . $fila, 'M');
        $sheet->setCellValue('K' . $fila, 'A');
        $sheet->setCellValue('L' . $fila, 'M');
        $sheet->setCellValue('M' . $fila, 'J');
        $sheet->setCellValue('N' . $fila, 'J');
        $sheet->setCellValue('O' . $fila, 'A');
        $sheet->setCellValue('P' . $fila, 'S');
        $sheet->setCellValue('Q' . $fila, 'O');
        $sheet->setCellValue('R' . $fila, 'N');
        $sheet->setCellValue('S' . $fila, 'D');

        $sheet->getStyle('A' . ($fila - 2) . ':U' . ($fila - 2))->applyFromArray($styleArray2);
        $sheet->getStyle('A' . ($fila - 1) . ':U' . ($fila - 1))->applyFromArray($styleArray2);
        $sheet->getStyle('A' . $fila . ':U' . $fila)->applyFromArray($styleArray2);
        $fila++;
        if ($formulario_cuatro->detalle_formulario) {
            foreach ($formulario_cuatro->detalle_formulario->operacions as $operacion) {
                $sheet->setCellValue('A' . $fila, $operacion->codigo_operacion);
                $sheet->setCellValue('B' . $fila, $operacion->operacion);
                $contador = $fila;
                foreach ($operacion->detalle_operaciones as $detalle_operacion) {
                    $sheet->setCellValue('C' . $contador, $detalle_operacion->ponderacion);
                    $sheet->setCellValue('D' . $contador, $detalle_operacion->resultado_esperado);
                    $sheet->setCellValue('E' . $contador, $detalle_operacion->medios_verificacion);
                    $sheet->setCellValue('F' . $contador, $detalle_operacion->codigo_tarea);
                    $sheet->setCellValue('G' . $contador, $detalle_operacion->actividad_tarea);
                    $sheet->setCellValue('H' . $contador, $detalle_operacion->pt_e);
                    $sheet->setCellValue('I' . $contador, $detalle_operacion->pt_f);
                    $sheet->setCellValue('J' . $contador, $detalle_operacion->pt_m);
                    $sheet->setCellValue('K' . $contador, $detalle_operacion->st_a);
                    $sheet->setCellValue('L' . $contador, $detalle_operacion->st_m);
                    $sheet->setCellValue('M' . $contador, $detalle_operacion->st_j);
                    $sheet->setCellValue('N' . $contador, $detalle_operacion->tt_j);
                    $sheet->setCellValue('O' . $contador, $detalle_operacion->tt_a);
                    $sheet->setCellValue('P' . $contador, $detalle_operacion->tt_s);
                    $sheet->setCellValue('Q' . $contador, $detalle_operacion->ct_o);
                    $sheet->setCellValue('R' . $contador, $detalle_operacion->ct_n);
                    $sheet->setCellValue('S' . $contador, $detalle_operacion->ct_d);
                    $sheet->setCellValue('T' . $contador, date("d/m/Y", strtotime($detalle_operacion->inicio)));
                    $sheet->setCellValue('U' . $contador, date("d/m/Y", strtotime($detalle_operacion->final)));
                    $sheet->getStyle('A' . $contador . ':U' . $contador)->applyFromArray($estilo_conenido);
                    $contador++;
                }
                $sheet->mergeCells("A" . $fila . ":A" . ($contador - 1));  //COMBINAR CELDAS
                $sheet->mergeCells("B" . $fila . ":B" . ($contador - 1));  //COMBINAR CELDAS
                $fila = $contador - 1;
                $sheet->getStyle('A' . $fila . ':U' . $fila)->applyFromArray($estilo_conenido);
                $fila++;
            }
        }
        $fila++;
        $sheet->setCellValue('A' . $fila, "");
        $sheet->setCellValue('B' . $fila, "ELABORADO POR:");
        $sheet->mergeCells("B" . $fila . ":D" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('E' . $fila, "REVISADO POR:");
        $sheet->mergeCells("E" . $fila . ":G" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('H' . $fila, "APROBADO");
        $sheet->mergeCells("H" . $fila . ":J" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila . ':J' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, "FIRMA");
        $sheet->setCellValue('B' . $fila, "");
        $sheet->mergeCells("B" . $fila . ":D" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('E' . $fila, "");
        $sheet->mergeCells("E" . $fila . ":G" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('H' . $fila, "");
        $sheet->mergeCells("H" . $fila . ":J" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila . ':J' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, "NOMBRE");
        $sheet->setCellValue('B' . $fila, "");
        $sheet->mergeCells("B" . $fila . ":D" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('E' . $fila, "");
        $sheet->mergeCells("E" . $fila . ":G" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('H' . $fila, "");
        $sheet->mergeCells("H" . $fila . ":J" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila . ':J' . $fila)->applyFromArray($estilo_conenido);
        $fila++;
        $sheet->setCellValue('A' . $fila, "CARGO");
        $sheet->setCellValue('B' . $fila, "");
        $sheet->mergeCells("B" . $fila . ":D" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('E' . $fila, "");
        $sheet->mergeCells("E" . $fila . ":G" . $fila);  //COMBINAR CELDAS
        $sheet->setCellValue('H' . $fila, "");
        $sheet->mergeCells("H" . $fila . ":J" . $fila);  //COMBINAR CELDAS
        $sheet->getStyle('A' . $fila . ':J' . $fila)->applyFromArray($estilo_conenido);
        
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(10);
        $sheet->getColumnDimension('I')->setWidth(10);
        $sheet->getColumnDimension('J')->setWidth(10);
        $sheet->getColumnDimension('K')->setWidth(10);
        $sheet->getColumnDimension('L')->setWidth(10);
        $sheet->getColumnDimension('M')->setWidth(10);
        $sheet->getColumnDimension('N')->setWidth(10);
        $sheet->getColumnDimension('O')->setWidth(10);
        $sheet->getColumnDimension('P')->setWidth(10);
        $sheet->getColumnDimension('Q')->setWidth(10);
        $sheet->getColumnDimension('R')->setWidth(10);
        $sheet->getColumnDimension('S')->setWidth(10);
        $sheet->getColumnDimension('T')->setWidth(15);
        $sheet->getColumnDimension('U')->setWidth(15);

        foreach (range('A', 'U') as $columnID) {
            $sheet->getStyle($columnID)->getAlignment()->setWrapText(true);
        }

        // DESCARGA DEL ARCHIVO
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Usuarios.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
