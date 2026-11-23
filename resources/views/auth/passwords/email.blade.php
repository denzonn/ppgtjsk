@extends('layouts.app')

@php
    $input = 'w-full rounded border border-gray-300 px-3 py-1.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-500/25';
@endphp

@section('content')
    <div class="mx-auto mt-[120px] max-w-[720px] px-3">
        <div class="rounded border border-black/15">
            <div class="border-b border-black/15 bg-black/[0.03] px-4 py-2">{{ __('Reset Password') }}</div>
            <div class="p-4">
                @if (session('status'))
                    <div class="mb-4 rounded border border-green-200 bg-green-50 p-4 text-green-800" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="grid gap-4 md:grid-cols-[1fr_2fr]">
                    @csrf
                    <label for="email" class="pt-2 md:text-end">{{ __('Email Address') }}</label>
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus class="{{ $input }} @error('email') border-red-600! @enderror">
                        @error('email')
                            <span class="mt-1 block text-sm font-bold text-red-600" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-start-2">
                        <button type="submit" class="rounded bg-brand px-5 py-2.5 text-white hover:bg-brand-dark">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
