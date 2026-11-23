@extends('layouts.app')

@php
    $label = 'pt-2 md:text-end';
    $input = 'w-full rounded border border-gray-300 px-3 py-1.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-500/25';
    $invalid = 'border-red-600!';
    $error = 'mt-1 block text-sm font-bold text-red-600';
@endphp

@section('content')
    <div class="mx-auto mt-[120px] max-w-[720px] px-3">
        <div class="rounded border border-black/15">
            <div class="border-b border-black/15 bg-black/[0.03] px-4 py-2">{{ __('Register') }}</div>
            <div class="p-4">
                <form method="POST" action="{{ route('register') }}" class="grid gap-4 md:grid-cols-[1fr_2fr]">
                    @csrf
                    <label for="name" class="{{ $label }}">{{ __('Name') }}</label>
                    <div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                            autofocus class="{{ $input }} @error('name') {{ $invalid }} @enderror">
                        @error('name')
                            <span class="{{ $error }}" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="email" class="{{ $label }}">{{ __('Email Address') }}</label>
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" class="{{ $input }} @error('email') {{ $invalid }} @enderror">
                        @error('email')
                            <span class="{{ $error }}" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="password" class="{{ $label }}">{{ __('Password') }}</label>
                    <div>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="{{ $input }} @error('password') {{ $invalid }} @enderror">
                        @error('password')
                            <span class="{{ $error }}" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="password-confirm" class="{{ $label }}">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required
                        autocomplete="new-password" class="{{ $input }}">

                    <div class="md:col-start-2">
                        <button type="submit" class="rounded bg-brand px-5 py-2.5 text-white hover:bg-brand-dark">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
