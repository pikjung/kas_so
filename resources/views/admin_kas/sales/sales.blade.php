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
    
        <div class="card mt-5">
            <div class="card-header">
                Sales
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#salesTambah">
                    Tambah Sales
                </button>
            </div>
    
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Area</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($sales as $item)
                                <tr>
                                    <td>{{$item->area->nama_area}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->user->username}}</td>
                                    <td>{{$item->user->email}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editSales({{$item->id}})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="hapusSales({{$item->id}})">
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

    <!-- Modal Tambah Sales -->
    <div class="modal fade" id="salesTambah" tabindex="-1" role="dialog" aria-labelledby="salesTambahLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="salesTambahLabel">Tambah Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin_kas/sales/tambah" method="POST" id="formTambahSales">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Area</label>
                            <select name="area_id" id="" class="form-control">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"> {{$area->nama_area}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="formTambahSales">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Sales -->
    <div class="modal fade" id="salesEdit" tabindex="-1" role="dialog" aria-labelledby="salesEditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="salesEditLabel">Edit Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formEditSales">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Area</label>
                            <select name="area_id" id="" class="form-control" id="area_id_edit">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"> {{$area->nama_area}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name_edit">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id="username_edit">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" id="email_edit">
                        </div>
                        <div class="form-group">
                            <label for="">Password <strong>*Kosongkan jika tidak ingin mengganti</strong></label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="formEditSales">Simpan</button>
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

        function editSales(id) {
            $('#area_id_edit').val('');
            $('#username_edit').val('');
            $('#name_edit').val('');
            $('#email_edit').val('');
            $('#formEditSales').removeAttr('action');
            $('#formEditSales').attr('action','/admin_kas/sales/edit/'+id);
            
            $.get('/admin_kas/sales/'+id, function(data, index){
                $('#area_id_edit').val(data.sales.area_id);
                $('#username_edit').val(data.user.username);
                $('#name_edit').val(data.user.name);
                $('#email_edit').val(data.user.email);
                $('#salesEdit').modal('show')
            })
        }

        function hapusSales(id) {
            swal({
                    title: "Yakin ingin hapus?",
                    text: "Data yang dihapus tidak bisa di recovery!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = "/admin_kas/sales/hapus/" + id;
                    } else {
                        swal("Gagal Hapus!");
                    }
                });
        }
    </script>
@endsection
