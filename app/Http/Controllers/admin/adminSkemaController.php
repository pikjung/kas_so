<?php

namespace App\Http\Controllers\admin;

use App\Models\skema;
use App\Models\fast_move;
use App\Models\skema_detail;
use Illuminate\Http\Request;
use App\Models\fast_move_detail;
use App\Http\Controllers\Controller;

class adminSkemaController extends Controller
{
    //

    public function index($id)
    {
        $skema = skema::where('fast_move_detail_id', $id)->get();
        $fastMoveDetail = fast_move_detail::findOrFail($id);
        return view('admin_kas.fast_move.skema', ['skemas' => $skema, 'fastMoveDetail' => $fastMoveDetail]);
    }

    public function show($id)
    {
        $skema = skema::findOrFail($id);
        return response()->json(['skemas' => $skema], 200);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'fast_move_detail_id' => 'required',
            'nama_skema' => 'required',
            'detail.*'
        ]);

        $skema = skema::create([
            'fast_move_detail_id' => $request->fast_move_detail_id,
            'nama_skema'=> $request->nama_skema
        ]);

        for ($i=0; $i < count($request->detail); $i++) { 
            skema_detail::create([
                'skema_id' => $skema->id,
                'detail' => $request->detail[$i],
            ]);
        }
        
        return redirect()->back()->with(['success' => true, 'message' => 'Skema and Detail have been created successfully']);
    }

    public function update(Request $request, $id)
    {
        $skema = skema::findOrFail($id);
        $request->validate([
            'nama_skema' => 'required',
            'detail.*' => 'required'
        ]);

        $skema->nama_skema = $request->nama_skema;

        for ($i=0; $i < $request->detail; $i++) { 
            $skema_detail = skema_detail::find($request->skema_detail_id[$i]);
            $skema_detail->detail = $request->detail[$i];
            $skema_detail->save();
        }

        $skema->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Skema and Detail Updated Successfully']);
    }

    public function hapus($id) 
    {
        $skema = skema::findOrFail($id);
        $detail_skema = skema_detail::where('skema_id', $id)->get();
        foreach ($detail_skema as $item) {
            $skema_detail = skema_detail::find($item->id);
            $skema_detail->delete();
        }

        $skema->delete();
        return redirect()->back()->with(['success' => true, 'message' => 'Skema and Detail deleted successfully']);
    }

    public function tambahDetail(Request $request,$id)
    {
        $request->validate([
            'detail.*' => 'required'
        ]);

        for ($i=0; $i < count($request->detail); $i++) { 
            skema_detail::create([
                'skema_id' => $id,
                'detail' => $request->detail[$i],
            ]);
        }

        return redirect()->back()->with(['success' => true, 'message' => 'Detail created successfully']);
    }

    public function hapusDetail($id)
    {
        $skema_detail = skema_detail::findOrFail($id);
        $skema_detail->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Detail deleted successfully']);
    }
}
