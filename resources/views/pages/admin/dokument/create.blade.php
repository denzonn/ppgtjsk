@extends('layouts.admin')

@section('title')
    Admin Dokumen
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('document.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Dokumen PPGT</span>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="formDocument" action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="judul" class="mb-2">Judul Dokumen <span class="star">*</label>
                    <input type="text" name="judul" id="judul" class="form-control mb-4">

                    <label for="file" class=" mb-2">File <span class="star">*</label>
                    <input type="file" name="file" class="form-control">

                    <div>
                        <button class="button mt-4 w-100">
                            <span class="submit">Submit</span>
                            <span class="loading"><i class="fa fa-refresh"></i></span>
                            <span class="check"><i class="fa fa-check"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        const button = document.querySelector('.button');
        const submit = document.querySelector('.submit');

        function toggleClass() {
            this.classList.toggle('actives');
        }

        function addClass() {
            this.classList.add('finished');
        }

        function submitForm() {
            setTimeout(function() {
                document.getElementById('formDocument').submit();
            }, 2000); // Delay redirect for 5 seconds (5000 milliseconds)
        }

        button.addEventListener('transitionend', toggleClass);
        button.addEventListener('transitionend', addClass);
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
            toggleClass.call(this);
            submitForm();
        });
    </script>
@endpush
