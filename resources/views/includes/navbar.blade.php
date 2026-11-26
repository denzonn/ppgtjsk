@php
    // transparent = navbar beranda: teks putih di atas hero, jadi putih solid saat di-scroll / dibuka.
    $transparent = $transparent ?? false;
    $text = $transparent ? 'text-white group-data-solid/nav:text-black' : 'text-black';
    // Di atas foto hero pakai biru cerah logo agar terbaca; di latar putih pakai biru PPGT.
    $accent = $transparent
        ? 'hover:text-ppgt-sky focus:text-ppgt-sky group-data-solid/nav:hover:text-brand group-data-solid/nav:focus:text-brand'
        : 'hover:text-brand focus:text-brand';
    $link = "block py-2 text-lg font-light lg:py-0 $accent $text";
    $active = $transparent ? 'text-ppgt-sky! group-data-solid/nav:text-brand!' : 'text-brand!';
    $ppgtActive = request()->is('kegiatan*', 'gallery*', 'profil*', 'dokument*');
@endphp
<nav data-navbar
    class="group/nav fixed inset-x-0 top-0 z-50 py-[15px] transition-all duration-1000 data-solid:bg-white data-solid:shadow-[0_5px_12px_-2px_rgba(211,211,211,0.75)]">
    <div class="mx-auto flex max-w-[1220px] flex-wrap items-center px-3">
        <img src="{{ \App\Models\SiteImage::url('logo') }}" class="mr-[15px] size-8 rounded-full md:size-12" alt="" />
        <a href="{{ route('home') }}"
            class="text-xl font-bold no-underline md:text-2xl {{ $transparent ? 'text-white group-data-solid/nav:text-[#5d5d5d]' : 'text-black' }}">
            Jemaat Satria Kasih
        </a>
        <button type="button" data-navbar-toggle aria-label="Toggle navigation"
            class="ml-auto rounded px-3 py-1 text-2xl lg:hidden {{ $text }}">
            <i class="fa-solid fa-bars"></i>
        </button>

        <ul
            class="hidden w-full items-center group-data-open/nav:flex max-lg:flex-col max-lg:items-start max-lg:pt-2 lg:ml-auto lg:mr-5 lg:flex lg:w-auto lg:gap-5">
            <li><a href="{{ route('home') }}" class="{{ $link }} {{ request()->is('/') ? $active : '' }}">Home</a></li>
            <li><a href="{{ route('artikel') }}" class="{{ $link }} {{ request()->is('artikel*') ? $active : '' }}">Artikel</a></li>
            <li><a href="{{ route('form-anggota') }}" class="{{ $link }} {{ request()->is('form-anggota*') ? $active : '' }}">Keanggotaan</a></li>
            <li><a href="{{ route('iuran') }}" class="{{ $link }} {{ request()->is('iuran*') ? $active : '' }}">Iuran</a></li>
            <li class="group/dd relative">
                <a href="#" class="{{ $link }} {{ $ppgtActive ? $active : '' }} inline-flex items-center gap-1">
                    PPGT <i class="fa-solid fa-chevron-down text-xs"></i>
                </a>
                <div
                    class="invisible absolute left-0 top-full z-10 min-w-48 translate-y-[-10px] rounded-lg bg-white py-2 opacity-0 shadow-[0_20px_30px_rgba(57,76,96,0.15)] transition-all duration-300 group-focus-within/dd:visible group-focus-within/dd:translate-y-0 group-focus-within/dd:opacity-100 group-hover/dd:visible group-hover/dd:translate-y-0 group-hover/dd:opacity-100 lg:mt-2">
                    @foreach ([['profil', 'Profil', 'profil*'], ['document', 'Document', 'dokument*'], ['kegiatan', 'Kegiatan', 'kegiatan*'], ['gallery', 'Gallery', 'gallery*']] as [$route, $label, $pattern])
                        <a href="{{ route($route) }}"
                            class="flex h-10 items-center px-6 text-base text-[#222] hover:text-brand {{ request()->is($pattern) ? 'text-brand' : 'opacity-60 hover:opacity-100' }}">{{ $label }}</a>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('unit-usaha') }}" class="{{ $link }} {{ request()->is('unit-usaha*') ? $active : '' }}">Unit Usaha</a></li>
            @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="{{ $link }}">{{ __('Logout') }}</button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav>
