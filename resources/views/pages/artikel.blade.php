@extends('layouts.app')

@section('title')
    Detail Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <section class="mt-[100px]">
        <div class="mx-auto max-w-[1400px] px-3">
            <div class="mb-4 mt-12 flex flex-col items-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="relative mb-2 inline-block pb-[5px] text-center text-[2rem] font-semibold after:absolute after:bottom-0 after:left-[40%] after:h-0.5 after:w-[60px] after:bg-[#227bff]">
                    Artikel PPGT JSK</h2>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                <div class="grid content-start gap-6 md:col-span-2 md:grid-cols-3">
                    @foreach ($artikel as $item)
                        <a href="{{ route('artikel-detail', $item->slug) }}">
                            <img src="{{ Storage::url($item->photo) }}" alt=""
                                class="h-[250px] w-full rounded-lg object-cover">
                            <div class="mt-[5px] text-xl font-semibold text-[#393E46]">{{ $item->judul }}</div>
                            <div class="mt-[3px] text-sm text-[#393E46]">
                                {!! \Illuminate\Support\Str::limit(strip_tags($item->isi), 200) !!}</div>
                        </a>
                    @endforeach
                </div>
                @include('pages.partials.artikel-sidebar')
            </div>
        </div>
    </section>
@endsection
