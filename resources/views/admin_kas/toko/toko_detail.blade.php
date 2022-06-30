@extends('admin_kas.app')

@section('content')
    <div class="mt-5">

    </div>


    <div class="container-fluid">
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
                Toko Detail
                <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalTambahTokoDetail">
                    Tambah
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <th>Area</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($toko_details as $toko_detail)
                            <tr>
                                <td>{{ $toko_detail->area->nama_area }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick='editTokoDetail("{{ $toko_detail->id }}")'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick='hapusTokoDetail("{{ $toko_detail->id }}")'>
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

    {{-- Modal Tambah Toko Detail --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTambahTokoDetail" aria-labelledby="modalTambahTokoDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Tambah Toko
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin_kas/toko_detail/tambah" method="post" id="formTambahTokoDetail">
                        {{ csrf_field() }}
                        <input type="hidden" name="toko_id" value="{{ $toko->id }}">
                        <div class="form-group">
                            <label for="">Area</label>
                            <select name="area_id" id="" class="form-control">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{$area->nama_area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" form="formTambahTokoDetail">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Toko Detail --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditTokoDetail" aria-labelledby="modalEditTokoDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Detail Toko Edit
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="formEditTokoDetail">
                        <input type="hidden" name="toko_id" value="{{ $toko->id }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Area</label>
                            <select name="area_id" id="area_id_edit" class="form-control">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{$area->nama_area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" form="formEditTokoDetail">Simpan</button>
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
        })

        function editTokoDetail(id) {
            $('#area_id_edit').val('');
            $('#formEditTokoDetail').removeAttr('action');
            $('#formEditTokoDetail').attr('action', '/admin_kas/toko_detail/edit/' + id);
            $.get('/admin_kas/toko_detail/show/' + id, function(data, index) {
                $('#area_id_edit').val(data.toko_details.area_id);
                $('#modalEditTokoDetail').modal('show')
            });
        }

        function hapusTokoDetail(id) {
            swal({
                    title: "Yakin ingin hapus?",
                    text: "Data yang dihapus tidak bisa di recovery!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "/admin_kas/toko_detail/hapus/" + id;
                    } else {
                        swal("Gagal Hapus!");
                    }
                });
        }

    </script>
@endsection
