<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetDataAPISiakad extends Controller
{
    public function getDataDosen($nip = null)
    {
        $getDosen = $cekAuthSiakad = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
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
    }

    public function getDataProdi($kode = null)
    {
        $getProdi = $cekAuthSiakad = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
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
    }

    public function getDataFakultas($kode = null)
    {
        $getFakultas = $cekAuthSiakad = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
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
    }
}
