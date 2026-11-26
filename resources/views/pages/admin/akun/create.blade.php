@extends('layouts.admin')

@section('title')
    Tambah Akun
@endsection

@section('content')
    @php
        $in = 'block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] text-admin-heading outline-none transition focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light mb-6';
        $lb = 'inline-block mb-2 text-sm font-semibold text-admin-heading';
    @endphp
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-admin-light/60 px-5 py-4 md:px-6">
                <a href="{{ route('akun.index') }}" title="Kembali"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading"><i class="bx bx-arrow-back text-xl"></i></a>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Tambah data</p>
                    <h1 class="text-base font-bold text-admin-heading">Tambah Akun</h1>
                </div>
            </div>
            <div class="p-5 md:p-6">
                @if ($errors->any())
                    <div class="mb-6 rounded-xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-danger-50 text-danger-700 ring-1 ring-danger-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('akun.store') }}" method="POST">
                    @csrf
                    <label for="name" class="{{ $lb }}">Nama <span class="font-bold text-danger-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="{{ $in }}">
                    <label for="email" class="{{ $lb }}">Email <span class="font-bold text-danger-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="{{ $in }}">
                    <label for="password" class="{{ $lb }}">Password <span class="font-bold text-danger-500">*</span></label>
                    <input type="password" name="password" id="password" class="{{ $in }}">
                    <label for="password_confirmation" class="{{ $lb }}">Ulangi Password <span class="font-bold text-danger-500">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="{{ $in }}">
                    <label for="periode_id" class="{{ $lb }}">Periode <span class="font-bold text-danger-500">*</span></label>
                    <select name="periode_id" id="periode_id" class="{{ $in }}">
                        @foreach ($periode as $p)
                            <option value="{{ $p->id }}" @selected(old('periode_id') == $p->id)>{{ $p->label() }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="block w-full rounded-lg text-center text-sm font-semibold transition-colors px-5 py-2.5 bg-admin text-white hover:bg-admin-dark">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
