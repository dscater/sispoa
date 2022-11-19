<?php

namespace App\Http\Controllers;

use App\Models\FormularioCuatro;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public $validacion = [
        'nombre' => 'required|min:4',
    ];

    public function index()
    {
        $unidads = Unidad::all();
        return response()->JSON(["unidads" => $unidads, "total" => count($unidads)]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion);
        Unidad::create(array_map("mb_strtoupper", $request->all()));
        return response()->JSON(["sw" => true, "msj" => "El registro se almacenó correctamente"]);
    }

    public function show(Unidad $unidad)
    {
        return response()->JSON($unidad);
    }

    public function update(Unidad $unidad, Request $request)
    {
        $request->validate($this->validacion);
        $unidad->update(array_map("mb_strtoupper", $request->all()));
        return response()->JSON(["sw" => true, "unidad" => $unidad, "msj" => "El registro se actualizó correctamente"]);
    }

    public function destroy(Unidad $unidad)
    {
        $existe = User::where("unidad_id", $unidad->id)->get();
        if (count($existe) > 0) {
            return response()->JSON(["sw" => false, "unidad" => $unidad, "msj" => "No es posible eliminar este registro, porque esta siendo utilizado por otros modulos"]);
        }

        $existe = FormularioCuatro::where("unidad_id", $unidad->id)->get();
        if (count($existe) > 0) {
            return response()->JSON(["sw" => false, "unidad" => $unidad, "msj" => "No es posible eliminar este registro, porque esta siendo utilizado por otros modulos"]);
        }

        $unidad->delete();
        return response()->JSON(["sw" => true, "msj" => "El registro se eliminó correctamente"]);
    }
}
