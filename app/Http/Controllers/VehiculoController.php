<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        return view('vehicles.vehicles');
    }
    public function manageVehicles()
    {
        return view('vehicles.vehiclesManage');
    }
}
