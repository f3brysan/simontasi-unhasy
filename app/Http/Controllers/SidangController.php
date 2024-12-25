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
            ->where('type', 'P')
            ->whereIn('tps.status', ['1'])
            ->first();
        $data['prodi'] = DB::table('ms_prodi')->where('kode_prodi', auth()->user()->prodi_kode)->first()->prodi;
        if (empty($dataProposal)) {
            return redirect()->route('dashboard')->with('error', 'Anda belum memiliki proposal yang disetujui');
        }

        $dataSidang = DB::table('tr_pendaftaran as tp')
            ->select('tp.*')
            ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')
            ->where('tp.no_induk', $no_induk)
            ->where('type', 'T')
            ->first();

        if (empty($dataSidang)) {
            $data['proposal'] = $dataProposal;
            $data['pembimbing'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataProposal->id)
                ->where('tipe', 'like', 'B%')->get();
            $data['penguji'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataProposal->id)
                ->where('tipe', 'like', 'U%')->get();
            return view('sidang.daftar', $data);
        } else {
            $data['dataSidang'] = $dataSidang;
            $data['pembimbing'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataSidang->id)
                ->where('tipe', 'like', 'B%')->get();
            $data['penguji'] = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $dataSidang->id)
                ->where('tipe', 'like', 'U%')->get();
            $data['berkas'] = DB::table('ms_berkas as b')
                // Select the necessary fields
                ->select('b.*', 'pb.id as doc_id', 'pb.file', 'pb.is_lock')
                // Join the tr_pendaftaran_berkas table to retrieve the associated file
                ->leftJoin('tr_pendaftaran_berkas as pb', function ($join) use ($dataSidang) {
                    // Use the on and where methods to specify the join condition
                    $join->on('pb.berkas_id', '=', 'b.id')
                        ->where('pb.pendaftaran_id', '=', $dataSidang->id);
                })  
                // Filter the documents to only include those of type 'P'
                ->where('b.type', 'T')
                // Get the results
                ->get();

            $data['berkas_hasil'] = DB::table('ms_berkas as b')
                // Select the necessary fields
                ->select('b.*', 'pb.id as doc_id', 'pb.file', 'pb.is_lock')
                // Join the tr_pendaftaran_berkas table to retrieve the associated file
                ->leftJoin('tr_pendaftaran_berkas as pb', function ($join) use ($dataSidang) {
                    // Use the on and where methods to specify the join condition
                    $join->on('pb.berkas_id', '=', 'b.id')
                        ->where('pb.pendaftaran_id', '=', $dataSidang->id);
                })
                // Filter the documents to only include those of type 'P'
                ->where('b.type', 'TH')
                // Get the results
                ->get();

            $data['statusBayar'] = DB::table('tr_pendaftaran_va')->where('pendaftaran_id', $dataSidang->id)->first();
            $data['jadwal'] = DB::table('tr_pendaftaran_jadwal')->where('id', $dataSidang->id)->first();
            $data['statusProposal'] = DB::table('tr_pendaftaran_status')->where('pendaftaran_id', $dataSidang->id)->first();   
            return view('sidang.index', $data);
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

            $insertStatusProposal = DB::table('tr_pendaftaran_status')->insert([
                'id' => Str::uuid(),
                'pendaftaran_id' => $idPendaftaranSidang
            ]);
            $exe = DB::table('tr_pendaftaran_va')->insert([
                'id' => Str::uuid(),
                'pendaftaran_id' => $idPendaftaranSidang,
                'nomor_va' => '07' . $request->nim,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
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
