<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top blackColor">
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" class="photoback ml-2" />
        <a class="navbar-brand" href="{{ route('home') }}">Jemaat Satria Kasih</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa-solid fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('keanggotaan*') ? 'active' : '' }}"
                        href="{{ route('keanggotaan') }}">Keanggotaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('unit-usaha*') ? 'active' : '' }}"
                        href="{{ route('unit-usaha') }}">Unit Usaha</a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-button {{ request()->is('kegiatan', 'gallery', 'profil*', 'dokument*') ? 'active' : '' }}"
                        href="#" onmouseenter="toggleMenuOpen(true)" onmouseleave="toggleMenuOpen(false)">
                        PPGT
                        <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 9L11.7874 14.7874V14.7874C11.9048 14.9048 12.0952 14.9048 12.2126 14.7874V14.7874L18 9"
                                stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <div onmouseenter="toggleMenuOpen(true)" onmouseleave="toggleMenuOpen(false)" class="menu">
                        <div class="menu-buttons">
                            <button class="active" onclick="toggleMenuBlock(this, 0)">
                                PPGT
                            </button>
                        </div>
                        <div id="menuContent" class="menu-content">
                            <div class="menu-block">
                                <a class="dropdown-item {{ request()->is('profil*') ? 'active' : '' }}"
                                    href="{{ route('profil') }}">Profil</a>
                                <a class="dropdown-item {{ request()->is('dokument*') ? 'active' : '' }}"
                                    href="{{ route('document') }}">Document</a>
                                <a class="dropdown-item {{ request()->is('kegiatan*') ? 'active' : '' }}"
                                    href="{{ route('kegiatan') }}">Kegiatan</a>
                                <a class="dropdown-item {{ request()->is('gallery*') ? 'active' : '' }}"
                                    href="{{ route('gallery') }}">Gallery</a>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- Jika sdh auth maka tidak usah tampilkan --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar -->
