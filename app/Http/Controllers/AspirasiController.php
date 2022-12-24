<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    function index()
    {
        $aspirasi = Aspirasi::query()->get();

        return response()->json([
            "status" => true,
            "message" => "aspirasi masyarakat",
            "data" => $aspirasi
        ]);
    }
}
