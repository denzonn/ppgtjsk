@extends('layouts.app')

@section('title')
    Detail Kegiatan - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <section class="artikel">
        <div class="container">
            <div class="content mt-5 mb-3" data-aos="fade-up" data-aos-duration="1000">
                <h2>Artikel PPGT JSK</h2>
            </div>
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="row">
                        @foreach ($artikel as $item)
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
