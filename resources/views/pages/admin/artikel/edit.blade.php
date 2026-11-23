@extends('layouts.admin')

@section('title')
    Admin Artikel
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-fuchsia-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('artikel.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-fuchsia-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-fuchsia-500 text-2xl text-white shadow-lg shadow-fuchsia-500/30"><i class="bx bx-news"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-fuchsia-600">Ubah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Artikel PPGT</h1>
                </div>
            </div>
            <div class="p-6 md:p-8">
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-rose-50 text-rose-700 ring-1 ring-rose-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('artikel.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                    id="artikel-form">
                    @csrf
                    @method('PUT')
                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="judul" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Judul Artikel <span class="font-bold text-rose-500">*</span></label>
                            <input type="text" name="judul" id="judul" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-fuchsia-400 focus:bg-white focus:ring-4 focus:ring-fuchsia-100 disabled:bg-slate-100 mb-6"
                                placeholder="Tambahkan Judul Artikel" value="{{ $data->judul }}" required>
                        </div>
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="tanggal" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Tanggal Artikel <span class="font-bold text-rose-500">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-fuchsia-400 focus:bg-white focus:ring-4 focus:ring-fuchsia-100 disabled:bg-slate-100 mb-6"
                                value="{{ $data->tanggal }}" required>
                        </div>
                    </div>

                    <label for="isi" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Isi Artikel <span class="font-bold text-rose-500">*</span></label>
                    <textarea name="isi" id="isi" cols="30" rows="10" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-fuchsia-400 focus:bg-white focus:ring-4 focus:ring-fuchsia-100 disabled:bg-slate-100">{!! $data->isi !!}</textarea>

                    <label for="tags" class="inline-block mb-2 text-sm font-semibold text-admin-heading mt-6">Tags <span class="font-bold text-rose-500">*</span></label>
                    <div id="tags-container" class="flex flex-row">
                        <div id="tagOutput"></div>
                        <input type="hidden" name="tags" id="tags-hidden" required>
                        <input type="text" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-fuchsia-400 focus:bg-white focus:ring-4 focus:ring-fuchsia-100 disabled:bg-slate-100 mb-6" id="tags-input" placeholder="Tambahkan tag artikel">
                    </div>

                    <div class="-mx-3 flex flex-wrap">
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="photo" class="inline-block mb-2 text-sm font-semibold text-admin-heading mt-6">Foto Artikel <span class="font-bold text-rose-500">*</span></label>
                            <input type="file" name="photo" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-fuchsia-400 focus:bg-white focus:ring-4 focus:ring-fuchsia-100 disabled:bg-slate-100" accept="image/png,image/jpeg">
                            <div class="font-semibold text-[#f00]">Tidak perlu upload kalau tidak ingin mengganti
                                gambar</div>
                        </div>
                        <div class="shrink-0 px-3 w-full mb-2 md:w-6/12">
                            <div>Image Preview</div>
                            <img class="h-[150px]" src="{{ Storage::url($data->photo) }}" alt="">
                        </div>
                    </div>

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-fuchsia-600 text-white shadow-lg shadow-fuchsia-600/30 hover:bg-fuchsia-700 mt-6!">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();


                xhr.open('POST', '{{ route('ckeditor.upload') }}', true);
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }

                    resolve({
                        default: response.url
                    });
                });

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            // Prepares the data and sends the request.
            _sendRequest(file) {
                // Prepare the form data.
                const data = new FormData();

                data.append('upload', file);

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send(data);
            }

        }

        function uploadPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#isi'), {
                extraPlugins: [uploadPlugin],

                // More configuration options.
                // ...
            })
            .catch(error => {
                console.log(error);
            });
    </script>
    <script>
        // Fungsi untuk menambahkan tag ke tagOutput
        function addTag(tagText) {
            var tagSpan = document.createElement('span');
            tagSpan.textContent = tagText;
            tagSpan.className = 'badge mx-1 mb-1 inline-flex items-center rounded bg-admin px-2 py-1 text-xs font-bold text-white';

            // Menambahkan tombol "x" untuk menghapus tag
            var deleteButton = document.createElement('button');
            deleteButton.textContent = 'x';
            deleteButton.className = 'ml-1 rounded border bg-white px-1.5 text-black';
            deleteButton.onclick = function() {
                tagSpan.remove();
                updateHiddenInput();
            };

            tagSpan.appendChild(deleteButton);
            document.getElementById('tagOutput').appendChild(tagSpan);
            updateHiddenInput();
        }

        // Fungsi untuk memperbarui nilai input tersembunyi dengan nilai tag yang ada
        function updateHiddenInput() {
            var tagsArray = [];
            var tagsElements = document.getElementById('tagOutput').querySelectorAll('.badge');
            tagsElements.forEach(function(tagElement) {
                tagsArray.push(tagElement.textContent.trim());
            });
            document.getElementById('tags-hidden').value = JSON.stringify(tagsArray);
        }

        // Event listener untuk menambahkan tag saat spasi ditekan
        document.getElementById('tags-input').addEventListener('keypress', function(event) {
            if (event.keyCode === 32 || event.which === 32) {
                event.preventDefault(); // Mencegah default action form
                var tagInput = document.getElementById('tags-input');
                var tagText = tagInput.value.trim();
                if (tagText !== '') {
                    addTag(tagText);
                    tagInput.value = '';
                }
            }
        });

        // Tampilkan tag-tag dari data artikel saat halaman dimuat
        var tagsArray = {!! json_encode($tagsArray) !!};
        tagsArray.forEach(function(tagText) {
            addTag(tagText);
        });

        document.getElementById('artikel-form').addEventListener('submit', function(event) {
            var tagOutput = document.getElementById('tagOutput').children;

            var tagsArray = [];

            for (var i = 0; i < tagOutput.length; i++) {
                tagsArray.push(tagOutput[i].textContent.trim());
            }

            document.getElementById('tags-hidden').value = tagsArray.join(',');

            if (tagsArray.length === 0) {
                event.preventDefault(); // Mencegah formulir disubmit
                alert('Tag tidak boleh kosong');
            }
        });
    </script>
@endpush
