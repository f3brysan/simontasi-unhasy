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
            // Retrieve distinct faculties from the 'ms_prodi' table
            $getFaculties = DB::table('ms_prodi')->distinct()->orderBy('fakultas')->get();
            $faculitesData = [];

            // Initialize faculties data structure with default values
            foreach ($getFaculties as $key => $value) {
                $faculitesData['P'][$value->kode_fakultas]['namaFakultas'] = $value->fakultas;
                $faculitesData['P'][$value->kode_fakultas]['total'] = 0;
                $faculitesData['T'][$value->kode_fakultas]['namaFakultas'] = $value->fakultas;
                $faculitesData['T'][$value->kode_fakultas]['total'] = 0;
            }

            // Get the maximum count of registrations
            $data['maxCount'] = DB::table('tr_pendaftaran')->count();

            // Retrieve transaction counts grouped by faculty and type
            $getTransactionCountFaculties = DB::table('ms_prodi as mp')
                ->distinct()
                ->select('mp.kode_fakultas', 'p.type', DB::raw('COUNT(p.*) as total'))
                ->leftJoin('users as u', 'u.prodi_kode', '=', 'mp.kode_prodi')
                ->join('tr_pendaftaran as p', 'p.no_induk', '=', 'u.no_induk')
                ->groupBy(['mp.kode_fakultas', 'p.type'])
                ->orderBy('mp.kode_fakultas', 'ASC')
                ->get();

            // Aggregate transaction totals into faculties data
            foreach ($getTransactionCountFaculties as $key => $value) {
                $faculitesData[$value->type][$value->kode_fakultas]['total'] += $value->total;
            }

            // Store the transaction counts by faculty in the data array
            $data['countTransactionfaculties'] = $faculitesData;

            // If the user is pengelola, we do not need to display the pengelola page
            if ($user->hasRole('pengelola')) {
                $superUser = false;
                $getUserProdi = DB::table('tr_user_prodi')->where('user_id', auth()->user()->id)->get()->pluck('kode_prodi');
                $getProdi = DB::table('ms_prodi')->whereIn('kode_prodi', $getUserProdi)->orderby('fakultas')->get();
                $data['prodi'] = $getProdi;
            } else {
                $superUser = true;
                $getProdi = DB::table('ms_prodi')->orderby('fakultas')->get();
                $data['prodi'] = $getProdi;
            }

            $prodiDatas = [];
            foreach ($getProdi as $key => $value) {
                $prodiDatas['P'][$value->kode_prodi]['namaProdi'] = $value->prodi;
                $prodiDatas['P'][$value->kode_prodi]['total'] = 0;
                $prodiDatas['T'][$value->kode_prodi]['namaProdi'] = $value->prodi;
                $prodiDatas['T'][$value->kode_prodi]['total'] = 0;
            }

            $arrProdi = $getProdi->pluck('kode_prodi')->toArray();
            
            $getTransCountProdis = DB::table('ms_prodi as mp')
                ->distinct()
                ->select('mp.kode_prodi', 'p.type', DB::raw('COUNT(p.*) as total'))
                ->leftJoin('users as u', 'u.prodi_kode', '=', 'mp.kode_prodi')
                ->join('tr_pendaftaran as p', 'p.no_induk', '=', 'u.no_induk')
                ->when($superUser == false, function ($q) use ($arrProdi) {
                    return $q->whereIn('mp.kode_prodi', $arrProdi);
                })
                ->groupBy(['mp.kode_prodi', 'p.type'])
                ->orderBy('mp.kode_prodi', 'ASC')
                ->get();
            

            foreach ($getTransCountProdis as $key => $value) {
                $prodiDatas[$value->type][$value->kode_prodi]['total'] += $value->total;
            }

            $data['countTransactionProdis'] = $prodiDatas;
            // Return the superadmin dashboard
            return view('dashboard.superadmin', $data);
        }

        // If the user is a mahasiswa, return the mahasiswa dashboard
        if (in_array('mahasiswa', $roles)) {
            $data['getProposal'] = DB::table('tr_pendaftaran as tp')
                ->select('tp.*')
                ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')
                ->where('tp.no_induk', $user->no_induk)
                ->where(function ($query) {
                    $query->whereNull('tps.status')
                        ->orWhere('tps.status', '!=', '0');
                })
                ->first();

            $data['proposalAccepted'] = DB::table('tr_pendaftaran as tp')
                ->select('tp.*')
                ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')
                ->where('tp.no_induk', $user->no_induk)
                ->whereIn('tps.status', ['1'])
                ->first();

            $data['allPendaftaran'] = DB::table('tr_pendaftaran as tp')
                ->select('tp.*', 'tps.status', 'tps.catatan')
                ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')
                ->where('tp.no_induk', $user->no_induk)
                ->get();

            return view('dashboard.mahasiswa', $data);
        }

        // If the user is a dosen, return the dosen dashboard
        if (in_array('dosen', $roles)) {
            $getProposal = DB::table("tr_pendaftaran as p")
                ->join("users as u", function ($join) {
                    $join->on("u.no_induk", "=", "p.no_induk");
                })
                ->join("tr_pendaftaran_dosen as pd", function ($join) {
                    $join->on("pd.pendaftaran_id", "=", "p.id");
                })
                ->join("tr_pendaftaran_jadwal as pj", function ($join) {
                    $join->on("pj.id", "=", "p.id");
                })
                ->join("ms_prodi as mp", function ($join) {
                    $join->on("mp.kode_prodi", "=", "u.prodi_kode");
                })
                ->select("p.*", "u.nama", "u.prodi_kode", "mp.prodi", "pj.gedung", "pj.ruang", "pj.awal", "pj.akhir")
                ->where("pd.nip", auth()->user()->no_induk)
                ->get();

            $events = [];
            foreach ($getProposal as $item) {
                $jenis = $item->type == 'P' ? 'Sidang Proposal' : 'Sidang Skripsi';
                $jenis = in_array($item->prodi_kode, ['25', '22', '23']) ? 'Sidang Tesis' : $jenis;
                $events[] = [
                    'title' => $jenis . ' ' . $item->nama . ' (' . $item->prodi . ') bertempat di ' . $item->gedung . ', Ruang : ' . $item->ruang,
                    'start' => $item->awal,
                    'end' => $item->akhir,
                ];
            }
            // dd($events);
            return view('dashboard.dosen', compact('events'));
        }
    }




}
