@extends('layouts.admin')

@section('title')
    Admin Artikel
@endsection

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        <div class="overflow-hidden rounded-xl bg-white border border-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-admin-light/60 px-5 py-4 md:px-6">
                <a href="{{ route('artikel.index') }}" title="Kembali"
                    class="grid size-8 shrink-0 place-items-center rounded-lg border border-admin-border bg-white text-admin-text transition-colors hover:text-admin-heading"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-admin text-lg text-white"><i class="bx bx-news"></i></span>
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-admin">Ubah data</p>
                    <h1 class="text-base font-bold text-admin-heading">Artikel PPGT</h1>
                </div>
            </div>
            <div class="p-5 md:p-6">
                @if ($errors->any())
                    <div class="mb-6 rounded-xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-danger-50 text-danger-700 ring-1 ring-danger-200">
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
                            <label for="judul" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Judul Artikel <span class="font-bold text-danger-500">*</span></label>
                            <input type="text" name="judul" id="judul" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                                placeholder="Tambahkan Judul Artikel" value="{{ $data->judul }}" required>
                        </div>
                        <div class="shrink-0 px-3 w-full md:w-6/12">
                            <label for="tanggal" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Tanggal Artikel <span class="font-bold text-danger-500">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100 mb-6"
                                value="{{ $data->tanggal }}" required>
                        </div>
                    </div>

                    <label for="isi" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Isi Artikel <span class="font-bold text-danger-500">*</span></label>
                    <textarea name="isi" id="isi" cols="30" rows="10" class="block w-full rounded-lg border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-admin focus:bg-white focus:ring-2 focus:ring-admin-light disabled:bg-slate-100">{!! $data->isi !!}</textarea>

                    <label for="tags" class="inline-block mb-2 text-sm font-semibold text-admin-heading mt-6">Tags <span class="font-bold text-danger-500">*</span></label>
                    <div id="tags-container" class="flex min-h-11 flex-wrap items-center gap-1 rounded-lg border border-admin-border bg-slate-50/60 px-2 py-1.5 transition focus-within:border-admin focus-within:bg-white focus-within:ring-2 focus-within:ring-admin-light">
                        <div id="tagOutput" class="contents"></div>
                        <input type="hidden" name="tags" id="tags-hidden" required>
                        <input type="text" class="min-w-40 flex-1 bg-transparent px-2 py-1 text-[0.9375rem] outline-none placeholder:text-slate-400" id="tags-input" placeholder="Tambahkan tag artikel">
                    </div>
                    <p class="mb-6 mt-1 text-xs text-admin-text">Ketik tag lalu tekan <kbd class="rounded border border-admin-border bg-white px-1 font-mono text-[10px]">Spasi</kbd> untuk menambahkannya.</p>

                    @include('pages.admin.partials.photo-picker', ['name' => 'photo', 'label' => 'Foto Artikel', 'current' => $data->photo, 'shape' => 'wide', 'hint' => 'Gambar sampul artikel. Biarkan jika tidak ingin mengganti.'])

                    <button type="submit" class="block w-full rounded-lg text-center text-sm font-semibold transition-colors px-5 py-2.5 bg-admin text-white hover:bg-admin-dark mt-6!">Simpan</button>
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
            tagSpan.className = 'badge inline-flex items-center rounded-full bg-admin py-1 pl-2.5 pr-1 text-xs font-semibold text-white';

            // Menambahkan tombol "x" untuk menghapus tag
            var deleteButton = document.createElement('button');
            deleteButton.innerHTML = '<span class="material-symbols-outlined text-[12px]!" aria-hidden="true">close</span>';
            deleteButton.title = 'Hapus tag';
            deleteButton.type = 'button';
            deleteButton.className = 'ml-1.5 grid size-4 place-items-center rounded-full bg-white/20 text-sm leading-none hover:bg-white/40';
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
                tagsArray.push(tagElement.firstChild.textContent.trim());
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
                tagsArray.push(tagOutput[i].firstChild.textContent.trim());
            }

            document.getElementById('tags-hidden').value = tagsArray.join(',');

            if (tagsArray.length === 0) {
                event.preventDefault(); // Mencegah formulir disubmit
                alert('Tag tidak boleh kosong');
            }
        });
    </script>
@endpush
