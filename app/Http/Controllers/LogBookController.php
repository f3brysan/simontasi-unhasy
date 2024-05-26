<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
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
                        <button type="button" class="btn btn-danger text-light" '.$is_approve   .'><i class="fa-solid fa-trash-can"></i></button>                        
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

    public function getDosenLogBook(Request $request)
    {
        $nip = auth()->user()->no_induk;
        $getMahasiswaLogBooks = DB::table("tr_pendaftaran as p")
            ->join("users as u", function ($join) {
                $join->on("u.no_induk", "=", "p.no_induk");
            })
            ->join("tr_pendaftaran_dosen as pd", function ($join) {
                $join->on("pd.pendaftaran_id", "=", "p.id");
            })
            ->select("p.*", "u.nama", "u.prodi_kode")
            ->where("pd.nip", $nip)
            ->get();

        $countLogBooks = DB::table("tr_logbook")
            ->select("pendaftaran_id", DB::raw("count (*)"))
            ->where("nip", $nip)
            ->where('is_approve', '0')
            ->groupBy("pendaftaran_id")
            ->get();

        foreach ($getMahasiswaLogBooks as $logBook) {
            $prodi = (new GetDataAPISiakad)->getDataProdi($logBook->prodi_kode);
            $mahasiswaLogBooks[$logBook->id] = [
                'id' => $logBook->id,
                'no_induk' => $logBook->no_induk,
                'nama' => $logBook->nama,
                'title' => $logBook->title,
                'prodi' => $prodi->prodi
            ];
        }
        foreach ($countLogBooks as $count) {
            $mahasiswaLogBooks[$count->pendaftaran_id]['total_logbook'] = $count->count;
        }

        if ($request->ajax()) {
            return DataTables::of($mahasiswaLogBooks)
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . URL::to('dosen/log-bimbingan/detil/' . Crypt::encrypt($data['id'])) . '" target="_blank" class="btn btn-primary btn-sm">Lihat</a>';
                    return $btn;
                })
                ->addColumn('title', function ($data) {
                    return $data['title'];
                })
                ->addColumn('total_logbook', function ($data) {
                    return '<span class="badge bg-warning text-dark">' . $data['total_logbook'] . ' Menunggu Approval</span>';
                })
                // Make the columns raw so that HTML can be rendered
                ->rawColumns(['action', 'title', 'total_logbook'])
                // Add an index column
                ->addIndexColumn()
                // Return the Datatables object
                ->make(true);
        }

        return view('logbook.dosen.index');
    }

    public function getDetilLogBookMhs($id, Request $request)
    {
        // Decrypt the ID
        $id = Crypt::decrypt($id);

        // Retrieve the logbooks for the given pendaftaran ID
        $logBooks = DB::table("tr_logbook")
            ->where("pendaftaran_id", $id)
            ->get();

        // Retrieve the proposal data for the given pendaftaran ID
        $dataProposal = DB::table('tr_pendaftaran as p')
            ->where('id', $id)->first();

        // Retrieve the user data (mahasiswa) for the given proposal data
        $dataMHS = User::where('no_induk', $dataProposal->no_induk)->first();

        // Retrieve the program study data for the given user data
        $prodi = (new GetDataAPISiakad)->getDataProdi($dataMHS->prodi_kode);

        // Prepare the data for the view
        $data = [
            'dataProposal' => $dataProposal,
            'dataMHS' => $dataMHS,
            'logBooks' => $logBooks,
            'prodi' => $prodi
        ];

        /**
         * Check if the request is an AJAX request
         * Use Datatables to display the data         
         */
        if ($request->ajax()) {
            // Use Datatables to display the data
            return DataTables::of($logBooks)
                /**
                 * Add a column for the action button                 
                 */
                ->addColumn('action', function ($data) {
                    // Determine the button type and icon based on the is_approve value
                    $btnType = $data->is_approve == 0 ? 'btn-success' : 'btn-warning';
                    $btnIcon = $data->is_approve == 0 ? 'fa-check' : 'fa-arrows-rotate';
                    // Generate the HTML for the button
                    $btn = '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button type="button" data-id="' . Crypt::encrypt($data->id) . '" data-status="' . $data->is_approve . '" class="approve btn ' . $btnType . ' text-light"><i class="fa-solid ' . $btnIcon . '"></i></button>                   
                  </div>';
                    // Return the button HTML
                    return $btn;
                })
                /**
                 * Add a column for the user's catatan                 
                 */
                ->addColumn('catatan', function ($data) {
                    // Return the catatan value
                    return $data->catatan;
                })
                /**
                 * Add a column for the status                 
                 */
                ->addColumn('status', function ($data) {
                    // Determine the status badge based on the is_approve value
                    $status = $data->is_approve == '1' ? '<span class="badge bg-success">Disetujui</span>' : '<span class="badge bg-warning">Belum disetujui</span>';
                    // Return the status badge HTML
                    return $status;
                })
                // Make the columns raw so that HTML can be rendered
                ->rawColumns(['catatan', 'action', 'status'])
                // Add an index column
                ->addIndexColumn()
                // Return the Datatables object
                ->make(true);
        }

        // Pass the data to the view
        return view('logbook.dosen.detil-mhs', $data);
    }

    public function approveDetilLogBookMhs($id)
    {
        /**
         * Approve or reject a logbook entry
         *
         * @param string $id The encrypted ID of the logbook entry
         * @return \Illuminate\Http\JsonResponse The status of the update
         */
        try {
            // Decrypt the ID parameter
            $id = Crypt::decrypt($id);

            // Retrieve the logbook entry
            $get = DB::table('tr_logbook')->where('id', $id)->first();

            // Determine the new status based on the current status
            $status = $get->is_approve == 1 ? 0 : 1;

            // Update the logbook entry with the new status and current timestamp
            $update = DB::table('tr_logbook')->where('id', $id)->update([
                'is_approve' => $status,
                'approve_at' => date('Y-m-d H:i:s')
            ]);

            // Return the new status as a JSON response
            return response()->json($status);
        } catch (\Exception $e) {
            // If an exception occurs, return the error message as a JSON response
            return response()->json($e->getMessage());
        }
    }
}
