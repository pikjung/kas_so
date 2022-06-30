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
                Fast Move
                <div class="float-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahFastMove">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <th>Brand</th>
                        <th>Nama Fast Move</th>
                        <th>Aktif</th>
                        {{-- <th>Preview</th> --}}
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($fastMoves as $fastMove)
                            <tr>
                                <td>{{$fastMove->brand->nama_brand}}</td>
                                <td>{{$fastMove->nama_fast_move}}</td>
                                <td>
                                    <input type="checkbox" name="status" onchange='change_status("{{$fastMove->id}}")' @if ($fastMove->aktif == 'ya') checked @endif>
                                </td>
                                {{-- <td>
                                    <a href="/admin_kas/fast_move/preview/{{$fastMove->id}}" class="btn btn-secondary btn-sm" >
                                        <i class="fa fa-window-maximize"></i>
                                    </a>
                                </td> --}}
                                <td>
                                    <button class="btn btn-info btn-sm" onclick='detailFastMove("{{$fastMove->id}}")'>
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" onclick='editFastMove("{{$fastMove->id}}")'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick='hapusFastMove("{{$fastMove->id}}")'>
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
    <div class="modal fade" id="modalTambahFastMove" tabindex="-1" role="dialog" aria-labelledby="modalTambahFastMoveLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahFastMoveLabel">Tambah Fast Move</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/fast_move/tambah" method="POST" id="formFastMoveTambah">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Brand</label>
                        <select name="brand_id" class="form-control" id="brand_id">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{$brand->nama_brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Fast Move</label>
                        <input type="text" class="form-control" id="nama_fast_move" name="nama_fast_move">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formFastMoveTambah">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="modalFastMoveEdit" tabindex="-1" role="dialog" aria-labelledby="modalFastMoveEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFastMoveEditLabel">Edit Fast Move</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formFastMoveEdit">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Brand</label>
                        <select name="brand_id" class="form-control" id="brand_id_edit">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{$brand->nama_brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Fast Move</label>
                        <input type="text" class="form-control" id="nama_fast_move_edit" name="nama_fast_move">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formFastMoveEdit">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Detail Produk -->
    <div class="modal fade" id="modalFastMoveDetail" tabindex="-1" role="dialog" aria-labelledby="modalFastMoveDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFastMoveDetailLabel">Detail Fast Move</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Nama Produk</th>
                    </thead>
                    <tbody id="bodyModal">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-info active" id="buttonDetail">Detail <i class="fa fa-arrow-right"></i></a>
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
        
        function hapusFastMove(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/fast_move/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }

        function editFastMove(id) {
            $('#brand_id_edit').val('');
            $('#nama_fast_move_edit').val('');
            $('#formFastMoveEdit').removeAttr('action');
            $('#formFastMoveEdit').attr('action','/admin_kas/fast_move/edit/'+id);
            $.get('/admin_kas/fast_move/'+id, function(data, index){
                $('#brand_id_edit').val(data.fastMoves.brand_id);
                $('#nama_fast_move_edit').val(data.fastMoves.nama_fast_move);
                $('#modalFastMoveEdit').modal('show');
            })
        }

        function change_status(id) {
            $.get('/admin_kas/fast_move/status/'+id, function(data, index){
                swal({
                title: "Status Changed",
                text: data.message,
                icon: "success",
                });
            })
        }

        function detailFastMove(id) {
            $('#buttonDetail').removeAttr('href');
            $('#bodyModal').html('');
            $.get('/admin_kas/fast_move/detail/'+id, function(data, index){
                $.each(data, function(val, item){
                    $('#bodyModal').append('<tr><td>'+item.nama_fast_move_detail+'</td></tr>')
                })
                $('#buttonDetail').attr('href','/admin_kas/fast_move_detail/'+id);
                $('#modalFastMoveDetail').modal('show');
            })
        }
    </script>
@endsection