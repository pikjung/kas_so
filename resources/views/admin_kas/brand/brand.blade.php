@extends('admin_kas.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-3">
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
        <div class="table-responsive">
            <div class="card">
                <div class="card-header">
                    Brand
                    <button class="btn btn-primary float-right" id="tambahBrand" data-toggle="modal" data-target="#modalTambahBrand">Tambah</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Project</th>
                            <th>Nama Brand</th>
                            <th>Singkatan</th>
                            <th>Warna</th>
                            <th>Photo</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>
                                        {{$brand->project->nama_project}}
                                    </td>
                                    <td>
                                        {{$brand->nama_brand}}
                                    </td>
                                    <td>
                                        {{$brand->singkatan}}
                                    </td>
                                    <td>
                                        <span class="badge badge-{{$brand->warna}}">
                                            {{$brand->warna}}
                                        </span>
                                    </td>
                                    <td>
                                        <img src="{{asset('uploads/brand/'.$brand->photo)}}" alt="{{$brand->nama_brand}}" class="img-thumbnail" width="100px">
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" onclick='editBrand("{{$brand->id}}")' >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick='hapusBrand("{{$brand->id}}")'>
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
  
    <!-- Modal Tambah Brand -->
    <div class="modal fade" id="modalTambahBrand" tabindex="-1" role="dialog" aria-labelledby="modalTambahBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBrandLabel">Tambah Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/brand/tambah" method="POST" id="formBrandTambah" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="project">Project</label>
                        <select name="project_id" id="project_id" class="form-control">
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->nama_project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_brand">Nama Brand</label>
                        <input type="text" class="form-control" name="nama_brand" id="nama_brand">
                    </div>
                    <div class="form-group">
                        <label for="singkatan">Singkatan</label>
                        <input type="text" class="form-control" name="singkatan" id="singkatan">
                    </div>
                    <div class="form-group">
                        <label for="warna">Warna</label>
                        <select name="warna" id="warna" class="form-control">
                            <option value="primary" class="text-primary">Primary</option>
                            <option value="success" class="text-success">Success</option>
                            <option value="warning" class="text-warning">Warning</option>
                            <option value="secondary" class="text-secondary">Secondary</option>
                            <option value="danger" class="text-danger">Danger</option>
                            <option value="info" class="text-info">Info</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="formBrandTambah" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit Brand -->
    <div class="modal fade" id="modalEditBrand" tabindex="-1" role="dialog" aria-labelledby="modalEditBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditBrandLabel">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formBrandEdit" enctype="multipart/form-data">
                    {{ csrf_field() }}  
                    <div class="form-group">
                        <label for="project">Project</label>
                        <select name="project_id" id="project_id_edit" class="form-control">
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->nama_project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_brand">Nama Brand</label>
                        <input type="text" class="form-control" name="nama_brand" id="nama_brand_edit">
                    </div>
                    <div class="form-group">
                        <label for="singkatan">Singkatan</label>
                        <input type="text" class="form-control" name="singkatan" id="singkatan_edit">
                    </div>
                    <div class="form-group">
                        <label for="warna">Warna</label>
                        <select name="warna" id="warna_edit" class="form-control">
                            <option value="primary" class="text-primary">Primary</option>
                            <option value="success" class="text-success">Success</option>
                            <option value="warning" class="text-warning">Warning</option>
                            <option value="secondary" class="text-secondary">Secondary</option>
                            <option value="danger" class="text-danger">Danger</option>
                            <option value="info" class="text-info">Info</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo <strong>*kosongkan jika tidak ingin diubah</strong></label>
                        <input type="file" id="photo_edit" name="photo" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="formBrandEdit" class="btn btn-primary">Simpan</button>
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

        function editBrand(id) {
            $('#nama_brand_edit').val("");
            $('#singkatan_edit').val("");
            $('#warna_edit').val("");
            $('#project_id_edit').val("");
            $('#formBrandEdit').removeAttr('action');
            $('#formBrandEdit').attr('action','/admin_kas/brand/edit/'+id);
            $.get('/admin_kas/brand/'+id, function(data, index){
                $('#nama_brand_edit').val(data.brands.nama_brand);
                $('#singkatan_edit').val(data.brands.singkatan);
                $('#warna_edit').val(data.brands.warna)
                $('#project_id_edit').val(data.brands.project_id)
                $('#modalEditBrand').modal('show');
            })
        }

        function hapusBrand(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/brand/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }
    </script>
@endsection