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
                // 'prodi' => $user->prodi_kode ? [(new GetDataAPISiakad)->getDataProdi($user->prodi_kode)->prodi ?? ''] : [],
                'prodi' => $user->prodi_kode ? [DB::table('ms_prodi')->where('kode_prodi', $user->prodi_kode)->first()->prodi ?? ''] : [],
                // User's roles
                'roles' => $user->roles->pluck('name')->toArray(),
            ];
        }

        // Get all prodi_kode and user_id from tr_user_prodi
        $prodiPengelola = DB::table('tr_user_prodi')->get();
        // Loop through each prodi_kode and user_id
        foreach ($prodiPengelola as $item) {
            // Get the program of study name            
            $prodi = DB::table('ms_prodi')->where('kode_prodi', $item->kode_prodi)->first()->prodi ?? '';
            // Get the user's index based on the user's ID
            $prodiIndex = array_search($item->user_id, array_column($usersData, 'id'));            
            // Add the program of study to the user's data
            $usersData[$prodiIndex]['prodi'][] = $prodi;
        }

        // Get all programs of study        
        $prodiList = DB::table('ms_prodi')->get() ?? [];

        if ($request->ajax()) {
            // Use Datatables to display the data
            return DataTables::of($usersData)
                // Add a column for the user's action
                ->addColumn('action', function ($user) use ($roles) {
                    $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                    // If the user has a role that can be assigned to the user
                    if (array_intersect($user['roles'], $roles->pluck('name')->toArray())) {
                        // Add a button to assign roles to the user
                        $btn .= '<button href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($user['id']) . '" data-original-title="Ubah Peran" title="Ubah Peran" class="edit btn btn-primary btn-sm edit-user"><i class="fa-solid fa-wrench"></i></button>';
                    }else{
                        $btn .= '<button href="javascript:void(0)" data-toggle="tooltip" data-id="' . Crypt::encrypt($user['id']) . '" data-original-title="Ubah Peran" title="Ubah Peran" class="edit btn btn-secondary btn-sm edit-user" disabled><i class="fa-solid fa-wrench"></i></button>';
                    }                    
                    $btn .= '<button href="javascript:(0)" class="btn btn-sm btn-warning login-as" data-id="' . Crypt::encrypt($user['id']) . '" data-name="'.$user['name'].'" title="Login as"><i class="fa-solid fa-right-to-bracket"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                // Add a column for the user's roles
                ->addColumn('roles', function ($user) {
                    $result = '';
                    // Loop through each role
                    foreach ($user['roles'] as $role) {
                        switch ($role) {
                            case 'superadmin':
                                $type = 'bg-primary';
                                break;

                            case 'dosen':
                                $type = 'bg-info';
                                break;

                            case 'mahasiswa':
                                $type = 'bg-warning';
                                break;

                            default:
                                $type = 'bg-success';
                                break;
                        }
                        // Add a badge for the role
                        $result .= '<span class="badge ' . $type . ' m-1">' . $role . '</span>';
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

    public function create($parr)
    {

        try {
            // Start a new transaction
            DB::beginTransaction();

            // Create a new user            
            $user = User::create([
                'nama' => $parr['name'],
                'no_induk' => $parr['no_induk'],
                'email' => $parr['no_induk'] . '@unhasy.ac.id',
                'password' => bcrypt($parr['password'])
            ]);
            
            // Assign roles to the user
            foreach ($parr['roles'] as $role) {
                $user->assignRole($role);
            }

            if (isset($parr['prodi'])) {
                // Add the user's program of study
                foreach ($parr['prodi'] as $program) {
                    DB::table('tr_user_prodi')->insert([
                        'id' => Str::uuid(),
                        'user_id' => $user->id,
                        'kode_prodi' => $program,
                        'created_at' => now()
                    ]);
                }
            }


            // Commit the transaction
            DB::commit();

            return true;

        } catch (\Exception $exception) {
            // Rollback the transaction
            DB::rollBack();

            // Return the exception message
            return $exception->getMessage();
        }
    }

    /**
     * Update user data
     *
     * @param array $parr array of user data
     *
     * @return bool
     */
    public function update($parr)
    {
        // Start a new transaction
        DB::beginTransaction();
        // Get the user to be updated
        $user = User::where('id', $parr['id'])->first();
        // Update the user
        $updateUser = $user->update([
            'nama' => $parr['name'],
            'updated_at' => date('Y-m-d h:i:s')
        ]);

        // Re-assign roles to the user
        $user->syncRoles($parr['roles']);

        // Remove all the user's program of study
        $removeProdi = DB::table('tr_user_prodi')->where('user_id', $parr['id'])->delete();

        // Add the user's program of study
        foreach ($parr['prodi'] as $program) {
            DB::table('tr_user_prodi')->insert([
                'id' => Str::uuid(),
                'user_id' => $parr['id'],
                'kode_prodi' => $program,
                'created_at' => now()
            ]);
        }
        // Commit the transaction
        DB::commit();
        return true;
    }

    /**
     * Store a newly created or update existing user.
     *
     * This function is responsible for storing a newly created user
     * or update an existing user based on the presence of the 'id'
     * parameter in the request.
     *
     * @param Request $request the request containing the user data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Get all the request data
            $parr = $request->all();

            // Check if user is updating an existing user
            if (!empty($request->id)) {
                // If updating an existing user, update the user
                $store = $this->update($parr);
            } else { // Otherwise create a new user
                // If creating a new user, create the user                
                $store = $this->create($parr);                
            }

            // If the store operation is successful
            if ($store == true) {
                // Return JSON true
                return response()->json(true);
            } else { // Otherwise return JSON false
                return response()->json(false);
            }

        } catch (\Exception $exception) { // If exception occurs
            // Return the exception message
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Show the user with the given ID
     *
     * This function retrieves a user with the given ID and returns the user
     * along with their program of study and roles.
     *
     * @param string $id encrypted user ID
     *
     * @return \Illuminate\Http\JsonResponse user data
     */
    public function show($id)
    {
        $result = []; // initialize the result array
        $id = Crypt::decrypt($id); // decrypt the given ID
        $getUser = User::with('roles')->where('id', $id)->first(); // get the user
        $result['user'] = $getUser; // set the user data in the result
        $result['prodi'] = []; // initialize the program of study array
        $result['roles'] = []; // initialize the roles array

        $getProdi = DB::table('tr_user_prodi')->where('user_id', $id)->get(); // get the user's program of study
        foreach ($getProdi as $prodi) { // loop through the program of study
            array_push($result['prodi'], $prodi->kode_prodi); // add the program of study to the array
        }
        foreach ($getUser->roles as $role) { // loop through the user's roles
            array_push($result['roles'], $role->name); // add the role to the array
        }

        return response()->json($result); // return the user data

    }    
}
