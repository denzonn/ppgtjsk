@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-[120px] max-w-[720px] px-3">
        <div class="rounded border border-black/15">
            <div class="border-b border-black/15 bg-black/[0.03] px-4 py-2">{{ __('Confirm Password') }}</div>
            <div class="p-4">
                <p class="mb-4">{{ __('Please confirm your password before continuing.') }}</p>

                <form method="POST" action="{{ route('password.confirm') }}" class="grid gap-4 md:grid-cols-[1fr_2fr]">
                    @csrf
                    <label for="password" class="pt-2 md:text-end">{{ __('Password') }}</label>
                    <div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-500/25 @error('password') border-red-600! @enderror">
                        @error('password')
                            <span class="mt-1 block text-sm font-bold text-red-600" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center gap-4 md:col-start-2">
                        <button type="submit" class="rounded bg-brand px-5 py-2.5 text-white hover:bg-brand-dark">
                            {{ __('Confirm Password') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="text-blue-600 underline" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
