<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class API_NilaiAkhirController extends Controller
{
    /**
     * Get Nilai Akhir
     * 
     * This function will get the Nilai Akhir from the database based on the NIM
     * that is passed in the request.
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNilaiAkhir(Request $request)
    {
        try {
            // Get the input NIM from the request
            $nim = $request->input('nim');
            
            // Get the data from the tr_pendaftaran and tr_pendaftaran_status table
            // where the type is T and the NIM is in the input array
            // The result will be stored in the $getNilaiAkhir variable
            $getNilaiAkhir = DB::table('tr_pendaftaran as tp')
            ->select('tp.*','tps.nilai','tps.grade','tps.nilai_konversi')
            ->join('tr_pendaftaran_status as tps','tps.pendaftaran_id','=','tp.id')
            ->where('tp.type','=','T')
            ->where('tp.no_induk', $nim)
            ->first();

            if (empty($getNilaiAkhir)) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan',
                    ],
                    404
                );
            }
            
            // Create an empty array to store the result
            $result = [
                'nim' => $getNilaiAkhir->no_induk,
                'nilai' => $getNilaiAkhir->nilai,
                'grade' => $getNilaiAkhir->grade,
                'nilai_konversi' => $getNilaiAkhir->nilai_konversi
                ];
            

            // Return the result as a JSON response with a 200 status code
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Data berhasil diambil',
                    'data' => $result,
                ],
                200
            );
        } catch (\Throwable $th) {
            // Catch any error that occurs and return it as a JSON response with a 500 status code
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $th->getMessage()
                ],
                500
            );
        }
    }
}
