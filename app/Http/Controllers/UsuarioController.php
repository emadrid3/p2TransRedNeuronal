<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('users.users');
    }

    
    public function manageUsers()
    {
        return view('users.usersManage');
    }

    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $result = $user->save();

        if ($result) {
            return response()->json(['message' => 'User create succesfully'], 201);
        }else{
            return response()->json(['message' => 'Error to create user'], 500);
        }
    }
}
