<?php

namespace App\Http\Controllers\admin;

use App\Models\brand;
use App\Models\paket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminPaketController extends Controller
{
    //
    public function index()
    {
        $paket = paket::orderBy('created_at', 'desc')->get();
        $brand = brand::all();
        return view('admin_kas.paket.paket', ['pakets' => $paket, 'brands' => $brand]);
    }
    
    public function show($id)
    {
        $paket = paket::findOrFail($id);
        return response()->json(['paket' => $paket], 200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'nama_paket' => 'required',
            'deskripsi' => 'required',
        ]); 

        paket::create([
            'brand_id' => $request->brand_id,
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Paket Created Successfully']);
    }

    public function update(Request $request, $id)
    {
        $paket = paket::findOrFail($id);
        $request->validate([
            'brand_id' => 'required',
            'nama_paket' => 'required',
            'deskripsi' => 'required',
        ]);

        $paket->brand_id = $request->brand_id;
        $paket->nama_paket = $request->nama_paket;
        $paket->deskripsi = $request->deskripsi;
        $paket->save();

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Paket Updated Successfully'
        ]);
    }

    public function hapus($id)
    {
        $paket = paket::findOrFail($id);
        $paket->delete();

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Paket deleted successfully',
        ]);
    }

    public function changeStatus($id)
    {
        $paket = paket::findOrFail($id);

        if ($paket->aktif == 'ya') {
            $paket->aktif = 'tidak';
        } else {
            $paket->aktif = 'ya';
        }

        $paket->save();

        return response()->json(['success' => true], 200);
    }
}
