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

        <div class="card shadow">
            <div class="card-header">
                Area
                <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalTambahArea">
                    Tambah Area
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" cellspacing="0"width="100%">
                        <thead>
                            <th>Project</th>
                            <th>Nama Area</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($areas as $area)
                                <tr>
                                    <td>
                                        {{$area->project->nama_project}}
                                    </td>
                                    <td>
                                        {{$area->nama_area}}
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" onclick='editArea("{{$area->id}}")'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick='hapusArea("{{$area->id}}")'>
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

    <!-- Modal Tambah Area -->
    <div class="modal fade" id="modalTambahArea" tabindex="-1" role="dialog" aria-labelledby="modalTambahAreaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAreaLabel">Tambah Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/area/tambah" method="POST" id="formTambahArea">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="project_id">Project</label>
                        <select name="project_id" class="form-control" id="project_id">
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->nama_project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_area">Nama Area</label>
                        <input type="text" class="form-control" name="nama_area" id="nama_area">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formTambahArea">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit Area -->
    <div class="modal fade" id="modalEditArea" tabindex="-1" role="dialog" aria-labelledby="modalEditAreaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAreaLabel">Tambah Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEditArea">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="project_id">Project</label>
                        <select name="project_id" class="form-control" id="project_id_edit">
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->nama_project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_area">Nama Area</label>
                        <input type="text" class="form-control" name="nama_area" id="nama_area_edit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formEditArea">Simpan</button>
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

        function editArea(id) {
            $('#nama_area_edit').val("");
            $('#project_id_edit').val("");
            $('#formEditArea').removeAttr('action');
            $('#formEditArea').attr('action','/admin_kas/area/edit/'+id);
            $.get('/admin_kas/area/'+id, function(data, index){
                $('#nama_area_edit').val(data.areas.nama_area);
                $('#project_id_edit').val(data.areas.project_id)
                $('#modalEditArea').modal('show');
            })
        }

        function hapusArea(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/area/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }
    </script>

@endsection