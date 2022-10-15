<?php

namespace App\Http\Controllers;

use App\Models\ActividadTarea;
use App\Models\FCOperacion;
use App\Models\FormularioCinco;
use App\Models\LugarResponsable;
use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormularioCincoController extends Controller
{
    public $validacion = [
        'formulario_id' => 'required||unique:formulario_cinco,formulario_id',
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $listado = FormularioCinco::all();
        return response()->JSON(['listado' => $listado, 'total' => count($listado)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        $request['total_formulario'] = 0;
        $nuevo_formulario_cinco = FormularioCinco::create(array_map('mb_strtoupper', $request->except("data")));

        $data = $request->data;
        $total_formulario = 0;
        foreach ($data as $d) {
            $nueva_operacion = $nuevo_formulario_cinco->operacions()->create([
                "operacion_id" => mb_strtoupper($d["operacion_id"]),
                "total_operacion" => mb_strtoupper($d["total_operacion"]),
            ]);
            foreach ($d["lugar_responsables"] as $lugar_responsable) {
                $nuevo_lugar_responsable = $nueva_operacion->lugar_responsables()->create([
                    "lugar" => $lugar_responsable["lugar"],
                    "responsable" => $lugar_responsable["responsable"],
                ]);
                foreach ($lugar_responsable["actividad_tareas"] as $tarea) {
                    $nuevo_lugar_responsable->actividad_tareas()->create([
                        "fco_id" => $nueva_operacion->id,
                        "detalle_operacion_id" => $tarea["detalle_operacion_id"]
                    ]);
                }

                foreach ($lugar_responsable["partidas"] as $partida) {
                    $nueva_partida = $nuevo_lugar_responsable->partidas()->create([
                        "partida" => $partida["partida"],
                        "descripcion" => $partida["descripcion"],
                        "cantidad" => $partida["cantidad"],
                        "unidad" => $partida["unidad"],
                        "costo" => $partida["costo"],
                        "t42" => $partida["t42"],
                        "ue" => $partida["ue"],
                        "prog" => $partida["prog"],
                        "act" => $partida["act"],
                        "otros" => $partida["otros"],
                    ]);
                    $total_formulario += (float)$nueva_partida->cantidad * (float)$nueva_partida->costo;
                }
            }
        }
        $nuevo_formulario_cinco->total_formulario = $total_formulario;
        $nuevo_formulario_cinco->save();

        return response()->JSON([
            'sw' => true,
            'formulario_cinco' => $nuevo_formulario_cinco,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, FormularioCinco $formulario_cinco)
    {
        $this->validacion['formulario_id'] = 'required||unique:formulario_cinco,formulario_id,' . $formulario_cinco->id;
        $request->validate($this->validacion, $this->mensajes);
        $formulario_cinco->update(array_map('mb_strtoupper', $request->except("data", "eliminados", "tareas_eliminados", "partidas_eliminados")));

        $eliminados = $request->eliminados;
        if (isset($eliminados) && count($eliminados) > 0) {
            foreach ($eliminados as $eliminado) {
                $operacion = FCOperacion::find($eliminado);
                foreach ($operacion->lugar_responsables as $lugar) {
                    DB::delete("DELETE FROM partidas WHERE lugar_responsable_id=$lugar->id");
                    DB::delete("DELETE FROM actividad_tareas WHERE lugar_responsable_id=$lugar->id");
                    $lugar->delete();
                }
                $operacion->delete();
            }
        }

        $tareas_eliminados = $request->tareas_eliminados;
        if (isset($tareas_eliminados) && count($tareas_eliminados) > 0) {
            foreach ($tareas_eliminados as $eliminado) {
                $tarea = ActividadTarea::find($eliminado);
                $tarea->delete();
            }
        }

        $partidas_eliminados = $request->partidas_eliminados;
        if (isset($partidas_eliminados) && count($partidas_eliminados) > 0) {
            foreach ($partidas_eliminados as $eliminado) {
                $partida = Partida::find($eliminado);
                $partida->delete();
            }
        }

        $data = $request->data;
        $total_formulario = 0;
        foreach ($data as $d) {
            if ($d["id"] == 0 || $d["id"] == "") {
                // crear
                $nueva_operacion = $formulario_cinco->operacions()->create([
                    "operacion_id" => mb_strtoupper($d["operacion_id"]),
                    "total_operacion" => mb_strtoupper($d["total_operacion"]),
                ]);
            } else {
                // actualizar
                $fco = FCOperacion::find($d["id"]);
                $fco->update([
                    "operacion_id" => mb_strtoupper($d["operacion_id"]),
                    "total_operacion" => mb_strtoupper($d["total_operacion"]),
                ]);
                $nueva_operacion = $fco;
            }
            foreach ($d["lugar_responsables"] as $lugar_responsable) {
                if ($lugar_responsable["id"] == 0 || $lugar_responsable["id"] == "") {
                    $nuevo_lugar_responsable = $nueva_operacion->lugar_responsables()->create([
                        "lugar" => $lugar_responsable["lugar"],
                        "responsable" => $lugar_responsable["responsable"],
                    ]);
                } else {
                    $lr = LugarResponsable::find($lugar_responsable["id"]);
                    $lr->update([
                        "lugar" => $lugar_responsable["lugar"],
                        "responsable" => $lugar_responsable["responsable"],
                    ]);
                    $nuevo_lugar_responsable = $lr;
                }
                foreach ($lugar_responsable["actividad_tareas"] as $tarea) {
                    if ($tarea["id"] == 0 || $tarea["id"] == "") {
                        $nuevo_lugar_responsable->actividad_tareas()->create([
                            "fco_id" => $nueva_operacion->id,
                            "detalle_operacion_id" => $tarea["detalle_operacion_id"]
                        ]);
                    } else {
                        $t = ActividadTarea::find($tarea["id"]);
                        $t->update([
                            "fco_id" => $nueva_operacion->id,
                            "detalle_operacion_id" => $tarea["detalle_operacion_id"]
                        ]);
                    }
                }

                foreach ($lugar_responsable["partidas"] as $partida) {
                    if ($partida["id"] == 0 || $partida["id"] == "") {
                        $nueva_partida = $nuevo_lugar_responsable->partidas()->create([
                            "partida" => $partida["partida"],
                            "descripcion" => $partida["descripcion"],
                            "cantidad" => $partida["cantidad"],
                            "unidad" => $partida["unidad"],
                            "costo" => $partida["costo"],
                            "t42" => $partida["t42"],
                            "ue" => $partida["ue"],
                            "prog" => $partida["prog"],
                            "act" => $partida["act"],
                            "otros" => $partida["otros"],
                        ]);
                    } else {
                        $p = Partida::find($partida["id"]);
                        $p->update([
                            "partida" => $partida["partida"],
                            "descripcion" => $partida["descripcion"],
                            "cantidad" => $partida["cantidad"],
                            "unidad" => $partida["unidad"],
                            "costo" => $partida["costo"],
                            "t42" => $partida["t42"],
                            "ue" => $partida["ue"],
                            "prog" => $partida["prog"],
                            "act" => $partida["act"],
                            "otros" => $partida["otros"],
                        ]);
                        $nueva_partida = $p;
                    }
                    $total_formulario += (float)$nueva_partida->cantidad * (float)$nueva_partida->costo;
                }
            }
        }
        $formulario_cinco->total_formulario = $total_formulario;
        $formulario_cinco->save();

        return response()->JSON([
            'sw' => true,
            'formulario_cinco' => $formulario_cinco,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(FormularioCinco $formulario_cinco)
    {
        return response()->JSON([
            'sw' => true,
            'formulario_cinco' => $formulario_cinco
        ], 200);
    }

    public function destroy(FormularioCinco $formulario_cinco)
    {
        foreach ($formulario_cinco->operacions as $operacion) {
            foreach ($operacion->lugar_responsables as $lugar) {
                DB::delete("DELETE FROM partidas WHERE lugar_responsable_id=$lugar->id");
                DB::delete("DELETE FROM actividad_tareas WHERE lugar_responsable_id=$lugar->id");
                $lugar->delete();
            }
            $operacion->delete();
        }
        $formulario_cinco->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}