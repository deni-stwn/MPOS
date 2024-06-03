<x-drawer-component id="drawer-edit-user" title="Edit User">
    <form id="edit-user-form" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input type="password" name="password" id="password"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        </div>
        <div class="mt-8">
            <x-button type="submit" classes="btn w-full">
                Edit
            </x-button>
        </div>
    </form>
</x-drawer-component>
