<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use Illuminate\Http\Request;
use PDF;

class CertificacionController extends Controller
{
    public $validacion = [
        'formulario_id' => 'required',
        'fco_id' => 'required',
        'actividad_tarea_id' => 'required',
        'partida_id' => 'required',
        'cantidad_usar' => 'required',
        'justificacion' => 'required',
        'correlativo' => 'required',
        'solicitante_id' => 'required',
        'superior_id' => 'required',
        'ue' => 'required',
        'prog' => 'required',
        'proy' => 'required',
        'act' => 'required',
        'ff' => 'required',
        'of' => 'required',
        'codigo' => 'required',
        'accion' => 'required',
        'estado' => 'required',
    ];

    public function index()
    {
        $certificacions = Certificacion::all();
        return response()->JSON(["certificacions" => $certificacions, "total" => count($certificacions)]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $this->validacion['archivo'] = 'file';
        }
        $request->validate($this->validacion);
        $request["fecha_registro"] = date("Y-m-d");
        $certificacion = Certificacion::create(array_map("mb_strtoupper", $request->except("archivo")));
        if ($request->hasFile('archivo')) {
            $file = $request->archivo;
            $nom_archivo = time() . '_' . $certificacion->id . '.' . $file->getClientOriginalExtension();
            $certificacion->archivo = $nom_archivo;
            $file->move(public_path() . '/archivos/', $nom_archivo);
            $certificacion->save();
        }
        return response()->JSON(["sw" => true, "msj" => "El registro se almacenó correctamente"]);
    }

    public function show(Certificacion $certificacion)
    {
        return response()->JSON($certificacion);
    }

    public function pdf(Certificacion $certificacion)
    {

        $pdf = PDF::loadView('reportes.certificacion', compact('certificacion'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('Certificacion.pdf');
    }

    public function update(Certificacion $certificacion, Request $request)
    {
        if ($request->hasFile('foto')) {
            $this->validacion['archivo'] = 'file';
        }
        $request->validate($this->validacion);
        $certificacion->update(array_map("mb_strtoupper", $request->except("archivo")));

        if ($request->hasFile('archivo')) {
            $antiguo = $certificacion->archivo;
            if ($antiguo) {
                \File::delete(public_path() . '/archivos/' . $antiguo);
            }
            $file = $request->archivo;
            $nom_archivo = time() . '_' . $certificacion->id . '.' . $file->getClientOriginalExtension();
            $certificacion->archivo = $nom_archivo;
            $file->move(public_path() . '/archivos/', $nom_archivo);
            $certificacion->save();
        }

        return response()->JSON(["sw" => true, "certificacion" => $certificacion, "msj" => "El registro se actualizó correctamente"]);
    }

    public function destroy(Certificacion $certificacion)
    {
        $antiguo = $certificacion->archivo;
        \File::delete(public_path() . '/archivos/' . $antiguo);
        $certificacion->delete();
        return response()->JSON(["sw" => true, "certificacion" => $certificacion, "msj" => "El registro se actualizó correctamente"]);
    }

    public function getNroCorrelativo()
    {
        $ultimo = Certificacion::get()->last();
        if ($ultimo) {
            return response()->JSON((int)$ultimo->correlativo + 1);
        }
        return response()->JSON(1);
    }
}
