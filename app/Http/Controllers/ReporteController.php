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
}
