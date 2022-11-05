<?php

namespace App\Http\Controllers;

use App\Models\Semaforo;
use Illuminate\Http\Request;

class SemaforoController extends Controller
{
    public $validacion = [
        'descripcion' => 'required|min:4',
    ];

    public function index()
    {
        $semaforos = Semaforo::all();
        return response()->JSON(["semaforos" => $semaforos, "total" => count($semaforos)]);
    }

    public function store(Request $request)
    {
        $this->validacion["archivo"] = 'required|image|mimes:jpeg,jpg,png|max:4096';
        $request->validate($this->validacion);
        $request["fecha_registro"] = date("Y-m-d");
        $semaforo = Semaforo::create(array_map("mb_strtoupper", $request->except("archivo")));
        if ($request->hasFile('archivo')) {
            $file = $request->archivo;
            $nom_archivo = time() . '_semaforo' . $semaforo->id . '.' . $file->getClientOriginalExtension();
            $semaforo->archivo = $nom_archivo;
            $file->move(public_path() . '/files/', $nom_archivo);
            $semaforo->save();
        }
        return response()->JSON(["sw" => true, "msj" => "El registro se almacenó correctamente"]);
    }

    public function show(Semaforo $semaforo)
    {
        return response()->JSON($semaforo);
    }

    public function update(Semaforo $semaforo, Request $request)
    {
        if ($request->hasFile('archivo')) {
            $this->validacion["archivo"] = 'required|image|mimes:jpeg,jpg,png|max:4096';
        }
        $request->validate($this->validacion);
        $semaforo->update(array_map("mb_strtoupper", $request->except("archivo")));
        if ($request->hasFile('archivo')) {
            $antiguo = $semaforo->archivo;
            \File::delete(public_path() . "/files/" . $antiguo);

            $file = $request->archivo;
            $nom_archivo = time() . '_semaforo' . $semaforo->id . '.' . $file->getClientOriginalExtension();
            $semaforo->archivo = $nom_archivo;
            $file->move(public_path() . '/files/', $nom_archivo);
            $semaforo->save();
        }
        return response()->JSON(["sw" => true, "semaforo" => $semaforo, "msj" => "El registro se actualizó correctamente"]);
    }

    public function destroy(Semaforo $semaforo)
    {
        $antiguo = $semaforo->archivo;
        \File::delete(public_path() . "/files/" . $antiguo);
        $semaforo->delete();
        return response()->JSON(["sw" => true, "semaforo" => $semaforo, "msj" => "El registro se actualizó correctamente"]);
    }
}
