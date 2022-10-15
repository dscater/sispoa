<?php

namespace App\Http\Controllers;

use App\Models\DetalleFormulario;
use App\Models\DetalleOperacion;
use App\Models\Operacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleFormularioController extends Controller
{
    public $validacion = [
        'formulario_id' => 'required||unique:detalle_formularios,formulario_id',
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $detalle_formularios = DetalleFormulario::all();
        return response()->JSON(['detalle_formularios' => $detalle_formularios, 'total' => count($detalle_formularios)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        $nuevo_detalle_formulario = DetalleFormulario::create(array_map('mb_strtoupper', $request->except("data")));

        $data = $request->data;
        foreach ($data as $d) {
            $nueva_operacion = $nuevo_detalle_formulario->operacions()->create([
                "codigo_operacion" => mb_strtoupper($d["codigo_operacion"]),
                "operacion" => mb_strtoupper($d["operacion"]),
            ]);
            foreach ($d["detalle_operaciones"] as $do) {
                $nueva_operacion->detalle_operaciones()->create([
                    "ponderacion" => $do["ponderacion"],
                    "resultado_esperado" => mb_strtoupper($do["resultado_esperado"]),
                    "medios_verificacion" => mb_strtoupper($do["medios_verificacion"]),
                    "codigo_tarea" => mb_strtoupper($do["codigo_tarea"]),
                    "actividad_tarea" => mb_strtoupper($do["actividad_tarea"]),
                    "pt_e" => mb_strtoupper($do["pt_e"]),
                    "pt_f" => mb_strtoupper($do["pt_f"]),
                    "pt_m" => mb_strtoupper($do["pt_m"]),
                    "st_a" => mb_strtoupper($do["st_a"]),
                    "st_m" => mb_strtoupper($do["st_m"]),
                    "st_j" => mb_strtoupper($do["st_j"]),
                    "tt_j" => mb_strtoupper($do["tt_j"]),
                    "tt_a" => mb_strtoupper($do["tt_a"]),
                    "tt_s" => mb_strtoupper($do["tt_s"]),
                    "ct_o" => mb_strtoupper($do["ct_o"]),
                    "ct_n" => mb_strtoupper($do["ct_n"]),
                    "ct_d" => mb_strtoupper($do["ct_d"]),
                    "inicio" => $do["inicio"],
                    "final" => $do["final"],
                ]);
            }
        }

        return response()->JSON([
            'sw' => true,
            'detalle_formulario' => $nuevo_detalle_formulario,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, DetalleFormulario $detalle_formulario)
    {
        $this->validacion['formulario_id'] = 'required||unique:detalle_formularios,formulario_id,' . $detalle_formulario->id;
        $request->validate($this->validacion, $this->mensajes);
        $detalle_formulario->update(array_map('mb_strtoupper', $request->except("data", "eliminados", "do_eliminados")));

        $eliminados = $request->eliminados;
        $do_eliminados = $request->do_eliminados;
        if (isset($eliminados) && count($eliminados) > 0) {
            foreach ($eliminados as $eliminado) {
                $operacion = Operacion::find($eliminado);
                DB::delete("DELETE FROM detalle_operacions WHERE operacion_id=$operacion->id");
                $operacion->delete();
            }
        }
        if (isset($do_eliminados) && count($do_eliminados) > 0) {
            foreach ($do_eliminados as $eliminado) {
                $do = DetalleOperacion::find($eliminado);
                $do->delete();
            }
        }

        $data = $request->data;
        foreach ($data as $d) {
            if ($d["id"] == 0 || $d["id"] == "") {
                $nueva_operacion = $detalle_formulario->operacions()->create([
                    "codigo_operacion" => mb_strtoupper($d["codigo_operacion"]),
                    "operacion" => mb_strtoupper($d["operacion"]),
                ]);
            } else {
                $operacion = Operacion::find($d["id"]);
                $nueva_operacion = $operacion;
                $operacion->update([
                    "codigo_operacion" => mb_strtoupper($d["codigo_operacion"]),
                    "operacion" => mb_strtoupper($d["operacion"]),
                ]);
            }


            foreach ($d["detalle_operaciones"] as $do) {
                if ($do["id"] == 0 || $do["id"] == "") {
                    $nueva_operacion->detalle_operaciones()->create([
                        "ponderacion" => $do["ponderacion"],
                        "resultado_esperado" => mb_strtoupper($do["resultado_esperado"]),
                        "medios_verificacion" => mb_strtoupper($do["medios_verificacion"]),
                        "codigo_tarea" => mb_strtoupper($do["codigo_tarea"]),
                        "actividad_tarea" => mb_strtoupper($do["actividad_tarea"]),
                        "pt_e" => mb_strtoupper($do["pt_e"]),
                        "pt_f" => mb_strtoupper($do["pt_f"]),
                        "pt_m" => mb_strtoupper($do["pt_m"]),
                        "st_a" => mb_strtoupper($do["st_a"]),
                        "st_m" => mb_strtoupper($do["st_m"]),
                        "st_j" => mb_strtoupper($do["st_j"]),
                        "tt_j" => mb_strtoupper($do["tt_j"]),
                        "tt_a" => mb_strtoupper($do["tt_a"]),
                        "tt_s" => mb_strtoupper($do["tt_s"]),
                        "ct_o" => mb_strtoupper($do["ct_o"]),
                        "ct_n" => mb_strtoupper($do["ct_n"]),
                        "ct_d" => mb_strtoupper($do["ct_d"]),
                        "inicio" => $do["inicio"],
                        "final" => $do["final"],
                    ]);
                } else {
                    $detalle_operacion = DetalleOperacion::find($do["id"]);
                    $detalle_operacion->update([
                        "ponderacion" => $do["ponderacion"],
                        "resultado_esperado" => mb_strtoupper($do["resultado_esperado"]),
                        "medios_verificacion" => mb_strtoupper($do["medios_verificacion"]),
                        "codigo_tarea" => mb_strtoupper($do["codigo_tarea"]),
                        "actividad_tarea" => mb_strtoupper($do["actividad_tarea"]),
                        "pt_e" => mb_strtoupper($do["pt_e"]),
                        "pt_f" => mb_strtoupper($do["pt_f"]),
                        "pt_m" => mb_strtoupper($do["pt_m"]),
                        "st_a" => mb_strtoupper($do["st_a"]),
                        "st_m" => mb_strtoupper($do["st_m"]),
                        "st_j" => mb_strtoupper($do["st_j"]),
                        "tt_j" => mb_strtoupper($do["tt_j"]),
                        "tt_a" => mb_strtoupper($do["tt_a"]),
                        "tt_s" => mb_strtoupper($do["tt_s"]),
                        "ct_o" => mb_strtoupper($do["ct_o"]),
                        "ct_n" => mb_strtoupper($do["ct_n"]),
                        "ct_d" => mb_strtoupper($do["ct_d"]),
                        "inicio" => $do["inicio"],
                        "final" => $do["final"],
                    ]);
                }
            }
        }

        return response()->JSON([
            'sw' => true,
            'detalle_formulario' => $detalle_formulario,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(DetalleFormulario $detalle_formulario)
    {
        return response()->JSON([
            'sw' => true,
            'detalle_formulario' => $detalle_formulario
        ], 200);
    }

    public function destroy(DetalleFormulario $detalle_formulario)
    {
        foreach ($detalle_formulario->operacions as $o) {
            DB::delete("DELETE FROM detalle_operacions WHERE operacion_id = $o->id");
            $o->delete();
        }
        $detalle_formulario->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}
