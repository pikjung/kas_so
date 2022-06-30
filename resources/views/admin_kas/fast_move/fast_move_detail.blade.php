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
                Fast Move Detail
                <div class="float-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahFastMoveDetail">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <th>Nama Produk</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($fastMoveDetails as $fastMoveDetail)
                            <tr>
                                <td>{{$fastMoveDetail->nama_fast_move_detail}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick='detailFastMoveDetail("{{$fastMoveDetail->id}}")'>
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" onclick='editFastMoveDetail("{{$fastMoveDetail->id}}")'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick='hapusFastMoveDetail("{{$fastMoveDetail->id}}")'>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="modalTambahFastMoveDetail" tabindex="-1" role="dialog" aria-labelledby="modalTambahFastMoveDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahFastMoveDetailLabel">Tambah Fast Move</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/fast_move_detail/tambah" method="POST" id="formFastMoveDetailTambah">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="hidden" name="fast_move_id" value="{{ $fastMove->id }}">
                        <input type="text" class="form-control" id="nama_fast_move_detail" name="nama_fast_move_detail">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formFastMoveDetailTambah">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="modalFastMoveDetailEdit" tabindex="-1" role="dialog" aria-labelledby="modalFastMoveDetailEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFastMoveDetailEditLabel">Edit Fast Move</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formFastMoveDetailEdit">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nama Fast Move</label>
                        <input type="text" class="form-control" id="nama_fast_move_detail_edit" name="nama_fast_move_detail">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formFastMoveDetailEdit">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Skema -->
    <div class="modal fade" id="modalSkema" tabindex="-1" role="dialog" aria-labelledby="modalSkemaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSkemaLabel">Skema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Nama Skema</th>
                    </thead>
                    <tbody id="bodyModal">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-info active" id="buttonSkema">Lihat Skema <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var sesi = '{{Session::get('success')}}';
            if (sesi) {
                var pesan = '{{Session::get('message')}}';
                swal(pesan);
            } 
        })
        
        function hapusFastMoveDetail(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/fast_move_detail/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }

        function editFastMoveDetail(id) {
            $('#nama_fast_move_detail_edit').val('');
            $('#formFastMoveDetailEdit').removeAttr('action');
            $('#formFastMoveDetailEdit').attr('action','/admin_kas/fast_move_detail/edit/'+id);
            $.get('/admin_kas/fast_move_detail/show/'+id, function(data, index){
                $('#nama_fast_move_detail_edit').val(data.fastMoveDetail.nama_fast_move_detail);
                $('#modalFastMoveDetailEdit').modal('show');
            })
        }


        function detailFastMoveDetail(id) {
            $('#buttonSkema').removeAttr('href');
            $('#bodyModal').html('');
            $.get('/admin_kas/fast_move_detail/skema/'+id, function(data, index){
                $.each(data, function(val, item){
                    $('#bodyModal').append('<tr><td>'+item.nama_skema+'</td></tr>')
                })
                $('#buttonSkema').attr('href','/admin_kas/skema/'+id);
                $('#modalSkema').modal('show');
            })
        }
    </script>
@endsection