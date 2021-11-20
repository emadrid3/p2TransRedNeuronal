<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EventosController extends Controller
{
    public function index()
    {
        return view('events.events');
    }
}
