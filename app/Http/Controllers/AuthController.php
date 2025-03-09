<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function index()
    {
        // Display the login form
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        // Validate email and password fields
        $request->validate([
            'no_induk' => ['required'],
            'password' => ['required'],
        ]);

        // Define the credentials for user authentication
        $credentials = $request->validate([
            'no_induk' => ['required'],
            'password' => ['required'],
        ]);

        // Attempt user authentication
        if (Auth::attempt($credentials)) {
            // If authentication is successful, regenerate the session and
            // store the user information in the session
            $request->session()->regenerate();
            $user = auth()->user();            
            // Redirect to the intended page with a success message
            return redirect()->intended('/')->with('success', 'Selamat Datang ' . $user->name ?? $user->email . '.');
        }

        // If authentication fails with the provided credentials
        if (!Auth::attempt($credentials)) {
            // Prepare credentials to check against an external system (e.g., SIAKAD)
            $parr = array(
                'type' => 'auth',
                'username' => $request->no_induk,
                'password' => $request->password
            );

            // Make a request to an external system (SIAKAD) to authenticate
            $cekAuthSiakad = $this->requestData('http://siakad.unhasy.ac.id/api/all.php', 'POST', $parr);

            // If authentication against external system fails
            if (empty($cekAuthSiakad)) {
                return back()->with('LoginError', 'Tidak Bisa Mengakses Data Siakadu');
            }

            // If authentication against external system succeeds
            if (!empty($cekAuthSiakad)) {
                if ($cekAuthSiakad->message == "Login Fail.") {
                    return back()->with('LoginError', 'Email atau Password SIAKAD Anda salah !');
                }
                if ($cekAuthSiakad->message == "Login succeed.") {
                    // Extract user data from the response
                    $dataUser = $cekAuthSiakad->data;          
                    $prodi_kode = $dataUser->prodi_kode ?? NULL;                    
                    // Create a new user in the local system
                    $register = User::create([
                        'nama' => $dataUser->name,
                        'no_induk' => $dataUser->no_identitas,
                        'email' => $dataUser->email,
                        'password' => bcrypt($request->password),
                        'prodi_kode' => $prodi_kode,
                    ]);

                    // Assign role based on user type
                    if ($dataUser->jenis == 'MHS') {
                        $register->assignRole('mahasiswa');
                    }
                    if ($dataUser->jenis == 'DOSEN') {
                        $register->assignRole('dosen');
                    }

                    // Log in the newly created user
                    Auth::loginUsingId($register->id);
                    $request->session()->regenerate();
                    $user = auth()->user();

                    // Redirect to the intended page with a success message
                    return redirect()->intended('/')->with('success', 'Selamat Datang ' . $user->name ?? $user->email . '.');
                }
            }
        }

        // If all authentication attempts fail, return to the previous page with an error message
        return back()->with('LoginError', 'Email atau Password Anda salah !');

    }

    public function loginAs(Request $request) 
    {
        try {
            $id = Crypt::decrypt($request->id);            

            $getUser = User::where('id', $id)->exists();
            if ($getUser) {
                Auth::loginUsingId($id);
                $request->session()->regenerate();
                $user = auth()->user();
                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil',
                    'data' => $user
                ]);                
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        // Logout the user and invalidate the session
        Auth::logout();
        $request->session()->invalidate();
        // Regenerate the CSRF token for the next request
        $request->session()->regenerateToken();
        // Redirect to the login page
        return redirect('/login');
    }

    public function gantiPassword() 
    {
        $usernameAsPass = auth()->user()->no_induk;        
        $firstPassword = NULL;
        if (Hash::check($usernameAsPass, auth()->user()->password)) {                                    
            $firstPassword = $usernameAsPass;
        }
        return view('auth.ganti-password', compact('firstPassword'));
    }
}
