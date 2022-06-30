<?php

namespace App\Http\Controllers\toko;

use App\Models\brand;
use App\Models\order;
use App\Models\order_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class tokoDashboardController extends Controller
{
    //
    public function index()
    {
        $order = order::where('user_id',Auth::id())->where('status','progress')->get();
        $brands = brand::all();
        return view('toko.dashboard.dashboard', [
            'orders' => $order,
            'brands' => $brands
        ]);
    }

    public function detailOrder($id)
    {
        $order_detail = order_detail::where('order_id',$id)->get();
        return response()->json(['order_details' => $order_detail], 200);
    }
}
