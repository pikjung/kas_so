<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\brand;
use App\Models\project;

class adminBrandController extends Controller
{
    //
    public function index()
    {
        $brand = brand::orderBy('nama_brand','asc')->get();
        $project = project::all();
        return view('admin_kas.brand.brand', ['brands' => $brand, 'projects' => $project]);
    }

    public function show($id)
    {
        $brand = brand::find($id);
        return response()->json(['brands' => $brand,'message' => 'success']);
    }

    public function create(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'nama_brand' => 'required',
            'singkatan' => 'required',
            'warna' => 'required',
            'photo' => 'required',
            'photo' => 'mimes:jpg,jpeg,png|max:2000',
        ]);

        $fileNamePhoto = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('uploads/brand/'), $fileNamePhoto);

        $brand = brand::create([
            'project_id' => $request->project_id,
            'nama_brand' => $request->nama_brand,
            'singkatan' => $request->singkatan,
            'warna' => $request->warna,
            'photo' => $fileNamePhoto
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Data berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $brand = brand::findOrFail($id);
        $request->validate([
            'project_id' => 'required',
            'nama_brand' => 'required',
            'singkatan' => 'required',
            'warna' => 'required',
        ]);

        if (!empty($request->photo)) {
            if (file_exists(public_path('/uploads/brand/'.$brand->photo))) {
                unlink(public_path('/uploads/brand/'.$brand->photo));
            } 
            
            $fileNamephoto = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads/brand/'), $fileNamephoto);
        } else {
            $fileNamephoto = $brand->photo;
        }

        $brand->project_id = $request->project_id;
        $brand->nama_brand = $request->nama_brand;
        $brand->singkatan = $request->singkatan;
        $brand->warna = $request->warna;
        $brand->photo = $fileNamephoto;
        $brand->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Data berhasil di update']);
    }

    public function hapus($id)
    {
        $brand = brand::findOrFail($id);
        if (file_exists(public_path('/uploads/brand/'.$brand->photo))) {
            unlink(public_path('/uploads/brand/'.$brand->photo));
        } 
        $brand->delete();
        return redirect()->back()->with(['success' => true, 'message' => 'Data berhasil di hapus']);
    }
}
