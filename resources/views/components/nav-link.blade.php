@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-emerald-300 text-sm font-medium leading-5 text-white focus:outline-none focus:border-emerald-200 transition'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-emerald-100 hover:text-white hover:border-emerald-200 focus:outline-none focus:text-white focus:border-emerald-200 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
