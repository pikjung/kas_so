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
                            Nama Produk: <b>{{ $troli->nama_produk }}</b>
                        </div>
                        <div class="col-12">
                            QTY: <b>{{ $troli->qty }}</b>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-danger float-right" onclick='hapusTroli("{{ $troli->id }}")'>
                                <i class="fa fa-trash"></i>
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
