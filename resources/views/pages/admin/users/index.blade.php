@extends('layouts.app')
@section('content')
    <div class="container duration-300" id="main-content">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">User</h2>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full rounded-lg overflow-hidden">
                        <div class="flex justify-end mb-2">
                            <x-button type="button" classes="btn" click="openDrawer('drawer-add-user')">
                                + Add User
                            </x-button>
                        </div>
                        <table id="table-user" class="min-w-full leading-normal">
                            <thead>
                                <tr class="text-center">
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Foto
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        name
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        No Telf
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Nama Toko
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.alert')

    {{-- form create --}}
    @include('pages.admin.users.create')

    {{-- form edit --}}
    @include('pages.admin.users.edit')

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                let table = new DataTable('#table-user', {
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('users.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'nomor_telf',
                            name: 'nomor_telf'
                        },
                        {
                            data: 'nama_toko',
                            name: 'nama_toko'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                handleFormSubmission('#add-user-form', "{{ route('users.store') }}", 'POST', 'User added successfully.',
                    'drawer-add-user', table);

                handleFormSubmission('#edit-user-form', function() {
                    let id = $('#edit-user-form').attr('action').split('/').pop();
                    return "/users/" + id;
                }, 'PUT', 'User updated successfully.', 'drawer-edit-user', table);

                $('#table-user').on("click", ".edit", function(event) {
                    event.preventDefault();
                    let id = $(this).attr("id");
                    $.ajax({
                        url: "/users/" + id + "/edit",
                        type: "GET",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function(res) {
                            console.log(res)
                            $("#edit-user-form").attr("action", "/users/" + id);
                            window.setEditDropzone("#edit-user-form #fotoprofile-dropzone", res,
                                'foto');
                            $("#edit-user-form" + " #name").val(res.name);
                            $("#edit-user-form" + " #email").val(res.email);
                            $("#edit-user-form" + " #nomor_telf").val(res.nomor_telf);
                            $("#edit-user-form" + " #password").val("");
                            openDrawer('drawer-edit-user');
                        },
                    });
                });

                handleDeleteButtonClick('#table-user', '/users/', table);
            });
        </script>
    @endpush
@endsection
