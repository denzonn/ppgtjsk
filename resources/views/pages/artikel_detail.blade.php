@extends('layouts.app')

@section('title')
    Detail Kegiatan - PPGT Jemaat Satria Kasih
@endsection


@section('content')
    <section class="mt-[100px]">
        <div class="mx-auto max-w-[1400px] px-3">
            <nav aria-label="breadcrumb">
                <ol class="mb-4 flex flex-wrap gap-2 text-[#6c757d]">
                    <li><a href="{{ route('artikel') }}" class="text-black">Artikel</a></li>
                    <li>/</li>
                    <li aria-current="page">{{ $artikel->judul }}</li>
                </ol>
            </nav>
            <div class="grid gap-6 md:grid-cols-3">
                <div class="md:col-span-2">
                    <div class="mt-[5px] text-[32px] font-black text-[#393E46]">{{ $artikel->judul }}</div>
                    <span>{{ \Carbon\Carbon::parse($artikel->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                    <img src="{{ $artikel->photo }}" alt="" class="mt-4 w-full rounded-lg">
                    <div class="rich-text mt-5 text-lg text-[#393E46]">{!! $artikel->isi !!}</div>
                    <div class="text-sm font-semibold text-[#999] md:text-end">Editor : {{ $artikel->penulis }}</div>

                    <div class="mt-[52px] text-[28px] font-semibold text-[#393E46]">Related Posts</div>
                    <div class="mt-2 grid gap-6 md:grid-cols-3">
                        @foreach ($relatedPosts as $item)
                            <a href="{{ route('artikel-detail', $item->slug) }}">
                                <img src="{{ $item->photo }}" alt=""
                                    class="h-[250px] w-full rounded-lg object-cover">
                                <div class="mt-[5px] text-xl font-semibold text-[#393E46]">{{ $item->judul }}</div>
                                <div class="mt-[3px] text-sm text-[#393E46]">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($item->isi), 200) !!}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @include('pages.partials.artikel-sidebar')
            </div>
        </div>
    </section>
@endsection
