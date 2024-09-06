<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

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
                        <button type="button" data-id="' . Crypt::encrypt($data->id) . '" class="btn btn-primary edit" ' . $is_approve . '><i class="fa-solid fa-gear"></i></button>
                        <button type="button" data-id="' . Crypt::encrypt($data->id) . '" class="btn btn-danger text-light delete" ' . $is_approve . '><i class="fa-solid fa-trash-can"></i></button>                        
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
                    ->addColumn('attachment', function ($data) {
                        $btn = '';
                        if (isset($data->attachment)) {                            
                            $btn = '<a href="'.URL::to('/').'/'.$data->attachment.'" class="btn btn-sm btn-info" target="_blank"> Lihat berkas</a>';
                        }
                        return $btn;
                    })
                    // Make the columns raw so that HTML can be rendered
                    ->rawColumns(['catatan', 'action', 'status', 'attachment'])
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

    public function countLogBookProposal($id)
    {
        try {
            // Decrypt the ID parameter
            $pendaftaran_id = Crypt::decrypt($id);
            
            // Retrieve the logbook data for the decrypted ID
            $getData = DB::table('tr_logbook')->where('pendaftaran_id', $pendaftaran_id)->count();

            return response()->json($getData);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getDetilLogBook($id)
    {
        try {
            // Decrypt the ID parameter
            $id = Crypt::decrypt($id);

            // Retrieve the logbook entry
            $get = DB::table('tr_logbook')->where('id', $id)->first();
            $get->pendaftaran_id = Crypt::encrypt($get->pendaftaran_id);

            return response()->json(['message' => 'success', 'data' => $get], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
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
                $storage = NULL;

                // Check if the formFile field is not empty
                if ($request->formFile) {
                    // Retrieve the uploaded file from the request
                    $file = $request->file('formFile');

                    // Get the extension of the uploaded file
                    $extension = $file->getClientOriginalExtension();

                    // Generate the path where the file will be stored
                    $path = 'uploads/logbook/';

                    // Store the file in the specified path
                    $storage = Storage::disk('my_files')->put($path, $file);
                }

                if (empty($request->idLogBook)) {
                    // Insert a new logbook record
                    DB::table('tr_logbook')->insert([
                        'id' => Str::uuid(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'nim' => $request->nimLogBook,
                        'nip' => $pembimbing->nip,
                        'tgl_bimbingan' => $request->tgl_bimbingan,
                        'catatan' => $request->catatanLogBook,
                        'is_approve' => 0,
                        'attachment' => $storage,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    // Retrieve the existing logbook record
                    $getOld = DB::table('tr_logbook')->where('id', $request->idLogBook)->first();

                    // Check if the formFile field is empty
                    if ($storage == NULL) {
                        // Keep the existing attachment
                        $storage = $getOld->attachment;
                    }
                    
                    // Update an existing logbook record
                    DB::table('tr_logbook')->where('id', $request->idLogBook)->update([
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
            ->where("nip", $nip)
            ->get();

        $mahasiswaLogBooks = [];
        foreach ($getMahasiswaLogBooks as $logBook) {
            $prodi = DB::table('ms_prodi')->where('kode_prodi', $logBook->prodi_kode)->first();
            $mahasiswaLogBooks[$logBook->id] = [
                'id' => $logBook->id,
                'no_induk' => $logBook->no_induk,
                'nama' => $logBook->nama,
                'title' => $logBook->title,
                'type' => $logBook->type,
                'prodi' => $prodi->prodi,
                'wait_logbook' => 0,
                'total_logbook' => 0
            ];
        }

        foreach ($countLogBooks as $count) {
            if ($count->is_approve == 0) {
                $mahasiswaLogBooks[$count->pendaftaran_id]['wait_logbook']++;
            }
            $mahasiswaLogBooks[$count->pendaftaran_id]['total_logbook']++;
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
                ->addColumn('type', function ($data) {
                    return $data['type'] == 'P' ? 'Proposal' : 'TA/Skripsi/Tesis';
                })
                ->addColumn('total_logbook', function ($data) {
                    $status = '<span class="badge bg-warning text-dark">' . $data['wait_logbook'] . ' Menunggu Approval</span>';
                    $status .= '/';
                    $status .= '<span class="badge bg-info text-light">' . $data['total_logbook'] . ' Data Log Book</span>';
                    return $status;
                })
                // Make the columns raw so that HTML can be rendered
                ->rawColumns(['action', 'title', 'total_logbook', 'type'])
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
            ->leftJoin('users as u', function ($join) {
                // Use the on and where methods to specify the join condition
                $join->on('u.no_induk', '=', 'p.no_induk');
            })
            ->where('p.id', $id)
            ->select("p.*", "u.nama")
            ->first();

        // Retrieve the user data (mahasiswa) for the given proposal data
        $dataMHS = User::where('no_induk', $dataProposal->no_induk)->first();

        // Retrieve the program study data for the given user data        
        $prodi = DB::table('ms_prodi')->where('kode_prodi', $dataMHS->prodi_kode)->first();

        $jadwal = DB::table('tr_pendaftaran_jadwal')->where('id', $dataProposal->id)->first();

        // Prepare the data for the view
        $data = [
            'dataProposal' => $dataProposal,
            'dataMHS' => $dataMHS,
            'logBooks' => $logBooks,
            'prodi' => $prodi,
            'jadwal' => $jadwal
        ];

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

        // Retrieve the proposal documents
        $data['berkas'] = DB::table('ms_berkas as b')
            // Select the necessary fields
            ->select('b.*', 'pb.id as doc_id', 'pb.file', 'pb.is_lock')
            // Join the tr_pendaftaran_berkas table to retrieve the associated file
            ->leftJoin('tr_pendaftaran_berkas as pb', function ($join) use ($dataProposal) {
                // Use the on and where methods to specify the join condition
                $join->on('pb.berkas_id', '=', 'b.id')
                    ->where('pb.pendaftaran_id', '=', $dataProposal->id);
            })
            // Filter the documents to only include those of type 'P'
            ->where('b.type', 'P')
            // Get the results
            ->get();

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

        // Retrieve the status of the proposal This is used to display the status of the proposal on the detail logbook page
        $data['statusProposal'] = DB::table('tr_pendaftaran_status')
            ->where('pendaftaran_id', $dataProposal->id)
            ->first();

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

    public function deleteDetilLogBookMhs($id)
    {
        try {
            // Decrypt the ID parameter
            $id = Crypt::decrypt($id);

            // Insert the logbook entry into the temporary table
            // This is done to preserve the logbook entry in case it needs to be recovered
            $sql = "INSERT INTO temp_tr_logbook
            SELECT * FROM tr_logbook
            WHERE id = '$id'";
            $insertToTemp = DB::statement($sql); // Insert the logbook entry into the temporary table

            // Delete the logbook entry from the main table
            $get = DB::table('tr_logbook')->where('id', $id)->delete(); // Delete the logbook entry from the main table

            // Return the status of the deletion as a JSON response
            return response()->json(['message' => 'success', 'data' => $get], 200);
        } catch (\Exception $e) {
            // If an exception occurs, return the error message as a JSON response
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function storeHasilProposal(Request $request)
    {
        // dd($request->all());
        $noInduk = Crypt::decrypt($request->no_induk);
        $hasilSidang = $request->hasilsidang;
        $catatan = $request->catatanhasil;

        $getPendaftaran = DB::table('tr_pendaftaran as tp')
            ->select('tp.*')
            ->whereRaw('tp.id NOT IN (SELECT pendaftaran_id FROM tr_pendaftaran_status)')
            ->where('no_induk', $noInduk)
            ->first();

        switch ($hasilSidang) {
            case 'TERIMA':
                $hasilSidang = 1;
                break;
            case 'CATATAN':
                $hasilSidang = 1;
                break;
            case 'TOLAK':
                $hasilSidang = 0;
                break;
            default:
                $hasilSidang = 1;
                break;
        }

        if ($hasilSidang == 'TERIMA') {
            $insert = DB::table('tr_pendaftaran_status')->insert([
                'id' => Str::uuid(),
                'pendaftaran_id' => $getPendaftaran->id,
                'status' => $hasilSidang,
                'created_by' => auth()->user()->no_induk,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $insert = DB::table('tr_pendaftaran_status')->insert([
                'id' => Str::uuid(),
                'pendaftaran_id' => $getPendaftaran->id,
                'status' => $hasilSidang,
                'catatan' => $catatan,
                'created_by' => auth()->user()->no_induk,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return back()->with('success', 'Hasil Sidang Proposal berhasil disimpan');

    }
}
