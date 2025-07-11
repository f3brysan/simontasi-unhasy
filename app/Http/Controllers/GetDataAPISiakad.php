<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetDataAPISiakad extends Controller
{
    /**
     * Retrieves data for a specific dosen from the API.
     *
     * @param string|null $nip The NIP of the dosen to retrieve. If null, retrieves all dosen.
     * @return mixed|null The data for the dosen with the specified NIP, or all dosen if $nip is null. Returns null if the API request fails.
     */
    public function getDataDosen($nip = null)
    {
        try {
            $getDosen = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
                'type' => 'dosen'
            ]);

            $result = $getDosen->data;
            if ($nip != null) {
                foreach ($getDosen->data as $item) {
                    if ($item->no_identitas == $nip) {
                        $result = (object) [
                            'email' => $item->email,
                            'nama' => $item->nama,
                            'no_identitas' => $item->no_identitas,
                            'prodi_kode' => $item->prodi_kode
                        ];
                    }
                }
            }
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDataProdi($kode = null)
    {
        try {
            $getProdi = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
                'type' => 'prodi'
            ]);

            $result = $getProdi->data;

            if ($kode != null) {
                foreach ($getProdi->data as $item) {
                    if ($item->kode_prodi == $kode) {
                        $result = (object) [
                            'kode_fakultas' => $item->kode_fakultas,
                            'fakultas' => $item->fakultas,
                            'kode_prodi' => $item->kode_prodi,
                            'prodi' => $item->prodi
                        ];
                    }
                }
            }
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDataFakultas($kode = null)
    {
        try {
            $getFakultas = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
                'type' => 'prodi'
            ]);

            if ($kode != null) {
                foreach ($getFakultas->data as $item) {
                    if ($item->kode_fakultas == $kode) {
                        $result = (object) [
                            'kode_fakultas' => $item->kode_fakultas,
                            'fakultas' => $item->fakultas,
                        ];
                    }
                }
            } else {
                foreach ($getFakultas->data as $item) {
                    $result[$item->kode_fakultas] = (object) [
                        'kode_fakultas' => $item->kode_fakultas,
                        'fakultas' => $item->fakultas,
                    ];
                }
            }
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function void(Request $request)
    {
        try {
             $this->validate($request, [
                'token' => 'required',
                'url' => 'required'
            ]);            
            
            $response = Http::post($request->url, [
                'token' => $request->token,
            ]);

            return response()->json([
                'success' => true,
                'status' => $response->json()['status']
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
