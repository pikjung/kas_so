@extends('toko.app')

@section('content')
                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <div class="mt-5 mb-5"><hr></div>
    
                        <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
                            <div class="carousel-inner" style="max-height:250px;">
                              <div class="carousel-item active">
                                <img class="d-block w-100" src="https://lelogama.go-jek.com/post_thumbnail/promo-goshop.jpg" alt="First slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="https://lelogama.go-jek.com/post_thumbnail/promo-goshop.jpg" alt="Second slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="https://lelogama.go-jek.com/post_thumbnail/promo-goshop.jpg" alt="Third slide">
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
    
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
                            <h1 class="h3 mb-0 text-gray-800">Halo! Toko Anugrah Elektrik</h1>
                        </div>
    
                        <!-- Content Row -->
                        <div class="row">
    
                            <!-- Order Philips -->
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
    
                        <!-- Content Row -->
    
                        <div class="row">
    
                            <!-- Area Chart -->
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="card shadow mb-4">
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="card-title">
                                            <b>Orderan Berjalan</b>
                                        </div>
                                        
                                        <div class="row">
                                            @foreach ($orders as $order)
                                            <div class="col-12 mb-2">
                                                <div class="card rounded">
                                                    <div class="card-body">
                                                        <div class="float-left">
                                                            <div class="text-{{$order->brand->warna}}">{{$order->brand->nama_brand}}</div> No Order: {{$order->nama_order}} 
                                                        </div>
                                                        <div class="float-right">
                                                            <i>{{$order->status}}</i> <br>
                                                            <button class="btn btn-outline-info" onclick="detailOrder({{$order->id}})">Lihat Detail</button>
                                                        </div> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Content Row -->
                        <div class="row">
    
                            <!-- Content Column -->
                            <div class="col-lg-12 mb-4">
    
                                <!-- Project Card Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Info Terbaru!</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="card rounded">
                                                    <div class="card-body">
                                                         <div class="card-title">
                                                             Kenaikan harga PPN 11%
                                                         </div>
                                                         <p>
                                                             Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta non enim neque, corrupti quis possimus in repellat minus totam eaque, praesentium eius obcaecati soluta ducimus adipisci. Numquam deleniti tenetur molestiae!
                                                         </p>
                                                         <div class="float-right">
                                                             <a href="#" class="btn btn-info">Baca selengkapnya</a>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="card rounded">
                                                    <div class="card-body">
                                                        <div class="card-title">
                                                            Tata cara Retur online
                                                        </div>
                                                        <p>
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta non enim neque, corrupti quis possimus in repellat minus totam eaque, praesentium eius obcaecati soluta ducimus adipisci. Numquam deleniti tenetur molestiae!
                                                        </p>
                                                        <div class="float-right">
                                                            <a href="#" class="btn btn-info">Baca selengkapnya</a>
                                                        </div>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
    
                    </div>
                    <!-- /.container-fluid -->
    
                </div>
                <!-- End of Main Content -->


                <script>
                    function detailOrder(id) {
                        $.get('/dashboard/detailOrder/'+id, function (data, index) {
                            var html = '<div class="row">';
                            var y = ""
                            $.each(data.order_details, function (val, item) {
                                y = y + "<div class='col-12 mb-2'><div class='card shadow rounded'><div class='card-body'>Produk: "+item.nama_produk+"<br>QTY: "+item.qty+"</div></div></div>"
                            })
                            // console.log(y);
                            html = html + y;
                            html = html + "</div>";
                            Swal.fire({
                                title: 'Detail Order',
                                html: html,
                                showCloseButton: true,
                            });
                        })
                    }
                </script>
@endsection