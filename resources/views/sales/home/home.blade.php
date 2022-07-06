@extends('sales.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">

        </div>
        <br>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h3 mb-0 text-gray-800">Halo Sales!</h1>
        </div>

        <div class="card shadow">
            <div class="card-header">
                Cari Toko
            </div>
            <div class="card-body">
                <div class="form-group">
                    <select name="" id="toko_cari" class="form-control">
                        <option value="">--Pilih Toko--</option>
                        @foreach ($toko_details as $toko_detail)
                            <option value="{{ $toko_detail->id }}">{{ $toko_detail->toko->nama_toko }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary float-right" type="button" id="button_cari_toko">
                        <i class="fa fa-shopping-chart"></i>
                        Buat Order
                    </button>
                </div>
            </div>
        </div>

        <div class="card shadow mt-4">
            <div class="card-header">
                Info
            </div>
            <div class="card-body">
                
            </div>
        </div>

    </div>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#toko_cari').select2();

            $('#button_cari_toko').click(function() {
                var toko_id = $('#toko_cari').val();
                if (toko_id.length == 0) {
                    Swal.fire({
                        title: 'Waring',
                        text: 'Pilih Toko dulu!',
                        showCloseButton: true,
                    });
                } else {
                    window.location.href = "/sales/order/toko/" + toko_id;
                }
            });
        });
    </script>
@endsection
