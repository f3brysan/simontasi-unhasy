<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all users
        $users = User::with('roles')->get();
        // Initialize an empty array for the users data
        $usersData = [];
        // Get roles that can be assigned to the user
        $roles = Role::whereIn('name', ['superadmin', 'pengelola'])->get();

        // Loop through each user
        foreach ($users as $user) {
            // Add user's data to the users data array
            $usersData[] = [
                // User ID
                'id' => $user->id,
                // User's name
                'name' => $user->nama ?? '',
                // User's student number
                'no_induk' => $user->no_induk ?? '',
                // User's program of study
                'prodi' => $user->prodi_kode ? [(new GetDataAPISiakad)->getDataProdi($user->prodi_kode)['prodi'] ?? ''] : [],
                // User's roles
                'roles' => $user->roles->pluck('name')->toArray(),
            ];
        }

        // Get all prodi_kode and user_id from tr_user_prodi
        $prodiPengelola = DB::table('tr_user_prodi')->get();
        // Loop through each prodi_kode and user_id
        foreach ($prodiPengelola as $item) {
            // Get the program of study name
            $prodi = (new GetDataAPISiakad)->getDataProdi($item->kode_prodi)['prodi'] ?? '';
            // Get the user's index based on the user's ID
            $prodiIndex = array_search($item->user_id, array_column($usersData, 'id'));
            // Add the program of study to the user's data
            $usersData[$prodiIndex]['prodi'][] = $prodi;
        }

        // Get all programs of study
        $prodiList = (new GetDataAPISiakad)->getDataProdi() ?? [];

        if ($request->ajax()) {
            // Use Datatables to display the data
            return DataTables::of($usersData)
                // Add a column for the user's action
                ->addColumn('action', function ($user) use ($roles) {
                    $btn = '';
                    // If the user has a role that can be assigned to the user
                    if (array_intersect($user['roles'], $roles->pluck('name')->toArray())) {
                        // Add a button to assign roles to the user
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($user['id']) . '" data-original-title="Ubah Peran" title="Ubah Peran" class="edit btn btn-primary btn-sm edit-user"><i class="fa-solid fa-wrench"></i></a>';
                    }

                    return $btn;
                })
                // Add a column for the user's roles
                ->addColumn('roles', function ($user) {
                    $result = '';
                    // Loop through each role
                    foreach ($user['roles'] as $role) {
                        // Add a badge for the role
                        $result .= '<span class="badge bg-info m-1">' . $role . '</span>';
                    }
                    return $result;
                })
                // Add a column for the user's programs of study
                ->addColumn('prodi', function ($user) {
                    $result = '';
                    // Loop through each program of study
                    foreach ($user['prodi'] as $prodi) {
                        // Add the program of study to the result
                        $result .= '<ol>' . $prodi . '</ol>';
                    }
                    return $result;
                })
                // Make the columns raw so that HTML can be rendered
                ->rawColumns(['roles', 'action', 'prodi'])
                // Add an index column
                ->addIndexColumn()
                // Return the Datatables object
                ->make(true);
        }

        // Return the index view with the data
        return view('user.index', compact('prodiList', 'roles'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Begin transaction
        DB::beginTransaction();

        try {
            // Create a new user
            $user = User::create([
                'name' => $request->nama,
                'no_induk' => $request->no_induk,
                'email' => $request->no_induk . '@unhasy.ac.id',
                'password' => bcrypt($request->password)
            ]);

            // Assign roles to the user
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }

            // Add the user's program of study
            foreach ($request->prodi as $program) {
                DB::table('tr_user_prodi')->insert([
                    'user_id' => $user->id,
                    'kode_prodi' => $program,
                    'created_at' => now()
                ]);
            }

            // Commit the transaction
            DB::commit();

            return response()->json(true);

        } catch (\Exception $exception) {
            // Rollback the transaction
            DB::rollBack();

            // Return the exception message
            return response()->json($exception->getMessage());
        }
    }
}
