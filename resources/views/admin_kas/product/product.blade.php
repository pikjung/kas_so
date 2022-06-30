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

        <div class="card">
            <div class="card-header">
                Produk
                <div class="float-right">
                    <button class="btn btn-info" data-toggle="modal" data-target="#modalImportProduk">
                        Import
                    </button> 
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahProduk">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <th>Kode Idem</th>
                        <th>Brand</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr>
                                <td>{{$produk->kode_idem}}</td>
                                <td>{{$produk->brand->nama_brand}}</td>
                                <td>{{$produk->nama_produk}}</td>
                                <td>{{$produk->deskripsi}}</td>
                                <td>
                                    <input type="checkbox" name="status" onchange='change_status("{{$produk->id}}")' @if ($produk->aktif == 'ya') checked @endif>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick='editProduk("{{$produk->id}}")'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick='hapusProduk("{{$produk->id}}")'>
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
    <div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahProdukLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin_kas/product/tambah" method="POST" id="formTambahProduk">
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
                        <label for="">Kode Idemp</label>
                        <input type="text" class="form-control" id="kode_idem" name="kode_idem">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" ></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formTambahProduk">Simpan</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog" aria-labelledby="modalEditProdukLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditProdukLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEditProduk">
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
                        <label for="">Kode Idemp</label>
                        <input type="text" class="form-control" id="kode_idem_edit" name="kode_idem">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk_edit" name="nama_produk">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi_edit"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formEditProduk">Simpan</button>
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
        
        function hapusProduk(id) {
            swal({
                title: "Yakin ingin hapus?",
                text: "Data yang dihapus tidak bisa di recovery!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/admin_kas/product/hapus/"+id;
                } else {
                    swal("Gagal Hapus!");
                }
            });
        }

        function editProduk(id) {
            $('#brand_id_edit').val('');
            $('#kode_idem_edit').val('');
            $('#nama_produk_edit').val('');
            $('#deskripsi_edit').html('');
            $('#formEditProduk').removeAttr('action');
            $('#formEditProduk').attr('action','/admin_kas/product/edit/'+id);
            $.get('/admin_kas/product/'+id, function(data, index){
                $('#brand_id_edit').val(data.produks[0].brand_id);
                $('#kode_idem_edit').val(data.produks[0].kode_idem);
                $('#nama_produk_edit').val(data.produks[0].nama_produk);
                $('#deskripsi_edit').html(data.produks[0].deskripsi);
                $('#modalEditProduk').modal('show');
            })
        }

        function change_status(id) {
            $.get('/admin_kas/product/status/'+id, function(data, index){
                swal({
                title: "Status Changed",
                text: data.message,
                icon: "success",
                });
            })
        }
    </script>
@endsection