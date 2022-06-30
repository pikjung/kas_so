@extends('toko.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">
            <hr>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-gray-800">Order <b>{{ $brand->nama_brand }}</b></h1>
        </div>

        <div class="row mt-5">
            <div class="col-md-12 col-lg-12 col-xl-12 col-12">
                <div class="card rounded shadow">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'favorit') active @endif"
                                    href="/order/{{ $brand_id }}/favorit">Favorit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'paket') active @endif"
                                    href="/order/{{ $brand_id }}/paket">Paket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'lainnya') active @endif"
                                    href="/order/{{ $brand_id }}/lainnya">Lainnya</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="/order/troli/lainnya" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Pilih Produk</label>
                                <select name="produk_id" id="produk_id" class="form-control">
                                    @foreach ($produks as $produk)
                                        <option value="{{$produk->id}}">{{ $produk->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">QTY</label>
                                <input type="number" name="qty" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Troli</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
