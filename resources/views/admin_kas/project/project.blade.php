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
                Project
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalProjectTambah">
                    Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Nama Project</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>
                                        {{$project->nama_project}}
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" onclick='editProject("{{$project->id}}")'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick='hapusProject("{{$project->id}}")'>
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

    <!-- Modal Tambah Project -->
    <div class="modal fade" id="modalProjectTambah" tabindex="-1" role="dialog" aria-labelledby="modalProjectTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProjectTambahLabel">Tambah Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/project/tambah" method="POST" id="formTambahProject">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_project">Nama Project</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formTambahProject">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit Project -->
    <div class="modal fade" id="modalProjectEdit" tabindex="-1" role="dialog" aria-labelledby="modalProjectEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProjectEditLabel">Tambah Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEditProject">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_project">Nama Project</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project_edit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formEditProject">Simpan</button>
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

        function editProject(id) {
            $('#nama_project_edit').val("");
            $('#formEditProject').removeAttr('action');
            $('#formEditProject').attr('action','/admin_kas/project/edit/'+id);
            $.get('/admin_kas/project/'+id, function(data, index){
                $('#nama_project_edit').val(data.projects.nama_project);
                $('#modalProjectEdit').modal('show');
            })
        }

        function hapusProject(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/project/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }
    </script>
@endsection