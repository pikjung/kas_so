<?php

namespace App\Http\Controllers\admin;

use App\Models\skema;
use App\Models\fast_move;

use Illuminate\Http\Request;
use App\Models\fast_move_detail;
use App\Http\Controllers\Controller;

class adminFastMoveDetailController extends Controller
{
    //
    public function index($id)
    {
        $fastMove = fast_move::find($id);
        $fastMoveDetail = fast_move_detail::where('fast_move_id',$id)->get();

        return view('admin_kas.fast_move.fast_move_detail', ['fastMove' => $fastMove, 'fastMoveDetails' => $fastMoveDetail]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'fast_move_id' => 'required',
            'nama_fast_move_detail' => 'required',
        ]);

        fast_move_detail::create([
            'fast_move_id' => $request->fast_move_id,
            'nama_fast_move_detail' => $request->nama_fast_move_detail
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Fast Move Detail Created']);
    }

    public function update(Request $request, $id)
    {
        $fastMoveDetail = fast_move_detail::findOrFail($id);
        $request->validate([
            'nama_fast_move_detail' => 'required',
        ]);

        $fastMoveDetail->nama_fast_move_detail = $request->nama_fast_move_detail;
        $fastMoveDetail->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Fast Move Detail Updated']);
    }

    public function show($id)
    {
        $fastMoveDetail = fast_move_detail::findOrFail($id);
        return response()->json(['fastMoveDetail' => $fastMoveDetail], 200);
    }

    public function hapus($id)
    {
        $fastMoveDetail = fast_move_detail::findOrFail($id);
        $fastMoveDetail->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Fast Move Detail Deleted']);
    }

    public function skema($id)
    {
        $skema = skema::where('fast_move_detail_id', $id)->get();

        return response()->json($skema, 200);
    }
}
