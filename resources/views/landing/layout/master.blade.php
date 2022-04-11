<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title') - Pererenan Nengah Guest House</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Material Design icons-->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/asset-landing/css/styles.css" rel="stylesheet" />
    <!-- Custom Style CSS -->
    <link href="/asset-landing/css/custom.css" rel="stylesheet" />
    @livewireStyles
</head>
<style type="text/css">
    .map-container {
        overflow: hidden;
        padding-bottom: 56.25%;
        position: relative;
        height: 0;
    }

    .map-container iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
    }

</style>

<body class="d-flex flex-column py-0 h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="{{ route('landing.home') }}">
                    Pererenan Nengah Guest House
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing.home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing.booking') }}">
                                Booking
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing.content') }}">
                                Content
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landing.contactus') }}" style="margin-right: 10px;">
                                Contact Us
                            </a>
                        </li>
                        @if(Auth::guard('web')->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person"></i>&nbsp;{{ Str::words(auth()->guard('web')->user()->nama, 2) }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('landing.user.profileSetting') }}">
                                        <i class="bi bi-gear"></i>&nbsp;&nbsp;Profile Setting
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('landing.user.cartList') }}">
                                        <i class="bi bi-cart2"></i>&nbsp;&nbsp;Cart List&nbsp;&nbsp;&nbsp;
                                        <span class="badge bg-secondary">
                                            @livewire('user.get-count-cart')
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('landing.user.bookingList') }}">
                                        <i class="bi bi-journal-check"></i>&nbsp;&nbsp;Booking List&nbsp;&nbsp;&nbsp;
                                        <span class="badge bg-primary">
                                            @livewire('user.get-count-booking')
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-left"></i>&nbsp;&nbsp;{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div> 
                @if(!Auth::guard('web')->check())
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center justify-content-xl-start">
                    <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary ">Sign In</a>
                </div>
                @endif
            </div>
            </div>
        </nav>

        @yield('content')

    </main>
    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright &copy; Pererenan Nengah Guest House 2022</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="{{ route('landing.booking') }}">Booking</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="{{ route('landing.content') }}">Content</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="{{ route('landing.contactus') }}">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- JQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="/asset-landing/js/scripts.js"></script>

    @livewireScripts

    @yield('script')
</body>

</html>
