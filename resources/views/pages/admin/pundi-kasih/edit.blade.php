@extends('layouts.admin')

@section('title')
    Admin Pundi Kasih
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('pundi-kasih.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Pundi Kasih</span>
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
                <form action="{{ route('pundi-kasih.update', $data->id) }}" method="POST" >
                    @csrf
                    @method('put')
                    <label for="pertanyaan" class="mb-2">Nama Bank : {{ $data->bank->name }} </label>
                        <br>
                    <label for="no_rek" class="mb-2">No Rekening <span class="star">*</label>
                    <input type="text" name="no_rek" id="no_rek" class="form-control mb-4"
                        value="{{ $data->no_rek }}">

                    <label for="atas_nama" class="mb-2">Atas Nama <span class="star">*</label>
                    <input type="text" name="atas_nama" id="atas_nama" class="form-control mb-4"
                        value="{{ $data->atas_nama }}">

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
