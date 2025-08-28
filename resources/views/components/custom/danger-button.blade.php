<x-custom.button {{ $attributes->merge(['class' => 'bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-900 text-white']) }}>
    {{ $slot }}
</x-custom.button>