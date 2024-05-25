<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get list of dosen pembimbing
        $getDosen = (new GetDataAPISiakad)->getDataDosen();

        // Filter dosen pembimbing by current user's program study
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

        // Get proposal data
        $no_induk = auth()->user()->no_induk;
        $dataProposal = DB::table('tr_pendaftaran as p')
            ->where('no_induk', $no_induk)->first();

        $data = [
            'allDosenPembimbing' => $allDosenPembimbing,
            'dataProposal' => $dataProposal,
            'berkasProposal' => null,
            'pembimbing' => null,
            'penguji' => null,
        ];

        // Get proposal berkas, pembimbing, dan penguji
        if (!empty($dataProposal)) {
            $data['berkasProposal'] = DB::table('tr_pendaftaran_berkas')
                ->where('pendaftaran_id', $dataProposal->id)->get();
            $data['pembimbing'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataProposal->id)
                ->where('tipe', 'like', 'B%')->get();
            $data['penguji'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataProposal->id)
                ->where('tipe', 'like', 'U%')->get();
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
                    'created_by' => auth()->user()->nama,
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
    
    public function approveDosenProposal($id)
    {
        try {
            $id = Crypt::decrypt($id);    
            $getDosenPembimbing = DB::table('tr_pendaftaran_dosen')->where('tipe', 'B')->where('pendaftaran_id', $id)->first();
            $value = $getDosenPembimbing->is_ok == 1 ? 0 : 1;        
            $getDosenPembimbing = DB::table('tr_pendaftaran_dosen')->where('tipe', 'B')->where('pendaftaran_id', $id)->update([
                'is_ok' => $value,
                'is_ok_by' => $no_induk = auth()->user()->nama,
                'is_ok_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json($value);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
