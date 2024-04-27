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
}
