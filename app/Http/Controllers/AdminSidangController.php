<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;

class AdminSidangController extends Controller
{
    public function index(Request $request)
    {
        // Get data for the datatable of the proposal data
        $data = $this->getAllDataSidang();
        $proposalData = $data['getDataProposals'];
        
        // If the request is an AJAX request, return a datatable of the proposal data
        if ($request->ajax()) {
            // Generate columns for the datatable
            return DataTables::of($proposalData)
                ->addColumn('action', function ($proposal) {
                    // Generate buttons for the datatable
                    $approveBtn = $proposal['is_ok'] == 0 ? 'Setujui Dosen Pembimbing' : 'Tidak Setujui Dosen Pembimbing';
                    $btn = '<div class="dropdown">
                    <button class="btn btn-info dropdown-toggle text-light" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gears"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="' . URL::to('admin/data/proposal/detil/' . Crypt::encrypt($proposal['id'])) . '" data-toggle="tooltip" data-id="' . Crypt::encrypt($proposal['id']) . '" title="Lihat" class="dropdown-item btn btn-primary btn-sm edit-user m-1">Lihat Detil</a></li>                                                 
                    </ul>
                  </div>';
                    return $btn;
                })
                ->addColumn('approved', function ($proposal) {
                    // Generate the approval status for the datatable
                    $isOk = $proposal['is_ok'] == 0 ? '<span class="badge bg-warning">Belum Disetujui</span>' : '<span class="badge bg-success">Disetujui</span>';
                    return $isOk;
                })
                ->addColumn('title', function ($proposal) {
                    return Str::words($proposal['title'], 20, '...');
                })
                ->addColumn('dosen', function ($proposal) {
                    $result = '<ul>';
                    $result .= ' <b>Dosen Pembimbing</b> <li>' . $proposal['dosen_pembimbing'] . '</li>';
                    $result .= '</ul>';
                    return $result;
                })
                ->rawColumns(['action', 'approved', 'title', 'dosen'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.sidang.index', $data);
    }

    public function getAllDataSidang()
    {
        // Get the program code for the user
        $getUserProdi = DB::table('tr_user_prodi')->where('user_id', auth()->user()->id)->get()->pluck('kode_prodi');

        // Get the data for proposals based on the user's role
        if (auth()->user()->hasRole('pengelola')) {
            // Get the data for proposals with the role of 'pengelola'
            $getData = DB::table("tr_pendaftaran as p")
                ->join("users as u", function ($join) use ($getUserProdi) {
                    // Join the 'users' table with the 'tr_pendaftaran' table
                    $join->on("u.no_induk", "=", "p.no_induk")
                        ->whereIn("u.prodi_kode", $getUserProdi);
                })
                ->leftjoin("tr_pendaftaran_dosen as pd", function ($join) {
                    // Join the 'tr_pendaftaran_dosen' table with the 'tr_pendaftaran' table
                    $join->on("pd.pendaftaran_id", "=", "p.id")
                    ->where("pd.tipe", "B");
                })
                ->select("p.*", "u.prodi_kode", "u.nama", "pd.is_ok as dosen_ok")
                ->get();
        }
        if (auth()->user()->hasRole('superadmin')) {
            // Get the data for proposals with the role of 'superadmin'
            $getData = DB::table("tr_pendaftaran as p")
                ->join("users as u", function ($join) {
                    // Join the 'users' table with the 'tr_pendaftaran' table
                    $join->on("u.no_induk", "=", "p.no_induk");
                })
                ->leftjoin("tr_pendaftaran_dosen as pd", function ($join) {
                    // Join the 'tr_pendaftaran_dosen' table with the 'tr_pendaftaran' table
                    $join->on("pd.pendaftaran_id", "=", "p.id")
                    ->where("pd.tipe", "B");
                })
                ->select("p.*", "u.prodi_kode", "u.nama", "pd.is_ok as dosen_ok")
                ->get();
        }

        // Filter the data for proposals
        $getDataProposals = $getData->where('type', 'T');
        
        // Get the program data and supervisor data
        $getProdi = DB::table('ms_prodi')->get();
        $getDosenPembimbing = DB::table('tr_pendaftaran_dosen')->where('tipe', 'B')->get();

        // Prepare the data for proposals
        $resultDataProposals = [];
        foreach ($getDataProposals as $proposal) {
            $resultDataProposals[$proposal->id] = [
                'id' => $proposal->id,
                'no_induk' => $proposal->no_induk,
                'title' => $proposal->title,
                'prodi_kode' => $proposal->prodi_kode,
                'nama' => $proposal->nama,
                'is_ok' => $proposal->is_ok
            ];

            // Get the name of the program
            foreach ($getProdi as $prodi) {
                if ($prodi->kode_prodi == $proposal->prodi_kode) {
                    $resultDataProposals[$proposal->id]['prodi_nama'] = $prodi->prodi;
                }
            }

            // Get the name of the supervisor
            foreach ($getDosenPembimbing as $pembimbing) {
                if ($pembimbing->pendaftaran_id == $proposal->id) {
                    $resultDataProposals[$proposal->id]['dosen_pembimbing'] = $pembimbing->nama;
                }
            }
        }

        // Get the number of waiting and approved proposals
        $getWaitProposals = $getDataProposals->where('is_ok', 0) ?? 0;
        $getDoneProposals = $getDataProposals->where('is_ok', 1) ?? 0;

        // Prepare the data for the view
        $data = [
            'getDataProposals' => $resultDataProposals,
            'getWaitProposals' => $getWaitProposals,
            'getDoneProposals' => $getDoneProposals
        ];

        return $data;
    }
}
