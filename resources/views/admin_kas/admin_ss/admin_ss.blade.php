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
                Admin SS
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#adminSSTambah">
                    Tambah Admin SS
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editAdminSS({{$user->id}})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteAdminSS({{$user->id}})">
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

    <!-- Modal Tambah Admin SS -->
    <div class="modal fade" id="adminSSTambah" tabindex="-1" role="dialog" aria-labelledby="adminSSTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminSSTambahLabel">Tambah Admin SS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/admin_ss/tambah" method="POST" id="formTambahAdminSS">
                    {{ csrf_field() }}
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
                <button type="submit" class="btn btn-primary" form="formTambahAdminSS">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Update Admin SS -->
    <div class="modal fade" id="adminSSUpdate" tabindex="-1" role="dialog" aria-labelledby="adminSSUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminSSUpdateLabel">Update Admin SS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEditAdminSS">
                    {{ csrf_field() }}
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
                        <label for="">Password <strong>*Kosongkan jika tidak ingin mengganti</strong> </label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formEditAdminSS">Simpan</button>
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
        
        function editAdminSS(id) {
            $('#username_edit').val('');
            $('#name_edit').val('');
            $('#email_edit').val('');
            
            $('#formEditAdminSS').removeAttr('action');
            $('#formEditAdminSS').attr('action','/admin_kas/admin_ss/edit/'+id);
            $.get('/admin_kas/admin_ss/'+id, function(data, index){
                $('#username_edit').val(data.user.username);
                $('#name_edit').val(data.user.name);
                $('#email_edit').val(data.user.email);
            })

            $('#adminSSUpdate').modal('show');
        }

        function deleteAdminSS(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/admin_ss/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }
    </script>
@endsection