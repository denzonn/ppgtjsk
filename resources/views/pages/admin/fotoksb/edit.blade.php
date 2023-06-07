@extends('layouts.admin')

@section('title')
    Admin Foto KSB
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <h4>Edit Foto KSB</h4>
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

                <div class="foto">
                    <img src="{{ Storage::url($ksb->foto) }}" alt="" style="max-width: 400px">
                </div>

                <form action="{{ route('foto-ksb.update', $ksb->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="nama" class="mb-2">Nama <span class="star">*</span></label>
                    <input type="text" name="nama" id="nama" class="form-control mb-4"
                        value="{{ $ksb->nama }}">

                    <label for="jabatan" class="mb-2">Jabatan <span class="star">*</span></label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control mb-4"
                        value="{{ $ksb->jabatan }}">

                    <label for="motto" class="mb-2">Motto <span class="star">*</span></label>
                    <textarea name="motto" id="motto" cols="30" rows="10" class="form-control">{!! $ksb->motto !!}</textarea>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <label for="instagram" class="mt-lg-4 mt-4 mb-2">Instagram</label>
                            <input type="text" name="instagram" id="instagram" class="form-control mb-4"
                                value="{{ $ksb->instagram }}">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="whatsapp" class="mt-lg-4 mb-2">Whatsapp</label>
                            <input type="text" name="whatsapp" id="whatsapp" class="form-control mb-4"
                                value="{{ $ksb->whatsapp }}">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label for="facebook" class="mt-lg-4 mb-2">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control mb-4"
                                value="{{ $ksb->facebook }}">
                        </div>
                    </div>

                    <label for="url_youtube" class="mb-2">Foto <span class="star">*</span></label>
                    <div class="text-muted">Jika tidak ingin mengganti foto tidak perlu mengupload</div>
                    <input type="file" name="foto" id="foto" class="form-control mb-4">

                    <button type="submit" class="btn btn-primary btn-block w-100">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        ClassicEditor
            .create(document.querySelector('#motto'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
