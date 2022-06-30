@extends('admin_kas.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5"></div>

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
                Paket
                <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalTambahPaket">
                    Tambah Paket
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>
                                Brand
                            </th>
                            <th>
                                Nama Paket
                            </th>
                            <th>
                                Deskripsi
                            </th>
                            <th>
                                Aktif
                            </th>
                            <th>
                                Aksi
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($pakets as $paket)
                                <tr>
                                    <td>{{ $paket->brand->nama_brand }}</td>
                                    <td>{{ $paket->nama_paket }}</td>
                                    <td>{{ $paket->deskripsi }}</td>
                                    <td>
                                        <input type="checkbox" onchange='change_status("{{ $paket->id }}")'
                                            @if ($paket->aktif == 'ya') checked @endif>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick='editPaket("{{ $paket->id }}")'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick='hapusPaket("{{ $paket->id }}")'>
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
    </div>


    <!-- Modal Tambah Paket -->
    <div class="modal fade" id="modalTambahPaket" tabindex="-1" role="dialog" aria-labelledby="modalTambahPaketLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPaketLabel">Tambah Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin_kas/paket/tambah" method="post" id="formTambahPaket">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id}}">{{$brand->nama_brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Paket</label>
                            <input type="text" class="form-control" name="nama_paket" id="nama_paket">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="formTambahPaket">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Paket -->
    <div class="modal fade" id="modalEditPaket" tabindex="-1" role="dialog" aria-labelledby="modalEditPaketLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPaketLabel">Edit Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="formEditPaket">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Brand</label>
                            <select name="brand_id" id="brand_id_edit" class="form-control">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id}}">{{$brand->nama_brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Paket</label>
                            <input type="text" class="form-control" name="nama_paket" id="nama_paket_edit">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi_edit" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="formEditPaket">Simpan</button>
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

        function editPaket(id) {
            $('#nama_paket_edit').val('');
            $('#deskripsi_edit').html('');
            $('#formEditPaket').removeAttr('action');
            $('#formEditPaket').attr('action','/admin_kas/paket/edit/'+id);
            $.get('/admin_kas/paket/'+id, function (data, index) {
                $('#nama_paket_edit').val(data.paket.nama_paket);
                $('#deskripsi_edit').html(data.paket.deskripsi);
                $('#brand_id_edit').val(data.paket.brand_id);
                $('#modalEditPaket').modal('show')
            });
        }

        function hapusPaket(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/paket/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }

        function change_status(id) {
            $.get('/admin_kas/paket/status/'+id, function(data, index){
                swal({
                title: "Status Changed",
                text: data.message,
                icon: "success",
                });
            })
        }


    </script>
@endsection
