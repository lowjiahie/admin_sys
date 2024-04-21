<!-- staff.master.blade.php -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Custom fonts for this template-->
        <link href="{{ asset('sbadmin2/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css' ) }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        @vite(['resources/js/app.js'])
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                    <div class="sidebar-brand-icon">
                        <svg t="1710685911127" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1670" width="32" height="32"><path d="M519.04 224H96v400c0 97.28 78.72 176 176 176h528c70.4 0 128-57.6 128-128v-39.04c0-225.28-183.68-408.96-408.96-408.96z m156.16 256c17.92 17.92 35.2 57.6 46.72 92.8l-129.92-1.92c-34.56-1.28-66.56-15.36-87.68-39.04-8.96-10.24-16-20.48-21.12-33.28-2.56-6.4-5.76-12.16-8.96-18.56h200.96z m113.92 94.08a458.88 458.88 0 0 0-36.48-94.08h74.24c14.72 29.44 25.6 61.44 31.36 95.36l-69.12-1.28z m-4.48-158.08H437.76c-39.04-58.88-81.28-99.84-120.96-128H518.4c108.16 0 202.88 50.56 266.24 128z m15.36 320H272c-61.44 0-112-50.56-112-112V288h3.84c12.8 1.92 165.12 28.16 260.48 236.16 7.04 17.92 17.92 35.2 32 50.56 33.28 36.48 81.92 58.88 133.76 60.16l228.48 5.12h45.44v32c0 35.2-28.8 64-64 64zM96 864h832v64h-832zM96 96h435.2v64H96z" fill="#1296db" p-id="1671"></path></svg>
                    </div>
                    <div class="sidebar-brand-text mx-2">RTG</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Heading -->
                <div class="sidebar-heading mt-3">
                    ADMIN PANEL
                </div>

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                @if($admin->type->value == 30)
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-users"></i>
                            <span>Staff Management</span>
                        </a>
                        <div id="collapseZero" class="collapse" aria-labelledby="userOne" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Staff Functions :</h6>
                                <a class="collapse-item" href="{{ route("admin.staff.list") }}">Staff Listing</a>
                            </div>
                        </div>
                    </li>
                @endif

                <!-- Nav Item - User Management -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="userOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">User Functions :</h6>
                            <a class="collapse-item" href="{{ route("admin.cus.list") }}">User Listing</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Food and Beverage -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-train"></i>
                        <span>Train Route Management</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="foodTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Train Route functions:</h6>
                            <a class="collapse-item" href="{{ route("admin.train.list") }}">Train Listing</a>
                            <a class="collapse-item" href="{{ route("admin.station.list") }}">Station Listing</a>
                            <a class="collapse-item" href="{{ route('admin.trainroute.list') }}">Train Route Listing</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Forum Management -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        <i class="fas fa-comments"></i>
                        <span>Feedback Management</span>
                    </a>
                    <div id="collapseSix" class="collapse" aria-labelledby="forumSix" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Feedback Functions :</h6>
                            <a class="collapse-item" href="{{ route('admin.feedback.list') }}">Feedback Listing</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Table Management -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <i class="fas fa-border-all"></i>
                        <span>Booking Management</span>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="tableFour" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Booking Functions :</h6>
                            <a class="collapse-item" href="{{ route('admin.booking.list') }}">Booking Listing</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        <i class="fas fa-border-all"></i>
                        <span>Reports</span>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="tableFive" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Reports Functions :</h6>
                            <a class="collapse-item" href="{{ route("admin.monthly.report.list") }}">Monthly Sales Report</a>
                            <a class="collapse-item" href="{{ route("admin.transaction.report.list") }}">Transaction Report</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $admin->name }}</span>
                                    <svg t="1646250226251" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6301" width="32" height="32"><path d="M512 74.666667C270.933333 74.666667 74.666667 270.933333 74.666667 512S270.933333 949.333333 512 949.333333 949.333333 753.066667 949.333333 512 753.066667 74.666667 512 74.666667z m0 160c70.4 0 128 57.6 128 128s-57.6 128-128 128-128-57.6-128-128 57.6-128 128-128z m236.8 507.733333c-23.466667 32-117.333333 100.266667-236.8 100.266667s-213.333333-68.266667-236.8-100.266667c-8.533333-10.666667-10.666667-21.333333-8.533333-32 29.866667-110.933333 130.133333-187.733333 245.333333-187.733333s215.466667 76.8 245.333333 187.733333c2.133333 10.666667 0 21.333333-8.533333 32z" p-id="6302" fill="#515151"></path></svg>                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route("admin.logout") }}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; {{ config('app.name') }} {{ date('Y') }}</span>
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

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('sbadmin2/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('sbadmin2/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('sbadmin2/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

        <script>
           $(document).ready(function() {
                $('.datatable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'pdfHtml5',
                            text: 'Export PDF', // Customize the button text
                            className: 'btn btn-primary', // Add custom classes for styling
                            footer: true // Include the footer in the exported PDF
                        }
                    ],
                    searching: false,
                    lengthChange: false,
                    "pageLength": 50,
                });
                $('.select-origin').select2({
                    placeholder: "Select a Origin",
                    allowClear: true
                });

                $('.select-destination').select2({
                    placeholder: "Select a Destination",
                    allowClear: true
                });

                $('.select-train').select2({
                    placeholder: "Select a Train",
                    allowClear: true
                });
            });
            const datetimeInput = document.getElementById('datetimepicker1');
        </script>
    </body>
</html>
