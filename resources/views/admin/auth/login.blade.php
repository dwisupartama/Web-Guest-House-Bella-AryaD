<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Admin Login - Pererenan Nengah Guest House</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/asset-landing/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>


    <!-- Custom styles for this template -->
    <link href="/asset-landing/css/signin.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="text-center">

    <main class="form-signin">
        @if (\Session::has('error'))
        <script type="text/javascript">
        Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "{!! \Session::get('error') !!}",
            confirmButtonColor: '#3085d6',
        });
        </script>
        @endif
        <form action="{{ route('admin.proses') }}" method="POST">
            @csrf
            <h1 class="fw-bolder">Admin Log In</h1>
            <p class="lead fw-normal text-muted mb-5">Pererenan Nengah Guest House</p>
            {{-- <h1 class="h3 mb-3 fw-normal">Please sign in</h1> --}}

            <div class="form-floating">
                <input type="text" id="floatingInput" placeholder="Username" class="form-control" name="username" required autocomplete="username" autofocus>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" id="floatingPassword" placeholder="Password" class="form-control" name="password" required autocomplete="current-password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Log In</button>

            <p class="mt-5 mb-3 text-muted">&copy; 2022 Pererenan Nengah Guest House</p>
        </form>
    </main>



</body>

</html>