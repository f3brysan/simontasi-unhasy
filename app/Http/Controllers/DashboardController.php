<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    /**
     * Display the dashboard for the authenticated user.
     *
     * This method determines which dashboard to display based on the user's
     * role. If the user is a superadmin or pengelola, it will display the
     * superadmin dashboard. If the user is a mahasiswa, it will display the
     * mahasiswa dashboard. If the user is a dosen, it will display the dosen
     * dashboard. If the user is a koordinator, it will display the koordinator
     * dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Get the user's role names
        $roles = $user->getRoleNames()->toArray();

        // Define the roles that should use the superadmin dashboard
        $useIndex = ['superadmin', 'pengelola'];

        // If the user is a superadmin or pengelola, return the superadmin dashboard
        if (array_intersect($useIndex, $roles)) {
            // If the user is pengelola, we do not need to display the pengelola page
            if ($user->hasRole('pengelola')) {

            } else {
                // Get data for the datatable of the proposal data
                $data = $this->indexSuperAdmin();
                $proposalData = $data['getDataProposals'];

                // If the request is an AJAX request, return a datatable of the proposal data
                if ($request->ajax()) {
                    // Generate columns for the datatable
                    return DataTables::of($proposalData)
                        ->addColumn('action', function ($proposal) {
                            // Generate buttons for the datatable
                            $approveBtn = $proposal['is_ok'] == 0 ? 'btn-success' : 'btn-danger';
                            $approveBtnx = $proposal['is_ok'] == 0 ? 'fa-solid fa-check text-white' : 'fa-solid fa-close text-white';
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($proposal['id']) . '" title="Lihat" class="edit btn btn-primary btn-sm edit-user m-1"><em class="fa-solid fa-eye"></em></a>';
                            $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($proposal['id']) . '" data-nim="' . $proposal['no_induk'] . '" data-name="'.$proposal['nama'].'" data-status="'.$proposal['is_ok'].'" title="Setujui" class="approve btn '.$approveBtn.' btn-sm m-1"><em class="'.$approveBtnx.'"></em></a>';
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
                            $result .= ' <b>Dosen Pembimbing</b> <li>'.$proposal['dosen_pembimbing'].'</li>';
                            $result .= '</ul>';
                            return $result;
                        })
                        ->rawColumns(['action', 'approved', 'title', 'dosen'])
                        ->addIndexColumn()
                        ->make(true);
                }
            }

            // Return the superadmin dashboard
            return view('dashboard.superadmin', $data);
        }

        // If the user is a mahasiswa, return the mahasiswa dashboard
        if (in_array('mahasiswa', $roles)) {
            return view('dashboard.mahasiswa');
        }

        // If the user is a dosen, return the dosen dashboard
        if (in_array('dosen', $roles)) {
            return view('dashboard.dosen');
        }
    }



    public function indexSuperAdmin()
    {
        $data = [];
        $getData = DB::table("tr_pendaftaran as p")
            ->join("users as u", function ($join) {
                $join->on("u.no_induk", "=", "p.no_induk");
            })
            ->join("tr_pendaftaran_dosen as pd", function ($join) {
                $join->on("pd.pendaftaran_id", "=", "p.id");
            })
            ->select("p.*", "u.prodi_kode", "u.nama", "pd.is_ok")
            ->get();
        $getDataProposals = $getData->where('type', 'P');
        $getProdi = (new GetDataAPISiakad)->getDataProdi();
        $getDosenPembimbing = DB::table('tr_pendaftaran_dosen')->where('tipe', 'B')->get();
        $getDosenPenguji = DB::table('tr_pendaftaran_dosen')->where('tipe', 'U')->get();

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

            foreach ($getProdi as $prodi) {
                if ($prodi->kode_prodi == $proposal->prodi_kode) {
                    $resultDataProposals[$proposal->id]['prodi_nama'] = $prodi->prodi;
                }
            }

            foreach ($getDosenPembimbing as $pembimbing) {
                if ($pembimbing->pendaftaran_id == $proposal->id) {
                    $resultDataProposals[$proposal->id]['dosen_pembimbing'] = $pembimbing->nama;
                }
            }
        }


        $getWaitProposals = $getDataProposals->where('is_ok', 0) ?? 0;
        $getDoneProposals = $getDataProposals->where('is_ok', 1) ?? 0;

        $data = [
            'getDataProposals' => $resultDataProposals,
            'getWaitProposals' => $getWaitProposals,
            'getDoneProposals' => $getDoneProposals
        ];

        return $data;
    }
}
