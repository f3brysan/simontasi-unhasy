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
                            $btn = '<a href="' . URL::to('/') . '/' . $data->attachment . '" class="btn btn-sm btn-info" target="_blank"> Lihat berkas</a>';
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
                    $path = 'uploads/logbook';

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
                        'attachment' => $storage,
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

        if ($dataProposal->type == 'T') {
            $formPenilaian = DB::table('ms_indikator_penilaian as ip')
                ->select('ip.*', 'kp.nama as nama_komponen', 'n.nilai')
                ->join('ms_komponen_penilaian as kp', 'kp.id', '=', 'ip.komponen_penilaian_id')
                ->leftJoin('tr_nilai as n', function ($join) use ($dataProposal) {
                    $join->on('n.indikator_penilaian', '=', 'ip.id')
                        ->where('n.pendaftaran_id', $dataProposal->id)
                        ->where('n.created_by', auth()->user()->no_induk);
                })
                ->get();
            $totalNilai = $formPenilaian->sum('nilai');
            $namaJenisPendaftaran = 'TA/Skripsi/Tesis/Munosaqah';
        } else {
            $formPenilaian = [];
            $namaJenisPendaftaran = 'Proposal';
            $totalNilai = 0;
        }

        $checkDosenRole = DB::table('tr_pendaftaran_dosen')
            ->where('pendaftaran_id', $dataProposal->id)
            ->where('nip', auth()->user()->no_induk)
            ->first();


        // Prepare the data for the view
        $data = [
            'dataProposal' => $dataProposal,
            'dataMHS' => $dataMHS,
            'logBooks' => $logBooks,
            'prodi' => $prodi,
            'jadwal' => $jadwal,
            'formPenilaian' => $formPenilaian,
            'namaJenisPendaftaran' => $namaJenisPendaftaran,
            'totalNilai' => $totalNilai,
            'checkDosenRole' => $checkDosenRole
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
            
        $data['allowBtn'] = $data['statusProposal']->status == '1' ? false : true;
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
                ->addColumn('action', function ($data) use ($checkDosenRole) {
                    // Determine the button type and icon based on the is_approve value
                    $btnType = $data->is_approve == 0 ? 'btn-success' : 'btn-warning';
                    $btnIcon = $data->is_approve == 0 ? 'fa-check' : 'fa-arrows-rotate';
                    $title = $data->is_approve == 0 ? 'Terima' : 'Reset';
                    // Generate the HTML for the button
                    $btn = '';
                    if ($checkDosenRole->tipe == 'B') {
                        $btn = '<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                    <button type="button" data-id="' . Crypt::encrypt($data->id) . '" data-status="' . $data->is_approve . '" class="approve btn ' . $btnType . ' text-light" title="' . $title . '"><i class="fa-solid ' . $btnIcon . '"></i></button>                   
                    </div>';
                    }

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
                ->addColumn('attachment', function ($data) {
                    $btn = '';
                    if (isset($data->attachment)) {
                        $btn = '<a href="' . URL::to('/') . '/' . $data->attachment . '" class="btn btn-sm btn-info" target="_blank"> Lihat berkas</a>';
                    }
                    return $btn;
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
                ->rawColumns(['catatan', 'action', 'status', 'attachment'])
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
            ->leftJoin('tr_pendaftaran_status as tps', 'tps.pendaftaran_id', '=', 'tp.id')
            ->where('tp.no_induk', $noInduk)
            ->where(function ($query) {
                $query->whereNull('tps.status')
                    ->orWhere('tps.status', '!=', '0');
            })
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
            $insert = DB::table('tr_pendaftaran_status')->where('pendaftaran_id', $getPendaftaran->id)->update([
                'status' => $hasilSidang,
                'created_by' => auth()->user()->no_induk,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $update = DB::table('tr_pendaftaran_status')->where('pendaftaran_id', $getPendaftaran->id)->update([
                'status' => $hasilSidang,
                'catatan' => $catatan,
                'created_by' => auth()->user()->no_induk,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return back()->with('success', 'Hasil Sidang Proposal berhasil disimpan');

    }

    /**
     * Store or update nilai sidang for a given pendaftaran.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNilaiSidang(Request $request)
    {
        try {
            // Decrypt the pendaftaran_id from the request
            $pendaftaran_id = Crypt::decrypt($request->pendaftaran_id);

            // Begin a database transaction
            DB::beginTransaction();
            $sumNilai = 0;
            // Iterate through each nilai item in the request
            foreach ($request->nilai as $key => $value) {
                // Check if the nilai already exists for the given pendaftaran_id and indikator_penilaian
                $checkExist = DB::table('tr_nilai')
                    ->where('pendaftaran_id', $pendaftaran_id)
                    ->where('indikator_penilaian', $key)
                    ->where('created_by', auth()->user()->no_induk)
                    ->exists();

                // If it exists, update the existing entry
                if ($checkExist) {
                    // Update the existing entry
                    $exe = DB::table('tr_nilai')
                        ->where('pendaftaran_id', $pendaftaran_id)
                        ->where('indikator_penilaian', $key)
                        ->where('created_by', auth()->user()->no_induk)
                        ->update([
                            'nilai' => $value,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                } else {
                    // Otherwise, insert a new entry
                    $exe = DB::table('tr_nilai')->insert([
                        'id' => Str::uuid(),
                        'pendaftaran_id' => $pendaftaran_id,
                        'indikator_penilaian' => $key,
                        'nilai' => $value,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => auth()->user()->no_induk,
                    ]);
                }                               
                // Add the nilai to the sum
                $sumNilai += $value;
            }

            // Update the nilai of the pendaftaran_dosen table
            $updateNilaiDosen = DB::table('tr_pendaftaran_dosen')
                ->where('pendaftaran_id', $pendaftaran_id)
                ->where('nip', auth()->user()->no_induk)
                ->update([
                    'nilai' => $sumNilai,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            // If the operation fails, roll back the transaction and return an error
            if(!$updateNilaiDosen){
                DB::rollBack();
                return back()->with('error', 'Gagal menyimpan nilai sidang');
            }

            // Commit the transaction if all operations succeed
            DB::commit();
            return back()->with('success', 'Berhasil menyimpan nilai sidang');
        } catch (\Throwable $th) {
            // Handle any exceptions and output the error message
            dd($th->getMessage());
        }
    }
}
