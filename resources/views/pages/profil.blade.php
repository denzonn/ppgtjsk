@extends('layouts.app')

@section('title')
    Profil - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <section class="mt-[100px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="text-center">
                <h2
                    class="relative mb-4 inline-block pb-[15px] text-[2rem] font-semibold after:absolute after:bottom-0 after:left-[30%] after:h-0.5 after:w-20 after:bg-[#227bff]">
                    Profil PPGT</h2>
            </div>

            <details data-periode-menu class="relative z-20 w-full md:w-fit" data-aos="fade-up" data-aos-duration="1000">
                <summary
                    class="flex min-w-[260px] cursor-pointer list-none items-center justify-between gap-4 rounded bg-[#5380f7] px-5 py-4 text-xs font-semibold uppercase tracking-[1.2px] text-white shadow-[0_4px_12px_rgba(0,0,0,0.1)] [&::-webkit-details-marker]:hidden">
                    <span>Pilih Periode</span><i class="fa-solid fa-earth-asia text-base"></i>
                </summary>
                <ul class="absolute left-0 top-full mt-3 w-full rounded bg-white text-left shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                    @foreach ($profil as $item)
                        <li class="px-5 text-[#666]">
                            <a href="#" data-periode="{{ $item->id }}"
                                class="block border-b border-black/5 py-4 text-[0.7rem] hover:text-[#5380f7]">{{ $item->periode }}</a>
                        </li>
                    @endforeach
                </ul>
            </details>

            @foreach ($profil as $index => $item)
                <div data-periode-page="{{ $item->id }}" @if ($index !== 0) hidden @endif>
                    <div class="w-full pt-2 text-center text-[22px]">{{ $item->periode }}</div>
                    <img src="{{ Storage::url($item->photo) }}" alt="" class="mx-auto mt-5 h-auto w-[70vw] rounded-[5px]" />
                    <div class="rich-text mt-4 text-justify font-light [&_p]:indent-8">{!! $item->content !!}</div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('addon-script')
    <script>
        document.querySelectorAll('[data-periode]').forEach((link) => link.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('[data-periode-page]').forEach((page) => page.hidden = page.dataset.periodePage !== link.dataset.periode);
            document.querySelector('[data-periode-menu]').open = false;
            AOS.refresh();
        }));
    </script>
@endpush
