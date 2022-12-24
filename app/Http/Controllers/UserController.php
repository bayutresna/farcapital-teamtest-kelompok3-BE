<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function index(){
        $user = User::query()->get();
        return response()->json([
            'status' => true,
            'message' => 'data user ada',
            'data'=> $user
        ]);
    }

    function show($id){
        $user = User::query()->where('id', $id)->first();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'data tak da',
                'data'=> null
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'data user ada',
            'data'=> $user
        ]);
    }
    function store(Request $req){

        $payload = $req->all();
        $user = User::query()->create($payload);
        return response()->json([
            'status' => true,
            'message' => 'data user telah masuk',
            'data'=> $user
        ]);
    }

    function update(Request $req, $id){
        $user = User::query()->where('id', $id)->first();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'data tak da',
                'data'=> null
            ]);
        }

        $payload = $req->all();

        $user->fill($payload);
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'data user telah diubah',
            'data'=> $user
        ]);
    }

    function destroy($id){
        $user = User::query()->where('id', $id)->first();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'data tak da',
                'data'=> null
            ]);
        }
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'data dihapus',
            'data'=> null
        ]);
    }
}
