<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('images/logo.png') }}" alt="" style="max-width: 35px">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SATKAS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li
            class="menu-item {{ request()->is('admin/renungan-harian*', 'admin/kegiatan-mingguan*', 'admin/faq*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Home</div>
            </a>

            <ul class="menu-sub {{ request()->is('admin/renungan-harian*') ? 'active' : '' }}">
                <li class="menu-item">
                    <a href="{{ route('renungan-harian.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Renungan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('kegiatan-mingguan.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Kegiatan Mingguan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('faq.index') }}" class="menu-link">
                        <div data-i18n="Without menu">FAQ</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Fitur</span>
        </li>

        <li
            class="menu-item {{ request()->is('admin/foto-ksb*', 'admin/pengurus*', 'admin/program-kerja*', 'admin/notulensi-rapat*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Misc">Pengurus</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('foto-ksb.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Foto KSB</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('pengurus.index') }}" class="menu-link">
                        <div data-i18n="Container">Pengurus</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('program-kerja.index') }}" class="menu-link">
                        <div data-i18n="Basic">Program Kerja</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('notulensi-rapat.index') }}" class="menu-link">
                        <div data-i18n="Basic">Notulensi Rapat</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->is('admin/data-anggota*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Account Settings">Keanggotaan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('data-anggota.index') }}" class="menu-link">
                        <div data-i18n="Account">Data Anggota</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->is('admin/profil*', 'admin/document*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Profil</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('profil-ppgt.index') }}" class="menu-link">
                        <div data-i18n="Basic">Profil</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('document.index') }}" class="menu-link">
                        <div data-i18n="Basic">Document</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->is('admin/kegiatan', 'admin/gallery-kegiatan*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-task"></i>

                <div data-i18n="Misc">Kegiatan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('kegiatan.index') }}" class="menu-link">
                        <div data-i18n="Basic">Kegiatan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('gallery-kegiatan.index') }}" class="menu-link">
                        <div data-i18n="Basic">Gallery Kegiatan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item {{ request()->is('admin/inventaris*', 'admin/keuangan*', 'admin/iuran*') ? 'active' : '' }}">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Asset</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('inventaris.index') }}" class="menu-link">
                        <div data-i18n="Basic">Inventaris</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('keuangan') }}" class="menu-link">
                        <div data-i18n="Notifications">Data Keuangan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('iuran.index') }}" class="menu-link">
                        <div data-i18n="Connections">Iuran Anggota</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item ">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Misc">Unit Usaha</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Error">Coming Soon</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->is('admin/saran*') ? 'active' : '' }}">
            <a href="{{ route('saran.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bell"></i>
                <div data-i18n="Analytics">Saran</div>
            </a>
        </li>
        {{-- Logout --}}
        <li class="menu-item">
            <a href="{{ route('logout') }}" class="menu-link"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="menu-icon tf-icons bx bx-log-out-circle"></i>
                <div data-i18n="Analytics">Logout</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </li>
    </ul>
</aside>
<!-- / Menu -->
