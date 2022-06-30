<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mockupController extends Controller
{
    //

    public function login()
    {
        return view('login');
    }

    public function order()
    {
        return view('user.order.order');
    }

    public function orderFavorit($param)
    {
        return view('user.order.orderFavorit', ['param' => $param]);
    }

    public function orderPaket($param)
    {
        return view('user.order.orderPaket', ['param' => $param]);
    }

    public function orderLainnya($param)
    {
        return view('user.order.orderLainnya', ['param' => $param]);
    }
    
    public function orderDetail($param)
    {
        return view('user.order.orderDetail', ['param' => $param]);
    }

    public function dashboard()
    {
        return view('user.dashboard.dashboard');
    }

    public function troli()
    {
        return view('user.troli.troli');
    }
}
