<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('roles')->get();
        
        
        if ($request -> ajax()) {
            return DataTables::of($users)            
            ->addColumn('action', function ($users) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$users->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post">Edit</a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$users->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                return $btn;
            })
            ->addColumn('roles', function ($users) {
                $result = '';
                foreach ($users->roles as $role) {
                    $result .= $role->name . ', ';
                }

                return $result;
            })
            ->rawColumns(['roles', 'action'])
            ->addIndexColumn()
            ->make(true);
        }


    }
}
