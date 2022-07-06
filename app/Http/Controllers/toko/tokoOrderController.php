<?php

namespace App\Http\Controllers\toko;

use App\Models\brand;
use App\Models\paket;
use App\Models\troli;
use App\Models\produk;
use App\Models\fast_move;
use Illuminate\Http\Request;
use App\Models\fast_move_detail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class tokoOrderController extends Controller
{
    //

    public function index()
    {
        $brand = brand::all();
        return view('toko.order.order', ['brands' => $brand]);
    }
    
    public function brand($id,$type)
    {
        $brand = brand::find($id);
        if ($type == 'favorit') {
            $fastMove = fast_move::where('brand_id', $id)->get();
            $orderType = 'orderFavorit';
            return view('toko.order.'.$orderType, ['fastMoves' => $fastMove, 'brand' => $brand, 'brand_id' => $id, 'type' => $type]);
        } else if ($type == 'paket') {
            $paket = paket::orderBy('created_at','desc')->get();
            $orderType = 'orderPaket';
            return view('toko.order.'.$orderType, ['pakets' => $paket,'brand' => $brand, 'brand_id' => $id, 'type' => $type]);
        } else if ($type == 'lainnya') {
            $orderType = 'orderLainnya';
            $produk = produk::where('brand_id',$id)->get();
            return view('toko.order.'.$orderType, ['produks' => $produk, 'brand' => $brand, 'brand_id' => $id, 'type' => $type]);
        } else {
            return redirect('/order');
        }
    }

    public function troliLainnya(Request $request)
    {
        $type = 'lainnya';
        $request->validate([
            'produk_id' => 'required',
            'qty' => 'required',
        ]);

        $produk = produk::find($request->produk_id);
        $user_id = User::find(Auth::id());

        troli::create([
            'ordered_by' => 'toko',
            'user_id' => Auth::id(),
            'brand_id' => $produk->brand_id,
            'reference_id' => $produk->id,
            'type' => $type,
            'nama_produk' => $produk->nama_produk,
            'qty' => $request->qty,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Produk masuk ke troli!']);
    }
    
    public function troliFavorit(Request $request)
    {
        $type = 'favorit';
        $request->validate([
            'fast_move_id' => 'required',
            'qty' => 'required',
            'brand_id' => 'required',
            'produk' => 'required',
        ]);
    
        $produk = produk::find($request->produk_id);
        $user_id = User::find(Auth::id());
    
        troli::create([
            'ordered_by' => 'toko',
            'user_id' => Auth::id(),
            'brand_id' => $request->brand_id,
            'reference_id' => $request->fast_move_id,
            'type' => $type,
            'nama_produk' => $request->produk,
            'qty' => $request->qty,
        ]);
    
        return redirect()->back()->with(['success' => true, 'message' => 'Produk masuk ke troli!']);
    }

    public function troliPaket(Request $request)
    {
        $type = 'paket';
        $request->validate([
            'id' => 'required',
            'qty' => 'required',
        ]);

        $paket = paket::find($request->id);
    
        troli::create([
            'ordered_by' => 'toko',
            'user_id' => Auth::id(),
            'brand_id' => $paket->brand_id,
            'reference_id' => $paket->id,
            'type' => $type,
            'nama_produk' => $paket->nama_paket . " // " . $paket->deskripsi,
            'qty' => $request->qty,
        ]);
    
        return redirect()->back()->with(['success' => true, 'message' => 'Produk masuk ke troli!']);
    }

    public function favoritDetail($id)
    {
        $fastMoveDetail = fast_move_detail::find($id);
        $fastMove = fast_move::find($fastMoveDetail->fast_move_id);
        return view('toko.order.favorit_detail', ['fastMoveDetail' => $fastMoveDetail, 'fastMove' => $fastMove]);
    }

    public function pilihFastMove($id)
    {
        $fastMoveDetail = fast_move_detail::where('fast_move_id', $id)->get();
        return response()->json(['fastMoveDetail' => $fastMoveDetail], 200);
    }
    
}
