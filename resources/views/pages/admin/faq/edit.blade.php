@extends('layouts.admin')

@section('title')
    Admin Frequenly Ask Question
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('faq.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Frequenly Ask Question</span>
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
                <form action="{{ route('faq.update', $faq->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <label for="pertanyaan" class="mb-2">Pertanyaan <span class="star">*</label>
                    <input type="text" name="pertanyaan" id="pertanyaan" class="form-control mb-4"
                        value="{{ $faq->pertanyaan }}">

                    <label for="jawaban" class="mb-2">Jawaban <span class="star">*</label>
                    <textarea name="jawaban" id="jawaban" cols="30" rows="10">{!! $faq->jawaban !!}</textarea>

                    <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#jawaban'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
