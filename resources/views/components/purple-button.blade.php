@props(['tag' => 'button'])

<{{ $tag }} {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-indigo-600
                                                   border border-transparent rounded-md font-semibold
                                                   text-sm text-white hover:bg-indigo-700
                                                   focus:outline-none focus:ring-2
                                                   focus:ring-indigo-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</{{ $tag }}>
