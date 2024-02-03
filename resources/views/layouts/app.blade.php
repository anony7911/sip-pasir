<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="#">
    <link rel="shortcut icon" href="{{ asset('logo_pt_pasir.png') }}" type="image/x-icon">

    <meta name="description" content="Sistem Informasi Penjualan Pasir" />
    <meta name="keywords" content="Sistem Informasi Penjualan Pasir, PT. Tambang Pasir Ranokomea" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="{{ url('/') }}/asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/asset/css/tiny-slider.css" rel="stylesheet">
    <link href="{{ url('/') }}/asset/css/style.css" rel="stylesheet">
    <title>{{ $title ?? 'SIP - Pasir' }} || PT. Tambang Pasir Ranokomea
    </title>
    @livewireStyles
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="/">SIP - Pasir<span></span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li @if (request()->is('/')) class="nav-item active" @endif>
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li @if (request()->is('produk')) class="nav-item active" @endif>
                        <a class="nav-link" href="/produk">Produk</a>
                    </li>
                    <li @if (request()->is('keranjang')) class="nav-item active" @endif>
                    <a class="nav-link" href="/keranjang">Keranjang</a></li>
                    <li @if (request()->is('pesanan')) class="nav-item active" @endif>
                    <a class="nav-link" href="/pesanan">Pesanan</a></li>
                    <li @if (request()->is('kontak')) class="nav-item active" @endif>
                    <a class="nav-link" href="/kontak">Kontak</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ url('/') }}/asset/images/user.svg">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{-- nama --}}
                            @auth
                                <li><label class="dropdown-item">{{ Auth::user()->name }}</label></li>
                            @else
                                <li><label class="dropdown-item">Guest</label></li>
                            @endauth
                            <li>
                            @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                            @else
                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                            @endauth
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->
    {{ $slot }}
    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">
            <div class="border-top copyright">
                <div class="row pt-1">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
                                document.write(new Date().getFullYear());

                            </script>. All Rights Reserved. &mdash; Designed with love by <a href="#">#</a>
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </footer>
    <!-- End Footer Section -->


    <script src="{{ url('/') }}/asset/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/asset/js/tiny-slider.js"></script>
    <script src="{{ url('/') }}/asset/js/custom.js"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
