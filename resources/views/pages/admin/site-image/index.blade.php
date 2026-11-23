@extends('layouts.admin')

@section('title')
    Gambar Situs
@endsection

@section('content')
    {{-- Header: banner dengan pratinjau hero beranda saat ini --}}
    <section class="relative mb-8 overflow-hidden rounded-3xl bg-admin-ink text-white">
        <img src="{{ \App\Models\SiteImage::url('hero') }}" alt=""
            class="absolute inset-0 size-full object-cover opacity-40 mix-blend-luminosity">
        <div class="absolute inset-0 bg-linear-to-r from-admin-ink via-admin-ink/80 to-transparent"></div>
        <div class="relative max-w-xl p-8 md:p-10">
            <span class="mb-3 inline-flex items-center gap-2 rounded-full bg-rose-500/20 px-3 py-1 text-xs font-semibold text-rose-200">
                <i class="bx bx-image-alt"></i> Master Gambar
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight md:text-4xl">Gambar Situs</h1>
            <p class="mt-2 text-slate-300">Ganti gambar beranda, logo, dan favicon tanpa menyentuh kode. Slot yang belum
                diganti otomatis memakai gambar bawaan.</p>
            <a href="{{ route('home') }}" target="_blank"
                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-admin-ink transition hover:bg-rose-50">
                <i class="bx bx-show text-lg"></i> Lihat beranda
            </a>
        </div>
    </section>

    @if ($errors->any())
        <div class="mb-6 flex gap-3 rounded-2xl bg-rose-50 p-4 text-sm text-rose-700 ring-1 ring-rose-200">
            <i class="bx bx-error-circle text-xl"></i>
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @foreach (collect($slots)->groupBy(fn($slot) => $slot[3], preserveKeys: true) as $group => $groupSlots)
        <h2 class="mb-4 mt-8 flex items-center gap-3 text-sm font-bold uppercase tracking-[0.18em] text-slate-400 first-of-type:mt-0">
            {{ $group }} <span class="h-px flex-1 bg-admin-border"></span>
        </h2>
        <div class="grid gap-6 {{ $group === 'Beranda' ? '' : 'sm:grid-cols-2 xl:grid-cols-4' }}">
            @foreach ($groupSlots as $key => [$label, $hint])
                @php($custom = isset($uploaded[$key]))
                <form action="{{ route('site-image.update', $key) }}" method="POST" enctype="multipart/form-data"
                    class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-admin-border transition hover:shadow-lg hover:shadow-slate-200/70 {{ $group === 'Beranda' ? 'md:flex-row' : '' }}">
                    @csrf
                    @method('PUT')
                    <label
                        class="relative grid cursor-pointer place-items-center overflow-hidden bg-[repeating-conic-gradient(#f1f5f9_0_25%,#fff_0_50%)] bg-[length:20px_20px] {{ $group === 'Beranda' ? 'aspect-[16/7] md:w-3/5' : 'aspect-[4/3]' }}">
                        <img src="{{ \App\Models\SiteImage::url($key) }}" alt="{{ $label }}" data-preview
                            class="{{ $group === 'Beranda' ? 'size-full object-cover' : 'max-h-[70%] max-w-[70%] object-contain' }} transition group-hover:scale-105">
                        <span
                            class="absolute inset-0 grid place-items-center bg-admin-ink/50 text-sm font-semibold text-white opacity-0 transition group-hover:opacity-100">
                            <span class="flex items-center gap-2"><i class="bx bx-cloud-upload text-2xl"></i> Pilih gambar</span>
                        </span>
                        <input type="file" name="image" accept="image/png,image/jpeg,image/webp" required class="sr-only"
                            onchange="this.form.querySelector('[data-preview]').src = URL.createObjectURL(this.files[0]); this.form.querySelector('[data-save]').hidden = false">
                        <span
                            class="absolute left-3 top-3 rounded-full px-2.5 py-1 text-[0.7rem] font-bold uppercase tracking-wider {{ $custom ? 'bg-emerald-500 text-white' : 'bg-white/90 text-slate-500 ring-1 ring-slate-200' }}">
                            {{ $custom ? 'Diganti' : 'Bawaan' }}
                        </span>
                    </label>
                    <div class="flex flex-1 flex-col gap-2 p-5">
                        <h3 class="font-bold text-admin-heading">{{ $label }}</h3>
                        <p class="text-sm text-slate-500">{{ $hint }}</p>
                        @if ($custom)
                            <p class="text-xs text-slate-400">Diganti {{ $uploaded[$key]->locale('id')->diffForHumans() }}</p>
                        @endif
                        <div class="mt-auto flex flex-wrap items-center gap-2 pt-3">
                            <button type="submit" data-save hidden
                                class="inline-flex items-center gap-1.5 rounded-xl bg-rose-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-rose-500/30 transition hover:bg-rose-600">
                                <i class="bx bx-save"></i> Simpan
                            </button>
                            @if ($custom)
                                <button type="submit" form="reset-{{ $key }}"
                                    onclick="return confirm('Kembalikan {{ $label }} ke gambar bawaan?')"
                                    class="inline-flex items-center gap-1.5 rounded-xl px-3 py-2 text-sm font-medium text-slate-500 transition hover:bg-slate-100">
                                    <i class="bx bx-reset"></i> Kembalikan bawaan
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
    @endforeach
@endsection
