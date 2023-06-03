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
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member') }}">Keanggotaan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('gallery') }}">Gallery</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profil') }}">Profil</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('document') }}">Document</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bussiness.html">Unit Usaha</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kontak.html">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar -->
