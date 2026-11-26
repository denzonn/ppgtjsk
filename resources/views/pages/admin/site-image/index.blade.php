@extends('layouts.admin')

@section('title')
    Gambar Situs
@endsection

@section('content')
    <div class="flex flex-col gap-5">
        {{-- Banner: pratinjau hero beranda saat ini --}}
        <section class="relative overflow-hidden rounded-xl bg-admin-ink text-white">
            <img src="{{ \App\Models\SiteImage::url('hero') }}" alt="" class="absolute inset-0 size-full object-cover opacity-40">
            <div class="absolute inset-0 bg-linear-to-r from-admin-ink via-admin-ink/85 to-transparent"></div>
            <div class="relative flex max-w-xl flex-col gap-2 p-6 md:p-8">
                <span class="font-mono text-[10px] uppercase tracking-wider text-ink-200">Master Gambar</span>
                <h1 class="text-xl font-bold tracking-tight">Gambar Situs</h1>
                <p class="text-sm text-slate-300">Ganti gambar beranda, logo, dan favicon tanpa menyentuh kode. Slot yang belum
                    diganti otomatis memakai gambar bawaan.</p>
                <a href="{{ route('home') }}" target="_blank"
                    class="mt-2 inline-flex items-center gap-1.5 self-start rounded-lg bg-white/10 px-3 py-2 text-xs font-medium transition-colors hover:bg-white/15">
                    <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">open_in_new</span> Lihat beranda
                </a>
            </div>
        </section>

        @if ($errors->any())
            <div class="flex gap-2 rounded-xl border border-danger-200 bg-danger-50 p-4 text-sm text-danger-700">
                <span class="material-symbols-outlined text-[18px]!" aria-hidden="true">error</span>
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @foreach (collect($slots)->groupBy(fn($slot) => $slot[3], preserveKeys: true) as $group => $groupSlots)
            <section class="flex flex-col gap-3">
                <h2 class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-wider text-admin-text">
                    {{ $group }} <span class="h-px flex-1 bg-admin-border"></span>
                </h2>
                <div class="grid gap-4 {{ $group === 'Beranda' ? '' : 'sm:grid-cols-2 xl:grid-cols-4' }}">
                    @foreach ($groupSlots as $key => [$label, $hint])
                        @php($custom = isset($uploaded[$key]))
                        <form action="{{ route('site-image.update', $key) }}" method="POST" enctype="multipart/form-data"
                            class="group flex flex-col overflow-hidden rounded-xl border border-admin-border bg-white transition-colors hover:border-ink-200 {{ $group === 'Beranda' ? 'md:flex-row' : '' }}">
                            @csrf
                            @method('PUT')
                            <label
                                class="relative grid cursor-pointer place-items-center overflow-hidden bg-[repeating-conic-gradient(#f1f5f9_0_25%,#fff_0_50%)] bg-[length:20px_20px] {{ $group === 'Beranda' ? 'aspect-[16/7] md:w-3/5' : 'aspect-[4/3] border-b border-admin-border' }}">
                                <img src="{{ \App\Models\SiteImage::url($key) }}" alt="{{ $label }}" data-preview
                                    class="{{ $group === 'Beranda' ? 'size-full object-cover' : 'max-h-[65%] max-w-[65%] object-contain' }} transition-transform group-hover:scale-105">
                                <span class="absolute inset-0 grid place-items-center bg-admin-ink/50 text-xs font-semibold text-white opacity-0 transition-opacity group-hover:opacity-100">
                                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]!" aria-hidden="true">upload</span> Pilih gambar</span>
                                </span>
                                <input type="file" name="image" accept="image/png,image/jpeg,image/webp" required class="sr-only"
                                    onchange="this.form.querySelector('[data-preview]').src = window.URL.createObjectURL(this.files[0]); this.form.querySelector('[data-save]').hidden = false">
                                <span class="absolute left-3 top-3 rounded-full px-2 py-0.5 text-[11px] font-semibold {{ $custom ? 'bg-bronze-50 text-bronze-600 ring-1 ring-bronze-200' : 'bg-white text-admin-text ring-1 ring-admin-border' }}">
                                    {{ $custom ? 'Diganti' : 'Bawaan' }}
                                </span>
                            </label>
                            <div class="flex flex-1 flex-col gap-1 p-4">
                                <h3 class="text-sm font-bold">{{ $label }}</h3>
                                <p class="text-xs text-admin-text">{{ $hint }}</p>
                                @if ($custom)
                                    <p class="font-mono text-[11px] text-admin-text">Diganti {{ $uploaded[$key]->locale('id')->diffForHumans() }}</p>
                                @endif
                                <div class="mt-auto flex flex-wrap items-center gap-2 pt-3">
                                    <button type="submit" data-save hidden
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-admin px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-admin-dark">
                                        <span class="material-symbols-outlined text-[16px]!" aria-hidden="true">save</span> Simpan
                                    </button>
                                    @if ($custom)
                                        <button type="submit" form="reset-{{ $key }}" onclick="return confirm('Kembalikan {{ $label }} ke gambar bawaan?')"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-admin-border px-3 py-1.5 text-xs font-semibold text-admin-text transition-colors hover:bg-admin-body hover:text-admin-heading">
                                            <span class="material-symbols-outlined text-[15px]!" aria-hidden="true">restart_alt</span> Kembalikan bawaan
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                        @if ($custom)
                            <form id="reset-{{ $key }}" action="{{ route('site-image.destroy', $key) }}" method="POST" hidden>
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
@endsection
