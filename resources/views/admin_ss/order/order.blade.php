@extends('admin_ss.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">

        </div>
        <div class="card">
            <div class="card-header">
                Order
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped"">
                        <thead>
                            <th>No Order</th>
                            <th>Toko</th>
                            <th>Tgl Order</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </thead>
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
                            <th>Aksi</th>
                        </thead>
                        <tbody id="bodyDetail">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="button_konfirm" class="btn btn-primary text-white">
                        <i class="fa fa-arrow-right"></i> Konfirmasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#modalOrderDetail').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });

            $(document).ready(function() {
                var sesi = '{{ Session::get('success') }}';
                if (sesi) {
                    var pesan = '{{ Session::get('message') }}';
                    swal(pesan);
                }
            })
        })

        function detailOrder(id) {
            $('#bodyDetail').html('');
            $('#button_konfirm').removeAttr('href');
            $.get('/admin_ss/order/' + id, function(data, index) {
                // console.log(data)
                $.each(data.order_details, function(item, value) {
                    if (value.check == 'ya') {
                        var checked = 'checked';
                        var disabled = 'disabled';
                    } else {
                        var checked = '';
                        var disabled = '';
                    }
                    $('#bodyDetail').append(`
                        <tr>
                            <td>${value.nama_produk}</td>
                            <td id="qty${value.id}">${value.qty}</td>
                            <td><input type="checkBox" id="checkBox${value.id}" ${checked} onchange="checkDetail(${value.id})"></td>
                            <td id="remark${value.id}">${value.remark}</td>
                            <td>
                                <button class="btn btn-info btn-sm" id="btn${value.id}" onclick="remarkDetail(${value.id})" ${disabled}>
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        <tr>
                    `);
                })
                $('#button_konfirm').attr('href', '/admin_ss/order/confirm/' + id);
                $('#modalOrderDetail').modal('show');
            });
        }

        function checkDetail(id) {
            $.get('/admin_ss/order/check/' + id, function(data, index) {
                swal("Good job!", data.message, "success");
                if (data.checked == true) {
                    $('#checkBox' + id).attr('checked', '');
                    $('#btn' + id).attr('disabled', '');
                } else {
                    $('#checkBox' + id).removeAttr('checked');
                    $('#btn' + id).removeAttr('disabled');
                }
            });

        }

        function remarkDetail(id) {
            var remark = $('#remark' + id).html();
            var qty = $('#qty' + id).html();
            var form = document.createElement('div');
            form.className = "form-group"
            form.innerHTML = `<label>Remark</label><input id="remark_alrt`+id+`" class="form-control" value="`+remark+`"/><br><label>QTY</label><input id="qty_alrt`+id+`" class="form-control" value="`+qty+`"/>`
            swal("Change:", {
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                    closeOnClickOutside: false,
                    content: form,
                })
                .then(value => {
                    if (value) {
                        var remark_change = $('#remark_alrt'+id).val();
                        var qty_change = $('#qty_alrt'+id).val();
                        $.ajax({
                            type: "POST",
                            url: '/admin_ss/order/remark',
                            data: {
                                id: id,
                                remark: remark_change,
                                qty: qty_change,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                $('#remark' + id).html('')
                                $('#remark' + id).html(remark_change)
                                $('#qty' + id).html('')
                                $('#qty' + id).html(qty_change)
                            },
                            error: function(error) {
                                swal("Error!", error.responseJSON.message, "error");
                            }
                        });
                        console.log(value)
                    } else {
                        swal.close();
                    }
                });
        }
    </script>
@endsection
