<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\SimulasiBiaya;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class SimulasiBiayaController extends Controller
{
    //
    public function simpan(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kode_barang' => 'required|min:8 |max:8',
                'nilai_komoditas' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kode_barang = $request->kode_barang;
        $nilai_komoditas = $request->nilai_komoditas;

        // Ambil data uraian barang dari API
        $response_uraian = Http::get("https://insw-dev.ilcs.co.id/my/n/barang?hs_code={$kode_barang}");
        $data_uraian = $response_uraian->json('data');

        if (!empty($data_uraian)) {
            $uraian_barang = $data_uraian[0]['uraian_id'];
        } else {
            $uraian_barang = 'Uraian Barang Tidak Ditemukan';
        }


        // Ambil data tarif bm dari API
        $response_tarif = Http::get("https://insw-dev.ilcs.co.id/my/n/tarif?hs_code={$kode_barang}");
        $response = $response_tarif->json('data');

        if (!empty($response)) {
            $bm = $response[0]['bm'];
        } else {
            $bm = 0;
        }

        $nilai_bm = $nilai_komoditas * $bm / 100;

        $simulasi_biaya = SimulasiBiaya::create([
            'kode_barang' => $kode_barang,
            'uraian_barang' => $uraian_barang,
            'bm' => $bm,
            'nilai_komoditas' => $nilai_komoditas,
            'nilai_bm' => $nilai_bm,
        ]);

        if ($simulasi_biaya) {
            # code...
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $simulasi_biaya
            ], 201);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data gagal disimpan',
                'data' => null
            ], 400);
        }
    }


}
