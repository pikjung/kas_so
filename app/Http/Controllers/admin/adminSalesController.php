<?php

namespace App\Http\Controllers\admin;

use App\Models\area;
use App\Models\User;
use App\Models\sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class adminSalesController extends Controller
{
    //
    public function index()
    {
        $area = area::all();
        $sales = sales::orderBy('created_at', 'desc')->get();
        return view('admin_kas.sales.sales', ['sales' => $sales, 'areas' => $area]);
    }

    public function show($id)
    {
        $sales = sales::findOrFail($id);
        return response()->json(['sales' => $sales], 200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'area_id' => 'required',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'role_id' => '4',
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        sales::create([
            'user_id' => $user->id,
            'area_id' => $request->area_id,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Sales successfully created']);
    }
}
