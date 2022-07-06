<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Order Sales | KAS</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-primary text-light topbar mb-4 fixed-top shadow">

                    <a class="nav-link btn-link " href="#" id="messagesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bars fa-fw text-light"></i>

                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-left shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <a class="dropdown-item d-flex align-items-center" href="/sales">
                            <div class="mr-3">
                                <i class="fa fa-tachometer-alt"></i>
                            </div>
                            <div class="font-weight-bold">
                                Dashboard
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/sales/order">
                            <div class="mr-3">
                                <i class="fa fa-shopping-basket"></i>
                            </div>
                            <div class="font-weight-bold">
                                Order
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/sales/troli">
                            <div class="mr-3">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="font-weight-bold">
                                Troli
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/sales/riwayat_order">
                            <div class="mr-3">
                                <i class="fa fa-history"></i>
                            </div>
                            <div class="font-weight-bold">
                                Riwayat Order
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/sales/statistik">
                            <div class="mr-3">
                                <i class="fa fa-chart-bar"></i>
                            </div>
                            <div class="font-weight-bold">
                                Statistik
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/logout">
                            <div class="mr-3">
                                <i class="fa fa-sign-out-alt"></i>
                            </div>
                            <div class="font-weight-bold">
                                Logout
                            </div>
                        </a>

                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline text-light small">Sales T01</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item d-flex" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item d-flex" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item d-flex" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                {{-- bottom bar --}}
                <!-- Bottom Navbar -->
                {{-- <nav class="navbar navbar-dark bg-primary navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom">
                    <ul class="navbar-nav nav-justified w-100">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-history"></i>
                                History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-shopping-basket"></i>
                                Order
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-shopping-cart"></i><br>
                                Troli
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-user"></i>
                                Profile
                            </a>
                        </li>
                    </ul>
                </nav> --}}
                {{-- End Of Bottombar --}}

                @section('content')

                @show

                <!-- Footer -->
                <footer class="sticky-footer bg-white fixed-bottom">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

        <script>
            $(document).ready(function() {
                var sesi = '{{ Session::get('success') }}';
                if (sesi) {
                    var pesan = '{{ Session::get('message') }}';
                    swal(pesan);
                }
            })
        </script>

</body>

</html>
