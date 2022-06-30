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
        $user = User::find($sales->user_id);
        return response()->json(['sales' => $sales, 'user' => $user], 200);
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

    public function update(Request $request, $id)
    {
        $sales = sales::findOrFail($id);
        $request->validate([
            'area_id' => 'required',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = sales::findOrFail($sales->user_id);

        if ($request->password != null) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }

        $sales->area_id = $request->area_id;
        $sales->save();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Sales User successfully Updated']);

    }
}
