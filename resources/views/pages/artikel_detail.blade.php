@extends('layouts.app')

@section('title')
    Detail Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@push('prepend-style')
    <link rel="modulepreload" href="{{ asset('panorama-slider.uiinitiative.com/assets/vendor.0970188b.js') }}">
    <link rel="stylesheet" href="{{ asset('panorama-slider.uiinitiative.com/assets/index.98183fc7.css') }}">
@endpush

@section('content')
    <section class="artikel">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('artikel') }}"
                            style="text-decoration: none; color: black">Artikel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $artikel->judul }}</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-12 col-md-8">
                    <div>
                        <div class="detail-title">
                            {{ $artikel->judul }}
                        </div>
                        <div class="date">
                            <span>
                                {{ \Carbon\Carbon::parse($artikel->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                            </span>
                        </div>
                        <div>
                            <img src="{{ Storage::url($artikel->photo) }}" alt="" class="imagePhoto">
                        </div>
                        <div class="detail-isi">{!! $artikel->isi !!}</div>
                        <div class="editor">Editor : {{ $artikel->penulis }}</div>
                    </div>
                    <div>
                        <div class="related" style="font-size: 28px; color: #393E46; font-weight: 600; margin-top: 52px">
                            Related Posts</div>
                        <div class="row mt-2">
                            @foreach ($relatedPosts as $item)
                                <a href="{{ route('artikel-detail', $item->slug) }}" class="col-12 col-md-4"
                                    style="text-decoration: none">
                                    <div>
                                        <img src="{{ Storage::url($item->photo) }}" alt="" class="imageArtikel">
                                    </div>
                                    <div class="title">{{ $item->judul }}</div>
                                    <div class="isi">{!! \Illuminate\Support\Str::limit(strip_tags($item->isi), 200) !!}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="recent">Popular Posts</div>
                    <div class="mt-2">
                        @foreach ($popularArtikel as $item)
                            <div class="mb-1">
                                <a href="{{ route('artikel-detail', $item->slug) }}" class="popularArtikel">
                                    {{ $item->judul }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="recent" style="margin-top: 44px">Tags</div>
                    <div class="mt-2">
                        @foreach ($randomTags as $item)
                            <span class="badge bg-primary mb-2" style="font-size: 14px">{{ $item }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('prepend-script')
    <script type="module" crossorigin src="{{ asset('panorama-slider.uiinitiative.com/assets/index.3cc42008.js') }}">
    </script>
@endpush
