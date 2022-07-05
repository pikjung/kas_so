<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class adminSSAdminController extends Controller
{
    //
    public function index()
    {
        $user = User::where('role_id', 3)->get();
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
            'username' => 'required',
            'password' => 'required',
        ]);

        $check = User::where('email', $request->email)->first();
        if (!empty($check)) {
            return redirect()->back()->withErrors('Email Sudah digunakan');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Admin SS successfully Created']);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        if ($request->password != null) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $password;
        $user->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Admin SS successfully Updated']);
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Admin SS successfully deleted']);
    }
}
