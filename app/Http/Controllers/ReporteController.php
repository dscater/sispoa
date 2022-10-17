<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use App\Models\FormularioCuatro;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

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

    public function ejecucion_presupuestos(Request $request)
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
        switch ($filtro) {
            case "":
                $formularios = FormularioCuatro::where("unidad_id", $unidad_id)->get();
                break;
            case "Código PEI":
                break;
            case "Rango de fechas":
                $formularios = FormularioCuatro::whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
                break;
        }

        $unidads = Unidad::all();
        if ($filtro != "Todos") {
            if ($filtro == "Unidad Organizacional") {
                $unidads = Unidad::where("id", $unidad_id)->get();
            }
        }
        $categories = [];
        $presupuestos = [];
        $ejecutados = [];
        $saldos = [];

        foreach ($unidads as $unidad) {
            $categories[] = $unidad->nombre;
            $formularios = FormularioCuatro::where("unidad_id", $unidad->id)->get();
            if ($filtro == "Rango de fechas") {
                $formularios = FormularioCuatro::where("unidad_id", $unidad->id)->whereBetween("fecha_registro", [$fecha_ini, $fecha_fin])->get();
            }
            if (count($formularios) > 0) {
                // buscar los valores
                $suma_presupuestos = 0;
                $suma_ejecutados = 0;
                $suma_saldos = 0;
                foreach ($formularios as $formulario) {
                    if ($formulario->formulario_cinco) {
                        foreach ($formulario->formulario_cinco->operacions as $operacion) {
                            foreach ($operacion->actividad_tareas as $tarea) {
                                foreach ($tarea->partidas as $partida) {
                                    $total_usado = Certificacion::where("partida_id", $partida->id)->sum("presupuesto_usarse");
                                    $suma_ejecutados += (float)$total_usado;
                                    $saldo = (float) $partida->t42 - (float) $total_usado;
                                    $suma_saldos += (float)$saldo;
                                }
                            }
                        }
                        $suma_presupuestos += (float)$formulario->formulario_cinco->total_formulario;
                    }
                    $presupuestos[] = $suma_presupuestos;
                    $ejecutados[] = $suma_ejecutados;
                    $saldos[] = $suma_saldos;
                }
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
}
