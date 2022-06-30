@extends('toko.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-5">
            <hr>
        </div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h1 class="h3 mb-0 text-gray-800">Silahkan pilih brand</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            @foreach ($brands as $brand)
                <!-- Order Philips -->
                <div class="col-xl-3 col-md-6 col-6 mb-4">
                    <a href="/order/{{$brand->id}}/favorit">
                        <div class="card border-left-{{ $brand->warna }} h-100 shadow py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-{{ $brand->warna }} text-uppercase mb-1">
                                            <div class="row">
                                                <div class="col">
                                                    Order {{ $brand->nama_brand }}
                                                </div>
                                                <div class="col">
                                                    <img src="{{asset('/uploads/brand/'.$brand->photo)}}" alt="" style="width: 100px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
