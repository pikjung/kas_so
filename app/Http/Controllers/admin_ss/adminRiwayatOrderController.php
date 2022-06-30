<?php

namespace App\Http\Controllers\admin_ss;

use App\Models\order;
use App\Models\order_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminRiwayatOrderController extends Controller
{
    //
    public function index()
    {
        $order = order::orderBy('tgl_order', 'desc')->where('status', 'dikonfirmasi')->get();
        return view('admin_ss.riwayat_order.riwayat_order', ['orders' => $order]);
    }

    public function show($id)
    {
        $order_details = order_detail::where('order_id',$id)->get();
        return response()->json(['order_details' => $order_details], 200);
    }
}
