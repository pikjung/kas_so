<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\project;

class adminProjectController extends Controller
{
    //
    public function index()
    {
        $project = project::all();
        return view('admin_kas.project.project', ['projects' => $project]);
    }

    public function show($id)
    {
        $project = project::find($id);
        return response()->json(['projects' => $project],200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'nama_project' => 'required'
        ]);

        project::create([
            'nama_project' => $request->nama_project
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Project berhasil di tambah']);
    }

    public function update(Request $request, $id)
    {
        $project = project::findOrFail($id);
        $request->validate([
            'nama_project' => 'required'
        ]);

        $project->nama_project = $request->nama_project;
        $project->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Project berhasil di update']);
    }

    public function hapus($id)
    {
        $project = project::findOrFail($id);
        $project->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Project berhasil di hapus']);
    }
}
