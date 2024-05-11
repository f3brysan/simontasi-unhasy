<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    public function index()
    {
        $data = [];

        $getDosen = (new GetDataAPISiakad)->getDataDosen();

        $allDosenPembimbing = [];
        foreach ($getDosen as $item) {
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

    public function storeProposal(Request $request)
    {
        try {
            $no_induk = auth()->user()->no_induk;
            $dataDosen = (new GetDataAPISiakad)->getDataDosen($request->dosen_pembimbing);

            $isExist = DB::table('tr_pendaftaran as p')
                ->where('no_induk', $no_induk)->exists();
            DB::beginTransaction();
            if ($isExist) {
                # code...
            } else {
                $idPendaftaran = Str::uuid();
                $insertProposal = DB::table('tr_pendaftaran')->insert([
                    'id' => $idPendaftaran,
                    'no_induk' => $no_induk,
                    'title' => $request->judul,
                    'type' => 'P', // P = Proposal
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $insertDosen = DB::table('tr_pendaftaran_dosen')->insert([
                    'id' => Str::uuid(),
                    'pendaftaran_id' => $idPendaftaran,
                    'nip' => $request->dosen_pembimbing,
                    'nama' => $dataDosen->nama,
                    'tipe' => 'B', // B = Pembimbing
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->user()->name,
                    'is_ok' => 0
                ]);

                if (($insertDosen == true) and ($insertProposal == true)) {
                    DB::commit();
                    return response()->json(true);
                } else {
                    DB::rollBack();
                    return response()->json(false);
                }

            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
