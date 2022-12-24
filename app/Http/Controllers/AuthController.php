<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $req)
    {
        $email = $req->input('email');


        $email = $req->input('email');
        $password = $req->input('password');

        $user = User::query()->where('email', $email)->first();

        if ($user == null) {
            return response()->json([
                'status' => false,
                'message' => 'email salah',
                'data' => null
            ]);
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'password salah',
                'data' => null
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $user
        ]);

    }
}
