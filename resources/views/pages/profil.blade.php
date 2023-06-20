@extends('layouts.app')

@section('title')
    Profil - PPGT Jemaat Satria Kasih
@endsection

@section('content')
    <!-- History -->
    <section class="history">
        <div class="container">
            <div class="text-center">
                <h2>Dokumen Sejarah</h2>
            </div>
            @foreach ($profil as $item)
                <div class="content-container">
                    {!! $item->content !!}
                </div>
            @endforeach
        </div>
    </section>
    <!-- History -->
@endsection

@push('addon-script')
    <script>
        // Initialize Lightbox for images in the content
        function initializeLightbox() {
            const images = document.querySelectorAll('.content-container img');
            images.forEach((image) => {
                const anchor = document.createElement('a');
                anchor.href = image.src;
                anchor.setAttribute('data-lightbox', 'image');
                anchor.appendChild(image.cloneNode(true));
                image.parentNode.replaceChild(anchor, image);
            });

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });
        }

        document.addEventListener('DOMContentLoaded', initializeLightbox);
    </script>
@endpush
