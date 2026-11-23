@extends('layouts.admin')

@section('title')
    Admin Profil
@endsection

@section('content')
    <div class="mx-auto max-w-5xl">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-admin-border">
            <div class="flex items-center gap-4 border-b border-admin-border bg-linear-to-r from-purple-50 to-white px-6 py-5 md:px-8">
                <a href="{{ route('profil-ppgt.index') }}" title="Kembali"
                    class="grid size-10 shrink-0 place-items-center rounded-xl bg-white text-slate-500 shadow-sm ring-1 ring-admin-border transition hover:text-purple-600"><i class="bx bx-arrow-back text-xl"></i></a>
                <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-purple-500 text-2xl text-white shadow-lg shadow-purple-500/30"><i class="bx bx-history"></i></span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-purple-600">Ubah data</p>
                    <h1 class="text-xl font-extrabold text-admin-heading">Profil</h1>
                </div>
            </div>
            <div class="p-6" id="profil">
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl p-4 [&_ul]:list-disc [&_ul]:pl-5 bg-rose-50 text-rose-700 ring-1 ring-rose-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('profil-ppgt.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="periode" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Periode Kepengurusan <span class="font-bold text-rose-500">*</label>
                    <input type="text" name="periode" id="periode" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-purple-400 focus:bg-white focus:ring-4 focus:ring-purple-100 disabled:bg-slate-100 mb-6"
                        value="{{ $profil->periode }}">

                    <label for="content" class="inline-block mb-2 text-sm font-semibold text-admin-heading">Sejarah Kepengurusan</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-purple-400 focus:bg-white focus:ring-4 focus:ring-purple-100 disabled:bg-slate-100">{!! $profil->content !!}</textarea>

                    <label for="photo" class="inline-block mt-6">Foto Kepengurusan</label>
                    <div class="font-bold text-rose-500 mb-2">Tidak perlu upload klaw tidak ingin mengganti</div>
                    <input type="file" name="photo" class="block w-full rounded-xl border border-admin-border bg-slate-50/60 px-4 py-2.5 text-[0.9375rem] leading-[1.53] text-admin-heading outline-none transition placeholder:text-slate-400 focus:border-purple-400 focus:bg-white focus:ring-4 focus:ring-purple-100 disabled:bg-slate-100">

                    <button type="submit" class="block w-full rounded-xl text-center font-semibold transition px-5 py-3 text-[0.9375rem] bg-purple-600 text-white shadow-lg shadow-purple-600/30 hover:bg-purple-700 mt-6!">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
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

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message :
                            genericErrorText);
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
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

        function uploadImage(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#content'), {
                extraPlugins: [uploadImage],


                // More configuration options.
                // ...
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endpush
