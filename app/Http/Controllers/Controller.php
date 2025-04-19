<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function requestData($url, $method = 'GET', $data = null)
    {
        $option = [
            'headers' => [
                'Accept' => 'application/json',
            ]
        ];

        if ($data != null) {
            $option['form_params'] = $data;
        }

        $client = new Client();
        $res = $client->request($method, $url, $option);
        $stream = $res->getBody()->getContents();

        $hasil = json_decode($stream);
        return $hasil;
    }

    /**
     * Konversi nilai berupa angka ke dalam bentuk huruf dan point.
     *
     * @param float $value
     * @return array
     */
    public function konversiNilai($value)
    {
        // Ambil data master nilai dari database
        $getMasterNilai = DB::table('ms_nilai')->where('min', '<=', $value)->where('max', '>=', $value)->get();

        // Jika data master nilai tidak kosong, maka ambil nilai grade dan konversi
        if ($getMasterNilai->count() > 0) {
            $result = [
                'nilai' => $value,
                'letter_grade' => $getMasterNilai->first()->grade ?? '',
                'point' => $getMasterNilai->first()->konversi ?? '',
            ];
        } else {
            // Jika data master nilai kosong, maka return kosong
            $result = [];
        }
        return $result;
    }
}
