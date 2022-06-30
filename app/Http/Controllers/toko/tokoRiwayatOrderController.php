<?php

namespace App\Http\Controllers\toko;

use App\Models\order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class tokoRiwayatOrderController extends Controller
{
    //

    public function index()
    {
        $order = order::where('user_id', Auth::id())->where('status','dikonfirmasi')->get();
        return view('toko.riwayat_order.riwayat_order', ['orders' => $order]);
    }
}
