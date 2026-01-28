@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-emerald-300 text-base font-medium text-white bg-blue-900/80 focus:outline-none'
                : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-emerald-100 hover:text-white hover:bg-blue-800 hover:border-emerald-200 focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
