<?php

namespace App\Http\Controllers\admin;

use App\Models\area;
use App\Models\toko;
use App\Models\User;
use App\Models\region;
use App\Models\toko_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class adminTokoController extends Controller
{
    //
    public function index()
    {
        $toko = toko::orderBy('kode_toko', 'asc')->get();
        $region = region::all();
        return view('admin_kas.toko.toko', ['tokos' => $toko, 'regions' => $region]);
    }

    public function show($id)
    {
        $toko = toko::find($id);
        $user = User::find($toko->user_id);
        return response()->json(['tokos' => $toko, 'users' => $user], 200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'kode_toko' => 'required',
            'nama_toko' => 'required',
            'region_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 5
        ]);

        toko::create([
            'user_id' => $user->id,
            'nama_toko' => $request->nama_toko,
            'kode_toko' => $request->kode_toko,
            'region_id' => $request->region_id,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Toko Created!']);
    }

    public function update(Request $request, $id)
    {
        $toko = toko::findOrFail($id);
        $user = User::find($toko->user_id);

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'kode_toko' => 'required',
            'nama_toko' => 'required',
            'region_id' => 'required',
        ]);

        if (!empty($request->password)) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $password;
        $user->email = $request->email;
        $user->save();

        $toko->kode_toko = $request->kode_toko;
        $toko->nama_toko = $request->nama_toko;
        $toko->region_id = $request->region_id;
        $toko->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Toko Updated!']);
    }

    public function hapus($id)
    {
        $toko = toko::findOrFail($id);
        $user = User::find($toko->user_id);
        $toko->delete();
        $user->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Toko Deleted!']);
    }

    public function detail($id)
    {
        $toko_detail = DB::table('toko_details')
                        ->join('areas','toko_details.area_id','areas.id')
                        ->select('areas.nama_area')
                        ->get();
        return response()->json(['toko_details' => $toko_detail], 200);
    }

    public function detailIndex($id)
    {
        $toko  = toko::findOrFail($id);
        $toko_detail = toko_detail::where('toko_id',$id)->get();
        $area = area::all();
        return view('admin_kas.toko.toko_detail', ['toko' => $toko, 'toko_details' => $toko_detail, 'areas' => $area]);
    }

    public function detailShow($id)
    {
        $toko_detail = toko_detail::find($id);
        return response()->json(['toko_details' => $toko_detail], 200);
    }

    public function detailTambah(Request $request)
    {
        $request->validate([
            'area_id' => 'required',
        ]);

        toko_detail::create([
            'toko_id' => $request->toko_id,
            'area_id' => $request->area_id
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Toko Detail Created!']);
    }

    public function detailUpdate(Request $request, $id)
    {
        $toko_detail = toko_detail::findOrFail($id);
        $request->validate([
            'area_id' => 'required'
        ]);

        $toko_detail->area_id = $request->area_id;
        $toko_detail->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Toko Detail Updated!']);
    }

    public function detailHapus($id)
    {
        $toko_detail = toko_detail::findOrFail($id);
        $toko_detail->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Toko Detail Deleted!']);
    }
}
