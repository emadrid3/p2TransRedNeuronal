<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\historial;

class HistorialController extends Controller
{
    public function index()
    {
        return view('histories.histories');
    }
  /*   public function list(Request $request){
        try {
            $listCustomer = cliente::paginate($request->input('size'));
            return response()->json($listCustomer);
        } catch (\Exception $e) {
           throw $e;
        }
    } */
}
