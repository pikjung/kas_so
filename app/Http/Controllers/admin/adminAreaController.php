<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\area;
use App\Models\project;

class adminAreaController extends Controller
{
    public function index()
    {
        $area = area::orderBy('created_at', 'asc')->get();
        $project = project::all();
        return view('admin_kas.area.area', ['areas' => $area, 'projects' => $project]);
    }

    public function show($id)
    {
        $area = area::find($id);
        return response()->json(['areas' => $area]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'nama_area' => 'required',
        ]);

        area::create([
            'project_id' => $request->project_id,
            'nama_area' => $request->nama_area,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Area berhasil di tambah']);
    }

    public function update(Request $request, $id)
    {
        $area = area::findOrFail($id);

        $request->validate([
            'project_id' => 'required',
            'nama_area' => 'required',
        ]);

        $area->project_id = $request->project_id;
        $area->nama_area = $request->nama_area;
        $area->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Area berhasil di update!']);
    }

    public function hapus($id)
    {
        $area = area::findOrFail($id);
        $area->delete();
        return redirect()->back()->with(['success' => true, 'message' => 'Area dihapus!']);
    }

}
