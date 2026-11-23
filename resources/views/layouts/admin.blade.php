<!doctype html>
<html lang="id">

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
    <link rel="shortcut icon" href="{{ \App\Models\SiteImage::url('favicon') }}" type="image/x-icon">
</head>

<body
    class="group/admin bg-admin-body font-public text-[0.9375rem] text-admin-text antialiased [&_a:not([class])]:font-medium [&_a:not([class])]:text-admin">
    @include('includes.admin.sidebar')

    <div class="min-h-screen xl:pl-[280px]">
        @include('includes.admin.navbar')
        <main class="mx-auto max-w-[1400px] px-4 pb-12 pt-6 md:px-8">
            @yield('content')
        </main>
    </div>

    {{-- Notifikasi: flash "success" dari controller + sapaan sekali setelah login --}}
    @php
        $toast = session('success');
        if (!$toast && Auth::user()?->role == 'ADMIN' && !session('welcome_back')) {
            session(['welcome_back' => true]);
            $toast = 'Selamat datang kembali, ' . (Auth::user()->name ?? 'Admin') . ' 👋';
        }
    @endphp
    @if ($toast)
        <div role="status"
            class="invisible fixed bottom-6 right-6 z-[9999] flex max-w-sm items-center gap-3 overflow-hidden rounded-2xl bg-admin-ink py-4 pl-4 pr-6 text-sm text-white opacity-0 shadow-2xl shadow-black/30 animate-toast">
            <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-emerald-500/20 text-emerald-300"><i
                    class="bx bx-check text-xl"></i></span>
            <p>{{ $toast }}</p>
            <span
                class="absolute inset-x-0 bottom-0 h-1 origin-left scale-x-0 bg-linear-to-r from-emerald-400 to-cyan-400 animate-toast-bar"></span>
        </div>
    @endif

    @stack('prepend-script')
    @include('includes.admin.script')
    @stack('addon-script')
</body>

</html>
