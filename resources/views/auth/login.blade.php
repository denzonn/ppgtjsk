@extends('layouts.loginapp')

@section('title', 'Masuk — SATKAS PPGT Jemaat Satria Kasih')

@push('addon-style')
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@500;600;700&family=Source+Code+Pro:wght@400;500&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
@endpush

@php
    $input = 'w-full rounded-[6px] border border-[#C4C6CF] bg-white py-2.5 text-[14px] leading-5 text-[#1A1B1E] placeholder:text-[#44474E] transition-colors duration-[120ms] focus:border-[#002046] focus:outline-none focus:ring-1 focus:ring-[#002046]';
    $label = 'text-[14px] font-semibold leading-[18px] text-[#1A1B1E]';
@endphp

@section('content')
    <div class="flex min-h-screen flex-col justify-between bg-[#FAF9FD] px-6 py-8 font-['Source_Sans_3',sans-serif] text-[#1A1B1E] antialiased">

        <header class="mx-auto flex w-full max-w-[1200px] items-center justify-between">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-1 text-[12px] font-semibold leading-4 tracking-[0.2px] text-[#44474E] transition-colors duration-[120ms] hover:text-[#1A1B1E]">
                <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">arrow_back</span>
                <span>Kembali ke Beranda</span>
            </a>
            <span class="font-['Source_Code_Pro',monospace] text-[12px] font-medium leading-4 text-[#44474E]">PPGT Satria Kasih</span>
        </header>

        <main class="flex flex-1 items-center justify-center py-8">
            <div class="flex w-full max-w-[420px] flex-col gap-6">

                <div class="flex flex-col items-center gap-2 text-center">
                    <div class="flex size-10 items-center justify-center rounded-[8px] bg-[#002046] text-white">
                        <span class="font-['Libre_Franklin',sans-serif] text-[15px] font-semibold leading-5">SK</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h1 class="text-balance font-['Libre_Franklin',sans-serif] text-[24px] font-semibold leading-[30px] tracking-[-0.35px]">Masuk ke SATKAS</h1>
                        <p class="text-pretty text-[14px] leading-5 text-[#44474E]">Portal resmi administrasi dan keanggotaan PPGT Jemaat Satria Kasih.</p>
                    </div>
                </div>

                <article class="flex flex-col gap-6 rounded-[8px] border border-[#E9E7EB] bg-white p-8">
                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                        @csrf

                        @error('email')
                            <p role="alert" class="rounded-[6px] bg-[#FFDAD6] px-3 py-2 text-[14px] leading-5 text-[#93000A]">{{ $message }}</p>
                        @enderror

                        <div class="flex flex-col gap-1">
                            <label for="email" class="{{ $label }}">Alamat Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus
                                placeholder="nama@ppgtsatriakasih.org"
                                @error('email') aria-invalid="true" @enderror
                                class="{{ $input }} px-2 @error('email') border-[#BA1A1A] @enderror">
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="flex items-center justify-between gap-2">
                                <label for="password" class="{{ $label }}">Kata Sandi</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[12px] font-semibold leading-4 tracking-[0.2px] text-[#002046] hover:underline">Lupa kata sandi?</a>
                                @endif
                            </div>
                            <div class="relative flex items-center">
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                    placeholder="Masukkan kata sandi"
                                    @error('password') aria-invalid="true" @enderror
                                    class="{{ $input }} pl-2 pr-10 @error('password') border-[#BA1A1A] @enderror">
                                <button type="button" data-toggle-password aria-label="Tampilkan kata sandi"
                                    class="absolute right-2 inline-flex size-8 items-center justify-center rounded-[6px] text-[#44474E] hover:text-[#1A1B1E] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#002046]">
                                    <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p role="alert" class="text-[12px] leading-4 text-[#BA1A1A]">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="inline-flex items-center gap-2 text-[14px] leading-5 text-[#44474E]">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="size-4 rounded-[4px] border-[#C4C6CF] accent-[#002046]">
                            Ingat saya
                        </label>

                        <button type="submit"
                            class="mt-1 inline-flex w-full items-center justify-center rounded-[6px] bg-[#002046] px-4 py-2.5 text-[14px] font-semibold leading-[18px] text-white transition-colors duration-[120ms] ease-out hover:bg-[#1B365D] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#002046] focus-visible:ring-offset-2">
                            Masuk ke Akun
                        </button>
                    </form>
                </article>

                <p class="text-center text-[14px] leading-5 text-[#44474E]">
                    Belum memiliki akses? <span class="font-semibold text-[#002046]">Hubungi Pengurus</span>
                </p>
            </div>
        </main>

        <footer class="mx-auto w-full max-w-[1200px] text-center">
            <span class="text-[12px] font-medium leading-4 tracking-[0.4px] text-[#44474E]">© {{ date('Y') }} PPGT Jemaat Satria Kasih · Sistem Administrasi Jemaat</span>
        </footer>
    </div>
@endsection

@push('addon-script')
    <script>
        document.querySelector('[data-toggle-password]')?.addEventListener('click', (e) => {
            const btn = e.currentTarget;
            const input = document.getElementById('password');
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.querySelector('span').textContent = show ? 'visibility_off' : 'visibility';
            btn.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
        });
    </script>
@endpush
