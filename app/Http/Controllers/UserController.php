<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function store(Request $req){
        $payload = $req->all();
        $user = User::query()->create($payload);
        return response()->json([
            'status' => true,
            'message' => 'data user telah masuk',
            'data'=> $user
        ]);
    }
}
