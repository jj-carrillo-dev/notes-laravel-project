<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Notebook
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-link-button href="{{ route('notebooks.create') }}">
                New Note
            </x-link-button>
            @forelse ($notebooks as $notebook)
                <div class="bg-white dark:bg-gray-800 p-4 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-lg text-indigo-600">
                        <a href="{{ route('notebooks.show', $notebook) }}" class="hover:underline">
                            {{ $notebook->name }}
                        </a>
                    </h2> 
                        <span class="block mt-4 text-sm opacity-70">Created: {{ $notebook->created_at->diffForHumans() }} | Updated: {{ $notebook->updated_at->diffForHumans() }}</span>
                </div>
            @empty
                <p class="mt-2 text-gray-900 dark:text-gray-100">
                    You don-t have notebooks
                </p>
            @endforelse
            {{ $notebooks->links() }}
        </div>
    </div>
</x-app-layout>
