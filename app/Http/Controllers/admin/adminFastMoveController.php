<?php

namespace App\Http\Controllers\admin;

use App\Models\brand;
use App\Models\fast_move;
use Illuminate\Http\Request;
use App\Models\fast_move_detail;
use App\Http\Controllers\Controller;

class adminFastMoveController extends Controller
{
    //
    public function index()
    {
        $brand = brand::all();
        $fastMove = fast_move::orderBy('created_at','DESC')->get();
        return view('admin_kas.fast_move.fast_move', ['fastMoves' => $fastMove, 'brands' => $brand]);
    }

    public function show($id)
    {
        $fastMove = fast_move::findOrFail($id);
        return response()->json(['fastMoves' => $fastMove], 200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'nama_fast_move' => 'required',
        ]);

        fast_move::create([
            'brand_id' => $request->brand_id,
            'nama_fast_move' => $request->nama_fast_move,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Fast Move Berhasil di input']);
    }

    public function update(Request $request, $id)
    {
        $fastMove = fast_move::findOrFail($id);
        $request->validate([
            'brand_id' => 'required',
            'nama_fast_move' => 'required',
        ]);

        $fastMove->brand_id = $request->brand_id;
        $fastMove->nama_fast_move = $request->nama_fast_move;
        $fastMove->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Fast Move Updated!']);
    }

    public function hapus($id)
    {
        $fastMove = fast_move::findOrFail($id);
        $fastMove->delete();
        return redirect()->back()->with(['success' => true, 'message' => 'Fast Move Deleted!']);
    }

    public function changeStatus($id)
    {
        $fastMove = fast_move::findOrFail($id);

        if ($fastMove->aktif == 'ya') {
            $fastMove->aktif = 'tidak';
        } else {
            $fastMove->aktif = 'ya';
        }

        $fastMove->save();

        return response()->json(['success' => true], 200);
    }

    public function detail($id)
    {
        $fastMove = fast_move_detail::where('fast_move_id',$id)->get();
        return response()->json($fastMove, 200);
    }
}
