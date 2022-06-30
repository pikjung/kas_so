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
                            @foreach ($fastMoves as $fastMove)
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                                    <div class="card rounded">
                                        <div class="card-body">
                                            <div class="float-left">
                                                <b>{{ $fastMove->nama_fast_move }}</b> <br>
                                                @foreach ($fastMove->fast_move_detail as $item)
                                                    {{ $item->nama_fast_move_detail }},
                                                @endforeach
                                            </div>
                                            <div class="float-right">
                                                <button class="btn btn-outline-info"
                                                    onclick='pilihFastMove("{{ $fastMove->id }}")'>
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

        <!-- Modal Detail Favorit -->
        <div class="modal fade" id="modalFavoritDetail" tabindex="-1" role="dialog"
            aria-labelledby="modalFavoritDetailLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFavoritDetailLabel">Pilih Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="pilihBody">

                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        function pilihFastMove(id) {
            $('#pilihBody').html('');
            var btn = '';
            $.get('/order/favorit/pilihFastMove/' + id, function(data, index) {
                $.each(data.fastMoveDetail, function(key, val) {
                    btn = btn + '<a class="btn btn-primary" href="/order/favorit/detail/' + val.id +
                        '">' + val.nama_fast_move_detail + '</a> ';
                })
                Swal.fire({
                    icon: 'info',
                    title: 'Pilih Produk',
                    html: btn,
                    // footer: '<a href="">Why do I have this issue?</a>',
                    showCloseButton: true,
                    showConfirmButton: false
                })

            })
        }
    </script>
@endsection
