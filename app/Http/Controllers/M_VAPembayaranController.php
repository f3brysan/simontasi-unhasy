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
      // Join the relevant tables
      ->select('va.*', 'p.no_induk', 'p.type', 'u.nama', 'mp.prodi')
      ->join('tr_pendaftaran as p', 'p.id', '=', 'va.pendaftaran_id')
      ->join('users as u', 'u.no_induk', '=', 'p.no_induk')
      ->join('ms_prodi as mp', 'mp.kode_prodi', '=', 'u.prodi_kode')
      // Get the data
      ->get();

    // If the request is an AJAX request, return a datatable of the proposal data
    if ($request->ajax()) {
      // Generate columns for the datatable
      return DataTables::of($getData)
        // Add a column for the timestamp
        ->addColumn('timestamp', function ($getData) {
          // Return the timestamp
          $result = $getData->updated_at ?? $getData->created_at;
          return $result;
        })
        // Add a column for the status of the VA
        ->addColumn('statusVA', function ($getData) {
          // Return a label indicating the status of the VA
          $label = '';
          if ($getData->status == '1') {
            $label = '<span class="badge bg-success">Paid</span>';
          } else {
            $label = '<span class="badge bg-danger">Unpaid</span>';
          }
          return $label;
        })
        // Add a column for the type of pendaftaran
        ->addColumn('typePendaftaran', function ($getData) {
          // Return a label indicating the type of pendaftaran
          $type = '';
          if ($getData->type == 'P') {
            $type = '<span class="badge bg-secondary">Proposal</span>';
          }

          if ($getData->type == 'T') {
            $type = '<span class="badge bg-primary">Sidang Skripsi/TA/Tesis/Munasaqoh</span>';
          }
          return $type;
        })
        // Add a column for the action buttons
        ->addColumn('action', function ($getData) {
          // Generate buttons for the datatable
          $btn = '';
          if ($getData->status == '0') {
            // If the status is 0, add an accept button
            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success accept" data-id="' . Crypt::encrypt($getData->id) . '"><i class="fas fa-check"></i></a>';
          } else {
            // If the status is not 0, add a reject button
            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-danger reject" data-id="' . Crypt::encrypt($getData->id) . '"><i class="fas fa-times"></i></a>';
          }
          return $btn;
        })
        // Make the action column raw
        ->rawColumns(['action', 'timestamp', 'statusVA', 'typePendaftaran'])
        // Add the index column
        ->addIndexColumn()
        // Make the DataTables
        ->make(true);
    }

    // If the request is not an AJAX request, return the view
    return view('admin.va-pembayaran.index');
  }
  
  public function acceptVA(Request $request)
  {
    try {
      // Decrypt the ID
      $id = Crypt::decrypt($request->id);

      // Update the status to '1' which means accepted
      $update = DB::table('tr_pendaftaran_va')->where('id', $id)->update([
        'status' => '1',
        'updated_at' => date('Y-m-d H:i:s')
      ]);

      // If the update is successful, return a success message
      if ($update) {
        return response()->json(['success' => 'Berhasil']);
      }
    } catch (\Exception $th) {
      // If there is an error, return the error message
      return response()->json(['error' => $th->getMessage()]);
    }
  }
}
