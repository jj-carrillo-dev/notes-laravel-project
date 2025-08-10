<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>