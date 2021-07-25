<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\conductor;

class ConductorController extends Controller
{
    public function index()
    {
        return view('drivers.drivers');
    }

    public function manageDrivers()
    {
        $driver = null;
        return view('drivers.driversManage', ['driver' => $driver]);
    }


    public function list(Request $request){
        try {
            $listDrivers = conductor::paginate($request->input('size'));
            return response()->json($listDrivers);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function editDrivers($id)
    {
        $driver = conductor::find($id);
        return view('drivers.driversManage', ['driver' => $driver]);
    }

    public function update(Request $request){
        try {
            $request->validate(["nombre"=>"required", "cedula"=>"required", "celular"=>"required"]);
            $driver = conductor::find($request->input('id'));
            if( !is_null($request->input('nombre')) ){
                $driver->nombre = $request->input('nombre');
            }
            if( !is_null($request->input('cedula')) ){
                $driver->cedula = $request->input('cedula');
            }
            if( !is_null($request->input('celular')) ){
                $driver->celular = $request->input('celular');
            }
            $driver->save();
            return response()->json(['message' => 'Conductor actualizado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function delete(Request $request){
        try {
            $driver = conductor::find($request->input('id'));
            $driver->delete();
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function create(Request $request)
    {
        try {
            $request->validate(["nombre"=>"required", "cedula"=>"required", "celular"=>"required"]);
            $driver = new conductor();
            $driver->nombre = $request->input('nombre');
            $driver->cedula = $request->input('cedula');
            $driver->celular = $request->input('celular');
            $driver->save();

            return response()->json(['message' => 'Conductor creado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $drivers = conductor::where('nombre','like',"%$input%")
            ->orWhere('cedula','like',"%$input%")
            ->orWhere('celular','like',"%$input%")
            ->paginate($request->input('size'));

            return response()->json($drivers);
        } catch (\Exception $e) {
           throw $e;
        }
    }

}
