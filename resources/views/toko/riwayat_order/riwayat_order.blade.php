@extends('toko.app')

@section('content')

<div class="container-fluid">
    <div class="mt-5">

    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12 col-md-12 mt-5">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="card-title">
                        <b>Riwayat Order</b>
                    </div>
                    <div class="row">
                        @foreach ($orders as $order)
                        <div class="col-12 mb-2">
                            <div class="card rounded">
                                <div class="card-body">
                                    <div class="float-left">
                                        <div class="text-{{$order->brand->warna}}">{{$order->brand->nama_brand}}</div> No Order: {{$order->nama_order}} 
                                    </div>
                                    <div class="float-right">
                                        <i>{{$order->status}}</i> <br>
                                        <button class="btn btn-outline-info" onclick="detailOrder({{$order->id}})">Lihat Detail</button>
                                    </div> <br>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function detailOrder(id) {
        $.get('/dashboard/detailOrder/'+id, function (data, index) {
            var html = '<div class="row">';
            var y = ""
            $.each(data.order_details, function (val, item) {
                y = y + "<div class='col-12 mb-2'><div class='card shadow rounded'><div class='card-body'>Produk: "+item.nama_produk+"<br>QTY: "+item.qty+"</div></div></div>"
            })
            // console.log(y);
            html = html + y;
            html = html + "</div>";
            Swal.fire({
                title: 'Detail Order',
                html: html,
                showCloseButton: true,
            });
        })
    }
</script>

@endsection