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
                $getUserProdi = DB::table('tr_user_prodi')->where('user_id', auth()->user()->id)->get()->pluck('kode_prodi');                
                $getProdi = DB::table('ms_prodi')->whereIn('kode_prodi', $getUserProdi)->get();
                $data['prodi'] = $getProdi;
            } else {                
                $getProdi = DB::table('ms_prodi')->get();
                $data['prodi'] = $getProdi;
            }

            // Return the superadmin dashboard
            return view('dashboard.superadmin', $data);
        }

        // If the user is a mahasiswa, return the mahasiswa dashboard
        if (in_array('mahasiswa', $roles)) {                 
            $data['getProposal'] = DB::table('tr_pendaftaran as tp')
            ->select('tp.*')
            ->leftJoin('tr_pendaftaran_status as tps','tps.pendaftaran_id','=','tp.id')
            ->where('tp.no_induk', $user->no_induk)
            ->where(function ($query) {
                $query->whereNull('tps.status')
                    ->orWhere('tps.status', '!=', '0');
            })
            ->first();    
            
            $data['proposalAccepted'] = DB::table('tr_pendaftaran as tp')
            ->select('tp.*')
            ->leftJoin('tr_pendaftaran_status as tps','tps.pendaftaran_id','=','tp.id')
            ->where('tp.no_induk', $user->no_induk)            
            ->whereIn('tps.status', ['1'])            
            ->first(); 

            $data['allPendaftaran'] = DB::table('tr_pendaftaran as tp')
            ->select('tp.*', 'tps.status', 'tps.catatan')
            ->leftJoin('tr_pendaftaran_status as tps','tps.pendaftaran_id','=','tp.id')
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
                    'title' => $jenis.' '.$item->nama.' ('.$item->prodi.') bertempat di '.$item->gedung.', Ruang : '.$item->ruang,
                    'start' => $item->awal,
                    'end' => $item->akhir,
                ];
            }
            // dd($events);
            return view('dashboard.dosen', compact('events'));
        }
    }



    
}
