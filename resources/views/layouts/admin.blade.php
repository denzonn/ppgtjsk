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
    class="group/admin bg-admin-body font-public text-[15px] leading-[22px] text-admin-heading antialiased [&_:is(h1,h2,h3)]:font-headline [&_a:not([class])]:font-semibold [&_a:not([class])]:text-admin">
    <div class="flex min-h-screen">
        @include('includes.admin.sidebar')

        <div class="flex min-w-0 flex-1 flex-col">
            @include('includes.admin.navbar')
            <main class="mx-auto flex w-full max-w-[1200px] flex-1 flex-col p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Notifikasi: flash "success" dari controller + sapaan sekali setelah login --}}
    @php
        $toast = session('success');
        if (!$toast && Auth::user()?->role == 'ADMIN' && !session('welcome_back')) {
            session(['welcome_back' => true]);
            $toast = 'Selamat datang kembali, ' . (Auth::user()->name ?? 'Admin');
        }
    @endphp
    @if ($toast)
        <div role="status"
            class="invisible fixed bottom-6 right-6 z-[9999] flex max-w-sm items-center gap-3 overflow-hidden rounded-xl bg-admin-ink py-3 pl-3 pr-5 text-sm text-[#f1f0f4] opacity-0 animate-toast">
            <span class="material-symbols-outlined text-[20px]! text-[#aec7f7]">check_circle</span>
            <p>{{ $toast }}</p>
            <span class="absolute inset-x-0 bottom-0 h-0.5 origin-left scale-x-0 bg-[#aec7f7] animate-toast-bar"></span>
        </div>
    @endif

    @stack('prepend-script')
    @include('includes.admin.script')
    @stack('addon-script')
</body>

</html>
