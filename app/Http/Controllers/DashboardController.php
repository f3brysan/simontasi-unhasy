<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames()->toArray();
        
        if (in_array('superadmin', $roles)) {
            return view('dashboard.index');
        }

        if (in_array('mahasiswa', $roles)) {   
            return view('dashboard.mahasiswa');         
        }
        
    }
}
