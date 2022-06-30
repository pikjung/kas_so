@extends('admin_ss.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">

        </div>

        <div class="card mt-5">
            <div class="card-header">
                Riwayat Order
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <th>No Order</th>
                            <th>Toko</th>
                            <th>Tgl Order</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Detail</th>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->nama_order }}</td>
                                    <td>{{ $order->user->toko->nama_toko }}</td>
                                    <td>{{ $order->tgl_order }}</td>
                                    <td>{{ $order->note }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <button class="btn btn-info" onclick="detailOrder({{ $order->id }})">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Order -->
    <div class="modal fade" id="modalOrderDetail" tabindex="-1" role="dialog" aria-labelledby="modalOrderDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalOrderDetailLabel">Order Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>Check</th>
                            <th>Remark</th>
                        </thead>
                        <tbody id="bodyDetail">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function detailOrder(id) {
            $.get('/admin_ss/riwayat_order/' + id, function(data, index) {
                $('#bodyDetail').html('')
                // console.log(data)
                $.each(data.order_details, function(item, value) {
                    if (value.check == 'ya') {
                        var checked = 'checked';
                    } else {
                        var checked = '';
                    }
                    $('#bodyDetail').append(`
                        <tr>
                            <td>${value.nama_produk}</td>
                            <td>${value.qty}</td>
                            <td><input type="checkBox" id="checkBox${value.id}" ${checked} readonly disabled/></td>
                            <td id="remark${value.id}">${value.remark}</td>
                        <tr>
                    `);
                })
                $('#button_konfirm').attr('href', '/admin_ss/order/confirm/' + id);
                $('#modalOrderDetail').modal('show');
            });
        }
    </script>
@endsection
