<a {{ $attributes }}
    class="{{ $active ? 'bg-gray-100 text-gray-400' : 'text-gray-400 hover:bg-gray-300 hover:text-gray-400' }} rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $active ? 'page' : false }}">{{ $slot }}
</a>

