<div id="{{ $id }}"
    class="fixed drawer-slider inset-y-0 top-14 right-0 w-72 bg-white shadow-xl z-10 transform translate-x-full transition-transform duration-300">
    <div class="h-full flex flex-col">
        <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
            <div class="flex items-start justify-between flex-col gap-y-4">
                <div class="ml-3 h-7 flex items-center">
                    <button type="button"
                        class="bg-white flex gap-3 items-center rounded-md text-gray-400 hover:text-gray-500"
                        onclick="closeDrawer('{{ $id }}')">
                        <img src="{{ asset('assets/images/arrow.svg') }}" alt="arrow">
                        <span>Kembali</span>
                    </button>
                </div>
                <h2 class="text-lg font-semibold text-gray-900" id="slide-over-title">{{ $title }}</h2>
            </div>
            <div class="mt-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
