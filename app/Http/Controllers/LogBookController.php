<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class LogBookController extends Controller
{
    public function getLogBook($id, Request $request)
    {
        try {
            // Decrypt the ID parameter
            $pendaftaran_id = Crypt::decrypt($id);

            // Retrieve the logbook data for the decrypted ID
            $getData = DB::table('tr_logbook')->where('pendaftaran_id', $pendaftaran_id)->get();

            // Check if the request is an AJAX request
            if ($request->ajax()) {
                // Use Datatables to display the data
                return DataTables::of($getData)
                    ->addColumn('action', function ($data) {
                        $is_approve = $data->is_approve == '1' ? 'disabled' : '';
                        $btn = '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <button type="button" class="btn btn-primary" ' . $is_approve . '><i class="fa-solid fa-gear"></i></button>
                        <button type="button" class="btn btn-danger text-light"><i class="fa-solid fa-trash-can"></i></button>                        
                      </div>';
                        return $btn;
                    })
                    // Add a column for the user's catatan
                    ->addColumn('catatan', function ($data) {
                        // Return the catatan value
                        return $data->catatan;
                    })
                    ->addColumn('status', function ($data) {
                        $status = $data->is_approve == '1' ? '<span class="badge bg-success">Disetujui</span>' : '<span class="badge bg-warning">Belum disetujui</span>';
                        return $status;
                    })
                    // Make the columns raw so that HTML can be rendered
                    ->rawColumns(['catatan', 'action', 'status'])
                    // Add an index column
                    ->addIndexColumn()
                    // Return the Datatables object
                    ->make(true);
            }
        } catch (\Exception $e) {
            // If an exception occurs, return the error message
            return $e->getMessage();
        }
    }

    public function storeLogBook(Request $request)
    {
        try {
            // Decrypt the proposal ID
            $pendaftaran_id = Crypt::decrypt($request->idProposal);

            // Retrieve the pembimbing data for the decrypted proposal ID
            $getPembimbing = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $pendaftaran_id)
                ->where('tipe', 'B')
                ->where('is_ok', '1')
                ->get();

            DB::beginTransaction();
            $taskDo = 0;  // Number of tasks completed
            $mustDo = count($getPembimbing);  // Total number of tasks

            /**
             * Insert or update the logbook records for each pembimbing
             */
            foreach ($getPembimbing as $pembimbing) {
                if (empty($idLogBook)) {
                    // Insert a new logbook record
                    DB::table('tr_logbook')->insert([
                        'id' => Str::uuid(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'nim' => $request->nimLogBook,
                        'nip' => $pembimbing->nip,
                        'tgl_bimbingan' => $request->tgl_bimbingan,
                        'catatan' => $request->catatanLogBook,
                        'is_approve' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    // Update an existing logbook record
                    DB::table('tr_logbook')->where('pendaftaran_id', $pendaftaran_id)->update([
                        'id' => Str::uuid(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'nim' => $request->nimLogBook,
                        'nip' => $pembimbing->nip,
                        'tgl_bimbingan' => $request->tgl_bimbingan,
                        'catatan' => $request->catatanLogBook,
                        'is_approve' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                $taskDo++;  // Increment the number of tasks completed
            }

            if ($taskDo == $mustDo) {
                // If all tasks are completed, commit the transaction
                DB::commit();
                return response()->json(true);
            } else {
                // If not all tasks are completed, rollback the transaction
                DB::rollBack();
                return response()->json(false);
            }
        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction and return the error message
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }
}
