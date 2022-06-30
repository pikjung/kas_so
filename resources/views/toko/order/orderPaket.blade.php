@extends('toko.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">
            <hr>
        </div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-gray-800">Order <b>{{ $brand->nama_brand }}</b></h1>
        </div>

        <div class="row mt-5">
            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                <div class="card rounded shadow">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'favorit') active @endif"
                                    href="/order/{{ $brand_id }}/favorit">Favorit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'paket') active @endif"
                                    href="/order/{{ $brand_id }}/paket">Paket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'lainnya') active @endif"
                                    href="/order/{{ $brand_id }}/lainnya">Lainnya</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($pakets as $paket)
                            <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                                <div class="card rounded">
                                    <div class="card-body">
                                        <div class="float-left">
                                            <b>{{$paket->nama_paket}}</b> <br>
                                            {{$paket->deskripsi}}
                                        </div>
                                        <div class="float-right">
                                            <button type="button" class="btn btn-outline-info" onclick='orderPaket("{{$paket->id}}")'>
                                                Pilih
                                            </button>
                                        </div>
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
        function orderPaket(id) {
            var qty = '<input type="number" class="form-control" id="qty_paket" min="1">'
            Swal.fire({
                    icon: 'info',
                    title: 'Masukan Ke troli?',
                    html: qty,
                    footer: 'Save Untuk menyimpan ke Troli',
                    showCloseButton: true,
                    showConfirmButton: true,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var qty_final = $('#qty_paket').val();
                        $.ajax({
                            type: "POST",
                            url: '/order/troli/paket',
                            data: {
                                _token: "{{ csrf_token() }}",
                                qty: qty_final,
                                id: id,
                            },
                            success: function () {
                                Swal.fire('Masuk Ke troli!', '', 'success');
                                window.location.reload();
                            },
                            error: function () {
                                Swal.fire('Gagal Menyimpan', '', 'danger')
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Perubahan tidak disimpan', '', 'info')
                    }
                })
        }
    </script>
@endsection
