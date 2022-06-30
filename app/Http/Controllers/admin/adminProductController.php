<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Illuminate\Http\Request;

use App\Models\produk;

class adminProductController extends Controller
{
    //
    public function index()
    {
        $produk = produk::orderBy('created_at','desc')->get();
        $brand = brand::all();
        return view('admin_kas.product.product', ['produks' => $produk, 'brands' => $brand]);
    }

    public function show($id)
    {
        $produk = produk::orderBy('created_at','desc')->get();
        return response()->json(['produks' => $produk, 'messages' => 'Get Product by ID'], 200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'nama_produk' => 'required',
            'kode_idem' => 'required',
            'deskripsi' => 'required',
        ]);

        produk::create([
            'brand_id' => $request->brand_id,
            'nama_produk' => $request->nama_produk,
            'kode_idem' => $request->kode_idem,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Product created']);
    }

    public function update(Request $request, $id)
    {
        $produk = produk::findOrFail($id);
        $request->validate([
            'brand_id' => 'required',
            'nama_produk' => 'required',
            'kode_idem' => 'required',
            'deskripsi' => 'required',
        ]);

        $produk->brand_id = $request->brand_id;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->kode_idem = $request->kode_idem;
        $produk->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Product Updated']);
    }

    public function hapus($id)
    {
        $produk = produk::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Product Deleted']);
    }

    public function status($id)
    {
        $produk = produk::findOrFail($id);
        if ($produk->aktif == 'ya') {
            $produk->aktif = 'tidak';
        } else {
            $produk->aktif = 'ya';
        }
        $produk->save();
        return redirect()->back()->with(['success' => true, 'message' => 'Product Status Updated']);
    }

    public function import(Request $request)    
    {
        
    }
}
