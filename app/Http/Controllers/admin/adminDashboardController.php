<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminDashboardController extends Controller
{
    //
    public function index()
    {
        return view('admin_kas.dashboard.dashboard');
    }
}
