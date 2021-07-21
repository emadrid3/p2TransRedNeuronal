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
    public function list(Request $request){
        try {
            $listHistory = historial::paginate($request->input('size'));
            return response()->json($listHistory);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
