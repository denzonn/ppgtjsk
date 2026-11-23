@extends('layouts.admin')

@section('title')
    Admin Dokumen
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-indigo-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('document.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-indigo-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-indigo-500 text-2xl text-white shadow-lg shadow-indigo-500/30"><i class="bx bx-folder"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-600">Tambah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Dokumen PPGT</h1>
                </div>
            </div>
            <div class="p-6 md:p-8">
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-rose-50 text-rose-700 ring-1 ring-rose-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="formDocument" action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="judul" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Judul Dokumen <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="judul" id="judul" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:ring-4 focus:ring-indigo-100 disabled:bg-slate-100 mb-6">

                    <label for="file" class="inline-block mb-2 text-sm font-semibold text-admin-heading">File <span class="font-bold text-rose-500">*</label>
                    <input type="file" name="file" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:ring-4 focus:ring-indigo-100 disabled:bg-slate-100">

                    <div>
                        {{-- Status animasi diatur JS lewat class "actives" lalu "finished" --}}
                        <button
                            class="button relative mt-6 flex h-[4.2rem] w-full items-center justify-center overflow-hidden rounded-[5px] bg-admin font-semibold uppercase text-white before:absolute before:bottom-0 before:left-0 before:h-full before:w-0 before:bg-[#54d98c] hover:bg-[#797cfd] [&.actives]:bg-[#2ecc71] [&.actives]:before:w-full [&.actives]:before:transition-[width] [&.actives]:before:duration-1000 [&.actives]:before:ease-linear [&.finished]:bg-[#54d98c]">
                            <span
                                class="submit absolute top-1/2 -translate-y-1/2 leading-none transition-all [.actives_&]:-top-full [.finished_&]:hidden">Submit</span>
                            <span
                                class="loading absolute top-full text-2xl leading-none transition-all [.actives_&]:top-1/2 [.actives_&]:-translate-y-1/2 [.finished_&]:hidden"><i
                                    class="fa fa-refresh [.actives_&]:animate-spin"></i></span>
                            <span
                                class="check absolute top-1/2 hidden -translate-y-1/2 text-2xl leading-none [.finished_&]:block [.finished_&]:animate-pop"><i
                                    class="fa fa-check"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        const button = document.querySelector('.button');
        const submit = document.querySelector('.submit');

        function toggleClass() {
            this.classList.toggle('actives');
        }

        function addClass() {
            this.classList.add('finished');
        }

        function submitForm() {
            setTimeout(function() {
                document.getElementById('formDocument').submit();
            }, 2000); // Delay redirect for 5 seconds (5000 milliseconds)
        }

        button.addEventListener('transitionend', toggleClass);
        button.addEventListener('transitionend', addClass);
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
            toggleClass.call(this);
            submitForm();
        });
    </script>
@endpush
