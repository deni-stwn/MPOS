<x-drawer-component id="drawer-add-user" title="Tambah User">
    <form id="add-user-form" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Form fields here -->
        <div class="space-y-6">
            <div>
                <div class="mt-1">
                    <label for="fotoprofile" class="block text-sm font-medium text-gray-700">Foto Profile</label>
                    <div class="needsclick dropzone" id="fotoprofile-dropzone"></div>
                </div>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input type="email" name="email" id="email"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div>
                <label for="nomor_telf" class="block text-sm font-medium text-gray-700">No Telf</label>
                <div class="mt-1">
                    <input type="number" name="nomor_telf" id="nomor_telf"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div>
                <label for="nama_toko" class="block text-sm font-medium text-gray-700">Nama Toko</label>
                <div class="mt-1">
                    <input type="text" name="nama_toko" id="nama_toko"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input type="password" name="password" id="password"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        </div>
        <div class="mt-8">
            <x-button type="submit" classes="btn w-full">
                Tambah
            </x-button>
        </div>
    </form>
</x-drawer-component>


@push('scripts')
    <script>
        let uploadedDocumentMap = {}
        Dropzone.options.fotoprofileDropzone = {
            url: '{{ route('users.storeMedia') }}',
            maxFilesize: 10, // MB
            maxFiles: 1,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp, .gif, .svg',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="foto[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="foto[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($user) && $user->foto)
                    let files =
                        {!! json_encode($user->foto) !!}
                    for (let i in files) {
                        let file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="foto[]" value="' + file.file_name +
                            '">')
                    }
                @endif
            }
        }
    </script>
@endpush
