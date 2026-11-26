@extends('layouts.loginapp')

@section('content')
    <div class="mt-[50px] px-3 md:mt-20">
        <div class="relative mx-auto grid min-h-[550px] w-[768px] max-w-full overflow-hidden rounded-[10px] bg-white md:grid-cols-2 md:shadow-[0_14px_28px_rgba(0,0,0,0.25),0_10px_10px_rgba(0,0,0,0.22)]"
            data-aos="fade-up" data-aos-duration="1000">
            <form method="POST" action="{{ route('login') }}"
                class="flex flex-col items-center justify-center bg-white px-[50px] text-center">
                @csrf
                <h1 class="text-[2.5rem] font-bold">Sign in</h1>
                <div class="my-5 flex gap-2.5">
                    @foreach (['fa-facebook-f', 'fa-google-plus-g', 'fa-linkedin-in'] as $icon)
                        <a href="#"
                            class="inline-flex size-10 items-center justify-center rounded-full border border-[#ddd] text-[#333]"><i
                                class="fab {{ $icon }}"></i></a>
                    @endforeach
                </div>
                <span class="text-xs">or use your account</span>

                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus placeholder="Email"
                    class="my-2 w-full bg-[#eee] px-[15px] py-3 outline-none focus:ring-2 focus:ring-[#1e429c]/30 @error('email') ring-2 ring-red-500 @enderror">
                @error('email')
                    <span class="w-full text-left text-sm font-bold text-red-600" role="alert">{{ $message }}</span>
                @enderror

                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Password"
                    class="my-2 w-full bg-[#eee] px-[15px] py-3 outline-none focus:ring-2 focus:ring-[#1e429c]/30 @error('password') ring-2 ring-red-500 @enderror">
                @error('password')
                    <span class="w-full text-left text-sm font-bold text-red-600" role="alert">{{ $message }}</span>
                @enderror

                <button type="submit"
                    class="mt-2 rounded-[20px] border border-[#1e429c] bg-[#1e429c] px-[45px] py-3 text-xs font-bold uppercase tracking-[1px] text-white transition-transform duration-75 active:scale-95">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="my-[15px] text-sm text-[#333] hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>

            <div
                class="hidden flex-col items-center justify-center bg-linear-to-r from-ppgt-950 to-ppgt-700 px-10 text-center text-white md:flex">
                <h1 class="text-[2.5rem] font-bold">Hello, Friend!</h1>
                <p class="mb-[30px] mt-5 text-sm font-thin leading-5 tracking-[0.5px]">Selamat Datang di Website Resmi PPGT
                    Jemaat Satria Kasih. Silahkan Masukkan Akun Anda!</p>
            </div>
        </div>
    </div>
@endsection
