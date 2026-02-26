@props(['active' => false])

@php
    $classes = $active ?? false ? 'rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white' : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
