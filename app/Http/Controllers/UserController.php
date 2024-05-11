<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('roles')->get();

        $dataProdi = [];
        $getProdi = (new GetDataAPISiakad)->getDataProdi();       

        if ($request->ajax()) {
            return DataTables::of($users)
                ->addColumn('action', function ($users) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . Crypt::encrypt($users->id) . '" data-original-title="Ubah Peran" title="Ubah Peran" class="edit btn btn-primary btn-sm edit-user"><i class="fa-solid fa-wrench"></i></a>';
                    return $btn;
                })
                ->addColumn('roles', function ($users) {
                    $result = '';
                    foreach ($users->roles as $role) {
                        $result .= '<span class="badge bg-info">' . $role->name . '</span>';
                    }
                    return $result;
                })
                ->addColumn('prodi', function($users){
                    $result = '';
                    if ($users->prodi_kode) {
                        $prodi = (new GetDataAPISiakad)->getDataProdi($users->prodi_kode);
                        $result = $prodi->prodi;
                    }
                   
                    return $result;
                })
                ->rawColumns(['roles', 'action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.index', compact('dataProdi'));
    }
}
