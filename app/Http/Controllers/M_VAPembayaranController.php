<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class M_VAPembayaranController extends Controller
{
  public function index(Request $request)
  {
    $getData = DB::table('tr_pendaftaran_va as va')
      ->select('va.*', 'p.no_induk', 'p.type', 'u.nama', 'mp.prodi')
      ->join('tr_pendaftaran as p', 'p.id', '=', 'va.pendaftaran_id')
      ->join('users as u', 'u.no_induk', '=', 'p.no_induk')
      ->join('ms_prodi as mp', 'mp.kode_prodi', '=', 'u.prodi_kode')
      ->get();
    // dd($getData);
    // If the request is an AJAX request, return a datatable of the proposal data
    if ($request->ajax()) {
      // Generate columns for the datatable
      return DataTables::of($getData)
        ->addColumn('timestamp', function ($getData) {
          $result = $getData->updated_at ?? $getData->created_at;
          return $result;
        })
        ->addColumn('statusVA', function ($getData) {
          $label = '';
          if ($getData->status == '1') {
            $label = '<span class="badge bg-success">Paid</span>';
          } else {
            $label = '<span class="badge bg-danger">Unpaid</span>';
          }
          return $label;
        })
        ->addColumn('typePendaftaran', function ($getData) {
          $type = '';
          if ($getData->type == 'P') {
            $type = '<span class="badge bg-secondary">Proposal</span>';
          }

          if ($getData->type == 'T') {
            $type = '<span class="badge bg-primary">Sidang Skripsi/TA/Tesis/Munasaqoh</span>';
          }
          return $type;
        })
        ->addColumn('action', function ($getData) {
          // Generate buttons for the datatable
          $btn = '';
          if ($getData->status == '0') {
            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success accept" data-id="' . Crypt::encrypt($getData->id) . '"><i class="fas fa-check"></i></a>';
          } else {
            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-danger reject" data-id="' . Crypt::encrypt($getData->id) . '"><i class="fas fa-times"></i></a>';
          }
          return $btn;
        })
        ->rawColumns(['action', 'timestamp', 'statusVA', 'typePendaftaran'])
        ->addIndexColumn()
        ->make(true);
    }

    return view('admin.va-pembayaran.index');
  }

  public function acceptVA(Request $request)
  {
    try {
      $id = Crypt::decrypt($request->id);      
      $update = DB::table('tr_pendaftaran_va')->where('id', $id)->update([
        'status' => '1',
        'updated_at' => date('Y-m-d H:i:s')        
      ]);
      if ($update) {
        return response()->json(['success' => 'Berhasil']);
      }
    } catch (\Exception $th) {
      return response()->json(['error' => $th->getMessage()]);
    }
  }
}
