@props(['type' => 'button', 'classes' => '', 'click' => ''])

<button type="{{ $type }}"
    class="{{ $classes }} bg-[#054248] rounded-[32px] text-sm px-[14px] py-[10px] text-white"
    @if ($click) onclick="{{ $click }}" @endif>
    {{ $slot }}
</button>
