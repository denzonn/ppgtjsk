@extends('layouts.app2')

@section('title')
    PPGT Jemaat Satria Kasih
@endsection

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
@endpush

@push('prepend-style')
    <script type="module" crossorigin src="{{ asset('carousel/assets/index.ef4fdc7a.js') }}"></script>
    <link rel="modulepreload" href="{{ asset('carousel/assets/vendor.8992d2a8.js') }}">
    <link rel="stylesheet" href="{{ asset('carousel/assets/index.3e4e39bd.css') }}">
@endpush

@section('content')
    <!-- Activity Information -->
    <section
        class="min-h-screen bg-cover bg-fixed bg-top bg-no-repeat text-center tracking-[0.3em] text-white"
        style="background-image: linear-gradient(rgba(0,0,0,.4), rgba(0,0,0,.4)), url('{{ \App\Models\SiteImage::url('hero') }}')">
        <div class="relative mx-auto h-screen max-w-[1220px] px-3">
            <div class="absolute left-1/2 top-1/2 w-full -translate-x-1/2 -translate-y-1/2 px-3">
                <h1 class="mb-2 font-slab text-[2rem] font-black tracking-[0.1rem] md:text-[4rem] md:tracking-[0.3em]"
                    data-aos="fade-up" data-aos-duration="1500">
                    <span id="home"></span>
                </h1>
                <div class="text-[0.8rem] tracking-[0.1em] text-[#a4a4a4] md:text-base" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-delay="500">
                    1 Korintus 3:11 (TB) Karena tidak ada seorang pun yang dapat meletakkan dasar lain dari pada dasar
                    yang telah diletakkan, yaitu Yesus Kristus.
                </div>
                <a href="#kegiatan"
                    class="mt-2 inline-block rounded bg-brand-dark px-[15px] py-[5px] text-base text-white md:px-[25px] md:py-2.5"
                    data-aos="fade-up" data-aos-duration="1500" data-aos-delay="500">
                    INFO KEGIATAN
                </a>
            </div>
        </div>
    </section>
    <!-- Activity Information -->

    <!-- Renungan -->
    <section class="mb-[50px] mt-[30px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mb-4 mt-12" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="inline-block rounded-b-[10px] border-b-4 border-brand pb-[5px] font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Renungan Harian</h2>
            </div>
            <div class="text-justify text-base font-light" data-aos="fade-up" data-aos-duration="2000">
                <div class="mb-2 mr-2.5 float-left max-[500px]:w-full">
                    <iframe height="300" src="{{ $renungan[0]->url_youtube }}" frameborder="0" allowfullscreen
                        class="w-full rounded-[5px] min-[500px]:w-[30rem]"></iframe>
                </div>
                <div class="rich-text leading-[30px]">
                    <h4 class="mb-2 text-2xl font-medium">{{ $renungan[0]->judul }} ({{ $renungan[0]->ayat }})</h4>
                    <div data-more-short>
                        <p>{!! Illuminate\Support\Str::limit($renungan[0]->isi, 1030) !!}
                            @if (strlen($renungan[0]->isi) >= 1030)
                                <button type="button" data-more-toggle
                                    class="px-3 text-xs italic text-[#b6b6b6] underline">Read more</button>
                            @endif
                        </p>
                    </div>
                    @if (strlen($renungan[0]->isi) > 1030)
                        <div data-more-full hidden>
                            <p>{!! $renungan[0]->isi !!}
                                <button type="button" data-more-toggle
                                    class="w-full text-xs italic text-[#b6b6b6] underline">Read Less</button>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="clear-both" data-aos="fade-up" data-aos-duration="2500">
                <hr class="my-4 border-gray-300">
                <div class="text-xs font-light text-[#a4a4a4]">
                    Penulis : Tim Renungan Harian GT
                </div>
                <hr class="my-4 border-gray-300">
            </div>
        </div>
    </section>
    <!-- Renungan -->

    <!-- All Acitivity -->
    <section class="relative my-12" id="kegiatan">
        <div class="absolute -mt-10 h-[40vh] w-[40vh] rounded-[60%_40%_30%_70%/60%_30%_70%_40%] bg-linear-45 from-[#88d5bf] to-[#5d6bf8] md:mt-0 md:h-[30vh] md:w-[30vh]"
            data-aos="fade-up" data-aos-duration="1000"></div>
        <div class="relative mx-auto max-w-[1220px] px-3">
            <div class="flex flex-col items-end" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="mb-2 inline-block rounded-b-[10px] border-b-4 border-brand pb-[5px] text-center font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Kegiatan PPGT</h2>
            </div>
            <div class="grid gap-4 lg:grid-cols-2">
                @php
                    $increment = 0;
                @endphp
                @foreach ($kegiatan as $item)
                    <div class="mt-3 lg:mt-0" data-aos="fade-up" data-aos-duration="{{ $increment += 1000 }}">
                        @include('pages.partials.kegiatan-card')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- All Acitivity -->

    {{-- Activity Weekend --}}
    <section>
        <div class="mx-auto max-w-[1220px] px-3">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="inline-block rounded-b-[10px] border-b-4 border-brand pb-[5px] font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Kegiatan Seminggu</h2>
            </div>
            <div class="mt-6 p-4">
                <div class="overflow-x-auto" data-aos="fade-up" data-aos-duration="2000">
                    <table class="w-full text-left [&_td]:p-2 [&_th]:p-2 [&_thead_tr]:border-b-2 [&_tbody_tr:nth-child(odd)]:bg-black/5">
                        <thead>
                            <tr>
                                <th class="w-1/5">Hari/Tanggal</th>
                                <th class="w-[30%]">Kegiatan</th>
                                <th class="w-1/5">Waktu</th>
                                <th class="w-[30%]">Tempat</th>
                            </tr>
                        </thead>
                        @php
                            $increment2 = 1000;
                        @endphp
                        <tbody>
                            @forelse ($kegiatanMingguan as $item)
                                <tr class="border-b border-gray-200" data-aos="fade-up"
                                    data-aos-duration="{{ $increment2 += 500 }}">
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </td>
                                    <td>{{ $item->kegiatan->name }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>
                                        <a class="cursor-pointer text-black" target="_blank" href="{{ $item->maps }}">
                                            {!! $item->tempat !!}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada kegiatan minggu ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    {{-- Activity Weekend --}}

    <!-- Gallery -->
    <section class="relative z-[2] mb-[50px]">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mb-4 flex flex-col items-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="inline-block rounded-b-[10px] border-b-4 border-brand pb-[5px] text-center font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Dokumentasi Kegiatan</h2>
            </div>
            <p class="mb-4 text-center text-gray-500" data-aos="fade-up" data-aos-duration="2000">
                "Jangan lewatkan momen spesial kami! Lihat galeri foto kegiatan kami
                dan saksikan betapa serunya kami dalam melakukan berbagai aktivitas
                yang pasti akan membuat Anda terinspirasi." <a href="{{ route('gallery') }}"
                    class="text-blue-600">Liat Semua......</a>
            </p>
        </div>
        <div class="swiper" data-aos="zoom-in" data-aos-duration="2000">
            <div class="swiper-wrapper">
                @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <!-- elements with  "swiper-carousel-animate-opacity" class will have animated opacity -->
                        <div class="swiper-carousel-animate-opacity">
                            <img src="{{ Storage::url($item->photo) }}" alt="">
                            <div class="slide-content text-white">
                                <h2>{{ $item->kegiatan->name }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Gallery -->

    <!-- Pengurus -->
    <div class="my-12">
        <div class="mx-auto max-w-[1220px] px-3">
            <div class="mb-6 text-center" data-aos="fade-up" data-aos-duration="2000">
                <h2 class="mb-2 font-slab text-2xl font-medium text-brand lg:text-[2rem]">K S W B
                    <br>
                    2022 - 2024
                    <br>
                    <span class="font-sans text-lg font-light text-[#a4a4a4]">Ketua - Sekretaris - Wakil Sekretaris -
                        Bendahara</span>
                </h2>
            </div>
            <section data-aos="fade-up" data-aos-duration="1000">
                <div class="flex max-md:h-screen max-md:flex-col">
                    @foreach ($ksb as $item)
                        <figure
                            class="group relative isolate flex h-[500px] flex-1 overflow-hidden rounded-lg bg-black p-[25px] opacity-75 transition-[flex,opacity] duration-500 hover:flex-[5] hover:opacity-100 max-md:hover:basis-full">
                            <img src="{{ Storage::url($item->foto) }}" alt=""
                                class="absolute right-0 top-0 -z-10 size-full object-cover" />
                            <figcaption class="self-end uppercase text-white">
                                <a href="{{ $item->instagram }}" target="_blank" class="text-white">
                                    <h2
                                        class="mb-0 -translate-y-2.5 rounded-[5px] bg-linear-to-r from-[#0d6efd] to-[#032658] px-2.5 text-xl opacity-0 transition-[opacity,transform] delay-0 duration-300 group-hover:translate-y-0 group-hover:opacity-100 group-hover:delay-[350ms]">
                                        {{ $item->nama }}</h2>
                                </a>
                                <br>
                                <div
                                    class="inline-block translate-y-2.5 rounded-[5px] bg-linear-to-r from-[#4136d9] to-[#0086c7] px-[5px] text-[0.8rem] text-white opacity-0 shadow-[0_1px_10px_rgba(0,0,0,0.2)] transition-[opacity,transform] delay-0 duration-300 group-hover:translate-y-0 group-hover:opacity-100 group-hover:delay-[350ms]">
                                    {{ $item->jabatan }}</div>
                                <br>
                                <div
                                    class="inline-block translate-y-2.5 rounded-[5px] bg-linear-to-r from-white to-[#f0f0f0] px-[5px] text-[0.7rem] text-[#4136d9] opacity-0 shadow-[0_1px_10px_rgba(0,0,0,0.2)] transition-[opacity,transform] delay-[350ms] duration-300 group-hover:translate-y-0 group-hover:opacity-100 [&_p]:mb-0">
                                    {!! $item->motto !!}</div>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </section>
            <hr class="mt-12 border-gray-300">
            <div class="relative mb-6 mt-12 text-center" data-aos="fade-up" data-aos-duration="1000">
                <div class="absolute right-0 mt-[45px] h-[40vh] w-[40vh] rounded-[60%_40%_30%_70%/60%_30%_70%_40%] bg-linear-45 from-[#88d5bf] to-[#5d6bf8] md:-right-[130px] md:mt-0 md:h-[30vh] md:w-[30vh] md:rounded-[30%_70%_70%_30%/30%_30%_70%_70%]"
                    data-aos="fade-up" data-aos-duration="1000"></div>
                <h2 class="relative mb-2 font-slab text-2xl font-medium text-brand lg:text-[2rem]">Pengurus PPGT
                    <br>
                    <span class="font-sans text-lg font-light text-[#a4a4a4]">Jemaat Satria Kasih</span>
                </h2>
            </div>
            <div class="relative grid md:grid-cols-2 lg:grid-cols-3">
                @php
                    $increment4 = 0;
                    $sector = 'font-slab text-xl font-medium text-brand';
                    $name = 'font-sans text-base font-light leading-[30px] text-[#696969]';
                @endphp
                @foreach ($manajement as $item)
                    <div data-aos="fade-up" data-aos-duration="{{ $increment4 += 1000 }}">
                        <div class="p-[15px]" data-tilt data-tilt-max="10" data-tilt-speed="400"
                            data-tilt-perspective="700">
                            <img src="{{ Storage::url($item->foto_bidang) }}" alt="" class="w-full rounded-[7px]">
                        </div>
                        <div class="px-[15px]">
                            <div class="{{ $sector }}">{{ $item->nama_bidang }}</div>
                            @foreach ($manajementPengurus as $item)
                                @foreach ($item as $item)
                                    <div class="{{ $name }}">{{ $item->jabatan->nama_jabatan }} :
                                        {{ $item->nama_anggota }}</div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endforeach
                @foreach ($bidang as $item)
                    <div data-aos="fade-up" data-aos-duration="{{ $increment4 += 1500 }}">
                        <div class="p-[15px]" data-tilt data-tilt-max="10" data-tilt-speed="400"
                            data-tilt-perspective="700">
                            <img src="{{ Storage::url($item->foto_bidang) }}" alt="" class="w-full rounded-[7px]">
                        </div>
                        <div class="px-[15px]">
                            <div class="{{ $sector }}">{{ $item->nama_bidang }}</div>
                            @foreach ($pengurus[$loop->index] as $anggota)
                                @if ($anggota->jabatan->nama_jabatan == 'Ketua Bidang')
                                    <div class="{{ $name }}">Ketua Bidang: {{ $anggota->nama_anggota }}</div>
                                @endif
                            @endforeach
                            @if ($item->nama_bidang === 'Kelompok-Kelompok')
                                @foreach ($pengurus[$loop->index] as $anggota)
                                    <div class="{{ $name }}">{{ $anggota->jabatan->nama_jabatan }} :
                                        <div>{{ $anggota->nama_anggota }}</div>
                                    </div>
                                @endforeach
                            @else
                                <div class="{{ $name }}">Anggota:</div>
                                <ol class="mb-4 list-decimal pl-8 text-[#696969]">
                                    @foreach ($pengurus[$loop->index] as $anggota)
                                        @if ($anggota->jabatan->nama_jabatan == 'Anggota Bidang')
                                            <li>
                                                <div class="{{ $name }}">{{ $anggota->nama_anggota }}</div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Pengurus -->

    <!-- Contact -->
    <div class="my-12">
        <div class="mx-auto max-w-[1220px] px-3">
            <hr class="border-gray-300">
            <div class="mb-4 mt-[30px] flex flex-col items-center" data-aos="fade-up" data-aos-duration="1000">
                <h2
                    class="inline-block rounded-b-[10px] border-b-4 border-brand pb-[5px] text-center font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                    Kontak</h2>
            </div>
            @php
                $h6 = 'mb-2 text-xl font-medium text-[#595959]';
            @endphp
            <div class="grid gap-6 md:grid-cols-2">
                <div class="p-4 shadow-[0_5px_12px_-2px_rgba(211,211,211,0.2)]" data-aos="fade-up"
                    data-aos-duration="2000">
                    <h6 class="{{ $h6 }}">Info Selanjutnya</h6>
                    <p class="text-[15px] leading-[27px] text-[#696969]">Untuk info lebih lanjut silahkan teman-teman
                        menghubungi pengurus PPGT Jemaat Satria Kasih atau bisa melalui instagram PPGT Jemaat Satria Kasih
                        <a href="https://www.instagram.com/ppgtsatriakasih/"
                            class="text-[#696969] hover:text-brand">@ppgtsatriakasih</a>
                    </p>
                </div>
                <div class="p-4 shadow-[0_5px_12px_-2px_rgba(211,211,211,0.2)]" data-aos="fade-up"
                    data-aos-duration="3000">
                    <h6 class="{{ $h6 }}">Sekilas Info</h6>
                    <div class="rich-text mb-4 text-[15px] leading-[27px] text-[#696969]">
                        @foreach ($sekilasAnggota as $item)
                            {!! $item->description !!}
                        @endforeach
                    </div>
                    <h6 class="{{ $h6 }} lg:mt-12">Pundi Kasih</h6>
                    <div class="text-[15px] text-[#696969]">
                        <div>Buat teman-teman yang ingin berbagi kasih dapat mengirimkan ke rekening PPGT Jemaat Satria
                            Kasih</div>
                        <div class="grid lg:grid-cols-2">
                            @foreach ($pundiKasih as $item)
                                @if ($item->no_rek !== '-' && $item->no_rek !== null)
                                    <div>
                                        <br>
                                        <img src="{{ \App\Models\SiteImage::bankLogo($item->bank->name) }}" alt="" class="inline w-[50px]">
                                        <span>{{ $item->no_rek }}</span>
                                        <br>
                                        <span>a/n {{ $item->atas_nama }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact -->

    <section class="bg-[#fdfdfd] py-[2vh]">
        <div class="mx-auto grid max-w-[1220px] gap-6 px-3 lg:grid-cols-2">
            <!-- Suggestion -->
            <section class="my-12 lg:px-[8.33%]">
                <div data-aos="fade-up" data-aos-duration="1000">
                    <h2
                        class="mb-2 inline-block rounded-b-[10px] border-b-4 border-brand pb-[5px] text-center font-slab text-2xl font-medium text-brand lg:text-[2rem]">
                        Saran</h2>
                </div>
                <p class="mb-4 text-gray-500" data-aos="fade-up" data-aos-duration="1500">
                    Berikan saran anda untuk membuat PPGT Jemaat Satria Kasih lebih baik lagi!
                </p>
                <form action="{{ route('user.saran') }}" method="post" data-aos="fade-up" data-aos-duration="25000">
                    @csrf
                    <label class="text-[1.2rem]">Nama</label>
                    <input type="text" name="nama"
                        class="block w-full rounded-[5px] border border-[#b6b6b6] px-3 py-1.5 outline-none focus:border-brand" />
                    <label class="mt-4 block text-[1.2rem]">Saran</label>
                    <textarea name="saran"
                        class="h-[150px] w-full rounded-[5px] border border-[#b6b6b6] p-[5px] text-black outline-none focus:border-brand"></textarea>
                    <button class="mt-4 w-full rounded bg-brand px-5 py-2.5 text-white hover:bg-brand-dark">Kirim</button>
                </form>
            </section>
            <!-- Suggestion -->

            <!-- FAQ -->
            <section class="my-12">
                <div class="pb-4 text-center" data-aos="fade-up" data-aos-duration="1000">
                    <h2
                        class="relative mb-[45px] mt-5 inline-block text-[2rem] font-semibold leading-none after:absolute after:-bottom-[25px] after:left-1/2 after:h-0.5 after:w-[60px] after:-translate-x-1/2 after:bg-[#227bff] md:mt-0">
                        FAQ</h2>
                </div>
                <div class="rounded bg-white shadow-[0_2px_48px_0_rgba(0,0,0,0.06)] max-lg:mb-[30px]" data-aos="fade-up"
                    data-aos-duration="2000">
                    @php
                        $increment5 = 0;
                    @endphp
                    @foreach ($faq as $item)
                        <details name="faq" class="group border-b border-dashed border-[#cee1f8]" data-aos="fade-up"
                            data-aos-duration="{{ $increment5 += 1000 }}">
                            <summary
                                class="flex cursor-pointer list-none gap-2 px-[30px] py-5 text-base tracking-[1px] text-[#3b566e] transition-all duration-300 hover:bg-[#0b69f51c] hover:pl-10 [&::-webkit-details-marker]:hidden">
                                <i class="fa-solid fa-plus mt-1 text-[#006eff] transition-transform group-open:rotate-45"></i>
                                {{ $item->pertanyaan }}
                            </summary>
                            <div
                                class="border-t border-[#f3f8ff] px-[30px] pb-4 pl-[35px] pt-[30px] text-[0.9rem] leading-7 tracking-[1px] text-[#6f8ba4] rich-text">
                                <p>{!! $item->jawaban !!}</p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </section>
            <!-- FAQ -->
        </div>
    </section>
@endsection

@push('addon-script')
    {{-- tYPED --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.16/typed.umd.js"
        integrity="sha512-+2pW8xXU/rNr7VS+H62aqapfRpqFwnSQh9ap6THjsm41AxgA0MhFRtfrABS+Lx2KHJn82UOrnBKhjZOXpom2LQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new Typed('#home', {
            strings: ['PENGURUS PPGT 2022 - 2024'],
            typeSpeed: 130,
            typeDelay: 100,
            loop: false,
            startDelay: 300,
        });

        document.querySelectorAll('[data-more-toggle]').forEach((btn) => btn.addEventListener('click', () => {
            for (const el of document.querySelectorAll('[data-more-short], [data-more-full]')) el.hidden = !el.hidden;
        }));
    </script>
@endpush
