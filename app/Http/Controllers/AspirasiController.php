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

    function show($id)
    {
        $aspirasi = Aspirasi::query()->where("id", $id)->first();
        if (!isset($aspirasi)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
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
        $payload = $request->all();
        if (!isset($payload['judul'])) {
            return response()->json([
                "status" => false,
                "message" => "input belum lengkap",
                "data" => null
            ]);
        }

        // ------------ tolong direvisi
        if ($request->file("foto")) {
            $payload['foto'] = $request->file('foto')->store('foto', 'public');
            dd($payload['foto']);
        }
        //-------------endrevisi
        $author = Aspirasi::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $author
        ]);
    }

    function update(Request $request, $id)
    {
        $author = Aspirasi::query()->where("id", $id)->first();
        if (!isset($author)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = $request->all();


        // -------------tolong direvisi
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $file->hashName();
            $file->move('foto', $filename);
            $path = $request->getSchemeAndHttpHost() . '/foto/' . $filename;
            $payload['foto'] = $path;

            //file lama
            $lokasifoto = str_replace($request->getSchemeAndHttpHost(), '', $author->foto);
            $foto = public_path($lokasifoto);
            unlink($foto);
        }
        // --------------------endrevisi

        $author->fill($payload);
        $author->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $author
        ]);
    }

    function destroy(Request $request, $id)
    {
        $author = Aspirasi::query()->where("id", $id)->first();
        if (!isset($author)) {
            return response()->json([
                "status" => false,
                "message" => "data tidak ditemukan",
                "data" => null
            ]);
        }

        //-------------tolong direvisi
        if ($author->foto != '') {
            $lokasigambar = str_replace($request->getSchemeAndHttpHost(), '', $author->foto);
            $gambar = public_path($lokasigambar);
            unlink($gambar);
        }
        // ----------------endrevisi

        $author->delete();

        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $author
        ]);
    }
}
