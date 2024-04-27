<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    public function index()
    {
        $data = [];
        
        $getDosen = $cekAuthSiakad = $this->requestData('https://siakad.unhasy.ac.id/api/all.php', 'POST', [
            'type' => 'dosen'
        ]);

        $allDosenPembimbing = [];
        foreach ($getDosen->data as $item) {
            if ($item->prodi_kode == auth()->user()->prodi_kode) {
                $allDosenPembimbing[$item->no_identitas] = [
                    'nip' => $item->no_identitas,
                    'nama' => $item->nama,
                ];
            }
        }
        ksort($allDosenPembimbing);
        $data['allDosenPembimbing'] = $allDosenPembimbing;

        $no_induk = auth()->user()->no_induk;
        $data['dataProposal'] = DB::table('tr_pendaftaran as p')
            ->where('no_induk', $no_induk)->first();

        $data['berkasProposal'] = null;
        $data['pembimbing'] = null;
        $data['penguji'] = null;

        if (!empty($data['dataProposal'])) {
            $data['berkasProposal'] = DB::table('tr_pendaftaran_berkas')->where('pendaftaran_id', $data['dataProposal']->id)->get();
            $data['pembimbing'] = DB::table('tr_pendaftaran_dosen')->where('pendaftaran_id', $data['dataProposal']->id)->where('tipe', 'like', 'B%')->get();
            $data['penguji'] = DB::table('tr_pendaftaran_dosen')->where('pendaftaran_id', $data['dataProposal']->id)->where('tipe', 'like', 'U%')->get();
        }

        // dd($data);

        return view('proposal.index', $data);
    }
}
