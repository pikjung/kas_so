@extends('toko.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">
            <hr>
        </div>
        <!-- Page Heading -->
        <div class="mt-5 mb-4">
            <div class="row">
                <div class="col-6">
                    <h1 class="h3 mb-0 text-gray-800">Troli</h1>
                </div>
                <div class="col-6">
                    <button class="btn btn-success float-right" id="buttonCheckout">
                        <i class="fa fa-shopping-cart"></i> Checkout
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        @foreach ($trolis as $troli)
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>Brand: <b>{{ $troli->brand->nama_brand }}</b></h5>
                            <hr>
                        </div>
                        <div class="col-10" style="font-size: 12px">
                            <?php $no = 1 ?>
                            @foreach ($troli->brand->troli as $item)
                                {{ $no }}.  Nama Produk: <b>{{ $item->nama_produk }}</b> | QTY : <b>{{ $item->qty }}</b> <br>
                                <?php $no++ ?>
                            @endforeach
                        </div>
                        <div class="col-2">
                            <button class="btn btn-warning float-right" onclick='detailTroli("{{ $troli->brand_id }}")'>
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <script>
        $(document).ready(function() {
            var sesi = '{{Session::get('status')}}';
            if (sesi) {
                var pesan = '{{Session::get('message')}}';
                Swal.fire(pesan, '', sesi)
            } 
            $('#buttonCheckout').click(function () {
                var id = '{{Auth::id()}}';
                console.log(id);
                Swal.fire({
                    icon: 'info',
                    title: 'Lanjutkan Order?',
                    footer: 'Save Untuk menyimpan ke Troli',
                    showCloseButton: true,
                    showConfirmButton: true,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Order',
                    denyButtonText: `Batalkan`,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/troli/checkout/"+id;
                    } else if (result.isDenied) {
                        Swal.fire('Perubahan tidak disimpan', '', 'info')
                    }
                })
            })
        })


        function hapusTroli(id) {
            Swal.fire({
                    title: "Yakin ingin hapus?",
                    text: "Data yang dihapus tidak bisa di recovery!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "/troli/hapus/" + id;
                    } else {
                        swal("Gagal Hapus!");
                    }
                });
        }
    </script>
@endsection
