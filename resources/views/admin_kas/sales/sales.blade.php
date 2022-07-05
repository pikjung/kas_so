@extends('admin_ss.app')

@section('content')
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#salesTambah">
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
                                <td>{{$sales->area->nama_area}}</td>
                                <td>{{$sales->user->name}}</td>
                                <td>{{$sales->user->username}}</td>
                                <td>{{$sales->user->email}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" onclick="editSales({{$sales->id}})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger" onclick="hapusSales({{$sales->id}})">
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

    <script>
        $(document).ready(function() {
            var sesi = '{{ Session::get('success') }}';
            if (sesi) {
                var pesan = '{{ Session::get('message') }}';
                swal(pesan);
            }
        })
    </script>
@endsection
