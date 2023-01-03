<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    function index()
    {
        $aspirasi = Aspirasi::query()->orderBy('is_read','asc')->orderBy('created_at','desc')->get();

        return response()->json([
            "status" => true,
            "message" => "aspirasi masyarakat",
            "data" => $aspirasi
        ]);
    }

    function show($id)
    {
        $aspirasi = Aspirasi::query()->where("id", $id)->first();
        if (!isset($aspirasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "ini aspirasi",
            "data" => $aspirasi
        ]);
    }

    function store(Request $request)
    {
        // mengambil data dari request
        $payload = $request->all();
        if (!isset($payload['judul'])) {
            return response()->json([
                "status" => false,
                "message" => "input belum lengkap",
                "data" => null
            ]);
        }
        // end ambil data dari request
        // ------------ tolong direvisi
        $file = $request->file('foto');
        if ($file) {

            $filename = $file->hashName();
            $file->move("aspirasi", $filename);
            //pembuatan url foto
            $path = $request->getSchemeAndHttpHost() . "/aspirasi/" . $filename;
            //end pembuatan url foto

            //untuk memasukan posisi foto pada storage
            $path3 = $request->getSchemeAndHttpHost() . "aspirasi/" . $filename;
            $path2 = str_replace($request->getSchemeAndHttpHost(), "", $path3);
            //end memasukan posisi foto pada storage

        }
        //-------------endrevisi

        $payload['foto'] = $path;
        $payload['imgurl'] = $path2;

        $aspirasi = Aspirasi::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $aspirasi
        ]);
    }

    function update(Request $request, $id)
    {
        $aspirasi = Aspirasi::query()->where("id", $id)->first();
        if (!isset($aspirasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        $payload = $request->all();

        $file = $request->file('foto');
        $temp = $aspirasi->imgurl;


        if ($file) {

            $file = $request->file('foto');
            if ($file) {

                $filename = $file->hashName();
                $file->move("aspirasi", $filename);
                //pembuatan url foto
                $path = $request->getSchemeAndHttpHost() . "/aspirasi/" . $filename;
                //end pembuatan url foto

                //untuk memasukan posisi foto pada storage
                $path3 = $request->getSchemeAndHttpHost() . "aspirasi/" . $filename;
                $path2 = str_replace($request->getSchemeAndHttpHost(), "", $path3);
                //end memasukan posisi foto pada storage

            }


            $payload['foto'] = $path;
            $payload['imgurl'] = $path2;
            unlink($temp);
        }


        $aspirasi->fill($payload);
        $aspirasi->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $aspirasi
        ]);
    }

    function destroy(Request $request, $id)
    {
        $aspirasi = Aspirasi::query()->where("id", $id)->first();

        if (!isset($aspirasi)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }


        unlink($aspirasi->imgurl);


        $aspirasi->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $aspirasi
        ]);
    }
}
