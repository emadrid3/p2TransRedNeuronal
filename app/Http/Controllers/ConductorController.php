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
        return view('drivers.driversManage', ['driver' => $driver]);
    }

   /*  public function editDrivers($id)
    {
        $driver = conductor::find($id);
        return view('drivers.driversManage', ['driver' => $driver]);
    } */

    public function list(Request $request){
        try {
            $listDrivers = conductor::paginate($request->input('size'));
            return response()->json($listDrivers);
        } catch (\Exception $e) {
           throw $e;
        }
    }

   /*  public function create(Request $request)
    {
        try {
            $request->validate(["name"=>"required", "email"=>"required"]);
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            
            return response()->json(['message' => 'User create succesfully']);
            
        } catch (\Exception $e) {
           throw $e;
        }
    } */
}
