@extends('layouts.admin')

@section('title')
    Admin Artikel
@endsection

@section('content')
    <div class="pages">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('artikel.index') }}" class="back">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span class="title">Artikel PPGT</span>
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
                <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" id="artikel-form">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="judul" class="mb-2">Judul Artikel <span class="star">*</label>
                                <input type="text" name="judul" id="judul" class="form-control mb-4" placeholder="Tambahkan Judul Artikel" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="tanggal" class="mb-2">Tanggal Artikel <span class="star">*</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control mb-4" required>
                        </div>
                    </div>

                    <label for="isi" class="mb-2">Isi Artikel <span class="star">*</label>
                    <textarea name="isi" id="isi" cols="30" rows="10" class="form-control"></textarea>

                    <label for="tags" class="mb-2 mt-4">Tags <span class="star">*</span></label>
                    <div id="tags-container" class="d-flex flex-row">
                        <div id="tagOutput"></div>
                        <input type="hidden" name="tags" id="tags-hidden" required>
                        <input type="text" class="form-control mb-4" id="tags-input" placeholder="Tambahkan tag artikel">
                    </div>

                    <label for="photo" class=" mb-2">Foto Artikel <span class="star">*</label>
                    <input type="file" name="photo" class="form-control" accept="image/png,image/jpeg" required>

                    <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        class MyUploadAdapter {
            constructor( loader ) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }

            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();


                xhr.open( 'POST', '{{ route('ckeditor.upload') }}', true );
                xhr.setRequestHeader( 'x-csrf-token', '{{ csrf_token() }}' );
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;

                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }

                    resolve( {
                        default: response.url
                    } );
                } );

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }

            // Prepares the data and sends the request.
            _sendRequest( file ) {
                // Prepare the form data.
                const data = new FormData();

                data.append( 'upload', file );

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send( data );
            }
        }

        function uploadPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter( loader );
            };
        }

        ClassicEditor
            .create( document.querySelector( '#isi' ), {
                extraPlugins: [ uploadPlugin ],

                // More configuration options.
                // ...
            } )
            .catch( error => {
                console.log( error );
            } );

    </script>
    <script>
        function addTag(tagText) {
            var tagSpan = document.createElement('span');
            tagSpan.textContent = tagText;
            tagSpan.className = 'badge bg-primary mx-1 mb-1';

            // Menambahkan tombol "x" untuk menghapus tag
            var deleteButton = document.createElement('button');
            deleteButton.textContent = 'x';
            deleteButton.className = 'bg-white rounded border ms-1 p-1';
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
