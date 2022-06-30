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
                Region
                <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modalTambahRegion">
                    Tambah Region
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" cellspacing="0"width="100%">
                        <thead>
                            <th>Nama Region</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                                <tr>
                                    <td>
                                        {{$region->nama_region}}
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" onclick='editRegion("{{$region->id}}")'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick='hapusRegion("{{$region->id}}")'>
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
    <div class="modal fade" id="modalTambahRegion" tabindex="-1" role="dialog" aria-labelledby="modalTambahRegionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahRegionLabel">Tambah Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/region/tambah" method="POST" id="formTambahRegion">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_region">Nama Region</label>
                        <input type="text" class="form-control" name="nama_region" id="nama_region">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formTambahRegion">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit Region -->
    <div class="modal fade" id="modalEditRegion" tabindex="-1" role="dialog" aria-labelledby="modalEditRegionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditRegionLabel">Tambah Region</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEditRegion">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_region">Nama Region</label>
                        <input type="text" class="form-control" name="nama_region" id="nama_region_edit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formEditRegion">Simpan</button>
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

        function editRegion(id) {
            $('#nama_region_edit').val("");
            $('#formEditRegion').removeAttr('action');
            $('#formEditRegion').attr('action','/admin_kas/region/edit/'+id);
            $.get('/admin_kas/region/'+id, function(data, index){
                $('#nama_region_edit').val(data.regions.nama_region);
                $('#modalEditRegion').modal('show');
            })
        }

        function hapusRegion(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/region/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }
    </script>

@endsection