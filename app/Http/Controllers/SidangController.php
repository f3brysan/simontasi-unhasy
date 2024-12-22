<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SidangController extends Controller
{
    public function index()
    {
        $no_induk = auth()->user()->no_induk;
        $dataProposal = DB::table('tr_pendaftaran as tp')
            ->select('tp.*')
            ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')
            ->where('tp.no_induk', $no_induk)
            ->whereIn('tps.status', ['1'])
            ->first();
        $data['prodi'] = DB::table('ms_prodi')->where('kode_prodi', auth()->user()->prodi_kode)->first()->prodi;
        if (empty($dataProposal)) {
            return redirect()->route('dashboard')->with('error', 'Anda belum memiliki proposal yang disetujui');
        } else {
            $data['proposal'] = $dataProposal;
            $data['pembimbing'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataProposal->id)
                ->where('tipe', 'like', 'B%')->get();
            $data['penguji'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataProposal->id)
                ->where('tipe', 'like', 'U%')->get();
            return view('sidang.daftar', $data);
        }

    }


    public function daftarSidang(Request $request)
    {        

        try {
            DB::beginTransaction();
            $idPendaftaranSidang = Str::uuid();
            $insertSidang = DB::table('tr_pendaftaran')->insert([
                'id' => $idPendaftaranSidang,
                'no_induk' => $request->nim,
                'title' => $request->judul,
                'type' => 'T', 
                'created_at' => now(),
            ]);

            $idProposal = DB::table('tr_pendaftaran as tp')
            ->select('tp.*')
            ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')
            ->where('tp.no_induk', $request->nim)
            ->whereIn('tps.status', ['1'])
            ->first()->id;

            $getDosen = DB::table('tr_pendaftaran_dosen')->where('pendaftaran_id', $idProposal)->get();
            $countDosen = count($getDosen);
            $countDosenDone = 0;
            foreach ($getDosen as $key => $value) {
                $insertDosenSidang = DB::table('tr_pendaftaran_dosen')->insert([
                    'id' => Str::uuid(),
                    'pendaftaran_id' => $idPendaftaranSidang,
                    'nip' => $value->nip,
                    'nama' => $value->nama,
                    'tipe' => $value->tipe,
                    'created_by' => $request->nim,
                    'created_at' => now()                    
                ]);

            $countDosenDone++;
            }

            if ($countDosen == $countDosenDone) {
                DB::commit();
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
