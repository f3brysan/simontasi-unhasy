<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Fetch users with their roles
        $usersWithRoles = User::with('roles')->get();

        // Initialize an empty array to store user data
        $usersData = [];

        $roles = Role::whereIn('name', ['superadmin', 'pengelola'])->get();        

        // Iterate through each user
        foreach ($usersWithRoles as $user) {
            // Initialize user data array with basic information
            $userData = [
                'id' => $user->id,
                'nama' => $user->nama,
                'no_induk' => $user->no_induk,
                'prodi' => '',
                'fakultas' => ''
            ];

            // Fetch program and faculty data if available
            if ($user->prodi_kode) {
                $prodiData = (new GetDataAPISiakad)->getDataProdi($user->prodi_kode);
                $userData['prodi'] = $prodiData->prodi;

                $fakultasData = (new GetDataAPISiakad)->getDataFakultas($prodiData->kode_fakultas);
                $userData['fakultas'] = $fakultasData->fakultas;
            }

            // Add user roles to the user data
            foreach ($user->roles as $role) {
                $userData['roles'][] = $role->name;
            }

            // Add user data to the main array
            $usersData[$user->id] = $userData;
        }

        // Fetch faculty data
        $dataProdi = (new GetDataAPISiakad)->getDataProdi();
            
        // If request is AJAX, return DataTables
        if ($request->ajax()) {
            return DataTables::of($usersData)
                ->addColumn('action', function ($userData) {
                    $rolePermit = ['superadmin', 'pengelola'];
                    $btn = '';
                    if (array_intersect($userData['roles'], $rolePermit)) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . Crypt::encrypt($userData['id']) . '" data-original-title="Ubah Peran" title="Ubah Peran" class="edit btn btn-primary btn-sm edit-user"><i class="fa-solid fa-wrench"></i></a>';
                    }
                   
                    return $btn;
                })
                ->addColumn('roles', function ($userData) {
                    $result = '';
                    foreach ($userData['roles'] as $role) {
                        $result .= '<span class="badge bg-info">' . $role . '</span>';
                    }
                    return $result;
                })
                ->addColumn('prodi', function ($userData) {
                    return $userData['fakultas'] . '<br>' . $userData['prodi'];
                })
                ->rawColumns(['roles', 'action', 'prodi'])
                ->addIndexColumn()
                ->make(true);
        }

        // If not AJAX, return view with faculty data
        return view('user.index', compact('dataProdi', 'roles'));

    }
}
