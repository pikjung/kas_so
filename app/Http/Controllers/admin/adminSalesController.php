<?php

namespace App\Http\Controllers\admin;

use App\Models\sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminSalesController extends Controller
{
    //
    public function index()
    {
        $sales = sales::orderBy('created_at', 'desc')->get();
        return view('admin_kas.sales.sales', ['sales' => $sales]);
    }

    public function show($id)
    {
        $sales = sales::findOrFail($id);
        return response()->json(['sales' => $sales], 200);
    }
}
