<?php

namespace App\Http\Controllers\sales;

use App\Models\toko;
use App\Models\User;
use App\Models\sales;
use App\Models\toko_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class salesDashboardController extends Controller
{
    //
    public function index()
    {
        $user = User::find(Auth::id());
        $sales = sales::where('user_id',$user->id)->first();
        $toko_detail = toko_detail::where('area_id',$sales->area_id)->get();
        return view('sales.home.home', ['toko_details' => $toko_detail]);
    }
}
