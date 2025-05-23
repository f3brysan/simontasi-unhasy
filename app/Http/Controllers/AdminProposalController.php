<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class AdminProposalController extends Controller
{
    public function index(Request $request)
    {
        // Get data for the datatable of the proposal data
        $data = $this->getAllDataProposal();
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

        return view('admin.proposal.index', $data);
    }

    public function getAllDataProposal()
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
        $getDataProposals = $getData->where('type', 'P');

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

    public function detil($id)
    {
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
        $prodi = DB::table('ms_prodi')->where('kode_prodi', $mhs->prodi_kode)->first();

        $jadwal = DB::table('tr_pendaftaran_jadwal')->where('id', $dataProposal->id)->first();

        // Prepare the data to be passed to the view
        $data = [
            'dataProposal' => $dataProposal,
            'berkasProposal' => null,
            'biodata' => $mhs,
            'pembimbing' => null,
            'penguji' => null,
            'prodi' => $prodi->prodi,
            'jadwal' => $jadwal
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
        $getDosen = DB::table('ms_dosen')->get();

        // Filter the dosens by the current user's program study
        $allDosenPenguji = [];
        foreach ($getDosen as $item) {
            if (
                $item->prodi_kode == $mhs->prodi_kode
                and !in_array($item->no_identitas, $pembimbing)
                and !in_array($item->no_identitas, $penguji)
            ) {
                $allDosenPenguji[$item->no_identitas] = [
                    'nip' => $item->no_identitas,
                    'nama' => $item->nama,
                ];

            }

            if (
                $item->prodi_kode == $mhs->prodi_kode
                and !in_array($item->no_identitas, $penguji)
            ) {
                $allDosenPembimbing[$item->no_identitas] = [
                    'nip' => $item->no_identitas,
                    'nama' => $item->nama,
                ];

            }
        }
        ksort($allDosenPenguji);
        ksort($allDosenPembimbing);

        $data['getNilaibyDosen'] = DB::table('tr_nilai')
            ->select('created_by', 'is_lock', DB::raw("COALESCE(SUM(nilai), '0') AS total_nilai"))
            ->where('pendaftaran_id', $dataProposal->id)
            ->groupBy(['created_by', 'is_lock'])
            ->get()
            ->keyBy('created_by');

        $data['berkas_hasil'] = DB::table('ms_berkas as b')
            // Select the necessary fields
            ->select('b.*', 'pb.id as doc_id', 'pb.file', 'pb.is_lock')
            // Join the tr_pendaftaran_berkas table to retrieve the associated file
            ->leftJoin('tr_pendaftaran_berkas as pb', function ($join) use ($dataProposal) {
                // Use the on and where methods to specify the join condition
                $join->on('pb.berkas_id', '=', 'b.id')
                    ->where('pb.pendaftaran_id', '=', $dataProposal->id);
            })
            // Filter the documents to only include those of type 'P'
            ->where('b.type', 'PH')
            // Get the results
            ->get();
        
        $data['statusPendaftaran'] = DB::table('tr_pendaftaran_status')->where('pendaftaran_id', $dataProposal->id)->first();


        // Add the filtered dosens to the data array
        $data['allDosenPenguji'] = $allDosenPenguji;
        $data['allDosenPembimbing'] = $allDosenPembimbing;

        $data['logbookDone'] = DB::table('tr_logbook')->where('pendaftaran_id', $dataProposal->id)->where('is_approve', 1)->get();
        $data['statusBayar'] = DB::table('tr_pendaftaran_va')->where('pendaftaran_id', $dataProposal->id)->first();
        if ($data['statusPendaftaran']->status == '0' OR $data['statusPendaftaran']->status == NULL) {
            $data['allowBtn'] = true;
        }else{
            $data['allowBtn'] = false;
        }                        
        
        // Return the view with the data    
        return view('admin.proposal.detil', $data);
    }

    public function getDosenPembimbing($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $getDosenPembimbing = DB::table('tr_pendaftaran_dosen')
                ->where('tipe', 'B')
                ->where('pendaftaran_id', $id)
                ->first();
            return response()->json($getDosenPembimbing);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function storePembimbing(Request $request)
    {
        $dataDosen = DB::table('ms_dosen')->where('no_identitas', $request->dosen_pembimbing)->first();
        $pendaftaran_id = Crypt::decrypt($request->id_pendaftaran);

        $insertDosen = DB::table('tr_pendaftaran_dosen')->where('pendaftaran_id', $pendaftaran_id)->where('tipe', 'B')->update([
            'nip' => $request->dosen_pembimbing,
            'nama' => $dataDosen->nama,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => auth()->user()->nama,
            'is_ok' => NULL,
        ]);

        if ($insertDosen) {
            return Redirect::back()->with('success', 'Dosen pembimbing disimpan.');
        } else {
            return Redirect::back()->with('error', 'Dosen pembimbing gagal disimpan.');
        }
    }

    public function storePenguji(Request $request)
    {
        $dataDosen = DB::table('ms_dosen')->where('no_identitas', $request->dosen_penguji)->first();
        $pendaftaran_id = Crypt::decrypt($request->id_pendaftaran);

        $insertDosen = DB::table('tr_pendaftaran_dosen')->insert([
            'id' => Str::uuid(),
            'pendaftaran_id' => $pendaftaran_id,
            'nip' => $request->dosen_penguji,
            'nama' => $dataDosen->nama,
            'tipe' => 'U', // U = Pembimbing
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => auth()->user()->nama,
            'is_ok' => 1
        ]);

        if ($insertDosen) {
            return Redirect::back()->with('success', 'Dosen penguji disimpan.');
        } else {
            return Redirect::back()->with('error', 'Dosen penguji gagal disimpan.');
        }

    }

    public function deletePenguji(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->id);
            $delete = DB::table('tr_pendaftaran_dosen')->where('id', $id)->delete();

            return response()->json($delete);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function storeJadwalSidang(Request $request)
    {

        $pendaftaran_id = Crypt::decrypt($request->id_pendaftaran);
        $checkExist = DB::table('tr_pendaftaran_jadwal')->where('id', $pendaftaran_id)->exists();
        $awal = date("Y/m/d H:i:s", strtotime($request->jadwalsidang));
        $akhir = date("Y/m/d H:i:s", strtotime($request->jadwalsidang) + 60 * 60);

        if ($checkExist) {
            $store = DB::table('tr_pendaftaran_jadwal')->where('id', $pendaftaran_id)->update([
                'awal' => $awal,
                'akhir' => $akhir,
                'gedung' => $request->gedung,
                'ruang' => $request->ruang,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->nama,
            ]);
        } else {
            $store = DB::table('tr_pendaftaran_jadwal')->insert([
                'id' => $pendaftaran_id,
                'awal' => $awal,
                'akhir' => $akhir,
                'gedung' => $request->gedung,
                'ruang' => $request->ruang,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->nama,
            ]);
        }

        if ($store) {
            return Redirect::back()->with('success', 'Jadwal sidang berhasil disimpan.');
        } else {
            return Redirect::back()->with('error', 'Jadwal sidang gagal disimpan.');
        }
    }

    public function getJadwalSidang($id)
    {
        try {
            // Decrypt the id parameter
            $id = Crypt::decrypt($id);

            // Retrieve the jadwal sidang data from the database
            $data = DB::table('tr_pendaftaran_jadwal')->where('id', $id)->first();

            // Return the jadwal sidang data in JSON format
            return response()->json($data);
        } catch (\Exception $e) {
            // If an exception occurs, return the exception message in JSON format
            return response()->json($e->getMessage());
        }
    }
}
