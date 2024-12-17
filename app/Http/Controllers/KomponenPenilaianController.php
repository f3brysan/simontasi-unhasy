<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class KomponenPenilaianController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('ms_komponen_penilaian')->get();

        // If the request is an AJAX request, return a datatable of the data data
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
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('ms-komponen-penilaian.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            // Check if an ID is provided to determine if it's an insert or update operation
            if ($request->id == null) {
                // Insert a new komponen penilaian
                $exe = DB::table('ms_komponen_penilaian')->insert([
                    'id' => Str::uuid(),
                    'nama' => $request->nama,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->user()->nama
                ]);
            } else {
                // Update the existing komponen penilaian
                $exe = DB::table('ms_komponen_penilaian')->where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => auth()->user()->nama
                ]);
            }

            // If the operation was successful, return a JSON response with true
            if ($exe) {
                return response()->json(true);
            }
        } catch (\Exception $th) {
            // Return the error message if an exception occurs
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $data = DB::table('ms_komponen_penilaian')->where('id', $id)->first();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
