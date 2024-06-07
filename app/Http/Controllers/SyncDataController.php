<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyncDataController extends Controller
{
    public function syncDataDosen()
    {
        try {
            $getDosen = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
                'type' => 'dosen'
            ]);

            $newData = 0;
            foreach ($getDosen->data as $item) {
                $checkExist = DB::table('ms_dosen')->where('no_identitas', $item->no_identitas)->exists();
                if (!$checkExist) {
                    DB::table('ms_dosen')->insert([
                        'email' => $item->email,
                        'nama' => $item->nama,
                        'no_identitas' => $item->no_identitas,
                        'prodi_kode' => $item->prodi_kode
                    ]);
                    $newData++;
                }
            }
            return $newData;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function syncDataProdi()
    {
        try {
            $getProdi = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
                'type' => 'prodi'
            ]);

            $newData = 0;
            foreach ($getProdi->data as $item) {
                $checkExist = DB::table('ms_prodi')->where('kode_prodi', $item->kode_prodi)->exists();
                if (!$checkExist) {
                    DB::table('ms_prodi')->insert([
                        'kode_fakultas' => $item->kode_fakultas,
                        'fakultas' => $item->fakultas,
                        'kode_prodi' => $item->kode_prodi,
                        'prodi' => $item->prodi
                    ]);
                    $newData++;
                }
            }
            return $newData;
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
}
