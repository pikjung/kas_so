@extends('admin_kas.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                Skema Table
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalSkemaTambah">
                    Tambah Skema
                </button>
            </div>
            <div class="card-body">
                @foreach ($skemas as $skema)
                    <div class="card shadow mb-2">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-8">
                                    {{ $skema->nama_skema }}
                                </div>
                                <div class="col-4">
                                    <div class="float-right">
                                        <button class="btn btn-danger btn-sm" onclick='hapusSkema("{{ $skema->id }}")'>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm" onclick='editSkema("{{ $skema->id }}")'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-info btn-sm"
                                            onclick='tambahDetailSkema("{{ $skema->id }}")'>
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($skema->skema_detail as $skema_detail)
                                <div class="badge badge-secondary">
                                    <span>{{ $skema_detail->detail }}</span>
                                    <a onclick='hapusSkemaDetail("{{ $skema_detail->id }}")'><i class="fa fa-times"></i></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Skema Tambah -->
    <div class="modal fade" id="modalSkemaTambah" tabindex="-1" role="dialog" aria-labelledby="modalSkemaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSkemaLabel">Tambah Skema</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin_kas/skema/tambah" id="formSkemaTambah" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Nama Skema</label>
                            <input type="text" class="form-control" name="nama_skema">
                            <input type="hidden" name="fast_move_detail_id" value="{{ $fastMoveDetail->id }}">
                            <input type="hidden" id="number_skema" value="1">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="buttonTambahSkemaDetail" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="row" id="skemaDetailBody">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="formSkemaTambah">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Skema Edit -->
    <div class="modal fade" id="modalSkemaEdit" tabindex="-1" role="dialog" aria-labelledby="modalSkemaEditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSkemaEditLabel">Edit Skema</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formSkemaEdit" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Nama Skema</label>
                            <input type="text" class="form-control" name="nama_skema" id="nama_skema_edit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="formSkemaEdit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Skema Detail -->
    <div class="modal fade" id="modalSkemaDetail" tabindex="-1" role="dialog" aria-labelledby="modalSkemaDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSkemaDetailLabel">Detail Skema Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formSkemaDetail" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Detail</label>
                            <input type="text" class="form-control" name="detail[]">
                            <input type="hidden" name="skema_id" id="skema_id_detail" >
                            <input type="hidden" id="number_skema_detail" value="1">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="buttonSkemaDetail" type="button">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="row" id="skemaDetailBodyDetail">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="formSkemaDetail">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var sesi = '{{ Session::get('success') }}';
            if (sesi) {
                var pesan = '{{ Session::get('message') }}';
                swal(pesan);
            }

            $('#buttonTambahSkemaDetail').click(function() {
                var number_skema = parseInt($('#number_skema').val());
                $('#skemaDetailBody').append('<div class="col-5" id="colSkema' + number_skema + '">' +
                    '<div class="form-group">' +
                    '<label>Detail Skema</label>' +
                    '<input class="form-control" type="text" name="detail[]" id="detail_skema' +
                    number_skema + '">' +
                    '</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-1" id="colSkemaButton' + number_skema + '">' +
                    '<div class="form-group">' +
                    '<br>' +
                    '<button class="btn btn-danger" onclick=hapusSkemaDetailTambah("' + number_skema +
                    '") type="button">' +
                    '<i class="fa fa-times"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>')
                number_skema += 1;
                $('#number_skema').val(number_skema)
            })

            $('#buttonSkemaDetail').click(function() {
                var number_skema_detail = parseInt($('#number_skema_detail').val());
                $('#skemaDetailBodyDetail').append('<div class="col-5" id="colSkema' + number_skema_detail + '">' +
                    '<div class="form-group">' +
                    '<label>Detail Skema</label>' +
                    '<input class="form-control" type="text" name="detail[]" id="detail_skema' +
                    number_skema_detail + '">' +
                    '</label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-1" id="colSkemaButton' + number_skema_detail + '">' +
                    '<div class="form-group">' +
                    '<br>' +
                    '<button class="btn btn-danger" onclick=hapusSkemaDetailDetail("' + number_skema_detail +
                    '") type="button">' +
                    '<i class="fa fa-times"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>')
                number_skema_detail += 1;
                $('#number_skema_detail').val(number_skema_detail)
            })
        })

        function hapusSkemaDetailDetail(number_skema) {
            $('#colSkema' + number_skema).remove()
            $('#colSkemaButton' + number_skema).remove()
        }

        function hapusSkemaDetailTambah(number_skema) {
            $('#colSkema' + number_skema).remove()
            $('#colSkemaButton' + number_skema).remove()
        }

        function editSkema(id) {
            $('#nama_skema_edit').val('')
            $('#formSkemaEdit').removeAttr('action');
            $('#formSkemaEdit').attr('action','/admin_kas/skema/edit/'+ id);
            $.get('/admin_kas/skema/show/' + id, function(data, index) {
                $('#nama_skema_edit').val(data.skemas.nama_skema);
                $('#modalSkemaEdit').modal('show')
            })
        }

        function hapusSkema(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/skema/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }

        function hapusSkemaDetail(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/skema_detail/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }

        function tambahDetailSkema(id) {
            $('#formSkemaDetail').removeAttr('action');
            $('#formSkemaDetail').attr('action', '/admin_kas/skema_detail/tambah/'+id)
            $('#modalSkemaDetail').modal('show')
        }
    </script>
@endsection
