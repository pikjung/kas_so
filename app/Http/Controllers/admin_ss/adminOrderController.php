<?php

namespace App\Http\Controllers\admin_ss;

use App\Models\order;
use App\Models\order_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class adminOrderController extends Controller
{
    //
    public function index()
    {
        $order = order::where('status', 'progress')->get();
        return view('admin_ss.order.order' , [
            'orders' => $order
        ]);
    }

    public function show($id)
    {
        $order_detail = order_detail::where('order_id', $id)->get();
        return response()->json(['order_details' => $order_detail], 200);
    }

    public function check($id)
    {
        $order_detail = order_detail::find($id);
        if ($order_detail->check == 'tidak') {
            $order_detail->check = 'ya';
            $order_detail->checked_by = Auth::id();
            $order_detail->save();
            return response()->json(['checked' => true, 'message' => 'Order checked'], 200);
        } else {
            $order_detail->checked_by = 0;
            $order_detail->check = 'tidak';
            $order_detail->save();
            return response()->json(['checked' => false, 'message' => 'Order unChecked '], 200);
        }

    }

    public function confirm($id)
    {
        $order = order::findOrFail($id);
        $order->status = 'dikonfirmasi';
        $order->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Order confirmed']);
    }

    public function remark(Request $request)
    {
        $request->validate([
            'remark' => 'required',
            'qty' => 'required',
        ]);

        $order_detail = order_detail::findOrFail($request->id);
        $order_detail->remark = $request->remark;
        $order_detail->qty = $request->qty;
        $order_detail->save();

        return response()->json(['success' => true, 'message' => 'Remark successfully saved'], 200);
    }
}
