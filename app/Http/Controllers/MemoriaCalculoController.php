<?php

namespace App\Http\Controllers;

use App\Models\FormularioCuatro;
use App\Models\MemoriaCalculo;
use App\Models\MemoriaOperacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoriaCalculoController extends Controller
{
    public $validacion = [
        'formulario_id' => 'required||unique:memoria_calculos,formulario_id',
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $listado = [];
        if (Auth::user()->tipo == "JEFES DE UNIDAD" || Auth::user()->tipo == "DIRECTORES" || Auth::user()->tipo == "JEFES DE ÁREAS") {
            $listado = MemoriaCalculo::select("memoria_calculos.*")
                ->join("formulario_cuatro", "formulario_cuatro.id", "=", "memoria_calculos.formulario_id")
                ->where("formulario_cuatro.unidad_id", Auth::user()->unidad_id)
                ->get();
        } else {
            $listado = MemoriaCalculo::all();
        }
        return response()->JSON(['listado' => $listado, 'total' => count($listado)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        $request["total_actividades"] = 0;
        $request["total_ene"] = 0;
        $request["total_feb"] = 0;
        $request["total_mar"] = 0;
        $request["total_abr"] = 0;
        $request["total_may"] = 0;
        $request["total_jun"] = 0;
        $request["total_jul"] = 0;
        $request["total_ago"] = 0;
        $request["total_sep"] = 0;
        $request["total_oct"] = 0;
        $request["total_nov"] = 0;
        $request["total_dic"] = 0;
        $request["total_final"] = 0;
        $nuevo_memoria_calculo = MemoriaCalculo::create(array_map('mb_strtoupper', $request->except("data")));

        $total_actividades = 0;
        $total_ene = 0;
        $total_feb = 0;
        $total_mar = 0;
        $total_abr = 0;
        $total_may = 0;
        $total_jun = 0;
        $total_jul = 0;
        $total_ago = 0;
        $total_sep = 0;
        $total_oct = 0;
        $total_nov = 0;
        $total_dic = 0;
        $total_final = 0;

        $data = $request->data;
        foreach ($data as $d) {
            $nueva_operacion = $nuevo_memoria_calculo->operacions()->create([
                "operacion_id" => mb_strtoupper($d["operacion_id"]),
                "ue" => mb_strtoupper($d["ue"]),
                "prog" => mb_strtoupper($d["prog"]),
                "act" => mb_strtoupper($d["act"]),
                "detalle_operacion_id" => mb_strtoupper($d["detalle_operacion_id"]),
                "lugar" => mb_strtoupper($d["lugar"]),
                "responsable" => mb_strtoupper($d["responsable"]),
                "partida_id" => mb_strtoupper($d["partida_id"]),
                "partida" => mb_strtoupper($d["partida"]),
                "nro" => mb_strtoupper($d["nro"]),
                "descripcion" => mb_strtoupper($d["descripcion"]),
                "descripcion_detallada" => mb_strtoupper($d["descripcion_detallada"]),
                "cantidad" => $d["cantidad"],
                "unidad" => mb_strtoupper($d["unidad"]),
                "costo" => mb_strtoupper($d["costo"]),
                "total" => $d["total"],
                "justificacion" => mb_strtoupper($d["justificacion"]),
                "ene" => $d["ene"],
                "feb" => $d["feb"],
                "mar" => $d["mar"],
                "abr" => $d["abr"],
                "may" => $d["may"],
                "jun" => $d["jun"],
                "jul" => $d["jul"],
                "ago" => $d["ago"],
                "sep" => $d["sep"],
                "oct" => $d["oct"],
                "nov" => $d["nov"],
                "dic" => $d["dic"],
                "total_operacion" => $d["total_operacion"],
                "fecha_registro" => date("Y-m-d")
            ]);
            $total_actividades += (float)$nueva_operacion->total;
            $total_ene += $nueva_operacion->ene ? (float)$nueva_operacion->ene : 0;
            $total_feb += $nueva_operacion->feb ? (float)$nueva_operacion->feb : 0;
            $total_mar += $nueva_operacion->mar ? (float)$nueva_operacion->mar : 0;
            $total_abr += $nueva_operacion->abr ? (float)$nueva_operacion->abr : 0;
            $total_may += $nueva_operacion->may ? (float)$nueva_operacion->may : 0;
            $total_jun += $nueva_operacion->jun ? (float)$nueva_operacion->jun : 0;
            $total_jul += $nueva_operacion->jul ? (float)$nueva_operacion->jul : 0;
            $total_ago += $nueva_operacion->ago ? (float)$nueva_operacion->ago : 0;
            $total_sep += $nueva_operacion->sep ? (float)$nueva_operacion->sep : 0;
            $total_oct += $nueva_operacion->oct ? (float)$nueva_operacion->oct : 0;
            $total_nov += $nueva_operacion->nov ? (float)$nueva_operacion->nov : 0;
            $total_dic += $nueva_operacion->dic ? (float)$nueva_operacion->dic : 0;
            $total_final += (float)$nueva_operacion->total_operacion;
        }

        $nuevo_memoria_calculo->total_actividades = number_format($total_actividades, 2, ".", "");
        $nuevo_memoria_calculo->total_ene = $total_ene;
        $nuevo_memoria_calculo->total_feb = $total_feb;
        $nuevo_memoria_calculo->total_mar = $total_mar;
        $nuevo_memoria_calculo->total_abr = $total_abr;
        $nuevo_memoria_calculo->total_may = $total_may;
        $nuevo_memoria_calculo->total_jun = $total_jun;
        $nuevo_memoria_calculo->total_jul = $total_jul;
        $nuevo_memoria_calculo->total_ago = $total_ago;
        $nuevo_memoria_calculo->total_sep = $total_sep;
        $nuevo_memoria_calculo->total_oct = $total_oct;
        $nuevo_memoria_calculo->total_nov = $total_nov;
        $nuevo_memoria_calculo->total_dic = $total_dic;
        $nuevo_memoria_calculo->total_final = $total_final;
        $nuevo_memoria_calculo->save();

        $nuevo_memoria_calculo->formulario_cinco()->create(["fecha_registro" => date("Y-m-d")]);

        return response()->JSON([
            'sw' => true,
            'memoria_calculo' => $nuevo_memoria_calculo,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, MemoriaCalculo $memoria_calculo)
    {
        $this->validacion['formulario_id'] = 'required|unique:memoria_calculos,formulario_id,' . $memoria_calculo->id;
        $request->validate($this->validacion, $this->mensajes);

        $request["total_actividades"] = 0;
        $request["total_ene"] = 0;
        $request["total_feb"] = 0;
        $request["total_mar"] = 0;
        $request["total_abr"] = 0;
        $request["total_may"] = 0;
        $request["total_jun"] = 0;
        $request["total_jul"] = 0;
        $request["total_ago"] = 0;
        $request["total_sep"] = 0;
        $request["total_oct"] = 0;
        $request["total_nov"] = 0;
        $request["total_dic"] = 0;
        $request["total_final"] = 0;

        $memoria_calculo->update(array_map('mb_strtoupper', $request->except("data", "eliminados", "tareas_eliminados", "partidas_eliminados")));

        $eliminados = $request->eliminados;
        if (isset($eliminados) && count($eliminados) > 0) {
            foreach ($eliminados as $eliminado) {
                $operacion = MemoriaOperacion::find($eliminado);
                $operacion->delete();
            }
        }

        $total_actividades = 0;
        $total_ene = 0;
        $total_feb = 0;
        $total_mar = 0;
        $total_abr = 0;
        $total_may = 0;
        $total_jun = 0;
        $total_jul = 0;
        $total_ago = 0;
        $total_sep = 0;
        $total_oct = 0;
        $total_nov = 0;
        $total_dic = 0;
        $total_final = 0;

        $data = $request->data;
        foreach ($data as $d) {

            if ($d["id"] == 0 || $d["id"] == "") {
                $nueva_operacion = $memoria_calculo->operacions()->create([
                    "operacion_id" => mb_strtoupper($d["operacion_id"]),
                    "ue" => mb_strtoupper($d["ue"]),
                    "prog" => mb_strtoupper($d["prog"]),
                    "act" => mb_strtoupper($d["act"]),
                    "detalle_operacion_id" => mb_strtoupper($d["detalle_operacion_id"]),
                    "lugar" => mb_strtoupper($d["lugar"]),
                    "responsable" => mb_strtoupper($d["responsable"]),
                    "partida_id" => mb_strtoupper($d["partida_id"]),
                    "partida" => mb_strtoupper($d["partida"]),
                    "nro" => mb_strtoupper($d["nro"]),
                    "descripcion" => mb_strtoupper($d["descripcion"]),
                    "descripcion_detallada" => mb_strtoupper($d["descripcion_detallada"]),
                    "cantidad" => $d["cantidad"],
                    "unidad" => mb_strtoupper($d["unidad"]),
                    "costo" => mb_strtoupper($d["costo"]),
                    "total" => $d["total"],
                    "justificacion" => mb_strtoupper($d["justificacion"]),
                    "ene" => $d["ene"],
                    "feb" => $d["feb"],
                    "mar" => $d["mar"],
                    "abr" => $d["abr"],
                    "may" => $d["may"],
                    "jun" => $d["jun"],
                    "jul" => $d["jul"],
                    "ago" => $d["ago"],
                    "sep" => $d["sep"],
                    "oct" => $d["oct"],
                    "nov" => $d["nov"],
                    "dic" => $d["dic"],
                    "total_operacion" => $d["total_operacion"],
                    "fecha_registro" => date("Y-m-d")
                ]);
            } else {
                // actualizar
                $memoria_operacion = MemoriaOperacion::find($d["id"]);
                $memoria_operacion->update([
                    "operacion_id" => mb_strtoupper($d["operacion_id"]),
                    "ue" => mb_strtoupper($d["ue"]),
                    "prog" => mb_strtoupper($d["prog"]),
                    "act" => mb_strtoupper($d["act"]),
                    "detalle_operacion_id" => mb_strtoupper($d["detalle_operacion_id"]),
                    "lugar" => mb_strtoupper($d["lugar"]),
                    "responsable" => mb_strtoupper($d["responsable"]),
                    "partida_id" => mb_strtoupper($d["partida_id"]),
                    "partida" => mb_strtoupper($d["partida"]),
                    "nro" => mb_strtoupper($d["nro"]),
                    "descripcion" => mb_strtoupper($d["descripcion"]),
                    "descripcion_detallada" => mb_strtoupper($d["descripcion_detallada"]),
                    "cantidad" => $d["cantidad"],
                    "unidad" => mb_strtoupper($d["unidad"]),
                    "costo" => mb_strtoupper($d["costo"]),
                    "total" => $d["total"],
                    "justificacion" => mb_strtoupper($d["justificacion"]),
                    "ene" => $d["ene"],
                    "feb" => $d["feb"],
                    "mar" => $d["mar"],
                    "abr" => $d["abr"],
                    "may" => $d["may"],
                    "jun" => $d["jun"],
                    "jul" => $d["jul"],
                    "ago" => $d["ago"],
                    "sep" => $d["sep"],
                    "oct" => $d["oct"],
                    "nov" => $d["nov"],
                    "dic" => $d["dic"],
                    "total_operacion" => $d["total_operacion"],
                ]);
                $nueva_operacion = $memoria_operacion;
            }


            $total_actividades += (float)$nueva_operacion->total;
            $total_ene += $nueva_operacion->ene ? (float)$nueva_operacion->ene : 0;
            $total_feb += $nueva_operacion->feb ? (float)$nueva_operacion->feb : 0;
            $total_mar += $nueva_operacion->mar ? (float)$nueva_operacion->mar : 0;
            $total_abr += $nueva_operacion->abr ? (float)$nueva_operacion->abr : 0;
            $total_may += $nueva_operacion->may ? (float)$nueva_operacion->may : 0;
            $total_jun += $nueva_operacion->jun ? (float)$nueva_operacion->jun : 0;
            $total_jul += $nueva_operacion->jul ? (float)$nueva_operacion->jul : 0;
            $total_ago += $nueva_operacion->ago ? (float)$nueva_operacion->ago : 0;
            $total_sep += $nueva_operacion->sep ? (float)$nueva_operacion->sep : 0;
            $total_oct += $nueva_operacion->oct ? (float)$nueva_operacion->oct : 0;
            $total_nov += $nueva_operacion->nov ? (float)$nueva_operacion->nov : 0;
            $total_dic += $nueva_operacion->dic ? (float)$nueva_operacion->dic : 0;
            $total_final += (float)$nueva_operacion->total_operacion;
        }

        $memoria_calculo->total_actividades = number_format($total_actividades, 2, ".", "");
        $memoria_calculo->total_ene = $total_ene;
        $memoria_calculo->total_feb = $total_feb;
        $memoria_calculo->total_mar = $total_mar;
        $memoria_calculo->total_abr = $total_abr;
        $memoria_calculo->total_may = $total_may;
        $memoria_calculo->total_jun = $total_jun;
        $memoria_calculo->total_jul = $total_jul;
        $memoria_calculo->total_ago = $total_ago;
        $memoria_calculo->total_sep = $total_sep;
        $memoria_calculo->total_oct = $total_oct;
        $memoria_calculo->total_nov = $total_nov;
        $memoria_calculo->total_dic = $total_dic;
        $memoria_calculo->total_final = $total_final;
        $memoria_calculo->save();

        if (!$memoria_calculo->formulario_cinco) {
            $memoria_calculo->formulario_cinco()->create(["fecha_registro" => date("Y-m-d")]);
        }

        return response()->JSON([
            'sw' => true,
            'memoria_calculo' => $memoria_calculo,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(MemoriaCalculo $memoria_calculo)
    {
        return response()->JSON([
            'sw' => true,
            'memoria_calculo' => $memoria_calculo
        ], 200);
    }

    public function destroy(MemoriaCalculo $memoria_calculo)
    {
        $existe_certificaciones = MemoriaOperacion::where("memoria_id", $memoria_calculo->id)
            ->join("certificacions", "certificacions.mo_id", "=", "memoria_operacions.id")
            ->get();
        if (count($existe_certificaciones) > 0) {
            return response()->JSON([
                'sw' => false,
                'msj' => 'No es posible eliminar este registro debido a que existen certificaciones realizadas'
            ], 200);
        }

        $memoria_calculo->operacions()->delete();
        $memoria_calculo->formulario_cinco()->delete();
        $memoria_calculo->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function getOperaciones(Request $request)
    {
        $formulario_cuatro = FormularioCuatro::find($request->formulario_id);
        $memoria_calculo = $formulario_cuatro->memoria_calculo;
        if ($memoria_calculo) {
            $operaciones = $memoria_calculo->operacions;
            return response()->JSON($operaciones);
        }
        return response()->JSON([]);
    }
    public function getTabla(MemoriaCalculo $memoria_calculo)
    {
        $html = view("parcial.memoria_calculo", compact("memoria_calculo"))->render();
        return response()->JSON($html);
    }
}
