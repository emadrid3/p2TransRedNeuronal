<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogisticaController extends Controller
{
    public function index()
    {
        return view('logistic.logistic');
    }
    public function manageLogistic()
    {
        return view('logistic.logisticManage');
    }
}
