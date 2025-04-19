<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ProposalDocTemplateController extends Controller
{
    public function pdfBeritaAcaraProposal($id)
    {
        try {
            $dataProposal = DB::table('tr_pendaftaran as tp')
            ->select('tp.*')
            ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')            
            ->where('tp.id', $id)
            ->where(function ($query) {
                $query->whereNull('tps.status')
                    ->orWhere('tps.status', '!=', '0');
            })
            ->first();
            
            $users = DB::table('users')->where('no_induk', $dataProposal->no_induk)->first();
            $prodi = DB::table('ms_prodi')->where('kode_prodi', $users->prodi_kode)->first();
            $jadwal = DB::table('tr_pendaftaran_jadwal')->where('id', $dataProposal->id)->first();
            
            $dosen = DB::table('tr_pendaftaran_dosen')->where('pendaftaran_id', $id)->orderBy('tipe', 'ASC')->orderby('nip')->get();
            
            $jenjang = substr($prodi->prodi, 0, 2);
            $jenisSidang = $jenjang == 'S1' ? 'Sidang Akhir Skripsi' : 'Sidang Akhir Tesis';
            
            $data = [
                'title' => $dataProposal->type == 'P' ? 'BERITA ACARA SEMINAR PROPOSAL' : 'BERITA ACARA'. ' ' . strtoupper($jenisSidang),
                'title2' => $dataProposal->type == 'P' ? 'RANGKUMAN HASIL SEMINAR PROPOSAL' : 'RANGKUMAN HASIL'. ' ' . strtoupper($jenisSidang),
                'fileName' => 'berita-acara-proposal',
                'dataProposal' => $dataProposal,
                'users' => $users,
                'prodi' => $prodi,
                'jadwal' => $jadwal,
                'dosen' => $dosen
            ];            
            
            $pdf = Pdf::loadView('master-pdf.berita-acara-proposal', $data)->setPaper('a4', 'potrait');
            $uniqueCode = date('YmdHis');
            // Return the PDF stream with a unique file name
            // return view('master-pdf.berita-acara-proposal', $data);
            return $pdf->stream($data['fileName'].'-'.$dataProposal->no_induk. '-' . $uniqueCode . '.pdf');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
