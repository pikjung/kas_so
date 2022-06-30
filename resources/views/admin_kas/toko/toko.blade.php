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
                Toko
                <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalTambahToko">
                    Tambah
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <th>Kode Toko</th>
                        <th>Nama Toko</th>
                        <th>Region</th>
                        <th>User</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($tokos as $toko)
                            <tr>
                                <td>{{ $toko->kode_toko }}</td>
                                <td>{{ $toko->nama_toko }}</td>
                                <td>{{ $toko->region->nama_region }}</td>
                                <td>{{ $toko->user->name }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick='detailToko("{{ $toko->id }}")'>
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick='editToko("{{ $toko->id }}")'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick='hapusToko("{{ $toko->id }}")'>
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

    {{-- Modal Tambah Toko --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTambahToko" aria-labelledby="modalTambahTokoLabel"
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
                    <form action="/admin_kas/toko/tambah" method="post" id="formTambahToko">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Kode Toko</label>
                                    <input type="text" class="form-control" name="kode_toko">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama toko</label>
                                    <input type="text" class="form-control" name="nama_toko">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Region</label>
                                    <select name="region_id" id="region_id" class="form-control">
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->nama_region }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" form="formTambahToko">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Toko --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditToko" aria-labelledby="modalEditTokoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Tambah Edit
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="formEditToko">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name_edit">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="email_edit">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="username" id="username_edit">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Kode Toko</label>
                                    <input type="text" class="form-control" name="kode_toko" id="kode_toko_edit">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama toko</label>
                                    <input type="text" class="form-control" name="nama_toko" id="nama_toko_edit">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Region</label>
                                    <select name="region_id" id="region_id_edit" class="form-control">
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->nama_region }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" form="formEditToko">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail Toko --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modalDetailToko" aria-labelledby="modalDetailTokoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Detail Toko
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>Area</th>
                            </thead>
                            <tbody id="detail-body">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a id="detail-href" class="btn btn-info"><i class="fa fa-"></i> Selengkapnya</a>
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

        function editToko(id) {
            $('#name_edit').val('');
            $('#email_edit').val('');
            $('#username_edit').val('');
            $('#kode_toko_edit').val('');
            $('#nama_toko_edit').val('');
            $('#region_id_edit').val('');
            $('#formEditToko').removeAttr('action');
            $('#formEditToko').attr('action', '/admin_kas/toko/edit/' + id);
            $.get('/admin_kas/toko/' + id, function(data, index) {
                $('#name_edit').val(data.users.name);
                $('#email_edit').val(data.users.email);
                $('#username_edit').val(data.users.username);
                $('#kode_toko_edit').val(data.tokos.kode_toko);
                $('#nama_toko_edit').val(data.tokos.nama_toko);
                $('#region_id_edit').val(data.tokos.region_id);
                $('#modalEditToko').modal('show')
            });
        }

        function hapusToko(id) {
            swal({
                    title: "Yakin ingin hapus?",
                    text: "Data yang dihapus tidak bisa di recovery!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "/admin_kas/toko/hapus/" + id;
                    } else {
                        swal("Gagal Hapus!");
                    }
                });
        }

        function detailToko(id) {
            $('#detail-body').html('');
            $('#detail-href').removeAttr('disabled','');
            $('#detail-href').removeAttr('href','');
            $.get('/admin_kas/toko/detail/' + id, function(data, index) {
                $.each(data.toko_details, function(index, value) {
                    $('#detail-body').append('<tr><td>' + value.nama_area + '</td></tr>');
                })
                $('#detail-href').attr('href', '/admin_kas/toko_detail/' + id);
                $('#modalDetailToko').modal('show')
            })
        }
    </script>
@endsection
