<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')

    <title>
        @yield('title')
    </title>
    <link rel="shortcut icon" href="{{ asset('images/titlelogo.png') }}" type="image/x-icon">
</head>

<body>

    @include('includes.navbar-home')

    @yield('content')

    @include('includes.footer')

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')

</body>

</html>
