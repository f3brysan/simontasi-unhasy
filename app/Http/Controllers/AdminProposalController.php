<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;

class AdminProposalController extends Controller
{
    public function index(Request $request)
    {
        // Get data for the datatable of the proposal data
        $data = $this->indexSuperAdmin();
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
                      <li><a href="'.URL::to('admin/data/proposal/detil/'.Crypt::encrypt($proposal['id'])).'" data-toggle="tooltip" data-id="' . Crypt::encrypt($proposal['id']) . '" title="Lihat" class="dropdown-item btn btn-primary btn-sm edit-user m-1">Lihat Detil</a></li>
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($proposal['id']) . '" data-nim="' . $proposal['no_induk'] . '" data-name="' . $proposal['nama'] . '" data-status="' . $proposal['is_ok'] . '" title="Setujui" class="dropdown-item approve btn btn-sm m-1">' . $approveBtn . '</a></li>                              
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

        return view('admin.proposal.index', $data);
    }

    public function indexSuperAdmin()
    {
        // Get the data for proposals
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

    public function detil($id){
        /**
         * Retrieves the detail of a proposal based on its ID.
         *
         * @param string $id The encrypted ID of the proposal.
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */        
            // Decrypt the ID
            $id = Crypt::decrypt($id);

            // Retrieve the proposal data from the database
            $dataProposal = DB::table('tr_pendaftaran as p')
                ->where('id', $id)->first();
            
            // Retrieve the user data associated with the proposal
            $mhs = User::where('no_induk', $dataProposal->no_induk)->first();

            // Retrieve the data of the current user's program study
            $prodi = (new GetDataAPISiakad)->getDataProdi($mhs->prodi_kode);

            // Prepare the data to be passed to the view
            $data = [
                'dataProposal' => $dataProposal,
                'berkasProposal' => null,
                'biodata' => $mhs,
                'pembimbing' => null,
                'penguji' => null,
                'prodi' => $prodi->prodi,
            ];

            // Retrieve the proposal berkas, pembimbing, and penguji
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

            // Get the NIPs of the pembimbing and penguji
            $pembimbing = $data['pembimbing']->pluck('nip')->toArray();
            $penguji = $data['penguji']->pluck('nip')->toArray();

            // Retrieve all the dosens
            $getDosen = (new GetDataAPISiakad)->getDataDosen();

            // Filter the dosens by the current user's program study
            $allDosenPenguji = [];
            foreach ($getDosen as $item) {
                if ($item->prodi_kode == $mhs->prodi_kode 
                    AND !in_array($item->no_identitas, $pembimbing) 
                    AND !in_array($item->no_identitas, $penguji)
                ) {
                    $allDosenPenguji[$item->no_identitas] = [
                        'nip' => $item->no_identitas,
                        'nama' => $item->nama,
                    ];
                }
            }
            ksort($allDosenPenguji);

            // Add the filtered dosens to the data array
            $data['allDosenPenguji'] = $allDosenPenguji;

            $data['logbookDone'] = DB::table('tr_logbook')->where('pendaftaran_id', $dataProposal->id)->where('is_approve', 1)->get();

            // Return the view with the data
            return view('admin.proposal.detil', $data);
    }
}
