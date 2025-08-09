<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>