@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-[120px] max-w-[720px] px-3">
        <div class="rounded border border-black/15">
            <div class="border-b border-black/15 bg-black/[0.03] px-4 py-2">{{ __('Verify Your Email Address') }}</div>
            <div class="p-4">
                @if (session('resent'))
                    <div class="mb-4 rounded border border-green-200 bg-green-50 p-4 text-green-800" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="text-blue-600 underline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
@endsection
