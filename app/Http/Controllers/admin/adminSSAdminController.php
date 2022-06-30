<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class adminSSAdminController extends Controller
{
    //
    public function index()
    {
        $user = User::where('role_id',3)->get();
        return view('admin_kas.admin_ss.admin_ss', ['users' => $user]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user], 200);
    }
}
