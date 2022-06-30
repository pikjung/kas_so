<?php

namespace App\Http\Controllers\admin;

use App\Models\region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminRegionController extends Controller
{
    //
    public function index()
    {
        $region = region::orderBy('created_at', 'desc')->get();
        return view('admin_kas.region.region', ['regions' => $region]);
    }

    public function show($id)
    {
        $region = region::find($id);
        return response()->json(['regions' => $region]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'nama_region' => 'required'
        ]);

        region::create([
            'nama_region' => $request->nama_region,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Region Created!']);
    }

    public function update(Request $request, $id)    
    {
        $region = region::findOrFail($id);
        $request->validate([
            'nama_region' => 'required'
        ]);

        $region->nama_region = $request->nama_region;
        $region->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Region updated!']);
    }

    public function hapus($id)
    {
        $region = region::findOrFail($id);
        $region->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Region deleted!']);
    }
}
