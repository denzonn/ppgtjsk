<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('prepend-style')
    @include('includes.admin.style')
    @stack('addon-style')

    <title>
        @yield('title')
    </title>
    <link rel="shortcut icon" href="{{ asset('images/titlelogo.png') }}" type="image/x-icon">
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Layout container -->
            @include('includes.admin.sidebar')
            <div class="layout-page">
                @include('includes.admin.navbar')
                <!-- Navbar -->
                @yield('content')
                {{-- tampilkan hanya ketika sudah login dan hanya 1 kali saja di baca --}}
                @if (Auth::user() && Auth::user()->role == 'ADMIN')
                    @php
                        $user = Auth::user()->name ?? 'Admin';
                        
                        // Periksa apakah pesan selamat datang sudah ditampilkan sebelumnya
                        if (!session('welcome_back')) {
                            echo '
                                <div class="notification">
                                    <p>Welcome back, ' .
                                $user .
                                ' 👋</p>
                                    <span class="notification__progress"></span>
                                </div>
                            ';
                        
                            // Set variabel session 'welcome_back' agar pesan hanya ditampilkan sekali saat login
                            session(['welcome_back' => true]);
                        }
                    @endphp
                @endif
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

    </div>
    <!-- / Layout wrapper -->

    @stack('prepend-script')
    @include('includes.admin.script')
    @stack('addon-script')

</body>

</html>
