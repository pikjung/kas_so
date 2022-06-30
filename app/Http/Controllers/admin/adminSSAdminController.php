<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

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

    public function tambah(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'role_id' => 3,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Admin SS successfully Created']);
    }
}
