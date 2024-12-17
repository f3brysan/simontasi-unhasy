<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class IndikatorPenilaianController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the indikator penilaian data from the database
        $data = DB::table('ms_indikator_penilaian as i')
            ->select('i.*', 'k.nama as nama_komponen')
            ->join('ms_komponen_penilaian as k', 'k.id', '=', 'i.komponen_penilaian_id')
            ->get();

        // Retrieve the komponen penilaian data for the select box
        $msKomponen = DB::table('ms_komponen_penilaian')->orderBy('nama', 'asc')->get();

        // If the request is an AJAX request, return a datatable of the data
        if ($request->ajax()) {
            // Generate columns for the datatable
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    // Generate buttons for the datatable                    
                    $btn = '<div class="dropdown">
                    <button class="btn btn-info dropdown-toggle text-light" type="button" data-coreui-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gears"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($data->id) . '" title="Lihat" class="dropdown-item btn btn-primary btn-sm edit m-1">Ubah</a></li>                                                 
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($data->id) . '" title="Lihat" class="dropdown-item btn btn-primary btn-sm delete m-1">Hapus</a></li>                                                 
                    </ul>
                  </div>';
                    return $btn;
                })
                ->addColumn('range_nilai', function ($data) {
                    // Generate the approval status for the datatable
                    $rangeNilai = $data->min_score . ' - ' . $data->max_score;
                    return $rangeNilai;
                })
                ->rawColumns(['action', 'range_nilai'])
                ->addIndexColumn()
                ->make(true);
        }
        // Return the view with the data
        return view('ms-indikator-penilaian.index', compact('msKomponen'));
    }
}
