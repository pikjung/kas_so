@extends('user.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">
            <hr>
        </div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-gray-800">Order detail <b>{{$param}}</b></h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        Pilih Produk
                    </div>
                    <div class="col-12 col-lg-12">
                        <button class="btn btn-outline-secondary">Essential</button>
                        <button class="btn btn-outline-secondary">Helix</button>
                        <button class="btn btn-outline-secondary">Tornado</button>
                    </div>
                    <div class="col-12 col-lg-12">
                        <br>
                        Pilih Watt
                    </div>
                    <div class="col-12 col-lg-12">
                        <button class="btn btn-outline-secondary">2 Watt</button>
                        <button class="btn btn-outline-secondary">3 Watt</button>
                        <button class="btn btn-outline-secondary">4 Watt</button>
                    </div>
                    <div class="col-12 col-lg-12">
                        <br>
                        Pilih Warna
                    </div>
                    <div class="col-12 col-lg-12">
                        <button class="btn btn-outline-secondary">Putih</button>
                        <button class="btn btn-outline-secondary">Netral</button>
                        <button class="btn btn-outline-secondary">Kuning</button>
                    </div>

                    <div class="col-12 col-lg-12">
                        <br>
                        <div class="float-right">
                            <button class="btn btn-success">
                                Selesai
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection