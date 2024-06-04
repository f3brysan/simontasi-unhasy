<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ProposalController extends Controller
{
    public function index()
    {
        // Get list of dosen pembimbing
        $getDosen = (new GetDataAPISiakad)->getDataDosen();

        // Filter dosen pembimbing by current user's program study
        $allDosenPembimbing = [];
        foreach ($getDosen as $item) {
            if ($item->prodi_kode == auth()->user()->prodi_kode) {
                $allDosenPembimbing[$item->no_identitas] = [
                    'nip' => $item->no_identitas,
                    'nama' => $item->nama,
                ];
            }
        }
        ksort($allDosenPembimbing);

        // Get proposal data
        $no_induk = auth()->user()->no_induk;
        $dataProposal = DB::table('tr_pendaftaran as p')
            ->where('no_induk', $no_induk)->first();

        // Retrieve data of the current user's program study
        $prodi = (new GetDataAPISiakad)->getDataProdi(auth()->user()->prodi_kode);

        // Prepare data to be passed to the view        
        $data = [
            'allDosenPembimbing' => $allDosenPembimbing,
            'dataProposal' => $dataProposal,
            'berkasProposal' => null,
            'pembimbing' => null,
            'penguji' => null,
            'prodi' => $prodi->prodi,
        ];

        // Get proposal berkas, pembimbing, dan penguji
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

        return view('proposal.index', $data);
    }

    public function storeProposal(Request $request)
    {
        /**
         * Store a new proposal in the database.
         *
         * @param Request $request The HTTP request containing the proposal data.
         * @return \Illuminate\Http\JsonResponse A JSON response indicating the success or failure of the operation.
         * @throws \Exception If an error occurs during the database transaction.
         */
        try {
            // Get the user's student number and the data of the selected professor
            $no_induk = auth()->user()->no_induk;
            $dataDosen = (new GetDataAPISiakad)->getDataDosen($request->dosen_pembimbing);

            // Check if the user already has a proposal
            $isExist = DB::table('tr_pendaftaran as p')
                ->where('no_induk', $no_induk)->exists();
            DB::beginTransaction();

            // If the user does not have a proposal, create a new one
            if (!$isExist) {
                $idPendaftaran = Str::uuid();
                $insertProposal = DB::table('tr_pendaftaran')->insert([
                    'id' => $idPendaftaran,
                    'no_induk' => $no_induk,
                    'title' => $request->judul,
                    'type' => 'P', // P = Proposal
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $insertDosen = DB::table('tr_pendaftaran_dosen')->insert([
                    'id' => Str::uuid(),
                    'pendaftaran_id' => $idPendaftaran,
                    'nip' => $request->dosen_pembimbing,
                    'nama' => $dataDosen->nama,
                    'tipe' => 'B', // B = Pembimbing
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => auth()->user()->nama,
                    'is_ok' => 0
                ]);

                // If the new proposal and the professor are successfully inserted, commit the transaction
                if (($insertDosen == true) && ($insertProposal == true)) {
                    DB::commit();
                    return response()->json(true);
                } else {
                    // If the insertion fails, rollback the transaction and return a failure response
                    DB::rollBack();
                    return response()->json(false);
                }
            } else {
                // If the user already has a proposal, return a failure response
                return response()->json(false);
            }
        } catch (\Exception $e) {
            // If an error occurs during the transaction, rollback the transaction and return the error message
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function approveDosenProposal($id)
    {
        /**
         * Approve or reject a proposal's proposal_head.
         *
         * @param string $id The encrypted ID of the proposal.
         * @return \Illuminate\Http\JsonResponse A JSON response that contains the new value of the proposal_head's approval status.
         * @throws \Exception If an error occurs while updating the proposal_head's approval status.
         */
        try {
            // Decrypt the encrypted ID.
            $id = Crypt::decrypt($id);

            // Get the proposal_head with the specified ID.
            $getDosenPembimbing = DB::table('tr_pendaftaran_dosen')
                ->where('tipe', 'B')
                ->where('pendaftaran_id', $id)
                ->first();

            // Calculate the new value of the proposal_head's approval status.
            $value = $getDosenPembimbing->is_ok == 1 ? 0 : 1;

            // Update the proposal_head's approval status.
            DB::table('tr_pendaftaran_dosen')
                ->where('tipe', 'B')
                ->where('pendaftaran_id', $id)
                ->update([
                    'is_ok' => $value,
                    'is_ok_by' => auth()->user()->nama, // Update the name of the user who approved or rejected the proposal.
                    'is_ok_at' => date('Y-m-d H:i:s') // Update the timestamp of the approval/rejection.
                ]);

            // Return the new value of the proposal_head's approval status.
            return response()->json($value);
        } catch (\Exception $e) {
            // If an error occurs, return an error message along with the error code.
            return response()->json($e->getMessage(), 500);
        }
    }
}
