<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SkorController extends Controller
{
    public function hitungSkor()
    {
        // List data hasil pengerjaan soal oleh siswa
        $data_hasil = [
            'Andi' => ['BENAR', 'SALAH', 'BENAR', 'BENAR', 'SALAH'],
            'Maya' => ['SALAH', 'SALAH', 'SALAH', 'BENAR', 'BENAR'],
            'Budi' => ['BENAR', 'SALAH', 'BENAR', 'SALAH', 'BENAR'],
            'Asih' => ['BENAR', 'BENAR', 'BENAR', 'BENAR', 'SALAH'],
            'Raja' => ['SALAH', 'SALAH', 'BENAR', 'BENAR', 'BENAR']
        ];

        // List bobot poin soal-soal
        $skor_bobot = [10, 30, 20, 20, 20];

        // Menghitung skor akhir untuk setiap siswa
        $skor_akhir = [];
        foreach ($data_hasil as $siswa => $hasil) {
            $skor = 0;
            foreach ($hasil as $index => $jawaban) {
                if ($jawaban === 'BENAR') {
                    $skor += $skor_bobot[$index];
                }
            }
            $skor_akhir[] = [
                'index' => count($skor_akhir) + 1,
                'nama' => $siswa,
                'skor' => $skor
            ];
        }

        // Mengurutkan skor akhir secara descending
        usort($skor_akhir, function($a, $b) {
            return $b['skor'] - $a['skor'];
        });

        // Mencetak output yang diharapkan
        return response()->json($skor_akhir);
    }
}
