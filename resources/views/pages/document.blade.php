@extends('layouts.app')

@section('title')
    Dokument - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <div class="mt-[100px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mt-12" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="mb-2 inline-block border-b-4 border-brand pb-[5px] text-center font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Dokument PPGT</h2>
                <p class="mb-4 text-gray-500">"Silahkan download dokumen PPGT dibawah ini"</p>
            </div>

            <!-- Search -->
            <form action="{{ route('document.search') }}" method="GET" class="mb-4 flex w-full" data-aos="fade-up"
                data-aos-duration="2000">
                <input type="text" name="search" placeholder="Cari Dokumen" value="{{ $searchQuery ?? '' }}"
                    class="min-w-0 flex-1 rounded-l-[5px] bg-[#eee] p-2.5 outline-none focus:ring-2 focus:ring-brand/30">
                <button type="submit"
                    class="w-[15%] min-w-20 rounded-r-[5px] bg-brand text-white hover:bg-[#3c4e9e]">Cari</button>
            </form>

            <!-- Document -->
            <div class="grid gap-x-6 md:grid-cols-2 lg:grid-cols-3">
                @php
                    $increment = 2000;
                @endphp
                @forelse ($documen as $item)
                    <div class="mt-5 rounded border border-black/15 p-4" data-aos="fade-up"
                        data-aos-duration="{{ $increment += 500 }}">
                        <h5 class="mb-2 text-[17px] leading-7"><i class="fa-regular fa-folder-open text-brand"></i>
                            {{ $item->judul }}</h5>
                        <div class="text-end">
                            <a href="{{ $item->file }}"
                                class="inline-block rounded bg-brand px-3 py-1.5 text-white hover:bg-[#3c4e9e]">Download</a>
                        </div>
                    </div>
                @empty
                    <p class="mt-5 text-gray-500">Dokumen tidak ditemukan.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
