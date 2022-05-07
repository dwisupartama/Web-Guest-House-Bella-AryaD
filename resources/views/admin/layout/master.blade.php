<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title') - Admin Pererenan Nengah Guest House</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <link href="/asset-admin/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Style CSS -->
    <link href="/asset-landing/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</head>
@yield('style')
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('admin.dashboard') }}">Admin Guest House</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{auth()->guard('admin')->user()->nama_admin}} </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profileSetting') }}">
                            <i class="fas fa-user-edit"></i>&nbsp;&nbsp;Profile Setting
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        {{-- <a class="dropdown-item" href="#!">Logout</a> --}}
                        <a href="{{ route('admin.logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link @if(Route::is('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Master Data</div>
                        @if(auth()->guard('admin')->user()->hak_akses == "Admin")
                        <a class="nav-link @if(Route::is('admin.data-admin.*')) active @endif" href="{{ route('admin.data-admin.index') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            Data Admin
                        </a>
                        @endif
                        <a class="nav-link @if(Route::is('admin.data-customer.*')) active @endif" href="{{ route('admin.data-customer.index') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            Data Customer
                        </a>
                        @if(auth()->guard('admin')->user()->hak_akses == "Admin")
                        <a class="nav-link @if(Route::is('admin.data-kamar.*')) active @endif" href="{{ route('admin.data-kamar.index') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-bed"></i>
                            </div>
                            Data Kamar
                        </a>
                        <a class="nav-link @if(Route::is('admin.data-konten.*')) active @endif" href="{{ route('admin.data-konten.index') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            Data Konten
                        </a>
                        <a class="nav-link @if(Route::is('admin.data-gambar.*')) active @endif" href="{{ route('admin.data-gambar.index') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-images"></i>
                            </div>
                            Data Gambar Konten
                        </a>
                        @endif
                        <div class="sb-sidenav-menu-heading">Reservasi</div>
                        <a class="nav-link @if(Route::is('admin.data-reservasi.*')) active @endif" href="{{ route('admin.data-reservasi.index') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            Data Reservasi
                        </a>
                        <a class="nav-link @if(Route::is('admin.laporan-reservasi.*')) active @endif" href="{{ route('admin.laporan-reservasi.index') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-flag"></i>
                            </div>
                            Laporan Reservasi
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{auth()->user("admin")->nama_admin}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">@yield('title')</h1>
                    <p>Pererenan Nengah Guest House</p>

                    @yield('content')

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Pererenan Nengah Guest House 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
    <script src="/asset-admin/js/scripts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/asset-admin/assets/demo/chart-area-demo.js"></script>
    <script src="/asset-admin/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/asset-admin/js/datatables-simple-demo.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/trumbowyg.min.js" integrity="sha512-t4CFex/T+ioTF5y0QZnCY9r5fkE8bMf9uoNH2HNSwsiTaMQMO0C9KbKPMvwWNdVaEO51nDL3pAzg4ydjWXaqbg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    
    @yield('script')

</body>

</html>
