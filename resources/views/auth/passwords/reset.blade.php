@extends('layouts.app')

@php
    $label = 'pt-2 md:text-end';
    $input = 'w-full rounded border border-gray-300 px-3 py-1.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-500/25';
    $error = 'mt-1 block text-sm font-bold text-red-600';
@endphp

@section('content')
    <div class="mx-auto mt-[120px] max-w-[720px] px-3">
        <div class="rounded border border-black/15">
            <div class="border-b border-black/15 bg-black/[0.03] px-4 py-2">{{ __('Reset Password') }}</div>
            <div class="p-4">
                <form method="POST" action="{{ route('password.update') }}" class="grid gap-4 md:grid-cols-[1fr_2fr]">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <label for="email" class="{{ $label }}">{{ __('Email Address') }}</label>
                    <div>
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
                            autocomplete="email" autofocus class="{{ $input }} @error('email') border-red-600! @enderror">
                        @error('email')
                            <span class="{{ $error }}" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="password" class="{{ $label }}">{{ __('Password') }}</label>
                    <div>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="{{ $input }} @error('password') border-red-600! @enderror">
                        @error('password')
                            <span class="{{ $error }}" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="password-confirm" class="{{ $label }}">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required
                        autocomplete="new-password" class="{{ $input }}">

                    <div class="md:col-start-2">
                        <button type="submit" class="rounded bg-brand px-5 py-2.5 text-white hover:bg-brand-dark">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
