<?php

namespace App\Http\Controllers\toko;

use App\Models\toko;
use App\Models\brand;
use App\Models\order;
use App\Models\troli;
use App\Models\region;
use App\Models\order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class tokoTroliController extends Controller
{
    //
    public function index()
    {
        $troli = troli::where('user_id', Auth::id())->get();
        return view('toko.troli.troli', ['trolis' => $troli]);
    }

    public function hapus($id)
    {
        $troli = troli::find($id);
        $troli->delete();
        return redirect()->back()->with(['success' => true, 'message' => 'Troli has been deleted.']);
    }

    public function checkout($id)
    {
        $toko = toko::where('user_id',$id)->first();
        $region = region::find($toko->region_id);
        $brandTroli = DB::table('trolis')
                    ->where('user_id', $id)
                    ->select('brand_id')
                    ->groupBy('brand_id')
                    ->get();
        if (empty($brandTroli->count())) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Troli Anda Kosong']);
        }
        $pesan = "Halo admin\nAda Pesanan dengan detail sebagai berikut:\n";
        $pesan = $pesan . $toko->nama_toko . "-" .$region->nama_region . "\nKode Toko: ".$toko->kode_toko."\n------------\n";
        foreach ($brandTroli as $item) {
            $brand = brand::find($item->brand_id);
            $checkOrder = order::where('brand_id', $item->brand_id)->get();
            $orderCount = $checkOrder->count() + 1;
            $nama_order = $brand->singkatan . "-" . date('Ym') ."-". $orderCount;
            $order = order::create([
                'brand_id' => $item->brand_id,
                'user_id' => $id,
                'nama_order' => $nama_order,
                'tgl_order' => date('Y-m-d H:i:s'),
                'status' => 'progress',
            ]);

            $pesan = $pesan . "Brand:" . $brand->nama_brand ."\n";
            $pesan = $pesan . "Nama Order:" . $nama_order ."\n";
            
            $trolis = troli::where('user_id',$id)->where('brand_id',$item->brand_id)->get();
            foreach ($trolis as $troli) {
                order_detail::create([
                    'order_id' => $order->id,
                    'type' => $troli->type,
                    'nama_produk' => $troli->nama_produk,
                    'qty' => $troli->qty,
                    'check' => 'tidak',
                ]);
                $pesan = $pesan . "- ". $troli->nama_produk . " | QTY: <b>".$troli->qty."</b>\n";
                $troli_delete = troli::find($troli->id);
                $troli_delete->delete();
            }

            $pesan = $pesan . "-------\n";
        }

        //telegram
        $apiToken = "5490810911:AAHFeGeW5iPlphzHZYORFZSRe1GYuqssoM8";
        $data = [
            'chat_id' => '-795300356',
            'text' => $pesan,
            'parse_mode' => 'HTML',
        ];

        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .http_build_query($data) );

        return redirect()->back()->with(['status' => 'success', 'message' => 'Order di proses']);
    }
}